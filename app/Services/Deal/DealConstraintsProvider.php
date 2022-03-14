<?php

namespace App\Services\Deal;

use App\Bridge\Constants;
use App\Interfaces\Deal\DealConstraintsProviderInterface;
use App\Models\DealConstraint;

class DealConstraintsProvider implements DealConstraintsProviderInterface
{
    public function isDealerDefined(DealConstraint $dealConstraint): bool
    {
        return in_array(Constants::DEAL_CONSTRAINTS_DEALER[$dealConstraint->dealer],Constants::PLAYERS_NAMES);
    }

    public function getDealer(DealConstraint $dealConstraint): int
    {
        return $dealConstraint->dealer;
    }

    public function isVulnerableNsDefined(DealConstraint $dealConstraint): bool
    {
        return $dealConstraint->vulnerable_NS > 0;
    }

    public function isNsVulnerable(DealConstraint $dealConstraint): bool
    {
        return $dealConstraint->vulnerable_NS == 1;
    }

    public function isVulnerableWeDefined(DealConstraint $dealConstraint): bool
    {
        return $dealConstraint->vulnerable_WE > 0;
    }

    public function isWeVulnerable(DealConstraint $dealConstraint): bool
    {
        return $dealConstraint->vulnerable_WE == 1;
    }
}
