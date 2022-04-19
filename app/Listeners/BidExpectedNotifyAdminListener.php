<?php

namespace App\Listeners;

use App\Events\BidExpectedEvent;
use App\Mail\BidExpectedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class BidExpectedNotifyAdminListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param BidExpectedEvent $event
     * @return void
     */
    public function handle(BidExpectedEvent $event)
    {
        /*
        Mail::to('info@sauron.pl')
            ->send(new BidExpectedMail($event->bidding));
        */
        return;
    }
}
