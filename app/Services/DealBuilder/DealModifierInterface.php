<?php

namespace App\Services\DealBuilder;

use App\Models\Deal;
use App\Models\DealConstraint;

interface DealModifierInterface
{
    public function applySettingsConstraints(Deal $deal, DealConstraint $dealConstraint): void;
}
