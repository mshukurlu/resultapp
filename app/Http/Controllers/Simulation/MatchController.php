<?php

namespace App\Http\Controllers\Simulation;

use App\Http\Controllers\Controller;
use App\Http\Resources\MatchResource;
use App\Services\WeeklySimulation;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function weeksMatch(int $numberOfWeek)
    {
        $getThisWeeksMatches = (new WeeklySimulation())
            ->weeklyGameSimulation($numberOfWeek);

        return response()->json(new MatchResource($getThisWeeksMatches));
    }
}
