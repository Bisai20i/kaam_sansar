<?php

namespace App\Http\Controllers;

use App\Models\PollingQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PollingQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pollingQuestions = PollingQuestion::all();
        return view('backend.pollingQuestion.index', compact('pollingQuestions'));
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
        $user = $request->user() ?? Auth::guard('admin')->user();
        $adminId = $user->id;
        $request->validate([
            'question' => 'required|string|max:255',
            'publish' =>'required|in:publish,unpublish',
        ]);
        PollingQuestion::create([
            'admin_id' => $adminId,
            'question' => $request->question,
        ]);
        return redirect()->back()->with('success', 'Question added successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PollingQuestion  $pollingQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(PollingQuestion $pollingQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PollingQuestion  $pollingQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(PollingQuestion $pollingQuestion)
    {
        return response()->json($pollingQuestion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PollingQuestion  $pollingQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PollingQuestion $pollingQuestion)
    {
        $request->validate([
            'question' => 'required|string|max:255',
        ]);
        $pollingQuestion->update([
            'question' => $request->question,
        ]);
        return redirect()->back()->with('success', 'Question updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PollingQuestion  $pollingQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(PollingQuestion $pollingQuestion)
    {
        $pollingQuestion->destory();
        return redirect()->back()->with('success','Question deleted successfully.');
    }
       public function publishStatus($id)
    {
        $question = PollingQuestion::findOrFail($id);
        $question->publishStatus = $question->publishStatus === 'publish' ? 'unpublish' : 'publish';
        $question->save();
        return redirect()->back()->with('success', 'Question status updated.');
    }
}
