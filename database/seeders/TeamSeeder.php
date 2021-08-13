<?php

namespace Database\Seeders;

use App\Models\League;
use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $teams = ['Chelsea','Arsenal','Manchester City','Liverpool'];

       $league = League::firstOrCreate(['name'=>'Premier league']);

        foreach ($teams as $team)
        {
            //Yes,I can mass insert avoiding iteration
            Team::create([
                'name'=>$team,
                'league_id'=>$league->id
            ]);
        }
    }
}
