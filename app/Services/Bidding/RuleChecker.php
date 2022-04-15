<?php

namespace App\Services\Bidding;

use App\BridgeCore\Constants;
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

        // pass
        $bids = ['pass'];

        $biddingParser = $this->biddingParserFactory->parse($bidding);

        // dbl
        if (
            $biddingParser->isColorBid(-1) ||
            ($biddingParser->isPass(-1) && $biddingParser->isPass(-2) && $biddingParser->isColorBid(-3))
        ) {
            $bids[] = 'dbl';
        }

        // rdbl
        if (
            $biddingParser->isDbl(-1) ||
            ($biddingParser->isPass(-1) && $biddingParser->isPass(-2) && $biddingParser->isDbl(-3))
        ) {
            $bids[] = 'rdbl';
        }

        // colors
        $lastColorBid = $biddingParser->getLastColorBid();
        $lastLevel = 0;
        $lastColorIndex = 0;
        if ($lastColorBid) {
            $lastLevel = intval($lastColorBid[0]);
            $lastColorIndex = array_search(substr($lastColorBid, 1), Constants::BIDS_COLORS);
        }

        for ($level = 1; $level <= Constants::BIDS_MAX_LEVEL; ++$level) {
            for ($colorIndex = 0; $colorIndex < count(Constants::BIDS_COLORS); ++$colorIndex) {
                if ($level < $lastLevel) {
                    continue;
                }
                if ($level === $lastLevel && $colorIndex <= $lastColorIndex) {
                    continue;
                }
                $bids[] = $level . Constants::BIDS_COLORS[$colorIndex];
            }
        }

        return $bids;

        return ['rdbl', 'pass',
            '4d', '4h', '4s', '4nt',
            '5c', '5d', '5h', '5s', '5nt',
            '6c', '6d', '6h', '6s', '6nt',
            '7c', '7d', '7h', '7s', '7nt',
        ];
    }
}
