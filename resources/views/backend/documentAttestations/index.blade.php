@extends('backend.layouts.main')

@section('title', 'Document Attestations')

@section('content')
<div class="container">
    <h4 class="fw-bold mb-4"><span class="text-muted fw-light">
        
    </span></h4>
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title">Document Attestation Applications</h4>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Applicant Name</th>
                            <th>Document Type</th>
                            <th>Attestation Country</th>
                            <th>Delivery Country</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documentAttestations as $attestation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $attestation->applicantName }}</td>
                            <td>{{ $attestation->documentType }} ({{ $attestation->subType }})</td>
                            <td>{{ $attestation->attestationCountry }}</td>
                            <td>{{ $attestation->deliveryCountry }}</td>
                            <td>{{ $attestation->primaryContact }}</td>
                            <td>{{ $attestation->email }}</td>
                            <td>
                                @if($attestation->status == 'approved')
                                <span class="badge bg-success">Approved</span>
                                @elseif($attestation->status == 'rejected')
                                <span class="badge bg-danger">Rejected</span>
                                @elseif($attestation->status == 'In-progress')
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
                                        <a class="dropdown-item text-success" href="{{ route('documentAttestations.show', $attestation->id) }}">
                                            <i class="fas fa-download me-1"></i> show
                                        </a>

                                        @if($attestation->status != 'In-progress')
                                        <form action="{{ route('documentAttestation.updateStatus', $attestation->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="status" value="In-progress">
                                            <button type="submit" class="dropdown-item text-info ps-3" style="background:none; border:none; padding:0; margin:0;">
                                                <i class="bx bx-loader-circle me-1"></i> Mark In-progress
                                            </button>
                                        </form>
                                        @endif

                                        @if($attestation->status != 'approved')
                                        <form action="{{ route('documentAttestation.updateStatus', $attestation->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="dropdown-item text-success ps-3" style="background:none; border:none; padding:0; margin:0;">
                                                <i class="bx bx-check me-1"></i> Approve
                                            </button>
                                        </form>
                                        @endif

                                        @if($attestation->status != 'rejected')
                                        <form action="{{ route('documentAttestation.updateStatus', $attestation->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="dropdown-item text-danger ps-3" style="background:none; border:none; padding:0; margin:0;">
                                                <i class="bx bx-x me-1"></i> Reject
                                            </button>
                                        </form>
                                        @endif

                                        <a class="dropdown-item text-secondary" href="javascript:void(0);"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            onclick="setDeleteFormAction({{ $attestation->id }})">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </a>

                                    </div>
                                </div>

                            </td>
                        
                            </tr>
                        @endforeach
                        @if ($documentAttestations->isEmpty())
                        <tr>
                            <td colspan="10" class="text-center">No document attestation applications found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
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
                        Are you sure you want to delete this Document Attestation?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Font Awesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<script>
    function setDeleteFormAction(id) {
        document.getElementById('deleteForm').action = "{{ route('documentAttestations.destroy', ':id') }}".replace(':id', id);
    }
</script>

@endsection
