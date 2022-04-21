<?php

namespace App\Services\Hands;

use App\BridgeCore\Constants;

class HandsService
{
    public function generateRandomCards(): Hands
    {
        $hands = [];
        $perm = $this->getRandomPermutation(Constants::COLORS_COUNT * Constants::CARDS_IN_COLOR_COUNT);
        for ($playerNo = 0; $playerNo < Constants::PLAYERS_COUNT; ++$playerNo) {
            $hand = [];
            $playerName = Constants::PLAYERS_NAMES[$playerNo];
            for ($colorNo = 0; $colorNo < Constants::COLORS_COUNT; ++$colorNo) {
                $hand[$colorNo] = [];
            }
            for ($playerCardNo = 0; $playerCardNo < Constants::PLAYERS_CARDS_COUNT; ++$playerCardNo) {
                $cardNo = $perm[$playerNo * Constants::PLAYERS_CARDS_COUNT + $playerCardNo];
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

            $hands[$playerName] = implode('.', $hand);
        }

        return new Hands($hands);
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
