<?php

namespace App\Http\Controllers\Simulation;

use App\Http\Controllers\Controller;
use App\Http\Resources\WeeklyResultsResource;
use App\Services\StatisticService;
use App\Services\WeeklySimulationService;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function getResults()
    {
        $getAllPoints = (new StatisticService())
            ->getTable();

        return response()->json(
            new WeeklyResultsResource($getAllPoints));
    }
}
