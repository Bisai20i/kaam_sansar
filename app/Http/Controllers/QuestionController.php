<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('answers', 'admin')->paginate(10);
        return view('backend.quiz.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.quiz.create');
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
        'question' => 'required|string',
        'points' => 'required|integer|min:0',
        'options' => 'required|array|size:4',
        'options.*' => 'required|string',
        'correct_option' => 'required|integer|between:0,3',
    ]);

    $question = Question::create([
        'question' => $request->question,
        'points' => $request->points,
        'admin_id' => Auth::id(),
    ]);

    foreach ($request->options as $index => $optionText) {
        $question->answers()->create([
            'answer' => $optionText,
            'is_correct' => $request->correct_option == $index,
        ]);
    }

    return redirect()->route('questions.index')->with('success', 'Question created successfully!');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::with('answers', 'admin')->findOrFail($id);
        return view('backend.quiz.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::with('answers')->findOrFail($id);
        return view('backend.quiz.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request, $id)
{
    $request->validate([
        'question' => 'required|string',
        'points' => 'required|integer|min:0',
        'options' => 'required|array|size:4',
        'options.*' => 'required|string',
        'correct_option' => 'required|integer|between:0,3',
    ]);

    $question = Question::findOrFail($id);

    $question->update([
        'question' => $request->question,
        'points' => $request->points,
    ]);

    // Delete old answers and add new ones
    $question->answers()->delete();

    foreach ($request->options as $index => $optionText) {
        $question->answers()->create([
            'answer' => $optionText,
            'is_correct' => $request->correct_option == $index,
        ]);
    }

    return redirect()->route('questions.index')->with('success', 'Question updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
{
    $question = Question::findOrFail($id);
    $question->answers()->delete(); // delete related answers first
    $question->delete(); // then delete the question itself

    return redirect()->route('questions.index')->with('success', 'Question deleted successfully!');
}

}
