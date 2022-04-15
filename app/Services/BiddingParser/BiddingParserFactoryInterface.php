<?php

namespace App\Services\BiddingParser;

use App\Models\Bidding;

interface BiddingParserFactoryInterface
{
    public function parse(Bidding $bidding): BiddingParserInterface;
}
