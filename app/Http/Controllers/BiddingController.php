<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidding;
use App\Services\Bidding\BiddingServiceInterface;
use App\Services\Bidding\RuleCheckerInterface;
use Illuminate\Support\Facades\Auth;

class BiddingController extends Controller
{
    private const MAX_PER_PAGE = 10;

    public function __construct(
        private RuleCheckerInterface $ruleChecker,
        private BiddingServiceInterface $biddingService
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $biddings = Bidding::latest()->paginate(self::MAX_PER_PAGE);
        return view('biddings.index',compact('biddings'))
            ->with('i', (request()->input('page', 1) - 1) * self::MAX_PER_PAGE);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bidding  $bidding
     * @return \Illuminate\Http\Response
     */
    public function show(Bidding $bidding)
    {
        return view(
            'biddings.show',
            ['bidding' => $bidding]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bidding  $bidding
     * @return \Illuminate\Http\Response
     */
    public function edit(Bidding $bidding)
    {
        $possibleBids = [];
        if ($this->biddingService->canUserPlaceBid($bidding, Auth::id())) {
            $possibleBids = $this->ruleChecker->getPossibleBids($bidding);
        } else {
            if (!$bidding->is_finished) {
                header("Refresh:5");
            }
        }
        return view('biddings.edit', compact('bidding', 'possibleBids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  \App\Models\Bidding  $bidding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bidding $bidding)
    {
        //
    }
}
