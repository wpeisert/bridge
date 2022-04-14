<?php

namespace App\Services\Bidding;

use App\Models\Bidding;
use App\Models\Deal;

class BiddingBuilder implements BiddingBuilderInterface
{
    public function build(Deal $deal): Bidding
    {
        $bidding = new Bidding();
        $bidding->deal_id = $deal->id;
        $bidding->current_user = $deal->dealer;
        $bidding->status = '';

        return $bidding;
    }
}
