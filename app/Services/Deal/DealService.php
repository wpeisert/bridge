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
                if (in_array($card, Constants::CARDS)) {
                    $index = array_search($card, Constants::CARDS);
                    $pc = Constants::CARDS_PC[$index] ?? 0;
                    $sum += $pc;
                }

                return $sum;
            },
            0
        );

        return $sum;
    }

    public function getCardsCount(string $cards, int $colorNo): int
    {
        $cardsArray = explode('.', $cards);

        return strlen($cardsArray[$colorNo]);
    }
}
