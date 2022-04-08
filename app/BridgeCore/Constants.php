<?php

namespace App\BridgeCore;

class Constants
{
    public const PLAYERS_COUNT = 4;
    public const PLAYERS_NAMES = ['N', 'E', 'S', 'W'];
    public const PLAYERS_CARDS_COUNT = 13;

    public const DEAL_CONSTRAINTS_VULNERABLE = ['- any -', 'Yes', 'No'];
    public const DEAL_CONSTRAINTS_DEALER = ['N', 'E', 'S', 'W', '- any -'];
    public const COLORS_COUNT = 4;
    public const COLORS_NAMES = ['S', 'H', 'D', 'C'];
    public const COLORS_SYMBOLS = ['&spades;', '&hearts;', '&diams;', '&clubs;'];
    public const COLORS_COLORS = ['000077', 'ee0000', 'ee4400', '008800'];
    public const CARDS = ['A', 'K', 'Q', 'J', 'T', '9', '8', '7', '6', '5', '4', '3', '2'];
    public const CARDS_IN_COLOR_COUNT = 13;
    public const MAX_PC = 40;

    public static function get(): array
    {
        return [
            'DEAL_CONSTRAINTS_FIELDS' => Tools::getDealConstraintFields(),
            'PLAYERS_COUNT' => self::PLAYERS_COUNT,
            'PLAYERS_NAMES' => self::PLAYERS_NAMES,
            'COLORS_SYMBOLS' => self::COLORS_SYMBOLS,
            'DEAL_CONSTRAINTS_VULNERABLE' => self::DEAL_CONSTRAINTS_VULNERABLE,
            'DEAL_CONSTRAINTS_DEALER' => self::DEAL_CONSTRAINTS_DEALER,
            'COLORS_COUNT' => self::COLORS_COUNT,
            'COLORS_NAMES' => self::COLORS_NAMES,
            'MAX_PC' => self::MAX_PC,
            'CARDS_IN_COLOR_COUNT' => self::CARDS_IN_COLOR_COUNT,
        ];
    }
}
