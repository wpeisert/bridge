<?php

namespace App\Services\DealAnalyser;

use App\Models\Deal;
use App\Services\Hands\Cards;
use App\Services\Hands\HandsService;

class DealAnalyser implements DealAnalyserInterface
{
    private Deal $deal;

    public function __construct(private HandsService $handsService) {}

    public function setDeal(Deal $deal)
    {
        $this->deal = $deal;
    }

    public function analyse(int $rounds = 10): void
    {
        $deal = clone $this->deal;
        $tricks = [];
        for ($round = 0; $round < $rounds; ++$round) {
            $this->shuffle($deal, ['E', 'W']);
            $tricks[] = $this->calculateDoubleDummy($deal);
        }
        $tricksProbabilities = $this->calculateTricksProbabilities($tricks);
        $contractsAll = $this->getAllContracts();
        $contractsEvaluated = $this->evaluateContracts($contractsAll, $tricksProbabilities);
        $contractsFiltered = $this->removeDuplicatesFromContracts($contractsEvaluated);
        $contracts = $this->searchMinimax($contractsFiltered);

        $this->storeMinimax($contracts);
    }

    public function shuffle(Deal $deal, array $playersNames)
    {
        $cardsNumbers = [];
        foreach ($playersNames as $playerName) {
            $cards = new Cards($deal->getHand($playerName));
            $cardsNumbers = array_merge($cardsNumbers, $cards->getAsNumbers());
        }
        $hands = $this->handsService->shuffleCards($cardsNumbers, $playersNames);
        $deal->setHands($hands);
    }

    public function calculateDoubleDummy(Deal $deal): array
    {
        // TODO implement
        return [];
        /*
         * This calculates double dummy.
         *
         * Returns result:
         *  - for each declarer (N, E, S, W)
         *  - for each color (c, d, h, s, nt)
         * so its 4x5 array of int
         */
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
