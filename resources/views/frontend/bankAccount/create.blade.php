@extends('frontend.layouts.main')

@section('title', isset($bankAccount) ? 'Edit Bank Account' : 'Create Bank Account')

@section('content')

<section class="ad_banner p-4 border border-1 border-dark-subtle mt-5 text-center mb-4">
    <h2 class="py-4">Advertisement Banner</h2>
</section>

<section class="prform mt-4">
    <div class="container-fluid container-lg">
        <div id="form-container"
            class="container-fluid container-lg border border-1 border-dark-subtle rounded-4 p-md-5 py-5">

            <!-- Form 1 - Personal Information -->
            <div id="moneyexchangeForm1" class="multi-step-form">
                <div class="d-flex">
                    <div class="col text-center">
                        <h3 style="color:#0064a7;">{{ isset($bankAccount) ? 'Edit Account' : 'Account Opening Form' }}</h3>
                    </div>
                </div>
                <div class="pt-5 pb-2">
                    <h1 style="font-size: 20px; font-weight: 500;">Dear ABZ Bank,</h1>
                    <p class="fw-normal" style="font-size: 18px;">Quo impedit dolores alias sunt corporis
                        voluptatibus necessitatibus laudantium. A sit reprehenderit quasi
                        quis tenetur consequatur accusantium eos. Delectus aperiam aperiam deserunt reprehenderit.
                        Magnam
                        cum labore sit inventore nobis doloribus. </p>
                </div>

                <div class="mt-4">
                    <!-- Form 1 Content -->
                    <form id="bankAccount" action="{{ isset($bankAccount) ? route('bankAccounts.update', $bankAccount->id) : route('bankAccounts.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(isset($bankAccount))
                        @method('PUT')
                        @endif

                        <div class="attestation">
                            <div class="">
                                <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Applicant Type</h4>
                            </div>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                    <div class="col">
                                        <label for="applicantType" class="form-label fs-6">Applicant Type <span class="text-danger fw-bold fw-bold">*</span>:</label>
                                        <select class="form-select form-control-da fs-6" id="applicantType" name="applicantType" required>
                                            <option value="">-- Select Type --</option>
                                            <option value="Individual" {{ old('applicantType', $bankAccount->applicantType ?? '') == 'Individual' ? 'selected' : '' }}>Individual</option>
                                            <option value="Business" {{ old('applicantType', $bankAccount->applicantType ?? '') == 'Business' ? 'selected' : '' }}>Business</option>
                                            <option value="Organization" {{ old('applicantType', $bankAccount->applicantType ?? '') == 'Organization' ? 'selected' : '' }}>Organization</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="salutation" class="form-label fs-6">Salutation <span class="text-danger fw-bold fw-bold">*</span>:</label>
                                        <select class="form-select form-control-da fs-6" id="salutation" name="salutation" required>
                                            <option value="">-- Select --</option>
                                            <option value="Mr" {{ old('salutation', $bankAccount->salutation ?? '') == 'Mr' ? 'selected' : '' }}>Mr</option>
                                            <option value="Mrs" {{ old('salutation', $bankAccount->salutation ?? '') == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                                            <option value="Miss" {{ old('salutation', $bankAccount->salutation ?? '') == 'Miss' ? 'selected' : '' }}>Miss</option>
                                            <option value="Dr" {{ old('salutation', $bankAccount->salutation ?? '') == 'Dr' ? 'selected' : '' }}>Dr</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label class="form-label fs-6 d-block">Nepali Citizen <span class="text-danger fw-bold">*</span>:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nepaleseCitizen" id="nepaleseCitizen_yes" value="1" {{ (old('nepaleseCitizen', $bankAccount->nepaleseCitizen ?? 1) == 1) ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="nepaleseCitizen_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nepaleseCitizen" id="nepaleseCitizen_no" value="0" {{ (old('nepaleseCitizen', $bankAccount->nepaleseCitizen ?? '') == 0) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="nepaleseCitizen_no">No</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label for="applicantPurpose" class="form-label fs-6">Applicant Purpose <span class="text-danger fw-bold">*</span>:</label>
                                        <select class="form-select form-control-da fs-6" id="applicantPurpose" name="applicantPurpose" required>
                                            <option value="">-- Select Purpose --</option>
                                            <option value="Personal" {{ old('applicantPurpose', $bankAccount->applicantPurpose ?? '') == 'Personal' ? 'selected' : '' }}>Personal</option>
                                            <option value="Business" {{ old('applicantPurpose', $bankAccount->applicantPurpose ?? '') == 'Business' ? 'selected' : '' }}>Business</option>
                                            <option value="Investment" {{ old('applicantPurpose', $bankAccount->applicantPurpose ?? '') == 'Investment' ? 'selected' : '' }}>Investment</option>
                                            <option value="Other" {{ old('applicantPurpose', $bankAccount->applicantPurpose ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="preferredBank" class="form-label fs-6">Preferred Bank <span class="text-danger fw-bold">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="preferredBank" name="preferredBank" value="{{ old('preferredBank', $bankAccount->preferredBank ?? '') }}" required maxlength="255" placeholder="Enter your preferred bank name">
                                    </div>
                                    <div class="col">
                                        <label for="branch" class="form-label fs-6">Branch <span class="text-danger fw-bold">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="branch" name="branch" value="{{ old('branch', $bankAccount->branch ?? '') }}" required maxlength="255" placeholder="Enter branch name">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="attestation">
                            <div class="">
                                <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Personal Details</h4>
                            </div>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                    <div class="col">
                                        <label for="firstName" class="form-label fs-6">First Name <span class="text-danger fw-bold">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="firstName" name="firstName" value="{{ old('firstName', $bankAccount->firstName ?? '') }}" required maxlength="255" placeholder="Enter your first name">
                                    </div>
                                    <div class="col">
                                        <label for="middleName" class="form-label fs-6">Middle Name:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="middleName" name="middleName" value="{{ old('middleName', $bankAccount->middleName ?? '') }}" maxlength="255" placeholder="Enter your middle name">
                                    </div>
                                    <div class="col">
                                        <label for="lastName" class="form-label fs-6">Last Name <span class="text-danger fw-bold">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="lastName" name="lastName" value="{{ old('lastName', $bankAccount->lastName ?? '') }}" required maxlength="255" placeholder="Enter your last name">
                                    </div>
                                    <div class="col">
                                        <label for="mobileNumber" class="form-label fs-6">Mobile Number <span class="text-danger fw-bold">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="mobileNumber" name="mobileNumber" value="{{ old('mobileNumber', $bankAccount->mobileNumber ?? '') }}" required maxlength="255" placeholder="Enter your mobile number">
                                    </div>
                                    <div class="col">
                                        <label for="phoneNumber" class="form-label fs-6">Phone Number:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber', $bankAccount->phoneNumber ?? '') }}" maxlength="255" placeholder="Enter your phone number">
                                    </div>
                                    <div class="col">
                                        <label for="email" class="form-label fs-6">Email Address:</label>
                                        <input type="email" class="form-control form-control-da fs-6" id="email" name="email" value="{{ old('email', $bankAccount->email ?? '') }}" maxlength="255" placeholder="Enter your email address">
                                    </div>

                                    <div class="col">
                                        <label for="englishDob" class="fs-6 mb-1">Date of Birth (AD):</label>
                                        <input type="date" placeholder="2050-06-15" id="englishDob" name="englishDob"
                                            class="fs-6 form-control"
                                            value="{{ old('englishDob', $bankAccount->englishDob ?? '') }}">
                                    </div>

                                    <div class="col">
                                        <label for="nepaliDob" class="fs-6 mb-1">Date of Birth (BS):</label>
                                        <input type="text" placeholder="2050-06-15" id="nepaliDob" name="nepaliDob"
                                            class="fs-6 form-control"
                                            value="{{ old('nepaliDob', $bankAccount->nepaliDob ?? '') }}">
                                    </div>

                                    <div class="col">
                                        <label for="applyFromCountry" class="form-label fs-6">Apply From Country:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="applyFromCountry" name="applyFromCountry" value="{{ old('applyFromCountry', $bankAccount->applyFromCountry ?? '') }}" maxlength="255" placeholder="Enter country name">
                                    </div>
                                    <div class="col">
                                        <label for="contactMedium" class="form-label fs-6">Contact Medium:</label>
                                        <select class="form-select form-control-da fs-6" id="contactMedium" name="contactMedium">
                                            <option value="">-- Select Medium --</option>
                                            <option value="Email" {{ old('contactMedium', $bankAccount->contactMedium ?? '') == 'Email' ? 'selected' : '' }}>Email</option>
                                            <option value="Phone" {{ old('contactMedium', $bankAccount->contactMedium ?? '') == 'Phone' ? 'selected' : '' }}>Phone</option>
                                            <option value="Mobile" {{ old('contactMedium', $bankAccount->contactMedium ?? '') == 'Mobile' ? 'selected' : '' }}>Mobile</option>
                                            <option value="Other" {{ old('contactMedium', $bankAccount->contactMedium ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="otherContactDetail" class="form-label fs-6">Other Contact Details:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="otherContactDetail" name="otherContactDetail" value="{{ old('otherContactDetail', $bankAccount->otherContactDetail ?? '') }}" maxlength="255" placeholder="Enter other contact details">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="attestation">
                            <div class="">
                                <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Family Details</h4>
                            </div>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                    <div class="col">
                                        <label for="fatherName" class="form-label fs-6">Father's Name <span class="text-danger fw-bold">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="fatherName" name="fatherName" value="{{ old('fatherName', $bankAccount->fatherName ?? '') }}" required maxlength="255" placeholder="Enter father's name">
                                    </div>
                                    <div class="col">
                                        <label for="motherName" class="form-label fs-6">Mother's Name <span class="text-danger fw-bold">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="motherName" name="motherName" value="{{ old('motherName', $bankAccount->motherName ?? '') }}" required maxlength="255" placeholder="Enter mother's name">
                                    </div>
                                    <div class="col">
                                        <label for="grandfatherName" class="form-label fs-6">Grandfather's Name <span class="text-danger fw-bold">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="grandfatherName" name="grandfatherName" value="{{ old('grandfatherName', $bankAccount->grandfatherName ?? '') }}" required maxlength="255" placeholder="Enter grandfather's name">
                                    </div>
                                    <div class="col">
                                        <label for="spouse" class="form-label fs-6">Spouse Name:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="spouse" name="spouse" value="{{ old('spouse', $bankAccount->spouse ?? '') }}" maxlength="255" placeholder="Enter spouse name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="attestation">
                                <div class="">
                                    <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Permanent Address</h4>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                        <div class="col">
                                            <label for="permanentCountry" class="form-label fs-6">Country <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="permanentCountry" name="permanentCountry" value="{{ old('permanentCountry', $bankAccount->permanentCountry ?? '') }}" required maxlength="255" placeholder="Enter country name">
                                        </div>
                                        <div class="col">
                                            <label for="permanentProvince" class="form-label fs-6">Province <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="permanentProvince" name="permanentProvince" value="{{ old('permanentProvince', $bankAccount->permanentProvince ?? '') }}" required maxlength="255" placeholder="Enter province name">
                                        </div>
                                        <div class="col">
                                            <label for="permanentDistrict" class="form-label fs-6">District <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="permanentDistrict" name="permanentDistrict" value="{{ old('permanentDistrict', $bankAccount->permanentDistrict ?? '') }}" required maxlength="255" placeholder="Enter district name">
                                        </div>
                                        <div class="col">
                                            <label for="permanentMunicipality" class="form-label fs-6">Municipality <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="permanentMunicipality" name="permanentMunicipality" value="{{ old('permanentMunicipality', $bankAccount->permanentMunicipality ?? '') }}" required maxlength="255" placeholder="Enter municipality name">
                                        </div>
                                        <div class="col">
                                            <label for="permanentCity" class="form-label fs-6">City <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="permanentCity" name="permanentCity" value="{{ old('permanentCity', $bankAccount->permanentCity ?? '') }}" required maxlength="255" placeholder="Enter city name">
                                        </div>
                                        <div class="col">
                                            <label for="permanentWardNo" class="form-label fs-6">Ward No <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="permanentWardNo" name="permanentWardNo" value="{{ old('permanentWardNo', $bankAccount->permanentWardNo ?? '') }}" required maxlength="255" placeholder="Enter ward number">
                                        </div>
                                        <div class="col">
                                            <label for="permanentStreet" class="form-label fs-6">Street:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="permanentStreet" name="permanentStreet" value="{{ old('permanentStreet', $bankAccount->permanentStreet ?? '') }}" maxlength="255" placeholder="Enter street name">
                                        </div>
                                        <div class="col">
                                            <label for="permanentState" class="form-label fs-6">State:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="permanentState" name="permanentState" value="{{ old('permanentState', $bankAccount->permanentState ?? '') }}" maxlength="255" placeholder="Enter state name">
                                        </div>
                                        <div class="col">
                                            <label for="permanentTole" class="form-label fs-6">Tole <span class="text-danger fw-bold">*</span>:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="permanentTole" name="permanentTole" value="{{ old('permanentTole', $bankAccount->permanentTole ?? '') }}" required maxlength="255" placeholder="Enter tole name">
                                        </div>
                                        <div class="col">
                                            <label for="permanentHouseNo" class="form-label fs-6">House No:</label>
                                            <input type="text" class="form-control form-control-da fs-6" id="permanentHouseNo" name="permanentHouseNo" value="{{ old('permanentHouseNo', $bankAccount->permanentHouseNo ?? '') }}" maxlength="255" placeholder="Enter house number">
                                        </div>
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
                                        <input class="form-check-input fs-6" type="checkbox" value="1" id="sameAsPermanent" name="sameAsPermanent" {{ old('sameAsPermanent', $bankAccount->sameAsPermanent ?? 0) == 1 ? 'checked' : '' }}> <label class="form-check-label fs-6" for="sameAsPermanent">Same as Permanent Address</label>
                                    </div>
                                </div>
                                <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                    <div class="col">
                                        <label for="temporaryCountry" class="form-label fs-6">Country <span class="text-danger fw-bold">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="temporaryCountry" name="temporaryCountry" value="{{ old('temporaryCountry', $bankAccount->temporaryCountry ?? '') }}" required maxlength="255" placeholder="Enter country name">
                                    </div>
                                    <div class="col">
                                        <label for="temporaryProvince" class="form-label fs-6">Province <span class="text-danger fw-bold">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="temporaryProvince" name="temporaryProvince" value="{{ old('temporaryProvince', $bankAccount->temporaryProvince ?? '') }}" required maxlength="255" placeholder="Enter province name">
                                    </div>
                                    <div class="col">
                                        <label for="temporaryDistrict" class="form-label fs-6">District <span class="text-danger fw-bold">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="temporaryDistrict" name="temporaryDistrict" value="{{ old('temporaryDistrict', $bankAccount->temporaryDistrict ?? '') }}" required maxlength="255" placeholder="Enter district name">
                                    </div>
                                    <div class="col">
                                        <label for="temporaryMunicipality" class="form-label fs-6">Municipality <span class="text-danger fw-bold">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="temporaryMunicipality" name="temporaryMunicipality" value="{{ old('temporaryMunicipality', $bankAccount->temporaryMunicipality ?? '') }}" required maxlength="255" placeholder="Enter municipality name">
                                    </div>
                                    <div class="col">
                                        <label for="temporaryWardNo" class="form-label fs-6">Ward No <span class="text-danger fw-bold">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="temporaryWardNo" name="temporaryWardNo" value="{{ old('temporaryWardNo', $bankAccount->temporaryWardNo ?? '') }}" required maxlength="255" placeholder="Enter ward number">
                                    </div>
                                    <div class="col">
                                        <label for="temporaryCity" class="form-label fs-6">City <span class="text-danger fw-bold">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="temporaryCity" name="temporaryCity" value="{{ old('temporaryCity', $bankAccount->temporaryCity ?? '') }}" required maxlength="255" placeholder="Enter city name">
                                    </div>
                                    <div class="col">
                                        <label for="temporaryTole" class="form-label fs-6">Tole <span class="text-danger fw-bold">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="temporaryTole" name="temporaryTole" value="{{ old('temporaryTole', $bankAccount->temporaryTole ?? '') }}" required maxlength="255" placeholder="Enter tole name">
                                    </div>
                                    <div class="col">
                                        <label for="temporaryStreet" class="form-label fs-6">Street:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="temporaryStreet" name="temporaryStreet" value="{{ old('temporaryStreet', $bankAccount->temporaryStreet ?? '') }}" maxlength="255" placeholder="Enter street name">
                                    </div>
                                    <div class="col">
                                        <label for="temporaryState" class="form-label fs-6">State:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="temporaryState" name="temporaryState" value="{{ old('temporaryState', $bankAccount->temporaryState ?? '') }}" maxlength="255" placeholder="Enter state name">
                                    </div>
                                    <div class="col">
                                        <label for="temporaryHouseNo" class="form-label fs-6">House No:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="temporaryHouseNo" name="temporaryHouseNo" value="{{ old('temporaryHouseNo', $bankAccount->temporaryHouseNo ?? '') }}" maxlength="255" placeholder="Enter house number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Job Details Section -->
                        <div class="attestation">
                            <div class="">
                                <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Job Details</h4>
                            </div>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                    <div class="col">
                                        <label for="jobTitle" class="form-label fs-6">Job Title:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="jobTitle" name="jobTitle" value="{{ old('jobTitle', $bankAccount->jobTitle ?? '') }}" maxlength="255" placeholder="Enter your job title">
                                    </div>
                                    <div class="col">
                                        <label for="jobCity" class="form-label fs-6">Job City:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="jobCity" name="jobCity" value="{{ old('jobCity', $bankAccount->jobCity ?? '') }}" maxlength="255" placeholder="Enter job city">
                                    </div>
                                    <div class="col">
                                        <label for="companyName" class="form-label fs-6">Company Name:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="companyName" name="companyName" value="{{ old('companyName', $bankAccount->companyName ?? '') }}" maxlength="255" placeholder="Enter company name">
                                    </div>
                                    <div class="col">
                                        <label for="yearlySalary" class="form-label fs-6">Yearly Salary:</label>
                                        <input type="number" step="0.01" class="form-control form-control-da fs-6" id="yearlySalary" name="yearlySalary" value="{{ old('yearlySalary', $bankAccount->yearlySalary ?? '') }}" placeholder="Enter yearly salary">
                                    </div>
                                    <div class="col">
                                        <label for="monthlySalary" class="form-label fs-6">Monthly Salary:</label>
                                        <input type="number" step="0.01" class="form-control form-control-da fs-6" id="monthlySalary" name="monthlySalary" value="{{ old('monthlySalary', $bankAccount->monthlySalary ?? '') }}" placeholder="Enter monthly salary">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Required Documents Section -->
                        <div class="attestation">
                            <div class="">
                                <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Required Documents</h4>
                            </div>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-2 row-gap-3">

                                    {{-- Signature Photo --}}
                                    <div class="col">
                                        <label for="signature" class="form-label fs-6">
                                            Signature Photo :<span class="text-danger fw-bold">*</span>
                                        </label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                        <input type="file" class="form-control" id="signature" name="signature"
                                            accept=".jpg,.jpeg,.png,.pdf"
                                            onchange="previewImage(this, 'signaturePreview')"
                                            @if(!isset($bankAccount)) required @endif>

                                        @if(isset($bankAccount) && $bankAccount->signature)
                                        <div class="mt-2">
                                            <img id="signaturePreview" src="{{ asset($bankAccount->signature) }}"
                                                alt="Signature Preview"
                                                class="img-fluid rounded"
                                                style="max-width: 300px; max-height: 200px;">
                                        </div>
                                        @else
                                        <div class="mt-2">
                                            <img id="signaturePreview" src=""
                                                alt="Signature Preview"
                                                class="img-fluid rounded d-none"
                                                style="max-width: 300px; max-height: 200px;">
                                        </div>
                                        @endif
                                    </div>

                                    {{-- Thumb Print Photo --}}
                                    <div class="col">
                                        <label for="fingerPrint" class="form-label fs-6">
                                            Thumb Print Photo:<span class="text-danger fw-bold">*</span>
                                        </label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                        <input type="file" class="form-control" id="fingerPrint" name="fingerPrint"
                                            accept=".jpg,.jpeg,.png,.pdf"
                                            onchange="previewImage(this, 'fingerPrintPreview')"
                                            @if(!isset($bankAccount)) required @endif>

                                        @if(isset($bankAccount) && $bankAccount->fingerPrint)
                                        <div class="mt-2">
                                            <img id="fingerPrintPreview" src="{{ asset($bankAccount->fingerPrint) }}"
                                                alt="Thumb Print Preview"
                                                class="img-fluid rounded"
                                                style="max-width: 300px; max-height: 200px;">
                                        </div>
                                        @else
                                        <div class="mt-2">
                                            <img id="fingerPrintPreview" src=""
                                                alt="Thumb Print Preview"
                                                class="img-fluid rounded d-none"
                                                style="max-width: 300px; max-height: 200px;">
                                        </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="my-4 border border-1 border-secondary"></div>
                        <div class="d-flex flex-column mx-3 mb-5">
                            <div class="form-check">
                                <input class="form-check-input fs-6" type="checkbox" value="1" id="checkCorrect" name="checkCorrect" required>
                                <label class="form-check-label fs-6" for="checkCorrect">
                                    <span class="required"></span> I confirm that all
                                    information provided is accurate and complete. I
                                    understand
                                    that providing false
                                    information may result in the rejection of my
                                    application
                                    and
                                    possible
                                    legal
                                    consequences.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input fs-6" type="checkbox" value="1" id="checkTerms" name="checkTerms" required>
                                <label class="form-check-label fs-6" for="checkTerms">
                                    <span class="required"></span> I agree to the Terms
                                    and
                                    Conditions
                                    and Privacy Policy of
                                    Kamsansar's
                                    Bank Account
                                    service.
                                </label>
                            </div>
                            <div class="required-fields-message text-danger  fw-bold">* - Required fields -
                                Please
                                fill all
                                required fields before proceeding.</div>
                        </div>
                        <div class="d-flex justify-content-end py-4">
                            <button type="submit" id="submitBtn" class="btn btn" style="background-color: #0064a7; color: white;" disabled>
                                {{ isset($bankAccount) ? 'Update Application' : 'Submit Application' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Your existing scripts -->



<script>
    $(document).ready(function() {
        function copyPermanentToTemporary() {
            $('#temporaryCountry').val($('#permanentCountry').val());
            $('#temporaryProvince').val($('#permanentProvince').val());
            $('#temporaryDistrict').val($('#permanentDistrict').val());
            $('#temporaryMunicipality').val($('#permanentMunicipality').val());
            $('#temporaryWardNo').val($('#permanentWardNo').val());
            $('#temporaryCity').val($('#permanentCity').val());
            $('#temporaryTole').val($('#permanentTole').val());
            $('#temporaryStreet').val($('#permanentStreet').val());
            $('#temporaryState').val($('#permanentState').val());
            $('#temporaryHouseNo').val($('#permanentHouseNo').val());
        }

        $('#sameAsPermanent').on('change', function() {
            if (this.checked) {
                copyPermanentToTemporary();
                $('#form-container .accordion-body input[id^="temporary"]').prop('readonly', true);
            } else {
                $('#form-container .accordion-body input[id^="temporary"]').prop('readonly', false);
            }
        });

        // If checkbox is checked when page loads, trigger the change event
        if ($('#sameAsPermanent').is(':checked')) {
            $('#sameAsPermanent').trigger('change');
        }
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
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection