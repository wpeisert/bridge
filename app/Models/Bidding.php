<?php

namespace App\Models;

use App\Services\BiddingAnalyser\BiddingAnalyser;
use App\Services\Imp\ImpService;
use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    public const STATUS_FINISHED = 'finished';

    protected $fillable = [
        'training_id', 'deal_id', 'current_player', 'status', 'contract', 'result_NS', 'result_WE'
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

    public function getCurrentUserIdAttribute(): int
    {
        $player = $this->training->getUser($this->current_player);
        return $player ? $player->id : 0;
    }

    public function getCurrentUserNameAttribute(): string
    {
        if (!$this->current_player) {
            return ' - none - ';
        }
        $player = $this->training->getUser($this->current_player);
        return $player ? $player->name : 'computer';
    }

    public function getAnalysisAttribute(): string
    {
        return app()->make(BiddingAnalyser::class)->getBiddingAnalysisHtml($this);
    }

    public function getResultNsImpAttribute(): float
    {
        return (new ImpService())->getImp($this->result_NS);
    }

    public function getResultWeImpAttribute(): float
    {
        return (new ImpService())->getImp($this->result_WE);
    }
}
