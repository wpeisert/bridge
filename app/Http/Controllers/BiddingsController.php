<?php

namespace App\Http\Controllers;

use App\Repositories\TrainingRepositoryInterface;
use App\Services\BiddingParser\BiddingParserFactoryInterface;
use Illuminate\Support\Facades\Auth;

class BiddingsController extends Controller
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
        return view('bridge.trainings', compact('activeTrainings', 'finishedTrainings', 'biddingParser'));
        return view('bridge.trainings', compact('activeTrainings', 'finishedTrainings'));
    }
}
