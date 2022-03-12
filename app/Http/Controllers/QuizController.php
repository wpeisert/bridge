<?php

namespace App\Http\Controllers;

use App\Models\DealConstraint;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $quizzes = Quiz::latest()->paginate(5);
        return view('quizzes.index',compact('quizzes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $dealConstraints = DealConstraint::all();
        return view('quizzes.create', compact('dealConstraints'));
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
            'description' => 'required',
        ]);

        Quiz::create($request->all());

        return redirect()->route('quizzes.index')
            ->with('success','Quiz created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Quiz $quiz
     * @return Response
     */
    public function show(Quiz $quiz)
    {
        return view('quizzes.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Quiz $quiz
     * @return Response
     */
    public function edit(Quiz $quiz)
    {
        $dealConstraints = DealConstraint::all();
        return view('quizzes.edit', compact('quiz', 'dealConstraints'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Quiz $quiz
     * @return Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $quiz->update($request->all());

        return redirect()->route('quizzes.index')
            ->with('success','Quiz updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Quiz $quiz
     * @return Response
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('quizzes.index')
            ->with('success','Quiz deleted successfully');
    }

    public function generateDeals(Quiz $quiz)
    {
        return redirect()->route('quizzes.index')
            ->with('success','10 deals generated successfully');
    }
}
