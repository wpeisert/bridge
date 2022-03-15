<?php

namespace App\Interfaces\Deal;

use App\Models\Deal;
use App\Models\DealConstraint;

interface DealModifierInterface
{
    public function applySettingsConstraints(Deal $deal, DealConstraint $dealConstraint): void;
}
