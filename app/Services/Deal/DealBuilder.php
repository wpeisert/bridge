<?php

namespace App\Services\Deal;

use App\Exceptions\DealBuilderLimitReachedException;
use App\Interfaces\Deal\DealBuilderInterface;
use App\Interfaces\Deal\DealConstraintsVerifierInterface;
use App\Interfaces\Deal\DealCreatorInterface;
use App\Models\Deal;
use App\Models\DealConstraint;

class DealBuilder implements DealBuilderInterface
{
    public function __construct(
        private DealCreatorInterface $dealCreator,
        private DealConstraintsVerifierInterface $dealConstraintsVerifier
    ) {}

    /**
     * @param DealConstraint|null $dealConstraint
     * @return Deal
     * @throws DealBuilderLimitReachedException
     */
    public function build(?DealConstraint $dealConstraint): Deal
    {
        $limit = intval(config('bridge.deal_builder_trials_limit'));
        if ($limit <= 0) {
            throw new DealBuilderLimitReachedException(-1);
        }

        for ($trial = 0; $trial < $limit; ++$trial) {
            $deal = $this->dealCreator->create();
            if (!$dealConstraint) {
                return $deal;
            }
            if ($this->dealConstraintsVerifier->verify($deal, $dealConstraint)) {
                return $deal;
            }
        }

        throw new DealBuilderLimitReachedException($dealConstraint->id);
    }
}
