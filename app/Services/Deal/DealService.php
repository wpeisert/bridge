<?php

namespace App\Services\Deal;

use App\BridgeCore\Constants;

class DealService implements DealServiceInterface
{
    public function getPC(string $cards): int
    {
        $sum = array_reduce(
            str_split($cards),
            function ($sum, $card) {
                $index = array_search($card, Constants::CARDS);
                $pc = (Constants::CARDS_PC[$index ?? 666] ?? 0);
                return $sum + $pc;
            },
            0
        );

        return $sum;
    }

    public function getCardsCount(string $cards, int $colorNo, int $playerNo): int
    {
        $cardsArray = explode('.', $cards);

        return strlen($cardsArray[$colorNo]);
    }
}
