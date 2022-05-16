<?php

namespace App\Services\DealAnalyser\ProbabilityCalculator;

use App\BridgeCore\Constants;
use App\Services\DealAnalyser\DoubleDummy\DoubleDummyResult;

class ProbabilityCalculator
{
    /**
     * @param DoubleDummyResult[] $ddResults
     * @return TricksProbabilities
     */
    public function calculateTricksProbabilities(array $ddResults): TricksProbabilities
    {
        /*
         * Calculates probabilities of taking given number of tricks:
         *  - for each declarer (N, E, S, W)
         *  - for each color (c, d, h, s, nt)
         *  - for each number of tricks (0..13)
         * so it's 4x5x14 array of float
         * Note: zero entries may be not present
         */
        $probs = [];

        foreach (Constants::PLAYERS_NAMES as $playerName) {
            foreach (Constants::BIDS_COLORS as $bidColor) {
                for ($tricks = 0; $tricks <= Constants::PLAYERS_CARDS_COUNT; ++$tricks) {
                    $probs[$playerName][$bidColor][$tricks] = 0;
                }
            }
        }

        /** @var DoubleDummyResult $ddResult */
        foreach ($ddResults as $ddResult) {
            foreach (Constants::PLAYERS_NAMES as $playerName) {
                foreach (Constants::BIDS_COLORS as $bidColor) {
                    $maxTricks = $ddResult->getTricks($playerName, $bidColor);
                    $probs[$playerName][$bidColor][$maxTricks]++;
                }
            }
        }

        foreach (Constants::PLAYERS_NAMES as $playerName) {
            foreach (Constants::BIDS_COLORS as $bidColor) {
                for ($tricks = 0; $tricks <= Constants::PLAYERS_CARDS_COUNT; ++$tricks) {
                    $probs[$playerName][$bidColor][$tricks] /= count($ddResults);
                }
            }
        }

        return new TricksProbabilities($probs);
    }
}
