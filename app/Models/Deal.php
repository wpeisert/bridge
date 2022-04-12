<?php

namespace App\Models;

use App\BridgeCore\Constants;
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
        $member = 'cards_' . $playerName;
        $cards = $this->$member;

        return $this->decorateOneLine($cards);
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

    private function decorateOneLine(string $cards)
    {
        $result = '';
        $cardsArr = explode('.', $cards);
        for ($iter = 0; $iter < 4; ++$iter) {
            $result .= '<span style="color: #' . Constants::COLORS_COLORS[$iter] . ';">' . Constants::COLORS_SYMBOLS[$iter] . '</span>';
            $result .= isset($cardsArr[$iter]) && $cardsArr[$iter] ? ' ' . str_replace('T', '10', $cardsArr[$iter]) : '-';
            $result .= '<br />';
        }

        return $result;
    }
}
