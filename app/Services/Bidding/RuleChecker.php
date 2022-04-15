<?php

namespace App\Services\Bidding;

use App\Models\Bidding;
use App\Services\BiddingParser\BiddingParserFactoryInterface;

class RuleChecker implements RuleCheckerInterface
{
    public function __construct(private BiddingParserFactoryInterface $biddingParserFactory) {}

    public function getPossibleBids(Bidding $bidding): array
    {
        if ($bidding->getIsFinishedAttribute()) {
            return [];
        }

        $biddingParser = $this->biddingParserFactory->parse($bidding);

        /*
        return ['rdbl', 'pass',
            '4d', '4h', '4s', '4nt',
            '5c', '5d', '5h', '5s', '5nt',
            '6c', '6d', '6h', '6s', '6nt',
            '7c', '7d', '7h', '7s', '7nt',
        ];
        */
    }
}
