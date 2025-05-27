@extends('backend.layouts.main')

@section('title', 'Document Attestation Details')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="content-wrapper">
        <h4 class="fw-bold mb-4">Document Attestation Details</h4>

        <!-- Application Information Section -->
        <div class="card">
            <div class="card-header">
                <h5>Application Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Document Type:</strong> {{ ucfirst($attestation->documentType) }}</p>
                        <p><strong>Sub Type:</strong> {{ $attestation->subType }}</p>
                        <p><strong>Applicant Country:</strong> {{ $attestation->applicantCountry }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Attestation Country:</strong> {{ $attestation->attestationCountry }}</p>
                        <p><strong>Status:</strong> 
                            <span class="badge bg-{{ 
                                $attestation->status == 'completed' ? 'success' : 'warning' 
                            }}">
                                {{ ucfirst($attestation->status) }}
                            </span>
                        </p>
                        <p><strong>Payment Status:</strong> 
                            <span class="badge bg-{{ 
                                $attestation->paymentStatus == 'paid' ? 'success' : 'danger' 
                            }}">
                                {{ ucfirst($attestation->paymentStatus) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Applicant Information Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Applicant Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Applicant Name:</strong> {{ $attestation->applicantName }}</p>
                        <p><strong>Primary Contact:</strong> {{ $attestation->primaryContact }}</p>
                        <p><strong>Secondary Contact:</strong> {{ $attestation->secondaryContact ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Email:</strong> {{ $attestation->email }}</p>
                        <p><strong>Purpose of Attestation:</strong> {{ $attestation->purpose }}</p>
                        <p><strong>Country for Attestation:</strong> {{ $attestation->countryAttestation }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delivery Address Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Delivery Address</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Country:</strong> {{ $attestation->deliveryCountry }}</p>
                        <p><strong>City:</strong> {{ $attestation->deliveryCity }}</p>
                        <p><strong>Street:</strong> {{ $attestation->deliveryStreet }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Apartment:</strong> {{ $attestation->deliveryApartment ?? 'N/A' }}</p>
                        <p><strong>Landmark:</strong> {{ $attestation->deliveryLandmark ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Work Address Section -->
        @if($attestation->workCountry)
        <div class="card mt-3">
            <div class="card-header">
                <h5>Work Address</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Country:</strong> {{ $attestation->workCountry }}</p>
                        <p><strong>City:</strong> {{ $attestation->workCity }}</p>
                        <p><strong>Street:</strong> {{ $attestation->workStreet }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Apartment:</strong> {{ $attestation->workApartment ?? 'N/A' }}</p>
                        <p><strong>Landmark:</strong> {{ $attestation->workLandmark ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Documents Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Submitted Documents</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        @if($attestation->identification)
                        <p><strong>Identification Document:</strong> <a href="{{ asset($attestation->identification) }}" target="_blank">View</a></p>
                        @endif
                        @if($attestation->visa)
                        <p><strong>Visa Document:</strong> <a href="{{ asset(  $attestation->visa) }}" target="_blank">View</a></p>
                        @endif
                        @if($attestation->citizenshipFront)
                        <p><strong>Citizenship Front:</strong> <a href="{{ asset( $attestation->citizenshipFront) }}" target="_blank">View</a></p>
                        @endif
                        @if($attestation->citizenshipBack)
                        <p><strong>Citizenship Back:</strong> <a href="{{ asset(  $attestation->citizenshipBack) }}" target="_blank">View</a></p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if($attestation->passport)
                        <p><strong>Passport:</strong> <a href="{{ asset( $attestation->passport) }}" target="_blank">View</a></p>
                        @endif
                        @if($attestation->photo)
                        <p><strong>Photo:</strong> <a href="{{ asset( $attestation->photo) }}" target="_blank">View</a></p>
                        @endif
                        @if($attestation->document1)
                        <p><strong>Additional Document 1:</strong> <a href="{{ asset( $attestation->document1) }}" target="_blank">View</a></p>
                        @endif
                        @if($attestation->document2)
                        <p><strong>Additional Document 2:</strong> <a href="{{ asset($attestation->document2) }}" target="_blank">View</a></p>
                        @endif
                    </div>
                </div>
                @if($attestation->document3 || $attestation->document4)
                <div class="row mt-2">
                    <div class="col-md-6">
                        @if($attestation->document3)
                        <p><strong>Additional Document 3:</strong> <a href="{{ asset( $attestation->document3) }}" target="_blank">View</a></p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if($attestation->document4)
                        <p><strong>Additional Document 4:</strong> <a href="{{ asset( $attestation->document4) }}" target="_blank">View</a></p>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Additional Information Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Additional Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Created At:</strong> {{ $attestation->created_at->format('Y-m-d H:i') }}</p>
                <p><strong>Last Updated:</strong> {{ $attestation->updated_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-3">
            <a href="{{ route('documentAttestations.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection