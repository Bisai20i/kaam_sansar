@extends('backend.layouts.main')

@section('title', 'Question List')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="content-wrapper">
        <h4 class="fw-bold mb-4">Questions</h4>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Question List</h5>
                        <a href="{{ route('questions.create') }}" class="btn btn-primary btn-sm text-white">
                            <i class="bx bx-plus"></i> Add Question
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Question</th>
                                        <th> Reward Points</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions as $question)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="question-content" style="max-width: 300px; max-height: 120px; overflow: auto;">
                                                {!! $question->question !!}
                                            </div>
                                        </td>
                                        <td>{{ $question->points }}</td>
                                        <td>{{ $question->admin->fullName ?? 'N/A' }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm btn-link text-dark p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded fs-4"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('questions.show', $question->id) }}">
                                                            <i class="bx bx-show me-1"></i> View
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('questions.edit', $question->id) }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                    </li>
                                                    {{-- @if ($question->publishStatus=='unpublish')
                                                       <li>
                                                        <a class="dropdown-item" href="{{ route('questions.publishStatus', $question->id) }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Publish
                                                        </a>
                                                    </li>  
                                                    @endif
                                                     <li>
                                                        <a class="dropdown-item" href="{{ route('questions.publishSatus', $question->id) }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Unpublish
                                                        </a>
                                                    </li> --}}
                                                    <li>
                                                        <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $question->id }}">
                                                            <i class="bx bx-trash me-1"></i> Delete
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteModal{{ $question->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $question->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $question->id }}">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this question?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('questions.destroy', $question->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger btn-sm">Yes, Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $questions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
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
</style>
