<?php

namespace App\Services\DealBuilder;

use App\Models\Deal;
use App\Models\DealConstraint;

interface DealBuilderInterface
{
    public function build(?DealConstraint $dealConstraint): Deal;
}
