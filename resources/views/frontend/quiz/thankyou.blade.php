@extends('frontend.layouts.main')
@section('title', 'Quiz')

@section('content')

<div id="quiz5" class="d-flex justify-content-center align-items-center vh-100 px-3">
    <div class="w-100" style="max-width: 800px;">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="text-primary pt-4" style="font-size: 28px; font-weight: 600;">
                    🎉 You have completed the quiz!
                </h5>
                <p class="text-primary" style="font-size: 28px; font-weight: 600;">
                    Thank you for your participation.
                </p>
                <p class="text-black pb-3 pt-1" style="font-size: 22px; font-weight: 400;">
                    🏆 Your Score: <strong>{{ $userScore->total_points ?? 0 }}</strong> out of <strong>{{ $totalQuestions }}</strong> points
                </p>


                <hr>

                <h6 class="text-primary fw-bold mb-3 pt-1" style="font-size: 26px; font-weight: 600;">
                    Leaderboard
                </h6>

                <table class="table table-bordered my-4">
                    <thead class="table-light" style="font-size: 18px; font-weight: 600;">
                        <tr>
                            <th>Rank</th>
                            <th>Name</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leaderboard as $index => $entry)
                        <tr class="{{ (auth()->user()->id === $entry->user_id) ? 'table-info fw-semibold' : 'fw-normal' }}"
                            style="font-size: 18px; color: #515151;">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $entry->firstName }} {{ $entry->lastName }}
                                @if(auth()->user()->id === $entry->user_id)
                                (You)
                                @endif
                            </td>
                            <td>{{ $entry->total_points }} / {{ $totalQuestions }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- <a href="{{ route('quiz.frontend') }}" class="btn bg-primary text-white fw-semibold rounded-2 my-3 px-4 py-2">
                    Play Again
                </a> -->
            </div>
        </div>
    </div>
</div>

@endsection