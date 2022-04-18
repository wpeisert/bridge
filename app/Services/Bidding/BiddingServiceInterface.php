<?php

namespace App\Services\Bidding;

use App\Models\Bidding;

interface BiddingServiceInterface
{
    public function isBidCorrect(Bidding $bidding, string $bid): bool;
    public function canUserPlaceBid(Bidding $bidding, int $userId): bool;
    public function canPlaceBid(Bidding $bidding, int $userId, string $bid): bool;
    public function placeBid(Bidding $bidding, mixed $createData);
    public function increaseCurrentPlayer(Bidding $bidding);
}
