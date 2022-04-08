<?php

namespace App\Services\DealBuilder;

use App\Models\Deal;

interface DealGeneratorInterface
{
    public function generateRandom(): Deal;
}
