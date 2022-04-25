<?php

namespace App\Http\Controllers;

use App\Models\Bidding;
use App\Repositories\TrainingQueryBuilderInterface;
use App\Services\BiddingParser\BiddingParserFactoryInterface;
use Illuminate\Support\Facades\Auth;

class MyBiddingsController extends Controller
{
    public function __construct(
        private TrainingQueryBuilderInterface $trainingRepository,
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
            $this->trainingRepository->getUserTrainingsActive($userId, true)->get()->all()
        );
        $finishedTrainings = $this->trainingRepository->getUserTrainingsActive($userId, false)->get()->all();

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

    public function next(Bidding $bidding)
    {
        $nextBidding = $this->trainingRepository->getNextBiddingInTraining($bidding);
        return redirect()->route('mybidding', $nextBidding->id);
    }

    public function nextbid(?Bidding $bidding = null)
    {
/*
        $userId = Auth::id();
        $nextBidding = $this->trainingRepository->getNextUserActiveBidding($userId, $bidding);
        if ($nextBidding) {
            return redirect()->route('mybidding', $nextBidding->id);
        }
*/
        return redirect()->route('dashboard');
    }
}
