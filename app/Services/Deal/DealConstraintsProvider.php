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

    public function isVulnerableDefined(DealConstraint $dealConstraint): bool
    {
        return in_array(Constants::DEAL_CONSTRAINTS_VULNERABLE[$dealConstraint->vulnerable], ['NS', 'WE', 'both', 'none']);
    }

    public function isNsVulnerable(DealConstraint $dealConstraint): bool
    {
        return in_array(Constants::DEAL_CONSTRAINTS_VULNERABLE[$dealConstraint->vulnerable], ['NS', 'both']);
    }

    public function isWeVulnerable(DealConstraint $dealConstraint): bool
    {
        return in_array(Constants::DEAL_CONSTRAINTS_VULNERABLE[$dealConstraint->vulnerable], ['WE', 'both']);
    }
}
