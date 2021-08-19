<?php

namespace App\Traits;

use App\Models\League;
use App\Models\Match;
use App\Models\Team;
use App\Services\StatisticService;

trait PredictionHelperFunctions
{

    private function simulateFurtherMatches($furtherMatches)
    {
        $options = array('minGoals' => config('simulation.minGoals'),
            'maxGoals' => config('simulation.maxGoals'),
            'simulationCount' => config('simulation.simulationCount')
        );

        return $this->linearSumWeeklyPointsOfTeam(
            $this->weeklySimulations($furtherMatches, $options)
        );

    }

    private function getPointsOfTeamsViaGoalCount($hostTeamGoals, $guestTeamGoals)
    {
        if ($hostTeamGoals == $guestTeamGoals) {
            $points = [
                'host_team_point' => 1,
                'guest_team_point' => 1
            ];
        } else if ($hostTeamGoals > $guestTeamGoals) {
            $points = [
                'host_team_point' => 3,
                'guest_team_point' => 0
            ];
        } else if ($hostTeamGoals < $guestTeamGoals) {
            $points = [
                'host_team_point' => 0,
                'guest_team_point' => 3
            ];
        }

        return $points;
    }

    private function weeklySimulations($furtherMatches, $options)
    {
        $weeklySimulation = array();

        foreach ($furtherMatches as $furtherMatch) {
            for ($i = 0; $i < $options['simulationCount']; $i++) {
                $makeRandomGoalsForHostTeam =
                    rand($options['minGoals'], $options['maxGoals']);
                $makeRandomGoalsForGuestTeam =
                    rand($options['minGoals'], $options['maxGoals']);
                $points = $this->getPointsOfTeamsViaGoalCount(
                    $makeRandomGoalsForHostTeam, $makeRandomGoalsForGuestTeam
                );
                $weeklySimulation[$furtherMatch['week']]
                [$furtherMatch['host_team_id']][] = $points['host_team_point'];
                $weeklySimulation[$furtherMatch['week']]
                [$furtherMatch['guest_team_id']][] = $points['guest_team_point'];
            }
        }
        return $weeklySimulation;
    }

    private function linearSumWeeklyPointsOfTeam($weeklySimulationResults)
    {
        $linearSum = array();
        foreach ($weeklySimulationResults as $week => $teamResults) {
            foreach ($teamResults as $teamId => $results) {
                foreach ($results as $index => $point) {
                    $linearSum[$teamId][$index] =
                        !isset($linearSum[$teamId][$index]) ? 0 :
                            $linearSum[$teamId][$index];

                    $linearSum[$teamId][$index] += $point;
                }
            }
        }
        return $linearSum;
    }

    private function addOldPointsToFurtherMatchesSimulationResults($simulatedMatchesResults)
    {
        $teamsPoints = (new StatisticService())
            ->getAllTeamPoints();

        foreach ($simulatedMatchesResults as $team_id => &$simulatedPoints) {
            foreach ($simulatedPoints as &$point) {
                #we are trying to find point via teamid
                $key = array_search($team_id, array_column($teamsPoints, 'id'));
                $point += $teamsPoints[$key]->pts;
            }
        }
        return $simulatedMatchesResults;
    }

    private function winCountOfEveryTeam($teamsPoints)
    {
        $teamsIds = League::first()->teams()->pluck('id');
        $teamWinCount = array();

        foreach ($teamsIds as $teamId) {
            //we assume every team can be winner at least 0 percentage

            $teamWinCount[$teamId] = 0;
        }
        for ($i = 0; $i < config('simulation.simulationCount'); $i++) {
            $winnerOnRow = $this->findWinTeamOnRow($i, $teamsPoints, $teamsIds);
            $teamWinCount[$winnerOnRow['id']] += 1;
            //  array_push($teamWinCount,$winnerOnRow['id']);
        }
        //  dd($teamWinCount);
        //  return array_count_values($teamWinCount);
        return $teamWinCount;
    }

    private function findWinTeamOnRow($rowIndex, $teamPoints, $teamIds)
    {
        $currentWinner = ['id' => 0, 'point' => 0];

        foreach ($teamIds as $team) {
            $rowPoint = $teamPoints[$team][$rowIndex];
            if ($rowPoint > $currentWinner['point']) {
                $currentWinner['id'] = $team;
                $currentWinner['point'] = $rowPoint;
            }
        }

        return $currentWinner;
    }

    private function winnerCountInPercentage($winnerCounts)
    {
        $predictInPercentage = [];
        $simulationCount = config('simulation.simulationCount');
        foreach ($winnerCounts as $teamId => $winnerCount) {
            $predictInPercentage[] = ['percentage' =>
                round(($winnerCount / $simulationCount) * 100, 2),
                'team_id' => $teamId];
        }
        return $predictInPercentage;
    }
}
