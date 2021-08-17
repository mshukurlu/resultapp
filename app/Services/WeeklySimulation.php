<?php
namespace App\Services;
use App\Models\Match;
use Carbon\Carbon;

class WeeklySimulation{
    public function weeklyGameSimulation(int $numberOfWeek)
    {
        if($numberOfWeek>8)
        {
            abort(404);
        }

        $getWeeksMatch = Match::where('week',$numberOfWeek)
            ->first();

        if(!$getWeeksMatch->played_at) {
            $minGoals = 0;
            $maxGoals = 5;
            $guestTeamGoals = rand($minGoals,$maxGoals);
            $hostTeamsGoals = rand($minGoals,$maxGoals);
            $getWeeksMatch = tap($getWeeksMatch)
                ->update(['host_team_goals' => $hostTeamsGoals,
                    'guest_team_goals' => $guestTeamGoals,
                    'played_at'=>Carbon::now()]);
        }

        return  $getWeeksMatch;
    }

    public function getWeeklyPoints(int $numberOfWeek) : array
    {

    }
}
