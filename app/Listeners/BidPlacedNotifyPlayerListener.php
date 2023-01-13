<?php

namespace App\Listeners;

use App\Events\BidPlacedEvent;
use App\Mail\BidPlacedMail;
use App\Services\Bidding\BiddingServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class BidPlacedNotifyPlayerListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(private BiddingServiceInterface $biddingService) {}

    /**
     * Handle the event.
     *
     * @param BidPlacedEvent $event
     * @return void
     */
    public function handle(BidPlacedEvent $event)
    {
        $bidding = $event->bidding;
        $user = $bidding->training->getUser($bidding->current_player);
        if (!$user) {
            return;
        }
        Mail::to($user)
            ->send(new BidPlacedMail($bidding));
    }
}
