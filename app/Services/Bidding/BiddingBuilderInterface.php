<?php

namespace App\Services\Bidding;

use App\Models\Bidding;
use App\Models\Deal;

interface BiddingBuilderInterface
{
    public function build(Deal $deal): Bidding;
}
