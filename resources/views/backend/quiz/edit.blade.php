@extends('backend.layouts.main')

@section('title', 'Edit Question')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="content-wrapper">
        <h4 class="fw-bold mb-4">Edit Question</h4>

        <div class="row">
            <div class="col-md-8 col-lg-11 mx-auto">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Update Question</h5>
                        <a href="{{ route('questions.index') }}" class="btn btn-primary btn-sm text-white">
                            <i class="bx bx-arrow-back"></i> Back
                        </a>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form id="questionForm" action="{{ route('questions.update', $question->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="question" class="form-label">Question</label>
                                <textarea id="summernote" name="question"
                                    class="form-control @error('question') is-invalid @enderror" required>{{ old('question', $question->question) }}</textarea>
                                @error('question')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="points" class="form-label">Reward Points</label>
                                <input type="number" id="points" name="points"
                                    class="form-control @error('points') is-invalid @enderror"
                                    value="{{ old('points', $question->points) }}" min="0" required>
                                @error('points')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <label class="form-label">Options (select one correct):</label>

                            @php
                                $options = old('options', $question->answers->pluck('answer')->toArray());
                                $correctIndex = old('correct_option', $question->answers->search(fn($answer) => $answer->is_correct));
                            @endphp

                            @for ($i = 0; $i < 4; $i++)
                                <div class="input-group mb-2">
                                    <input type="text" name="options[]"
                                        class="form-control @error('options.' . $i) is-invalid @enderror"
                                        placeholder="Option text"
                                        value="{{ $options[$i] ?? '' }}" required>
                                    <div class="input-group-text">
                                        <input type="radio" name="correct_option" value="{{ $i }}"
                                            {{ $correctIndex == $i ? 'checked' : '' }} required>
                                    </div>
                                    @error('options.' . $i)
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endfor

                            @error('correct_option')
                            <div class="text-danger mb-3">{{ $message }}</div>
                            @enderror

                            <button type="submit" class="btn btn-primary mt-3">Update Question</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 150
        });

        // Before form submit, copy summernote content to textarea for server validation
        $('#questionForm').on('submit', function(e) {
            var content = $('#summernote').summernote('code').trim();

            if (!content || content === '<p><br></p>') {
                alert('Please enter the question.');
                e.preventDefault();
                return false;
            }

            $('#summernote').val(content);
        });
    });
</script>
@endsection
