<?php

namespace App\Http\Controllers;

use App\Models\Bidding;
use App\Repositories\TrainingRepositoryInterface;
use App\Services\BiddingParser\BiddingParserFactoryInterface;
use Illuminate\Support\Facades\Auth;

class MyBiddingsController extends Controller
{
    public function __construct(
        private TrainingRepositoryInterface $trainingRepository,
        private BiddingParserFactoryInterface $biddingParserFactory
    ) {}

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $activeTrainings = $this->trainingRepository->splitUserTrainings(
            $this->trainingRepository->getUserTrainings($userId, true)
        );
        $finishedTrainings = $this->trainingRepository->getUserTrainings($userId, false);

        header("Refresh:5");
        $biddingParser = $this->biddingParserFactory;
        return view('bridge.mytrainings', compact('activeTrainings', 'finishedTrainings', 'biddingParser'));
    }

    public function bidding(Bidding $bidding)
    {
        return view(
            'bridge.mybidding',
            ['bidding' => $bidding]
        );
    }

    public function create()
    {
        return view(
            'bridge.mybidding_create'
        );
    }

    public function next()
    {
        return redirect()->route('dashboard');
    }
}
