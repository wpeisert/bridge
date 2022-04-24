<?php

namespace App\Repositories;

use App\Models\Bidding;
use Illuminate\Database\Eloquent\Builder;

interface TrainingRepositoryInterface
{
    public function getUserTrainings(int $userId): Builder;
    public function getUserTrainingsActive(int $userId, bool $active = true): Builder;
    public function splitUserTrainings(array $trainings): array;
    public function getNextBiddingInTraining(Bidding $bidding): Bidding;
}
