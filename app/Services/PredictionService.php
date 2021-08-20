<?php


namespace App\Services;


use App\Models\Match;
use App\Traits\SimulateCalculationTrait;
use App\Traits\SimulatePredectionTrait;

/**
 * Class PredictionService
 * @package App\Services
 */
class PredictionService
{
    use SimulateCalculationTrait,SimulatePredectionTrait;

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
