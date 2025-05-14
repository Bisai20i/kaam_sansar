@extends('backend.layouts.main')
@section('title', 'Manage Work Permit Districts')
@section('content')

<div class="container">
    <h4 class="fw-bold m-4">Work Permits / Nepal / Districts</h4>
    <!-- Add New District -->
    <div class="row">
        <!-- Form to Add/Edit Job Category -->
        <div class="col-12 col-lg-8">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0"> District Lists</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('workPermitDistricts.store') }}">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <select name="provience_id" class="form-select" required>
                                    <option value="">-- Select Province --</option>
                                    @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->provienceName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="districtName" class="form-control" placeholder="District Name" required>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">Add District</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Districts</h5>
                    <small class="text-muted float-end">List of Districts</small>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <!-- District List -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Province</th>
                                    <th>District</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($districts as $district)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $district->province->provienceName ?? '' }}</td>
                                    <td>{{ $district->districtName }}</td>
                                    <td style="border-right: 1px solid #dee2e6;">
                                        <!-- Action Dropdown -->
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <!-- Edit Option -->
                                                 <a class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $district->id }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <!-- Delete Option -->
                                                <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $district->id }}">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $district->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $district->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('workPermitDistricts.update', $district->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $district->id }}">Edit District</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="provience_id{{ $district->id }}" class="form-label">Province</label>
                                                        <select name="provience_id" class="form-select" required>
                                                            @foreach($provinces as $province)
                                                            <option value="{{ $province->id }}" {{ $district->provience_id == $province->id ? 'selected' : '' }}>{{ $province->provienceName }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="districtName{{ $district->id }}" class="form-label">District Name</label>
                                                        <input type="text" name="districtName" class="form-control" value="{{ $district->districtName }}" required>
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

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal{{ $district->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $district->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('workPermitDistricts.destroy', $district->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $district->id }}">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete the district <strong>{{ $district->districtName }}</strong>?
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
