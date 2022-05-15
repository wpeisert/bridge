<?php

namespace App\Services\DealAnalyser;

use App\BridgeCore\Constants;
use App\Models\Deal;
use App\Services\Contract\Contract;
use App\Services\Contract\ContractService;
use App\Services\DealAnalyser\DoubleDummy\DoubleDummyCalculator;
use App\Services\DealAnalyser\DoubleDummy\DoubleDummyResult;
use App\Services\Hands\Cards;
use App\Services\Hands\Hands;
use App\Services\Hands\HandsService;

class DealAnalyser implements DealAnalyserInterface
{
    private const MAX_DEALS_DD = 40;
    private const ROUNDS = 40;

    private Deal $deal;

    public function __construct(
        private HandsService $handsService,
        private DoubleDummyCalculator $doubleDummyCalculator,
        private ContractService $contractService
    ) {}

    public function setDeal(Deal $deal)
    {
        $this->deal = $deal;
    }

    public function analyse(int $rounds = self::ROUNDS): void
    {
        $dealHands = $this->deal->getHands();
        $hands = [];
        for ($round = 0; $round < $rounds; ++$round) {
            $hands[] = $this->shuffle($dealHands, ['E', 'W']);
        }

        $ddResults = $this->doubleDummyCalculator->calculate($hands);

        $tricksProbabilities = $this->calculateTricksProbabilities($ddResults);

        $contractsEvaluated = [];
        foreach ($this->getAllContracts() as $contract) {
            $contractsEvaluated[] = $this->evaluateContract($contract, $tricksProbabilities);

        }
        $contractsFiltered = $this->removeDuplicatesFromContracts($contractsEvaluated);
        $contracts = $this->searchMinimax($contractsFiltered);

        $this->storeMinimax($contracts);
    }

    public function shuffle(Hands $hands, array $playersNames): Hands
    {
        $cardsNumbers = [];
        foreach ($playersNames as $playerName) {
            $cards = new Cards($hands->getHand($playerName));
            $cardsNumbers = array_merge($cardsNumbers, $cards->getAsNumbers());
        }
        $newHands = $this->handsService->shuffleCards($cardsNumbers, $playersNames);
        foreach (Constants::PLAYERS_NAMES as $playerName) {
            if (in_array($playerName, $playersNames)) {
                continue;
            }
            $newHands->setHand($playerName, $hands->getHand($playerName));
        }

        return $newHands;
    }

    /**
     * @param DoubleDummyResult[] $ddResults
     * @return array
     */
    public function calculateTricksProbabilities(array $ddResults): array
    {
        /*
         * Calculates probabilities of taking given number of tricks:
         *  - for each declarer (N, E, S, W)
         *  - for each color (c, d, h, s, nt)
         *  - for each number of tricks (0..13)
         * so it's 4x5x14 array of float
         * Note: zero entries may be not present
         */
        $probs = [];

        foreach (Constants::PLAYERS_NAMES as $playerName) {
            foreach (Constants::BIDS_COLORS as $bidColor) {
                for ($tricks = 0; $tricks <= Constants::PLAYERS_CARDS_COUNT; ++$tricks) {
                    $probs[$playerName][$bidColor][$tricks] = 0;
                }
            }
        }

        /** @var DoubleDummyResult $ddResult */
        foreach ($ddResults as $ddResult) {
            foreach (Constants::PLAYERS_NAMES as $playerName) {
                foreach (Constants::BIDS_COLORS as $bidColor) {
                    $maxTricks = $ddResult->getTricks($playerName, $bidColor);
                    for ($tricks = 0; $tricks <= $maxTricks; ++$tricks) {
                        $probs[$playerName][$bidColor][$tricks]++;
                    }
                }
            }
        }

        foreach (Constants::PLAYERS_NAMES as $playerName) {
            foreach (Constants::BIDS_COLORS as $bidColor) {
                for ($tricks = 0; $tricks <= Constants::PLAYERS_CARDS_COUNT; ++$tricks) {
                    $probs[$playerName][$bidColor][$tricks] /= count($ddResults);
                }
            }
        }

        return $probs;
    }

    public function getAllContracts(): array
    {
        return [];
        /*
         * Returns all possible contracts for all hands
         * Number is: 4(N,E,S,W)x5(c,d,h,s,nt)x7x3(pass/dbl/rdbl) = 420
         */
        foreach (Constants::PLAYERS_NAMES as $playerName) {

        }
    }

    public function calculateContractExpectedValue(Contract $contract, array $tricksProbabilities): array
    {

        $result = $this->contractService->getValue($contract, $tricks);
    }

    public function removeDuplicatesFromContracts(array $contracts): array
    {
        // TODO implement
        return [];
        /*
         * If for given contract the result is same for N and S (resp. E and W), remove this duplication (S resp. W)
         */
    }

    public function searchMinimax(array $contracts): array
    {
        // TODO implement
        return [];
        /*
         * Performs minimax algo.
         * Returns short list of best contracts.
         */
    }

    public function storeMinimax(array $contracts)
    {

    }
}
