<?php

namespace App\Http\Controllers\Simulation;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\TeamService;
use Illuminate\Http\Request;

/**
 * Class TeamController
 * @package App\Http\Controllers\Simulation
 */
class TeamController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        return response()->json((new TeamService())
            ->all());
    }
}
