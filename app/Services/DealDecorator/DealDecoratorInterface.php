<?php

namespace App\Services\DealDecorator;

interface DealDecoratorInterface
{
    public function getValue(string $fieldName): int;
}
