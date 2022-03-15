<?php

namespace App\Bridge;

class Tools
{
    public static function getDealConstraintsFields(): array
    {
        $fields = [];

        for ($playerNo = 0; $playerNo < Constants::PLAYERS_COUNT; ++$playerNo) {
            $fields['PC_' . $playerNo . '_from'] = ['defaultValue' => 0, 'maxValue' => Constants::MAX_PC];
            $fields['PC_' . $playerNo . '_to'] = ['defaultValue' => Constants::MAX_PC, 'maxValue' => Constants::MAX_PC];
        }

        $fields['PC_02_from'] = ['defaultValue' => 0, 'maxValue' => Constants::MAX_PC];
        $fields['PC_02_to'] = ['defaultValue' => Constants::MAX_PC, 'maxValue' => Constants::MAX_PC];
        $fields['PC_13_from'] = ['defaultValue' => 0, 'maxValue' => Constants::MAX_PC];
        $fields['PC_13_to'] = ['defaultValue' => Constants::MAX_PC, 'maxValue' => Constants::MAX_PC];

        foreach (Constants::COLORS_NAMES as $colorName) {
            for ($playerNo = 0; $playerNo < Constants::PLAYERS_COUNT; ++$playerNo) {
                $fields[$colorName . '_' . $playerNo . '_from'] = ['defaultValue' => 0, 'maxValue' => Constants::CARDS_IN_COLOR_COUNT];
                $fields[$colorName . '_' . $playerNo . '_to'] = ['defaultValue' => Constants::CARDS_IN_COLOR_COUNT, 'maxValue' => Constants::CARDS_IN_COLOR_COUNT];
            }
        }

        return $fields;
    }

    /**
     * @param string $name
     * @return string
     */
    public static function parseDealConstraintsFieldName(string $name): string
    {
        return str_replace(
            array_merge(['PC'], Constants::COLORS_NAMES, array_keys(Constants::PLAYERS_NAMES), ['_', 'from', 'to']),
            array_merge(['Points'], Constants::COLORS_SYMBOLS, Constants::PLAYERS_NAMES, [' ', '>=', '<=']),
            $name
        );
    }
}
