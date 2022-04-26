<?php

namespace App\Services\Bidding;

interface PlayerServiceInterface
{
    public function increasePlayer(string $playerName, int $count = 1): string;
}
