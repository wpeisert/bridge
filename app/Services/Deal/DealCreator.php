<?php

namespace App\Services\Deal;

use App\Interfaces\Deal\DealCreatorInterface;
use App\Models\Deal;

class DealCreator implements DealCreatorInterface
{
    public function create(): Deal
    {
        throw new \Exception('not implemented yet');
        // TODO: Implement create() method.
    }
}
