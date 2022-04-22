<?php

namespace Tests\Unit\App\Services\Deal;

use App\Services\Hands\Cards;
use Tests\TestCase;

class CardsTest extends TestCase
{
    public function test_constructor()
    {
        $cards = new Cards('qwe');
        $this->assertEquals('qwe', $cards);
    }

    /**
     * @dataProvider setFromNumbersDataProvider
     */
    public function test_setFromNumbers(array $cardsNumbers, string $cardsStr)
    {
        $cards = new Cards();
        $cards->setFromNumbers($cardsNumbers);
        $this->assertEquals($cardsStr, $cards);
    }

    public function setFromNumbersDataProvider()
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
     * @dataProvider getAsNumbersDataProvider
     */
    public function test_getAsNumbers(string $cardsStr, array $cardsNumbers)
    {
        $cards = new Cards($cardsStr);
        $this->assertEquals($cardsNumbers, $cards->getAsNumbers());
    }

    public function getAsNumbersDataProvider()
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
        $cards = new Cards();
        $newNumbers = $cards->setFromNumbers($cardsNumbers)->getAsNumbers();
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
