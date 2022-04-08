<?php

namespace App\Services\DealBuilder;

use App\Services\DealConstraint\DealConstraintDecoratorFactoryInterface;
use App\Services\DealDecorator\DealDecoratorFactoryInterface;
use App\Services\DealDecorator\DealDecoratorInterface;
use App\Models\Deal;
use App\Models\DealConstraint;

class DealConstraintVerifier implements DealConstraintVerifierInterface
{
    private DealDecoratorInterface $deal;

    public function __construct(
        private DealDecoratorFactoryInterface $dealDecoratorFactory,
        private DealConstraintDecoratorFactoryInterface $dealConstraintDecoratorFactory
    ) {}

    public function verify(Deal $deal, DealConstraint $dealConstraint): bool
    {
        $dealDecorator = $this->dealDecoratorFactory->decorate($deal);
        $dealConstraintDecorator = $this->dealConstraintDecoratorFactory->decorate($dealConstraint);


        return true;
        // TODO: Implement verify() method.
    }
}
