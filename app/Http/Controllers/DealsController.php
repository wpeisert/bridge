<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DealsController extends Controller
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
            'bridge.deals',
            [
                'currentDeals' => $this->getFakeDeals(),
                'finishedDeals' => $this->getFakeDeals(),
            ]
        );
    }

    /**
     * @return array[]
     */
    private function getFakeDeals(): array
    {
        return
            [
                [
                    'partner_name' => 'Daro',
                    'deals' => [
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
                    'deals' => [
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
