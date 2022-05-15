<?php

namespace App\Services\Contract;

class Contract
{
    public string $bidColor;
    public string $declarer;
    public int $level;
    public string $type; // '', 'dbl', 'rdbl'
    public bool $vulnerable;

    public static function create(array $data = []): Contract
    {
        $contract = new Contract;
        foreach ($data as $name => $value) {
            if (property_exists(Contract::class, $name)) {
                $contract->$name = $value;
            }
        }

        return $contract;
    }
}
