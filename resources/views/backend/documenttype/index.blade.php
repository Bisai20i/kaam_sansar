@extends('backend.layouts.main')
@section('title', 'Manage Document Types')
@section('content')

<div class="container">
    <h4 class="fw-bold m-4 ">
        <a href="{{ route('documentAttestations.index') }}" class="btn btn-primary mb-4">
            <i class="fas fa-arrow-left text-white"></i> Back
        </a>
    </h4>

        <div class="row">
            <!-- Form to Add New Document Type -->
            <div class="col-12 col-lg-8">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Add Document Type</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('document-types.store') }}">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-md-9">
                                    <input type="text" name="documentType" class="form-control" placeholder="Enter Document Type" required>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary w-100">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Document Types List Table -->
            <div class="col-12 col-lg-8">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Document Types</h5>
                        <small class="text-muted float-end">List of all document types</small>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Document Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($documentTypes as $type)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $type->documentType }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $type->id }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $type->id }}">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $type->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $type->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('document-types.update', $type->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $type->id }}">Edit Document Type</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text" name="documentType" class="form-control" value="{{ $type->documentType }}" required>
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
                                    <div class="modal fade" id="deleteModal{{ $type->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $type->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('document-types.destroy', $type->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $type->id }}">Delete Confirmation</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete <strong>{{ $type->documentType }}</strong>?
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