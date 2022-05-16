<?php

namespace App\Services\DealAnalyser\ProbabilityCalculator;

class TricksProbabilities
{
    public function __construct(private array $probs) {}

    public function getProbabilities(string $playerName, string $bidColor): array
    {
        return $this->probs[$playerName][$bidColor];
    }
}
