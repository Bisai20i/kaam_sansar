@extends('frontend.layouts.main')
@section('title', 'Quiz Thank You')

@section('content')
<style>
    .quiz-question img {
        max-width: 100%;
        height: auto;
        display: block;
        margin-top: 10px;
    }
</style>

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
                    🏆 Your Score: <strong>{{ $correctAnswers }}</strong> out of <strong>{{ $totalQuestions }}</strong> points
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
                        @foreach($leaderboard as $entry)
                        <tr class="{{ Auth::guard('job_seekers')->user()->id === $entry->id ? 'table-info fw-semibold' : 'fw-normal' }}"
                            style="font-size: 18px; color: #515151;">
                            <td>{{ $entry->rank }}</td>
                            <td>{{ $entry->firstName }} {{ $entry->lastName }}
                                @if(Auth::guard('job_seekers')->user()->id === $entry->id)
                                (You)
                                @endif
                            </td>
                            <td>{{ $entry->correct_answers }}/{{ $totalQuestions }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="button" class="btn btn-outline-secondary my-2" data-bs-toggle="modal" data-bs-target="#breakdownModal">
                    See Result
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Point Breakdown -->
<div class="modal fade" id="breakdownModal" tabindex="-1" aria-labelledby="breakdownModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 700px;">
        <div class="modal-content" style="height: 650px;">
            <div class="modal-header">
                <h5 class="modal-title" id="breakdownModalLabel">Point Breakdown</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-2" style="height: 350px; overflow: hidden;">
                @php
                    $chunks = array_chunk($questions->toArray(), 5);
                @endphp

                <div id="pagesContainer" style="display: flex; width: {{ count($chunks) * 100 }}%; height: 100%; transition: transform 0.4s ease;">
                    @foreach($chunks as $pageIndex => $chunk)
                    <div style="width: {{ 100 / count($chunks) }}%; padding: 10px; box-sizing: border-box; overflow-y: auto;">
                        @foreach($chunk as $index => $question)
                        <div class="mb-3 border-bottom pb-2 d-flex justify-content-between align-items-center"
                             style="font-size: 14px; background-color: #f5f5f5; padding: 10px 15px; border-radius: 6px; margin-bottom: 12px;">
                            <div style="flex: 1;">
                                <div class="fw-semibold" style="font-size: 16px; margin-bottom: 3px;">
                                    Question {{ $pageIndex * 5 + $index + 1 }}:
                                </div>
                                <div class="quiz-question" style="font-size: 14px;">
                                    {!! $question['text'] !!}
                                </div>
                                <div>
                                    Your Answer: <strong>{{ $question['user_answer'] }}</strong>
                                </div>
                                <div>
                                    Correct Answer: <strong>{{ $question['correct_answer'] }}</strong>
                                </div>
                            </div>

                            <div class="d-flex align-items-center ms-3">
                                <div class="d-flex align-items-center justify-content-center rounded-circle"
                                     style="width: 28px; height: 28px; font-size: 14px; color: white;
                                     background-color: {{ $question['is_correct'] ? '#28a745' : '#dc3545' }};">
                                    {{ $question['is_correct'] ? '+1' : '0' }}
                                </div>
                                <span class="ms-2" style="font-size: 18px;">
                                    {!! $question['is_correct'] ? '✔️' : '❌' !!}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="modal-footer">
                <div class="ms-auto d-flex gap-2">
                    <button id="prevBtn" onclick="changePage(-1)" class="btn btn-outline-secondary rounded-circle"
                            style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; font-size: 18px;" disabled>
                        &#8592;
                    </button>
                    <button id="nextBtn" onclick="changePage(1)" class="btn btn-outline-secondary rounded-circle"
                            style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                        &#8594;
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const totalPages = {{ count($chunks) }};
    let currentPage = 1;

    function changePage(direction) {
        currentPage += direction;
        if (currentPage < 1) currentPage = 1;
        if (currentPage > totalPages) currentPage = totalPages;

        const pagesContainer = document.getElementById('pagesContainer');
        const offsetPercent = -((currentPage - 1) * (100 / totalPages));
        pagesContainer.style.transform = `translateX(${offsetPercent}%)`;

        document.getElementById('prevBtn').disabled = currentPage === 1;
        document.getElementById('nextBtn').disabled = currentPage === totalPages;
    }

    // Initialize on load
    changePage(0);
</script>
@endsection