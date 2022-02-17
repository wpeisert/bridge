<?php

namespace App\Http\Controllers;

use App\Interfaces\BiddingRepositoryInterface;
use App\Models\User;
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
                        'title' => 'Licytacje bieżące',
                        'biddingsByUser' => [['partner_name' => 'XX Zenon XX', 'biddings' => $pending]]
                    ],
                    [
                        'title' => 'Licytacje oczekujące',
                        'biddingsByUser' => [['partner_name' => 'XX Zenon XX', 'biddings' => $preparing]]
                    ],
                    [
                        'title' => 'Licytacje zakończone',
                        'biddingsByUser' => [['partner_name' => 'XX Zenon XX', 'biddings' => $finished]]
                    ],
                ],
            ]
        );
    }
}
