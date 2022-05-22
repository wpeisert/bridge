<?php

namespace App\Services\DealAnalyser\ProbabilityCalculator;

use App\BridgeCore\Constants;
use App\Services\DealAnalyser\DoubleDummy\DoubleDummyCalculator;
use App\Services\DealAnalyser\DoubleDummy\DoubleDummyResult;
use App\Services\Hands\Hands;
use App\Services\Hands\HandsService;

class ProbabilityCalculator
{
    public function __construct(
        private HandsService $handsService,
        private DoubleDummyCalculator $doubleDummyCalculator
    ) {}

    public function calculateHandsTricksProbabilities(Hands $hands, string $side, int $rounds): TricksProbabilities
    {
        $randomHands = $this->prepareRandomHands($hands, $side, $rounds);
        $ddResults = $this->doubleDummyCalculator->calculate($randomHands);
        $tricksProbabilities = $this->calculateTricksProbabilities($ddResults);

        return $tricksProbabilities;
    }

    public function prepareRandomHands(Hands $hands, string $side, int $rounds)
    {
        $opponents = array_values(array_diff(Constants::PLAYERS_NAMES, str_split($side)));
        $randomHands = [];
        for ($round = 0; $round < $rounds; ++$round) {
            $randomHands[] = $this->handsService->shuffleHands($hands, $opponents);
        }
        return $randomHands;
    }

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

        /** @var DoubleDummyResult $ddResult */
        foreach ($ddResults as $ddResult) {
            foreach (Constants::PLAYERS_NAMES as $playerName) {
                foreach (Constants::BIDS_COLORS as $bidColor) {
                    $maxTricks = $ddResult->getTricks($playerName, $bidColor);
                    $probs[$playerName][$bidColor][$maxTricks] = isset($probs[$playerName][$bidColor][$maxTricks])
                        ? $probs[$playerName][$bidColor][$maxTricks]++ : 1;
                }
            }
        }

        $count = count($ddResults);
        foreach (Constants::PLAYERS_NAMES as $playerName) {
            foreach (Constants::BIDS_COLORS as $bidColor) {
                for ($tricks = 0; $tricks <= Constants::PLAYERS_CARDS_COUNT; ++$tricks) {
                    if (isset($probs[$playerName][$bidColor][$tricks])) {
                        $probs[$playerName][$bidColor][$tricks] /= $count;
                    }
                }
            }
        }

        return new TricksProbabilities($probs);
    }
}
