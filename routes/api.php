<?php

use App\Http\Controllers\Simulation\MatchController;
use App\Http\Controllers\Simulation\StatisticsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix'=>'simulation'],function(){
    Route::get('weekly-match/{week}',
        [MatchController::class,'weeksMatch']);
    Route::get('table',[StatisticsController::class,'getResults']);
});
