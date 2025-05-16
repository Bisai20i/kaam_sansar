@extends('frontend.layouts.main')
@section('title', 'Quiz')

@section('content')



<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .question-body img {
        width: 100%;
        max-height: 250px;
        /* Adjust height here */
        object-fit: cover;
        /* Crop the image nicely */
        border-radius: 10px;
        margin-bottom: 15px;
        display: block;
    }

    .quiz-card {
        max-width: 650px;
        margin: 30px auto;
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        background-color: #fff;
    }

    .question-header {
        background-color: #f0f4f8;
        padding: 20px;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
    }

    .question-body {
        padding: 25px;
    }

    .question-body img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .form-check-label {
        display: block;
        padding: 12px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: 0.2s ease-in-out;
    }

    .form-check-input:checked+.form-check-label {
        background-color: #e3f2fd;
        border-color: #2196f3;
        color: #0d47a1;
    }

    .quiz-footer {
        padding: 20px;
        text-align: center;
    }
</style>

<div class="container">
    <div class="quiz-card">
        <div class="question-header">
            Fantasy Quiz #156
        </div>

        <form id="quiz-form" action="{{ route('quiz.submit') }}" method="POST">
            @csrf

            @foreach ($questions as $index => $question)
            <div class="question-slide question-body" style="{{ $index === 0 ? '' : 'display:none;' }}">
                <strong>Q{{ $index + 1 }} of {{ count($questions) }}</strong>
                <div class="mt-3 mb-4">
                    {!! $question->question !!} {{-- Summernote-rendered HTML --}}
                </div>

                @foreach ($question->answers as $answer)
                <div class="form-check">
                    <input class="form-check-input d-none" type="radio"
                        name="question_{{ $question->id }}"
                        value="{{ $answer->id }}"
                        id="answer_{{ $answer->id }}" required>
                    <label class="form-check-label" for="answer_{{ $answer->id }}">
                        {{ $answer->answer }}
                    </label>
                </div>
                @endforeach
            </div>
            @endforeach

            <div class="quiz-footer d-flex justify-content-between">
                <button type="button" id="next-btn" class="btn btn-primary">Next</button>
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

        if (!answered) {
            alert('Please select an answer before proceeding.');
            return;
        }

        if (current < slides.length - 1) {
            current++;
            showSlide(current);
            window.scrollTo(0, 0);
        }
    });

    // Initialize first slide
    showSlide(current);
});


</script>
@endsection