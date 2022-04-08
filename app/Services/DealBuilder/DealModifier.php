<?php

namespace App\Services\DealBuilder;

use App\Services\DealConstraint\DealConstraintDecoratorFactoryInterface;
use App\Models\Deal;
use App\Models\DealConstraint;

class DealModifier implements DealModifierInterface
{
    public function __construct(private DealConstraintDecoratorFactoryInterface $dealConstraintsDecoratorFactory) {}

    public function applySettingsConstraints(Deal $deal, DealConstraint $dealConstraint): void
    {
        $dealConstraintDecorator = $this->dealConstraintsDecoratorFactory->decorate($dealConstraint);
        if ($dealConstraintDecorator->isDealerDefined()) {
            $deal->dealer = $dealConstraintDecorator->getDealer();
        }

        if ($dealConstraintDecorator->isNsVulnerableDefined()) {
            $deal->vulnerable_NS = $dealConstraintDecorator->isNsVulnerable();
        }

        if ($dealConstraintDecorator->isWeVulnerableDefined()) {
            $deal->vulnerable_WE = $dealConstraintDecorator->isWeVulnerable();
        }
    }
}
