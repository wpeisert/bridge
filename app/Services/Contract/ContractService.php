<?php

namespace App\Services\Contract;

use App\BridgeCore\Constants;

class ContractService
{
    /**
     * https://www.pzbs.pl/sedziowie/mpb/2007/pol/przep77.htm
     *
     * @param Contract $contract
     * @param int $tricks
     * @return int
     */
    public function getValue(Contract $contract, int $tricks): int
    {
        $requiredTricks = Constants::BASE_TRICKS + $contract->level;
        if ($tricks < $requiredTricks) {
            $value = -$this->getPenaltyValue($requiredTricks - $tricks, $contract->type, $contract->vulnerable);
        } else {
            $value = $this->getSuccessValue($contract->bidColor, $contract->level, $tricks, $contract->type, $contract->vulnerable);
        }

        if (in_array($contract->declarer, ['W', 'E'])) {
            $value = -$value;
        }

        return $value;
    }

    private function getPenaltyValue(int $tricksBelow, string $type, bool $vulnerable): int
    {
        $value = Constants::PENALTY_FIRST_UNDERTRICK[$vulnerable][$type]
            + ($tricksBelow - 1) * Constants::PENALTY_SECOND_UNDERTRICK[$vulnerable][$type];
        if ($tricksBelow >= Constants::PENALTY_FOURTH_FROM) {
            $value += ($tricksBelow - Constants::PENALTY_FOURTH_FROM + 1) * Constants::PENALTY_FOURTH_UNDERTRICK[$vulnerable][$type];
        }

        return $value;
    }

    private function getSuccessValue(string $bidColor, int $level, int $tricks, string $type, bool $vulnerable): int
    {
        $declaredValue = Constants::REWARD_FIRST_TRICK[$bidColor]
            + ($level - 1) * Constants::REWARD_NEXT_TRICK[$bidColor];
        if ($type === 'dbl') {
            $declaredValue *= 2;
        } elseif ($type === 'rdbl') {
            $declaredValue *= 4;
        }

        $value = $declaredValue;

        $isGame = $declaredValue >= Constants::GAME_REQUIRED_POINTS;
        if ($isGame) {
            $value += Constants::REWARD_GAME[$vulnerable];
        } else {
            $value += Constants::REWARD_NONGAME;
        }

        $value += Constants::REWARD_DBL[$type];
        $value += Constants::REWARD_SLAM[$vulnerable][$level] ?? 0;

        $overtricks = $tricks - Constants::BASE_TRICKS - $level;

        if (!$type) {
            $value += $overtricks * Constants::REWARD_NEXT_TRICK[$bidColor];
        } else {
            $value += $overtricks * Constants::REWARD_OVERTRICKS_DBL[$vulnerable][$type];
        }

        return $value;
    }
}
