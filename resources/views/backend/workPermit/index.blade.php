@extends('backend.layouts.main')

@section('title', 'Work Permit Requests')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="content-wrapper">
    <h4 class="fw-bold m-3"><span class="text-muted fw-light">Work Permit Application</span></h4>
        <div class="row">
            <div class="col-12 ">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Work Permits</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>District</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($workPermits->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center">No Data Found</td>
                                    </tr>
                                    @endif

                                    @foreach ($workPermits as $permit)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $permit->firstName . ' ' . $permit->lastName }}</td>
                                        <td>{{ $permit->email }}</td>
                                        <td>{{ $permit->phoneNo }}</td>
                                        <td>{{ $permit->appDistrict ?? 'N/A' }}</td>
                                        <td>{{ $permit->appLocation ?? 'N/A' }}</td>
                                        <td>
                                            @if($permit->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                            @elseif($permit->status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                            @elseif($permit->status == 'In-progress')
                                            <span class="badge bg-info">In Progress</span>
                                            @else
                                            <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item text-success" href="{{ route('workPermits.show', $permit->id) }}">
                                                        <i class="fas fa-show"></i> show
                                                    </a>

                                                    @if($permit->status != 'In-progress')
                                                    <form action="{{ route('workPermit.updateStatus', $permit->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <input type="hidden" name="status" value="In-progress">
                                                        <button type="submit" class="dropdown-item text-info ps-3" style="background:none; border:none; padding:0; margin:0;">
                                                            <i class="bx bx-loader-circle me-1"></i> Mark In-progress
                                                        </button>
                                                    </form>
                                                    @endif

                                                    @if($permit->status != 'approved')
                                                    <form action="{{ route('workPermit.updateStatus', $permit->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <input type="hidden" name="status" value="approved">
                                                        <button type="submit" class="dropdown-item text-success ps-3" style="background:none; border:none; padding:0; margin:0;">
                                                            <i class="bx bx-check me-1"></i> Approve
                                                        </button>
                                                    </form>
                                                    @endif

                                                    @if($permit->status != 'rejected')
                                                    <form action="{{ route('workPermit.updateStatus', $permit->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit" class="dropdown-item text-danger ps-3" style="background:none; border:none; padding:0; margin:0;">
                                                            <i class="bx bx-x me-1"></i> Reject
                                                        </button>
                                                    </form>
                                                    @endif

                                                    <a class="dropdown-item text-secondary" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                        onclick="setDeleteFormAction({{ $permit->id }})">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </a>

                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Work Permit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Work Permit?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function setDeleteFormAction(id) {
            document.getElementById('deleteForm').action = "{{ route('workPermits.destroy', ':id') }}".replace(':id', id);
        }
    </script>
</div>
@endsection