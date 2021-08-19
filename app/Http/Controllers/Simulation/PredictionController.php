<?php

namespace App\Http\Controllers\Simulation;

use App\Http\Controllers\Controller;
use App\Services\PredictionService;
use Illuminate\Http\Request;

class PredictionController extends Controller
{
   public function result()
   {
     $prediction = (new PredictionService())
           ->getPredictionResults();
    return response()->json($prediction);
   }
}
