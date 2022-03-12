<?php

namespace App\Interfaces\Deal;

use App\Models\Deal;

interface DealCreatorInterface
{
    public function create(): Deal;
}
