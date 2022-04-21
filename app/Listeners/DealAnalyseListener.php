<?php

namespace App\Listeners;

use App\Events\DealCreatedEvent;
use App\Services\DealAnalyser\DealAnalyserFactoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DealAnalyseListener implements ShouldQueue
{
    use InteractsWithQueue;

    public $queue = 'slow';

    public function __construct(private DealAnalyserFactoryInterface $dealAnalyserFactory) {}

    /**
     * Handle the event.
     *
     * @param DealCreatedEvent $event
     * @return void
     */
    public function handle(DealCreatedEvent $event)
    {
        $this->dealAnalyserFactory->parse($event->deal)->analyse();
    }
}
