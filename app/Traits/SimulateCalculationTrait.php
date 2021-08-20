<?php

namespace App\Traits;

use App\Models\League;
use App\Models\Match;
use App\Models\Team;
use App\Services\StatisticService;

/**
 * Trait SimulateCalculationTrait
 * @package App\Traits
 */
trait SimulateCalculationTrait
{
    /**
     * @param $hostTeamGoals
     * @param $guestTeamGoals
     * @return int[]
     */
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



    /**
     * @param $weeklySimulationResults
     * @return array
     */
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

    /**
     * @param $simulatedMatchesResults
     * @return mixed
     */
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

    /**
     * @param $teamsPoints
     * @return array
     */
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

    /**
     * @param $rowIndex
     * @param $teamPoints
     * @param $teamIds
     * @return int[]
     */
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

    /**
     * @param $winnerCounts
     * @return array
     */
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
