<?php

namespace App\Services\BiddingParser;

use App\Models\Bidding;

class BiddingParserFactory implements BiddingParserFactoryInterface
{
    public function __construct(private BiddingParserInterface $biddingParser) {}

    public function parse(Bidding $bidding): BiddingParserInterface
    {
        $biddingParser = clone $this->biddingParser;
        $biddingParser->setBidding($bidding);

        return $biddingParser;
    }
}
