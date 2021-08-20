<?php


namespace App\Services;


use App\Models\Match;
use App\Models\Team;
use App\Traits\PredictionHelperFunctions;

/**
 * Class PredictionService
 * @package App\Services
 */
class PredictionService
{
    use PredictionHelperFunctions;

    /**
     * @return array
     */
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

    /**
     * @return array
     */
    public function getPredictionResults()
    {
        return $this->makePrediction();
    }

}
