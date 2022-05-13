<?php

namespace App\Services\DealAnalyser;

use App\BridgeCore\Constants;
use App\Models\Deal;
use App\Services\DealAnalyser\DoubleDummy\DoubleDummyCalculator;
use App\Services\DealAnalyser\DoubleDummy\DoubleDummyResult;
use App\Services\Hands\Cards;
use App\Services\Hands\Hands;
use App\Services\Hands\HandsService;

class DealAnalyser implements DealAnalyserInterface
{
    private const MAX_DEALS_DD = 40;
    private const ROUNDS = 10;

    private Deal $deal;

    public function __construct(
        private HandsService $handsService,
        private DoubleDummyCalculator $doubleDummyCalculator
    ) {}

    public function setDeal(Deal $deal)
    {
        $this->deal = $deal;
    }

    public function analyse(int $rounds = self::ROUNDS): void
    {
        $dealHands = $this->deal->getHands();
        $hands = [];
        for ($round = 0; $round < $rounds; ++$round) {
            $hands[] = $this->shuffle($dealHands, ['E', 'W']);
        }

        $ddResults = $this->doubleDummyCalculator->calculate($hands);

        $tricksProbabilities = $this->calculateTricksProbabilities($ddResults);
        $contractsAll = $this->getAllContracts();
        $contractsEvaluated = $this->evaluateContracts($contractsAll, $tricksProbabilities);
        $contractsFiltered = $this->removeDuplicatesFromContracts($contractsEvaluated);
        $contracts = $this->searchMinimax($contractsFiltered);

        $this->storeMinimax($contracts);
    }

    public function shuffle(Hands $hands, array $playersNames): Hands
    {
        $cardsNumbers = [];
        foreach ($playersNames as $playerName) {
            $cards = new Cards($hands->getHand($playerName));
            $cardsNumbers = array_merge($cardsNumbers, $cards->getAsNumbers());
        }
        $newHands = $this->handsService->shuffleCards($cardsNumbers, $playersNames);
        foreach (Constants::PLAYERS_NAMES as $playerName) {
            if (in_array($playerName, $playersNames)) {
                continue;
            }
            $newHands->setHand($playerName, $hands->getHand($playerName));
        }

        return $newHands;
    }

    public function calculateTricksProbabilities(array $tricks): array
    {
        // TODO implement
        return [];
        /*
         * Calculates probabilities of taking given number of tricks:
         *  - for each declarer (N, E, S, W)
         *  - for each color (c, d, h, s, nt)
         *  - for each number of tricks (0..13)
         * so it's 4x5x14 array of float
         * Note: zero entries may be not present
         */
    }

    public function getAllContracts(): array
    {
        // TODO implement
        return [];
        /*
         * Returns all possible contracts for all hands
         * Number is: 1(pass) + 4(N,E,S,W)x5(c,d,h,s,nt)x7x3(pass/dbl/rdbl) = 421
         */
    }

    public function evaluateContracts(array $contracts, array $tricksProbabilities): array
    {
        // TODO implement
        return [];
        /*
         * Evaluates contracts (always points from the point of view of NS):
         *  - for each contract
         *  so returns array of size 421 of float
         */
    }

    public function removeDuplicatesFromContracts(array $contracts): array
    {
        // TODO implement
        return [];
        /*
         * If for given contract the result is same for N and S (resp. E and W), remove this duplication (S resp. W)
         */
    }

    public function searchMinimax(array $contracts): array
    {
        // TODO implement
        return [];
        /*
         * Performs minimax algo.
         * Returns short list of best contracts.
         */
    }

    public function storeMinimax(array $contracts)
    {

    }
}
