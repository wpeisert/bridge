<?php

namespace Tests\Unit\App\Services\Deal;

use App\Services\Contract\Contract;
use App\Services\Contract\ContractService;
use App\Services\Contract\ContractValueService;
use Tests\TestCase;

class ContractServiceTest extends TestCase
{
    /**
     * @dataProvider dataProvider_isLower
     *
     * @return void
     */
    public function test_isLower(int $level1, string $bidColor1, int $level2, string $bidColor2, $isLower)
    {
        $contract1 = Contract::create(
            [
                'bidColor' => $bidColor1,
                'level' => $level1,
            ]
        );
        $contract2 = Contract::create(
            [
                'bidColor' => $bidColor2,
                'level' => $level2,
            ]
        );
        $service = new ContractService(new ContractValueService());
        $this->assertSame($isLower, $service->isLower($contract1, $contract2));
    }

    public function dataProvider_isLower()
    {
        return [
            [1, 's', 1, 's', false],
            [1, 's', 2, 's', true],
            [2, 's', 1, 's', false],
            [2, 'c', 2, 's', true],
            [2, 'd', 2, 's', true],
            [2, 'h', 2, 's', true],
            [2, 'nt', 2, 's', false],
        ];
    }
}
