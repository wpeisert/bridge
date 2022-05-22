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
        $this->analyseSide($deal, 'NS', $rounds);
        $this->analyseSide($deal, 'WE', $rounds);
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

        /*
         * ['side' => 'NS', 'contract' => Contract, 'ev' => 123.5]
         */
        $minimax = $this->minimax->filter($contractsFiltered2);

        $minimaxSide = is_string($minimax['contract']) ? $minimax['contract'] : $minimax['contract']->getHash() . ' ev: ' . $minimax['ev'];

        $deal->update(
            [
                'minimax_' . $side => $minimaxSide,
                'tricks_probabilities_' . $side => $tricksProbabilities->getSerialized(),
            ]
        );
    }
}
