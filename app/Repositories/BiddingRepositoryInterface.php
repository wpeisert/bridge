<?php

namespace App\Repositories;

use App\Models\User;

interface BiddingRepositoryInterface
{
    public function getUserAllBiddings(User $user, ?string $status = null);
}
