<?php

namespace App\Services\Hands;

use App\BridgeCore\Constants;

class Hands
{
    private array $hands = [];

    /**
     * @param array $hands
     * @throws \Exception
     */
    public function setHands(array $hands)
    {
        foreach ($hands as $playerName => $hand) {
            $this->setHand($playerName, $hand);
        }
    }

    public function getHands(): array
    {
        return $this->hands;
    }

    public function setHand(string $playerName, string $hand)
    {
        $this->hands[$playerName] = $hand;
    }

    public function getHand(string $playerName): string
    {
        return $this->hands[$playerName] ?? '';
    }
}
