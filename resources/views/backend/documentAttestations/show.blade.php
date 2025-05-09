@extends('backend.layouts.main')

@section('title', 'Document Attestation Details')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="content-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Document Attestation Details</h4>
            <a href="{{ route('documentAttestations.index') }}" class="btn btn-secondary">Back to List</a>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5>Basic Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Job Seeker ID:</strong> {{ $documentationAttestation->jobSeekerId }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Document Type:</strong> {{ $documentationAttestation->documentType }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Sub Type:</strong> {{ $documentationAttestation->subType }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Applicant Name:</strong> {{ $documentationAttestation->applicantName }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Purpose:</strong> {{ $documentationAttestation->purpose }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5>Country Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Applicant Country:</strong> {{ $documentationAttestation->applicantCountry }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Attestation Country:</strong> {{ $documentationAttestation->attestationCountry }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Country Attestation:</strong> {{ $documentationAttestation->countryAttestation }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5>Delivery Address</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <p><strong>Country:</strong> {{ $documentationAttestation->deliveryCountry }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>City:</strong> {{ $documentationAttestation->deliveryCity }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Street:</strong> {{ $documentationAttestation->deliveryStreet }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Apartment:</strong> {{ $documentationAttestation->deliveryApartment ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Landmark:</strong> {{ $documentationAttestation->deliveryLandmark ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Primary Contact:</strong> {{ $documentationAttestation->primaryContact }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Secondary Contact:</strong> {{ $documentationAttestation->secondaryContact ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Email:</strong> {{ $documentationAttestation->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if($documentationAttestation->workCountry)
        <div class="card mb-4">
            <div class="card-header">
                <h5>Work Address</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <p><strong>Country:</strong> {{ $documentationAttestation->workCountry }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>City:</strong> {{ $documentationAttestation->workCity }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Street:</strong> {{ $documentationAttestation->workStreet }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Apartment:</strong> {{ $documentationAttestation->workApartment ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Landmark:</strong> {{ $documentationAttestation->workLandmark ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <h5>Documents</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @if($documentationAttestation->identification)
                    <div class="col-md-4 mb-3">
                        <p><strong>Identification:</strong></p>
                        <a href="{{ asset( $documentationAttestation->identification) }}" target="_blank" class="btn btn-sm btn-primary">View Document</a>
                    </div>
                    @endif

                    @if($documentationAttestation->visa)
                    <div class="col-md-4 mb-3">
                        <p><strong>Visa:</strong></p>
                        <a href="{{ asset( $documentationAttestation->visa) }}" target="_blank" class="btn btn-sm btn-primary">View Document</a>
                    </div>
                    @endif

                    @if($documentationAttestation->citizenshipFront)
                    <div class="col-md-4 mb-3">
                        <p><strong>Citizenship Front:</strong></p>
                        <a href="{{ asset('storage/' . $documentationAttestation->citizenshipFront) }}" target="_blank" class="btn btn-sm btn-primary">View Document</a>
                    </div>
                    @endif

                    @if($documentationAttestation->citizenshipBack)
                    <div class="col-md-4 mb-3">
                        <p><strong>Citizenship Back:</strong></p>
                        <a href="{{ asset('storage/' . $documentationAttestation->citizenshipBack) }}" target="_blank" class="btn btn-sm btn-primary">View Document</a>
                    </div>
                    @endif

                    @if($documentationAttestation->passport)
                    <div class="col-md-4 mb-3">
                        <p><strong>Passport:</strong></p>
                        <a href="{{ asset('storage/' . $documentationAttestation->passport) }}" target="_blank" class="btn btn-sm btn-primary">View Document</a>
                    </div>
                    @endif

                    @if($documentationAttestation->photo)
                    <div class="col-md-4 mb-3">
                        <p><strong>Photo:</strong></p>
                        <img src="{{ asset('storage/' . $documentationAttestation->photo) }}" alt="Applicant Photo" style="max-width: 150px; height: auto;">
                    </div>
                    @endif
                </div>

                <div class="row mt-3">
                    @for($i = 1; $i <= 4; $i++) @php $doc="document$i" @endphp @if($documentationAttestation->$doc)
                    <div class="col-md-3 mb-3">
                        <p><strong>Additional Document {{ $i }}:</strong></p>
                        <a href="{{ asset('storage/' . $documentationAttestation->$doc) }}" target="_blank" class="btn btn-sm btn-primary">View Document</a>
                    </div>
                    @endif
                    @endfor
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Status Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Payment Status:</strong> 
                            <span class="badge bg-{{ $documentationAttestation->paymentStatus === 'paid' ? 'success' : 'warning' }}">
                                {{ ucfirst($documentationAttestation->paymentStatus) }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Processing Status:</strong> 
                            <span class="badge bg-{{ $documentationAttestation->status === 'completed' ? 'success' : 'info' }}">
                                {{ ucfirst($documentationAttestation->status) }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Last Updated:</strong> {{ $documentationAttestation->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection