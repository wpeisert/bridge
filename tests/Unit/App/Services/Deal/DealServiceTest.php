<?php

namespace Tests\Unit\App\Services\Deal;

use App\Services\Deal\DealService;
use Tests\TestCase;

class DealServiceTest extends TestCase
{
    /**
     * @dataProvider pcDataProvider
     *
     * @return void
     */
    public function test_PC(string $cards, int $pc)
    {
        $service = new DealService();
        $this->assertSame($pc, $service->getPC($cards));
    }

    public function pcDataProvider()
    {
        return [
            ['', 0],
            ['...', 0],
            ['A', 4],
            ['K', 3],
            ['Q', 2],
            ['J', 1],
            ['T', 0],
            ['AK.QJ.AK.QJ', 20],
            ['A.5432.5432.5432', 4],
            ['AKQJAKQJTAKQJAKQJT7', 40],
        ];
    }

    /**
     * @dataProvider cardsCountDataProvider
     *
     * @return void
     */
    public function test_cards_count(string $cards, int $colorNo, int $cnt)
    {
        $service = new DealService();
        $this->assertSame($cnt, $service->getCardsCount($cards, $colorNo));
    }

    public function cardsCountDataProvider()
    {
        return [
            ['32..5432.8765432', 0, 2],
            ['2..4321.98765432', 1, 0],
            ['2..4321.98765432', 2, 4],
            ['2..4321.98765432', 3, 8],
        ];
    }
}
