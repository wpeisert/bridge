<?php

namespace App\Services\Training;

use App\Models\Training;

interface TrainingGeneratorInterface
{
    public function generate(Training $training): int;
}
