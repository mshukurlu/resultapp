<?php


namespace App\Traits;


trait SimulatePredectionTrait
{
    /**
     * @param $furtherMatches
     * @return array
     */
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

    /**
     * @param $furtherMatches
     * @param $options
     * @return array
     */
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

}
