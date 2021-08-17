<?php

namespace App\Http\Controllers\Simulation;

use App\Http\Controllers\Controller;
use App\Http\Resources\WeeklyResultsResource;
use App\Services\WeeklySimulation;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function getWeeklyResults(int $numberOfWeek)
    {
        $getAllPoints = (new WeeklySimulation())
            ->getWeeklyPoints($numberOfWeek);

        return response()->json(
            new WeeklyResultsResource($getAllPoints));
    }
}
