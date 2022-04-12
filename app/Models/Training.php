<?php

namespace App\Models;

use App\BridgeCore\Constants;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'quiz_id'
    ];

    public function __construct(array $attributes = [])
    {
        $fieldNames = [];
        foreach (Constants::PLAYERS_NAMES as $playerName) {
            $fieldNames[] = 'user_id_' . $playerName;
        }

        $this->fillable = array_merge($this->fillable, $fieldNames);

        parent::__construct($attributes);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function biddings()
    {
        return $this->hasMany(Bidding::class);
    }

    public function getUser(string $userName)
    {
        return $this->belongsTo(User::class, 'user_id_' . $userName)->first();
    }

    public function isStarted(): bool
    {
        return $this->biddings()->count();
    }
}
