<?php

namespace App\Services\DealDecorator;

use App\Models\Deal;

class DealDecoratorFactory implements DealDecoratorFactoryInterface
{
    public function __construct(private DealDecoratorInterface $dealDecorator) {}

    public function decorate(Deal $deal): DealDecoratorInterface
    {
        $dealDecorator = clone $this->dealDecorator;
        $dealDecorator->setDeal($deal);

        return $dealDecorator;
    }
}
