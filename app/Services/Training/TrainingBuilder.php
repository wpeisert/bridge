<?php

namespace App\Services\Training;

use App\Models\Training;
use App\Services\Bidding\BiddingBuilderInterface;

class TrainingBuilder implements TrainingBuilderInterface
{
    public function __construct(private BiddingBuilderInterface $biddingBuilder) {}

    public function build(Training $training): int
    {
        $cnt = 0;
        foreach ($training->quiz->deals as $deal) {
            $bidding = $this->biddingBuilder->build($deal);
            $bidding->training_id = $training->id;
            $bidding->save();
            $cnt++;
        }

        return $cnt;
    }
}
