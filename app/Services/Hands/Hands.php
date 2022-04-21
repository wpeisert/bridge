<?php

namespace App\Services\Hands;

class Hands
{
    private $hands = [];

    public function __construct(array $hands)
    {
        $this->hands = $hands;
    }

    public function getHand(string $playerName): string
    {
        return $this->hands[$playerName] ?? '';
    }
}
