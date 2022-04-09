<?php

namespace App\Services\DealDecorator;

use App\BridgeCore\Constants;
use App\Models\Deal;
use App\Services\Deal\DealServiceInterface;

class DealDecorator implements DealDecoratorInterface
{
    private Deal $deal;

    public function __construct(private DealServiceInterface $dealService) {}

    public function setDeal(Deal $deal)
    {
        $this->deal = $deal;
    }

    /**
     * Names from Tools::getDealConstraintFields without _from or _to part
     *
     * @param string $fieldName
     * @return int
     */
    public function getValue(string $fieldName): int
    {
        $split = explode('_', $fieldName);
        if ('PC' === $split[0]) {
            $sum = array_reduce(
                str_split($split[1]),
                function($sum, $playerNo) {
                    $pc = $this->getPC(intval($playerNo));
                    return $sum + $pc;
                },
                0
            );

            return $sum;
        }
        return $this->getCardsCount($split[0], intval($split[1]));
    }

    public function getPC(int $playerNo): int
    {
        $field = 'cards_' . Constants::PLAYERS_NAMES[$playerNo];
        $cards = $this->deal->$field;

        return $this->dealService->getPC($cards);
    }

    public function getCardsCount(string $colorName, int $playerNo): int
    {
        $field = 'cards_' . Constants::PLAYERS_NAMES[$playerNo];
        $cards = $this->deal->$field;
        $colorNo = array_search($colorName, Constants::COLORS_NAMES);

        return $this->dealService->getCardsCount($cards, $colorNo, $playerNo);
    }
}
