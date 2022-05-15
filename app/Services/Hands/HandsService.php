<?php

namespace App\Services\Hands;

use App\BridgeCore\Constants;
use App\Services\Random\RandomService;

class HandsService
{
    public function __construct(
        private RandomService $randomService,
        private CardsService $cardsService
    ) {}

    public function generateRandomHands(): Hands
    {
        $allCardsNumbers = range(0, Constants::CARDS_COUNT - 1);

        return $this->shuffleCards($allCardsNumbers, Constants::PLAYERS_NAMES);
    }

    /**
     * @param array $cardsNumbers
     * @param array $playerNames
     * @return Hands
     * @throws \Exception
     */
    public function shuffleCards(array $cardsNumbers, array $playerNames): Hands
    {
        if (count($cardsNumbers) !== count($playerNames) * Constants::PLAYERS_CARDS_COUNT) {
            throw new \Exception(
                sprintf("%d cards cannot be shuffled amongst %d players", count($cardsNumbers), count($playerNames))
            );
        }
        $shuffledCardsNumbers = $this->randomService->shuffle($cardsNumbers);

        $hands = new Hands();
        foreach ($playerNames as $iter => $playerName) {
            $playerCardsNumbers = array_slice(
                $shuffledCardsNumbers, $iter * Constants::PLAYERS_CARDS_COUNT,
                Constants::PLAYERS_CARDS_COUNT
            );
            $hands->setHand($playerName, $this->cardsService->numbers2string($playerCardsNumbers));
        }

        return $hands;
    }

    public function shuffleHands(Hands $hands, array $playersNames): Hands
    {
        $cardsNumbers = [];
        foreach ($playersNames as $playerName) {
            $cardsNumbers = array_merge($cardsNumbers, $this->cardsService->string2numbers($hands->getHand($playerName)));
        }
        $newHands = $this->shuffleCards($cardsNumbers, $playersNames);
        foreach (Constants::PLAYERS_NAMES as $playerName) {
            if (in_array($playerName, $playersNames)) {
                continue;
            }
            $hand = $hands->getHand($playerName);
            if ($hand) {
                $newHands->setHand($playerName, $hand);
            }
        }

        return $newHands;
    }

    public function getHandsAsPBN(Hands $hands): string
    {
        $str = 'N:';
        foreach (Constants::PLAYERS_NAMES as $playerName) {
            $str .= $hands->getHand($playerName) . ' ';
        }

        return trim($str);
    }
}
