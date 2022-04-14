<?php

namespace App\Services\DealBuilder;

use App\BridgeCore\Constants;
use App\Services\RandomSeederInterface;
use App\Models\Deal;

class DealGenerator implements DealGeneratorInterface
{
    public function __construct(private RandomSeederInterface $randomSeeder) {}

    public function generateRandom(): Deal
    {
        $this->randomSeeder->seed();

        $deal = new Deal();

        $deal->dealer = Constants::PLAYERS_NAMES[rand(0, Constants::PLAYERS_COUNT - 1)];
        $deal->vulnerable_NS = rand(0, 1);
        $deal->vulnerable_WE = rand(0, 1);

        $playersCardsArr = $this->generateRandomCards();
        for ($playerNo = 0; $playerNo < Constants::PLAYERS_COUNT; ++$playerNo) {
            $playerName = Constants::PLAYERS_NAMES[$playerNo];
            $field = 'cards_' . $playerName;
            $deal->$field = $playersCardsArr[$playerNo];
        }

        return $deal;
    }

    private function generateRandomCards(): array
    {
        $playersCardsArr = [];
        $perm = $this->getRandomPermutation(Constants::COLORS_COUNT * Constants::CARDS_IN_COLOR_COUNT);
        for ($playerNo = 0; $playerNo < Constants::PLAYERS_COUNT; ++$playerNo) {
            $playerCards = [];
            for ($colorNo = 0; $colorNo < Constants::COLORS_COUNT; ++$colorNo) {
                $playerCards[$colorNo] = [];
            }
            for ($playerCardNo = 0; $playerCardNo < Constants::PLAYERS_CARDS_COUNT; ++$playerCardNo) {
                $cardNo = $perm[$playerNo * Constants::PLAYERS_CARDS_COUNT + $playerCardNo];
                $cardColorNo = intdiv($cardNo, Constants::PLAYERS_CARDS_COUNT);
                $cardInColorNo = $cardNo % Constants::PLAYERS_CARDS_COUNT;
                $playerCards[$cardColorNo][] = $cardInColorNo;
            }
            for ($colorNo = 0; $colorNo < Constants::COLORS_COUNT; ++$colorNo) {
                sort($playerCards[$colorNo]);
                array_walk(
                    $playerCards[$colorNo],
                    function (&$cardInColorNo, $key) {
                        $cardInColorNo = Constants::CARDS[$cardInColorNo];
                    }
                );
                $playerCards[$colorNo] = implode('', $playerCards[$colorNo]);
            }
            $playersCardsArr[] = implode('.', $playerCards);
        }

        return $playersCardsArr;
    }

    private function getRandomPermutation(int $size): array
    {
        $arr = [];
        for ($iter = 0; $iter < $size; ++$iter) {
            $arr[] = ['value' => $iter, 'order' => rand()];
        }

        usort($arr, function ($a, $b) { return $a['order'] < $b['order']; });

        return array_map( function ($a) { return $a['value']; }, $arr );
    }
}
