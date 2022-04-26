<?php

namespace App\Services\Training;

use Illuminate\Database\Eloquent\Builder;

interface TrainingQueryBuilderInterface
{
    public function getUserTrainings(int $userId): Builder;
    public function getUserTrainingsActive(int $userId, bool $active = true): Builder;
}
