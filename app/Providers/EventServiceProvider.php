<?php

namespace App\Providers;

use App\Events\BidPlacedEvent;
use App\Events\DealCreatedEvent;
use App\Listeners\BidPlacedNotifyAdminListener;
use App\Listeners\BidPlacedNotifyPlayerListener;
use App\Listeners\DealAnalyseListener;
use App\Listeners\MakeComputerBidListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        BidPlacedEvent::class => [
            BidPlacedNotifyAdminListener::class,
            BidPlacedNotifyPlayerListener::class,
            MakeComputerBidListener::class,
        ],
        DealCreatedEvent::class => [
            DealAnalyseListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
