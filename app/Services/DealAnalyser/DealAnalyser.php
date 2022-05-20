<?php

namespace App\Services\DealAnalyser;

use App\Models\Deal;
use App\Services\Contract\Contract;
use App\Services\DealAnalyser\ProbabilityCalculator\ProbabilityCalculator;
use Tests\Unit\App\Services\Contract\ContractService;

class DealAnalyser implements DealAnalyserInterface
{
    public function __construct(
        private ProbabilityCalculator $probabilityCalculator,
        private ContractService $contractService
    ) {}

    public function analyse(Deal $deal, int $rounds = self::ROUNDS)
    {
        $contractsNS = $this->analyseSide($deal, 'NS', $rounds);
        $contractsWE = $this->analyseSide($deal, 'EW', $rounds);
        $contractPASS = [
            'contract' => Contract::create(['bidColor' => 'pass']),
            'ev' => 0,
        ];

        $this->storeMinimax($contracts);
    }

    public function analyseSide(Deal $deal, string $side, int $rounds = self::ROUNDS)
    {
        $tricksProbabilities = $this->probabilityCalculator->calculateHandsTricksProbabilities($deal->getHands(), $side, $rounds);

        $contractsEvaluated = $this->contractService->evaluateContracts(
            $this->contractService->getAllContracts(),
            $deal->vulnerable_NS,
            $deal->vulnerable_WE,
            $tricksProbabilities
        );

        // xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

        usort(
            $contractsEvaluated,
            function ($a, $b) {
                return ($a['ev'] < $b['ev']) ? -1 : 1;
            }
        );

        return $contractsEvaluated;
    }
}
