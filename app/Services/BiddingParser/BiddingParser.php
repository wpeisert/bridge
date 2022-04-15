<?php

namespace App\Services\BiddingParser;

use App\BridgeCore\Constants;
use App\Models\Bid;
use App\Models\Bidding;

class BiddingParser implements BiddingParserInterface
{
    private Bidding $bidding;

    /**
     * @var string[]
     */
    private array $bids;

    public function setBidding(Bidding $bidding)
    {
        $this->bidding = $bidding;
        $this->bids = array_map(function ($bid) {return $bid->bid;}, $bidding->bids()->get()->all());
    }

    public function isColorBid(int $index): bool
    {
        $bid = $this->getBid($index);
        return $bid && !in_array($bid, Constants::BIDS_SPECIAL);
    }

    public function isPass(int $index): bool
    {
        return 'pass' === $this->getBid($index);
    }

    public function isDbl(int $index): bool
    {
        return 'dbl' === $this->getBid($index);
    }

    public function getLastColorBid(): string
    {
        for ($index = count($this->bids) - 1; $index >= 0; --$index) {
            if (!$this->isColorBid($index)) {
                continue;
            }
            return $bid = $this->getBid($index);
        }

        return '';
    }

    public function getBid(int $index): string
    {
        $count = count($this->bids);
        if ($index >= 0 && $index < $count) {
            return $this->bids[$index];
        }
        if ($count + $index >=0) {
            return $this->bids[$count + $index];
        }
        return '';
    }
}
