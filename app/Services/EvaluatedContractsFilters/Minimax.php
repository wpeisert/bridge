<?php

namespace App\Services\EvaluatedContractsFilters;

use App\BridgeCore\Constants;
use App\Services\Contract\Contract;
use App\Services\Contract\ContractService;

class Minimax
{
    public function __construct(private ContractService $contractService) {}

    public function filter(array $contractsEvaluated): array
    {
        $bidding = [];
        $lastValue = 0;
        while (true) {
            foreach (Constants::SIDES as $side) {
                $coeff = str_contains($side, 'N') ? 1 : -1;
                $maxContractEvaluated = $this->getMaxContractEvaluated($side, $contractsEvaluated);
                if ($coeff * $maxContractEvaluated['ev'] > $coeff * $lastValue) {
                    $lastValue = $maxContractEvaluated['ev'];
                    $newContract = [
                        'side' => $side,
                        'contract' => clone $maxContractEvaluated['contract'],
                        'ev' => $maxContractEvaluated['ev']
                    ];
                } else {
                    $newContract = [
                        'side' => $side,
                        'contract' => 'pass',
                        'ev' => 0
                    ];
                }

                if (is_string($newContract['contract']) && $newContract['contract'] === 'pass' && count($bidding) > 0) {
                    $contractEvaluated = array_pop($bidding);
                    return $contractEvaluated;
                }

                $bidding[] = $newContract;

                $contractsEvaluated = $this->removeLowerContracts($contractsEvaluated, $maxContractEvaluated['contract']);
            }
        }
    }

    private function getMaxContractEvaluated(string $side, array $contractsEvaluated)
    {
        $players = str_split($side);
        $coeff = in_array('N', $players) ? 1 : -1;
        $index = null;
        $max = $coeff * (-999999.0);
        foreach ($contractsEvaluated as $inx => $contractEvaluated) {
            if (!in_array($contractEvaluated['contract']->declarer, $players)) {
                continue;
            }
            if ($coeff * $contractEvaluated['ev'] > $coeff * $max) {
                $max = $contractEvaluated['ev'];
                $index = $inx;
            }
        }

        return $contractsEvaluated[$index];
    }

    private function removeLowerContracts(array $contractsEvaluated, Contract $contract)
    {
        $filteredContracts = [];
        foreach ($contractsEvaluated as $hash => $contractEvaluated) {
            if ($this->contractService->isLower($contractEvaluated['contract'], $contract)) {
                continue;
            }
            $filteredContracts[$hash] = [
                'contract' => clone $contractEvaluated['contract'],
                'ev' => $contractEvaluated['ev'],
            ];
        }

        return $filteredContracts;
    }
}
