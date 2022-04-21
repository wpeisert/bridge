<?php

namespace App\Services\DealAnalyser;

use App\Models\Deal;

interface DealAnalyserFactoryInterface
{
    public function parse(Deal $deal): DealAnalyserInterface;
}
