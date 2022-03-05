<?php

namespace App\Dictionaries;

class BridgeConstants
{
    public const PLAYERS_COUNT = 4;
    public const PLAYERS_NAMES = ['N', 'E', 'S', 'W'];
    public const COLORS_SYMBOLS = ['&spades;', '&hearts;', '&diams;', '&clubs;'];
    public const DEAL_CONSTRAINTS_VULNERABLE = ['- any -', 'NS', 'WE', ' both ', ' none '];
    public const DEAL_CONSTRAINTS_DEALER = ['N', 'E', 'S', 'W', '- any -'];
    public const COLORS_COUNT = 4;
    public const COLORS_NAMES = ['S', 'H', 'D', 'C'];
    public const MAX_PC = 40;
    public const MAX_CARDS_IN_COLOR = 13;

    public static function get(): array
    {
        return [
            'DEAL_CONSTRAINTS_FIELDS' => static::getDealConstraintsFields(),
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

    public static function getDealConstraintsFields(): array
    {
        $fields = [];

        for ($playerNo = 0; $playerNo < BridgeConstants::PLAYERS_COUNT; ++$playerNo) {
            $fields['PC_' . $playerNo . '_from'] = ['defaultValue' => 0, 'maxValue' => self::MAX_PC];
            $fields['PC_' . $playerNo . '_to'] = ['defaultValue' => self::MAX_PC, 'maxValue' => self::MAX_PC];
        }

        $fields['PC_02_from'] = ['defaultValue' => 0, 'maxValue' => self::MAX_PC];
        $fields['PC_02_to'] = ['defaultValue' => self::MAX_PC, 'maxValue' => self::MAX_PC];

        foreach (self::COLORS_NAMES as $colorName) {
            for ($playerNo = 0; $playerNo < BridgeConstants::PLAYERS_COUNT; ++$playerNo) {
                $fields[$colorName . '_' . $playerNo . '_from'] = ['defaultValue' => 0, 'maxValue' => self::MAX_CARDS_IN_COLOR];
                $fields[$colorName . '_' . $playerNo . '_to'] = ['defaultValue' => self::MAX_CARDS_IN_COLOR, 'maxValue' => self::MAX_CARDS_IN_COLOR];
            }
        }

        return $fields;
    }


}
