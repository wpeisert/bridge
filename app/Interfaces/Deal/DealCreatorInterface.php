<?php

namespace App\Interfaces\Deal;

use App\Models\Deal;
use App\Models\DealConstraint;

interface DealCreatorInterface
{
    public function create(?DealConstraint $dealConstraint): Deal;
}
