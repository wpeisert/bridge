<?php

namespace App\Models;

use App\BridgeCore\Constants;
use App\Services\BiddingParser\BiddingParser;
use App\Services\BiddingParser\BiddingParserFactoryInterface;
use App\Services\DealAnalyser\ProbabilityCalculator\TricksProbabilities;
use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    private const STATUS_FINISHED = 'finished';

    protected $fillable = [
        'training_id', 'deal_id', 'current_player', 'status', 'result_NS', 'result_WE'
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

    public function getAnalysisAttribute(): string
    {
        $res = '';
        foreach (Constants::SIDES as $side) {
            $fieldname = 'tricks_probabilities_' . $side;
            $serializedProbabilities = $this->deal->$fieldname;
            $tricksProbabilities = TricksProbabilities::createFromSerialized($serializedProbabilities);
            $res .= "Trick probabilities $side: \n" . $tricksProbabilities->getHtml() . "\n";
        }

        return $this->deal->analysis . "<hr>"
            . 'Contract: ' . app()->make(BiddingParserFactoryInterface::class)->parse($this)->getContractAsString() . "<hr>"
            . 'Result NS: ' . $this->result_NS . "\n"
            . 'Result WE: ' . $this->result_WE . "\n<hr>"
            . $res;
    }
}
