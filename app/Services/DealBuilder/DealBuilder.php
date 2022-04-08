<?php

namespace App\Services\DealBuilder;

use App\Exceptions\DealBuilderLimitReachedException;
use App\Models\Deal;
use App\Models\DealConstraint;

class DealBuilder implements DealBuilderInterface
{
    public function __construct(
        private DealCreatorInterface $dealCreator,
        private DealConstraintVerifierInterface $DealConstraintVerifier
    ) {}

    /**
     * @param DealConstraint|null $dealConstraint
     * @return Deal
     * @throws DealBuilderLimitReachedException
     */
    public function build(?DealConstraint $dealConstraint = null): Deal
    {
        $limit = intval(config('bridge.deal_builder_trials_limit'));
        if ($limit <= 0) {
            throw new DealBuilderLimitReachedException(-1);
        }

        for ($trial = 0; $trial < $limit; ++$trial) {
            $deal = $this->dealCreator->create($dealConstraint);
            if (!$dealConstraint) {
                return $deal;
            }
            if ($this->DealConstraintVerifier->verify($deal, $dealConstraint)) {
                return $deal;
            }
        }

        throw new DealBuilderLimitReachedException($dealConstraint->id);
    }
}
