<?php

namespace Tests\Unit\App\Services\Deal;

use App\Services\EvaluatedContractsFilters\DblRdbl;
use Tests\TestCase;

class DblRdblTest extends TestCase
{
    /**
     * @dataProvider getRemainingIndices_dataProvider
     */
    public function test_getRemainingIndices(array $data, array $result)
    {
        $dblRdbl = new DblRdbl();
        $this->assertEquals($result, $dblRdbl->getRemainingIndices(...$data));
    }

    public function getRemainingIndices_dataProvider()
    {
        return [
            // basic situation, when nothing is being changed
            [ [null, null, null], [] ],
            [ [100, null, null], [0] ],
            [ [null, 100, null], [1] ],
            [ [null, null, 100], [2] ],
            [ [100, null, 100], [0, 2] ],
            // '' and 'dbl'
            [ [100, 200, null], [0] ],
            [ [100, 50, null], [1] ],
            // 'dbl' and 'rdbl'
            [ [null, 200, 300], [2] ],
            [ [null, 200, 100], [1] ],
            // all
            [ [100, 200, 300], [0] ],
            [ [100, 50, 300], [0] ],
            [ [100, 50, 0], [1] ],
            [ [100, 50, 80], [2] ],
        ];
    }
}
