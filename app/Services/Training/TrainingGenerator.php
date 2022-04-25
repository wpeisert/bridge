<?php

namespace App\Services\Training;

use App\Events\BidExpectedEvent;
use App\Models\Training;
use App\Services\Bidding\BiddingBuilderInterface;

class TrainingGenerator implements TrainingGeneratorInterface
{
    public function __construct(private BiddingBuilderInterface $biddingBuilder) {}

    public function generate(Training $training): int
    {
        $cnt = 0;
        foreach ($training->quiz->deals as $deal) {
            $bidding = $this->biddingBuilder->build($deal);
            $bidding->training_id = $training->id;
            $bidding->save();
            BidExpectedEvent::dispatch($bidding);
            $cnt++;
        }

        return $cnt;
    }
}
