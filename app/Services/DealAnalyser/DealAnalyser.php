<?php

namespace App\Services\DealAnalyser;

use App\Models\Deal;

class DealAnalyser implements DealAnalyserInterface
{
    private Deal $deal;

    public function setDeal(Deal $deal)
    {
        $this->deal = $deal;
    }

    public function analyse(int $rounds = 10): void
    {
        // TODO: Implement analyse() method.
    }
}
