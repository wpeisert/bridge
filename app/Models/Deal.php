<?php

namespace App\Models;

use App\Bridge\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'vulnerable_02', 'vulnerable_13', 'cards_0', 'cards_1', 'cards_2', 'cards_3', 'dealer'
    ];

    protected $casts = [
        'vulnerable_02' => 'integer',
        'vulnerable_13' => 'integer',
    ];

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class)->withTimestamps();
    }


    public function getOneLineCards(int $user_no): string
    {
        $member = 'cards_' . $user_no;
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
