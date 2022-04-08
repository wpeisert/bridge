<?php

namespace App\Services\DealBuilder;

use App\Models\Deal;
use App\Models\DealConstraint;

interface DealCreatorInterface
{
    public function create(?DealConstraint $dealConstraint): Deal;
}
