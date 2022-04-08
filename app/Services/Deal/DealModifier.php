<?php

namespace App\Services\Deal;

use App\Interfaces\DealConstraints\DealConstraintsDecoratorInterface;
use App\Interfaces\Deal\DealModifierInterface;
use App\Models\Deal;
use App\Models\DealConstraint;

class DealModifier implements DealModifierInterface
{
    public function __construct(private DealConstraintsDecoratorInterface $DealConstraintsDecorator) {}

    public function applySettingsConstraints(Deal $deal, DealConstraint $dealConstraint): void
    {
        if ($this->DealConstraintsDecorator->isDealerDefined($dealConstraint)) {
            $deal->dealer = $this->DealConstraintsDecorator->getDealer($dealConstraint);
        }

        if ($this->DealConstraintsDecorator->isNsVulnerableDefined($dealConstraint)) {
            $deal->vulnerable_NS = $this->DealConstraintsDecorator->isNsVulnerable($dealConstraint);
        }

        if ($this->DealConstraintsDecorator->isWeVulnerableDefined($dealConstraint)) {
            $deal->vulnerable_WE = $this->DealConstraintsDecorator->isWeVulnerable($dealConstraint);
        }
    }
}
