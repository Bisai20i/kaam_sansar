@extends('backend.layouts.main')

@section('title', 'Seller Details')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="content-wrapper">
        <h4 class="fw-bold mb-4">Seller Details</h4>

        <div class="card">
            <div class="card-header">
                <h5>Personal Information</h5>
            </div>
            <div class="card-body">
                <p><strong>First Name:</strong> {{ $seller->first_name }}</p>
                <p><strong>Last Name:</strong> {{ $seller->last_name }}</p>
                <p><strong>Email:</strong> {{ $seller->email }}</p>
                <p><strong>Phone:</strong> {{ $seller->phone }}</p>
                <p><strong>Whatsapp Number:</strong> {{ $seller->whatsapp_number }}</p>
                <p><strong>Country:</strong> {{ $seller->country }}</p>
            </div>
        </div>

        <!-- Bank Details Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Bank Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Bank Name:</strong> {{ $seller->bank_name }}</p>
                <p><strong>Bank Account Number:</strong> {{ $seller->bank_account_number }}</p>
                <p><strong>SWIFT Code:</strong> {{ $seller->swift_code }}</p>
                <p><strong>Bank Country:</strong> {{ $seller->bank_country }}</p>
                <p><strong>Branch Location:</strong> {{ $seller->branch_location }}</p>
            </div>
        </div>

        <!-- Business Details Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Business Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Business Name:</strong> {{ $seller->business_name }}</p>
                <p><strong>Business Type:</strong> {{ $seller->business_type }}</p>
                <p><strong>Business Address:</strong> {{ $seller->business_address }}</p>
                <p><strong>Website/Social:</strong> {{ $seller->website_or_social }}</p>
            </div>
        </div>

        <!-- Product Details Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Product Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Product Category:</strong> {{ $seller->product_category }}</p>
                <p><strong>Delivery Time:</strong> {{ $seller->delivery_time }}</p>
                <p><strong>Target Country:</strong> {{ $seller->target_country }}</p>
            </div>
        </div>

        <!-- Document Files Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Documents</h5>
            </div>
            <div class="card-body">
                @if($seller->citizen_document)
                <p><strong>Citizen Document:</strong> <a href="{{ asset('storage/' . $seller->citizen_document) }}" target="_blank">View</a></p>
                @else
                <p>No Citizen Document uploaded</p>
                @endif

                @if($seller->passport_document)
                <p><strong>Passport Document:</strong> <a href="{{ asset('storage/' . $seller->passport_document) }}" target="_blank">View</a></p>
                @else
                <p>No Passport Document uploaded</p>
                @endif

                @if($seller->visa_document)
                <p><strong>Visa Document:</strong> <a href="{{ asset('storage/' . $seller->visa_document) }}" target="_blank">View</a></p>
                @else
                <p>No Visa Document uploaded</p>
                @endif

                @if($seller->resident_id_document)
                <p><strong>Resident ID Document:</strong> <a href="{{ asset('storage/' . $seller->resident_id_document) }}" target="_blank">View</a></p>
                @else
                <p>No Resident ID Document uploaded</p>
                @endif

                @if($seller->registration_doc1)
                <p><strong>Registration Doc 1:</strong> <a href="{{ asset('storage/' . $seller->registration_doc1) }}" target="_blank">View</a></p>
                @endif
                @if($seller->registration_doc2)
                <p><strong>Registration Doc 2:</strong> <a href="{{ asset('storage/' . $seller->registration_doc2) }}" target="_blank">View</a></p>
                @endif
                @if($seller->registration_doc3)
                <p><strong>Registration Doc 3:</strong> <a href="{{ asset('storage/' . $seller->registration_doc3) }}" target="_blank">View</a></p>
                @endif
            </div>
        </div>

        <!-- Images Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Images</h5>
            </div>
            <div class="card-body">
                @if($seller->show_pic1)
                <p><strong>Image 1:</strong><br><img src="{{ asset('storage/' . $seller->show_pic1) }}" alt="Image 1" style="max-width: 150px; height: auto;"></p>
                @endif
                @if($seller->show_pic2)
                <p><strong>Image 2:</strong><br><img src="{{ asset('storage/' . $seller->show_pic2) }}" alt="Image 2" style="max-width: 150px; height: auto;"></p>
                @endif
                @if($seller->show_pic3)
                <p><strong>Image 3:</strong><br><img src="{{ asset('storage/' . $seller->show_pic3) }}" alt="Image 3" style="max-width: 150px; height: auto;"></p>
                @endif
            </div>
        </div>

        <!-- Terms & Status Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Other Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Terms Accepted:</strong> {{ $seller->terms_accepted ? 'Yes' : 'No' }}</p>
                <p><strong>Status:</strong> {{ ucfirst($seller->status) }}</p>
            </div>
        </div>
    </div>
   

</div>
@endsection