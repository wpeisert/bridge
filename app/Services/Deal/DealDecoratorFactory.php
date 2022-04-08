<?php


namespace App\Services\Deal;


use App\Interfaces\Deal\DealDecoratorFactoryInterface;
use App\Interfaces\Deal\DealDecoratorInterface;
use App\Models\Deal;

class DealDecoratorFactory implements DealDecoratorFactoryInterface
{
    public function decorate(Deal $deal): DealDecoratorInterface
    {
        return new DealDecorator($deal);
    }
}
