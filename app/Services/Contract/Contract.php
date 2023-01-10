<?php

namespace App\Services\Contract;

use App\BridgeCore\Tools;

class Contract
{
    public string $bidColor;
    public string $declarer;
    public int $level;
    public string $type; // '', 'dbl', 'rdbl'
    public bool $vulnerable = false;

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

    public static function createFromHash(string $hash): Contract
    {
        if (str_contains($hash, 'pass')) {
            return self::PASS();
        }

        //$hash = $declarer . strval($level) . $bidColor . $type . ($vulnerable ? '(vuln)' : '');
        $vulnerable = str_contains($hash, '(vuln)');
        $type = '';
        if (str_contains($hash, 'rdbl')) {
            $type = 'rdbl';
        } elseif (str_contains($hash, 'dbl')) {
            $type = 'dbl';
        }
        if (str_contains($hash, 'nt')) {
            $bidColor = 'nt';
        } else {
            $bidColor = $hash[2];
        }

        return Contract::create(
            [
                'declarer' => $hash[0],
                'level' => intval($hash[1]),
                'bidColor' => $bidColor,
                'type' => $type,
                'vulnerable' => $vulnerable,
            ]
        );
    }

    public function getHash(): string
    {
        if ($this->isPass()) {
            return 'pass';
        }
        return self::calculateHash($this->declarer, $this->level, $this->bidColor, $this->type, $this->vulnerable);
    }

    public static function calculateHash(string $declarer, int $level, string $bidColor, string $type, bool $vulnerable): string
    {
        return $declarer . strval($level) . $bidColor . $type . ($vulnerable ? '(vuln)' : '');
    }

    public static function PASS(): Contract
    {
        if (!isset(self::$PASS)) {
            self::$PASS = Contract::create(['bidColor' => 'pass']);
        }

        return self::$PASS;
    }

    public function isPass(): bool
    {
        return 'pass' === $this->bidColor;
    }

    public function getAsString(): string
    {
        if ($this->isPass()) {
            return 'pass';
        }

        $contractStr = $this->declarer . ' ' . Tools::decorateBid($this->level . $this->bidColor);
        if ($this->type === 'rdbl') {
            $contractStr .= 'xx';
        } elseif ($this->type === 'rdbl') {
            $contractStr .= 'x';
        }

        return $contractStr;
    }

    private static Contract $PASS;
}
