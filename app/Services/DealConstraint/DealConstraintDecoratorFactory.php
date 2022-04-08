<?php

namespace App\Services\DealConstraint;

use App\Models\DealConstraint;
use App\Services\DealConstraint\DealConstraintDecoratorInterface;

class DealConstraintDecoratorFactory implements DealConstraintDecoratorFactoryInterface
{
    public function decorate(DealConstraint $dealConstraint): DealConstraintDecoratorInterface
    {
        return new DealConstraintDecorator($dealConstraint);
    }
}
