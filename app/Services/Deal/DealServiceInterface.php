<?php

namespace App\Services\Deal;

interface DealServiceInterface
{
    public function getPC(string $cards): int;
    public function getCardsCount(string $cards, int $colorNo, int $playerNo): int;
}
