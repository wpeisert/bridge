<?php

namespace App\Interfaces\Deal;

use App\Models\Deal;
use App\Models\DealConstraint;

interface DealBuilderInterface
{
    public function build(?DealConstraint $dealConstraint): Deal;
}
