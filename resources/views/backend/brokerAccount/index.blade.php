@extends('backend.layouts.main')

@section('title', 'Broker Applications')

@section('content')
<div class="container">
    <h4 class="fw-bold m-3"><span class="text-muted fw-light">Broker Applications</span></h4>
    <div class="card shadow">
        <div>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title p-3">Broker Account List</h4>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>BOID</th>
                            <th>Client Type</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Bank</th>
                            <th>Branch</th>
                            <th>Account Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brokerAccounts as $broker)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $broker->boid }}</td>
                            <td>{{ ucfirst($broker->clientType) }}</td>
                            <td>{{ $broker->mobileNumber }}</td>
                            <td>{{ $broker->emailAddress }}</td>
                            <td>{{ $broker->bankName }}</td>
                            <td>{{ $broker->bankBranch }}</td>
                            <td>{{ $broker->accountNumber }}</td>
                            <td>
                                @if($broker->status == 'approved')
                                <span class="badge bg-success">Approved</span>
                                @elseif($broker->status == 'rejected')
                                <span class="badge bg-danger">Rejected</span>
                                @elseif($broker->status == 'In-progress')
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
                                        <a class="dropdown-item text-success" href="{{ route('brokerAccounts.show', $broker->id) }}">
                                            <i class="fas fa-download"></i> download
                                        </a>

                                        @if($broker->status != 'In-progress')
                                        <form action="{{ route('brokerAccount.updateStatus', $broker->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="status" value="In-progress">
                                            <button type="submit" class="dropdown-item text-info ps-3" style="background:none; border:none; padding:0; margin:0;">
                                                <i class="bx bx-loader-circle me-1"></i> Mark In-progress
                                            </button>
                                        </form>
                                        @endif

                                        @if($broker->status != 'approved')
                                        <form action="{{ route('brokerAccount.updateStatus', $broker->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="dropdown-item text-success ps-3" style="background:none; border:none; padding:0; margin:0;">
                                                <i class="bx bx-check me-1"></i> Approve
                                            </button>
                                        </form>
                                        @endif

                                        @if($broker->status != 'rejected')
                                        <form action="{{ route('brokerAccount.updateStatus', $broker->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="dropdown-item text-danger ps-3" style="background:none; border:none; padding:0; margin:0;">
                                                <i class="bx bx-x me-1"></i> Reject
                                            </button>
                                        </form>
                                        @endif

                                        <a class="dropdown-item text-secondary" href="javascript:void(0);"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            onclick="setDeleteFormAction({{ $broker->id }})">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </a>

                                    </div>
                                </div>

                            </td>


                        </tr>
                        @endforeach
                        @if ($brokerAccounts->isEmpty())
                        <tr>
                            <td colspan="10" class="text-center">No broker accounts found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
     <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this broker account?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function setDeleteFormAction(id) {
        document.getElementById('deleteForm').action = "{{ route('brokerAccounts.destroy', ':id') }}".replace(':id', id);
    }
</script>
<!-- Font Awesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endsection