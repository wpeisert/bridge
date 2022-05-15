<?php

namespace Tests\Unit\App\Services\Deal;

use App\Services\Hands\CardsService;
use Tests\TestCase;

class CardsServiceTest extends TestCase
{
    /**
     * @dataProvider numbers2stringDataProvider
     */
    public function test_numbers2string(array $cardsNumbers, string $cardsStr)
    {
        $cardsService = new CardsService();
        $this->assertEquals($cardsStr, $cardsService->numbers2string($cardsNumbers));
    }

    public function numbers2stringDataProvider()
    {
        return [
            [[], '...'],
            [[0], 'A...'],
            [[1], 'K...'],
            [[12], '2...'],
            [[13], '.A..'],
            [[26], '..A.'],
            [[39], '...A'],
            [[51], '...2'],
            [[41, 51, 2], 'Q...Q2'],
            [[0, 3, 1, 4, 41, 51, 2], 'AKQJT...Q2'],
        ];
    }

    /**
     * @dataProvider string2numbersDataProvider
     */
    public function test_getAsNumbers(string $cardsStr, array $cardsNumbers)
    {
        $cardsService = new CardsService();
        $this->assertEquals($cardsNumbers, $cardsService->string2numbers($cardsStr));
    }

    public function string2numbersDataProvider()
    {
        return [
            ['', []],
            ['.', []],
            ['..', []],
            ['...', []],
            ['....rewew', []],
            ['A...', [0]],
            ['K...', [1]],
            ['2...', [12]],
            ['.A..', [13]],
            ['..A.', [26]],
            ['...A', [39]],
            ['...2', [51]],
        ];
    }


    /**
     * @dataProvider variousDataProvider
     */
    public function test_some_random_numbers_should_be_converted_properly(array $cardsNumbers)
    {
        $cardsService = new CardsService();
        $newNumbers = $cardsService->string2numbers($cardsService->numbers2string($cardsNumbers));
        sort($cardsNumbers);
        sort($newNumbers);
        $this->assertEquals($cardsNumbers, $newNumbers);
    }

    public function variousDataProvider()
    {
        return [
            [[0, 1, 2]],
            [[7, 8, 2]],
            [[41, 51, 2]],
        ];
    }
}
