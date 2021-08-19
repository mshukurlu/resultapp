<?php

namespace App\Http\Controllers\Simulation;

use App\Http\Controllers\Controller;
use App\Http\Resources\WeeklyResultsResource;
use App\Services\StatisticService;
use App\Services\WeeklySimulationService;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    protected $statisticService;
    public function __construct(StatisticService $statisticService)
    {
        $this->statisticService = $statisticService;
    }

    public function getResults()
    {
        $getAllPoints = $this->statisticService
            ->getTable();

        return response()->json(
            new WeeklyResultsResource($getAllPoints));
    }

    public function reset()
    {
        $this->statisticService->reset();

        return response()->json(['messsage'=>'Statistik cleared successfully']);
    }
}
