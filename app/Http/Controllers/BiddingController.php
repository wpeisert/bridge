<?php

namespace App\Http\Controllers;

use App\BridgeCore\Tools;
use App\Events\BidExpectedEvent;
use App\Http\Requests\StoreBiddingRequest;
use App\Http\Requests\UpdateBiddingRequest;
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
     * @param  \App\Http\Requests\StoreBiddingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBiddingRequest $request)
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
        $possibleBids = $this->ruleChecker->getPossibleBids($bidding);
        return view('biddings.edit', compact('bidding', 'possibleBids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBiddingRequest  $request
     * @param  \App\Models\Bidding  $bidding
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBiddingRequest $request, Bidding $bidding)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\UpdateBiddingRequest  $request
     * @param  \App\Models\Bidding  $bidding
     * @return \Illuminate\Http\Response
     */
    public function placeBid(UpdateBiddingRequest $request, Bidding $bidding)
    {
        $bidTxt = $request->get('bid');

        if (!in_array($bidTxt, $this->ruleChecker->getPossibleBids($bidding))) {
            return redirect()->route('biddings.edit', [$bidding->id])
                ->with('danger',"Bid " . Tools::decorateBid($bidTxt) . " illegal, user id: " . Auth::id() . ' name: ' . Auth::user()->name);
        }

        $this->biddingService->placeBid($bidding, array_merge($request->all(), ['user_id' => Auth::id()]));

        return redirect()->route('biddings.edit', [$bidding->id])
            ->with('success',"Bid " . Tools::decorateBid($bidTxt) . " placed successfully, user id: " . Auth::id() . ' name: ' . Auth::user()->name);
    }
}
