<?php

namespace Tests\Unit\App\Services\Deal;

use App\Services\Contract\Contract;
use App\Services\Contract\ContractValueService;
use Tests\TestCase;

class ContractValueServiceTest extends TestCase
{
    /**
     * @dataProvider contractExpectedValues
     *
     * @return void
     */
    public function test_calculateContractExpectedValue(
        string $declarer, string $bidColor, int $level, string $type, bool $vulnerable,
        array $tricksProbabilities,
        float $expectedValue
    ) {
        $contract = Contract::create(
            [
                'declarer' => $declarer,
                'bidColor' => $bidColor,
                'level' => $level,
                'type' => $type,
                'vulnerable' => $vulnerable,
            ]
        );
        $service = new ContractValueService();
        $this->assertSame($expectedValue, $service->calculateContractExpectedValue($contract, $tricksProbabilities));
    }

    public function contractExpectedValues()
    {
        return [
            ['N', 's', 4, '', false, [0,0,0,0,0,0,0,0,0,0.5,0.5,0,0,0], 185.0],
            ['N', 's', 4, 'dbl', false, [0,0,0,0,0,0,0,0,0,0.5,0.5,0,0,0], 245.0],
            ['N', 's', 4, '', true, [0,0,0,0,0,0,0,0,0,0.5,0.5,0,0,0], 260.0],
            ['E', 's', 4, '', true, [0,0,0,0,0,0,0,0,0,0.5,0.5,0,0,0], -260.0],
            ['N', 's', 4, 'dbl', true, [0,0,0,0,0,0,0,0,0,0.5,0.5,0,0,0], 295.0],

            ['N', 's', 4, '', false, [9 => 0.5, 10 => 0.5], 185.0],

            ['N', 'd', 6, '', false, [0,0,0,0,0,0,0,0,0,0,0,0,1,0], 920.0],
            ['N', 'd', 6, '', false, [0,0,0,0,0,0,0,0,0,0,0,1,0,0], -50],
            ['N', 'd', 6, '', false, [0,0,0,0,0,0,0,0,0,0,0,0.3,0.7,0], 629.0],
        ];
    }

    /**
     * @dataProvider contractValues
     *
     * @return void
     */
    public function test_getContractValue(string $declarer, string $bidColor, int $level, int $tricks, string $type, bool $vulnerable, int $value)
    {
        $contract = Contract::create(
            [
                'declarer' => $declarer,
                'bidColor' => $bidColor,
                'level' => $level,
                'type' => $type,
                'vulnerable' => $vulnerable,
            ]
        );
        $service = new ContractValueService();
        $this->assertSame($value, $service->getContractValue($contract, $tricks));
        $this->assertSame($value, intval($service->calculateContractExpectedValue($contract, [$tricks => 1])));
    }

