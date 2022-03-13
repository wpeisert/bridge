<?php

namespace App\Interfaces\Deal;

use App\Models\Deal;
use App\Models\DealConstraint;

interface DealModifierInterface
{
    public function applyBasicDealConstraints(Deal $deal, DealConstraint $dealConstraint): void;
}
