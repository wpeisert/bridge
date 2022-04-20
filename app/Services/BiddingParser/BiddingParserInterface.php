<?php

namespace App\Services\BiddingParser;

interface BiddingParserInterface
{
    public function isColorBid(int $index): bool;
    public function isPass(int $index): bool;
    public function isDbl(int $index): bool;
    public function getLastColorBid(): string;
    public function getBid(int $index): string;
    public function getContract(): string;
    public function getFirstColorBidInPairForBid(string $bid): string;
}
