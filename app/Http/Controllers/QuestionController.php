<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use App\Models\JobSeeker;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserAnswer;



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
                'is_correct' => ((int)$request->correct_option === $index),
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
                'is_correct' => ((int)$request->correct_option === $index),
            ]);
        }

        return redirect()->route('questions.index')->with('success', 'Question updated successfully!');
    }

    public function updateStatus($id)
    {
        $question = Question::findOrFail($id);
        $question->publishStauts = $question->publishStauts === 'publish' ? 'unpublish' : 'publish';
        $question->save();
        return redirect()->back()->with('success', 'Question status updated.');
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

    public function quiz()
    {
        $jobseeker = Auth::guard('job_seekers')->user();
        if (!$jobseeker) {
            abort(403, 'Unauthorized');
        }
        $answeredQuestionIds = UserAnswer::where('user_id', $jobseeker->id)->pluck('question_id')->toArray();
        $questions = Question::with('answers')
            ->where('publishStauts', 'publish')
            ->whereNotIn('id', $answeredQuestionIds)
            ->get();

        if ($questions->isEmpty()) {
            return redirect()->route('quiz.thankyou');
        }

        return view('frontend.quiz.show', compact('questions'));
    }

    public function submitQuiz(Request $request)
    {
        $jobseeker = Auth::guard('job_seekers')->user();

        if (!$jobseeker) {
            abort(403, 'Unauthorized');
        }

        // Get latest round and increment
        $latestRound = UserAnswer::where('user_id', $jobseeker->id)->max('round') ?? 0;
        $newRound = $latestRound + 1;

        $answers = $request->except('_token');
        $correctAnswers = 0;
        $totalQuestions = 0;

        foreach ($answers as $key => $answerId) {
            if (str_starts_with($key, 'question_')) {
                $questionId = (int) str_replace('question_', '', $key);
                $totalQuestions++;

                $isCorrect = Answer::where('id', $answerId)->value('is_correct');

                if ($isCorrect) {
                    $correctAnswers++;
                }

                UserAnswer::create([
                    'user_id' => $jobseeker->id,
                    'question_id' => $questionId,
                    'answer_id' => $answerId,
                    'round' => $newRound,
                ]);
            }
        }

        return redirect()->route('quiz.thankyou')->with([
            'points' => $correctAnswers,
            'total_questions' => $totalQuestions,
        ]);
    }

    public function thankYou()
{
    $jobseeker = Auth::guard('job_seekers')->user();

    // Check if user has any answers
    if (!UserAnswer::where('user_id', $jobseeker->id)->exists()) {
        return view('frontend.resultnotfound', ['message' => 'quiz']);
    }

    // Get user's latest round and question IDs
    $latestRound = UserAnswer::where('user_id', $jobseeker->id)->max('round');
    $userQuestionIds = UserAnswer::where('user_id', $jobseeker->id)
        ->where('round', $latestRound)
        ->pluck('question_id')
        ->sort()
        ->values();

    $totalQuestions = $userQuestionIds->count();

    // Get current user's correct answers
    $correctAnswers = UserAnswer::where('user_id', $jobseeker->id)
        ->where('round', $latestRound)
        ->whereHas('answer', function($q) {
            $q->where('is_correct', true);
        })
        ->count();

    // Find comparable users who answered the exact same questions
    $comparableUserIds = DB::table('user_answers')
        ->select('user_id')
        ->where('user_id', '!=', $jobseeker->id)
        ->whereIn('question_id', $userQuestionIds)
        ->groupBy('user_id')
        ->havingRaw('COUNT(DISTINCT question_id) = ?', [$totalQuestions])
        ->pluck('user_id');

    // Get comparable users' scores
    $leaderboard = JobSeeker::whereIn('id', $comparableUserIds)
        ->withCount(['userAnswers as correct_answers' => function($query) use ($userQuestionIds) {
            $query->whereIn('question_id', $userQuestionIds)
                ->whereHas('answer', function($q) {
                    $q->where('is_correct', true);
                });
        }])
        ->orderByDesc('correct_answers')
        ->get();

    // Add current user to leaderboard
    $currentUserData = (object) [
        'id' => $jobseeker->id,
        'firstName' => $jobseeker->firstName,
        'lastName' => $jobseeker->lastName,
        'correct_answers' => $correctAnswers,
        'rank' => 0
    ];

    $leaderboard->push($currentUserData);

    // Calculate ranks
    $leaderboard = $leaderboard->sortByDesc('correct_answers')->values();
    
    $rank = 1;
    $prevScore = null;
    $leaderboardWithRank = $leaderboard->map(function ($user) use (&$rank, &$prevScore) {
        $user->rank = ($prevScore !== null && $user->correct_answers === $prevScore) 
            ? $rank - 1 
            : $rank;
        $prevScore = $user->correct_answers;
        $rank++;
        return $user;
    });

    // Get detailed answers with questions and correct answers
    $userAnswers = UserAnswer::with(['question', 'answer', 'question.answers' => function($q) {
        $q->where('is_correct', true);
    }])
    ->where('user_id', $jobseeker->id)
    ->where('round', $latestRound)
    ->get();

    $questions = $userAnswers->map(function ($userAnswer) {
        return [
            'text' => $userAnswer->question->question,
            'user_answer' => $userAnswer->answer->answer,
            'correct_answer' => $userAnswer->question->answers->first()->answer ?? 'N/A',
            'is_correct' => $userAnswer->answer->is_correct,
        ];
    });

    return view('frontend.quiz.thankyou', [
        'leaderboard' => $leaderboardWithRank,
        'totalQuestions' => $totalQuestions,
        'correctAnswers' => $correctAnswers,
        'questions' => $questions,
        'latestRound' => $latestRound,
    ]);
}
}
