<?php

namespace App\Services\BiddingParser;

use App\BridgeCore\Constants;
use App\BridgeCore\Tools;
use App\Models\Bidding;
use App\Services\Bidding\PlayerServiceInterface;
use App\Services\Contract\Contract;

class BiddingParser implements BiddingParserInterface
{
    private Bidding $bidding;

    /**
     * @var string[]
     */
    private array $bids;

    public function __construct(private PlayerServiceInterface $playerService) {}

    public function setBidding(Bidding $bidding)
    {
        $this->bidding = $bidding;
        $this->bids = array_map(function ($bid) {return $bid->bid;}, $bidding->bids()->get()->all());
    }

    public function isColorBid(int $index): bool
    {
        $bid = $this->getBid($index);
        return $bid && !in_array($bid, Constants::BIDS_SPECIAL);
    }

    public function isPass(int $index): bool
    {
        return 'pass' === $this->getBid($index);
    }

    public function isDbl(int $index): bool
    {
        return 'dbl' === $this->getBid($index);
    }

    public function getLastColorBid(): string
    {
        for ($index = count($this->bids) - 1; $index >= 0; --$index) {
            if (!$this->isColorBid($index)) {
                continue;
            }
            return $bid = $this->getBid($index);
        }

        return '';
    }

    public function getBid(int $index): string
    {
        $count = count($this->bids);
        if ($index >= 0 && $index < $count) {
            return $this->bids[$index];
        }
        if ($count + $index >=0) {
            return $this->bids[$count + $index];
        }
        return '';
    }

    public function getContractWithoutVulnerability(): Contract
    {
        $lastColorBid = $this->getLastColorBid();
        if (!$lastColorBid) {
            return Contract::PASS();
        }

        $lastColorBidIndex = array_search($lastColorBid, $this->bids);
        $firstColorBid = $this->getFirstColorBidInPairForBid($lastColorBid);
        $firstColorBidIndex = array_search($firstColorBid, $this->bids);

        $declarer = $this->playerService->increasePlayer($this->bidding->deal->dealer, $firstColorBidIndex);
        $bidColor = substr($lastColorBid, 1);
        $level = intval($lastColorBid[0]);
        $type = '';
        $bids = array_slice($this->bids, $lastColorBidIndex);
        if (array_search('rdbl', $bids)) {
            $type = 'rdbl';
        } elseif (array_search('dbl', $bids)) {
            $type = 'dbl';
        }

        return Contract::create(
            [
                'declarer' => $declarer,
                'bidColor' => $bidColor,
                'level' => $level,
                'type' => $type
            ]
        );
    }

    public function getContractAsString(): string
    {
        return $this->getContractWithoutVulnerability()->getAsString();
    }

    public function getFirstColorBidInPairForBid(string $bid): string
    {
        $bidIndex = array_search($bid, $this->bids);
        if ($bidIndex === false) {
            return '';
        }
        $color = substr($bid, 1);
        for ($iter = $bidIndex % 2; $iter < count($this->bids); $iter += 2) {
            if (substr($this->bids[$iter], 1) === $color) {
                return $this->bids[$iter];
            }
        }
        return '';
    }
}
