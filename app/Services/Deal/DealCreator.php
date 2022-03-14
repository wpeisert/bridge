<?php

namespace App\Services\Deal;

use App\Interfaces\Deal\DealCreatorInterface;
use App\Interfaces\Deal\DealModifierInterface;
use App\Models\Deal;
use App\Models\DealConstraint;

class DealCreator implements DealCreatorInterface
{
    public function __construct(private DealModifierInterface $dealUpdater) {}
    /**
     * Creates random deal, but uses deal constraints object to set up definable fields:
     *   - dealer
     *   - vulnerability
     *
     * @param DealConstraint|null $dealConstraint
     * @return Deal
     * @throws \Exception
     */
    public function create(?DealConstraint $dealConstraint = null): Deal
    {
        $deal = new Deal();

        $deal->dealer = rand(0, 3);
        $deal->vulnerable_NS = rand(0, 1);
        $deal->vulnerable_WE = rand(0, 1);

        if (!$dealConstraint) {
            return $deal;
        }

        $this->dealUpdater->applyBasicDealConstraints($deal, $dealConstraint);

        return $deal;
    }
}
