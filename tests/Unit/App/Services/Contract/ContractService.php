<?php

namespace Tests\Unit\App\Services\Contract;

use App\BridgeCore\Constants;
use App\Services\Contract\Contract;
use App\Services\Contract\ContractValueService;
use App\Services\DealAnalyser\ProbabilityCalculator\TricksProbabilities;

class ContractService
{
    public function __construct(private ContractValueService $contractValueService) {}

    /**
     * @param Contract[] $contracts
     * @param bool $vulnerableNS
     * @param bool $vulnerableWE
     * @param TricksProbabilities $tricksProbabilities
     * @return array
     */
    public function evaluateContracts(array $contracts, bool $vulnerableNS, bool $vulnerableWE, TricksProbabilities $tricksProbabilities): array
    {
        $contractsEvaluated = [];

        foreach ($contracts as $contract) {
            $contract->vulnerable = in_array($contract->declarer, ['N', 'S']) ? $vulnerableNS : $vulnerableWE;
            $ev = $this->contractValueService->calculateContractExpectedValue(
                $contract,
                $tricksProbabilities->getProbabilities($contract->declarer, $contract->bidColor)
            );

            $contractsEvaluated[$contract->getHash()] = [
                'contract' => clone $contract,
                'ev' => $ev
            ];
        }

        return $contractsEvaluated;
    }

    public function getAllContracts(): array
    {
        /*
         * Returns all possible contracts
         * Number is: 2(NS,WE)x5(c,d,h,s,nt)x7x3(pass/dbl/rdbl)x2(players in pair) = 420
         */
        $contracts = [];

        foreach (['NS', 'WE'] as $side) {
            for ($level = 1; $level <= Constants::BIDS_MAX_LEVEL; ++$level) {
                foreach (Constants::BIDS_COLORS as $bidColor) {
                    foreach (Constants::CONTRACT_TYPES as $type) {
                        foreach (str_split($side) as $declarer) {
                            $contracts[] = Contract::create(
                                [
                                    'declarer' => $declarer,
                                    'type' => $type,
                                    'level' => $level,
                                    'bidColor' => $bidColor
                                ]
                            );
                        }
                    }
                }
            }
        }

        return $contracts;
    }
}
