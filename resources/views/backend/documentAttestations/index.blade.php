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
                            <th>Payment Status</th>
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
                                <span class="badge 
                                    @if($attestation->paymentStatus == 'paid') bg-success 
                                    @else bg-danger 
                                    @endif">
                                    {{ ucfirst($attestation->paymentStatus) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge 
                                    @if($attestation->status == 'completed') bg-success 
                                    @else bg-warning text-dark 
                                    @endif">
                                    {{ ucfirst($attestation->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('documentAttestations.show', $attestation->id) }}">
                                            <i class="fas fa-eye me-1"></i> View
                                        </a>
                                        <a class="dropdown-item" href="{{ route('documentAttestations.edit', $attestation->id) }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <button type="button" class="dropdown-item text-danger"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            data-url="{{ route('documentAttestations.destroy', $attestation->id) }}">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </button>
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
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Attestation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle text-warning" style="font-size: 50px;"></i>
                </div>
                <p class="text-center bold">
                    <strong><h4>Are you sure you want to delete this attestation?</h4></strong>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" action="" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<script>
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const url = button.getAttribute('data-url');
        document.getElementById('deleteForm').action = url;
    });
</script>

@endsection
