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

        if ($this->dealConstraintsProvider->isVulnerableNsDefined($dealConstraint)) {
            $deal->vulnerable_NS = $this->dealConstraintsProvider->isNsVulnerable($dealConstraint);
        }

        if ($this->dealConstraintsProvider->isVulnerableWeDefined($dealConstraint)) {
            $deal->vulnerable_WE = $this->dealConstraintsProvider->isWeVulnerable($dealConstraint);
        }
    }
}
