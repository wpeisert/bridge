<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    use HasFactory;

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('user_no', 'should_bid')->withTimestamps();
    }
}
