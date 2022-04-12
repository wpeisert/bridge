<?php

namespace App\Repositories;

use App\Repositories\BiddingRepositoryInterface;
use App\Models\User;

class BiddingRepository implements BiddingRepositoryInterface
{
    public function getUserAllBiddings(User $user, ?string $status = null)
    {
        $biddings = $user->biddings();
        if ($status) {
            $biddings = $biddings->where('status', '=', $status);
        }
        return $biddings->get();
    }
}
