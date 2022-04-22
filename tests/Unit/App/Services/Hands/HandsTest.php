<?php

namespace Tests\Unit\App\Services\Deal;

use App\Services\Hands\Hands;
use Tests\TestCase;

class HandsTest extends TestCase
{
    public function test_should_construct_empty_hands_for_no_constructor_argument()
    {
        $hands = new Hands();
        $this->assertEquals('', $hands->getHand('N'));
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_should_construct_hands(string $playerName, string $cards)
    {
        $hands = new Hands([$playerName => $cards]);
        $this->assertEquals($cards, $hands->getHand($playerName));
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_should_set_hand_for_player(string $playerName, string $cards)
    {
        $hands = new Hands();
        $hands->setHand($playerName, $cards);
        $this->assertEquals($cards, $hands->getHand($playerName));
    }

    public function test_should_fail_on_setting_hand_for_incorrent_player_name()
    {
        $this->expectException(\Exception::class);
        $hands = new Hands();
        $hands->setHand('n', 'rty');
    }

    public function dataProvider()
    {
        return [
            ['N', 'AK.QJ.AK.QJ'],
            ['E', 'A.5432.5432.5432'],
            ['S', 'AKQJAKQJTAKQJAKQJT7'],
            ['W', '765432'],
        ];
    }
}
