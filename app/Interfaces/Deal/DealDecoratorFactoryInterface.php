<?php


namespace App\Interfaces\Deal;


use App\Models\Deal;

interface DealDecoratorFactoryInterface
{
    public function decorate(Deal $deal): DealDecoratorInterface;
}
