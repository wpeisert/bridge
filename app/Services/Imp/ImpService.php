<?php

namespace App\Services\Imp;

class ImpService
{
    private const INF = 9999999;
    private const TRESHOLDS = [
        10, 40, 80, 120, 160, 210, 260, 310, 360, 420,
        490, 590, 740, 890, 1090, 1290, 1490, 1740, 1990, 2240,
        2490, 2990, 3490, 3990, self::INF
    ];

    // https://en.wikipedia.org/wiki/International_Match_Points
    public function getImp(float $points): float
    {
        $sign = 1;
        if ($points < 0) {
            $sign = -1;
            $points = -$points;
        }

        for ($imp = 0;; $imp++) {
            if ($points < self::TRESHOLDS[$imp] + 5) {
                return $sign * $imp;
            }
        }
    }
}
