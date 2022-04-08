<?php

namespace App\Services\DealConstraints;

use App\BridgeCore\Constants;
use App\Interfaces\DealConstraints\DealConstraintsDecoratorInterface;
use App\Models\DealConstraint;

class DealConstraintsDecorator implements DealConstraintsDecoratorInterface
{
    public function isDealerDefined(DealConstraint $dealConstraint): bool
    {
        return in_array(Constants::DEAL_CONSTRAINTS_DEALER[$dealConstraint->dealer],Constants::PLAYERS_NAMES);
    }

    public function getDealer(DealConstraint $dealConstraint): int
    {
        return $dealConstraint->dealer;
    }

    public function isNsVulnerableDefined(DealConstraint $dealConstraint): bool
    {
        return $dealConstraint->vulnerable_NS > 0;
    }

    public function isNsVulnerable(DealConstraint $dealConstraint): bool
    {
        return $dealConstraint->vulnerable_NS == 1;
    }

    public function isWeVulnerableDefined(DealConstraint $dealConstraint): bool
    {
        return $dealConstraint->vulnerable_WE > 0;
    }

    public function isWeVulnerable(DealConstraint $dealConstraint): bool
    {
        return $dealConstraint->vulnerable_WE == 1;
    }
}
