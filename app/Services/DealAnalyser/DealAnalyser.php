<?php

namespace App\Services\DealAnalyser;

use App\BridgeCore\Constants;
use App\Models\Deal;
use App\Services\DealAnalyser\DoubleDummy\DoubleDummyCalculator;
use App\Services\Hands\HandsService;
use App\Services\DealAnalyser\ProbabilityCalculator\ProbabilityCalculator;
use Tests\Unit\App\Services\Contract\ContractService;

class DealAnalyser implements DealAnalyserInterface
{
    public function __construct(
        private HandsService $handsService,
        private DoubleDummyCalculator $doubleDummyCalculator,
        private ProbabilityCalculator $probabilityCalculator,
        private ContractService $contractService
    ) {}

    public function analyse(Deal $deal, int $rounds = self::ROUNDS)
    {
        $contractsNS = $this->analyseSide($deal, 'NS', $rounds);
        $contractsWE = $this->analyseSide($deal, 'EW', $rounds);

        $this->storeMinimax($contracts);
    }

    public function analyseSide(Deal $deal, string $side, int $rounds = self::ROUNDS)
    {
        $players = str_split($side);
        $opponents = array_values(array_diff(Constants::PLAYERS_NAMES, str_split($side)));
        $dealHands = $deal->getHands();
        $hands = [];
        for ($round = 0; $round < $rounds; ++$round) {
            $hands[] = $this->handsService->shuffleHands($dealHands, $opponents);
        }

        $ddResults = $this->doubleDummyCalculator->calculate($hands);

        $tricksProbabilities = $this->probabilityCalculator->calculateTricksProbabilities($ddResults);

        $vulnerable = $side == 'NS' ? $deal->vulnerable_NS : $deal->vulnerable_WE;

        $contractsEvaluated = $this->contractService->evaluateContracts(
            $this->contractService->getAllContractsNoDeclarer(),
            $side,
            $vulnerable,
            $tricksProbabilities
        );

        usort(
            $contractsEvaluated,
            function ($a, $b) {
                return ($a['ev'] < $b['ev']) ? -1 : 1;
            }
        );

        return $contractsEvaluated;
    }
}
