<?php

namespace App\Services\BiddingParser;

use App\Models\Bidding;

class BiddingParser implements BiddingParserInterface
{
    private Bidding $bidding;

    public function __construct(private BiddingParserInterface $biddingParser) {}

    public function setBidding(Bidding $bidding)
    {
        $this->bidding = $bidding;
    }
}
