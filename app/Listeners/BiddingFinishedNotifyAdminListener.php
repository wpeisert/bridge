<?php

namespace App\Listeners;

use App\Events\BiddingFinishedEvent;
use App\Mail\AdminBiddingFinishedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class BiddingFinishedNotifyAdminListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param BiddingFinishedEvent $event
     * @return void
     */
    public function handle(BiddingFinishedEvent $event)
    {
        Mail::to(config('bridge.admin_email'))
            ->send(new AdminBiddingFinishedMail($event->bidding));
    }
}
