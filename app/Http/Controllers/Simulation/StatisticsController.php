<?php

namespace App\Http\Controllers\Simulation;

use App\Http\Controllers\Controller;
use App\Http\Resources\WeeklyResultsResource;
use App\Services\Statistic;
use App\Services\WeeklySimulation;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function getResults()
    {
        $getAllPoints = (new Statistic())
            ->getTable();

        return response()->json(
            new WeeklyResultsResource($getAllPoints));
    }
}
