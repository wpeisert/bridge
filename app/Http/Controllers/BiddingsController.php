<?php

namespace App\Http\Controllers;

use App\Repositories\TrainingRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class BiddingsController extends Controller
{
    public function __construct(protected TrainingRepositoryInterface $trainingRepository)
    {
    }

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
        return view('bridge.trainings', compact('activeTrainings', 'finishedTrainings'));
    }
}
