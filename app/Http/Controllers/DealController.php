<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $deals = Deal::latest()->paginate(5);
        return view('deals.index',compact('deals'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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

        Deal::create($request->all());

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
