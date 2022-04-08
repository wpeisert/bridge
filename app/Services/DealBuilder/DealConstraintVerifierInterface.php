<?php

namespace App\Services\DealBuilder;

use App\Models\Deal;
use App\Models\DealConstraint;

interface DealConstraintVerifierInterface
{
    public function verify(Deal $deal, DealConstraint $dealConstraint): bool;
}
