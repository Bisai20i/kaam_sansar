<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollingQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $polls = Poll::all();
        return view('backend.poll.index', compact('polls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $pollQuestion = PollingQuestion::with(['answers', 'polls'])
            ->where('publishStatus', 'publish')
            ->first();
        if($pollQuestion == null) {
            return redirect()->back()->with('error', 'No Polls to display. Come back later!');
        }
        return view('frontend.pollingSystem.create', compact('pollQuestion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
{
    // Check if the request is from mobile
    $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

    $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

    if (!$user) {
        return $isMobile
            ? response()->json(['success' => false, 'message' => 'Unauthorized'], 401)
            : redirect()->route('login')->with('error', 'Unauthorized access.');
    }

    $jobSeekerId = $user->id;

    // Validate input
    $validator = Validator::make($request->all(), [
        'polling_question_id' => 'required|exists:polling_questions,id',
        'polling_answer_id' => 'required|exists:polling_answers,id'
    ]);

    if ($validator->fails()) {
        return $isMobile
            ? response()->json(['success' => false, 'message' => 'Validation failed.', 'errors' => $validator->errors()], 422)
            : redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Check if user already voted
    $existingVote = Poll::where('jobSeekerId', $jobSeekerId)
        ->where('polling_question_id', $request->polling_question_id)
        ->first();

    if ($existingVote) {
        $existingVote->update([
            'polling_answer_id' => $request->polling_answer_id
        ]);
    } else {
        // Create vote
        Poll::create([
            'jobSeekerId' => $jobSeekerId,
            'polling_question_id' => $request->polling_question_id,
            'polling_answer_id' => $request->polling_answer_id
        ]);
    }

    // For mobile API response - just return success, client can request updated data
    if ($isMobile) {
        return response()->json([
            'success' => true,
            'message' => 'Successfully voted'
        ]);
    }

    // For web response
    return redirect()->back()->with('success', 'Your vote has been recorded!');
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function edit(Poll $poll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poll $poll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
        //
    }
}
