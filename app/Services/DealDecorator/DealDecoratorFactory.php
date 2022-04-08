<?php

namespace App\Services\DealDecorator;

use App\Models\Deal;

class DealDecoratorFactory implements DealDecoratorFactoryInterface
{
    public function decorate(Deal $deal): DealDecoratorInterface
    {
        return new DealDecorator($deal);
    }
}
