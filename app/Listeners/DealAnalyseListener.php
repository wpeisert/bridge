<?php

namespace App\Listeners;

use App\Events\DealCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DealAnalyseListener implements ShouldQueue
{
    use InteractsWithQueue;

    public $queue = 'slow';

    public function __construct() {}

    /**
     * Handle the event.
     *
     * @param DealCreatedEvent $event
     * @return void
     */
    public function handle(DealCreatedEvent $event)
    {
        return;
        // @TODO do deal analysis
    }
}