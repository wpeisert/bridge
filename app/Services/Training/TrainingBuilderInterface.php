<?php

namespace App\Services\Training;

use App\Models\Training;

interface TrainingBuilderInterface
{
    public function build(Training $training): int;
}
