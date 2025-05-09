@extends('backend.layouts.main')

@section('title', 'Document Attestations')

@section('content')
<div class="container">
    <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Document Attestations</span></h4>
    <div class="card shadow">
        <div>
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
                            <th>Action</th>
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
                                <a href="{{ route('documentAttestations.show', $attestation->id) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-download"></i> Download
                                </a>
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

<!-- Font Awesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endsection