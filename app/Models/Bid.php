<?php

namespace App\Models;

use App\BridgeCore\Tools;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = [
        'bid', 'alert', 'alert_description', 'user_id'
    ];


    public function bidding()
    {
        return $this->belongsTo(Bidding::class);
    }

    public function getBidHumanAttribute()
    {
        return Tools::decorateBid($this->bid);
    }
}
