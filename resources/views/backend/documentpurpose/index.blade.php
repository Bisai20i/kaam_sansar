@extends('backend.layouts.main')
@section('title', 'Manage Document Purposes')
@section('content')

<div class="container">
  <h4 class="fw-bold m-4 ">
        <a href="{{ route('documentAttestations.index') }}" class="btn btn-primary mb-4">
            <i class="fas fa-arrow-left text-white"></i> Back
        </a>
    </h4>
    <div class="row">
        <!-- Add New Purpose Form -->
        <div class="col-12 col-lg-8">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Add Document Purpose</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('document-purposes.store') }}">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-9">
                                <input type="text" name="documentPurpose" class="form-control" placeholder="Enter Document Purpose" required>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Purpose List Table -->
        <div class="col-12 col-lg-8">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Document Types</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">SN</th>
                                    <th style="width: 70%;">Document Purpose</th>
                                    <th style="width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documentPurposes as $purpose)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $purpose->documentPurpose }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $purpose->id }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $purpose->id }}">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $purpose->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $purpose->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('document-purposes.update', $purpose->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $purpose->id }}">Edit Document Purpose</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" name="documentPurpose" class="form-control" value="{{ $purpose->documentPurpose }}" required>
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
                                <div class="modal fade" id="deleteModal{{ $purpose->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $purpose->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('document-purposes.destroy', $purpose->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $purpose->id }}">Delete Confirmation</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete <strong>{{ $purpose->documentPurpose }}</strong>?
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