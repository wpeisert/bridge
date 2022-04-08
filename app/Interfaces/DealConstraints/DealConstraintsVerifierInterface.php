<?php

namespace App\Interfaces\DealConstraints;

use App\Models\Deal;
use App\Models\DealConstraint;

interface DealConstraintsVerifierInterface
{
    public function verify(Deal $deal, DealConstraint $dealConstraint): bool;
}
