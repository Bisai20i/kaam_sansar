@extends('frontend.layouts.main')

@section('title', 'Edit Work Permit')

@section('content')

<div id="multiStepForm3" class=" multi-step-form mt-5 pt-3">
    <div id="form-container" class="container-fluid container-lg border border-1 border-dark-subtle rounded-4 p-md-5 py-5 mb-5 mt-5">

        <div class="row">
            <div class="col-auto">
                <a href="{{ route('jobseeker.forms') }}" style="cursor: pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="36" viewBox="0 0 12 24">
                        <path fill="#000" fill-rule="evenodd"
                            d="m3.343 12l7.071 7.071L9 20.485l-7.778-7.778a1 1 0 0 1 0-1.414L9 3.515l1.414 1.414z" />
                    </svg>
                </a>
            </div>
            <div class="col text-center">
                <h3 style="color:#0064a7;">Work Permit Renewed</h3>
            </div>
        </div>

        <style>
            .activeTitle {
                background-color: #0064a7 !important;
                color: #fff;
            }

            .existing-file {
                display: flex;
                align-items: center;
                margin-top: 5px;
            }

            .existing-file a {
                margin-left: 10px;
                color: #0064a7;
            }
        </style>

        <div class="text-center my-4">
            <div class="d-md-inline-flex justify-content-center align-items-center gap-3 bg-light fs-6">
                <p class="title p-2 rounded-2 m-0 activeTitle" id="firstFormTitle">Select Service & Read Instructions</p>
                <p class="title p-2 bg-light rounded-2 m-0" id="secondFormTitle">Book Appointment</p>
                <p class="title p-2 bg-light rounded-2 m-0" id="mainFormTitle">Edit Application</p>
                <p class="title p-2 bg-light rounded-2 m-0" id="fourthFormTitle">Payment</p>
            </div>
        </div>

        <div class="my-3 mb-5 border container border-1 border-dark-subtle rounded-4 p-3 p-md-5">
            <form id="workPermitEditForm" action="{{ route('workPermits.update', $workPermit->id) }}" enctype="multipart/form-data" method="POST" class="accordion">
                @csrf
                @method('PUT')

                <div id="firstForm">
                    <div>
                        <h4 style="color:#0064a7;">Service Type</h4>
                        <p class="fs-6 my-3">Current service type:</p>
                    </div>
                    <div class="mb-3">
                        <div class="nav nav-pills mb-3 row" id="pills-tab" role="tablist">
                            <input type="hidden" name="serviceType" id="serviceType" value="{{ $workPermit->serviceType }}" required>
                            <div class="col-auto nav-item" role="presentation">
                                <button class="nav-link border border-1 border-dark-subtle fs-6 {{ $workPermit->serviceType === 'apply' ? 'active' : '' }}"
                                    data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                                    aria-controls="pills-home" aria-selected="true"
                                    onclick="document.getElementById('serviceType').value = 'apply'"> New Work Permit Issuance</button>
                            </div>
                            <div class="col-auto nav-item" role="presentation">
                                <button class="nav-link border border-1 border-dark-subtle fs-6 {{ $workPermit->serviceType === 'renewal' ? 'active' : '' }}"
                                    data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                                    aria-controls="pills-home" aria-selected="true"
                                    onclick="document.getElementById('serviceType').value = 'renewal'">Renewal work Permit</button>
                            </div>
                            <div class="col-auto nav-item" role="presentation">
                                <button class="nav-link border border-1 border-dark-subtle fs-6 {{ $workPermit->serviceType === 'replacement' ? 'active' : '' }}"
                                    data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                                    aria-controls="pills-home" aria-selected="true"
                                    onclick="document.getElementById('serviceType').value = 'replacement'">Legalization</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <h4 style="color:#0064a7;">Read Instructions</h4>
                        <p class="fs-6 my-3">Read before pre-enrollment</p>
                        <p>
                        <ul class="fs-6 " style="color:gray">
                            <li>You can renew your work permit only if it is still valid or has recently expired, and your employment details remain unchanged.</li>
                            <li>Submit your renewal application before the permit expires or within 30 days after expiration to avoid penalties.</li>
                            <li>Prepare all required documents including your current work permit, passport, visa, employment contract, recent photo, and tax clearance if needed.</li>
                            <li>Ensure all information provided matches your documents exactly to prevent rejection or processing delays.</li>
                        </ul>
                        </p>
                    </div>
                    <div class="mt-5">
                        <div class="d-flex justify-content-between mt-5">
                            <a href="{{ route('jobseeker.forms') }}" class="btn btn-light btn-lg py-2 px-4" type="button">back</a>
                            <button class="btn btn-lg py-2 px-4 text-white btn-next mt-0"
                                style="background-color: #0064a7;" type="button"
                                onclick="goToForm('firstForm','secondForm')">Next</button>
                        </div>
                    </div>
                </div>

                <div id="secondForm" class="d-none">
                    <div>
                        <h4 class="fs-4 text-semibold d-flex align-items-center" style="color:#0064a7;">
                            <button style="all:unset;cursor: pointer; margin-right:10px;" type="button"
                                onclick="goToForm('secondForm','firstForm')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="36" viewBox="0 0 12 24">
                                    <path fill="#000" fill-rule="evenodd"
                                        d="m3.343 12l7.071 7.071L9 20.485l-7.778-7.778a1 1 0 0 1 0-1.414L9 3.515l1.414 1.414z" />
                                </svg>
                            </button>
                            Edit Appointment
                        </h4>
                    </div>
                    <div class="mb-2">
                        <div class="row row-cols-1 row-cols-md-2">
                            <div class="col">
                                <label for="appCountry" class="required">Appointment Country:</label>
                                <select class="form-select my-2" aria-label="Default select example" id="appCountry" required name="appCountry">
                                    <option value="">Select Country</option>
                                    <option value="{{ $nepal->countryName }}" selected>{{ $nepal->countryName }}</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="appProvince" class="required">Appointment Province:</label>
                                <select class="form-select my-2" aria-label="Default select example" id="appProvince" name="appProvince" required>
                                    <option value="">Select Province</option>
                                    @foreach($provinces as $province)
                                    <option value="{{ $province->provienceName }}" {{ $workPermit->appProvince == $province->provienceName ? 'selected' : '' }}>
                                        {{ $province->provienceName }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="appDistrict" class="required">Select District:</label>
                                <select class="form-select my-2" aria-label="Default select example" name="appDistrict" id="appDistrict" required>
                                    <option value="">Select District</option>
                                    @foreach($districts as $district)
                                    @if($district['provienceName'] == $workPermit->appProvince)
                                    <option value="{{ $district['districtName'] }}" {{ $workPermit->appDistrict == $district['districtName'] ? 'selected' : '' }}>
                                        {{ $district['districtName'] }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="appLocation" class="required">Appointment Location:</label>
                                <select class="form-select my-2" aria-label="Default select example" id="appLocation" name="appLocation" required>
                                    <option value="">Select Location</option>
                                    @foreach($locations as $location)
                                    @if($location['districtName'] == $workPermit->appDistrict)
                                    <option value="{{ $location['locationName'] }}" {{ $workPermit->appLocation == $location['locationName'] ? 'selected' : '' }}>
                                        {{ $location['locationName'] }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-5">
                        <button class="btn btn-light btn-lg py-2 px-4" type="button"
                            onclick="goToForm('secondForm','firstForm')">Back</button>
                        <button class="btn btn-lg py-2 px-4 text-white btn-next mt-0" style="background-color: #0064a7;"
                            type="button"
                            onclick="if(validateAppointmentForm()) goToForm('secondForm','mainForm')">Next</button>
                    </div>
                </div>

                <div id="mainForm" class="d-none">
                    <h2 class="fs-4 text-semibold d-flex align-items-center" style="color:#0064a7;">
                        <button style="all:unset;cursor: pointer; margin-right:10px;" type="button"
                            onclick="goToForm('mainForm','secondForm')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="36" viewBox="0 0 12 24">
                                <path fill="#000" fill-rule="evenodd"
                                    d="m3.343 12l7.071 7.071L9 20.485l-7.778-7.778a1 1 0 0 1 0-1.414L9 3.515l1.414 1.414z" />
                            </svg>
                        </button> Edit Application
                    </h2>

                    <hr>

                    <h4 class="d-inline py-2 accordion-header fs-5 text-semibold" style="color:#0064a7;">
                        Personal Information
                    </h4>
                    <div class="row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 gx-3">
                        <div class="col">
                            <label for="firstName" class="form-label fs-6 required">First Name</label>
                            <br>
                            <input type="text" class="form-control" id="firstName" name="firstName" required
                                value="{{ old('firstName', $workPermit->firstName) }}">
                        </div>
                        <div class="col">
                            <label for="middleName" class="form-label fs-6">Middle Name</label>
                            <br>
                            <input type="text" class="form-control" id="middleName" name="middleName"
                                value="{{ old('middleName', $workPermit->middleName) }}">
                        </div>
                        <div class="col">
                            <label for="lastName" class="form-label fs-6 required">Last Name</label>
                            <br>
                            <input type="text" class="form-control" id="lastName" name="lastName" required
                                value="{{ old('lastName', $workPermit->lastName) }}">
                        </div>

                        <div class="col">
                            <label for="dateOfBirthAd" class="form-label fs-6 ">Date of Birth(AD)</label>
                            <br>
                            <input type="date" class="form-control" id="dateOfBirthAd" name="dateOfBirthAd"
                                value="{{ old('dateOfBirthAd', $workPermit->dateOfBirthAd) }}">
                        </div>

                        <div class="col">
                            <label for="dateOfBirthBs" class="form-label fs-6 ">Date of Birth(BS)</label>
                            <br>
                            <input type="text" class="form-control" id="dateOfBirthBs" name="dateOfBirthBs"
                                value="{{ old('dateOfBirthBs', $workPermit->dateOfBirthBs) }}">
                        </div>

                        <div class="col">
                            <label for="phoneNo" class="form-label fs-6 required">Phone Number</label>
                            <br>
                            <input type="text" class="form-control" id="phoneNo" name="phoneNo" required
                                value="{{ old('phoneNo', $workPermit->phoneNo) }}">
                        </div>

                        <div class="col">
                            <label for="birthplace" class="form-label fs-6">Birthplace</label>
                            <input type="text" class="form-control" id="birthplace" name="birthplace" value="{{ old('birthplace', $workPermit->birthplace) }}">
                        </div>

                        <div class="col">
                            <label for="gender" class="form-label fs-6">Gender</label>
                            <input type="text" class="form-control" id="gender" name="gender" value="{{ old('gender', $workPermit->gender) }}">
                        </div>

                        <div class="col">
                            <label for="age" class="form-label fs-6">Age</label>
                            <input type="number" class="form-control" id="age" name="age" value="{{ old('age', $workPermit->age) }}">
                        </div>

                        <div class="col">
                            <label for="nationality" class="form-label fs-6">Nationality</label>
                            <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality', $workPermit->nationality) }}">
                        </div>

                        <div class="col">
                            <label for="religion" class="form-label fs-6">Religion</label>
                            <input type="text" class="form-control" id="religion" name="religion" value="{{ old('religion', $workPermit->religion) }}">
                        </div>

                        <div class="col">
                            <label for="birthCountry" class="form-label fs-6">Birth Country</label>
                            <input type="text" class="form-control" id="birthCountry" name="birthCountry" value="{{ old('birthCountry', $workPermit->birthCountry) }}">
                        </div>

                        <div class="col">
                            <label for="fatherName" class="form-label fs-6">Father's Name</label>
                            <input type="text" class="form-control" id="fatherName" name="fatherName" value="{{ old('fatherName', $workPermit->fatherName) }}">
                        </div>

                        <div class="col">
                            <label for="motherName" class="form-label fs-6">Mother's Name</label>
                            <input type="text" class="form-control" id="motherName" name="motherName" value="{{ old('motherName', $workPermit->motherName) }}">
                        </div>

                        <div class="col">
                            <label for="marriedStatus" class="form-label fs-6">Marital Status</label>
                            <input type="text" class="form-control" id="marriedStatus" name="marriedStatus" value="{{ old('marriedStatus', $workPermit->marriedStatus) }}">
                        </div>

                        <div class="col">
                            <label for="spouseName" class="form-label fs-6">Spouse Name</label>
                            <input type="text" class="form-control" id="spouseName" name="spouseName" value="{{ old('spouseName', $workPermit->spouseName) }}">
                        </div>

                        <div class="col">
                            <label for="numberOfChildren" class="form-label fs-6">Number of Children</label>
                            <input type="number" class="form-control" id="numberOfChildren" name="numberOfChildren" value="{{ old('numberOfChildren', $workPermit->numberOfChildren) }}">
                        </div>

                        <div class="col">
                            <label for="spouseAge" class="form-label fs-6">Spouse Age</label>
                            <input type="number" class="form-control" id="spouseAge" name="spouseAge" value="{{ old('spouseAge', $workPermit->spouseAge) }}">
                        </div>

                    </div>
                    <h4 class="d-inline py-2 accordion-header fs-5 text-semibold" style="color:#0064a7;">
                        Bank Details
                    </h4>

                    <div class="row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 gx-3">
                        <div class="col">
                            <label for="bankAccount" class="form-label fs-6">Bank Account</label>
                            <input type="text" class="form-control" id="bankAccount" name="bankAccount" value="{{ old('bankAccount', $workPermit->bankAccount) }}">
                        </div>

                        <div class="col">
                            <label for="bankName" class="form-label fs-6">Bank Name</label>
                            <input type="text" class="form-control" id="bankName" name="bankName" value="{{ old('bankName', $workPermit->bankName) }}">
                        </div>

                        <div class="col">
                            <label for="accountType" class="form-label fs-6">Account Type</label>
                            <input type="text" class="form-control" id="accountType" name="accountType" value="{{ old('accountType', $workPermit->accountType) }}">
                        </div>

                        <div class="col">
                            <label for="bankBranch" class="form-label fs-6">Bank Branch</label>
                            <input type="text" class="form-control" id="bankBranch" name="bankBranch" value="{{ old('bankBranch', $workPermit->bankBranch) }}">
                        </div>

                        <div class="col">
                            <label for="bankNo" class="form-label fs-6">Bank No</label>
                            <input type="text" class="form-control" id="bankNo" name="bankNo" value="{{ old('bankNo', $workPermit->bankNo) }}">
                        </div>
                    </div>
                    <h4 class="d-inline py-2 accordion-header fs-5 text-semibold" style="color:#0064a7;">
                        Citizenship Information </h4>

                    <div class="row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 gx-3">
                        <div class="col">
                            <label for="nationalIdentityNo" class="form-label fs-6">National Identity No</label>
                            <input type="text" class="form-control" id="nationalIdentityNo" name="nationalIdentityNo" value="{{ old('nationalIdentityNo', $workPermit->nationalIdentityNo) }}">
                        </div>

                        <div class="col">
                            <label for="citizenshipNumber" class="form-label fs-6">Citizenship Number</label>
                            <input type="text" class="form-control" id="citizenshipNumber" name="citizenshipNumber" value="{{ old('citizenshipNumber', $workPermit->citizenshipNumber) }}">
                        </div>

                        <div class="col">
                            <label for="dateOfIssue" class="form-label fs-6">Date of Issue</label>
                            <input type="date" class="form-control" id="dateOfIssue" name="dateOfIssue" value="{{ old('dateOfIssue', $workPermit->dateOfIssue) }}">
                        </div>

                        <div class="col">
                            <label for="placeOfIssueDistrict" class="form-label fs-6">Place of Issue (District)</label>
                            <input type="text" class="form-control" id="placeOfIssueDistrict" name="placeOfIssueDistrict" value="{{ old('placeOfIssueDistrict', $workPermit->placeOfIssueDistrict) }}">
                        </div>

                        <div class="col">
                            <label for="placeOfIssueAbroad" class="form-label fs-6">Place of Issue (Abroad)</label>
                            <input type="text" class="form-control" id="placeOfIssueAbroad" name="placeOfIssueAbroad" value="{{ old('placeOfIssueAbroad', $workPermit->placeOfIssueAbroad) }}">
                        </div>

                    </div>
                    <h4 class="d-inline py-2 accordion-header fs-5 text-semibold" style="color:#0064a7;">
                        Citizenship Information </h4>

                    <div class="row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 gx-3">
                        <div class="col">
                            <label for="country" class="form-label fs-6">Country</label>
                            <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $workPermit->country) }}">
                        </div>

                        <div class="col">
                            <label for="companyName" class="form-label fs-6">Company Name</label>
                            <input type="text" class="form-control" id="companyName" name="companyName" value="{{ old('companyName', $workPermit->companyName) }}">
                        </div>

                        <div class="col">
                            <label for="currency" class="form-label fs-6">Currency</label>
                            <input type="text" class="form-control" id="currency" name="currency" value="{{ old('currency', $workPermit->currency) }}">
                        </div>
                    </div>

                    <h4 class="d-inline py-2 accordion-header fs-5 text-semibold" style="color:#0064a7;">
                        Facility Details </h4>

                    <div class="row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 gx-3">
                        <div class="col">
                            <label for="skill" class="form-label fs-6">Skill</label>
                            <input type="text" class="form-control" id="skill" name="skill" value="{{ old('skill', $workPermit->skill) }}">
                        </div>

                        <div class="col">
                            <label for="salary" class="form-label fs-6">Salary</label>
                            <input type="text" class="form-control" id="salary" name="salary" value="{{ old('salary', $workPermit->salary) }}">
                        </div>

                        <div class="col">
                            <label for="workType" class="form-label fs-6">Work Type</label>
                            <input type="text" class="form-control" id="workType" name="workType" value="{{ old('workType', $workPermit->workType) }}">
                        </div>

                        <div class="col">
                            <label for="food" class="form-label fs-6">Food</label>
                            <input type="text" class="form-control" id="food" name="food" value="{{ old('food', $workPermit->food) }}">
                        </div>

                        <div class="col">
                            <label for="accommodation" class="form-label fs-6">Accommodation</label>
                            <input type="text" class="form-control" id="accommodation" name="accommodation" value="{{ old('accommodation', $workPermit->accommodation) }}">
                        </div>

                        <div class="col">
                            <label for="dailyWorkHour" class="form-label fs-6">Daily Work Hour</label>
                            <input type="text" class="form-control" id="dailyWorkHour" name="dailyWorkHour" value="{{ old('dailyWorkHour', $workPermit->dailyWorkHour) }}">
                        </div>

                        <div class="col">
                            <label for="weeklyWorkDay" class="form-label fs-6">Weekly Work Day</label>
                            <input type="text" class="form-control" id="weeklyWorkDay" name="weeklyWorkDay" value="{{ old('weeklyWorkDay', $workPermit->weeklyWorkDay) }}">
                        </div>

                        <div class="col">
                            <label for="overTime" class="form-label fs-6">Over Time</label>
                            <input type="text" class="form-control" id="overTime" name="overTime" value="{{ old('overTime', $workPermit->overTime) }}">
                        </div>

                        <div class="col">
                            <label for="otherAllowance" class="form-label fs-6">Other Allowance</label>
                            <input type="text" class="form-control" id="otherAllowance" name="otherAllowance" value="{{ old('otherAllowance', $workPermit->otherAllowance) }}">
                        </div>
                    </div>

                    <h4 class="d-inline py-2 accordion-header fs-5 text-semibold" style="color:#0064a7;">
                        Facility Details </h4>

                    <div class="row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 gx-3">
                        <div class="col">
                            <label for="transportation" class="form-label fs-6">Transportation</label>
                            <input type="text" class="form-control" id="transportation" name="transportation" value="{{ old('transportation', $workPermit->transportation) }}">
                        </div>

                        <div class="col">
                            <label for="healthInsurance" class="form-label fs-6">Health Insurance</label>
                            <input type="text" class="form-control" id="healthInsurance" name="healthInsurance" value="{{ old('healthInsurance', $workPermit->healthInsurance) }}">
                        </div>
                    </div>


                    <h4 class="d-inline py-2 accordion-header fs-5 text-semibold" style="color:#0064a7;">
                        Visa Info </h4>

                    <div class="row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 gx-3">

                        <div class="col">
                            <label for="visaNo" class="form-label fs-6">Visa No</label>
                            <input type="text" class="form-control" id="visaNo" name="visaNo" value="{{ old('visaNo', $workPermit->visaNo) }}">
                        </div>

                        <div class="col">
                            <label for="citizenshipDateOfIssue" class="form-label fs-6">Citizenship Date of Issue</label>
                            <input type="date" class="form-control" id="citizenshipDateOfIssue" name="citizenshipDateOfIssue" value="{{ old('citizenshipDateOfIssue', $workPermit->citizenshipDateOfIssue) }}">
                        </div>

                        <div class="col">
                            <label for="citizenshipPlaceOfIssueDistrict" class="form-label fs-6">Citizenship Place of Issue (District)</label>
                            <input type="text" class="form-control" id="citizenshipPlaceOfIssueDistrict" name="citizenshipPlaceOfIssueDistrict" value="{{ old('citizenshipPlaceOfIssueDistrict', $workPermit->citizenshipPlaceOfIssueDistrict) }}">
                        </div>

                        <div class="col">
                            <label for="citizenshipPlaceOfIssueAbroad" class="form-label fs-6">Citizenship Place of Issue (Abroad)</label>
                            <input type="text" class="form-control" id="citizenshipPlaceOfIssueAbroad" name="citizenshipPlaceOfIssueAbroad" value="{{ old('citizenshipPlaceOfIssueAbroad', $workPermit->citizenshipPlaceOfIssueAbroad) }}">
                        </div>

                    </div>

                    <h4 class="d-inline py-2 accordion-header fs-5 text-semibold" style="color:#0064a7;">
                        Nominee Details
                    </h4>

                    <div class="row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 gx-3">
                        <div class="col">
                            <label for="nominee" class="form-label fs-6">Nominee</label>
                            <input type="text" class="form-control" id="nominee" name="nominee" value="{{ old('nominee', $workPermit->nominee) }}">
                        </div>

                        <div class="col">
                            <label for="nomineeName" class="form-label fs-6">Nominee Name</label>
                            <input type="text" class="form-control" id="nomineeName" name="nomineeName" value="{{ old('nomineeName', $workPermit->nomineeName) }}">
                        </div>

                        <div class="col">
                            <label for="nomineeRelation" class="form-label fs-6">Nominee Relation</label>
                            <input type="text" class="form-control" id="nomineeRelation" name="nomineeRelation" value="{{ old('nomineeRelation', $workPermit->nomineeRelation) }}">
                        </div>

                        <div class="col">
                            <label for="nomineeCountry" class="form-label fs-6">Nominee Country</label>
                            <input type="text" class="form-control" id="nomineeCountry" name="nomineeCountry" value="{{ old('nomineeCountry', $workPermit->nomineeCountry) }}">
                        </div>

                        <div class="col">
                            <label for="nomineeProvince" class="form-label fs-6">Nominee Province</label>
                            <input type="text" class="form-control" id="nomineeProvince" name="nomineeProvince" value="{{ old('nomineeProvince', $workPermit->nomineeProvince) }}">
                        </div>

                        <div class="col">
                            <label for="nomineeDistrict" class="form-label fs-6">Nominee District</label>
                            <input type="text" class="form-control" id="nomineeDistrict" name="nomineeDistrict" value="{{ old('nomineeDistrict', $workPermit->nomineeDistrict) }}">
                        </div>

                        <div class="col">
                            <label for="nomineeCity" class="form-label fs-6">Nominee City</label>
                            <input type="text" class="form-control" id="nomineeCity" name="nomineeCity" value="{{ old('nomineeCity', $workPermit->nomineeCity) }}">
                        </div>

                        <div class="col">
                            <label for="nomineeEmail" class="form-label fs-6">Nominee Email</label>
                            <input type="email" class="form-control" id="nomineeEmail" name="nomineeEmail" value="{{ old('nomineeEmail', $workPermit->nomineeEmail) }}">
                        </div>

                        <div class="col">
                            <label for="nomineePhone" class="form-label fs-6">Nominee Phone</label>
                            <input type="text" class="form-control" id="nomineePhone" name="nomineePhone" value="{{ old('nomineePhone', $workPermit->nomineePhone) }}">
                        </div>
                    </div>

                    <h4 class="d-inline py-2 accordion-header fs-5 text-semibold" style="color:#0064a7;">
                        Passport Details
                    </h4>

                    <div class="row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 gx-3">
                        <div class="col">
                            <label for="passportNumber" class="form-label fs-6">Passport Number</label>
                            <input type="text" class="form-control" id="passportNumber" name="passportNumber" value="{{ old('passportNumber', $workPermit->passportNumber) }}">
                        </div>

                        <div class="col">
                            <label for="passportType" class="form-label fs-6">Passport Type</label>
                            <input type="text" class="form-control" id="passportType" name="passportType" value="{{ old('passportType', $workPermit->passportType) }}">
                        </div>

                        <div class="col">
                            <label for="issueDate" class="form-label fs-6">Issue Date</label>
                            <input type="date" class="form-control" id="issueDate" name="issueDate" value="{{ old('issueDate', $workPermit->issueDate) }}">
                        </div>

                        <div class="col">
                            <label for="expiryDate" class="form-label fs-6">Expiry Date</label>
                            <input type="date" class="form-control" id="expiryDate" name="expiryDate" value="{{ old('expiryDate', $workPermit->expiryDate) }}">
                        </div>

                        <div class="col">
                            <label for="placeOfIssue" class="form-label fs-6">Place of Issue</label>
                            <input type="text" class="form-control" id="placeOfIssue" name="placeOfIssue" value="{{ old('placeOfIssue', $workPermit->placeOfIssue) }}">
                        </div>

                        <div class="col">
                            <label for="issuingAuthority" class="form-label fs-6">Issuing Authority</label>
                            <input type="text" class="form-control" id="issuingAuthority" name="issuingAuthority" value="{{ old('issuingAuthority', $workPermit->issuingAuthority) }}">
                        </div>
                    </div>
                    <h4 class="d-inline py-2 accordion-header fs-5 text-semibold" style="color:#0064a7;">
                        Contact Information
                    </h4>

                    <div class="row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 gx-3">
                        <div class="col">
                            <label for="contCountry" class="form-label fs-6">Country:<span class="text-danger">*</label>
                            <input type="text" class="form-control" id="contCountry" name="contCountry" value="{{ old('contCountry', $workPermit->contCountry) }}" required>
                        </div>

                        <div class="col">
                            <label for="state" class="form-label fs-6">State:<span class="text-danger">*</label>
                            <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $workPermit->state) }}" required>
                        </div>

                        <div class="col">
                            <label for="contdistrict" class="form-label fs-6">District:<span class="text-danger">*</label>
                            <input type="text" class="form-control" id="contdistrict" name="contdistrict" value="{{ old('contdistrict', $workPermit->contdistrict) }}" required>
                        </div>

                        <div class="col">
                            <label for="contCity" class="form-label fs-6">City:<span class="text-danger">*</label>
                            <input type="text" class="form-control" id="contCity" name="contCity" value="{{ old('contCity', $workPermit->contCity) }}" required>
                        </div>

                        <div class="col">
                            <label for="phoneNo" class="form-label fs-6">Phone Number:<span class="text-danger">*</label>
                            <input type="tel" class="form-control" id="phoneNo" name="phoneNo" value="{{ old('phoneNo', $workPermit->phoneNo) }}" required>
                        </div>

                        <div class="col">
                            <label for="email" class="form-label fs-6">Email Address:<span class="text-danger">*</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $workPermit->email) }}" required>
                        </div>
                    </div>

                    <h4 class="d-inline py-2 accordion-header fs-5 text-semibold" style="color:#0064a7;">
                        Permanent Address
                    </h4>

                    <div class="row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 gx-3">
                        <div class="col">
                            <label for="contactCountry" class="form-label fs-6">Country</label>
                            <input type="text" class="form-control" id="contactCountry" name="contactCountry" value="{{ old('contactCountry', $workPermit->contactCountry) }}">
                        </div>

                        <div class="col">
                            <label for="province" class="form-label fs-6">Province</label>
                            <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $workPermit->province) }}">
                        </div>


                        <div class="col">
                            <label for="district" class="form-label fs-6">District</label>
                            <input type="text" class="form-control" id="district" name="district" value="{{ old('district', $workPermit->district) }}">
                        </div>

                        <div class="col">
                            <label for="city" class="form-label fs-6">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $workPermit->city) }}">
                        </div>


                        <div class="col">
                            <label for="municipality" class="form-label fs-6">Municipality</label>
                            <input type="text" class="form-control" id="municipality" name="municipality" value="{{ old('municipality', $workPermit->municipality) }}">
                        </div>

                        <div class="col">
                            <label for="wardNo" class="form-label fs-6">Ward No</label>
                            <input type="number" class="form-control" id="wardNo" name="wardNo" value="{{ old('wardNo', $workPermit->wardNo) }}">
                        </div>

                        <div class="col">
                            <label for="tole" class="form-label fs-6">Tole</label>
                            <input type="text" class="form-control" id="tole" name="tole" value="{{ old('tole', $workPermit->tole) }}">
                        </div>

                        <div class="col">
                            <label for="street" class="form-label fs-6">Street</label>
                            <input type="text" class="form-control" id="street" name="street" value="{{ old('street', $workPermit->street) }}">
                        </div>

                        <div class="col">
                            <label for="houseNo" class="form-label fs-6">House No</label>
                            <input type="text" class="form-control" id="houseNo" name="houseNo" value="{{ old('houseNo', $workPermit->houseNo) }}">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <h4 class="d-inline py-2 accordion-header fs-5 text-semibold" style="color:#0064a7;">
                            Temporary Address
                        </h4>
                        <div class="form-check pt-3 pb-1">
                            <input type="hidden" name="sameAsPermanent" value="0"> <!-- For unchecked state -->
                            <input
                                class="form-check-input fs-6"
                                type="checkbox"
                                id="sameAsPermanent"
                                name="sameAsPermanent"
                                value="1"
                                {{ old('sameAsPermanent', $passportRenewal->sameAsPermanent ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label fs-6" for="sameAsPermanent">
                                Same as Permanent Address
                            </label>
                        </div>
                    </div>
                    <div class="row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 gx-3">
                        <div class="col">
                            <label for="tempCountry" class="form-label fs-6">Country</label>
                            <input type="text" class="form-control" id="tempCountry" name="tempCountry" value="{{ old('tempCountry', $workPermit->tempCountry) }}">
                        </div>

                        <div class="col">
                            <label for="tempProvince" class="form-label fs-6">Province</label>
                            <input type="text" class="form-control" id="tempProvince" name="tempProvince" value="{{ old('tempProvince', $workPermit->tempProvince) }}">
                        </div>

                        <div class="col">
                            <label for="tempDistrict" class="form-label fs-6">District</label>
                            <input type="text" class="form-control" id="tempDistrict" name="tempDistrict" value="{{ old('tempDistrict', $workPermit->tempDistrict) }}">
                        </div>

                        <div class="col">
                            <label for="tempMunicipality" class="form-label fs-6">Municipality</label>
                            <input type="text" class="form-control" id="tempMunicipality" name="tempMunicipality" value="{{ old('tempMunicipality', $workPermit->tempMunicipality) }}">
                        </div>

                        <div class="col">
                            <label for="tempWardNo" class="form-label fs-6">Ward No</label>
                            <input type="number" class="form-control" id="tempWardNo" name="tempWardNo" value="{{ old('tempWardNo', $workPermit->tempWardNo) }}">
                        </div>

                        <div class="col">
                            <label for="tempCity" class="form-label fs-6">City</label>
                            <input type="text" class="form-control" id="tempCity" name="tempCity" value="{{ old('tempCity', $workPermit->tempCity) }}">
                        </div>

                        <div class="col">
                            <label for="tempTole" class="form-label fs-6">Tole</label>
                            <input type="text" class="form-control" id="tempTole" name="tempTole" value="{{ old('tempTole', $workPermit->tempTole) }}">
                        </div>

                        <div class="col">
                            <label for="tempStreet" class="form-label fs-6">Street</label>
                            <input type="text" class="form-control" id="tempStreet" name="tempStreet" value="{{ old('tempStreet', $workPermit->tempStreet) }}">
                        </div>

                        <div class="col">
                            <label for="tempHouseNo" class="form-label fs-6">House No</label>
                            <input type="text" class="form-control" id="tempHouseNo" name="tempHouseNo" value="{{ old('tempHouseNo', $workPermit->tempHouseNo) }}">
                        </div>
                    </div>
                    <h4 class="d-inline py-2 accordion-header fs-5 text-semibold" style="color:#0064a7;">
                        Emergency Contact Details
                    </h4>

                    <div class="row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 gx-3">
                        <div class="col">
                            <label for="emergencyContactFullName" class="form-label fs-6">Full Name</label>
                            <input type="text" class="form-control" id="emergencyContactFullName" name="emergencyContactFullName" value="{{ old('emergencyContactFullName', $workPermit->emergencyContactFullName) }}">
                        </div>

                        <div class="col">
                            <label for="emergencyContactRelation" class="form-label fs-6">Relation</label>
                            <input type="text" class="form-control" id="emergencyContactRelation" name="emergencyContactRelation" value="{{ old('emergencyContactRelation', $workPermit->emergencyContactRelation) }}">
                        </div>

                        <div class="col">
                            <label for="emergencyContactCountry" class="form-label fs-6">Country</label>
                            <input type="text" class="form-control" id="emergencyContactCountry" name="emergencyContactCountry" value="{{ old('emergencyContactCountry', $workPermit->emergencyContactCountry) }}">
                        </div>

                        <div class="col">
                            <label for="emergencyContactStateProvince" class="form-label fs-6">State / Province</label>
                            <input type="text" class="form-control" id="emergencyContactStateProvince" name="emergencyContactStateProvince" value="{{ old('emergencyContactStateProvince', $workPermit->emergencyContactStateProvince) }}">
                        </div>

                        <div class="col">
                            <label for="emergencyContactDistrict" class="form-label fs-6">District</label>
                            <input type="text" class="form-control" id="emergencyContactDistrict" name="emergencyContactDistrict" value="{{ old('emergencyContactDistrict', $workPermit->emergencyContactDistrict) }}">
                        </div>

                        <div class="col">
                            <label for="emergencyContactCity" class="form-label fs-6">City</label>
                            <input type="text" class="form-control" id="emergencyContactCity" name="emergencyContactCity" value="{{ old('emergencyContactCity', $workPermit->emergencyContactCity) }}">
                        </div>
                        <div class="col">
                            <label for="emergencyContactEmail" class="form-label fs-6">Emergency Contact Email:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="emergencyContactEmail" name="emergencyContactEmail" value="{{ old('emergencyContactEmail', $workPermit->emergencyContactEmail) }}" required>
                        </div>

                        <div class="col">
                            <label for="emergencyContactPhone" class="form-label fs-6">Emergency Contact Phone:<span class="text-danger">*</label>
                            <input type="text" class="form-control" id="emergencyContactPhone" name="emergencyContactPhone" value="{{ old('emergencyContactPhone', $workPermit->emergencyContactPhone) }}" required>
                        </div>
                    </div>
                    <h4 class="d-inline py-2 accordion-header fs-5 text-semibold" style="color:#0064a7;">
                        Required Documents
                    </h4>

                    <div class="row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 gx-3">
                        <!-- Existing fields -->
                        @php
                        function displayFilePreview($filePath) {
                        if ($filePath) {
                        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                        if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                        return '<img src="' . asset($filePath) . '" alt="Preview" class="img-fluid my-2">';
                        } elseif ($ext === 'pdf') {
                        return '<a href="' . asset($filePath) . '" target="_blank" class="text-primary text-decoration-underline">View PDF</a>';
                        }
                        }
                        return '';
                        }
                        @endphp

                        <div class="col">
                            <label for="citizenshipFront" class="form-label fs-6">Citizenship Front:</label><br>
                            <input type="file" class="form-control" id="citizenshipFront" name="citizenshipFront" accept=".jpg,.jpeg,.png,.pdf" onchange="validateFileSize(this)">
                            {!! displayFilePreview($workPermit->citizenshipFront ?? null) !!}
                            <img src="#" alt="Preview" class="img img-fluid my-2 d-none">
                        </div>

                        <div class="col">
                            <label for="passportPhoto" class="form-label fs-6">Passport Photo: <span class="text-danger">*</span></label><br>
                            <input type="file" class="form-control" id="passportPhoto" name="passportPhoto" accept=".jpg,.jpeg,.png,.pdf" onchange="validateFileSize(this)">
                            {!! displayFilePreview($workPermit->passportPhoto ?? null) !!}
                            <img src="#" alt="Preview" class="img img-fluid my-2 d-none">
                        </div>

                        <div class="col">
                            <label for="bankAccountPhoto" class="form-label fs-6">Bank Account Photo:</label><br>
                            <input type="file" class="form-control" id="bankAccountPhoto" name="bankAccountPhoto" accept=".jpg,.jpeg,.png,.pdf" onchange="validateFileSize(this)">
                            {!! displayFilePreview($workPermit->bankAccountPhoto ?? null) !!}
                            <img src="#" alt="Preview" class="img img-fluid my-2 d-none">
                        </div>

                        <div class="col">
                            <label for="visaPhoto" class="form-label fs-6">Visa Photo: <span class="text-danger">*</span></label><br>
                            <input type="file" class="form-control" id="visaPhoto" name="visaPhoto" accept=".jpg,.jpeg,.png,.pdf" onchange="validateFileSize(this)">
                            {!! displayFilePreview($workPermit->visaPhoto ?? null) !!}
                            <img src="#" alt="Preview" class="img img-fluid my-2 d-none">
                        </div>

                        <div class="col">
                            <label for="chequePhoto" class="form-label fs-6">Cheque Photo:</label><br>
                            <input type="file" class="form-control" id="chequePhoto" name="chequePhoto" accept=".jpg,.jpeg,.png,.pdf" onchange="validateFileSize(this)">
                            {!! displayFilePreview($workPermit->chequePhoto ?? null) !!}
                            <img src="#" alt="Preview" class="img img-fluid my-2 d-none">
                        </div>

                        <div class="col">
                            <label for="agreementPhoto" class="form-label fs-6">Agreement Photo:</label><br>
                            <input type="file" class="form-control" id="agreementPhoto" name="agreementPhoto" accept=".jpg,.jpeg,.png,.pdf" onchange="validateFileSize(this)">
                            {!! displayFilePreview($workPermit->agreementPhoto ?? null) !!}
                            <img src="#" alt="Preview" class="img img-fluid my-2 d-none">
                        </div>

                        <div class="col">
                            <label for="arrivalStampPhoto" class="form-label fs-6">Arrival Stamp Photo:</label><br>
                            <input type="file" class="form-control" id="arrivalStampPhoto" name="arrivalStampPhoto" accept=".jpg,.jpeg,.png,.pdf" onchange="validateFileSize(this)">
                            {!! displayFilePreview($workPermit->arrivalStampPhoto ?? null) !!}
                            <img src="#" alt="Preview" class="img img-fluid my-2 d-none">
                        </div>

                        <div class="col">
                            <label for="embassyLetterPhoto" class="form-label fs-6">Embassy Letter Photo:</label><br>
                            <input type="file" class="form-control" id="embassyLetterPhoto" name="embassyLetterPhoto" accept=".jpg,.jpeg,.png,.pdf" onchange="validateFileSize(this)">
                            {!! displayFilePreview($workPermit->embassyLetterPhoto ?? null) !!}
                            <img src="#" alt="Preview" class="img img-fluid my-2 d-none">
                        </div>

                        <div class="col">
                            <label for="departureStampPhoto" class="form-label fs-6">Departure Stamp Photo:</label><br>
                            <input type="file" class="form-control" id="departureStampPhoto" name="departureStampPhoto" accept=".jpg,.jpeg,.png,.pdf" onchange="validateFileSize(this)">
                            {!! displayFilePreview($workPermit->departureStampPhoto ?? null) !!}
                            <img src="#" alt="Preview" class="img img-fluid my-2 d-none">
                        </div>

                        <div class="col">
                            <label for="oldLaborApprovalPhoto" class="form-label fs-6">Old Labor Approval Photo:</label><br>
                            <input type="file" class="form-control" id="oldLaborApprovalPhoto" name="oldLaborApprovalPhoto" accept=".jpg,.jpeg,.png,.pdf" onchange="validateFileSize(this)">
                            {!! displayFilePreview($workPermit->oldLaborApprovalPhoto ?? null) !!}
                            <img src="#" alt="Preview" class="img img-fluid my-2 d-none">
                        </div>

                        <div class="col">
                            <label for="otherDocumentsPhoto" class="form-label fs-6">Other Supporting Documents:</label><br>
                            <input type="file" class="form-control" id="otherDocumentsPhoto" name="otherDocumentsPhoto" accept=".jpg,.jpeg,.png,.pdf" onchange="validateFileSize(this)">
                            {!! displayFilePreview($workPermit->otherDocumentsPhoto ?? null) !!}
                            <img src="#" alt="Preview" class="img img-fluid my-2 d-none">
                        </div>

                    </div>

                    <div class="text-secondary col-12 mt-2">
                        <label class="form-label fs-6 mb-3 text-danger">* Files Should be in jpg, png or pdf format</label>
                    </div>

                    <div class="my-4 border border-1 border-secondary"></div>
                    <div class="d-flex flex-column mx-3 mb-5">
                        <div class="form-check">
                            <input class="form-check-input fs-5" type="checkbox" id="checkCorrect" required>
                            <label class="form-check-label fs-5" for="checkCorrect">
                                <span class="required"></span> I confirm that all information provided is accurate and complete.
                                I understand that providing false information may result in the rejection of my application
                                and possible legal consequences.
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input fs-5" type="checkbox" id="checkTerms" required>
                            <label class="form-check-label fs-5" for="checkTerms">
                                <span class="required"></span> I agree to the Terms and Conditions and Privacy Policy
                                of Kamsansar's passport renewal service.
                            </label>
                        </div>
                        <div class="required-fields-message">* - Required fields - Please fill all required fields before proceeding.</div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <button class="btn btn-light btn-lg py-2 px-4" type="button"
                            onclick="goToForm('mainForm','secondForm')">Back</button>
                        <div class="d-block">
                            <button class="btn btn-lg py-2 px-4 text-white btn-next mt-0"
                                style="background-color: #0064a7;" type="submit" id="form3NextBtn"
                                disabled>Update Application</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    // Function to handle form navigation
    function goToForm(currentFormId, nextFormId) {
        document.getElementById(currentFormId).classList.add('d-none');
        document.getElementById(nextFormId).classList.remove('d-none');

        document.querySelectorAll('.title').forEach(title => {
            title.classList.remove('activeTitle');
            title.classList.add('bg-light');
        });

        document.getElementById(nextFormId + 'Title').classList.add('activeTitle');
        document.getElementById(nextFormId + 'Title').classList.remove('bg-light');
    }

    // Form validation before proceeding
    function validateAppointmentForm() {
        const requiredFields = document.querySelectorAll('#secondForm [required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value) {
                field.classList.add('error');
                isValid = false;
            } else {
                field.classList.remove('error');
            }
        });

        return isValid;
    }

    // Enable submit button when checkboxes are checked
    document.addEventListener('DOMContentLoaded', function() {
        const checkCorrect = document.getElementById('checkCorrect');
        const checkTerms = document.getElementById('checkTerms');
        const submitBtn = document.getElementById('form3NextBtn');

        function checkSubmitConditions() {
            submitBtn.disabled = !(checkCorrect.checked && checkTerms.checked);
        }

        checkCorrect.addEventListener('change', checkSubmitConditions);
        checkTerms.addEventListener('change', checkSubmitConditions);
    });

    // Image preview handler
    function validateFileSize(input) {
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

    document.addEventListener('DOMContentLoaded', function() {
        const provinceSelect = document.getElementById('appProvince');
        const districtSelect = document.getElementById('appDistrict');
        const locationSelect = document.getElementById('appLocation');

        // Store all options data
        const cascadingData = {
            districts: @json($districts),
            locations: @json($locations),
        };

        // Store current values
        const currentValues = {
            province: provinceSelect.value,
            district: districtSelect.value,
            location: locationSelect.value
        };

        // Function to populate districts based on province
        function populateDistricts() {
            const provinceName = provinceSelect.value;
            const currentDistrict = currentValues.district;

            // Clear existing options except the first one
            districtSelect.innerHTML = '<option value="">Select District</option>';

            if (!provinceName) {
                locationSelect.innerHTML = '<option value="">Select Location</option>';
                return;
            }

            // Filter and add districts
            cascadingData.districts
                .filter(d => d.provienceName === provinceName)
                .forEach(district => {
                    const option = new Option(
                        district.districtName,
                        district.districtName,
                        district.districtName === currentDistrict,
                        district.districtName === currentDistrict
                    );
                    districtSelect.add(option);
                });

            // If province changed, reset location
            if (provinceName !== currentValues.province) {
                locationSelect.innerHTML = '<option value="">Select Location</option>';
            } else if (currentDistrict) {
                // If editing and province didn't change, populate locations
                populateLocations();
            }
        }

        // Function to populate locations based on district
        function populateLocations() {
            const districtName = districtSelect.value;
            const currentLocation = currentValues.location;

            // Clear existing options except the first one
            locationSelect.innerHTML = '<option value="">Select Location</option>';

            if (!districtName) return;

            // Filter and add locations
            cascadingData.locations
                .filter(l => l.districtName === districtName)
                .forEach(location => {
                    const option = new Option(
                        location.locationName,
                        location.locationName,
                        location.locationName === currentLocation,
                        location.locationName === currentLocation
                    );
                    locationSelect.add(option);
                });
        }

        // Event listeners
        provinceSelect?.addEventListener('change', function() {
            populateDistricts();
        });

        districtSelect?.addEventListener('change', function() {
            populateLocations();
        });

        // Initialize on load
        if (currentValues.province) {
            populateDistricts();
        }
    });

    $(document).ready(function() {
        $('#sameAsPermanent').on('change', function() {
            if (this.checked) {
                // Copy values from permanent to temporary address
                $('#tempCountry').val($('#contactCountry').val());
                $('#tempProvince').val($('#province').val());
                $('#tempDistrict').val($('#district').val());
                $('#tempCity').val($('#city').val());
                $('#tempMunicipality').val($('#municipality').val());
                $('#tempWardNo').val($('#wardNo').val());
                $('#tempTole').val($('#tole').val());
                $('#tempStreet').val($('#street').val());
                $('#tempHouseNo').val($('#houseNo').val());

                // Disable temporary fields
                $('.row.py-3:last-child input').prop('readonly', true);
            } else {
                // Enable temporary fields
                $('.row.py-3:last-child input').prop('readonly', false);
            }
        });

        // Initialize if checkbox is already checked (for edit mode)
        if ($('#sameAsPermanent').is(':checked')) {
            $('#sameAsPermanent').trigger('change');
        }
    });

    document.getElementById('form3NextBtn').addEventListener('click', function(e) {

        let hasError = false;

        // Check all required fields
        const fields = document.getElementById('mainForm').querySelectorAll('[required]');

        fields.forEach(field => {
            //field.style.transition = 'border 0.3s ease';

            if (!field.value.trim()) {
                // field.classList.add('is-invalid')
                field.classList.add('error');
                field.style.transition = 'border 0.3s ease';
                field.style.border = '1px solid red';
                window.scrollTo({
                    top: 100,
                    behavior: 'smooth'
                })
                hasError = true;
            } else {
                field.style.border = '';
            }
        });

        if (hasError) {
            e.preventDefault();
        }
    });

    function handleImagePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                let imageContainer = input.parentElement.querySelector('img');
                imageContainer.classList.remove('d-none');
                imageContainer.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function validateFileSize(input) {
        const file = input.files[0];
        const maxSize = 2 * 1024 * 1024;
        const parent = input.parentNode;

        const existingAlert = parent.querySelector('.file-size-error');
        if (existingAlert) {
            existingAlert.remove();
        }

        if (file && file.size > maxSize) {
            input.value = '';
            input.parentElement.querySelector('img').classList.add('d-none');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'text-danger mt-2 file-size-error';
            errorDiv.textContent = 'File size must be less than 2 MB.';

            parent.appendChild(errorDiv);
        } else {
            handleImagePreview(input)
        }
    }
</script>
@endpush