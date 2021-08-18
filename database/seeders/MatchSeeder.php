<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class MatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = Team::inRandomOrder()->get();

        foreach ($teams as $team)
        {
            echo $team->name."<br/>";
        }

        $weeks = array(
            array('host_team_id'=>$teams[0]->id,'guest_team_id'=>$teams[1]->id,'week'=>1),
            array('host_team_id'=>$teams[2]->id,'guest_team_id'=>$teams[3]->id,'week'=>1),
            array('host_team_id'=>$teams[0]->id,'guest_team_id'=>$teams[3]->id,'week'=>2),
            array('host_team_id'=>$teams[2]->id,'guest_team_id'=>$teams[1]->id,'week'=>2),
            array('host_team_id'=>$teams[0]->id,'guest_team_id'=>$teams[2]->id,'week'=>3),
            array('host_team_id'=>$teams[3]->id,'guest_team_id'=>$teams[1]->id,'week'=>3),
            #SECOND PART
            array('host_team_id'=>$teams[1]->id,'guest_team_id'=>$teams[0]->id,'week'=>4),
            array('host_team_id'=>$teams[3]->id,'guest_team_id'=>$teams[2]->id,'week'=>4),
            array('host_team_id'=>$teams[3]->id,'guest_team_id'=>$teams[0]->id,'week'=>5),
            array('host_team_id'=>$teams[1]->id,'guest_team_id'=>$teams[2]->id,'week'=>5),
            array('host_team_id'=>$teams[2]->id,'guest_team_id'=>$teams[0]->id,'week'=>6),
            array('host_team_id'=>$teams[1]->id,'guest_team_id'=>$teams[3]->id,'week'=>6),
        );
//
        \App\Models\Match::insert($weeks);
    }
}
