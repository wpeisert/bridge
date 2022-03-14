<?php

namespace App\Models;

use App\Bridge\Constants;
use App\Bridge\Tools;
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

    private function decorateOneLine(string $cards)
    {
        $result = '';
        $cardsArr = explode('.', $cards);
        for ($iter = 0; $iter < 4; ++$iter) {
            if (isset($cardsArr[$iter])) {
                $result .= Constants::COLORS_SYMBOLS[$iter] . ' ' . $cardsArr[$iter] . '   ';
            }
        }

        return $result;
    }
}
