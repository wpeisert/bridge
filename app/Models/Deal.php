<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    private const PLAYERS_COUNT = 4;
    private const PLAYERS_NAMES = ['N', 'E', 'S', 'W'];

    use HasFactory;

    protected $fillable = [
        'description', 'vulnerable_02', 'vulnerable_13', 'cards_0', 'cards_1', 'cards_2', 'cards_3', 'start_player_no'
    ];

    protected $casts = [
        'vulnerable_02' => 'integer',
        'vulnerable_13' => 'integer',
    ];

    public static function getPLayersCount(): int
    {
        return self::PLAYERS_COUNT;
    }

    public static function getPLayersNames(): array
    {
        return self::PLAYERS_NAMES;
    }

    public function getOneLineCards(int $user_no): string
    {
        $member = 'cards_' . $user_no;
        $cards = $this->$member;

        return $this->decorateOneLine($cards);
    }

    private function decorateOneLine(string $cards)
    {
        $colors = ['&spades;', '&hearts;', '&diams;', '&clubs;'];

        $result = '';
        $cardsArr = explode('.', $cards);
        for ($iter = 0; $iter < 4; ++$iter) {
            if ($cardsArr[$iter]) {
                $result .= $colors[$iter] . ' ' . $cardsArr[$iter] . '   ';
            }
        }

        return $result;
    }
}
