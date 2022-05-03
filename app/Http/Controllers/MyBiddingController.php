<?php

namespace App\Http\Controllers;

use App\BridgeCore\Tools;
use App\Models\Bidding;
use App\Models\DealConstraint;
use App\Models\Quiz;
use App\Models\Training;
use App\Models\User;
use App\Services\Bidding\BiddingServiceInterface;
use App\Services\Bidding\RuleCheckerInterface;
use App\Services\Quiz\QuizBuilderInterface;
use App\Services\Training\TrainingGeneratorInterface;
use App\Services\Training\TrainingQueryBuilderInterface;
use App\Services\BiddingParser\BiddingParserFactoryInterface;
use App\Services\Training\TrainingServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MyBiddingController extends Controller
{
    public function __construct(
        private TrainingQueryBuilderInterface $trainingQueryBuilder,
        private BiddingParserFactoryInterface $biddingParserFactory,
        private TrainingServiceInterface $trainingService,
        private QuizBuilderInterface $quizBuilder,
        private TrainingGeneratorInterface $trainingGenerator,
        private RuleCheckerInterface $ruleChecker,
        private BiddingServiceInterface $biddingService
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
        return view('mybidding.index', compact('activeTrainings', 'finishedTrainings', 'biddingParser'));
    }

    public function bidding(Bidding $bidding)
    {
        $possibleBids = [];
        if ($this->biddingService->canUserPlaceBid($bidding, Auth::id())) {
            $possibleBids = $this->ruleChecker->getPossibleBids($bidding);
        } else {
            if (!$bidding->is_finished) {
                header("Refresh:5");
            }
        }
        return view('mybidding.mybidding', compact('bidding', 'possibleBids'));
    }

    public function create()
    {
        $users = User::all();
        return view('mybidding.create', compact('users'));
    }

    public function next(Bidding $bidding)
    {
        $nextBidding = $this->trainingService->getNextBiddingInTraining($bidding);
        return redirect()->route('mybidding', $nextBidding->id);
    }

    public function nextbid(?Bidding $bidding = null)
    {
        if ($bidding) {
            return redirect()->route('mybidding.next', $bidding->id);
        }

        return redirect()->route('dashboard');
    }

    public function start(Request $request)
    {
        $params = $request->all();

        $dealConstraints = DealConstraint::create($params);
        $params['deal_constraint_id'] = $dealConstraints->id;
        $quiz = Quiz::create($params);
        $params['quiz_id'] = $quiz->id;
        $createdDealsCount = $this->quizBuilder->build($quiz);
        $training = Training::create($params);
        $startedBiddingsCount = $this->trainingGenerator->generate($training);

        return redirect()->route('dashboard')
            ->with('success', $startedBiddingsCount . ' biddings started successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @param  \App\Models\Bidding  $bidding
     * @return \Illuminate\Http\Response
     */
    public function placeBid(Request $request, Bidding $bidding)
    {
        $bidTxt = $request->get('bid');

        if (!$this->biddingService->canPlaceBid($bidding, Auth::id(), $bidTxt)) {
            return redirect()->route('mybidding', [$bidding->id])
                ->with('danger',"Bid " . Tools::decorateBid($bidTxt) . " illegal, user id: " . Auth::id() . ' name: ' . Auth::user()->name);
        }
        $this->biddingService->placeBid($bidding, array_merge($request->all(), ['user_id' => Auth::id()]));

        return redirect()->route('mybidding', [$bidding->id])
            ->with('success',"Bid " . Tools::decorateBid($bidTxt) . " placed successfully, user id: " . Auth::id() . ' name: ' . Auth::user()->name);
    }
}
