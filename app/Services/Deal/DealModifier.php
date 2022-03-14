<?php

namespace App\Services\Deal;

use App\Interfaces\Deal\DealConstraintsProviderInterface;
use App\Interfaces\Deal\DealModifierInterface;
use App\Models\Deal;
use App\Models\DealConstraint;

class DealModifier implements DealModifierInterface
{
    public function __construct(private DealConstraintsProviderInterface $dealConstraintsProvider) {}

    public function applyBasicDealConstraints(Deal $deal, DealConstraint $dealConstraint): void
    {
        if ($this->dealConstraintsProvider->isDealerDefined($dealConstraint)) {
            $deal->dealer = $this->dealConstraintsProvider->getDealer($dealConstraint);
        }

        if ($this->dealConstraintsProvider->isVulnerableDefined($dealConstraint)) {
            $deal->vulnerable_02 = $this->dealConstraintsProvider->isNsVulnerable($dealConstraint);
            $deal->vulnerable_13 = $this->dealConstraintsProvider->isWeVulnerable($dealConstraint);
        }
    }
}
