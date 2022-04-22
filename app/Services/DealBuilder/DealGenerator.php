<?php

namespace App\Services\DealBuilder;

use App\BridgeCore\Constants;
use App\Services\Hands\HandsService;
use App\Services\RandomSeederInterface;
use App\Models\Deal;

class DealGenerator implements DealGeneratorInterface
{
    public function __construct(
        private RandomSeederInterface $randomSeeder,
        private HandsService $handsService
    ) {}

    public function generateRandom(): Deal
    {
        $this->randomSeeder->seed();

        $deal = new Deal();

        $deal->dealer = Constants::PLAYERS_NAMES[rand(0, Constants::PLAYERS_COUNT - 1)];
        $deal->vulnerable_NS = rand(0, 1);
        $deal->vulnerable_WE = rand(0, 1);

        $hands = $this->handsService->generateRandomHands();
        $deal->setHands($hands);

        return $deal;
    }
}
