<?php

namespace App\Models;

use App\BridgeCore\Constants;
use App\BridgeCore\Tools;
use App\Services\Hands\Hands;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        $fieldNames = [];
        foreach (Constants::PLAYERS_NAMES as $playerName) {
            $fieldNames[] = 'cards_' . $playerName;
        }

        $this->fillable = array_merge($this->fillable, $fieldNames);

        parent::__construct($attributes);
    }

    protected $fillable = [
        'description', 'vulnerable_NS', 'vulnerable_WE', 'dealer'
    ];

    protected $casts = [
        'vulnerable_NS' => 'integer',
        'vulnerable_WE' => 'integer',
    ];

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class)->withTimestamps();
    }


    public function getOneLineCards(string $playerName): string
    {
        return Tools::decorateOneLine($this->getHand($playerName));
    }

    public function getVulnerableHumanAttribute()
    {
        if ($this->vulnerable_NS && $this->vulnerable_WE) {
            return 'both';
        }
        if (!$this->vulnerable_NS && $this->vulnerable_WE) {
            return 'WE';
        }
        if ($this->vulnerable_NS && !$this->vulnerable_WE) {
            return 'NS';
        }
        return ' - ';
    }

    public function setHands(Hands $hands)
    {
        foreach ($hands->getHands() as $playerName => $hand) {
            if (!in_array($playerName, Constants::PLAYERS_NAMES)) {
                throw new \Exception(sprintf("Incorrect player name: $playerName"));
            }
            $this->setHand($playerName, $hand);
        }
    }

    public function setHand(string $playerName, string $cards)
    {
        $field = 'cards_' . $playerName;
        $this->$field = $cards;
    }

    public function getHands(): Hands
    {
        $hands = new Hands;
        foreach (Constants::PLAYERS_NAMES as $playerName) {
            $hands->setHand($playerName, $this->getHand($playerName));
        }
        return $hands;
    }

    public function getHand(string $playerName): string
    {
        $field = 'cards_' . $playerName;
        return $this->$field;
    }
}
