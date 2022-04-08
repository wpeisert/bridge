<?php

namespace App\Services\DealDecorator;

use App\Models\Deal;

class DealDecorator implements DealDecoratorInterface
{
    public function __construct(private Deal $deal) {}
}
