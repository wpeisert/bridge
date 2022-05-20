<?php

namespace App\Services\EvaluatedContractsFilters;

use App\BridgeCore\Constants;
use App\Services\Contract\Contract;

class DblRdbl
{
    public function filter(array $contractsEvaluated): array
    {
        $contractsFiltered = [];

        foreach ($contractsEvaluated as $contractEvaluated) {
            /** @var Contract $contract */
            $contract = $contractEvaluated['contract'];

            $coeff = in_array($contract->declarer, str_split('NS')) ? 1 : -1;
            $contracts = [];
            $evs = [];
            $data = [];
            foreach (Constants::CONTRACT_TYPES as $type) {
                $contractTmp = clone $contract;
                $contractTmp->type = $type;
                $hash = $contractTmp->getHash();
                $exists = isset($contractsEvaluated[$hash]);
                $contracts[] = $contractTmp;
                $data[] = $exists ? $coeff * $contractsEvaluated[$hash]['ev'] : null;
                $evs[] = $exists ? $contractsEvaluated[$hash]['ev'] : null;
            }

            $indices = $this->getRemainingIndices(...$data);

            foreach ($indices as $index) {
                $contractsFiltered[$contracts[$index]->getHash()] = [
                    'contract' => $contracts[$index],
                    'ev' => $evs[$index],
                ];
            }
        }

        return $contractsFiltered;
    }

    /**
     * @param float|null $val0
     * @param float|null $val1
     * @param float|null $val2
     * @return int[]
     */
    public function getRemainingIndices(?float $val0, ?float $val1, ?float $val2): array
    {
        if (
            // if no more than 1, returns same
            ((is_null($val0) ? 0 : 1) + (is_null($val1) ? 0 : 1) + (is_null($val2) ? 0 : 1) <= 1) ||
            // only first and last ('' and 'rdbl')
            (!is_null($val0) && is_null($val1) && !is_null($val2))
        ) {
            $res = [];
            foreach ([$val0, $val1, $val2] as $index => $val) {
                if (!is_null($val)) {
                    $res[] = $index;
                }
            }
            return $res;
        }

        // $val1 is not null !!

        if (is_null($val2)) {
            return  ($val0 > $val1) ? [1] : [0];
        }
        if (is_null($val0)) {
            return  ($val2 > $val1) ? [2] : [1];
        }

        // all not null
        if ($val0 < $val1 || $val2 > $val0) {
            return [0];
        } else {
            return $val2 > $val1 ? [2] : [1];
        }
    }
}
