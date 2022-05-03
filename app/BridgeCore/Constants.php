<?php

namespace App\BridgeCore;

class Constants
{
    public const PLAYERS_COUNT = 4;
    public const PLAYERS_NAMES = ['N', 'E', 'S', 'W'];
    public const PLAYERS_CARDS_COUNT = 13;

    public const DEAL_CONSTRAINTS_VULNERABLE = ['- any -', 'Yes', 'No'];
    public const DEAL_CONSTRAINTS_DEALER = ['N', 'E', 'S', 'W', '- any -'];
    public const COLORS_NAMES = ['S', 'H', 'D', 'C'];
    public const COLORS_FULL_NAMES = ['Spades', 'Hearts', 'Diamonds', 'Clubs'];
    public const COLORS_COUNT = 4;
    public const COLORS_SYMBOLS = ['&spades;', '&hearts;', '&diams;', '&clubs;'];
    public const COLORS_COLORS = ['000077', 'ee0000', 'ee4400', '008800'];
    public const CARDS = ['A', 'K', 'Q', 'J', 'T', '9', '8', '7', '6', '5', '4', '3', '2'];
    public const CARDS_PC = [4, 3, 2, 1];
    public const CARDS_IN_COLOR_COUNT = 13;
    public const MAX_PC = 40;
    public const DBL_COLOR = 'ee0000';
    public const RDBL_COLOR = '0033ee';
    public const BIDS_COLORS = ['c', 'd', 'h', 's', 'nt'];
    public const BIDS_MAX_LEVEL = 7;
    public const BIDS_SPECIAL = ['pass', 'dbl', 'rdbl'];
    public const CARDS_COUNT = self::CARDS_IN_COLOR_COUNT * self::COLORS_COUNT;

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
            'COLORS_FULL_NAMES' => self::COLORS_FULL_NAMES,
            'CARDS_IN_COLOR_COUNT' => self::CARDS_IN_COLOR_COUNT,
            'MAX_PC' => self::MAX_PC,
            'DBL_COLOR' => self::DBL_COLOR,
            'RDBL_COLOR' => self::RDBL_COLOR,
            'BIDS_COLORS' => self::BIDS_COLORS,
            'BIDS_MAX_LEVEL' => self::BIDS_MAX_LEVEL,
            'BIDS_SPECIAL' => self::BIDS_SPECIAL,
        ];
    }
}
