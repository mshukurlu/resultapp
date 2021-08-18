<?php


namespace App\Services;


use App\Models\Team;

class TeamService
{
    public function all()
    {
        return Team::orderBy('name')
            ->get();
    }
}
