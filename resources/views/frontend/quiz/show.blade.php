@extends('frontend.layouts.main')
@section('title', 'Quiz')

@section('content')


<style>
    /* Quiz Container Styles */
    .quiz-card {
        max-width: 800px;
        margin: 30px auto;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.08);
        padding: 25px;
        background-color: #fff;
    }

    .question-header {
        font-size: 22px;
        font-weight: 500;
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }

    .question-body {
        padding: 0;
    }

    .question-body img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 25px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    /* Answer Options */
    .form-check {
        margin-bottom: 15px;
        padding: 0;
    }

    .form-check-input {
        display: none;
    }

    .form-check-label {
        display: flex;
        align-items: center;
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 15px 20px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .form-check-label:hover {
        border-color: #0064A7;
        background-color: rgba(0, 100, 167, 0.05);
    }

    .quiz-option {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background-color: #F4F4F4;
        color: #060710;
        font-weight: 600;
        font-size: 20px;
        margin-right: 15px;
        transition: all 0.3s ease;
    }

    /* Selected State */
    .form-check-input:checked + .form-check-label {
        border-color: #0064A7;
        background-color: rgba(0, 100, 167, 0.05);
    }

    .form-check-input:checked + .form-check-label .quiz-option {
        background-color: #0064A7;
        color: #fff;
    }

    /* Navigation */
    .quiz-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
    }

    .quiz-progress {
        font-size: 18px;
        font-weight: 500;
        text-align: center;
        color: #666;
    }

    #next-btn, #submit-btn {
        padding: 10px 25px;
        font-weight: 500;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        background-color: #F1F3F5;
        color: #666;
        transition: all 0.3s ease;
    }

    #next-btn.active, #submit-btn.active {
        background-color: #0064A7;
        color: #fff;
        border-color: #0064A7;
    }

    /* Results Page - Add this if you want to style the results similarly */
    .quiz-results {
        text-align: center;
        padding: 30px;
    }

    .quiz-results-title {
        font-size: 28px;
        font-weight: 600;
        color: #0064A7;
        margin-bottom: 20px;
    }

    .quiz-score {
        font-size: 22px;
        font-weight: 400;
        color: #333;
        margin-bottom: 30px;
    }

    .leaderboard {
        margin: 30px 0;
    }

    .leaderboard-title {
        font-size: 26px;
        font-weight: 600;
        color: #0064A7;
        margin-bottom: 20px;
    }

    .leaderboard-table {
        margin-bottom: 30px;
    }

    .leaderboard-table th {
        font-size: 18px;
        font-weight: 600;
        background-color: #f8f9fa;
    }

    .leaderboard-table td {
        font-size: 18px;
        color: #515151;
    }

    .user-row {
        font-weight: 600;
        background-color: #e3f2fd !important;
    }

    .play-again-btn {
        background-color: #0064A7;
        color: #fff;
        font-weight: 600;
        padding: 10px 25px;
        border-radius: 8px;
        border: none;
        transition: all 0.3s ease;
    }
</style>

<div class="container">
    <div class="quiz-card">
        <div class="question-header">
            Fantasy Quiz #1
        </div>

        <form id="quiz-form" action="{{ route('quiz.submit') }}" method="POST">
            @csrf

            @foreach ($questions as $index => $question)
            <div class="question-slide question-body" style="{{ $index === 0 ? '' : 'display:none;' }}">
                <strong>Q{{ $index + 1 }} of {{ count($questions) }}</strong>
                <div class="mt-3 mb-4">
                    @if($question->image)
                    <img src="{{ asset($question->image) }}" class="img-fluid" alt="Question Image">
                    @endif
                    {!! $question->question !!}
                </div>

                @foreach ($question->answers as $answer)
                <div class="form-check">
                    <input class="form-check-input" type="radio"
                        name="question_{{ $question->id }}"
                        value="{{ $answer->id }}"
                        id="answer_{{ $answer->id }}" required>
                    <label class="form-check-label" for="answer_{{ $answer->id }}">
                        <span class="quiz-option">{{ chr(65 + $loop->index) }}</span>
                        <span class="quiz-option-text">{{ $answer->answer }}</span>
                    </label>
                </div>
                @endforeach
            </div>
            @endforeach

            <div class="quiz-footer d-flex justify-content-between">
                <button type="button" id="next-btn" class="btn">Next</button>
                <span class="quiz-progress">Question 1 of {{ count($questions) }}</span>
                <button type="submit" id="submit-btn" class="btn btn-success">Submit Quiz</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.question-slide');
        const nextBtn = document.getElementById('next-btn');
        const submitBtn = document.getElementById('submit-btn');
        let current = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.display = i === index ? 'block' : 'none';
            });

            // Update progress text
            document.querySelector('.quiz-progress').textContent = `Question ${index + 1} of ${slides.length}`;

            // Show submit only on last slide, else show next button
            nextBtn.style.display = index === slides.length - 1 ? 'none' : 'inline-block';
            submitBtn.style.display = index === slides.length - 1 ? 'inline-block' : 'none';
        }

        nextBtn.addEventListener('click', function() {
            const currentSlide = slides[current];
            const radios = currentSlide.querySelectorAll('input[type=radio]');
            let answered = false;

            radios.forEach(radio => {
                if (radio.checked) answered = true;
            });

            if (current < slides.length - 1) {
                current++;
                showSlide(current);
                window.scrollTo(0, 0);
            }
        });

        // Toggle active class on option select
        document.querySelectorAll('.form-check-input').forEach(input => {
            input.addEventListener('change', function() {
                if (this.checked) {
                    nextBtn.classList.add('active');
                }
            });
        });

        // Initialize first slide
        showSlide(current);
    });
</script>
@endsection