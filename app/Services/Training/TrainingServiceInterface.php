<?php

namespace App\Services\Training;

use App\Models\Bidding;

interface TrainingServiceInterface
{
    public function splitUserTrainings(array $trainings): array;
    public function getNextBiddingInTraining(Bidding $bidding): Bidding;
}
