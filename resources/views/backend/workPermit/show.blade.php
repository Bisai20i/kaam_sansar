@extends('backend.layouts.main')

@section('title', 'Work Permit Details')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="content-wrapper">
        <h4 class="fw-bold mb-4">Work Permit Details</h4>

        <!-- Application Information Section -->
        <div class="card">
            <div class="card-header">
                <h5>Application Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Service Type:</strong> {{ ucfirst($workPermit->serviceType) }}</p>
                <p><strong>Application Country:</strong> {{ $workPermit->appCountry }}</p>
                <p><strong>Application Province:</strong> {{ $workPermit->appProvince }}</p>
                <p><strong>Application District:</strong> {{ $workPermit->appDistrict }}</p>
                <p><strong>Application Location:</strong> {{ $workPermit->appLocation }}</p>
                <p><strong>Status:</strong> <span class="badge bg-{{ 
                    $workPermit->status == 'approved' ? 'success' : 
                    ($workPermit->status == 'rejected' ? 'danger' : 
                    ($workPermit->status == 'processing' ? 'warning' : 'secondary')) 
                }}">{{ ucfirst($workPermit->status) }}</span></p>
            </div>
        </div>

        <!-- Personal Information Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Personal Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Full Name:</strong> {{ $workPermit->firstName }} {{ $workPermit->middleName ?? '' }} {{ $workPermit->lastName }}</p>
                        <p><strong>Date of Birth (AD):</strong> {{ $workPermit->dateOfBirthAd ?? 'N/A' }}</p>
                        <p><strong>Date of Birth (BS):</strong> {{ $workPermit->dateOfBirthBs ?? 'N/A' }}</p>
                        <p><strong>Birthplace:</strong> {{ $workPermit->birthplace ?? 'N/A' }}</p>
                        <p><strong>Gender:</strong> {{ $workPermit->gender ?? 'N/A' }}</p>
                        <p><strong>Age:</strong> {{ $workPermit->age ?? 'N/A' }}</p>
                        <p><strong>Nationality:</strong> {{ $workPermit->nationality ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Religion:</strong> {{ $workPermit->religion ?? 'N/A' }}</p>
                        <p><strong>Birth Country:</strong> {{ $workPermit->birthCountry ?? 'N/A' }}</p>
                        <p><strong>Father's Name:</strong> {{ $workPermit->fatherName ?? 'N/A' }}</p>
                        <p><strong>Mother's Name:</strong> {{ $workPermit->motherName ?? 'N/A' }}</p>
                        <p><strong>Marital Status:</strong> {{ $workPermit->marriedStatus ?? 'N/A' }}</p>
                        <p><strong>Spouse Name:</strong> {{ $workPermit->spouseName ?? 'N/A' }}</p>
                        <p><strong>Number of Children:</strong> {{ $workPermit->numberOfChildren ?? '0' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Information Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Contact Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Phone:</strong> {{ $workPermit->phoneNo }}</p>
                        <p><strong>Email:</strong> {{ $workPermit->email }}</p>
                        <p><strong>Emergency Contact Phone:</strong> {{ $workPermit->emergencyContactPhone }}</p>
                        <p><strong>Emergency Contact Email:</strong> {{ $workPermit->emergencyContactEmail }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Emergency Contact Name:</strong> {{ $workPermit->emergencyContactFullName ?? 'N/A' }}</p>
                        <p><strong>Emergency Contact Relation:</strong> {{ $workPermit->emergencyContactRelation ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Address Information Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Address Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Permanent Address</h6>
                        <p><strong>Country:</strong> {{ $workPermit->contactCountry ?? 'N/A' }}</p>
                        <p><strong>Province:</strong> {{ $workPermit->province ?? 'N/A' }}</p>
                        <p><strong>District:</strong> {{ $workPermit->district ?? 'N/A' }}</p>
                        <p><strong>Municipality:</strong> {{ $workPermit->municipality ?? 'N/A' }}</p>
                        <p><strong>City:</strong> {{ $workPermit->city ?? 'N/A' }}</p>
                        <p><strong>Ward No:</strong> {{ $workPermit->wardNo ?? 'N/A' }}</p>
                        <p><strong>Tole/Street:</strong> {{ $workPermit->tole ?? 'N/A' }}, {{ $workPermit->street ?? '' }}</p>
                        <p><strong>House No:</strong> {{ $workPermit->houseNo ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Temporary Address</h6>
                        @if($workPermit->sameAsPermanent)
                            <p>Same as Permanent Address</p>
                        @else
                            <p><strong>Country:</strong> {{ $workPermit->tempCountry ?? 'N/A' }}</p>
                            <p><strong>Province:</strong> {{ $workPermit->tempProvince ?? 'N/A' }}</p>
                            <p><strong>District:</strong> {{ $workPermit->tempDistrict ?? 'N/A' }}</p>
                            <p><strong>Municipality:</strong> {{ $workPermit->tempMunicipality ?? 'N/A' }}</p>
                            <p><strong>City:</strong> {{ $workPermit->tempCity ?? 'N/A' }}</p>
                            <p><strong>Ward No:</strong> {{ $workPermit->tempWardNo ?? 'N/A' }}</p>
                            <p><strong>Tole/Street:</strong> {{ $workPermit->tempTole ?? 'N/A' }}, {{ $workPermit->tempStreet ?? '' }}</p>
                            <p><strong>House No:</strong> {{ $workPermit->tempHouseNo ?? 'N/A' }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Passport Information Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Passport Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Passport Number:</strong> {{ $workPermit->passportNumber ?? 'N/A' }}</p>
                <p><strong>Passport Type:</strong> {{ $workPermit->passportType ?? 'N/A' }}</p>
                <p><strong>Issue Date:</strong> {{ $workPermit->issueDate ?? 'N/A' }}</p>
                <p><strong>Expiry Date:</strong> {{ $workPermit->expiryDate ?? 'N/A' }}</p>
                <p><strong>Place of Issue:</strong> {{ $workPermit->placeOfIssue ?? 'N/A' }}</p>
                <p><strong>Issuing Authority:</strong> {{ $workPermit->issuingAuthority ?? 'N/A' }}</p>
            </div>
        </div>

        <!-- Employment Information Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Employment Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Company Name:</strong> {{ $workPermit->companyName ?? 'N/A' }}</p>
                        <p><strong>Country:</strong> {{ $workPermit->country ?? 'N/A' }}</p>
                        <p><strong>Skill:</strong> {{ $workPermit->skill ?? 'N/A' }}</p>
                        <p><strong>Salary:</strong> {{ $workPermit->salary ?? 'N/A' }}</p>
                        <p><strong>Work Type:</strong> {{ $workPermit->workType ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Daily Work Hours:</strong> {{ $workPermit->dailyWorkHour ?? 'N/A' }}</p>
                        <p><strong>Weekly Work Days:</strong> {{ $workPermit->weeklyWorkDay ?? 'N/A' }}</p>
                        <p><strong>Overtime:</strong> {{ $workPermit->overTime ?? 'N/A' }}</p>
                        <p><strong>Other Allowance:</strong> {{ $workPermit->otherAllowance ?? 'N/A' }}</p>
                        <p><strong>Health Insurance:</strong> {{ $workPermit->healthInsurance ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bank Information Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Bank Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Bank Name:</strong> {{ $workPermit->bankName ?? 'N/A' }}</p>
                <p><strong>Account Number:</strong> {{ $workPermit->bankAccount ?? 'N/A' }}</p>
                <p><strong>Account Type:</strong> {{ $workPermit->accountType ?? 'N/A' }}</p>
                <p><strong>Bank Branch:</strong> {{ $workPermit->bankBranch ?? 'N/A' }}</p>
                <p><strong>Bank Number:</strong> {{ $workPermit->bankNo ?? 'N/A' }}</p>
                <p><strong>Currency:</strong> {{ $workPermit->currency ?? 'N/A' }}</p>
            </div>
        </div>

        <!-- Nominee Information Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Nominee Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Nominee Name:</strong> {{ $workPermit->nomineeName ?? 'N/A' }}</p>
                <p><strong>Relation:</strong> {{ $workPermit->nomineeRelation ?? 'N/A' }}</p>
                <p><strong>Country:</strong> {{ $workPermit->nomineeCountry ?? 'N/A' }}</p>
                <p><strong>Province:</strong> {{ $workPermit->nomineeProvince ?? 'N/A' }}</p>
                <p><strong>District:</strong> {{ $workPermit->nomineeDistrict ?? 'N/A' }}</p>
                <p><strong>City:</strong> {{ $workPermit->nomineeCity ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $workPermit->nomineeEmail ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $workPermit->nomineePhone ?? 'N/A' }}</p>
            </div>
        </div>

        <!-- Document Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Documents</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        @if($workPermit->citizenshipFront)
                        <p><strong>Citizenship Front:</strong> <a href="{{ asset(path: $workPermit->citizenshipFront) }}" target="_blank">View</a></p>
                        @endif
                        @if($workPermit->citizenshipBack)
                        <p><strong>Citizenship Back:</strong> <a href="{{ asset( $workPermit->citizenshipBack) }}" target="_blank">View</a></p>
                        @endif
                        @if($workPermit->previousPassport)
                        <p><strong>Previous Passport:</strong> <a href="{{ asset( $workPermit->previousPassport) }}" target="_blank">View</a></p>
                        @endif
                        @if($workPermit->passportPhoto)
                        <p><strong>Passport Photo:</strong> <a href="{{ asset( $workPermit->passportPhoto) }}" target="_blank">View</a></p>
                        @endif
                        @if($workPermit->bankAccountPhoto)
                        <p><strong>Bank Account Photo:</strong> <a href="{{ asset( $workPermit->bankAccountPhoto) }}" target="_blank">View</a></p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if($workPermit->visaPhoto)
                        <p><strong>Visa Photo:</strong> <a href="{{ asset( $workPermit->visaPhoto) }}" target="_blank">View</a></p>
                        @endif
                        @if($workPermit->chequePhoto)
                        <p><strong>Cheque Photo:</strong> <a href="{{ asset($workPermit->chequePhoto) }}" target="_blank">View</a></p>
                        @endif
                        @if($workPermit->agreementPhoto)
                        <p><strong>Agreement Photo:</strong> <a href="{{ asset($workPermit->agreementPhoto) }}" target="_blank">View</a></p>
                        @endif
                        @if($workPermit->otherDocumentsPhoto)
                        <p><strong>Other Documents:</strong> <a href="{{ asset( $workPermit->otherDocumentsPhoto) }}" target="_blank">View</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Additional Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Created At:</strong> {{ $workPermit->created_at->format('Y-m-d H:i') }}</p>
                <p><strong>Last Updated:</strong> {{ $workPermit->updated_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection