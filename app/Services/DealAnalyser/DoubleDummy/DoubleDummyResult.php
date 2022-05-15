<?php

namespace App\Services\DealAnalyser\DoubleDummy;

use App\BridgeCore\Constants;

class DoubleDummyResult
{
    private array $tricks;

    public function __construct(string $result)
    {
        $arr = explode(',', $result);
        $this->tricks = [];
        $iter = 0;
        foreach (Constants::PLAYERS_NAMES as $playerName) {
            foreach (Constants::BIDS_COLORS as $bidColor) {
                $this->tricks[$playerName][$bidColor] = intval(trim($arr[$iter]));
                ++$iter;
            }
        }
    }

    public function getTricks(string $playerName, string $bidColor): int
    {
        return $this->tricks[$playerName][$bidColor];
    }
}
