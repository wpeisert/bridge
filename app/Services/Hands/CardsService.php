<?php


namespace App\Services\Hands;


use App\BridgeCore\Constants;

class CardsService
{
    public function numbers2string($cardsNumbers): string
    {
        $cards = [];
        for ($colorNo = 0; $colorNo < Constants::COLORS_COUNT; ++$colorNo) {
            $cards[$colorNo] = [];
        }
        foreach ($cardsNumbers as $cardNo) {
            $cardColorNo = intdiv($cardNo, Constants::PLAYERS_CARDS_COUNT);
            $cardInColorNo = $cardNo % Constants::PLAYERS_CARDS_COUNT;
            $cards[$cardColorNo][] = $cardInColorNo;
        }
        for ($colorNo = 0; $colorNo < Constants::COLORS_COUNT; ++$colorNo) {
            sort($cards[$colorNo]);
            array_walk(
                $cards[$colorNo],
                function (&$cardInColorNo, $key) {
                    $cardInColorNo = Constants::CARDS[$cardInColorNo];
                }
            );
            $cards[$colorNo] = implode('', $cards[$colorNo]);
        }

        $hand = implode('.', $cards);

        return $hand;
    }

    /**
     * @param string $hand
     * @return int[]
     */
    public function string2numbers(string $hand): array
    {
        $cardsNumbers = [];
        $cards = explode('.', $hand);
        for ($colorNo = 0; $colorNo < Constants::COLORS_COUNT; ++$colorNo) {
            $len = strlen($cards[$colorNo] ?? '');
            for ($pos = 0; $pos < $len; ++$pos) {
                $card = $cards[$colorNo][$pos];
                $cardsNumbers[] = $colorNo * Constants::CARDS_IN_COLOR_COUNT + array_search($card, Constants::CARDS);
            }
        }

        return $cardsNumbers;
    }
}
