@extends('backend.layouts.main')
@section('title', 'Manage Work Permit Locations')
@section('content')

<div class="container">
    <h4 class="fw-bold m-4">Work Permits / Nepal / Locations</h4>
    <!-- Add New Location -->
    <div class="row">
        <!-- Form to Add/Edit Location -->
        <div class="col-12 col-lg-8">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Location Lists</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('workPermitLocations.store') }}">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <select name="district_id" class="form-select" required>
                                    <option value="">-- Select District --</option>
                                    @foreach($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->districtName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="locationName" class="form-control" placeholder="Location Name" required>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">Add Location</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Locations</h5>
                    <small class="text-muted float-end">List of Locations</small>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>District</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($locations as $location)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $location->district->districtName ?? '' }}</td>
                                    <td>{{ $location->locationName }}</td>
                                    <td style="border-right: 1px solid #dee2e6;">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $location->id }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $location->id }}">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $location->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $location->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('workPermitLocations.update', $location->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $location->id }}">Edit Location</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="district_id{{ $location->id }}" class="form-label">District</label>
                                                        <select name="district_id" class="form-select" required>
                                                            @foreach($districts as $district)
                                                            <option value="{{ $district->id }}" {{ $location->district_id == $district->id ? 'selected' : '' }}>{{ $district->districtName }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="locationName{{ $location->id }}" class="form-label">Location Name</label>
                                                        <input type="text" name="locationName" class="form-control" value="{{ $location->locationName }}" required>
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
                                <div class="modal fade" id="deleteModal{{ $location->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $location->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('workPermitLocations.destroy', $location->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $location->id }}">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete the location <strong>{{ $location->locationName }}</strong>?
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
