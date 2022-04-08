<?php

namespace App\Services\DealBuilder;

use App\Services\DealDecorator\DealDecoratorFactoryInterface;
use App\Services\DealDecorator\DealDecoratorInterface;
use App\Models\Deal;
use App\Models\DealConstraint;

class DealConstraintVerifier implements DealConstraintVerifierInterface
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
