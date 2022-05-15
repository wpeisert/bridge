<?php

namespace App\Services\DealAnalyser;

use App\Models\Deal;
use App\Services\DealAnalyser\DoubleDummy\DoubleDummyCalculator;
use App\Services\Hands\HandsService;
use App\Services\ProbabilityCalculator\ProbabilityCalculator;
use Tests\Unit\App\Services\Contract\ContractService;

class DealAnalyser implements DealAnalyserInterface
{
    public function __construct(
        private HandsService $handsService,
        private DoubleDummyCalculator $doubleDummyCalculator,
        private ProbabilityCalculator $probabilityCalculator,
        private ContractService $contractService
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

        $contractsEvaluated = $this->contractService->evaluateContracts(
            $this->contractService->getAllContractsNoDeclarer(),
            $tricksProbabilities
        );

        $contracts = $this->searchMinimax($contractsEvaluated);

        $this->storeMinimax($contracts);
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
