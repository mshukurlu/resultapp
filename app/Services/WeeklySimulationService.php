<?php
namespace App\Services;
use App\Models\Match;
use Carbon\Carbon;

class WeeklySimulationService{
    public function weeklyGameSimulation(int $numberOfWeek)
    {
        if($numberOfWeek>6)
        {
            abort(404);
        }elseif($numberOfWeek==1)
        {
            $this->resetMatchScores();
        }

        $getWeeksMatches = Match::where('week',$numberOfWeek)
            ->get();
        foreach ($getWeeksMatches as $match) {
            if (!$match->played_at) {
                $minGoals = 0;
                $maxGoals = 5;
                $guestTeamGoals = rand($minGoals, $maxGoals);
                $hostTeamsGoals = rand($minGoals, $maxGoals);
                $match->update(['host_team_goals' => $hostTeamsGoals,
                        'guest_team_goals' => $guestTeamGoals,
                        'played_at' => Carbon::now()]);
            }
        }
        return  $getWeeksMatches;
    }

    public function resetMatchScores()
    {
        Match::query()
            ->update(['host_team_goals'=>0,'guest_team_goals'=>0,'played_at'=>null]);
    }
}
