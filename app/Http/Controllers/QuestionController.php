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
            return redirect()->route('quiz.thankyou')->with('error', 'You have already taken all available questions.');
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

        // Get latest round for this user
        $latestRound = UserAnswer::where('user_id', $jobseeker->id)->max('round');

        // Total questions answered by this user in latest round
        $totalQuestions = UserAnswer::where('user_id', $jobseeker->id)
            ->where('round', $latestRound)
            ->count();

        // Number of correct answers by this user in latest round
        $correctAnswers = UserAnswer::join('answers', 'user_answers.answer_id', '=', 'answers.id')
            ->where('user_answers.user_id', $jobseeker->id)
            ->where('user_answers.round', $latestRound)
            ->where('answers.is_correct', true)
            ->count();

        // 🟢 Build leaderboard for ALL participants in this round
        $leaderboard = JobSeeker::join('user_answers', function ($join) use ($latestRound) {
            $join->on('job_seekers.id', '=', 'user_answers.user_id')
                ->where('user_answers.round', '=', $latestRound);
        })
            ->leftJoin('answers', 'user_answers.answer_id', '=', 'answers.id')
            ->selectRaw('job_seekers.id as user_id, job_seekers.firstName, job_seekers.lastName, COUNT(CASE WHEN answers.is_correct = 1 THEN 1 END) as correctAnswers')
            ->groupBy('job_seekers.id', 'job_seekers.firstName', 'job_seekers.lastName')
            ->orderByDesc('correctAnswers')
            ->get();

        // 🟢 Get detailed answers for current user in this round
        $userAnswers = UserAnswer::with(['question.answers', 'answer'])
            ->where('user_id', $jobseeker->id)
            ->where('round', $latestRound)
            ->get();

        $questions = [];

        foreach ($userAnswers as $userAnswer) {
            $question = $userAnswer->question;
            $selectedAnswer = $userAnswer->answer;
            $correctAnswer = $question->answers->firstWhere('is_correct', true);

            $questions[] = [
                'text' => $question->question,
                'user_answer' => $selectedAnswer->answer ?? 'N/A',
                'correct_answer' => $correctAnswer->answer ?? 'N/A',
                'is_correct' => $selectedAnswer->is_correct ?? false,
            ];
        }

        return view('frontend.quiz.thankyou', [
            'leaderboard' => $leaderboard,
            'totalQuestions' => $totalQuestions,
            'correctAnswers' => $correctAnswers,
            'questions' => $questions,
        ]);
    }
}
