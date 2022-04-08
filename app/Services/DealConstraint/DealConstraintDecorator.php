<?php

namespace App\Services\DealConstraint;

use App\BridgeCore\Constants;
use App\Services\DealConstraint\DealConstraintDecoratorInterface;
use App\Models\DealConstraint;

class DealConstraintDecorator implements DealConstraintDecoratorInterface
{
    public function __construct(private DealConstraint $dealConstraint) {}

    public function isDealerDefined(): bool
    {
        return in_array(Constants::DEAL_CONSTRAINTS_DEALER[$this->dealConstraint->dealer],Constants::PLAYERS_NAMES);
    }

    public function getDealer(): int
    {
        return $this->dealConstraint->dealer;
    }

    public function isNsVulnerableDefined(): bool
    {
        return $this->dealConstraint->vulnerable_NS > 0;
    }

    public function isNsVulnerable(): bool
    {
        return $this->dealConstraint->vulnerable_NS == 1;
    }

    public function isWeVulnerableDefined(): bool
    {
        return $this->dealConstraint->vulnerable_WE > 0;
    }

    public function isWeVulnerable(): bool
    {
        return $this->dealConstraint->vulnerable_WE == 1;
    }
}