    public function contractValues()
    {
        return [
            // simple contract
            ['N', 'c', 1, 7, '', false, 70],
            ['E', 'c', 1, 7, '', false, -70],
            ['S', 'c', 1, 7, '', false, 70],
            ['W', 'c', 1, 7, '', false, -70],

            ['N', 'c', 1, 7, '', true, 70],
            ['E', 'c', 1, 7, '', true, -70],
            ['S', 'c', 1, 7, '', true, 70],
            ['W', 'c', 1, 7, '', true, -70],
            // one down, no dbl
            ['N', 'c', 1, 6, '', false, -50],
            ['E', 'c', 1, 6, '', false, 50],
            ['S', 'c', 1, 6, '', false, -50],
            ['W', 'c', 1, 6, '', false, 50],

            ['N', 'c', 1, 6, '', true, -100],
            ['E', 'c', 1, 6, '', true, 100],
            ['S', 'c', 1, 6, '', true, -100],
            ['W', 'c', 1, 6, '', true, 100],
            // one down, dbl
            ['N', 'c', 1, 6, 'dbl', false, -100],
            ['E', 'c', 1, 6, 'dbl', false, 100],
            ['S', 'c', 1, 6, 'dbl', false, -100],
            ['W', 'c', 1, 6, 'dbl', false, 100],

            ['N', 'c', 1, 6, 'dbl', true, -200],
            ['E', 'c', 1, 6, 'dbl', true, 200],
            ['S', 'c', 1, 6, 'dbl', true, -200],
            ['W', 'c', 1, 6, 'dbl', true, 200],
            // one down, rdbl
            ['N', 'c', 1, 6, 'rdbl', false, -200],
            ['E', 'c', 1, 6, 'rdbl', false, 200],
            ['S', 'c', 1, 6, 'rdbl', false, -200],
            ['W', 'c', 1, 6, 'rdbl', false, 200],

            ['N', 'c', 1, 6, 'rdbl', true, -400],
            ['E', 'c', 1, 6, 'rdbl', true, 400],
            ['S', 'c', 1, 6, 'rdbl', true, -400],
            ['W', 'c', 1, 6, 'rdbl', true, 400],


            // two down
            ['N', 'c', 1, 5, '', false, -100],
            ['N', 'c', 1, 5, '', true, -200],
            ['N', 'c', 1, 5, 'dbl', false, -300],
            ['N', 'c', 1, 5, 'dbl', true, -500],
            ['N', 'c', 1, 5, 'rdbl', false, -600],
            ['N', 'c', 1, 5, 'rdbl', true, -1000],
            // three down
            ['N', 'c', 1, 4, '', false, -150],
            ['N', 'c', 1, 4, '', true, -300],
            ['N', 'c', 1, 4, 'dbl', false, -500],
            ['N', 'c', 1, 4, 'dbl', true, -800],
            ['N', 'c', 1, 4, 'rdbl', false, -1000],
            ['N', 'c', 1, 4, 'rdbl', true, -1600],
            // four down
            ['N', 'c', 1, 3, '', false, -200],
            ['N', 'c', 1, 3, '', true, -400],
            ['N', 'c', 1, 3, 'dbl', false, -800],
            ['N', 'c', 1, 3, 'dbl', true, -1100],
            ['N', 'c', 1, 3, 'rdbl', false, -1600],
            ['N', 'c', 1, 3, 'rdbl', true, -2200],
            // five down
            ['N', 'c', 1, 2, '', false, -250],
            ['N', 'c', 1, 2, '', true, -500],
            ['N', 'c', 1, 2, 'dbl', false, -1100],
            ['N', 'c', 1, 2, 'dbl', true, -1400],
            ['N', 'c', 1, 2, 'rdbl', false, -2200],
            ['N', 'c', 1, 2, 'rdbl', true, -2800],

            // made
            ['N', 'c', 1, 7, '', false, 70],
            ['N', 'c', 1, 7, '', true, 70],
            ['N', 'c', 1, 7, 'dbl', false, 140],
            ['N', 'c', 1, 7, 'dbl', true, 140],
            ['N', 'c', 1, 7, 'rdbl', false, 230],
            ['N', 'c', 1, 7, 'rdbl', true, 230],

            // +1
            ['N', 'c', 1, 8, '', false, 90],
            ['N', 'c', 1, 8, '', true, 90],
            ['N', 'c', 1, 8, 'dbl', false, 240],
            ['N', 'c', 1, 8, 'dbl', true, 340],
            ['N', 'c', 1, 8, 'rdbl', false, 430],
            ['N', 'c', 1, 8, 'rdbl', true, 630],

            // +2
            ['N', 'c', 1, 9, '', false, 110],
            ['N', 'c', 1, 9, '', true, 110],
            ['N', 'c', 1, 9, 'dbl', false, 340],
            ['N', 'c', 1, 9, 'dbl', true, 540],
            ['N', 'c', 1, 9, 'rdbl', false, 630],
            ['N', 'c', 1, 9, 'rdbl', true, 1030],

            // level = 1
            ['N', 'c', 1, 7, '', false, 70],
            ['N', 'd', 1, 7, '', false, 70],
            ['N', 'h', 1, 7, '', false, 80],
            ['N', 's', 1, 7, '', false, 80],
            ['N', 'nt', 1, 7, '', false, 90],

            // level = 2
            ['N', 'c', 2, 8, '', false, 90],
            ['N', 'd', 2, 8, '', false, 90],
            ['N', 'h', 2, 8, '', false, 110],
            ['N', 's', 2, 8, '', false, 110],
            ['N', 'nt', 2, 8, '', false, 120],

            // level = 3
            ['N', 'c', 2, 9, '', false, 110],
            ['N', 'd', 2, 9, '', false, 110],
            ['N', 'h', 2, 9, '', false, 140],
            ['N', 's', 2, 9, '', false, 140],
            ['N', 'nt', 2, 9, '', false, 150],

            // non game
            ['N', 'c', 4, 11, '', false, 150],
            ['N', 'd', 4, 11, '', false, 150],
            ['N', 'h', 3, 10, '', false, 170],
            ['N', 's', 3, 10, '', false, 170],
            ['N', 'nt', 2, 9, '', false, 150],
            // game, non vulnerable
            ['N', 'c', 5, 11, '', false, 400],
            ['N', 'd', 5, 11, '', false, 400],
            ['N', 'h', 4, 10, '', false, 420],
            ['N', 's', 4, 10, '', false, 420],
            ['N', 'nt', 3, 9, '', false, 400],
            // game, vulnerable
            ['N', 'c', 5, 11, '', true, 600],
            ['N', 'd', 5, 11, '', true, 600],
            ['N', 'h', 4, 10, '', true, 620],
            ['N', 's', 4, 10, '', true, 620],
            ['N', 'nt', 3, 9, '', true, 600],

            // small slam, non vulnerable
            ['N', 'c', 6, 12, '', false, 920],
            ['N', 'd', 6, 12, '', false, 920],
            ['N', 'h', 6, 12, '', false, 980],
            ['N', 's', 6, 12, '', false, 980],
            ['N', 'nt', 6, 12, '', false, 990],
            // small slam, vulnerable
            ['N', 'c', 6, 12, '', true, 1370],
            ['N', 'd', 6, 12, '', true, 1370],
            ['N', 'h', 6, 12, '', true, 1430],
            ['N', 's', 6, 12, '', true, 1430],
            ['N', 'nt', 6, 12, '', true, 1440],

            // slam, non vulnerable
            ['N', 'c', 7, 13, '', false, 1440],
            ['N', 'd', 7, 13, '', false, 1440],
            ['N', 'h', 7, 13, '', false, 1510],
            ['N', 's', 7, 13, '', false, 1510],
            ['N', 'nt', 7, 13, '', false, 1520],
            // slam, vulnerable
            ['N', 'c', 7, 13, '', true, 2140],
            ['N', 'd', 7, 13, '', true, 2140],
            ['N', 'h', 7, 13, '', true, 2210],
            ['N', 's', 7, 13, '', true, 2210],
            ['N', 'nt', 7, 13, '', true, 2220],
        ];
    }
}
