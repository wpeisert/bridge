<?php

namespace App\Services\Deal;

use App\Interfaces\Deal\DealConstraintsVerifierInterface;
use App\Models\Deal;
use App\Models\DealConstraint;

class DealConstraintsVerifier implements DealConstraintsVerifierInterface
{
    public function verify(Deal $deal, DealConstraint $dealConstraint): bool
    {
        return true;
        // TODO: Implement verify() method.
    }
}
