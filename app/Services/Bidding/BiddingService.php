<?php

namespace App\Services\Bidding;

use App\Events\BidExpectedEvent;
use App\Models\Bid;
use App\Models\Bidding;
use Illuminate\Support\Facades\Log;

class BiddingService implements BiddingServiceInterface
{
    public function __construct(
        private RuleCheckerInterface $ruleChecker,
        private PlayerServiceInterface $playerService
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
            $bidding->update(['status' => 'finished', 'current_player' => '']);
        }

        BidExpectedEvent::dispatch($bidding);
    }
}
