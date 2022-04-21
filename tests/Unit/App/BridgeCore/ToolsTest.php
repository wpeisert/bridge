<?php

namespace Tests\Unit\App\Services\Deal;

use App\BridgeCore\Tools;
use Tests\TestCase;

class ToolsTest extends TestCase
{
    public function test_some_correct_cases()
    {
        $this->assertEquals(0, Tools::card2number('AS'));
        $this->assertEquals(13, Tools::card2number('AH'));
        $this->assertEquals(12, Tools::card2number('2S'));
    }
    public function test_all_correct_cases()
    {
        for ($iter = 0; $iter < 52; ++$iter) {
            $this->assertEquals($iter, Tools::card2number(Tools::number2card($iter)));
        }
    }
}
