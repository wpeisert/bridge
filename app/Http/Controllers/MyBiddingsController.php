<?php

namespace App\Http\Controllers;

use App\Models\Bidding;
use App\Services\Training\TrainingQueryBuilderInterface;
use App\Services\BiddingParser\BiddingParserFactoryInterface;
use App\Services\Training\TrainingServiceInterface;
use Illuminate\Support\Facades\Auth;

class MyBiddingsController extends Controller
{
    public function __construct(
        private TrainingQueryBuilderInterface $trainingQueryBuilder,
        private BiddingParserFactoryInterface $biddingParserFactory,
        private TrainingServiceInterface $trainingService
    ) {}

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $activeTrainings = $this->trainingService->splitUserTrainings(
            $this->trainingQueryBuilder->getUserTrainingsActive($userId, true)->get()->all()
        );
        $finishedTrainings = $this->trainingQueryBuilder->getUserTrainingsActive($userId, false)->get()->all();

        header("Refresh:5");
        $biddingParser = $this->biddingParserFactory;
        return view('mytrainings.mytrainings', compact('activeTrainings', 'finishedTrainings', 'biddingParser'));
    }

    public function bidding(Bidding $bidding)
    {
        return view(
            'mytrainings.mybidding',
            ['bidding' => $bidding]
        );
    }

    public function create()
    {
        return view(
            'mytrainings.mybidding_create'
        );
    }

    public function next(Bidding $bidding)
    {
        $nextBidding = $this->trainingService->getNextBiddingInTraining($bidding);
        return redirect()->route('mybidding', $nextBidding->id);
    }

    public function nextbid(?Bidding $bidding = null)
    {
/*
        $userId = Auth::id();
        $nextBidding = $this->trainingQueryBuilder->getNextUserActiveBidding($userId, $bidding);
        if ($nextBidding) {
            return redirect()->route('mybidding', $nextBidding->id);
        }
*/
        return redirect()->route('dashboard');
    }
}
