<?php


namespace App\Services;


use App\Models\Team;

class TeamService
{
    /**
     * @return mixed
     */
    public function all()
    {
        return Team::orderBy('name')
            ->get();
    }
}
