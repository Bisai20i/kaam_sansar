@extends('frontend.layouts.main')

@section('title', 'Broker Account')
@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')

<section class="ad_banner p-4 border border-1 border-dark-subtle mt-5 text-center mb-4">
    <h2 class="py-4">Advertisement Banner</h2>
</section>

@endsection
<section class="work_permit_form">
    <div class="container-fluid container-lg">
        <div id="form-container"
            class="container-fluid container-lg border border-1 border-dark-subtle rounded-4 p-md-5 py-5 mb-5 mt-5">
            <form id="form" method="POST" action="{{ route('workPermits.store') }}">
                @csrf
                <div id="workpermitForm1" class="multi-step-form" style="display:block;">
                    <div class="d-flex">
                        <div class="col-auto">
                            <a href="#">
                                <i class="fa fa-chevron-left text-black fs-4 ms-2" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col text-center">
                            <h3 style="color:#0064a7;">Work Permit Renewed</h3>
                            <p>Complete the form to start your work permit process</p>
                        </div>
                    </div>

                    <div class="text-center my-4">
                        <div class="d-md-inline-flex justify-content-center align-items-center gap-3 bg-light fs-6">
                            <p class="p-2 rounded-2 text-white m-0" style="background-color: #0064a7;">Select Service & Read Instructions</p>
                            <p class="p-2 bg-light rounded-2 m-0">Book Appointment</p>
                            <p class="p-2 bg-light rounded-2 m-0">Fill Application</p>
                            <p class="p-2 bg-light rounded-2 m-0">Payment</p>
                        </div>
                    </div>

                    <div class="mt-5 border border-1 border-dark-subtle rounded-4 p-3 p-md-5" id="form1">
                        <!-- Select Service -->
                        <div>
                            <h5 style="color:#0064a7;">Select Service Type</h5>
                            <p>Please select one of the following service types:</p>
                            <div class="mb-3">
                                <div class="nav nav-pills mb-3 row gap-2" id="pills-tab" role="tablist">
                                    <div class="col-auto nav-item" role="presentation">
                                        <input type="radio" name="serviceType" id="newWorkPermit" value="new" class="btn-check" autocomplete="off">
                                        <label class="nav-link h-100 border border-1 border-dark-subtle fs-6" for="newWorkPermit">New Work Permit</label>
                                    </div>
                                    <div class="col-auto nav-item" role="presentation">
                                        <input type="radio" name="serviceType" id="renewWorkPermit" value="renew" class="btn-check" autocomplete="off">
                                        <label class="nav-link h-100 border border-1 border-dark-subtle fs-6" for="renewWorkPermit">Renew Work Permit</label>
                                    </div>
                                    <div class="col-auto nav-item" role="presentation">
                                        <input type="radio" name="serviceType" id="legalization" value="legalization" class="btn-check" autocomplete="off">
                                        <label class="nav-link h-100 border border-1 border-dark-subtle fs-6" for="legalization">Legalization</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Read Instructions -->
                        <div class="mt-5">
                            <h5 style="color:#0064a7;">Read Instructions</h5>
                            <p class="fs-5 my-3">Read before pre-enrollment</p>
                            <p class="fs-6 text-black-50">
                                Read all instructions carefully before applying.

                                Prepare all required documents in advance (passport, job offer, photos, certificates, etc.).

                                Book an appointment online—walk-ins are usually not accepted.

                                Ensure documents are complete, accurate, and in the correct format.

                                Bring both originals and copies to your appointment.

                                Requirements may vary by country and job type—check official guidelines.
                            </p>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between mt-5">
                            <button class="btn btn-light" type="reset">Cancel</button>
                            <button class="btn text-white border-0" style="background-color: #0064a7;" type="submit">Next</button>
                        </div>
                    </div>
                    <div id="workpermitForm2" class="multi-step-form" style="display:none;">
                        <div class="d-flex">
                            <div class="col-auto">
                                <a onclick="showPreviousForm(2)" style="cursor: pointer;">
                                    <i class="fa fa-chevron-left fs-4 ms-2" aria-hidden="true"></i>
                                </a>
                            </div>
                            <div class="col text-center">
                                <h3 style="color:#0064a7;">Work Permit Renewed</h3>
                                <p>Complete the form to start your work permit renewal process</p>
                            </div>
                        </div>

                        <div class="text-center my-4">
                            <div class="d-lg-inline-flex justify-content-center align-items-center gap-3 bg-light fs-6">
                                <p class="p-2 bg-light rounded-2 m-0">Select Service & Read Instructions</p>
                                <p class="p-2 rounded-2 text-white m-0" style="background-color: #0064a7;">Book Appointment</p>
                                <p class="p-2 bg-light rounded-2 m-0">Fill Application</p>
                                <p class="p-2 bg-light rounded-2 m-0">Payment</p>
                            </div>
                        </div>

                        <div class="mt-5 border border-1 border-dark-subtle rounded-4 p-3 p-md-5" id="form_2">
                            <div>
                                <h4 class="text-primary mb-4">Book Appointment</h4>
                            </div>
                            <div>
                                <form action="">
                                    <div class="row row-cols-2">
                                        <div class="col mb-3">
                                            <label for="appointment_country">Appointment Country:</label>
                                            <select id="appointment_country" name="appointment_country" class="form-select my-2" aria-label="Select appointment country">
                                                <option selected>Nepal</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                        <div class="col mb-3">
                                            <label for="appointment_province">Appointment Province:</label>
                                            <select id="appointment_province" name="appointment_province" class="form-select my-2" aria-label="Select appointment province">
                                                <option selected>Gandaki</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                        <div class="col mb-3">
                                            <label for="appointment_district">Appointment District:</label>
                                            <select id="appointment_district" name="appointment_district" class="form-select my-2" aria-label="Select appointment district">
                                                <option selected>Gandaki</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                        <div class="col mb-3">
                                            <label for="appointment_location">Appointment Location:</label>
                                            <select id="appointment_location" name="appointment_location" class="form-select my-2" aria-label="Select appointment location">
                                                <option selected>Department of Passports</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="d-flex justify-content-between mt-3">
                                <button class="btn btn-light">Cancel</button>
                                <button class="btn text-white border-0" style="background-color: #0064a7;" type="button" onclick="showNextForm(3)">Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 border border-1 border-dark-subtle rounded-4 p-3 p-md-5" id="form_3">
                        <div class="personalForm">
                            <div class="work-permit">
                                <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">
                                    Personal Information
                                </h4>
                            </div>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">

                                    <div class="col">
                                        <label for="firstName" class="form-label">First Name:</label>
                                        <input type="text" class="form-control fs-6" id="firstName" name="firstName" required maxlength="255" placeholder="John">
                                    </div>

                                    <div class="col">
                                        <label for="middleName" class="form-label">Middle Name:</label>
                                        <input type="text" class="form-control fs-6" id="middleName" name="middleName" maxlength="255" placeholder="Bahadur">
                                    </div>

                                    <div class="col">
                                        <label for="lastName" class="form-label">Last Name:</label>
                                        <input type="text" class="form-control fs-6" id="lastName" name="lastName" required maxlength="255" placeholder="Doe">
                                    </div>

                                    <div class="flatpickr-container flatpickr col d-flex flex-column">
                                        <label for="dateOfBirthAd" class="mb-1">Date of Birth (AD):</label>
                                        <div class="d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                            <input type="text" placeholder="1990-10-01" id="dateOfBirthAd" name="dateOfBirthAd" class="date-picker fs-6" required>
                                            <label for="dateOfBirthAd" class="input-button" title="toggle" data-toggle></label>
                                        </div>
                                    </div>

                                    <div class="flatpickr-container flatpickr col d-flex flex-column">
                                        <label for="dateOfBirthBs" class="mb-1">Date of Birth (BS):</label>
                                        <div class="d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 p-2 my-1">
                                            <input type="text" placeholder="1990-10-01" id="dateOfBirthBs" name="dateOfBirthBs" class="date-picker fs-6" required>
                                            <label for="dateOfBirthBs" class="input-button" title="toggle" data-toggle></label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label for="birthplace" class="form-label">Birthplace (District/Country if abroad):</label>
                                        <input type="text" class="form-control fs-6" id="birthplace" name="birthplace" required maxlength="255" placeholder="Pokhara">
                                    </div>

                                    <div class="col">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select id="gender" name="gender" class="form-select form-control fs-6" aria-label="Default select example">
                                            <option selected>Male</option>
                                        </select>
                                    </div>

                                    <div class="col">
                                        <label for="age" class="form-label">Age:</label>
                                        <input type="number" class="form-control fs-6" id="age" name="age" required placeholder="33">
                                    </div>

                                    <div class="col">
                                        <label for="nationality" class="form-label">Nationality</label>
                                        <input type="text" class="form-control fs-6" id="nationality" name="nationality" required maxlength="255" placeholder="Nepali">
                                    </div>

                                    <div class="col">
                                        <label for="religion" class="form-label">Religion:</label>
                                        <input type="text" class="form-control fs-6" id="religion" name="religion" required maxlength="255" placeholder="Hindu">
                                    </div>

                                    <div class="col">
                                        <label for="birthCountry" class="form-label">Birth Country:</label>
                                        <input type="text" class="form-control fs-6" id="birthCountry" name="birthCountry" required maxlength="255" placeholder="Nepal">
                                    </div>

                                    <div class="col">
                                        <label for="fatherName" class="form-label">Father's Name:</label>
                                        <input type="text" class="form-control fs-6" id="fatherName" name="fatherName" required maxlength="255" placeholder="Kiran Ale">
                                    </div>

                                    <div class="col">
                                        <label for="motherName" class="form-label">Mother's Name:</label>
                                        <input type="text" class="form-control fs-6" id="motherName" name="motherName" required maxlength="255" placeholder="Sita Ale">
                                    </div>

                                    <div class="col">
                                        <label for="status" class="form-label">Status:</label>
                                        <input type="text" class="form-control fs-6" id="status" name="status" required maxlength="255" placeholder="Single">
                                    </div>

                                    <div class="col">
                                        <label for="spouseName" class="form-label">Spouse Name:</label>
                                        <input type="text" class="form-control fs-6" id="spouseName" name="spouseName" required maxlength="255" placeholder="Simran Ale">
                                    </div>

                                    <div class="col">
                                        <label for="numberOfChildren" class="form-label">No. of Children:</label>
                                        <input type="number" class="form-control fs-6" id="numberOfChildren" name="numberOfChildren" required placeholder="2">
                                    </div>

                                    <div class="col">
                                        <label for="spouseAge" class="form-label">Spouse Age:</label>
                                        <input type="number" class="form-control fs-6" id="spouseAge" name="spouseAge" required placeholder="30">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bankDetails">
                        <div class="">
                            <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">
                                Bank Details
                            </h4>
                        </div>
                        <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">

                            <div class="col">
                                <label for="bankAccount" class="form-label">Bank Account:</label>
                                <select id="bankAccount" name="bankAccount" class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>Self</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="bankName" class="form-label fs-6">Bank Name:</label>
                                <input type="text" class="form-control form-control-da fs-6" id="bankName"
                                    name="bankName" required maxlength="255" placeholder="Nabil Bank">
                            </div>

                            <div class="col">
                                <label for="accountType" class="form-label">Account Type:</label>
                                <input type="text" id="accountType" name="accountType" class="form-control fs-6"
                                    required maxlength="255" placeholder="Saving">
                            </div>

                            <div class="col">
                                <label for="bankBranch" class="form-label">Bank Branch:</label>
                                <input type="text" id="bankBranch" name="bankBranch" class="form-control fs-6"
                                    required maxlength="255" placeholder="Amarsingh">
                            </div>

                            <div class="col">
                                <label for="bankNo" class="form-label fs-6">Bank No:</label>
                                <input type="number" class="form-control form-control-da fs-6" id="bankNo"
                                    name="bankNo" required maxlength="255" placeholder="00000000000">
                            </div>

                        </div>
                    </div>

                    <div class="citizenshipInfo">
                        <div class="">
                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">
                                Citizenship Information
                            </h4>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">

                                <div class="col">
                                    <label for="nationalIdentityNo" class="form-label">National Identity No (NIN-Only Digits):</label>
                                    <input type="number" class="form-control fs-6" id="nationalIdentityNo" name="nationalIdentityNo" required
                                        maxlength="255" placeholder="1234567890">
                                </div>

                                <div class="col">
                                    <label for="citizenshipNumber" class="form-label">Citizenship or Permit Number:</label>
                                    <input type="number" class="form-control fs-6" id="citizenshipNumber" name="citizenshipNumber" required
                                        maxlength="255" placeholder="1234567890">
                                </div>

                                <div class="flatpickr-container flatpickr col d-flex flex-column">
                                    <label for="dateOfIssue" class="mb-1">Citizenship Date of Issue (AD/BS):</label>
                                    <div class="d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                        <input type="text" placeholder="1990-10-01" id="dateOfIssue" name="dateOfIssue"
                                            class="date-picker fs-6" required>
                                        <label for="dateOfIssue" class="input-button" title="toggle" data-toggle>
                                        </label>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="placeOfIssueDistrict" class="form-label fs-6">Citizenship Place of Issue (District):</label>
                                    <input type="text" class="form-control fs-6" id="placeOfIssueDistrict" name="placeOfIssueDistrict"
                                        required maxlength="255" placeholder="Kaski">
                                </div>

                                <div class="col">
                                    <label for="placeOfIssueAbroad" class="form-label fs-6">Citizenship Place of Issue (If Abroad):</label>
                                    <input type="text" class="form-control fs-6" id="placeOfIssueAbroad" name="placeOfIssueAbroad"
                                        maxlength="255" placeholder="India">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="companyInfo">
                        <div class="">
                            <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Company Info</h4>
                        </div>
                        <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">

                            <div class="col">
                                <label for="country" class="form-label">Country:</label>
                                <select id="country" name="country" class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>Nepal</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="companyName" class="form-label fs-6">Company Name:</label>
                                <input type="text" class="form-control form-control-da fs-6" id="companyName" name="companyName"
                                    required maxlength="255" placeholder="TukiSoft">
                            </div>

                            <div class="col">
                                <label for="currency" class="form-label">Currency:</label>
                                <select id="currency" name="currency" class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>Nepalese Rupee</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="facilityDetails">
                        <div class="">
                            <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Facility Details</h4>
                        </div>
                        <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">

                            <div class="col">
                                <label for="skill" class="form-label fs-6">Skill:</label>
                                <input type="text" class="form-control form-control-da fs-6" id="skill" name="skill" required maxlength="255" placeholder="Enter Skill">
                            </div>

                            <div class="col">
                                <label for="salary" class="form-label fs-6">Salary:</label>
                                <input type="text" class="form-control form-control-da fs-6" id="salary" name="salary" required maxlength="255" placeholder="Enter Salary">
                            </div>

                            <div class="col">
                                <label for="workType" class="form-label fs-6">Work Type:</label>
                                <input type="text" class="form-control form-control-da fs-6" id="workType" name="workType" required maxlength="255" placeholder="Enter Work Type">
                            </div>

                            <div class="col">
                                <label for="food" class="form-label">Food:</label>
                                <select id="food" name="food" class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>No</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="accommodation" class="form-label">Accommodation:</label>
                                <select id="accommodation" name="accommodation" class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>No</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="dailyWorkHour" class="form-label fs-6">Daily Work Hour:</label>
                                <input type="text" class="form-control form-control-da fs-6" id="dailyWorkHour" name="dailyWorkHour" required maxlength="255" placeholder="8">
                            </div>

                            <div class="col">
                                <label for="weeklyWorkDay" class="form-label fs-6">Weekly Work Day:</label>
                                <input type="text" class="form-control form-control-da fs-6" id="weeklyWorkDay" name="weeklyWorkDay" required maxlength="255" placeholder="Monday">
                            </div>

                            <div class="col">
                                <label for="overTime" class="form-label">Over Time:</label>
                                <select id="overTime" name="overTime" class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>No</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="otherAllowance" class="form-label">Other Allowance:</label>
                                <select id="otherAllowance" name="otherAllowance" class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>No</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="otherFacility">
                        <div class="">
                            <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Other Facility</h4>
                        </div>
                        <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">

                            <div class="col">
                                <label for="transportation" class="form-label">Transportation:</label>
                                <select id="transportation" name="transportation" class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>No</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="healthInsurance" class="form-label">Health Insurance:</label>
                                <select id="healthInsurance" name="healthInsurance" class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>No</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="visaInfo">
                        <div class="">
                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Visa Information</h4>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">
                                <div class="col">
                                    <label for="visaNo" class="form-label">Visa No:</label>
                                    <input type="number" class="form-control fs-6" id="visaNo" name="visaNo" required maxlength="255" placeholder="Enter Visa No.">
                                </div>
                                <div class="col">
                                    <label for="citizenshipNumber" class="form-label">Citizenship or Permit Number:</label>
                                    <input type="number" class="form-control fs-6" id="citizenshipNumber" name="citizenshipNumber" required maxlength="255" placeholder="1234567890">
                                </div>

                                <div class="flatpickr-container flatpickr col d-flex flex-column">
                                    <label for="citizenshipDateOfIssue" class="mb-1">Citizenship Date of Issue (AD/BS):</label>
                                    <div class="d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                        <input type="text" placeholder="1990-10-01" id="citizenshipDateOfIssue" name="citizenshipDateOfIssue" class="date-picker fs-6" required>
                                        <label for="citizenshipDateOfIssue" class="input-button" title="toggle" data-toggle>
                                        </label>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="citizenshipPlaceOfIssueDistrict" class="form-label fs-6">Citizenship Place of Issue (District):</label>
                                    <input type="text" class="form-control form-control-da fs-6" id="citizenshipPlaceOfIssueDistrict" name="citizenshipPlaceOfIssueDistrict" required maxlength="255" placeholder="Kaksi">
                                </div>

                                <div class="col">
                                    <label for="citizenshipPlaceOfIssueAbroad" class="form-label fs-6">Citizenship Place of Issue (Abroad):</label>
                                    <input type="text" class="form-control form-control-da fs-6" id="citizenshipPlaceOfIssueAbroad" name="citizenshipPlaceOfIssueAbroad" required maxlength="255" placeholder="India">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="Nominee Info">
                        <div class="">
                            <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Nominee Info</h4>
                        </div>
                        <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                            <div class="col">
                                <label for="nominee" class="form-label">Import Nominee:</label>
                                <select class="form-select form-control fs-6" aria-label="Default select example" id="nominee" name="nominee">
                                    <option selected>Spouse</option>
                                    <option>Parent</option>
                                    <option>Child</option>
                                    <option>Other</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="nomineeName" class="form-label fs-6">Nominee Name: </label>
                                <input type="text" class="form-control form-control-da fs-6" id="nomineeName" name="nomineeName" required maxlength="255" placeholder="Hari Maya">
                            </div>

                            <div class="col">
                                <label for="nomineeRelation" class="form-label fs-6">Nominee Relation: </label>
                                <input type="text" class="form-control form-control-da fs-6" id="nomineeRelation" name="nomineeRelation" required maxlength="255" placeholder="Spouse">
                            </div>

                            <div class="col">
                                <label for="nomineeCountry" class="form-label fs-6">Country: </label>
                                <input type="text" class="form-control form-control-da fs-6" id="nomineeCountry" name="nomineeCountry" required maxlength="255" placeholder="Nepal">
                            </div>

                            <div class="col">
                                <label for="nomineeProvince" class="form-label">Province:</label>
                                <select class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>Gandaki</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="nomineeDistrict" class="form-label fs-6">District: </label>
                                <input type="text" class="form-control form-control-da fs-6" id="nomineeDistrict" name="nomineeDistrict" required maxlength="255" placeholder="Enter District">
                            </div>

                            <div class="col">
                                <label for="nomineeCity" class="form-label fs-6">City: </label>
                                <input type="text" class="form-control form-control-da fs-6" id="nomineeCity" name="nomineeCity" required maxlength="255" placeholder="Pokhara">
                            </div>

                            <div class="col">
                                <label for="nomineeEmail" class="form-label fs-6">Email Address: </label>
                                <input type="text" class="form-control form-control-da fs-6" id="nomineeEmail" name="nomineeEmail" required maxlength="255" placeholder="example@domain.com">
                            </div>

                            <div class="col">
                                <label for="nomineePhone" class="form-label fs-6">Phone Number: </label>
                                <input type="text" class="form-control form-control-da fs-6" id="nomineePhone" name="nomineePhone" required maxlength="255" placeholder="1234567890">
                            </div>
                        </div>
                    </div>

                    <div class="Passport_info">
                        <div class="">
                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Passport Information</h4>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">
                                <div class="col">
                                    <label for="passportNumber" class="form-label">Passport Number:</label>
                                    <input type="number" class="form-control fs-6" id="passportNumber" name="passportNumber" required maxlength="255" placeholder="XXXXXXXXXXXXXXXX">
                                </div>

                                <div class="col">
                                    <label for="passportType" class="form-label">Passport Type:</label>
                                    <select class="form-select form-control fs-6" aria-label="Default select example" id="passportType" name="passportType">
                                        <option selected>Nepali</option>
                                        <!-- Add other options as needed -->
                                    </select>
                                </div>

                                <div class="flatpickr-container flatpickr col d-flex flex-column">
                                    <label for="issueDate" class="mb-1">Issue Date:</label>
                                    <div class="d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                        <input type="text" placeholder="1990-10-01" id="issueDate" name="issueDate" class="date-picker fs-6" required>
                                        <label for="issueDate" class="input-button" title="toggle" data-toggle>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="#000" d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                            </svg>
                                        </label>
                                    </div>
                                </div>

                                <div class="flatpickr-container flatpickr col d-flex flex-column">
                                    <label for="expiryDate" class="mb-1">Expiry Date:</label>
                                    <div class="d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                        <input type="text" placeholder="1990-10-01" id="expiryDate" name="expiryDate" class="date-picker fs-6" required>
                                        <label for="expiryDate" class="input-button" title="toggle" data-toggle>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="#000" d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                            </svg>
                                        </label>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="placeOfIssue" class="form-label fs-6">Place of Issue:</label>
                                    <input type="text" class="form-control form-control-da fs-6" id="placeOfIssue" name="placeOfIssue" required maxlength="255" placeholder="Kaksi">
                                </div>

                                <div class="col">
                                    <label for="issuingAuthority" class="form-label fs-6">Issuing Authority:</label>
                                    <input type="text" class="form-control form-control-da fs-6" id="issuingAuthority" name="issuingAuthority" required maxlength="255" placeholder="Department of Foreign Affairs">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="contactInfo">
                        <div class="">
                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">
                                Contact Information
                            </h4>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">

                                <div class="col">
                                    <label for="contactEmail" class="form-label">Email Address:</label>
                                    <input
                                        type="email"
                                        class="form-control fs-6"
                                        id="contactEmail"
                                        name="contactEmail"
                                        required
                                        maxlength="255"
                                        placeholder="dev@gmail.com">
                                </div>

                                <div class="col">
                                    <label for="country" class="form-label">Country:</label>
                                    <select
                                        id="country"
                                        name="country"
                                        class="form-select form-control fs-6"
                                        aria-label="Default select example">
                                        <option selected>Nepal</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="stateProvince" class="form-label">State/Province:</label>
                                    <select
                                        id="stateProvince"
                                        name="stateProvince"
                                        class="form-select form-control fs-6"
                                        aria-label="Default select example">
                                        <option selected>Gandaki</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="district" class="form-label">District:</label>
                                    <select
                                        id="district"
                                        name="district"
                                        class="form-select form-control fs-6"
                                        aria-label="Default select example">
                                        <option selected>Kaski</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="city" class="form-label fs-6">City:</label>
                                    <input
                                        type="text"
                                        class="form-control fs-6"
                                        id="city"
                                        name="city"
                                        required
                                        maxlength="255"
                                        placeholder="Pokhara">
                                </div>

                                <div class="col">
                                    <label for="phone" class="form-label fs-6">Phone Number:</label>
                                    <input
                                        type="tel"
                                        class="form-control fs-6"
                                        id="phone"
                                        name="phone"
                                        required
                                        maxlength="15"
                                        placeholder="1234567890">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="permanentAddress">
                        <div class="">
                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">
                                Permanent Address
                            </h4>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">

                                <div class="col">
                                    <label for="country" class="form-label">Country:</label>
                                    <select id="country" name="country" class="form-select form-control fs-6">
                                        <option selected>Nepal</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="province" class="form-label">Province:</label>
                                    <select id="province" name="province" class="form-select form-control fs-6">
                                        <option selected>Gandaki</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="district" class="form-label">District:</label>
                                    <select id="district" name="district" class="form-select form-control fs-6">
                                        <option selected>Kaski</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="municipality" class="form-label">Municipality:</label>
                                    <select id="municipality" name="municipality" class="form-select form-control fs-6">
                                        <option selected>Pokhara Lekhnath</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="wardNo" class="form-label fs-6">Ward No:</label>
                                    <input
                                        type="number"
                                        class="form-control form-control-da fs-6"
                                        id="wardNo"
                                        name="wardNo"
                                        required
                                        maxlength="255"
                                        placeholder="08">
                                </div>

                                <div class="col">
                                    <label for="city" class="form-label fs-6">City:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="city"
                                        name="city"
                                        required
                                        maxlength="255"
                                        placeholder="Pokhara">
                                </div>

                                <div class="col">
                                    <label for="tole" class="form-label fs-6">Tole:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="tole"
                                        name="tole"
                                        required
                                        maxlength="255"
                                        placeholder="Rambazar">
                                </div>

                                <div class="col">
                                    <label for="street" class="form-label fs-6">Street:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="street"
                                        name="street"
                                        required
                                        maxlength="255"
                                        placeholder="09">
                                </div>

                                <div class="col">
                                    <label for="houseNo" class="form-label fs-6">House No:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="houseNo"
                                        name="houseNo"
                                        required
                                        maxlength="255"
                                        placeholder="255">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="temporaryAddress">
                        <div class="d-flex justify-content-between">
                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">
                                Temporary Address
                            </h4>
                            <div class="form-check pt-3 pb-1">
                                <input
                                    class="form-check-input fs-6"
                                    type="checkbox"
                                    id="sameAsPermanent"
                                    name="sameAsPermanent">
                                <label class="form-check-label fs-6" for="sameAsPermanent">
                                    Same as Permanent Address
                                </label>
                            </div>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">

                                <div class="col">
                                    <label for="tempCountry" class="form-label">Country:</label>
                                    <select id="tempCountry" name="tempCountry" class="form-select form-control fs-6">
                                        <option selected>Nepal</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="tempProvince" class="form-label">Province:</label>
                                    <select id="tempProvince" name="tempProvince" class="form-select form-control fs-6">
                                        <option selected>Gandaki</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="tempDistrict" class="form-label">District:</label>
                                    <select id="tempDistrict" name="tempDistrict" class="form-select form-control fs-6">
                                        <option selected>Kaski</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="tempMunicipality" class="form-label">Municipality:</label>
                                    <select id="tempMunicipality" name="tempMunicipality" class="form-select form-control fs-6">
                                        <option selected>Pokhara Lekhnath</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="tempWardNo" class="form-label fs-6">Ward No:</label>
                                    <input
                                        type="number"
                                        class="form-control form-control-da fs-6"
                                        id="tempWardNo"
                                        name="tempWardNo"
                                        required
                                        maxlength="255"
                                        placeholder="08">
                                </div>

                                <div class="col">
                                    <label for="tempCity" class="form-label fs-6">City:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="tempCity"
                                        name="tempCity"
                                        required
                                        maxlength="255"
                                        placeholder="Pokhara">
                                </div>

                                <div class="col">
                                    <label for="tempTole" class="form-label fs-6">Tole:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="tempTole"
                                        name="tempTole"
                                        required
                                        maxlength="255"
                                        placeholder="Rambazar">
                                </div>

                                <div class="col">
                                    <label for="tempStreet" class="form-label fs-6">Street:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="tempStreet"
                                        name="tempStreet"
                                        required
                                        maxlength="255"
                                        placeholder="09">
                                </div>

                                <div class="col">
                                    <label for="tempHouseNo" class="form-label fs-6">House No:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="tempHouseNo"
                                        name="tempHouseNo"
                                        required
                                        maxlength="255"
                                        placeholder="255">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="emergencyContact">
                        <div class="">
                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">
                                Emergency Contact
                            </h4>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">

                                <div class="col">
                                    <label for="emergencyFullName" class="form-label fs-6">Full Name:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="emergencyFullName"
                                        name="emergencyFullName"
                                        required
                                        maxlength="255"
                                        placeholder="Ram">
                                </div>

                                <div class="col">
                                    <label for="emergencyRelation" class="form-label fs-6">Relationship:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="emergencyRelation"
                                        name="emergencyRelation"
                                        required
                                        maxlength="255"
                                        placeholder="Brother">
                                </div>

                                <div class="col">
                                    <label for="emergencyCountry" class="form-label">Country:</label>
                                    <select
                                        id="emergencyCountry"
                                        name="emergencyCountry"
                                        class="form-select form-control fs-6">
                                        <option selected>Nepal</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="emergencyStateProvince" class="form-label">State/Province:</label>
                                    <select
                                        id="emergencyStateProvince"
                                        name="emergencyStateProvince"
                                        class="form-select form-control fs-6">
                                        <option selected>Bagmati</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="emergencyDistrict" class="form-label">District:</label>
                                    <select
                                        id="emergencyDistrict"
                                        name="emergencyDistrict"
                                        class="form-select form-control fs-6">
                                        <option selected>Kaski</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="emergencyCity" class="form-label fs-6">City:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="emergencyCity"
                                        name="emergencyCity"
                                        required
                                        maxlength="255"
                                        placeholder="Pokhara">
                                </div>

                                <div class="col">
                                    <label for="emergencyEmail" class="form-label fs-6">Email Address:</label>
                                    <input
                                        type="email"
                                        class="form-control form-control-da fs-6"
                                        id="emergencyEmail"
                                        name="emergencyEmail"
                                        required
                                        maxlength="255"
                                        placeholder="ram@gmail.com">
                                </div>

                                <div class="col">
                                    <label for="emergencyPhone" class="form-label fs-6">Phone No:</label>
                                    <input
                                        type="tel"
                                        class="form-control form-control-da fs-6"
                                        id="emergencyPhone"
                                        name="emergencyPhone"
                                        required
                                        maxlength="15"
                                        placeholder="1234567890">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="workDocuments">
                        <div class="">
                            <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">
                                Required Documents
                            </h4>
                        </div>

                        <div class="accordion-body row py-3 row-cols-1 row-cols-lg-2 row-gap-4 gx-5">
                            <div class="col">
                                <label for="passportPhoto" class="form-label fs-6">Passport Photo:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="passportPhoto"
                                    name="passportPhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>

                            <div class="col">
                                <label for="bankAccountPhoto" class="form-label fs-6">Bank Account Photo:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="bankAccountPhoto"
                                    name="bankAccountPhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>

                            <div class="col">
                                <label for="visaPhoto" class="form-label fs-6">Visa Photo:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="visaPhoto"
                                    name="visaPhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>

                            <div class="col">
                                <label for="chequePhoto" class="form-label fs-6">Cheque Photo:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="chequePhoto"
                                    name="chequePhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>

                            <div class="col">
                                <label for="agreementPhoto" class="form-label fs-6">Agreement Paper Photo:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="agreementPhoto"
                                    name="agreementPhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>

                            <div class="col">
                                <label for="arrivalStampPhoto" class="form-label fs-6">Arrival Stamp Photo:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="arrivalStampPhoto"
                                    name="arrivalStampPhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>

                            <div class="col">
                                <label for="embassyLetterPhoto" class="form-label fs-6">Embassy Letter Photo:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="embassyLetterPhoto"
                                    name="embassyLetterPhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>

                            <div class="col">
                                <label for="departureStampPhoto" class="form-label fs-6">Departure Stamp Photo:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="departureStampPhoto"
                                    name="departureStampPhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>

                            <div class="col">
                                <label for="oldLaborApprovalPhoto" class="form-label fs-6">Old Labor Approval Photo:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="oldLaborApprovalPhoto"
                                    name="oldLaborApprovalPhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>

                            <div class="col">
                                <label for="otherDocumentsPhoto" class="form-label fs-6">Other Documents:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="otherDocumentsPhoto"
                                    name="otherDocumentsPhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>
                        </div>
                    </div>

                    <div class="my-4 border border-1 border-secondary"></div>
                    <div class="d-flex flex-column mx-3 mb-5">

                        <div class="form-check">
                            <input class="form-check-input fs-6" type="checkbox" value="" id="checkCorrect"
                                required>
                            <label class="form-check-label fs-6" for="checkCorrect">
                                I confirm that all
                                information
                                provided is accurate and complete. I
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
                            <input class="form-check-input fs-6" type="checkbox" value="" id="checkTerms"
                                required>
                            <label class="form-check-label fs-6" for="checkTerms">
                                I agree to the Terms
                                and
                                Conditions
                                and Privacy Policy of
                                Kamsansar's
                                passport
                                renewal service.
                            </label>
                        </div>
                        <div class="required-fields-message">* - Required fields -
                            Please
                            fill all
                            required fields before proceeding.</div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <button class="btn btn-light" type="button">Cancel</button>
                        <div class="d-block">
                            <button class="btn text-white border-0 mt-0"
                                style="background-color: #0064a7; " type="button" form="passportForm"
                                id="form3NextBtn" onclick="showNextForm(4)">Next</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>@extends('frontend.layouts.main')

