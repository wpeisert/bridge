<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BiddingController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(int $id)
    {
        return view(
            'bridge.bidding',
            ['id' => $id]
        );
    }
}
