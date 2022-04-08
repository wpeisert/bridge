<?php

namespace App\Services\DealDecorator;

use App\Models\Deal;

interface DealDecoratorFactoryInterface
{
    public function decorate(Deal $deal): DealDecoratorInterface;
}
