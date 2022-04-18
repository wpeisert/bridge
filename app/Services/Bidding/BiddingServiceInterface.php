<?php

namespace App\Services\Bidding;

use App\Models\Bidding;

interface BiddingServiceInterface
{
    public function placeBid(Bidding $bidding, mixed $createData);
    public function increaseCurrentPlayer(Bidding $bidding);
}
