<?php

namespace App\Services\Hands;

use App\BridgeCore\Constants;

class Hands
{
    private array $hands;

    public function __construct(array $hands = [])
    {
        $this->hands = [];
        $this->setHands($hands);
    }

    /**
     * @param array $hands
     * @throws \Exception
     */
    public function setHands(array $hands)
    {
        foreach ($hands as $playerName => $cards) {
            $this->setHand($playerName, $cards);
        }
    }

    public function getHands(): array
    {
        return $this->hands;
    }

    public function setHand(string $playerName, string|Cards $cards)
    {
        if (!in_array($playerName, Constants::PLAYERS_NAMES)) {
            throw new \Exception("Player name not in " . implode(',', Constants::PLAYERS_NAMES));
        }

        $this->hands[$playerName] = is_string($cards) ? new Cards($cards) : $cards;
    }

    public function getHand(string $playerName): string
    {
        return $this->hands[$playerName] ?? '';
    }

    public function getHandsAsPBN(): string
    {
        $str = 'N:';
        foreach (Constants::PLAYERS_NAMES as $playerName) {
            $str .= $this->getHand($playerName) . ' ';
        }

        return trim($str);
    }
}
