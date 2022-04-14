<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBiddingRequest;
use App\Http\Requests\UpdateBiddingRequest;
use App\Models\Bid;
use App\Models\Bidding;

class BiddingController extends Controller
{
    private const MAX_PER_PAGE = 10;

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
        return view('biddings.edit', compact('bidding'));
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
        $bid = new Bid(['bid' => '6h']);
        $bidding->bids()->save($bid);

        return redirect()->route('biddings.edit', [$bidding->id])
            ->with('success','Bid placed successfully');
    }
}
