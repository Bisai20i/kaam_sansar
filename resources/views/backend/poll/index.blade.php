@extends('backend.layouts.main')
@section('title', 'Manage Polls')
@section('content')

<div class="container">
    <h4 class="fw-bold m-4">Polls List</h4>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <h5>Polls</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Job Seeker</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($polls as $poll)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $poll->jobSeeker->firstName}} {{ $poll->jobSeeker->lastName }}</td>
                                    <td>{{ $poll->question->question ?? 'N/A' }}</td>
                                    <td>{{ $poll->answer->answer ?? 'N/A' }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn p-0 dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $poll->id }}">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                         
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $poll->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('polls.destroy', $poll->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this poll?
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
