<?php


namespace App\Services\Hands;


class Cards
{
    public function __construct(private string $cards = '') {}

    public function __toString(): string
    {
        return $this->cards;
    }
}
