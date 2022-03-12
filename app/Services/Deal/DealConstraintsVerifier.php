<?php

namespace App\Services\Deal;

use App\Interfaces\Deal\DealConstraintsVerifierInterface;
use App\Models\Deal;
use App\Models\DealConstraint;

class DealConstraintsVerifier implements DealConstraintsVerifierInterface
{
    public function verify(Deal $deal, DealConstraint $dealConstraint): bool
    {
        throw new \Exception('not implemented yet');
        // TODO: Implement verify() method.
    }
}
