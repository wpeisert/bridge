<?php

namespace App\Services\Bidding;

use App\Models\Bidding;

class RuleChecker implements RuleCheckerInterface
{
    public function getPossibleBids(Bidding $bidding): array
    {
        return ['rdbl', 'pass',
            '4d', '4h', '4s', '4nt',
            '5c', '5d', '5h', '5s', '5nt',
            '6c', '6d', '6h', '6s', '6nt',
            '7c', '7d', '7h', '7s', '7nt',
        ];
    }
}
