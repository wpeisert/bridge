<?php

namespace App\Dictionaries;

class BridgeConstants
{
    public const PLAYERS_COUNT = 4;
    public const PLAYERS_NAMES = ['N', 'E', 'S', 'W'];
    public const COLORS_SYMBOLS = ['&spades;', '&hearts;', '&diams;', '&clubs;'];
    public const DEAL_CONSTRAINTS_VULNERABLE = ['- any -', 'NS', 'WE', ' both ', ' none '];
    public const DEAL_CONSTRAINTS_DEALER = ['N', 'E', 'S', 'W', '- any -'];
    public const DEAL_CONSTRAINTS_COLORS = ['S', 'H', 'D', 'C'];

    public static function get(): array
    {
        return [
            'PLAYERS_COUNT' => self::PLAYERS_COUNT,
            'PLAYERS_NAMES' => self::PLAYERS_NAMES,
            'COLORS_SYMBOLS' => self::COLORS_SYMBOLS,
            'DEAL_CONSTRAINTS_VULNERABLE' => self::DEAL_CONSTRAINTS_VULNERABLE,
            'DEAL_CONSTRAINTS_DEALER' => self::DEAL_CONSTRAINTS_DEALER,
            'DEAL_CONSTRAINTS_COLORS' => self::DEAL_CONSTRAINTS_COLORS,
        ];
    }
}
