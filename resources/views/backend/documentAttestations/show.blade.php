@extends('backend.layouts.main')

@section('title', 'Document Attestation Detail')

@section('content')
<div class="container">
    <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Document Attestation /</span> Detail</h4>

    <div class="card shadow p-4">
        <h5 class="mb-3">Applicant & Document Info</h5>
        <div class="row">
            <div class="col-md-4"><strong>Applicant Name:</strong> {{ $documentationAttestation->applicantName }}</div>
            <div class="col-md-4"><strong>Job Seeker ID:</strong> {{ $documentationAttestation->jobSeekerId }}</div>
            <div class="col-md-4"><strong>Document Type:</strong> {{ $documentationAttestation->documentType }} ({{ $documentationAttestation->subType }})</div>
        </div>
        <hr>

        <h5 class="mb-3">Country Details</h5>
        <div class="row">
            <div class="col-md-4"><strong>Applicant Country:</strong> {{ $documentationAttestation->applicantCountry }}</div>
            <div class="col-md-4"><strong>documentationAttestation Country:</strong> {{ $documentationAttestation->documentationAttestationCountry }}</div>
            <div class="col-md-4"><strong>Country documentationAttestation:</strong> {{ $documentationAttestation->countrydocumentationAttestation }}</div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6"><strong>Purpose:</strong> {{ $documentationAttestation->purpose }}</div>
        </div>
        <hr>

        <h5 class="mb-3">Delivery Address</h5>
        <div class="row">
            <div class="col-md-4"><strong>Country:</strong> {{ $documentationAttestation->deliveryCountry }}</div>
            <div class="col-md-4"><strong>City:</strong> {{ $documentationAttestation->deliveryCity }}</div>
            <div class="col-md-4"><strong>Street:</strong> {{ $documentationAttestation->deliveryStreet }}</div>
        </div>
        <div class="row mt-2">
            <div class="col-md-4"><strong>Apartment:</strong> {{ $documentationAttestation->deliveryApartment }}</div>
            <div class="col-md-4"><strong>Landmark:</strong> {{ $documentationAttestation->deliveryLandmark }}</div>
        </div>
        <div class="row mt-2">
            <div class="col-md-4"><strong>Primary Contact:</strong> {{ $documentationAttestation->primaryContact }}</div>
            <div class="col-md-4"><strong>Secondary Contact:</strong> {{ $documentationAttestation->secondaryContact }}</div>
            <div class="col-md-4"><strong>Email:</strong> {{ $documentationAttestation->email }}</div>
        </div>
        <hr>

        <h5 class="mb-3">Work Address</h5>
        <div class="row">
            <div class="col-md-4"><strong>Country:</strong> {{ $documentationAttestation->workCountry }}</div>
            <div class="col-md-4"><strong>City:</strong> {{ $documentationAttestation->workCity }}</div>
            <div class="col-md-4"><strong>Street:</strong> {{ $documentationAttestation->workStreet }}</div>
        </div>
        <div class="row mt-2">
            <div class="col-md-4"><strong>Apartment:</strong> {{ $documentationAttestation->workApartment }}</div>
            <div class="col-md-4"><strong>Landmark:</strong> {{ $documentationAttestation->workLandmark }}</div>
        </div>
        <hr>

        <h5 class="mb-3">Documents</h5>
        <div class="row">
            <div class="col-md-4"><strong>Citizenship Front:</strong> {{ $documentationAttestation->citizenshipFront }}</div>
            <div class="col-md-4"><strong>Citizenship Back:</strong> {{ $documentationAttestation->citizenshipBack }}</div>
            <div class="col-md-4"><strong>Passport:</strong> {{ $documentationAttestation->passport }}</div>
        </div>
        <div class="row mt-2">
            <div class="col-md-4"><strong>Identification:</strong> {{ $documentationAttestation->identification }}</div>
            <div class="col-md-4"><strong>Visa:</strong> {{ $documentationAttestation->visa }}</div>
            <div class="col-md-4"><strong>Photo:</strong> {{ $documentationAttestation->photo }}</div>
        </div>
        <div class="row mt-2">
            <div class="col-md-3"><strong>Document 1:</strong> {{ $documentationAttestation->document1 }}</div>
            <div class="col-md-3"><strong>Document 2:</strong> {{ $documentationAttestation->document2 }}</div>
            <div class="col-md-3"><strong>Document 3:</strong> {{ $documentationAttestation->document3 }}</div>
            <div class="col-md-3"><strong>Document 4:</strong> {{ $documentationAttestation->document4 }}</div>
        </div>
        <hr>

        <h5 class="mb-3">Status</h5>
        <div class="row">
            <div class="col-md-4"><strong>Payment Status:</strong> {{ ucfirst($documentationAttestation->paymentStatus) }}</div>
            <div class="col-md-4"><strong>Application Status:</strong> {{ ucfirst($documentationAttestation->status) }}</div>
        </div>
    </div>
</div>
@endsection
