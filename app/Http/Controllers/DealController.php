<?php

namespace App\Http\Controllers;

use App\Events\DealCreatedEvent;
use App\Models\Deal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DealController extends Controller
{
    private const MAX_PER_PAGE = 15;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $deals = Deal::latest()->paginate(self::MAX_PER_PAGE);
        return view('deals.index',compact('deals'))
            ->with('i', (request()->input('page', 1) - 1) * self::MAX_PER_PAGE);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('deals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required'
        ]);

        $deal = Deal::create($request->all());
        DealCreatedEvent::dispatch($deal);

        return redirect()->route('deals.index')
            ->with('success','Deal created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Deal  $deal
     * @return Response
     */
    public function show(Deal $deal)
    {
        return view('deals.show', compact('deal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Deal  $deal
     * @return Response
     */
    public function edit(Deal $deal)
    {
        return view('deals.edit', compact('deal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Deal  $deal
     * @return Response
     */
    public function update(Request $request, Deal $deal)
    {
        $request->validate([
            'description' => 'required'
        ]);

        $deal->update($request->all());

        return redirect()->route('deals.index')
            ->with('success','Deal updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Deal  $deal
     * @return Response
     */
    public function destroy(Deal $deal)
    {
        $deal->delete();

        return redirect()->route('deals.index')
            ->with('success','Deal deleted successfully');
    }
}
