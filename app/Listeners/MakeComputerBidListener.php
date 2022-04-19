<?php

namespace App\Listeners;

use App\Events\BidExpectedEvent;
use App\Services\Bidding\BiddingServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class MakeComputerBidListener implements ShouldQueue
{
    use InteractsWithQueue;

    private const COMPUTER_USER_ID = 0;

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
        if ($bidding->is_finished) {
            Log::debug("Computer bidding. Bidding is finished ", ['bidding->id' => $bidding->id]);
            return;
        }

        if ($bidding->current_user_id != self::COMPUTER_USER_ID) {
            Log::debug(
                "Computer bidding. Not computer user. ",
                [
                    'bidding->id' => $bidding->id,
                    '$bidding->current_user_id' => $bidding->current_user_id,
                ]
            );
            return;
        }

        $this->biddingService->placeBid($bidding, 'pass');
    }
}
