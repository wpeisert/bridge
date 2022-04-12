<?php

namespace App\Http\Controllers;

use App\Interfaces\BiddingRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiddingsController extends Controller
{
    public function __construct(protected BiddingRepositoryInterface $biddingRepository)
    {
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $preparing = $this->biddingRepository->getUserAllBiddings(Auth::user(), 'preparing');
        $pending = $this->biddingRepository->getUserAllBiddings(Auth::user(), 'pending');
        $finished = $this->biddingRepository->getUserAllBiddings(Auth::user(), 'finished');

        return view('bridge.biddings',
            [
                'allBiddings' => [
                    [
                        'title' => 'Current biddings',
                        'biddingsByUser' => [['partner_name' => 'XX Zenon XX', 'biddings' => $pending]]
                    ],
                    [
                        'title' => 'Preparing biddings',
                        'biddingsByUser' => [['partner_name' => 'XX Zenon XX', 'biddings' => $preparing]]
                    ],
                    [
                        'title' => 'Finished biddings',
                        'biddingsByUser' => [['partner_name' => 'XX Zenon XX', 'biddings' => $finished]]
                    ],
                ],
            ]
        );
    }
}
