<?php

namespace App\Services\Deal;

use App\Interfaces\Deal\DealModifierInterface;
use App\Models\Deal;
use App\Models\DealConstraint;

class DealModifier implements DealModifierInterface
{
    public function applyBasicDealConstraints(Deal $deal, DealConstraint $dealConstraint): void
    {
        // @TODO
    }
}
