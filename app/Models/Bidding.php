<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    private const STATUS_FINISHED = 'finished';

    protected $fillable = [
        'training_id', 'deal_id', 'current_user', 'status'
    ];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class)->orderBy('bidding_lp')->orderBy('id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('user_no', 'should_bid')->withTimestamps();
    }

    public function getIsFinishedAttribute()
    {
        return $this->status === self::STATUS_FINISHED;
    }
}
