<?php

namespace App\Services\DealAnalyser\ProbabilityCalculator;

class TricksProbabilities
{
    public function __construct(private array $probs) {}

    public function getProbabilities(string $playerName, string $bidColor): array
    {
        return $this->probs[$playerName][$bidColor];
    }

    public function getSerialized(): string
    {
        return serialize($this->probs);
    }

    public static function createFromSerialized(string $serialized): TricksProbabilities
    {
        return new TricksProbabilities(unserialize($serialized));
    }

    public function getHtml(): string
    {
        return str_replace("\n", "", view('tricks_probabilities', ['probs' => $this->probs])->render());
    }
}
