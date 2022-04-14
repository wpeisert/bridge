<?php

namespace App\BridgeCore;

class Tools
{
    public static function getDealConstraintFields(): array
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
    public static function parseDealConstraintFieldName(string $name): string
    {
        return str_replace(
            array_merge(['PC'], Constants::COLORS_NAMES, array_keys(Constants::PLAYERS_NAMES), ['_', 'from', 'to']),
            array_merge(['Points'], Constants::COLORS_SYMBOLS, Constants::PLAYERS_NAMES, [' ', '>=', '<=']),
            $name
        );
    }

    public static function decorateOneLine(string $cards)
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

    public static function decorateBid(string $bid): string
    {
        if (intval($bid[0]) === 0) {
            switch ($bid) {
                case 'dbl':
                    return '<span style="font-weight: bold; color: #' . Constants::DBL_COLOR . ';">' . 'X' . '</span>';
                case 'rdbl':
                    return '<span style="font-weight: bold; color: #' . Constants::RDBL_COLOR . ';">' . 'XX' . '</span>';
                default:
                    return $bid;
            }
        }

        $color = strtoupper(substr($bid, 1));
        $colorNo = array_search($color, Constants::COLORS_NAMES);
        $decorated = $bid[0] . '';
        if ($colorNo === false) {
            $decorated .= $color;
        } else {
            $decorated .= '<span style="color: #' . Constants::COLORS_COLORS[$colorNo] . ';">' . Constants::COLORS_SYMBOLS[$colorNo] . '</span>';
        }

        return $decorated;
    }
}
