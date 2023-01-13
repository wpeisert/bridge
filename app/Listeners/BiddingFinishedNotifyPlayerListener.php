<?php

namespace App\Listeners;

use App\BridgeCore\Constants;
use App\Events\BiddingFinishedEvent;
use App\Events\BidPlacedEvent;
use App\Mail\BiddingFinishedMail;
use App\Mail\BidPlacedMail;
use App\Services\Bidding\BiddingServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class BiddingFinishedNotifyPlayerListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param BidPlacedEvent $event
     * @return void
     */
    public function handle(BiddingFinishedEvent $event)
    {
        $bidding = $event->bidding;
        foreach (Constants::PLAYERS_NAMES as $playerName) {
            $player = $bidding->training->getUser($playerName);
            if ($player) {
                Mail::to($player)->send(new BiddingFinishedMail($bidding, $player));
            }
        }
    }
}
