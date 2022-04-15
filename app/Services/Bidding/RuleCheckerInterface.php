<?php

namespace App\Services\Bidding;

use App\Models\Bidding;

interface RuleCheckerInterface
{
    public function getPossibleBids(Bidding $bidding): array;
}
