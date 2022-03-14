<?php

namespace App\Bridge;

class Constants
{
    public const PLAYERS_COUNT = 4;
    public const PLAYERS_NAMES = ['N', 'E', 'S', 'W'];
    public const COLORS_SYMBOLS = ['&spades;', '&hearts;', '&diams;', '&clubs;'];
    public const DEAL_CONSTRAINTS_VULNERABLE = ['- any -', 'Yes', 'No'];
    public const DEAL_CONSTRAINTS_DEALER = ['N', 'E', 'S', 'W', '- any -'];
    public const COLORS_COUNT = 4;
    public const COLORS_NAMES = ['S', 'H', 'D', 'C'];
    public const MAX_PC = 40;
    public const MAX_CARDS_IN_COLOR = 13;

    public static function get(): array
    {
        return [
            'DEAL_CONSTRAINTS_FIELDS' => Tools::getDealConstraintsFields(),
            'PLAYERS_COUNT' => self::PLAYERS_COUNT,
            'PLAYERS_NAMES' => self::PLAYERS_NAMES,
            'COLORS_SYMBOLS' => self::COLORS_SYMBOLS,
            'DEAL_CONSTRAINTS_VULNERABLE' => self::DEAL_CONSTRAINTS_VULNERABLE,
            'DEAL_CONSTRAINTS_DEALER' => self::DEAL_CONSTRAINTS_DEALER,
            'COLORS_COUNT' => self::COLORS_COUNT,
            'COLORS_NAMES' => self::COLORS_NAMES,
            'MAX_PC' => self::MAX_PC,
            'MAX_CARDS_IN_COLOR' => self::MAX_CARDS_IN_COLOR,
        ];
    }
}
