@extends('backend.layouts.main')

@section('title', 'Kundali Matching List')

@section('content')
<div class="container py-5">
    <h4 class="fw-bold mb-4">Kundali Matching Details</h4>

    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Kundali Entries</h4>
                <!-- <a href="{{ route('kundalidetail.create') }}" class="btn btn-primary btn-sm text-white">Create Kundali</a> -->
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Girl Name</th>
                            <th>Girl DOB</th>
                            <th>Girl Place of Birth</th>
                            <th>Girl Time of Birth</th>
                            <th>Boy Name</th>
                            <th>Boy DOB</th>
                            <th>Boy Place of Birth</th>
                            <th>Boy Time of Birth</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kundali as $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $post->girlName }}</td>

                            <td>{{ $post->girlDateOfBirth }}</td>
                            <td>{{ $post->girlPlaceOfBirth }}</td>
                            <td>{{ $post->girlTimeOfBirth }}</td>
                            <td>{{ $post->boyName }}</td>
                            <td>{{ $post->boyDateOfBirth }}</td>
                            <td>{{ $post->boyPlaceOfBirth }}</td>
                            <td>{{ $post->boyTimeOfBirth }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('astrologer.view', ['type' => 'matching', 'id' => $post->id]) }}">
                                            <i class="bx bx-reply me-1"></i> Reply
                                        </a>

                                        <!-- <a class="dropdown-item" href="{{ route('kundalimatching.edit', $post->id) }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a> -->
                                        <a class="dropdown-item text-danger" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Confirmation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('kundalimatching.destroy', $post->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            Are you sure you want to delete this kundali?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
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
@endsection