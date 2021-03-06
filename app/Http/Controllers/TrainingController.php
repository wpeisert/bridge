<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Training;
use App\Models\User;
use App\Services\Training\TrainingGeneratorInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TrainingController extends Controller
{
    public function __construct(private TrainingGeneratorInterface $trainingGenerator) {}

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $trainings = Training::latest()->paginate(5);
        return view('trainings.index',compact('trainings'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $quizzes = Quiz::all();
        $users = User::all();

        return view('trainings.create', compact('quizzes', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Training::create($request->all());

        return redirect()->route('trainings.index')
            ->with('success','Training created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Training $training
     * @return Response
     */
    public function show(Training $training)
    {
        $quizzes = Quiz::all();
        $users = User::all();

        return view('trainings.show', compact('training', 'quizzes', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Training $training
     * @return Response
     */
    public function edit(Training $training)
    {
        $quizzes = Quiz::all();
        $users = User::all();

        return view('trainings.edit', compact('training', 'quizzes', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Training $training
     * @return Response
     */
    public function update(Request $request, Training $training)
    {
        if ($training->isStarted()) {
            return redirect()->route('trainings.index')
                ->with('danger','Training already started and cannot be changed');
        }
        $training->update($request->all());

        return redirect()->route('trainings.index')
            ->with('success','Training updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Training $training
     * @return Response
     */
    public function destroy(Training $training)
    {
        if ($training->isStarted()) {
            return redirect()->route('trainings.index')
                ->with('danger','Training already started and cannot be changed');
        }
        $training->delete();

        return redirect()->route('trainings.index')
            ->with('success','Training deleted successfully');
    }

    public function start(Training $training)
    {
        if ($training->isStarted()) {
            return redirect()->route('trainings.index')
                ->with('danger','Training already started and cannot be started again');
        }

        $count = $this->trainingGenerator->generate($training);

        return redirect()->route('trainings.index')
            ->with('success', $count . ' biddings started successfully');
    }
}
