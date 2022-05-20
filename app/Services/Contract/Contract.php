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

    public function getHash(): string
    {
        return self::calculateHash($this->declarer, $this->level, $this->bidColor, $this->type, $this->vulnerable);
    }

    public static function calculateHash(string $declarer, int $level, string $bidColor, string $type, bool $vulnerable): string
    {
        return $declarer . strval($level) . $bidColor . $type . ($vulnerable ? '(vuln)' : '');
    }
}
