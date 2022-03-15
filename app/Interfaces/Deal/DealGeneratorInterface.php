<?php

namespace App\Interfaces\Deal;

use App\Models\Deal;

interface DealGeneratorInterface
{
    public function generateRandom(): Deal;
}
