<?php

namespace App\Services\DealConstraints;

use App\Interfaces\DealConstraints\DealConstraintsVerifierInterface;
use App\Interfaces\Deal\DealDecoratorFactoryInterface;
use App\Interfaces\Deal\DealDecoratorInterface;
use App\Models\Deal;
use App\Models\DealConstraint;

class DealConstraintsVerifier implements DealConstraintsVerifierInterface
{
    private DealDecoratorInterface $deal;

    public function __construct(private DealDecoratorFactoryInterface $dealDecorator) {}

    public function verify(Deal $deal, DealConstraint $dealConstraint): bool
    {
        //$this->deal =
        return true;
        // TODO: Implement verify() method.
    }
}
