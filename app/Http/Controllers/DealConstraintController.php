<?php

namespace App\Http\Controllers;

use App\Models\DealConstraint;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DealConstraintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $dealConstraints = DealConstraint::latest()->paginate(5);
        return view('deal_constraints.index',compact('dealConstraints'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('deal_constraints.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        DealConstraint::create($request->all());

        return redirect()->route('deal_constraints.index')
            ->with('success','Deal constraints created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param DealConstraint $dealConstraint
     * @return Response
     */
    public function show(DealConstraint $dealConstraint)
    {
        return view('deal_constraints.show', compact('dealConstraint'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param DealConstraint $dealConstraint
     * @return Response
     */
    public function edit(DealConstraint $dealConstraint)
    {
        return view('deal_constraints.edit', compact('dealConstraint'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param DealConstraint $dealConstraint
     * @return Response
     */
    public function update(Request $request, DealConstraint $dealConstraint)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $dealConstraint->update($request->all());

        return redirect()->route('deal_constraints.index')
            ->with('success','Deal constraints updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DealConstraint $dealConstraint
     * @return Response
     */
    public function destroy(DealConstraint $dealConstraint)
    {
        $dealConstraint->delete();

        return redirect()->route('deal_constraints.index')
            ->with('success','Deal constraints deleted successfully');
    }
}
