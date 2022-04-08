<?php

namespace App\Services\DealConstraint;

use App\Models\DealConstraint;
use App\Services\DealConstraint\DealConstraintDecoratorInterface;

interface DealConstraintDecoratorFactoryInterface
{
    public function decorate(DealConstraint $dealConstraint): DealConstraintDecoratorInterface;
}
