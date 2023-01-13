<?php

namespace App\Listeners;

use App\Events\BidPlacedEvent;
use App\Mail\AdminBidPlacedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class BidPlacedNotifyAdminListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param BidPlacedEvent $event
     * @return void
     */
    public function handle(BidPlacedEvent $event)
    {
        Mail::to('info@sauron.pl')
            ->send(new AdminBidPlacedMail($event->bidding));
    }
}
