<?php

namespace App\Models;

use App\BridgeCore\Constants;
use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    private const STATUS_FINISHED = 'finished';

    protected $fillable = [
        'training_id', 'deal_id', 'current_player', 'status'
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
        return $this->hasMany(Bid::class)->orderBy('id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('user_no', 'should_bid')->withTimestamps();
    }

    public function getIsFinishedAttribute()
    {
        return $this->status === self::STATUS_FINISHED;
    }

    public function increaseCurrentPlayer()
    {
        $currentPlayer = $this->current_player;
        $currentPlayerIndex = array_search($currentPlayer, Constants::PLAYERS_NAMES);
        $nextPlayerIndex = ($currentPlayerIndex+1) % count(Constants::PLAYERS_NAMES);
        $nextPlayer = Constants::PLAYERS_NAMES[$nextPlayerIndex];
        $this->update(['current_player' => $nextPlayer]);
    }
}
