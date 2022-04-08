<?php


namespace App\Services\Deal;


use App\Interfaces\Deal\DealDecoratorInterface;
use App\Models\Deal;

class DealDecorator implements DealDecoratorInterface
{
    public function __construct(private Deal $deal) {}
}
