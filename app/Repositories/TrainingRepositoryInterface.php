<?php

namespace App\Repositories;

use App\Models\User;

interface TrainingRepositoryInterface
{
    public function getUserTrainings(int $userId, bool $active = true);
    public function splitUserTrainings(mixed $trainings);
}
