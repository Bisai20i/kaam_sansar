<?php

namespace App\Http\Controllers;

use App\Models\PollingAnswer;
use App\Models\PollingQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PollingAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pollingQuestions = PollingQuestion::all();
        $pollingAnswers = PollingAnswer::with('question')->get();
        return view('backend.pollingAnswer.index', compact('pollingQuestions', 'pollingAnswers'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'polling_question_id' => 'required|exists:polling_questions,id',
            'answers' => 'required|array',
            'answers.*' => 'required|string|max:255'
        ]);

        foreach ($request->answers as $answer) {
            PollingAnswer::create([
                'polling_question_id' => $request->polling_question_id,
                'answer' => $answer
            ]);
        }

        return redirect()->back()->with('success', 'Answers added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PollingAnswer  $pollingAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(PollingAnswer $pollingAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PollingAnswer  $pollingAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(PollingAnswer $pollingAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PollingAnswer  $pollingAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PollingAnswer $pollingAnswer)
    {
        {
    $validated = $request->validate([
        'polling_question_id' => 'required|exists:polling_questions,id',
        'answer' => 'required|string|max:255'
    ]);

    try {
        $pollingAnswer->update($validated);
        return redirect()->back()->with('success', 'Answer updated successfully');
    } catch (\Exception $e) {
        return back()->withInput()
            ->with('error', 'Error updating answer: ' . $e->getMessage());
    }
}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PollingAnswer  $pollingAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(PollingAnswer $pollingAnswer)
    {
        $pollingAnswer->delete();
        return redirect()->back()->with('success','Answer Delete Successfully');
    }
}
