@extends('frontend.layouts.main')

@section('title', isset($brokerAccount) ? 'Edit Broker Account' : 'Broker Account')

@section('content')

<section class="ad_banner p-4 border border-1 border-dark-subtle mt-5 text-center mb-4">
    <h2 class="py-4">Advertisement Banner</h2>
</section>
<style>
    .broker img.img {
        max-width: 200px;
        max-height: 250px;
    }

    .form-control::placeholder {
        color: #6c757d;
        opacity: 0.7;
    }
</style>
<section class="prform mt-4">
    <div class="container-fluid container-lg">
        <div id="form-container" class="container-fluid container-lg border border-1 border-dark-subtle rounded-4 p-md-5 py-5">
            <!-- Broker Account Form -->
            <div id="brokerAccountForm" class="multi-step-form">
                <div class="d-flex">
                    <div class="col text-center">
                        <h3 style="color:#0064a7;">Broker Account Opening Form</h3>
                    </div>
                </div>
                <!-- Form 1 - Personal Information -->
                <div id="moneyexchangeForm1" class="multi-step-form" style="display: block;">
                    <div class="d-flex">
                        <div class="col text-center">
                            <h3 style="color:#0064a7;">Nepal Stock Exchange Trade Management System</h3>
                            <p class="fw-normal" style="font-size: 24px;">Online Registration Form</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        @if ($errors->any())
                        <div class="alert alert-danger" id="error-alert">
                            <strong>Please fix the following errors:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <script>
                            // Automatically hide the error message after 10 seconds (10000 milliseconds)
                            setTimeout(function() {
                                let alert = document.getElementById('error-alert');
                                if (alert) {
                                    alert.style.display = 'none';
                                }
                            }, 10000);
                        </script>
                        @endif
                        <form id="brokerAccount" action="{{ isset($brokerAccount) ? route('brokerAccounts.update', $brokerAccount->id) : route('brokerAccounts.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if(isset($brokerAccount))
                            @method('PUT')
                            @endif
                            <input type="hidden" name="jobSeekerId" value="{{ auth()->user()->id ?? '' }}">

                            <!-- Account Information Section -->
                            <div class="attestation">
                                <div class="">
                                    <h4 class="py-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Depository Details</h4>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                        <div class="col">
                                            <label for="boid" class="form-label fs-6">
                                                BOID: <span class="text-danger fw-bold">*</span></label>
                                            <input type="text" class="form-control form-control-da fs-6" id="boid" name="boid" required maxlength="255" value="{{ $brokerAccount->boid ?? old('boid') }}" placeholder="Enter your 16-digit BOID number">
                                        </div>

                                    </div>


                                    <div class="">
                                        <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block">Personal Details</h4>
                                    </div>
                                    <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                        <div class="col">
                                            <label for="referralCode" class="form-label fs-6">Referral Code:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="referralCode" name="referralCode" maxlength="255" value="{{ $brokerAccount->referralCode ?? old('referralCode') }}" placeholder="Enter referral code if any">
                                        </div>
                                        <div class="col">
                                            <label for="clientType" class="form-label fs-6">Client Type <span class="text-danger fw-bold">*</span>:</label>
                                            <select class="form-select form-control-da fs-6" id="clientType" name="clientType" required>
                                                <option value="">-- Select Type --</option>
                                                <option value="individual" {{ (isset($brokerAccount->clientType) && $brokerAccount->clientType == 'individual') ? 'selected' : (old('clientType') == 'individual' ? 'selected' : '') }}>Individual</option>
                                                <option value="institutional" {{ (isset($brokerAccount->clientType) && $brokerAccount->clientType == 'institutional') ? 'selected' : (old('clientType') == 'institutional' ? 'selected' : '') }}>Institutional</option>
                                                <option value="minor" {{ (isset($brokerAccount->clientType) && $brokerAccount->clientType == 'minor') ? 'selected' : (old('clientType') == 'minor' ? 'selected' : '') }}>Minor</option>
                                                <option value="foreign" {{ (isset($brokerAccount->clientType) && $brokerAccount->clientType == 'foreign') ? 'selected' : (old('clientType') == 'foreign' ? 'selected' : '') }}>Foreign</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="mobileNumber" class="form-label fs-6">Mobile Number <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="mobileNumber" name="mobileNumber" required maxlength="255" value="{{ $brokerAccount->mobileNumber ?? old('mobileNumber') }}" placeholder="Enter your mobile number">
                                        </div>
                                        <div class="col">
                                            <label for="branchName" class="form-label fs-6">Branch Name <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="branchName" name="branchName" required maxlength="255" value="{{ $brokerAccount->branchName ?? old('branchName') }}" placeholder="Enter branch name">
                                        </div>
                                        <div class="col">
                                            <label for="panNumber" class="form-label fs-6">PAN Number:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="panNumber" name="panNumber" maxlength="255" value="{{ $brokerAccount->panNumber ?? old('panNumber') }}" placeholder="Enter PAN number if available">
                                        </div>
                                        <div class="col">
                                            <label for="emailAddress" class="form-label fs-6">Email Address <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="email" class="form-control form-control-da fs-6" id="emailAddress" name="emailAddress" required maxlength="255" value="{{ $brokerAccount->emailAddress ?? old('emailAddress') }}" placeholder="Enter your email address">
                                        </div>
                                        <div class="col">
                                            <label for="whatsappNumber" class="form-label fs-6">WhatsApp Number:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="whatsappNumber" name="whatsappNumber" maxlength="255" value="{{ $brokerAccount->whatsappNumber ?? old('whatsappNumber') }}" placeholder="Enter WhatsApp number if different">
                                        </div>
                                        <div class="col">
                                            <label for="viberNumber" class="form-label fs-6">Viber Number:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="viberNumber" name="viberNumber" maxlength="255" value="{{ $brokerAccount->viberNumber ?? old('viberNumber') }}" placeholder="Enter Viber number if available">
                                        </div>
                                        <div class="col">
                                            <label for="facebookLink" class="form-label fs-6">Facebook Link:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="facebookLink" name="facebookLink" maxlength="255" value="{{ $brokerAccount->facebookLink ?? old('facebookLink') }}" placeholder="Enter Facebook profile link">
                                        </div>
                                    </div>
                                </div>

                                <!-- Bank Details Section -->
                                <div class="attestation">
                                    <div class="">
                                        <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Bank Details</h4>
                                    </div>
                                    <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                        <div class="col">
                                            <label for="bankName" class="form-label fs-6">Bank Name <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="bankName" name="bankName" required maxlength="255" value="{{ $brokerAccount->bankName ?? old('bankName') }}" placeholder="Enter your bank name">
                                        </div>
                                        <div class="col">
                                            <label for="bankBranch" class="form-label fs-6">Bank Branch <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="bankBranch" name="bankBranch" required maxlength="255" value="{{ $brokerAccount->bankBranch ?? old('bankBranch') }}" placeholder="Enter bank branch">
                                        </div>
                                        <div class="col">
                                            <label for="accountType" class="form-label fs-6">Account Type <span class="text-danger fw-bold">*</span>:</label>
                                            <select class="form-select form-control-da fs-6" id="accountType" name="accountType" required>
                                                <option value="">-- Select Type --</option>
                                                <option value="saving" {{ (isset($brokerAccount->accountType) && $brokerAccount->accountType == 'saving') ? 'selected' : (old('accountType') == 'saving' ? 'selected' : '') }}>Saving</option>
                                                <option value="current" {{ (isset($brokerAccount->accountType) && $brokerAccount->accountType == 'current') ? 'selected' : (old('accountType') == 'current' ? 'selected' : '') }}>Current</option>
                                                <option value="fixed" {{ (isset($brokerAccount->accountType) && $brokerAccount->accountType == 'fixed') ? 'selected' : (old('accountType') == 'fixed' ? 'selected' : '') }}>Fixed</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="accountNumber" class="form-label fs-6">Account Number <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="accountNumber" name="accountNumber" required maxlength="255" value="{{ $brokerAccount->accountNumber ?? old('accountNumber') }}" placeholder="Enter your bank account number">
                                        </div>
                                    </div>
                                </div>

                                <!-- Investment Information Section -->
                                <div class="attestation">
                                    <div class="">
                                        <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Investment Information</h4>
                                    </div>
                                    <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                        <div class="col">
                                            <label for="investmentSource" class="form-label fs-6">Source of Investment:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="investmentSource" name="investmentSource" maxlength="255" value="{{ $brokerAccount->investmentSource ?? old('investmentSource') }}" placeholder="Enter source of investment funds">
                                        </div>
                                        <div class="col">
                                            <label for="companyName" class="form-label fs-6">Company/Business Name:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="companyName" name="companyName" maxlength="255" value="{{ $brokerAccount->companyName ?? old('companyName') }}" placeholder="Enter company name if applicable">
                                        </div>
                                        <div class="col">
                                            <label for="jobBusinessYears" class="form-label fs-6">Years of Job/Business :</label>
                                            <input type="number" class="form-control form-control-da fs-6" id="jobBusinessYears" name="jobBusinessYears" value="{{ $brokerAccount->jobBusinessYears ?? old('jobBusinessYears') }}" placeholder="Enter years in current job/business">
                                        </div>
                                        <div class="col">
                                            <label for="investmentAmount" class="form-label fs-6">Amount Willing to invest (NPR):</label>
                                            <input type="number" step="0.01" class="form-control form-control-da fs-6" id="investmentAmount" name="investmentAmount" value="{{ $brokerAccount->investmentAmount ?? old('investmentAmount') }}" placeholder="Enter approximate investment amount">
                                        </div>
                                        <div class="col">
                                            <label class="form-label fs-6 d-block"> Do you have Trading Knowledge:</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tradingKnowledge" id="tradingKnowledge_yes" value="1"
                                                    {{ (isset($brokerAccount->tradingKnowledge) && $brokerAccount->tradingKnowledge == 1) ? 'checked' : (old('tradingKnowledge') == '1' ? 'checked' : '') }}>
                                                <label class="form-check-label  text-secondary" for="tradingKnowledge_yes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tradingKnowledge" id="tradingKnowledge_no" value="0"
                                                    {{ (isset($brokerAccount->tradingKnowledge) && $brokerAccount->tradingKnowledge == 0) ? 'checked' : (old('tradingKnowledge') == '0' ? 'checked' : '') }}>
                                                <label class="form-check-label text-secondary" for="tradingKnowledge_no">No(First Time)</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Permanent Address Section -->
                                <div class="attestation">
                                    <div class="">
                                        <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Permanent Address</h4>
                                    </div>
                                    <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                        <div class="col">
                                            <label for="permanentCountry" class="form-label fs-6">Country <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="permanentCountry" name="permanentCountry" required maxlength="255" value="{{ $brokerAccount->permanentCountry ?? old('permanentCountry') }}" placeholder="Enter country name">
                                        </div>
                                        <div class="col">
                                            <label for="permanentProvince" class="form-label fs-6">Province <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="permanentProvince" name="permanentProvince" required maxlength="255" value="{{ $brokerAccount->permanentProvince ?? old('permanentProvince') }}" placeholder="Enter province name">
                                        </div>
                                        <div class="col">
                                            <label for="permanentDistrict" class="form-label fs-6">District <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="permanentDistrict" name="permanentDistrict" required maxlength="255" value="{{ $brokerAccount->permanentDistrict ?? old('permanentDistrict') }}" placeholder="Enter district name">
                                        </div>
                                        <div class="col">
                                            <label for="permanentMunicipality" class="form-label fs-6">Municipality <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="permanentMunicipality" name="permanentMunicipality" required maxlength="255" value="{{ $brokerAccount->permanentMunicipality ?? old('permanentMunicipality') }}" placeholder="Enter municipality name">
                                        </div>
                                        <div class="col">
                                            <label for="permanentWard" class="form-label fs-6">Ward No <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="number" class="form-control form-control-da fs-6" id="permanentWard" name="permanentWard" required value="{{ $brokerAccount->permanentWard ?? old('permanentWard') }}" placeholder="Enter ward number">
                                        </div>
                                        <div class="col">
                                            <label for="permanentCity" class="form-label fs-6">City <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="permanentCity" name="permanentCity" required maxlength="255" value="{{ $brokerAccount->permanentCity ?? old('permanentCity') }}" placeholder="Enter city name">
                                        </div>
                                        <div class="col">
                                            <label for="permanentTole" class="form-label fs-6">Tole <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="permanentTole" name="permanentTole" required maxlength="255" value="{{ $brokerAccount->permanentTole ?? old('permanentTole') }}" placeholder="Enter tole name">
                                        </div>
                                        <div class="col">
                                            <label for="permanentStreet" class="form-label fs-6">Street:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="permanentStreet" name="permanentStreet" maxlength="255" value="{{ $brokerAccount->permanentStreet ?? old('permanentStreet') }}" placeholder="Enter street name if applicable">
                                        </div>
                                        <div class="col">
                                            <label for="permanentHouseNo" class="form-label fs-6">House No:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="permanentHouseNo" name="permanentHouseNo" maxlength="255" value="{{ $brokerAccount->permanentHouseNo ?? old('permanentHouseNo') }}" placeholder="Enter house number if applicable">
                                        </div>
                                    </div>
                                </div>

                                <!-- Temporary Address Section -->
                                <div class="attestation">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Temporary Address</h4>
                                        </div>
                                        <div class="form-check mt-4">
                                            <input class="form-check-input fs-6" type="checkbox" value="1" id="sameAsPermanent" name="sameAsPermanent"
                                                {{ (isset($brokerAccount->sameAsPermanent) && $brokerAccount->sameAsPermanent == 1) ? 'checked' : (old('sameAsPermanent') == '1' ? 'checked' : '') }}>
                                            <label class="form-check-label fs-6" for="sameAsPermanent">Same as Permanent Address</label>
                                        </div>
                                    </div>
                                    <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                        <div class="col">
                                            <label for="temporaryCountry" class="form-label fs-6">Country <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="temporaryCountry" name="temporaryCountry" required maxlength="255" value="{{ $brokerAccount->temporaryCountry ?? old('temporaryCountry') }}" placeholder="Enter country name">
                                        </div>
                                        <div class="col">
                                            <label for="temporaryProvince" class="form-label fs-6">Province <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="temporaryProvince" name="temporaryProvince" required maxlength="255" value="{{ $brokerAccount->temporaryProvince ?? old('temporaryProvince') }}" placeholder="Enter province name">
                                        </div>
                                        <div class="col">
                                            <label for="temporaryDistrict" class="form-label fs-6">District <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="temporaryDistrict" name="temporaryDistrict" required maxlength="255" value="{{ $brokerAccount->temporaryDistrict ?? old('temporaryDistrict') }}" placeholder="Enter district name">
                                        </div>
                                        <div class="col">
                                            <label for="temporaryMunicipality" class="form-label fs-6">Municipality <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="temporaryMunicipality" name="temporaryMunicipality" required maxlength="255" value="{{ $brokerAccount->temporaryMunicipality ?? old('temporaryMunicipality') }}" placeholder="Enter municipality name">
                                        </div>
                                        <div class="col">
                                            <label for="temporaryWard" class="form-label fs-6">Ward No <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="number" class="form-control form-control-da fs-6" id="temporaryWard" name="temporaryWard" required value="{{ $brokerAccount->temporaryWard ?? old('temporaryWard') }}" placeholder="Enter ward number">
                                        </div>
                                        <div class="col">
                                            <label for="temporaryCity" class="form-label fs-6">City <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="temporaryCity" name="temporaryCity" required maxlength="255" value="{{ $brokerAccount->temporaryCity ?? old('temporaryCity') }}" placeholder="Enter city name">
                                        </div>
                                        <div class="col">
                                            <label for="temporaryTole" class="form-label fs-6">Tole <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="temporaryTole" name="temporaryTole" required maxlength="255" value="{{ $brokerAccount->temporaryTole ?? old('temporaryTole') }}" placeholder="Enter tole name">
                                        </div>
                                        <div class="col">
                                            <label for="temporaryStreet" class="form-label fs-6">Street:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="temporaryStreet" name="temporaryStreet" maxlength="255" value="{{ $brokerAccount->temporaryStreet ?? old('temporaryStreet') }}" placeholder="Enter street name if applicable">
                                        </div>
                                        <div class="col">
                                            <label for="temporaryHouseNo" class="form-label fs-6">House No:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="temporaryHouseNo" name="temporaryHouseNo" maxlength="255" value="{{ $brokerAccount->temporaryHouseNo ?? old('temporaryHouseNo') }}" placeholder="Enter house number if applicable">
                                        </div>
                                    </div>
                                </div>

                                <!-- Documents Section -->
                                <div class="broker">
                                    <div>
                                        <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Required Documents</h4>
                                    </div>
                                    <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-2 row-gap-3">

                                        <div class="col">
                                            <label for="kycForm" class="form-label fs-6">Clienr Registration Form KYC:</label><br>
                                            <label class="form-label  mb-3" style="font-size: 14px">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                            <input type="file" class="form-control form-control-da fs-6" id="kycForm" name="kycForm" accept=".jpg,.jpeg,.png,.pdf" onchange="handleImagePreview(this)">
                                            @if(isset($brokerAccount) && $brokerAccount->kycForm)
                                            <img src="{{ asset($brokerAccount->kycForm) }}" alt="KYC Form" class="img-fluid img mt-2 rounded w-100">
                                            @else
                                            <img src="#" alt="KYC Form Preview" class="img-fluid img mt-2 rounded w-100 d-none">
                                            @endif
                                        </div>

                                        <div class="col">
                                            <label for="citizenCertificate" class="form-label fs-6">Citizenship Certificate <span class="text-danger fw-bold">*</span>:</label><br>
                                            <label class="form-label  mb-3" style="font-size: 14px">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                            <input type="file" class="form-control form-control-da fs-6" id="citizenCertificate" name="citizenCertificate" accept=".jpg,.jpeg,.png,.pdf" {{ !isset($brokerAccount) ? 'required' : '' }} onchange="handleImagePreview(this)">
                                            @if(isset($brokerAccount) && $brokerAccount->citizenCertificate)
                                            <img src="{{ asset($brokerAccount->citizenCertificate) }}" alt="Citizenship Certificate" class="img-fluid img mt-2 rounded w-100 h-100">
                                            @else
                                            <img src="#" alt="Citizenship Preview" class="img-fluid img mt-2 rounded w-100 d-none">
                                            @endif
                                        </div>

                                        <div class="col">
                                            <label for="birthCertificate" class="form-label fs-6">Birth Certificate Incase of Minor:</label><br>
                                            <label class="form-label  mb-3" style="font-size: 14px">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                            <input type="file" class="form-control form-control-da fs-6" id="birthCertificate" name="birthCertificate" accept=".jpg,.jpeg,.png,.pdf" onchange="handleImagePreview(this)">
                                            @if(isset($brokerAccount) && $brokerAccount->birthCertificate)
                                            <img src="{{ asset($brokerAccount->birthCertificate) }}" alt="Birth Certificate" class="img-fluid img mt-2 rounded w-100">
                                            @else
                                            <img src="#" alt="Birth Certificate Preview" class="img-fluid img mt-2 rounded w-100 d-none">
                                            @endif
                                        </div>

                                        <div class="col">
                                            <label for="visaPassport" class="form-label fs-6">Visa/Passport incase of Foreign Emp.:</label><br>
                                            <label class="form-label mb-3" style="font-size: 14px">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                            <input type="file" class="form-control form-control-da fs-6" id="visaPassport" name="visaPassport" accept=".jpg,.jpeg,.png,.pdf" onchange="handleImagePreview(this)">
                                            @if(isset($brokerAccount) && $brokerAccount->visaPassport)
                                            <img src="{{ asset($brokerAccount->visaPassport) }}" alt="Visa/Passport" class="img-fluid img mt-2 rounded w-100">
                                            @else
                                            <img src="#" alt="Visa/Passport Preview" class="img-fluid img mt-2 rounded w-100 d-none">
                                            @endif
                                        </div>

                                        <div class="col">
                                            <label for="selfieWithId" class="form-label fs-6">Selfie with carrying any Gov issued ID:</label><br>
                                            <label class="form-label  mb-3" style="font-size: 14px">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                            <input type="file" class="form-control form-control-da fs-6" id="selfieWithId" name="selfieWithId" accept=".jpg,.jpeg,.png,.pdf" onchange="handleImagePreview(this)">
                                            @if(isset($brokerAccount) && $brokerAccount->selfieWithId)
                                            <img src="{{ asset($brokerAccount->selfieWithId) }}" alt="Selfie with ID" class="img-fluid img mt-2 rounded w-100">
                                            @else
                                            <img src="#" alt="Selfie ID Preview" class="img-fluid img mt-2 rounded w-100 d-none">
                                            @endif
                                        </div>

                                        <div class="col">
                                            <label for="guardianCitizenship" class="form-label fs-6">Guardian Citizenship Incase of Minor:</label><br>
                                            <label class="form-label mb-3" style="font-size: 14px">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                            <input type="file" class="form-control form-control-da fs-6" id="guardianCitizenship" name="guardianCitizenship" accept=".jpg,.jpeg,.png,.pdf" onchange="handleImagePreview(this)">
                                            @if(isset($brokerAccount) && $brokerAccount->guardianCitizenship)
                                            <img src="{{ asset($brokerAccount->guardianCitizenship) }}" alt="Guardian Citizenship" class="img-fluid img mt-2 rounded w-100">
                                            @else
                                            <img src="#" alt="Guardian Citizenship Preview" class="img-fluid img mt-2 rounded w-100 d-none">
                                            @endif
                                        </div>

                                        <div class="col">
                                            <label for="ppSizePhoto" class="form-label fs-6">Passport Size Photo <span class="text-danger fw-bold">*</span>:</label><br>
                                            <label class="form-label mb-3" style="font-size: 14px">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                            <input type="file" class="form-control form-control-da fs-6" id="ppSizePhoto" name="ppSizePhoto" accept=".jpg,.jpeg,.png,.pdf" {{ !isset($brokerAccount) ? 'required' : '' }} onchange="handleImagePreview(this)">
                                            @if(isset($brokerAccount) && $brokerAccount->ppSizePhoto)
                                            <img src="{{ asset($brokerAccount->ppSizePhoto) }}" alt="Passport Size Photo" class="img-fluid img mt-2 rounded w-100">
                                            @else
                                            <img src="#" alt="Passport Size Preview" class="img-fluid img mt-2 rounded w-100 d-none">
                                            @endif
                                        </div>

                                        <div class="col">
                                            <label for="tradingAgreement" class="form-label fs-6">Online Trading Agreement Form:</label><br>
                                            <label class="form-label mb-3" style="font-size: 14px">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                            <input type="file" class="form-control form-control-da fs-6" id="tradingAgreement" name="tradingAgreement" accept=".jpg,.jpeg,.png,.pdf" onchange="handleImagePreview(this)">
                                            @if(isset($brokerAccount) && $brokerAccount->tradingAgreement)
                                            <img src="{{ asset($brokerAccount->tradingAgreement) }}" alt="Trading Agreement" class="img-fluid img mt-2 rounded w-100">
                                            @else
                                            <img src="#" alt="Trading Agreement Preview" class="img-fluid img mt-2 rounded w-100 d-none">
                                            @endif
                                        </div>

                                        <div class="col">
                                            <label for="idCard" class="form-label fs-6">ID Card:</label><br>
                                            <label class="form-label mb-3" style="font-size: 14px">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                            <input type="file" class="form-control form-control-da fs-6" id="idCard" name="idCard" accept=".jpg,.jpeg,.png,.pdf" onchange="handleImagePreview(this)">
                                            @if(isset($brokerAccount) && $brokerAccount->idCard)
                                            <img src="{{ asset($brokerAccount->idCard) }}" alt="ID Card" class="img-fluid img mt-2 rounded w-100">
                                            @else
                                            <img src="#" alt="ID Card Preview" class="img-fluid img mt-2 rounded w-100 d-none">
                                            @endif
                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="my-4 border border-1 border-secondary"></div>
                            <div class="d-flex flex-column mx-3 mb-5">
                                <div class="form-check">
                                    <input class="form-check-input fs-6" type="checkbox" value="" id="checkCorrect" required>
                                    <label class="form-check-label fs-6" for="checkCorrect">
                                        <span class="required"></span> I confirm that all information provided is accurate and complete. I understand
                                        that providing false information may result in the rejection of my application and possible legal consequences.
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input fs-6" type="checkbox" value="" id="checkTerms" required>
                                    <label class="form-check-label fs-6" for="checkTerms">
                                        <span class="required"></span> I agree to the Terms and Conditions and Privacy Policy of Kamsansar's Brokers Account service.
                                    </label>
                                </div>
                                <div class="required-fields-message text-danger fw-bold fw-bold">* - Required fields -
                                    Please
                                    fill all
                                    required fields before proceeding.</div>
                            </div>
                            <div class="d-flex justify-content-end py-4">
                                <button type="submit" class="btn btn" id="submitBtn" disabled style="background-color: #0064a7; color: white;">
                                    {{ isset($brokerAccount) ? 'Update' : 'Submit' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>

<script>
    // Same as permanent address functionality
    $(document).ready(function() {
        // Function to copy permanent to temporary address
        function copyPermanentToTemporary() {
            $('#temporaryCountry').val($('#permanentCountry').val());
            $('#temporaryProvince').val($('#permanentProvince').val());
            $('#temporaryDistrict').val($('#permanentDistrict').val());
            $('#temporaryMunicipality').val($('#permanentMunicipality').val());
            $('#temporaryWard').val($('#permanentWard').val());
            $('#temporaryCity').val($('#permanentCity').val());
            $('#temporaryTole').val($('#permanentTole').val());
            $('#temporaryStreet').val($('#permanentStreet').val());
            $('#temporaryHouseNo').val($('#permanentHouseNo').val());

            $('#form-container .accordion-body input[id^="temporary"]').prop('readonly', true);
        }

        // Function to clear temporary address fields
        function clearTemporaryAddress() {
            $('#form-container .accordion-body input[id^="temporary"]').val('').prop('readonly', false);
        }

        // Check on page load if checkbox is checked
        if ($('#sameAsPermanent').is(':checked')) {
            copyPermanentToTemporary();
        }

        // Handle checkbox change
        $('#sameAsPermanent').change(function() {
            if (this.checked) {
                copyPermanentToTemporary();
            } else {
                clearTemporaryAddress();
            }
        });

        // Handle permanent address changes when checkbox is checked
        $('#form-container .accordion-body input[id^="permanent"]').on('input', function() {
            if ($('#sameAsPermanent').is(':checked')) {
                var permanentField = $(this).attr('id');
                var tempField = permanentField.replace('permanent', 'temporary');
                $('#' + tempField).val($(this).val());
            }
        });

    });
    document.addEventListener('DOMContentLoaded', function() {
        const checkCorrect = document.getElementById('checkCorrect');
        const checkTerms = document.getElementById('checkTerms');
        const submitBtn = document.getElementById('submitBtn');

        function toggleSubmitButton() {
            submitBtn.disabled = !(checkCorrect.checked && checkTerms.checked);
        }

        checkCorrect.addEventListener('change', toggleSubmitButton);
        checkTerms.addEventListener('change', toggleSubmitButton);
    });

    function handleImagePreview(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            const preview = input.nextElementSibling;

            reader.onload = function(e) {
                if (preview && preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                }
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection