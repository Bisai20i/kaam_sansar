@extends('backend.layouts.main')

@section('title', 'View Question')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">View Question</h5>
            <a href="{{ route('questions.index') }}" class="btn btn-sm btn-secondary">Back</a>
        </div>
        <div class="card-body">
            <h6><strong>Question:</strong></h6>
            <div class="mb-3">
                {!! $question->question !!}
            </div>

            <h6><strong>Reward Points:</strong> {{ $question->points }}</h6>
            <h6><strong>Created By:</strong> {{ $question->admin->fullName ?? 'N/A' }}</h6>

            <hr>

            <h6><strong>Options:</strong></h6>
            <ol type="A">
                @foreach ($question->answers as $answer)
                    <li>
                        {{ $answer->answer }}
                        @if ($answer->is_correct)
                            <span class="badge bg-success ms-2">Correct</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</div>
@endsection
