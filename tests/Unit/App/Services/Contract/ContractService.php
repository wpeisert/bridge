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
     * @param string $side
     * @param bool $vulnerable
     * @param TricksProbabilities $tricksProbabilities
     * @return array
     */
    public function evaluateContracts(array $contracts, string $side, bool $vulnerable, TricksProbabilities $tricksProbabilities): array
    {
        $contractsEvaluated = [];

        foreach ($contracts as $contract) {
            $contract->vulnerable = $vulnerable;
            $evalRes = $this->evaluateContract(
                $contract,
                $side,
                $tricksProbabilities
            );

            $contractsEvaluated = array_merge($contractsEvaluated, $evalRes);
        }

        return $contractsEvaluated;
    }

    /**
     * @param Contract $contract
     * @param string $side
     * @param TricksProbabilities $tricksProbabilities
     * @return array
     */
    public function evaluateContract(Contract $contract, string $side, TricksProbabilities $tricksProbabilities): array
    {
        $ev = [];
        $contractsTmp = [];
        foreach (str_split($side) as $declarer) {
            $contract->declarer = $declarer;
            $contractsTmp[] = clone $contract;
            $ev[] = $this->contractValueService->calculateContractExpectedValue(
                $contract,
                $tricksProbabilities->getProbabilities($contract->declarer, $contract->bidColor)
            );
        }

        $contractsEvaluated[] = [
            'contract' => $contractsTmp[0],
            'ev' => $ev[0],
        ];
        if ($ev[0] !== $ev[1]) {
            $contractsEvaluated[] = [
                'contract' => $contractsTmp[1],
                'ev' => $ev[1],
            ];
        }

        return $contractsEvaluated;
    }


    public function getAllContractsNoDeclarer(): array
    {
        /*
         * Returns all possible contracts
         * Number is: 5(c,d,h,s,nt)x7x3(pass/dbl/rdbl) = 105
         */
        $contracts = [];

        foreach (Constants::CONTRACT_TYPES as $type) {
            for ($level = 1; $level <= Constants::BIDS_MAX_LEVEL; ++$level) {
                foreach (Constants::BIDS_COLORS as $bidColor) {
                    $contracts[] = Contract::create(
                        [
                            'type' => $type,
                            'level' => $level,
                            'bidColor' => $bidColor
                        ]
                    );
                }
            }
        }

        return $contracts;
    }
}
