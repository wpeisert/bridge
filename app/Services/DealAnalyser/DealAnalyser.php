<?php

namespace App\Services\DealAnalyser;

use App\Models\Deal;
use App\Services\Contract\Contract;
use App\Services\Contract\ContractService;
use App\Services\DealAnalyser\ProbabilityCalculator\ProbabilityCalculator;
use App\Services\EvaluatedContractsFilters\DblRdbl;
use App\Services\EvaluatedContractsFilters\Minimax;
use App\Services\EvaluatedContractsFilters\SameResultForBothDeclarersInSide;

class DealAnalyser implements DealAnalyserInterface
{
    public function __construct(
        private ProbabilityCalculator $probabilityCalculator,
        private ContractService $contractService,
        private SameResultForBothDeclarersInSide $sameResultForBothDeclarersInSide,
        private DblRdbl $dblRdbl,
        private Minimax $minimax
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
            $this->contractService->getAllContracts(
                [
                    'vulnerable_NS' => $deal->vulnerable_NS,
                    'vulnerable_WE' => $deal->vulnerable_WE,
                ]
            ),
            $tricksProbabilities
        );

        $contractsFiltered0 = [];
        /** @var Contract $contractEv */
        foreach ($contractsEvaluated as $contractEv) {
            $contractsFiltered0[$contractEv['contract']->getHash()] = $contractEv;
        }

        $contractsFiltered1 = $this->sameResultForBothDeclarersInSide->filter($contractsFiltered0);

        $contractsFiltered2 = $this->dblRdbl->filter($contractsFiltered1);

        $contractsFiltered3 = $this->minimax->filter($contractsFiltered2);

        $this->uuuu();

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
