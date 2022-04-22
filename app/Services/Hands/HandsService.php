<?php

namespace App\Services\Hands;

use App\BridgeCore\Constants;

class HandsService
{
    public function __construct(private RandomService $randomService) {}

    public function generateRandomHands(): Hands
    {
        $allCardsNumbers = range(0, Constants::CARDS_COUNT - 1);

        return $this->shuffleCards($allCardsNumbers, Constants::PLAYERS_NAMES);
    }

    public function shuffleCards(array $cardsNumbers, $playerNames): Hands
    {
        $shuffledCardsNumbers = $this->randomService->shuffle($cardsNumbers);

        $hands = new Hands();
        foreach ($playerNames as $iter => $playerName) {
            $playerCardsNumbers = array_slice($shuffledCardsNumbers, $iter * Constants::PLAYERS_CARDS_COUNT, Constants::PLAYERS_CARDS_COUNT);
            $cards = new Cards();
            $cards->setFromNumbers($playerCardsNumbers);
            $hands->setHand($playerName, $cards);
        }

        return $hands;
    }
}
