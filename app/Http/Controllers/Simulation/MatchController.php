<?php

namespace App\Http\Controllers\Simulation;

use App\Http\Controllers\Controller;
use App\Http\Resources\MatchCollection;
use App\Http\Resources\MatchResource;
use App\Models\Match;
use App\Models\Team;
use App\Models\User;
use App\Services\WeeklySimulationService;
use Illuminate\Http\Request;

/**
 * Class MatchController
 * @package App\Http\Controllers\Simulation
 */
class MatchController extends Controller
{
    /**
     * @param int $numberOfWeek
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function weeksMatch(int $numberOfWeek)
    {
        $getThisWeeksMatches = (new WeeklySimulationService())
            ->weeklyGameSimulation($numberOfWeek);

        return MatchResource::collection($getThisWeeksMatches);
    }
}
