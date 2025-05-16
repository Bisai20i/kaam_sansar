@extends('backend.layouts.main')
@section('title', 'Manage Polling Questions')
@section('content')

<div class="container">
    <h4 class="fw-bold m-4">Polling Questions</h4>

    <!-- Add Question Form -->
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0">Add New Polling Question</h5></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('pollingQuestions.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <input type="text" name="question" class="form-control" placeholder="Enter question" required>
                            </div>
                            <div class="col-md-4">
                                <select name="publishStatus" class="form-select" required>
                                    <option value="publish">Publish</option>
                                    <option value="unpublish">Unpublish</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Question</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Question List -->
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <h5>Questions List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Question</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pollingQuestions as $question)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $question->question }}</td>
                                    <td>
                                        <span class="badge bg-{{ $question->publishStatus === 'publish' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($question->publishStatus) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn p-0 dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $question->id }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <form action="{{ route('polling_questions.toggle', $question->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="bx bx-refresh me-1"></i>
                                                        {{ $question->publishStatus == 'publish' ? 'Unpublish' : 'Publish' }}
                                                    </button>
                                                </form>
                                                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $question->id }}">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $question->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('pollingQuestions.update', $question->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Polling Question</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Question</label>
                                                        <input type="text" name="question" class="form-control" value="{{ $question->question }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Status</label>
                                                        <select name="publishStatus" class="form-select" required>
                                                            <option value="publish" {{ $question->publishStatus == 'publish' ? 'selected' : '' }}>Publish</option>
                                                            <option value="unpublish" {{ $question->publishStatus == 'unpublish' ? 'selected' : '' }}>Unpublish</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $question->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('pollingQuestions.destroy', $question->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete <strong>{{ $question->question }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
