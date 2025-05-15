@extends('backend.layouts.main')

@section('title', 'Renewal Details')

@section('content')

    <!-- Image Preview Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Image Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Preview" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4 d-flex justify-content-between align-items-center">
            <p class="d-flex gap-2 align-items-center">Passport Renewal Details <small class="badge fs-6 bg-{{ $passportRenewal->status == 'pending' ? 'warning' :  ($passportRenewal->status == 'rejected' ? 'danger' : 'success') }} rounded-pill">{{ $passportRenewal->status }}</small></p>
            <div class="d-flex gap-2 align-items-center justify-content-end">
                @if ($passportRenewal->status == 'pending')
                    <a href="{{ route('passport.renewal.setStatus', [$passportRenewal->id, 'to'=>'approved']) }}" class="btn btn-success ">Approve</a>
                    <a href="{{ route('passport.renewal.setStatus', [$passportRenewal->id, 'to'=>'rejected']) }}" class="btn btn-danger ">Reject</a>
                
                @else
                    <a href="{{ route('passport.renewal.setStatus', [$passportRenewal->id, 'to'=>'pending']) }}" class="btn btn-info">Set Status to Pending</a>
                @endif
                <a href="{{ route('passport.renewal') }}" class="btn btn-primary"><i class='bx bx-arrow-back'></i>  Back</a>
                
            </div>
            
        </h4>

        <!-- Personal Information -->
        <div class="card mb-3">
            <div class="card-header ">
                <h5>Personal Information</h5>
                
            </div>
            <div class="card-body">
                <p><strong>First Name:</strong> {{ $passportRenewal->first_name }}</p>
                <p><strong>Middle Name:</strong> {{ $passportRenewal->middle_name ?? 'N/A' }}</p>
                <p><strong>Last Name:</strong> {{ $passportRenewal->last_name }}</p>
                <p><strong>Date of Birth (AD):</strong> {{ $passportRenewal->date_of_birth_ad }}</p>
                <p><strong>Date of Birth (BS):</strong> {{ $passportRenewal->date_of_bs }}</p>
                <p><strong>Gender:</strong> {{ ucfirst($passportRenewal->gender) }}</p>
                <p><strong>Age:</strong> {{ $passportRenewal->age }}</p>
                <p><strong>Nationality:</strong> {{ $passportRenewal->nationality }}</p>
                <p><strong>Religion:</strong> {{ $passportRenewal->religion }}</p>
                <p><strong>Birth Country:</strong> {{ $passportRenewal->birth_country }}</p>
            </div>
        </div>

        <!-- Citizenship Info -->
        <div class="card mb-3">
            <div class="card-header">
                <h5>Citizenship Information</h5>
            </div>
            <div class="card-body">
                <p><strong>National ID No.:</strong> {{ $passportRenewal->national_identify_no }}</p>
                <p><strong>Citizenship No.:</strong> {{ $passportRenewal->citizenship_no }}</p>
                <p><strong>Issue Date:</strong> {{ $passportRenewal->citizenship_issue_date }}</p>
                <p><strong>Issue Place:</strong> {{ $passportRenewal->citizenship_issue_place }}</p>
                <p><strong>Issue Place Abroad:</strong> {{ $passportRenewal->citizenship_issue_place_abroad }}</p>
            </div>
        </div>

        <!-- Passport Details -->
        <div class="card mb-3">
            <div class="card-header">
                <h5>Current Passport Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Passport No.:</strong> {{ $passportRenewal->passport_no }}</p>
                <p><strong>Type:</strong> {{ $passportRenewal->passport_type }}</p>
                <p><strong>Issue Date:</strong> {{ $passportRenewal->passport_issue_date }}</p>
                <p><strong>Expiry Date:</strong> {{ $passportRenewal->passport_expiry_date }}</p>
                <p><strong>Issue Place:</strong> {{ $passportRenewal->passport_issue_place }}</p>
                <p><strong>Issuing Authority:</strong> {{ $passportRenewal->issuing_authority }}</p>
            </div>
        </div>

        <!-- Contact Details -->
        <div class="card mb-3">
            <div class="card-header">
                <h5>Contact Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> {{ $passportRenewal->email }}</p>
                <p><strong>Phone:</strong> {{ $passportRenewal->phone }}</p>
                <p><strong>Country:</strong> {{ $passportRenewal->contact_country }}</p>
                <p><strong>State:</strong> {{ $passportRenewal->contact_state }}</p>
                <p><strong>District:</strong> {{ $passportRenewal->contact_district }}</p>
                <p><strong>City:</strong> {{ $passportRenewal->contact_city }}</p>
                
            </div>
        </div>

        <!-- Emergency Contact -->
        <div class="card mb-3">
            <div class="card-header">
                <h5>Emergency Contact</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $passportRenewal->emergency_contact_name }}</p>
                <p><strong>Relation:</strong> {{ $passportRenewal->emergency_contact_relation }}</p>
                <p><strong>Country:</strong> {{ $passportRenewal->emergency_contact_country }}</p>
                <p><strong>Province:</strong> {{ $passportRenewal->emergency_contact_state }}</p>
                <p><strong>District:</strong> {{ $passportRenewal->emergency_contact_district }}</p>
                <p><strong>City:</strong> {{ $passportRenewal->emergency_contact_city }}</p>
                <p><strong>Email:</strong> {{ $passportRenewal->emergency_contact_email }}</p>
                <p><strong>Phone:</strong> {{ $passportRenewal->emergency_contact_phone }}</p>
            </div>
        </div>

        <!-- Appointment Details -->
        <div class="card mb-3">
            <div class="card-header">
                <h5>Appointment Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Country:</strong> {{ $passportRenewal->country }}</p>
                <p><strong>Province:</strong> {{ $passportRenewal->state }}</p>
                <p><strong>District:</strong> {{ $passportRenewal->district }}</p>
                <p><strong>Location:</strong> {{ $passportRenewal->location }}</p>
                <p><strong>Date:</strong> {{ $passportRenewal->appointment_date }}</p>
                <p><strong>Time:</strong> {{ $passportRenewal->appointment_time }}</p>
                <p><strong>Service Type:</strong> {{ ucfirst($passportRenewal->service_type) }}</p>
                <p><strong>Passport Pages:</strong> {{ str_replace('_', ' ', $passportRenewal->passport_pages) }}</p>
            </div>
        </div>

        <!-- Uploaded Documents -->

        <div class="card mb-3">
            <div class="card-header">
                <h5>Documents</h5>
            </div>
            <div class="card-body d-flex flex-wrap gap-3">
                @foreach (['citizenship_front', 'citizenship_back', 'academic_certificate', 'marriage_registration', 'divorce_certificate', 'national_eid', 'other_document', 'previous_passport'] as $doc)
                    @if ($passportRenewal->$doc)
                    <div class="flex-grow-1">
                        <p><strong>{{ ucwords(str_replace('_', ' ', $doc)) }}:</strong>
                            <img src="{{ asset('storage/' . $passportRenewal->$doc) }}" alt="{{ ucwords(str_replace('_', ' ', $doc)) }}"
                                class="img-thumbnail mt-1" style="max-width: 300px; cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#imageModal"
                                onclick="showModalImage('{{ asset('storage/' . $passportRenewal->$doc) }}')" >
                        </p>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>


        <!-- Status -->
        <div class="card mb-3">
            <div class="card-header">
                <h5>Status</h5>
            </div>
            <div class="card-body">
                <p><strong>Status:</strong> {{ ucfirst($passportRenewal->status) }}</p>
                <p><strong>Payment Status:</strong> {{ ucfirst($passportRenewal->payment_staus) }}</p>
            </div>
        </div>
    </div>


    <script>
        function showModalImage(src) {
            document.getElementById('modalImage').src = src;
        }
    </script>

@endsection
