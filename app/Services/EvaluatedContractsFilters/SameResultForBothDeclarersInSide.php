<?php

namespace App\Services\EvaluatedContractsFilters;

use App\BridgeCore\Constants;
use App\BridgeCore\Tools;
use App\Services\Contract\Contract;

class SameResultForBothDeclarersInSide
{
    public function filter(array $contractsEvaluated): array
    {
        $contractsFiltered = [];

        foreach ($contractsEvaluated as $hash1 => $contractEvaluated) {
            /** @var Contract $contract1 */
            /** @var Contract $contract2 */
            $contract1 = clone $contractEvaluated['contract'];
            $ev1 = $contractEvaluated['ev'];

            $contract2 = clone $contractEvaluated['contract'];
            $contract2->declarer = Tools::getPartner($contract2->declarer);
            $hash2 = $contract2->getHash();

            if (!isset($contractsEvaluated[$hash2])) {
                $contractsFiltered[$hash1] = [
                    'contract' => $contract1,
                    'ev' => $ev1,
                ];

                continue;
            }

            $ev2 = $contractsEvaluated[$hash2]['ev'];

            if (abs($ev1 - $ev2) < 0.001) {
                $contract1->declarer = Tools::getFirstPlayerInSide($contract1->declarer);
                $hash1 = $contract1->getHash();
                $contractsFiltered[$hash1] = [
                    'contract' => $contract1,
                    'ev' => $ev1,
                ];

                continue;
            }

            $contractsFiltered[$hash1] = [
                'contract' => $contract1,
                'ev' => $ev1,
            ];
            $contractsFiltered[$hash2] = [
                'contract' => $contract2,
                'ev' => $ev2,
            ];
        }

        return $contractsFiltered;
    }
}
