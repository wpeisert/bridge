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
}
