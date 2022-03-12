<?php

namespace App\Interfaces\Deal;

use App\Models\Deal;
use App\Models\DealConstraint;

interface DealConstraintsVerifierInterface
{
    public function verify(Deal $deal, DealConstraint $dealConstraint): bool;
}
