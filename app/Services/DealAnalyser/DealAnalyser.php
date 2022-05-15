<?php

namespace App\Services\DealAnalyser;

use App\Models\Deal;
use App\Services\Contract\ContractService;
use App\Services\DealAnalyser\DoubleDummy\DoubleDummyCalculator;
use App\Services\Hands\CardsService;
use App\Services\Hands\HandsService;
use App\Services\ProbabilityCalculator\ProbabilityCalculator;

class DealAnalyser implements DealAnalyserInterface
{
    public function __construct(
        private HandsService $handsService,
        private DoubleDummyCalculator $doubleDummyCalculator,
        private ContractService $contractService,
        private CardsService $cardsService,
        private ProbabilityCalculator $probabilityCalculator
    ) {}

    public function analyse(Deal $deal, int $rounds = self::ROUNDS): void
    {
        $dealHands = $deal->getHands();
        $hands = [];
        for ($round = 0; $round < $rounds; ++$round) {
            $hands[] = $this->handsService->shuffleHands($dealHands, ['E', 'W']);
        }

        $ddResults = $this->doubleDummyCalculator->calculate($hands);

        $tricksProbabilities = $this->probabilityCalculator->calculateTricksProbabilities($ddResults);

        $contractsEvaluated = [];
        foreach ($this->getAllContracts() as $contract) {
            $ev = $this->contractService->calculateContractExpectedValue(
                $contract,
                $tricksProbabilities->getProbabilities($contract->declarer, $contract->bidColor)
            );

            $contractsEvaluated[] = [
                'contract' => $contract,
                'ev' => $ev,
            ];
        }

        $contractsFiltered = $this->removeDuplicatesFromContracts($contractsEvaluated);
        $contracts = $this->searchMinimax($contractsFiltered);

        $this->storeMinimax($contracts);
    }

    public function getAllContracts(): array
    {
        return [];
        /*
         * Returns all possible contracts for all hands
         * Number is: 4(N,E,S,W)x5(c,d,h,s,nt)x7x3(pass/dbl/rdbl) = 420
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
