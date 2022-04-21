<?php

namespace App\Services\DealAnalyser;

use App\Models\Deal;

class DealAnalyserFactory implements DealAnalyserFactoryInterface
{
    public function __construct(private DealAnalyserInterface $dealAnalyser) {}

    public function parse(Deal $deal): DealAnalyserInterface
    {
        $dealAnalyser = clone $this->dealAnalyser;
        $dealAnalyser->setDeal($deal);

        return $dealAnalyser;
    }
}
