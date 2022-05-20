<?php

namespace App\Services\Contract;

use App\BridgeCore\Constants;
use App\Services\DealAnalyser\ProbabilityCalculator\TricksProbabilities;

class ContractService
{
    public function __construct(private ContractValueService $contractValueService) {}

    /**
     * @param Contract[] $contracts
     * @param TricksProbabilities $tricksProbabilities
     * @return array
     */
    public function evaluateContracts(array $contracts, TricksProbabilities $tricksProbabilities): array
    {
        $contractsEvaluated = [];

        foreach ($contracts as $contract) {
            $ev = $this->contractValueService->calculateContractExpectedValue(
                $contract,
                $tricksProbabilities->getProbabilities($contract->declarer, $contract->bidColor)
            );

            $contractsEvaluated[] = [
                'contract' => $contract,
                'ev' => $ev
            ];
        }

        return $contractsEvaluated;
    }

    /**
     * @param array $params
     * @return Contract[]
     */
    public function getAllContracts(array $params = []): array
    {
        $sides = $params['sides'] ?? Constants::SIDES;
        $levels = $params['levels'] ?? range(1, Constants::BIDS_MAX_LEVEL);
        $bidColors = $params['bidColors'] ?? Constants::BIDS_COLORS;
        $contractTypes = $params['contractTypes'] ?? Constants::CONTRACT_TYPES;
        $declarers = $params['declarers'] ?? Constants::PLAYERS_NAMES;
        $vulnerable_NS = $params['vulnerable_NS'] ?? false;
        $vulnerable_WE = $params['vulnerable_WE'] ?? false;

        $contracts = [];

        foreach ($sides as $side) {
            foreach ($levels as $level) {
                foreach ($bidColors as $bidColor) {
                    foreach ($contractTypes as $type) {
                        foreach (str_split($side) as $declarer) {
                            if (!in_array($declarer, $declarers)) {
                                continue;
                            }
                            $vulnerable = in_array($declarer, str_split('NS')) ? $vulnerable_NS : $vulnerable_WE;
                            $contracts[] = Contract::create(
                                [
                                    'declarer' => $declarer,
                                    'type' => $type,
                                    'level' => $level,
                                    'bidColor' => $bidColor,
                                    'vulnerable' => $vulnerable,
                                ]
                            );
                        }
                    }
                }
            }
        }

        return $contracts;
    }

    /**
     * @param Contract $contract1
     * @param Contract $contract2
     * @return bool
     */
    public function isLower(Contract $contract1, Contract $contract2): bool
    {
        return $contract1->level < $contract2->level ||
            $contract1->level === $contract2->level &&
                array_search($contract1->bidColor, Constants::BIDS_COLORS)
                < array_search($contract2->bidColor, Constants::BIDS_COLORS);
    }
}
