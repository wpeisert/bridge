<?php


namespace App\Services\Hands;


use App\BridgeCore\Constants;

class Cards
{
    public function __construct(private string $cards = '') {}

    public function __toString(): string
    {
        return $this->cards;
    }

    public function setFromNumbers($cardsNumbers): Cards
    {
        $hand = [];
        for ($colorNo = 0; $colorNo < Constants::COLORS_COUNT; ++$colorNo) {
            $hand[$colorNo] = [];
        }
        foreach ($cardsNumbers as $cardNo) {
            $cardColorNo = intdiv($cardNo, Constants::PLAYERS_CARDS_COUNT);
            $cardInColorNo = $cardNo % Constants::PLAYERS_CARDS_COUNT;
            $hand[$cardColorNo][] = $cardInColorNo;
        }
        for ($colorNo = 0; $colorNo < Constants::COLORS_COUNT; ++$colorNo) {
            sort($hand[$colorNo]);
            array_walk(
                $hand[$colorNo],
                function (&$cardInColorNo, $key) {
                    $cardInColorNo = Constants::CARDS[$cardInColorNo];
                }
            );
            $hand[$colorNo] = implode('', $hand[$colorNo]);
        }

        $this->cards = implode('.', $hand);

        return $this;
    }

    public function getAsNumbers(): array
    {
        $cardsNumbers = [];
        $hand = explode('.', $this->cards);
        for ($colorNo = 0; $colorNo < Constants::COLORS_COUNT; ++$colorNo) {
            $len = strlen($hand[$colorNo] ?? '');
            for ($pos = 0; $pos < $len; ++$pos) {
                $card = $hand[$colorNo][$pos];
                $cardsNumbers[] = $colorNo * Constants::CARDS_IN_COLOR_COUNT + array_search($card, Constants::CARDS);
            }
        }

        return $cardsNumbers;
    }
}
