<?php

namespace App\Services\Deal;

use App\Interfaces\Deal\DealCreatorInterface;
use App\Models\Deal;
use App\Models\DealConstraint;

class DealCreator implements DealCreatorInterface
{
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
        return new Deal();
        // TODO: Implement create() method.
    }
}
