<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BiddingsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view(
            'bridge.biddings',
            [
                'currentBiddings' => $this->getFakeBiddings(),
                'finishedBiddings' => $this->getFakeBiddings(),
            ]
        );
    }

    /**
     * @return array[]
     */
    private function getFakeBiddings(): array
    {
        return
            [
                [
                    'partner_name' => 'Daro',
                    'biddings' => [
                        [
                            'status' => 'my_bid',
                            'id' => 123,
                        ],
                        [
                            'status' => 'partner_bid',
                            'id' => 456,
                        ],
                        [
                            'status' => 'my_bid',
                            'id' => 789,
                        ],
                        [
                            'status' => 'partner_bid',
                            'id' => 234,
                        ],
                    ],
                ],
                [
                    'partner_name' => 'Zenon',
                    'biddings' => [
                        [
                            'status' => 'partner_bid',
                            'id' => 123,
                        ],
                        [
                            'status' => 'partner_bid',
                            'id' => 456,
                        ],
                        [
                            'status' => 'my_bid',
                            'id' => 789,
                        ],
                        [
                            'status' => 'partner_bid',
                            'id' => 234,
                        ],
                    ],
                ],
            ]
        ;
    }
}
