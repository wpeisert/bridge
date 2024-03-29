<?php

namespace App\Services\Bidding;

use App\BridgeCore\Constants;
use App\BridgeCore\Tools;
use App\Events\BiddingFinishedEvent;
use App\Events\BidPlacedEvent;
use App\Models\Bid;
use App\Models\Bidding;
use App\Services\BiddingParser\BiddingParserFactoryInterface;
use App\Services\Contract\ContractValueService;
use App\Services\DealAnalyser\ProbabilityCalculator\TricksProbabilities;
use Illuminate\Support\Facades\Log;

class BiddingService implements BiddingServiceInterface
{
    public function __construct(
        private RuleCheckerInterface $ruleChecker,
        private PlayerServiceInterface $playerService,
        private BiddingParserFactoryInterface $biddingParserFactory,
        private ContractValueService $contractValueService
    ) {}


    public function isBidCorrect(Bidding $bidding, string $bid): bool
    {
        return in_array($bid, $this->ruleChecker->getPossibleBids($bidding));
    }

    public function canUserPlaceBid(Bidding $bidding, int $userId): bool
    {
        return $bidding->current_user_id == $userId;
    }

    public function canPlaceBid(Bidding $bidding, int $userId, string $bid): bool
    {
        if (!$this->canUserPlaceBid($bidding, $userId)) {
            return false;
        }

        if (!$this->isBidCorrect($bidding, $bid)) {
            return false;
        }

        return true;
    }

    public function placeBid(Bidding $bidding, mixed $createData)
    {
        if (!is_array($createData)) {
            $createData = ['bid' => $createData];
        }
        if (!isset($createData['user_id'])) {
            $createData['user_id'] = 0;
        }

        if (!$this->canPlaceBid($bidding, $createData['user_id'], $createData['bid'])) {
            Log::error(
                "placeBid not allowed",
                [
                    '$bidding->current_user_id' =>  $bidding->current_user_id,
                    '$createData[user_id]' => $createData['user_id'],
                    '$createData[bid]' => $createData['bid'],
                ]
            );

            throw new \Exception("allowed user id: " . $bidding->current_user_id . " actual user id: " . $createData['user_id']);
        }

        $bidding->bids()->save(new Bid($createData));
        $bidding->update(['current_player' => $this->playerService->increasePlayer($bidding->current_player)]);
        if (0 === count($this->ruleChecker->getPossibleBids($bidding))) {
            $bidding->update(
                array_merge(
                    [
                        'status' => Bidding::STATUS_FINISHED,
                        'current_player' => '',
                    ],
                    $this->calculateResults($bidding),
                )
            );
            BiddingFinishedEvent::dispatch($bidding);
        }

        BidPlacedEvent::dispatch($bidding);
    }

    public function calculateResults(Bidding $bidding): array
    {
        $actualContract = $this->biddingParserFactory->parse($bidding)->getContractWithoutVulnerability();

        $res = ['contract' => $actualContract->getHash()];
        foreach (Constants::SIDES as $side) {
            $fieldname = 'minimax_ev_' . $side;
            $minimaxEv = $bidding->deal->$fieldname;

            if ($actualContract->isPass()) {
                $ev = 0;
            } else {
                $fieldname = 'tricks_probabilities_' . $side;
                $serializedProbabilities = $bidding->deal->$fieldname;
                $tricksProbabilities = TricksProbabilities::createFromSerialized($serializedProbabilities);

                $declarerPair = Tools::getPlayerSide($actualContract->declarer);
                $vulnerableFieldName = 'vulnerable_' . $declarerPair;
                $actualContract->vulnerable = $bidding->deal->$vulnerableFieldName;
                $ev = $this->contractValueService->calculateContractExpectedValue(
                    $actualContract,
                    $tricksProbabilities->getProbabilities($actualContract->declarer, $actualContract->bidColor)
                );
            }

            $res['result_' . $side] = $ev - $minimaxEv;
        }

        return $res;
    }
}
