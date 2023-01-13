<?php

namespace App\Services\Bidding;

use App\BridgeCore\Constants;
use App\Events\BidPlacedEvent;
use App\Models\Bid;
use App\Models\Bidding;
use Illuminate\Support\Facades\Log;

class PlayerService implements PlayerServiceInterface
{
    public function increasePlayer(string $playerName, int $count = 1): string
    {
        $playerIndex = array_search($playerName, Constants::PLAYERS_NAMES);
        $nextPlayerIndex = ($playerIndex + $count) % count(Constants::PLAYERS_NAMES);
        $nextPlayer = Constants::PLAYERS_NAMES[$nextPlayerIndex];
        return $nextPlayer;
    }
}
