<?php

namespace App\Listeners;

use App\Events\BidExpectedEvent;
use App\Mail\BidExpectedMail;
use App\Services\Bidding\BiddingServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class BidExpectedNotifyPlayerListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(private BiddingServiceInterface $biddingService) {}

    /**
     * Handle the event.
     *
     * @param BidExpectedEvent $event
     * @return void
     */
    public function handle(BidExpectedEvent $event)
    {
        $bidding = $event->bidding;
        $user = $bidding->training->getUser($bidding->current_player);
        if (!$user) {
            return;
        }
        Mail::to($user)
            ->send(new BidExpectedMail($bidding));
    }
}
