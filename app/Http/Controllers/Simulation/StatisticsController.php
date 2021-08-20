<?php

namespace App\Http\Controllers\Simulation;

use App\Http\Controllers\Controller;
use App\Http\Resources\WeeklyResultsResource;
use App\Services\StatisticService;
use App\Services\WeeklySimulationService;
use Illuminate\Http\Request;

/**
 * Class StatisticsController
 * @package App\Http\Controllers\Simulation
 */
class StatisticsController extends Controller
{
    /**
     * @var StatisticService
     */
    protected $statisticService;

    /**
     * StatisticsController constructor.
     * @param StatisticService $statisticService
     */
    public function __construct(StatisticService $statisticService)
    {
        $this->statisticService = $statisticService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResults()
    {
        $getAllPoints = $this->statisticService
            ->getTable();

        return response()->json(
            new WeeklyResultsResource($getAllPoints));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset()
    {
        $this->statisticService->reset();

        return response()->json(['messsage'=>'Statistik cleared successfully']);
    }
}