@section('title', 'Broker Account')
@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')

<section class="ad_banner p-4 border border-1 border-dark-subtle mt-5 text-center mb-4">
    <h2 class="py-4">Advertisement Banner</h2>
</section>

@endsection
<section class="work_permit_form">
    <div class="container-fluid container-lg">
        <div id="form-container"
            class="container-fluid container-lg border border-1 border-dark-subtle rounded-4 p-md-5 py-5 mb-5 mt-5">
            <form id="form" method="POST" action="{{ route('workPermits.store') }}">
                @csrf
                <div id="workpermitForm1" class="multi-step-form" style="display:block;">
                    <div class="d-flex">
                        <div class="col-auto">
                            <a href="#">
                                <i class="fa fa-chevron-left text-black fs-4 ms-2" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col text-center">
                            <h3 style="color:#0064a7;">Work Permit Renewed</h3>
                            <p>Complete the form to start your work permit process</p>
                        </div>
                    </div>

                    <div class="text-center my-4">
                        <div class="d-md-inline-flex justify-content-center align-items-center gap-3 bg-light fs-6">
                            <p class="p-2 rounded-2 text-white m-0" style="background-color: #0064a7;">Select Service & Read Instructions</p>
                            <p class="p-2 bg-light rounded-2 m-0">Book Appointment</p>
                            <p class="p-2 bg-light rounded-2 m-0">Fill Application</p>
                            <p class="p-2 bg-light rounded-2 m-0">Payment</p>
                        </div>
                    </div>

                    <div class="mt-5 border border-1 border-dark-subtle rounded-4 p-3 p-md-5" id="form1">
                        <!-- Select Service -->
                        <div>
                            <h5 style="color:#0064a7;">Select Service Type</h5>
                            <p>Please select one of the following service types:</p>
                            <div class="mb-3">
                                <div class="nav nav-pills mb-3 row gap-2" id="pills-tab" role="tablist">
                                    <div class="col-auto nav-item" role="presentation">
                                        <input type="radio" name="serviceType" id="newWorkPermit" value="new" class="btn-check" autocomplete="off">
                                        <label class="nav-link h-100 border border-1 border-dark-subtle fs-6" for="newWorkPermit">New Work Permit</label>
                                    </div>
                                    <div class="col-auto nav-item" role="presentation">
                                        <input type="radio" name="serviceType" id="renewWorkPermit" value="renew" class="btn-check" autocomplete="off">
                                        <label class="nav-link h-100 border border-1 border-dark-subtle fs-6" for="renewWorkPermit">Renew Work Permit</label>
                                    </div>
                                    <div class="col-auto nav-item" role="presentation">
                                        <input type="radio" name="serviceType" id="legalization" value="legalization" class="btn-check" autocomplete="off">
                                        <label class="nav-link h-100 border border-1 border-dark-subtle fs-6" for="legalization">Legalization</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Read Instructions -->
                        <div class="mt-5">
                            <h5 style="color:#0064a7;">Read Instructions</h5>
                            <p class="fs-5 my-3">Read before pre-enrollment</p>
                            <p class="fs-6 text-black-50">
                                Read all instructions carefully before applying.

                                Prepare all required documents in advance (passport, job offer, photos, certificates, etc.).

                                Book an appointment online—walk-ins are usually not accepted.

                                Ensure documents are complete, accurate, and in the correct format.

                                Bring both originals and copies to your appointment.

                                Requirements may vary by country and job type—check official guidelines.
                            </p>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between mt-5">
                            <button class="btn btn-light" type="reset">Cancel</button>
                            <button class="btn text-white border-0" style="background-color: #0064a7;" type="submit">Next</button>
                        </div>
                    </div>
                    <div id="workpermitForm2" class="multi-step-form" style="display:none;">
                        <div class="d-flex">
                            <div class="col-auto">
                                <a onclick="showPreviousForm(2)" style="cursor: pointer;">
                                    <i class="fa fa-chevron-left fs-4 ms-2" aria-hidden="true"></i>
                                </a>
                            </div>
                            <div class="col text-center">
                                <h3 style="color:#0064a7;">Work Permit Renewed</h3>
                                <p>Complete the form to start your work permit renewal process</p>
                            </div>
                        </div>

                        <div class="text-center my-4">
                            <div class="d-lg-inline-flex justify-content-center align-items-center gap-3 bg-light fs-6">
                                <p class="p-2 bg-light rounded-2 m-0">Select Service & Read Instructions</p>
                                <p class="p-2 rounded-2 text-white m-0" style="background-color: #0064a7;">Book Appointment</p>
                                <p class="p-2 bg-light rounded-2 m-0">Fill Application</p>
                                <p class="p-2 bg-light rounded-2 m-0">Payment</p>
                            </div>
                        </div>

                        <div class="mt-5 border border-1 border-dark-subtle rounded-4 p-3 p-md-5" id="form_2">
                            <div>
                                <h4 class="text-primary mb-4">Book Appointment</h4>
                            </div>
                            <div>
                                <form action="">
                                    <div class="row row-cols-2">
                                        <div class="col mb-3">
                                            <label for="appointment_country">Appointment Country:</label>
                                            <select id="appointment_country" name="appointment_country" class="form-select my-2" aria-label="Select appointment country">
                                                <option selected>Nepal</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                        <div class="col mb-3">
                                            <label for="appointment_province">Appointment Province:</label>
                                            <select id="appointment_province" name="appointment_province" class="form-select my-2" aria-label="Select appointment province">
                                                <option selected>Gandaki</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                        <div class="col mb-3">
                                            <label for="appointment_district">Appointment District:</label>
                                            <select id="appointment_district" name="appointment_district" class="form-select my-2" aria-label="Select appointment district">
                                                <option selected>Gandaki</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                        <div class="col mb-3">
                                            <label for="appointment_location">Appointment Location:</label>
                                            <select id="appointment_location" name="appointment_location" class="form-select my-2" aria-label="Select appointment location">
                                                <option selected>Department of Passports</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="d-flex justify-content-between mt-3">
                                <button class="btn btn-light">Cancel</button>
                                <button class="btn text-white border-0" style="background-color: #0064a7;" type="button" onclick="showNextForm(3)">Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 border border-1 border-dark-subtle rounded-4 p-3 p-md-5" id="form_3">
                        <div class="personalForm">
                            <div class="work-permit">
                                <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">
                                    Personal Information
                                </h4>
                            </div>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">

                                    <div class="col">
                                        <label for="firstName" class="form-label">First Name:</label>
                                        <input type="text" class="form-control fs-6" id="firstName" name="firstName" required maxlength="255" placeholder="John">
                                    </div>

                                    <div class="col">
                                        <label for="middleName" class="form-label">Middle Name:</label>
                                        <input type="text" class="form-control fs-6" id="middleName" name="middleName" maxlength="255" placeholder="Bahadur">
                                    </div>

                                    <div class="col">
                                        <label for="lastName" class="form-label">Last Name:</label>
                                        <input type="text" class="form-control fs-6" id="lastName" name="lastName" required maxlength="255" placeholder="Doe">
                                    </div>

                                    <div class="flatpickr-container flatpickr col d-flex flex-column">
                                        <label for="dateOfBirthAd" class="mb-1">Date of Birth (AD):</label>
                                        <div class="d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                            <input type="text" placeholder="1990-10-01" id="dateOfBirthAd" name="dateOfBirthAd" class="date-picker fs-6" required>
                                            <label for="dateOfBirthAd" class="input-button" title="toggle" data-toggle></label>
                                        </div>
                                    </div>

                                    <div class="flatpickr-container flatpickr col d-flex flex-column">
                                        <label for="dateOfBirthBs" class="mb-1">Date of Birth (BS):</label>
                                        <div class="d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 p-2 my-1">
                                            <input type="text" placeholder="1990-10-01" id="dateOfBirthBs" name="dateOfBirthBs" class="date-picker fs-6" required>
                                            <label for="dateOfBirthBs" class="input-button" title="toggle" data-toggle></label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label for="birthplace" class="form-label">Birthplace (District/Country if abroad):</label>
                                        <input type="text" class="form-control fs-6" id="birthplace" name="birthplace" required maxlength="255" placeholder="Pokhara">
                                    </div>

                                    <div class="col">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select id="gender" name="gender" class="form-select form-control fs-6" aria-label="Default select example">
                                            <option selected>Male</option>
                                        </select>
                                    </div>

                                    <div class="col">
                                        <label for="age" class="form-label">Age:</label>
                                        <input type="number" class="form-control fs-6" id="age" name="age" required placeholder="33">
                                    </div>

                                    <div class="col">
                                        <label for="nationality" class="form-label">Nationality</label>
                                        <input type="text" class="form-control fs-6" id="nationality" name="nationality" required maxlength="255" placeholder="Nepali">
                                    </div>

                                    <div class="col">
                                        <label for="religion" class="form-label">Religion:</label>
                                        <input type="text" class="form-control fs-6" id="religion" name="religion" required maxlength="255" placeholder="Hindu">
                                    </div>

                                    <div class="col">
                                        <label for="birthCountry" class="form-label">Birth Country:</label>
                                        <input type="text" class="form-control fs-6" id="birthCountry" name="birthCountry" required maxlength="255" placeholder="Nepal">
                                    </div>

                                    <div class="col">
                                        <label for="fatherName" class="form-label">Father's Name:</label>
                                        <input type="text" class="form-control fs-6" id="fatherName" name="fatherName" required maxlength="255" placeholder="Kiran Ale">
                                    </div>

                                    <div class="col">
                                        <label for="motherName" class="form-label">Mother's Name:</label>
                                        <input type="text" class="form-control fs-6" id="motherName" name="motherName" required maxlength="255" placeholder="Sita Ale">
                                    </div>

                                    <div class="col">
                                        <label for="status" class="form-label">Status:</label>
                                        <input type="text" class="form-control fs-6" id="status" name="status" required maxlength="255" placeholder="Single">
                                    </div>

                                    <div class="col">
                                        <label for="spouseName" class="form-label">Spouse Name:</label>
                                        <input type="text" class="form-control fs-6" id="spouseName" name="spouseName" required maxlength="255" placeholder="Simran Ale">
                                    </div>

                                    <div class="col">
                                        <label for="numberOfChildren" class="form-label">No. of Children:</label>
                                        <input type="number" class="form-control fs-6" id="numberOfChildren" name="numberOfChildren" required placeholder="2">
                                    </div>

                                    <div class="col">
                                        <label for="spouseAge" class="form-label">Spouse Age:</label>
                                        <input type="number" class="form-control fs-6" id="spouseAge" name="spouseAge" required placeholder="30">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bankDetails">
                        <div class="">
                            <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">
                                Bank Details
                            </h4>
                        </div>
                        <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">

                            <div class="col">
                                <label for="bankAccount" class="form-label">Bank Account:</label>
                                <select id="bankAccount" name="bankAccount" class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>Self</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="bankName" class="form-label fs-6">Bank Name:</label>
                                <input type="text" class="form-control form-control-da fs-6" id="bankName"
                                    name="bankName" required maxlength="255" placeholder="Nabil Bank">
                            </div>

                            <div class="col">
                                <label for="accountType" class="form-label">Account Type:</label>
                                <input type="text" id="accountType" name="accountType" class="form-control fs-6"
                                    required maxlength="255" placeholder="Saving">
                            </div>

                            <div class="col">
                                <label for="bankBranch" class="form-label">Bank Branch:</label>
                                <input type="text" id="bankBranch" name="bankBranch" class="form-control fs-6"
                                    required maxlength="255" placeholder="Amarsingh">
                            </div>

                            <div class="col">
                                <label for="bankNo" class="form-label fs-6">Bank No:</label>
                                <input type="number" class="form-control form-control-da fs-6" id="bankNo"
                                    name="bankNo" required maxlength="255" placeholder="00000000000">
                            </div>

                        </div>
                    </div>

                    <div class="citizenshipInfo">
                        <div class="">
                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">
                                Citizenship Information
                            </h4>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">

                                <div class="col">
                                    <label for="nationalIdentityNo" class="form-label">National Identity No (NIN-Only Digits):</label>
                                    <input type="number" class="form-control fs-6" id="nationalIdentityNo" name="nationalIdentityNo" required
                                        maxlength="255" placeholder="1234567890">
                                </div>

                                <div class="col">
                                    <label for="citizenshipNumber" class="form-label">Citizenship or Permit Number:</label>
                                    <input type="number" class="form-control fs-6" id="citizenshipNumber" name="citizenshipNumber" required
                                        maxlength="255" placeholder="1234567890">
                                </div>

                                <div class="flatpickr-container flatpickr col d-flex flex-column">
                                    <label for="dateOfIssue" class="mb-1">Citizenship Date of Issue (AD/BS):</label>
                                    <div class="d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                        <input type="text" placeholder="1990-10-01" id="dateOfIssue" name="dateOfIssue"
                                            class="date-picker fs-6" required>
                                        <label for="dateOfIssue" class="input-button" title="toggle" data-toggle>
                                        </label>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="placeOfIssueDistrict" class="form-label fs-6">Citizenship Place of Issue (District):</label>
                                    <input type="text" class="form-control fs-6" id="placeOfIssueDistrict" name="placeOfIssueDistrict"
                                        required maxlength="255" placeholder="Kaski">
                                </div>

                                <div class="col">
                                    <label for="placeOfIssueAbroad" class="form-label fs-6">Citizenship Place of Issue (If Abroad):</label>
                                    <input type="text" class="form-control fs-6" id="placeOfIssueAbroad" name="placeOfIssueAbroad"
                                        maxlength="255" placeholder="India">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="companyInfo">
                        <div class="">
                            <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Company Info</h4>
                        </div>
                        <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">

                            <div class="col">
                                <label for="country" class="form-label">Country:</label>
                                <select id="country" name="country" class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>Nepal</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="companyName" class="form-label fs-6">Company Name:</label>
                                <input type="text" class="form-control form-control-da fs-6" id="companyName" name="companyName"
                                    required maxlength="255" placeholder="TukiSoft">
                            </div>

                            <div class="col">
                                <label for="currency" class="form-label">Currency:</label>
                                <select id="currency" name="currency" class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>Nepalese Rupee</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="facilityDetails">
                        <div class="">
                            <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Facility Details</h4>
                        </div>
                        <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">

                            <div class="col">
                                <label for="skill" class="form-label fs-6">Skill:</label>
                                <input type="text" class="form-control form-control-da fs-6" id="skill" name="skill" required maxlength="255" placeholder="Enter Skill">
                            </div>

                            <div class="col">
                                <label for="salary" class="form-label fs-6">Salary:</label>
                                <input type="text" class="form-control form-control-da fs-6" id="salary" name="salary" required maxlength="255" placeholder="Enter Salary">
                            </div>

                            <div class="col">
                                <label for="workType" class="form-label fs-6">Work Type:</label>
                                <input type="text" class="form-control form-control-da fs-6" id="workType" name="workType" required maxlength="255" placeholder="Enter Work Type">
                            </div>

                            <div class="col">
                                <label for="food" class="form-label">Food:</label>
                                <select id="food" name="food" class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>No</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="accommodation" class="form-label">Accommodation:</label>
                                <select id="accommodation" name="accommodation" class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>No</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="dailyWorkHour" class="form-label fs-6">Daily Work Hour:</label>
                                <input type="text" class="form-control form-control-da fs-6" id="dailyWorkHour" name="dailyWorkHour" required maxlength="255" placeholder="8">
                            </div>

                            <div class="col">
                                <label for="weeklyWorkDay" class="form-label fs-6">Weekly Work Day:</label>
                                <input type="text" class="form-control form-control-da fs-6" id="weeklyWorkDay" name="weeklyWorkDay" required maxlength="255" placeholder="Monday">
                            </div>

                            <div class="col">
                                <label for="overTime" class="form-label">Over Time:</label>
                                <select id="overTime" name="overTime" class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>No</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="otherAllowance" class="form-label">Other Allowance:</label>
                                <select id="otherAllowance" name="otherAllowance" class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>No</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="otherFacility">
                        <div class="">
                            <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Other Facility</h4>
                        </div>
                        <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">

                            <div class="col">
                                <label for="transportation" class="form-label">Transportation:</label>
                                <select id="transportation" name="transportation" class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>No</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="healthInsurance" class="form-label">Health Insurance:</label>
                                <select id="healthInsurance" name="healthInsurance" class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>No</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="visaInfo">
                        <div class="">
                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Visa Information</h4>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">
                                <div class="col">
                                    <label for="visaNo" class="form-label">Visa No:</label>
                                    <input type="number" class="form-control fs-6" id="visaNo" name="visaNo" required maxlength="255" placeholder="Enter Visa No.">
                                </div>
                                <div class="col">
                                    <label for="citizenshipNumber" class="form-label">Citizenship or Permit Number:</label>
                                    <input type="number" class="form-control fs-6" id="citizenshipNumber" name="citizenshipNumber" required maxlength="255" placeholder="1234567890">
                                </div>

                                <div class="flatpickr-container flatpickr col d-flex flex-column">
                                    <label for="citizenshipDateOfIssue" class="mb-1">Citizenship Date of Issue (AD/BS):</label>
                                    <div class="d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                        <input type="text" placeholder="1990-10-01" id="citizenshipDateOfIssue" name="citizenshipDateOfIssue" class="date-picker fs-6" required>
                                        <label for="citizenshipDateOfIssue" class="input-button" title="toggle" data-toggle>
                                        </label>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="citizenshipPlaceOfIssueDistrict" class="form-label fs-6">Citizenship Place of Issue (District):</label>
                                    <input type="text" class="form-control form-control-da fs-6" id="citizenshipPlaceOfIssueDistrict" name="citizenshipPlaceOfIssueDistrict" required maxlength="255" placeholder="Kaksi">
                                </div>

                                <div class="col">
                                    <label for="citizenshipPlaceOfIssueAbroad" class="form-label fs-6">Citizenship Place of Issue (Abroad):</label>
                                    <input type="text" class="form-control form-control-da fs-6" id="citizenshipPlaceOfIssueAbroad" name="citizenshipPlaceOfIssueAbroad" required maxlength="255" placeholder="India">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="Nominee Info">
                        <div class="">
                            <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Nominee Info</h4>
                        </div>
                        <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                            <div class="col">
                                <label for="nominee" class="form-label">Import Nominee:</label>
                                <select class="form-select form-control fs-6" aria-label="Default select example" id="nominee" name="nominee">
                                    <option selected>Spouse</option>
                                    <option>Parent</option>
                                    <option>Child</option>
                                    <option>Other</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="nomineeName" class="form-label fs-6">Nominee Name: </label>
                                <input type="text" class="form-control form-control-da fs-6" id="nomineeName" name="nomineeName" required maxlength="255" placeholder="Hari Maya">
                            </div>

                            <div class="col">
                                <label for="nomineeRelation" class="form-label fs-6">Nominee Relation: </label>
                                <input type="text" class="form-control form-control-da fs-6" id="nomineeRelation" name="nomineeRelation" required maxlength="255" placeholder="Spouse">
                            </div>

                            <div class="col">
                                <label for="nomineeCountry" class="form-label fs-6">Country: </label>
                                <input type="text" class="form-control form-control-da fs-6" id="nomineeCountry" name="nomineeCountry" required maxlength="255" placeholder="Nepal">
                            </div>

                            <div class="col">
                                <label for="nomineeProvince" class="form-label">Province:</label>
                                <select class="form-select form-control fs-6" aria-label="Default select example">
                                    <option selected>Gandaki</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="nomineeDistrict" class="form-label fs-6">District: </label>
                                <input type="text" class="form-control form-control-da fs-6" id="nomineeDistrict" name="nomineeDistrict" required maxlength="255" placeholder="Enter District">
                            </div>

                            <div class="col">
                                <label for="nomineeCity" class="form-label fs-6">City: </label>
                                <input type="text" class="form-control form-control-da fs-6" id="nomineeCity" name="nomineeCity" required maxlength="255" placeholder="Pokhara">
                            </div>

                            <div class="col">
                                <label for="nomineeEmail" class="form-label fs-6">Email Address: </label>
                                <input type="text" class="form-control form-control-da fs-6" id="nomineeEmail" name="nomineeEmail" required maxlength="255" placeholder="example@domain.com">
                            </div>

                            <div class="col">
                                <label for="nomineePhone" class="form-label fs-6">Phone Number: </label>
                                <input type="text" class="form-control form-control-da fs-6" id="nomineePhone" name="nomineePhone" required maxlength="255" placeholder="1234567890">
                            </div>
                        </div>
                    </div>

                    <div class="Passport_info">
                        <div class="">
                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Passport Information</h4>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">
                                <div class="col">
                                    <label for="passportNumber" class="form-label">Passport Number:</label>
                                    <input type="number" class="form-control fs-6" id="passportNumber" name="passportNumber" required maxlength="255" placeholder="XXXXXXXXXXXXXXXX">
                                </div>

                                <div class="col">
                                    <label for="passportType" class="form-label">Passport Type:</label>
                                    <select class="form-select form-control fs-6" aria-label="Default select example" id="passportType" name="passportType">
                                        <option selected>Nepali</option>
                                        <!-- Add other options as needed -->
                                    </select>
                                </div>

                                <div class="flatpickr-container flatpickr col d-flex flex-column">
                                    <label for="issueDate" class="mb-1">Issue Date:</label>
                                    <div class="d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                        <input type="text" placeholder="1990-10-01" id="issueDate" name="issueDate" class="date-picker fs-6" required>
                                        <label for="issueDate" class="input-button" title="toggle" data-toggle>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="#000" d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                            </svg>
                                        </label>
                                    </div>
                                </div>

                                <div class="flatpickr-container flatpickr col d-flex flex-column">
                                    <label for="expiryDate" class="mb-1">Expiry Date:</label>
                                    <div class="d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                        <input type="text" placeholder="1990-10-01" id="expiryDate" name="expiryDate" class="date-picker fs-6" required>
                                        <label for="expiryDate" class="input-button" title="toggle" data-toggle>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="#000" d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                            </svg>
                                        </label>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="placeOfIssue" class="form-label fs-6">Place of Issue:</label>
                                    <input type="text" class="form-control form-control-da fs-6" id="placeOfIssue" name="placeOfIssue" required maxlength="255" placeholder="Kaksi">
                                </div>

                                <div class="col">
                                    <label for="issuingAuthority" class="form-label fs-6">Issuing Authority:</label>
                                    <input type="text" class="form-control form-control-da fs-6" id="issuingAuthority" name="issuingAuthority" required maxlength="255" placeholder="Department of Foreign Affairs">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="contactInfo">
                        <div class="">
                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">
                                Contact Information
                            </h4>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">

                                <div class="col">
                                    <label for="contactEmail" class="form-label">Email Address:</label>
                                    <input
                                        type="email"
                                        class="form-control fs-6"
                                        id="contactEmail"
                                        name="contactEmail"
                                        required
                                        maxlength="255"
                                        placeholder="dev@gmail.com">
                                </div>

                                <div class="col">
                                    <label for="country" class="form-label">Country:</label>
                                    <select
                                        id="country"
                                        name="country"
                                        class="form-select form-control fs-6"
                                        aria-label="Default select example">
                                        <option selected>Nepal</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="stateProvince" class="form-label">State/Province:</label>
                                    <select
                                        id="stateProvince"
                                        name="stateProvince"
                                        class="form-select form-control fs-6"
                                        aria-label="Default select example">
                                        <option selected>Gandaki</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="district" class="form-label">District:</label>
                                    <select
                                        id="district"
                                        name="district"
                                        class="form-select form-control fs-6"
                                        aria-label="Default select example">
                                        <option selected>Kaski</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="city" class="form-label fs-6">City:</label>
                                    <input
                                        type="text"
                                        class="form-control fs-6"
                                        id="city"
                                        name="city"
                                        required
                                        maxlength="255"
                                        placeholder="Pokhara">
                                </div>

                                <div class="col">
                                    <label for="phone" class="form-label fs-6">Phone Number:</label>
                                    <input
                                        type="tel"
                                        class="form-control fs-6"
                                        id="phone"
                                        name="phone"
                                        required
                                        maxlength="15"
                                        placeholder="1234567890">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="permanentAddress">
                        <div class="">
                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">
                                Permanent Address
                            </h4>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">

                                <div class="col">
                                    <label for="country" class="form-label">Country:</label>
                                    <select id="country" name="country" class="form-select form-control fs-6">
                                        <option selected>Nepal</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="province" class="form-label">Province:</label>
                                    <select id="province" name="province" class="form-select form-control fs-6">
                                        <option selected>Gandaki</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="district" class="form-label">District:</label>
                                    <select id="district" name="district" class="form-select form-control fs-6">
                                        <option selected>Kaski</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="municipality" class="form-label">Municipality:</label>
                                    <select id="municipality" name="municipality" class="form-select form-control fs-6">
                                        <option selected>Pokhara Lekhnath</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="wardNo" class="form-label fs-6">Ward No:</label>
                                    <input
                                        type="number"
                                        class="form-control form-control-da fs-6"
                                        id="wardNo"
                                        name="wardNo"
                                        required
                                        maxlength="255"
                                        placeholder="08">
                                </div>

                                <div class="col">
                                    <label for="city" class="form-label fs-6">City:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="city"
                                        name="city"
                                        required
                                        maxlength="255"
                                        placeholder="Pokhara">
                                </div>

                                <div class="col">
                                    <label for="tole" class="form-label fs-6">Tole:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="tole"
                                        name="tole"
                                        required
                                        maxlength="255"
                                        placeholder="Rambazar">
                                </div>

                                <div class="col">
                                    <label for="street" class="form-label fs-6">Street:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="street"
                                        name="street"
                                        required
                                        maxlength="255"
                                        placeholder="09">
                                </div>

                                <div class="col">
                                    <label for="houseNo" class="form-label fs-6">House No:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="houseNo"
                                        name="houseNo"
                                        required
                                        maxlength="255"
                                        placeholder="255">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="temporaryAddress">
                        <div class="d-flex justify-content-between">
                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">
                                Temporary Address
                            </h4>
                            <div class="form-check pt-3 pb-1">
                                <input
                                    class="form-check-input fs-6"
                                    type="checkbox"
                                    id="sameAsPermanent"
                                    name="sameAsPermanent">
                                <label class="form-check-label fs-6" for="sameAsPermanent">
                                    Same as Permanent Address
                                </label>
                            </div>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">

                                <div class="col">
                                    <label for="tempCountry" class="form-label">Country:</label>
                                    <select id="tempCountry" name="tempCountry" class="form-select form-control fs-6">
                                        <option selected>Nepal</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="tempProvince" class="form-label">Province:</label>
                                    <select id="tempProvince" name="tempProvince" class="form-select form-control fs-6">
                                        <option selected>Gandaki</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="tempDistrict" class="form-label">District:</label>
                                    <select id="tempDistrict" name="tempDistrict" class="form-select form-control fs-6">
                                        <option selected>Kaski</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="tempMunicipality" class="form-label">Municipality:</label>
                                    <select id="tempMunicipality" name="tempMunicipality" class="form-select form-control fs-6">
                                        <option selected>Pokhara Lekhnath</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="tempWardNo" class="form-label fs-6">Ward No:</label>
                                    <input
                                        type="number"
                                        class="form-control form-control-da fs-6"
                                        id="tempWardNo"
                                        name="tempWardNo"
                                        required
                                        maxlength="255"
                                        placeholder="08">
                                </div>

                                <div class="col">
                                    <label for="tempCity" class="form-label fs-6">City:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="tempCity"
                                        name="tempCity"
                                        required
                                        maxlength="255"
                                        placeholder="Pokhara">
                                </div>

                                <div class="col">
                                    <label for="tempTole" class="form-label fs-6">Tole:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="tempTole"
                                        name="tempTole"
                                        required
                                        maxlength="255"
                                        placeholder="Rambazar">
                                </div>

                                <div class="col">
                                    <label for="tempStreet" class="form-label fs-6">Street:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="tempStreet"
                                        name="tempStreet"
                                        required
                                        maxlength="255"
                                        placeholder="09">
                                </div>

                                <div class="col">
                                    <label for="tempHouseNo" class="form-label fs-6">House No:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="tempHouseNo"
                                        name="tempHouseNo"
                                        required
                                        maxlength="255"
                                        placeholder="255">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="emergencyContact">
                        <div class="">
                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">
                                Emergency Contact
                            </h4>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">

                                <div class="col">
                                    <label for="emergencyFullName" class="form-label fs-6">Full Name:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="emergencyFullName"
                                        name="emergencyFullName"
                                        required
                                        maxlength="255"
                                        placeholder="Ram">
                                </div>

                                <div class="col">
                                    <label for="emergencyRelation" class="form-label fs-6">Relationship:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="emergencyRelation"
                                        name="emergencyRelation"
                                        required
                                        maxlength="255"
                                        placeholder="Brother">
                                </div>

                                <div class="col">
                                    <label for="emergencyCountry" class="form-label">Country:</label>
                                    <select
                                        id="emergencyCountry"
                                        name="emergencyCountry"
                                        class="form-select form-control fs-6">
                                        <option selected>Nepal</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="emergencyStateProvince" class="form-label">State/Province:</label>
                                    <select
                                        id="emergencyStateProvince"
                                        name="emergencyStateProvince"
                                        class="form-select form-control fs-6">
                                        <option selected>Bagmati</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="emergencyDistrict" class="form-label">District:</label>
                                    <select
                                        id="emergencyDistrict"
                                        name="emergencyDistrict"
                                        class="form-select form-control fs-6">
                                        <option selected>Kaski</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="emergencyCity" class="form-label fs-6">City:</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-da fs-6"
                                        id="emergencyCity"
                                        name="emergencyCity"
                                        required
                                        maxlength="255"
                                        placeholder="Pokhara">
                                </div>

                                <div class="col">
                                    <label for="emergencyEmail" class="form-label fs-6">Email Address:</label>
                                    <input
                                        type="email"
                                        class="form-control form-control-da fs-6"
                                        id="emergencyEmail"
                                        name="emergencyEmail"
                                        required
                                        maxlength="255"
                                        placeholder="ram@gmail.com">
                                </div>

                                <div class="col">
                                    <label for="emergencyPhone" class="form-label fs-6">Phone No:</label>
                                    <input
                                        type="tel"
                                        class="form-control form-control-da fs-6"
                                        id="emergencyPhone"
                                        name="emergencyPhone"
                                        required
                                        maxlength="15"
                                        placeholder="1234567890">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="workDocuments">
                        <div class="">
                            <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">
                                Required Documents
                            </h4>
                        </div>

                        <div class="accordion-body row py-3 row-cols-1 row-cols-lg-2 row-gap-4 gx-5">
                            <div class="col">
                                <label for="passportPhoto" class="form-label fs-6">Passport Photo:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="passportPhoto"
                                    name="passportPhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>

                            <div class="col">
                                <label for="bankAccountPhoto" class="form-label fs-6">Bank Account Photo:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="bankAccountPhoto"
                                    name="bankAccountPhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>

                            <div class="col">
                                <label for="visaPhoto" class="form-label fs-6">Visa Photo:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="visaPhoto"
                                    name="visaPhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>

                            <div class="col">
                                <label for="chequePhoto" class="form-label fs-6">Cheque Photo:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="chequePhoto"
                                    name="chequePhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>

                            <div class="col">
                                <label for="agreementPhoto" class="form-label fs-6">Agreement Paper Photo:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="agreementPhoto"
                                    name="agreementPhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>

                            <div class="col">
                                <label for="arrivalStampPhoto" class="form-label fs-6">Arrival Stamp Photo:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="arrivalStampPhoto"
                                    name="arrivalStampPhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>

                            <div class="col">
                                <label for="embassyLetterPhoto" class="form-label fs-6">Embassy Letter Photo:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="embassyLetterPhoto"
                                    name="embassyLetterPhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>

                            <div class="col">
                                <label for="departureStampPhoto" class="form-label fs-6">Departure Stamp Photo:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="departureStampPhoto"
                                    name="departureStampPhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>

                            <div class="col">
                                <label for="oldLaborApprovalPhoto" class="form-label fs-6">Old Labor Approval Photo:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="oldLaborApprovalPhoto"
                                    name="oldLaborApprovalPhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>

                            <div class="col">
                                <label for="otherDocumentsPhoto" class="form-label fs-6">Other Documents:</label><br>
                                <label class="form-label fs-6 mb-3">(jpg, png, or pdf)</label>
                                <input
                                    type="file"
                                    class="form-control form-control-da fs-6"
                                    id="otherDocumentsPhoto"
                                    name="otherDocumentsPhoto"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>
                        </div>
                    </div>

                    <div class="my-4 border border-1 border-secondary"></div>
                    <div class="d-flex flex-column mx-3 mb-5">

                        <div class="form-check">
                            <input class="form-check-input fs-6" type="checkbox" value="" id="checkCorrect"
                                required>
                            <label class="form-check-label fs-6" for="checkCorrect">
                                I confirm that all
                                information
                                provided is accurate and complete. I
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
                            <input class="form-check-input fs-6" type="checkbox" value="" id="checkTerms"
                                required>
                            <label class="form-check-label fs-6" for="checkTerms">
                                I agree to the Terms
                                and
                                Conditions
                                and Privacy Policy of
                                Kamsansar's
                                passport
                                renewal service.
                            </label>
                        </div>
                        <div class="required-fields-message">* - Required fields -
                            Please
                            fill all
                            required fields before proceeding.</div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <button class="btn btn-light" type="button">Cancel</button>
                        <div class="d-block">
                            <button class="btn text-white border-0 mt-0"
                                style="background-color: #0064a7; " type="button" form="passportForm"
                                id="form3NextBtn" onclick="showNextForm(4)">Next</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>