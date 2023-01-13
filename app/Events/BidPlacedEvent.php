<?php

namespace App\Events;

use App\Models\Bidding;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BidPlacedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Bidding $bidding) {}
}
