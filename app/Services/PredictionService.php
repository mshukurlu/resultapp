<?php


namespace App\Services;


use App\Models\Match;
use App\Models\Team;
use App\Traits\PredictionHelperFunctions;

class PredictionService
{
    use PredictionHelperFunctions;

    public function makePrediction()
    {
        $furtherMatches = Match::whereNull('played_at')
            ->get();

     $teamsPoints = $this->addOldPointsToFurtherMatchesSimulationResults(
            $this->simulateFurtherMatches($furtherMatches)
        );

      return $this->winnerCountInPercentage(
          $this->winCountOfEveryTeam($teamsPoints
          ));
    }

    public function getPredictionResults()
    {
        return $this->makePrediction();
    }

}
