@extends('frontend.layouts.main')

@section('title', 'Edit Passport Renewal')

@section('content')


    <!-- Form 3 -->
    <div id="multiStepForm3" class="container multi-step-form mt-5 pt-3">
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
                <h2 style="color:#0064a7;">Edit Passport Renewal Form</h2>
                <p class="fs-3 mb-2">Edit the form below to update your passport renewal information</p>
            </div>


        </div>

        <style>
            .activeTitle {
                background-color: #0064a7 !important;
                color: #fff;
            }
        </style>

        <div class="text-center my-4">
            <div class="d-md-inline-flex justify-content-center align-items-center gap-3 bg-light fs-6">
                <p class="title p-2 rounded-2 m-0 activeTitle" id="firstFormTitle">Select Service
                    &
                    Read
                    Instructions
                </p>
                <p class="title p-2 bg-light rounded-2 m-0" id="secondFormTitle">Book Appointment</p>
                <p class="title p-2 bg-light rounded-2 m-0" id="mainFormTitle">Fill Application</p>
                <p class="title p-2 bg-light rounded-2 m-0" id="fourthFormTitle">Payment</p>
            </div>
        </div>


        <div class="my-3 mb-5 border border-1 border-dark-subtle rounded-4 p-3 p-md-5">

            <form id="passportRenewalForm" action="{{ route('passport.renew.partial') }}" enctype="multipart/form-data"
                method="POST" class="accordion">

                @csrf

                <style>
                    .nav-link {
                        color: #0064a7;
                    }

                    .accordion-header {
                        position: relative;
                    }

                    .accordion-header::after {
                        content: '';
                        position: absolute;
                        height: 1.5px;
                        width: 100%;
                        bottom: 1px;
                        left: 0;
                        background-color: #0064a7;
                    }
                </style>

                <div id="firstForm">
                    <div>
                        <h4 style="color:#0064a7;">Select Service Type</h4>
                        <p class="fs-6 my-3">Please select one of following passport type:</p>
                    </div>
                    <div class="mb-3">
                        <div class="nav nav-pills mb-3 row" id="pills-tab" role="tablist">
                            <input type="hidden" name="service_type" id="service_type"
                                value="{{ $passportRenewal->service_type }}" required>
                            <div class="col-auto nav-item" role="presentation">
                                <button
                                    class="nav-link border border-1 border-dark-subtle fs-6 {{ $passportRenewal->service_type == 'apply' ? 'active' : '' }}"
                                    data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                                    aria-controls="pills-home" aria-selected="true"
                                    onclick="document.getElementById('service_type').value = 'apply'">First
                                    Issuance</button>
                            </div>
                            <div class="col-auto nav-item" role="presentation">
                                <button
                                    class="nav-link border border-1 border-dark-subtle fs-6 {{ $passportRenewal->service_type == 'renewal' ? 'active' : '' }}"
                                    data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                                    aria-controls="pills-home" aria-selected="true"
                                    onclick="document.getElementById('service_type').value = 'renewal'">Renewal
                                    Issuance</button>
                            </div>

                            <div class="col-auto nav-item" role="presentation">
                                <button
                                    class="nav-link border border-1 border-dark-subtle fs-6 {{ $passportRenewal->service_type == 'replacement' ? 'active' : '' }}"
                                    data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                                    aria-controls="pills-home" aria-selected="true"
                                    onclick="document.getElementById('service_type').value = 'replacement'">Replacement</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <h4 style="color:#0064a7;">Read Instructions</h4>
                        <p class="fs-6 my-3">Read before pre-enrollment</p>
                        <p class="fs-6 text-black-50">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Inventore
                            libero
                            repellendus quo.
                            Consectetur vel placeat sit temporibus ab ex explicabo, dicta officia, pariatur
                            aspernatur,
                            eos expedita. Enim officiis eaque vel esse ab eos, debitis nesciunt accusantium in ea
                            voluptate ipsa. Laboriosam vero repudiandae magnam eum expedita? Expedita ab corrupti
                            minus
                            voluptates aspernatur laboriosam libero iure illum? Totam debitis dicta voluptas
                            voluptatem
                            esse iste beatae incidunt officia consequatur. Natus omnis excepturi praesentium,
                            aliquid
                            officia, a porro aspernatur officiis ullam quasi sapiente debitis quidem eligendi sequi
                            distinctio esse laboriosam illo dignissimos nostrum minima dolorum eos. Accusamus est,
                            sequi
                            sapiente at sunt ut. Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro
                            excepturi iusto, placeat deleniti, molestias repudiandae sed officiis dolorum optio illo
                            rem
                            iure voluptate nisi nostrum libero consequatur. A molestias blanditiis dignissimos
                            voluptates neque provident possimus non alias consequatur. Facilis vitae soluta, debitis
                            ex
                            incidunt dicta eos officiis blanditiis rerum non iste quod dolores atque cupiditate. Nam
                            incidunt porro saepe debitis quibusdam laboriosam vero maiores enim labore eveniet
                            aliquid
                            inventore officiis libero ullam sit sapiente illum adipisci dicta, qui blanditiis?
                            Voluptate
                            minima vel qui quisquam, cupiditate consequatur ratione voluptatem minus numquam quos!
                            Rem
                            atque, quidem ipsam corporis deserunt veniam possimus facilis.</p>
                    </div>
                    <div class="mt-5">
                        <h5 style="color:#0064a7;">Please choose from the following available Passport Types</h5>
                        <div class="d-flex flex-column flex-md-row m-3">
                            <div class="col form-check">
                                <input class="form-check-input fs-6" type="radio" name="passport_pages" id="option1"
                                    value="34_pages" {{ $passportRenewal->passport_pages == '34_pages' ? 'checked' : '' }}>
                                <label class="form-check-label fs-6" for="option1">
                                    Ordinary 34 Pages
                                </label>
                            </div>
                            <div class="col form-check">
                                <input class="form-check-input fs-6" type="radio" name="passport_pages" id="option2"
                                    value="66_pages" {{ $passportRenewal->passport_pages == '66_pages' ? 'checked' : '' }}>
                                <label class="form-check-label fs-6" for="option2">
                                    Ordinary 66 Pages
                                </label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-5">
                            <a href="{{ route('jobseeker.forms') }}" class="btn btn-light btn-lg py-2 px-4"
                                type="button">Cancel</a>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="36"
                                    viewBox="0 0 12 24">
                                    <path fill="#000" fill-rule="evenodd"
                                        d="m3.343 12l7.071 7.071L9 20.485l-7.778-7.778a1 1 0 0 1 0-1.414L9 3.515l1.414 1.414z" />
                                </svg>
                            </button>
                            Book Appointment
                        </h4>

                    </div>
                    <div class="mb-2">

                        <div class="row row-cols-1 row-cols-md-2">
                            <div class="col">
                                <label for="app_country" class="required">Appointment Country:</label>
                                <select class="form-select my-2" aria-label="Default select example" id="app_country"
                                    required name="country" data-value="{{ $passportRenewal->country }}">
                                    <option value="">Select Country</option>
                                    <option value="nepal">Nepal</option>
                                    <option value="1">Other</option>

                                </select>
                            </div>
                            <div class="col">
                                <label for="app_province" class="required">Appointment Province:</label>
                                <select class="form-select my-2" aria-label="Default select example" id="app_province"
                                    name="state" required data-value="{{ $passportRenewal->state }}">
                                    <option value="">Select Provience</option>
                                    <option>Gandaki</option>
                                    <option value="1">Other</option>

                                </select>
                            </div>

                            <div class="col">
                                <label for="app_district" class="required">Select District:</label>
                                <select class="form-select my-2" aria-label="Default select example" name="district"
                                    id="app_district" required data-value="{{ $passportRenewal->district }}">
                                    <option value=""></option>
                                    <option>Kaski</option>
                                    <option value="1">Other</option>

                                </select>
                            </div>
                            <div class="col">
                                <label for="app_province" class="required">Appointment Location:</label>
                                <select class="form-select my-2" aria-label="Default select example" id="app_location"
                                    name="location" required data-value="{{ $passportRenewal->location }}">
                                    <option value="">Department of Passports</option>
                                    <option value="1">Other</option>

                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <h4 style="color:#0064a7;" class="my-4">Please choose the nearest enrollment centre
                                to
                                your location
                            </h4>
                        </div>
                        <div class="row row-cols-1 row-cols-md-2 row-gap-5">
                            <input type="hidden" id="appointment_date" name="appointment_date" value="{{ $passportRenewal->appointment_date }}">
                            <div class="col">
                                <h4>Select a Date</h4>
                                <div class="content border border-1 border-secondary-subtle rounded-4 h-100 pt-2 mb-2">
                                    <div class="container text-left">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12 text-center">
                                                <div action="#" class="row align-items-center">
                                                    <div class="col">
                                                        <div id="inline_cal"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <h4>Select an hour</h4>
                                <div class="border border-1 border-secondary-subtle rounded-4 p-4 h-100">

                                    {{-- <input type="time" class="form-control" id="appointment_time" value="appointment_time"> --}}
                                    <div class="row row-cols-auto g-4" id="appointment_time"
                                        data-value="{{ $passportRenewal->appointment_time }}">
                                        <div class="col">
                                            <input type="radio" class="btn-check" name="appointment_time"
                                                id="btn-check-1" autocomplete="off" value="10:30">
                                            <label class="btn btn-outline-secondary fs-6 pt-2 w-auto h-auto"
                                                for="btn-check-1">10:30</label>
                                        </div>
                                        <div class="col">
                                            <input type="radio" class="btn-check" name="appointment_time"
                                                id="btn-check-2" autocomplete="off" value="11:30">
                                            <label class="btn btn-outline-secondary fs-6 pt-2 w-auto h-auto"
                                                for="btn-check-2">11:30</label>
                                        </div>
                                        <div class="col">
                                            <input type="radio" class="btn-check" name="appointment_time"
                                                id="btn-check-3" autocomplete="off" value="12:30">
                                            <label class="btn btn-outline-secondary fs-6 pt-2 w-auto h-auto"
                                                for="btn-check-3">12:30</label>
                                        </div>
                                    </div>
                                </div>

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
                        </button> Required Information
                    </h2>

                    <hr>
                    <div class="accordion-item">
                        <h4 class="d-inline py-2 accordion-header">
                            <button class="accordion-button fs-6 bg-body-tertiary" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">
                                Personal
                                Information</button>
                        </h4>


                        <div id="collapseOne" class="accordion-collapse collapse show"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                <div class="col">
                                    <label for="first_name" class="form-label fs-6 required">First
                                        Name:</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        required maxlength="255" placeholder="John">
                                </div>
                                <div class="col">
                                    <label for="middle_name" class="form-label fs-6">Middle
                                        Name:</label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name"
                                        maxlength="255" placeholder="Bahadur">
                                </div>
                                <div class="col">
                                    <label for="last_name" class="form-label fs-6 required">Last
                                        Name:</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required
                                        maxlength="255" placeholder="Doe">
                                </div>

                                <div class="flatpickr-container flatpickr col d-flex flex-column">
                                    <label for="date_of_birth_ad" class="fs-6 mb-1 required">Date of
                                        Birth
                                        (AD):</label>
                                    <div
                                        class=" d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                        <input type="text" placeholder="1990-10-01" id="date_of_birth_ad"
                                            name="date_of_birth_ad" class="date-picker fs-6" required>
                                        <label for="date_of_birth_ad" class="input-button" title="toggle" data-toggle>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="#000"
                                                    d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                            </svg>
                                        </label>
                                    </div>
                                </div>
                                <div class="flatpickr col d-flex flex-column">
                                    <label for="date_of_bs" class="fs-6 mb-1 required">Date of Birth
                                        (BS):</label>
                                    <div
                                        class=" d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                        <input type="text" placeholder="1990-10-01" id="date_of_bs" name="date_of_bs"
                                            class="date-picker fs-6" required>
                                        <label for="date_of_bs" class="input-button" title="toggle" data-toggle>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="#000"
                                                    d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                            </svg>
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="birthplace" class="form-label fs-6 required">Birthplace
                                        (District/
                                        Country if
                                        abroad):</label>
                                    <input type="text" class="form-control" id="birthplace" name="birthplace"
                                        required maxlength="255" placeholder="Kaski">
                                </div>


                                <div class="col">
                                    <label for="gender" class="form-label fs-6 required">Gender:</label>
                                    <select class="form-select fs-6" id="gender" name="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="age" class="form-label fs-6">Age:</label>
                                    <input type="number" class="form-control" id="age" name="age" required
                                        readonly>
                                </div>
                                <div class="col">
                                    <label for="nationality" class="form-label fs-6 required">Nationality:</label>
                                    <input type="text" class="form-control" id="nationality" name="nationality"
                                        required maxlength="255" placeholder="Nepali">
                                </div>

                                <div class="col">
                                    <label for="religion" class="form-label fs-6">Religion:</label>
                                    <input type="text" class="form-control" id="religion" name="religion"
                                        maxlength="255" placeholder="Hindu">
                                </div>
                                <div class="col">
                                    <label for="birth_country" class="form-label fs-6 required">Birth
                                        Country:</label>
                                    <input type="text" class="form-control" id="birth_country" name="birth_country"
                                        required maxlength="255" placeholder="Nepal">
                                </div>
                                <div class="col">
                                    <label for="father_name" class="form-label fs-6 required">Father's
                                        Name:</label>
                                    <input type="text" class="form-control" id="father_name" name="father_name"
                                        required maxlength="255" placeholder="Elon Doe">
                                </div>

                                <div class="col">
                                    <label for="mother_name" class="form-label fs-6 required">Mother's
                                        Name:</label>
                                    <input type="text" class="form-control" id="mother_name" name="mother_name"
                                        required maxlength="255" placeholder="Joana Doe">
                                </div>
                                <div class="col">
                                    <label for="marital_status" class="form-label fs-6 required">Marital
                                        Status:</label>
                                    <select class="form-select fs-6" id="marital_status" name="marital_status" required>
                                        <option value="">Select Status</option>
                                        <option value="Unmarried">Unmarried</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Widowed">Widowed</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="spouse_name" class="form-label fs-6">Spouse's
                                        Name:</label>
                                    <input type="text" class="form-control" id="spouse_name" name="spouse_name"
                                        maxlength="255" placeholder="Jane Doe">
                                </div>
                                <div class="col">
                                    <label for="no_of_children" class="form-label fs-6">No. of
                                        Children:</label>
                                    <input type="number" class="form-control" id="no_of_children" name="no_of_children"
                                        placeholder="2">
                                </div>
                                <div class="col">
                                    <label for="spouse_age" class="form-label fs-6">Spouse's
                                        Age:</label>
                                    <input type="text" class="form-control" id="spouse_age" name="spouse_age"
                                        maxlength="255" placeholder="20">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h4 class="accordion-header d-inline py-2">
                            <button class="accordion-button fs-6 bg-body-tertiary collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo">
                                Citizenship
                                Information</button>
                        </h4>

                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">

                            <div class=" accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                <div class="col">
                                    <label for="national_identify_no" class="form-label fs-6 required">National
                                        Identify No.
                                        (NIN-Only
                                        Digits):</label>
                                    <input type="text" class="form-control" id="national_identify_no"
                                        name="national_identify_no" required maxlength="255" placeholder="XXXXXXXXX">
                                </div>
                                <div class="col">
                                    <label for="citizenship_no" class="form-label fs-6 required">Citizenship
                                        or
                                        Permit
                                        Number:</label>
                                    <input type="text" class="form-control" id="citizenship_no" name="citizenship_no"
                                        required maxlength="255" placeholder="XXXXXXXX">
                                </div>
                                <div class="flatpickr col d-flex flex-column">
                                    <label for="citizenship_issue_date" class="fs-6 mb-1 required">Citizenship Date
                                        of
                                        Issue(AD/BS):</label>
                                    <div
                                        class=" d-flex border border-1 border-secondary-subtle justify-content-between align-items-center rounded-2 p-2 my-1">
                                        <input type="text" placeholder="1990-10-01" id="citizenship_issue_date"
                                            name="citizenship_issue_date" class="date-picker fs-6" required>
                                        <label for="citizenship_issue_date" class="input-button" title="toggle"
                                            data-toggle>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="#000"
                                                    d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                            </svg>
                                        </label>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="citizenship_issue_place" class="form-label fs-6 required">Citizenship
                                        Place of
                                        Issue(District):</label>
                                    <input type="text" class="form-control" id="citizenship_issue_place"
                                        name="citizenship_issue_place" required maxlength="255" placeholder="Kaski">
                                </div>
                                <div class="col">
                                    <label for="citizenship_issue_place_abroad" class="form-label fs-6">Citizenship Place
                                        of
                                        Issue(Abroad):</label>
                                    <input type="text" class="form-control" id="citizenship_issue_place_abroad"
                                        name="citizenship_issue_place_abroad" maxlength="255" placeholder="Texas">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h4 class="accordion-header d-inline py-2">
                            <button class="accordion-button fs-6 bg-body-tertiary collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                aria-controls="collapseThree">
                                Current
                                Passport
                                Details
                        </h4>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                <div class="col">
                                    <label for="passport_no" class="form-label fs-6 required">Passport
                                        Number:</label>
                                    <input type="text" class="form-control" id="passport_no" name="passport_no"
                                        required maxlength="255" placeholder="XXXXXXXXX">
                                </div>
                                <div class="col">
                                    <label for="passport_type" class="form-label fs-6 required">Pasport
                                        Type:</label>
                                    <select class="form-select fs-6" id="passport_type" name="passport_type" required>
                                        <option value="">Select Type</option>
                                        <option value="Type 1">Type 1</option>
                                        <option value="Type 2">Type 2</option>
                                        <option value="Type 3">Type 3</option>
                                    </select>
                                </div>
                                <div class="flatpickr col d-flex flex-column">
                                    <label for="passport_issue_date" class="fs-6 mb-1 required">Issue
                                        Date:</label>
                                    <div
                                        class=" d-flex border border-1 border-secondary-subtle justify-content-between align-items-center rounded-2 p-2 my-1">
                                        <input type="text" placeholder="1990-10-01" id="passport_issue_date"
                                            name="passport_issue_date" class="date-picker fs-6" required>
                                        <label for="passport_issue_date" class="input-button" title="toggle" data-toggle>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="#000"
                                                    d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                            </svg>
                                        </label>
                                    </div>
                                </div>

                                <div class="flatpickr col d-flex flex-column">
                                    <label for="passport_expiry_date" class="fs-6 mb-1 required">Expiry
                                        Date:</label>
                                    <div
                                        class=" d-flex border border-1 border-secondary-subtle justify-content-between align-items-center rounded-2 p-2 my-1">
                                        <input type="text" placeholder="1990-10-01" id="passport_expiry_date"
                                            name="passport_expiry_date" class="date-picker fs-6" required>
                                        <label for="passport_expiry_date" class="input-button" title="toggle"
                                            data-toggle>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="#000"
                                                    d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                            </svg>
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="passport_issue_place" class="form-label fs-6 required">Place
                                        of
                                        Issue:</label>
                                    <input type="text" class="form-control" id="passport_issue_place"
                                        name="passport_issue_place" required maxlength="255" placeholder="Nepal">
                                </div>
                                <div class="col">
                                    <label for="issuing_authority" class="form-label fs-6 required">Issuing
                                        Authority:</label>
                                    <input type="text" class="form-control" id="issuing_authority"
                                        name="issuing_authority" required maxlength="255" placeholder="DOP">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h4 class="accordion-header">
                            <button class="accordion-button fs-6 bg-body-tertiary collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                                aria-controls="collapseFour">
                                Contact Information
                            </button>
                        </h4>
                        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                <div class="col">
                                    <label for="email" class="form-label fs-6 required">Email
                                        Address:</label>
                                    <input type="email" class="form-control" id="email" name="email" required
                                        maxlength="255" placeholder="john.doe@gmail.com">
                                </div>

                                <div class="col">
                                    <label for="country" class="form-label fs-6 required">Country:</label>
                                    <select class="form-select fs-6" id="country" name="country" required>
                                        <option value="">Select Country</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="USA">USA</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="state" class="form-label fs-6 required">State/Province:</label>
                                    <select class="form-select fs-6" id="state" name="state" required>
                                        <option value="">Select State/Province</option>
                                        <option value="Gandaki">Gandaki</option>
                                        <option value="Karnali">Karnali</option>
                                        <option value="Bagmati">Bagmati</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="district" class="form-label fs-6 required">District:</label>
                                    <select class="form-select fs-6" id="district" name="district" required>
                                        <option value="">Select District</option>
                                        <option value="Kaski">Kaski</option>
                                        <option value="Etc">Etc</option>
                                        <option value="Bagmati">Bagmati</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="city" class="form-label fs-6 required">City:</label>
                                    <input type="text" class="form-control" id="city" name="city" required
                                        maxlength="255" placeholder="Pokhara">
                                </div>

                                <div class="col">
                                    <label for="phone" class="form-label fs-6 required">Phone
                                        Number:</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required
                                        maxlength="255" placeholder="98XXXXXXXX">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h4 class="accordion-header">
                            <button class="accordion-button fs-6 bg-body-tertiary collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false"
                                aria-controls="collapseFive">
                                Emergency Contact
                            </button>
                        </h4>
                        <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                <div class="col">
                                    <label for="emergency_contact_name" class="form-label fs-6 required">Full
                                        Name:</label>
                                    <input type="text" class="form-control" id="emergency_contact_name"
                                        name="emergency_contact_name" required maxlength="255" placeholder="Jane Doe">
                                </div>

                                <div class="col">
                                    <label for="emergency_contact_relation"
                                        class="form-label fs-6 required">Relationship:</label>
                                    <input type="text" class="form-control" id="emergency_contact_relation"
                                        name="emergency_contact_relation" required maxlength="255" placeholder="Cousin">
                                </div>

                                <div class="col">
                                    <label for="emergency_contact_country"
                                        class="form-label fs-6 required">Country:</label>
                                    <select class="form-select fs-6" id="emergency_contact_country"
                                        name="emergency_contact_country" required>
                                        <option value="">Select Country</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Other">Other</option>
                                        <option value="USA">USA</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="emergency_contact_state"
                                        class="form-label fs-6 required">State/Province:</label>
                                    <select class="form-select fs-6" id="emergency_contact_state"
                                        name="emergency_contact_state" required>
                                        <option value="">Select State/Province</option>
                                        <option value="Gandaki">Gandaki</option>
                                        <option value="Karnali">Karnali</option>
                                        <option value="Bagmati">Bagmati</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="emergency_contact_district"
                                        class="form-label fs-6 required">District:</label>
                                    <select class="form-select fs-6" id="emergency_contact_district"
                                        name="emergency_contact_district" required>
                                        <option value="">Select District</option>
                                        <option value="Kaski">Kaski</option>
                                        <option value="Etc">Etc</option>
                                        <option value="Bagmati">Bagmati</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="emergency_contact_city" class="form-label fs-6 required">City:</label>
                                    <input type="text" class="form-control" id="emergency_contact_city"
                                        name="emergency_contact_city" required maxlength="255" placeholder="Pokhara">
                                </div>

                                <div class="col">
                                    <label for="emergency_contact_email" class="form-label fs-6 required">Email:</label>
                                    <input type="email" class="form-control" id="emergency_contact_email"
                                        name="emergency_contact_email" required maxlength="255"
                                        placeholder="contact@gmail.com">
                                </div>

                                <div class="col">
                                    <label for="emergency_contact_phone" class="form-label fs-6 required">Phone
                                        Number:</label>
                                    <input type="tel" class="form-control" id="emergency_contact_phone"
                                        name="emergency_contact_phone" required maxlength="255" placeholder="98XXXXXXXX">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h4 class="accordion-header">
                            <button class="accordion-button fs-6 bg-body-tertiary collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false"
                                aria-controls="collapseSix">
                                Required Documents
                            </button>
                        </h4>
                        <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row py-3 row-cols-1 row-cols-lg-2 row-gap-4 gx-5">
                                    <div class="col">
                                        <label for="citizenship_front" class="form-label fs-6 required">Citizenship
                                            Front:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in jpg, png
                                            or pdf
                                            format)</label>
                                        <input type="file" class="form-control" id="citizenship_front"
                                            name="citizenship_front" required accept=".jpg,.jpeg,.png,.pdf">
                                    </div>

                                    <div class="col">
                                        <label for="citizenship_back" class="form-label fs-6 required">Citizenship
                                            Back:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in jpg, png
                                            or pdf
                                            format)</label>
                                        <input type="file" class="form-control" id="citizenship_back"
                                            name="citizenship_back" required accept=".jpg,.jpeg,.png,.pdf">
                                    </div>

                                    <div class="col">
                                        <label for="academic_certificate" class="form-label fs-6">Academic
                                            Certificate:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in jpg, png
                                            or pdf
                                            format)</label>
                                        <input type="file" class="form-control" id="academic_certificate"
                                            name="academic_certificate" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>

                                    <div class="col">
                                        <label for="marriage_registration" class="form-label fs-6">Marriage
                                            Registration:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in jpg, png
                                            or pdf
                                            format)</label>
                                        <input type="file" class="form-control" id="marriage_registration"
                                            name="marriage_registration" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>

                                    <div class="col">
                                        <label for="divorce_certificate" class="form-label fs-6">Divorce
                                            Certificate:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in jpg, png
                                            or pdf
                                            format)</label>
                                        <input type="file" class="form-control" id="divorce_certificate"
                                            name="divorce_certificate" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>

                                    <div class="col">
                                        <label for="national_eid" class="form-label fs-6">National
                                            eID:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in jpg, png
                                            or pdf
                                            format)</label>
                                        <input type="file" class="form-control" id="national_eid" name="national_eid"
                                            accept=".jpg,.jpeg,.png,.pdf">
                                    </div>

                                    <div class="col">
                                        <label for="other_document" class="form-label fs-6">Any
                                            Other
                                            Supporting
                                            Document:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in jpg, png
                                            or pdf
                                            format)</label>
                                        <input type="file" class="form-control" id="other_document"
                                            name="other_document" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>

                                    <div class="col">
                                        <label for="previous_passport" class="form-label fs-6">Previous
                                            Passport:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in jpg, png
                                            or pdf
                                            format)</label>
                                        <input type="file" class="form-control" id="previous_passport"
                                            name="previous_passport" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="text-secondary col-12 mt-2"><label class="form-label fs-6 mb-3 text-danger">*
                            Files Should be in jpg, png
                            or pdf format</label></div>

                    <div class="my-4 border border-1 border-secondary"></div>
                    <div class="d-flex flex-column mx-3 mb-5">

                        <div class="form-check">
                            <input class="form-check-input fs-5" type="checkbox" value="" id="checkCorrect"
                                required>
                            <label class="form-check-label fs-5" for="checkCorrect">
                                <span class="required"></span> I confirm that all information
                                provided is accurate and complete. I
                                understand
                                that providing false
                                information may result in the rejection of my application and
                                possible
                                legal
                                consequences.
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input fs-5" type="checkbox" value="" id="checkTerms"
                                required>
                            <label class="form-check-label fs-5" for="checkTerms">
                                <span class="required"></span> I agree to the Terms and Conditions
                                and Privacy Policy of
                                Kamsansar's
                                passport
                                renewal service.
                            </label>
                        </div>
                        <div class="required-fields-message">* - Required fields - Please fill all
                            required fields before proceeding.</div>
                    </div>


                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <button class="btn btn-light btn-lg py-2 px-4" type="button"
                            onclick="goToForm('mainForm','secondForm')">Back</button>
                        <div class="d-block">
                            <button class="btn btn-lg py-2 px-4 text-white btn-next mt-0"
                                style="background-color: #0064a7;" type="submit" id="form3NextBtn"
                                disabled>Update</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <style>
        .form-check-input:checked {
            background-color: #0064A7;
            border-color: #0064A7;
        }


        .error {
            border: 1px solid rgb(255, 120, 120);
        }
    </style>


@endsection


@push('scripts')
    <script src="https://preview.colorlib.com/theme/bootstrap/calendar-16/js/rome.js"></script>

    <script src="https://preview.colorlib.com/theme/bootstrap/calendar-16/js/main.js"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
        integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
        data-cf-beacon='{"rayId":"91b7e635cdf99888","serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2025.1.0","token":"cd0b4b3a733644fc843ef0b185f98241"}'
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <script>
        function getBaseUrl() {
            return window.location.protocol + "//" + window.location.host;
        }
        document.addEventListener('DOMContentLoaded', function() {
            const countrySelect = document.getElementById('app_country');
            const provinceSelect = document.getElementById('app_province');
            const districtSelect = document.getElementById('app_district');
            const locationSelect = document.getElementById('app_location');
            const dateInput = document.getElementById('appointment_date');


            // Populate dropdown helper
            function populateSelect(selectElement, items, defaultText, labelKey = 'name') {
                selectElement.innerHTML = `<option value="">${defaultText}</option>`;
                let selectValue = selectElement.getAttribute('data-value');
                items.forEach(item => {
                    const option = document.createElement('option');
                    option.setAttribute('data-id', item.id);

                    if (item[labelKey] == selectValue) {
                        option.selected = true;
                    }
                    option.value = item[labelKey];
                    option.textContent = item[labelKey];
                    selectElement.appendChild(option);
                });
            }

            function getRelatedProviences(countryId) {
                fetch(getBaseUrl() + `/passport/proviences/${countryId}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.status && data.proviences) {
                            populateSelect(provinceSelect, data.proviences, 'Select Province',
                                'provienceName');
                            populateSelect(districtSelect, [], 'Select District');
                            populateSelect(locationSelect, [], 'Select Location');
                        }

                    })
                    .then(() => {
                        getRelatedDistricts(provinceSelect[provinceSelect.selectedIndex].getAttribute('data-id'))
                    })
            }

            // Fetch countries on page load
            fetch(getBaseUrl() + '/passport/countries')
                .then(res => res.json())
                .then(data => {
                    if (data.status && data.countries) {
                        populateSelect(countrySelect, data.countries, 'Select Country', 'countryName');
                        
                    }
                })
                .then(() => {
                    getRelatedProviences(countrySelect[countrySelect.selectedIndex].getAttribute('data-id'))
                })



            // Fetch provinces on country change
            countrySelect.addEventListener('change', function() {
                console.log('country changed')
                const countryId = this.options[this.selectedIndex].getAttribute('data-id');
                if (!countryId) return;
                getRelatedProviences(countryId);
                
            });

            function getRelatedDistricts(provinceId){
                fetch(getBaseUrl() + `/passport/districts/${provinceId}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.status && data.districts) {
                            populateSelect(districtSelect, data.districts, 'Select District',
                                'districtName');
                            populateSelect(locationSelect, [], 'Select Location');
                        }

                    })
                    .then(() => {
                        getRelatedLocations(districtSelect[districtSelect.selectedIndex].getAttribute('data-id'))
                    })
            }

            // Fetch districts on province change
            provinceSelect.addEventListener('change', function() {
                const provinceId = this.options[this.selectedIndex].getAttribute('data-id');

                if (!provinceId) return;
                getRelatedDistricts(provinceId);
                
            });

            function getRelatedLocations(districtId){
                fetch(getBaseUrl() + `/passport/locations/${districtId}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.status && data.locations) {
                            populateSelect(locationSelect, data.locations, 'Select Location',
                                'locationName');
                        }
                    })
                    .then(() => {
                        console.log(dateInput.value)
                        console.log(locationSelect[locationSelect.selectedIndex].getAttribute('data-id'))
                        getTimes(dateInput.value, locationSelect[locationSelect.selectedIndex].getAttribute('data-id'))
                    })
            }

            // Fetch locations on district change
            districtSelect.addEventListener('change', function() {
                const districtId = this.options[this.selectedIndex].getAttribute('data-id');
                if (!districtId) return;
                getRelatedLocations(districtId);
                
            });

            locationSelect.addEventListener('change', function() {
                const locationId = this.options[this.selectedIndex].getAttribute('data-id');
                getTimes(dateInput.value, locationId);
            })
        });
    </script>

    <script>
        // datepicker initializer 
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr(".date-picker", {
                dateFormat: "Y-m-d",
                allowInput: true
            });
        });

        const getTimes = (value, locationId) => {
            const timeContainer = document.getElementById('appointment_time');
            let prevTime = timeContainer.getAttribute('data-value');

            timeContainer.innerHTML =
                `<div class="col"><label class="border border-outline-secondary p-2 fs-6 rounded-2 w-auto h-auto">Loading...</label></div>`;

            // console.log("Fetching Time: " + value);

            if (!locationId) {

                timeContainer.innerHTML =
                    `<div class="col"><label class="border border-outline-secondary p-2 fs-6 rounded-2 w-auto h-auto">Select Location First</label></div>`;
                return;

            }

            fetch(getBaseUrl() + `/passport/times/${locationId}/${value}`)
                .then(res => res.json())
                .then(data => {

                    if (!data.status) {
                        timeContainer.innerHTML =
                            `<div class="col"><label class="btn btn-outline-secondary fs-6 pt-2 w-auto h-auto">No Available Times</label></div>`;
                        return;
                    }

                    if (data.status && data.times) {

                        if (data.times.time.length == 0) {
                            timeContainer.innerHTML =
                                `<div class="col">
                                    <label class="btn btn-outline-secondary fs-6 pt-2 w-auto h-auto">No Available Times</label>
                                </div>`;
                            return;
                        }

                        timeContainer.innerHTML = '';
                        data.times.time.forEach((t, index) => {
                            const time = t.time;
                            const id = `btn-check-${index + 1}`;


                            let checked = prevTime.slice(0, 5) == time

                            console.log(prevTime, time)

                            console.log(checked)
                            const col = document.createElement('div');
                            col.className = 'col';

                            col.innerHTML = `
                                        <input type="radio" class="btn-check" name="appointment_time" autocomplete="off" id="${id}" value="${time}" ${checked ? 'checked' : ''}>
                                        <label class="btn btn-outline-secondary fs-6 pt-2 w-auto h-auto" for="${id}">${time}</label>
                                    `;
                            timeContainer.appendChild(col);
                        });

                    }

                });

        }



        document.addEventListener("DOMContentLoaded", function() {

            var calendar = rome(inline_cal, {
                time: false, // Only date
                inputFormat: 'YYYY-MM-DD'
            });

            calendar.setValue(document.getElementById('appointment_date').value);

            getTimes(document.getElementById('appointment_date').value, document.getElementById('app_location')
                .options[document.getElementById('app_location').selectedIndex].getAttribute('data-id'));

            // Listen for date change and update hidden input
            calendar.on('data', function(value) {
                console.log(value + "date changed")
                document.getElementById('appointment_date').value = value;
                getTimes(value, document.getElementById('app_location').options[document.getElementById(
                    'app_location').selectedIndex].getAttribute('data-id'));

            });
        });



        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('passportRenewalForm').addEventListener('submit', function(e) {
                console.log("submitting")
                const requiredFields = document.getElementById('passportRenewalForm').querySelectorAll(
                    '[required]:not([type="checkbox"])');
                let hasError = false;

                requiredFields.forEach(field => {
                    console.log(field)
                    if (!field.value.trim()) {
                        field.classList.add('error');
                        hasError = true;
                    } else {
                        field.classList.remove('error');
                    }
                    console.log(hasError)
                });

                if (hasError) {
                    e.preventDefault(); // Stop form submission
                }
            });

            // Optional: remove error class on input
            document.querySelectorAll('[required]').forEach(field => {
                field.addEventListener('input', () => {
                    if (field.value.trim()) {
                        field.classList.remove('error');
                    }
                });
            });
        })
        let checkTerms = document.getElementById('checkTerms');
        let checkCorrect = document.getElementById('checkCorrect');

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

        checkTerms.addEventListener('change', function() {
            if (checkTerms.checked && checkCorrect.checked) {
                document.getElementById('form3NextBtn').disabled = false;
            } else {
                document.getElementById('form3NextBtn').disabled = true;
            }
        })

        checkCorrect.addEventListener('change', function() {
            if (checkTerms.checked && checkCorrect.checked) {
                document.getElementById('form3NextBtn').disabled = false;
            } else {
                document.getElementById('form3NextBtn').disabled = true;
            }
        })

        function goToForm(current, next) {

            let titles = document.querySelectorAll('.title')
            titles.forEach(title => {
                title.classList.remove('activeTitle');
            })

            document.getElementById(next + "Title").classList.add('activeTitle');

            let sections = document.querySelectorAll('.form-section');

            sections.forEach(section => {
                section.classList.add('d-none');
            })

            document.getElementById(current).classList.add('d-none');
            document.getElementById(next).classList.remove('d-none');
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });

        }

        function validateAppointmentForm() {
            let hasError = false;

            // Select the required fields
            const requiredFields = [
                document.getElementById('app_country'),
                document.getElementById('app_province'),
                document.getElementById('app_district'),
                document.getElementById('app_location')
            ];

            // Validate each required select field
            requiredFields.forEach(field => {
                if (!field.value.trim() || field.value === "Other") {
                    field.classList.add('error');
                    hasError = true;
                } else {
                    field.classList.remove('error');
                }
            });

            // Validate appointment date
            const appointmentDateField = document.getElementById('appointment_date');
            if (!appointmentDateField.value.trim()) {
                appointmentDateField.classList.add('error');
                hasError = true;
            } else {
                appointmentDateField.classList.remove('error');
            }

            // Validate appointment time (radio group)
            const timeSelected = document.querySelector('input[name="appointment_time"]:checked');
            if (!timeSelected) {
                document.querySelectorAll('input[name="appointment_time"]').forEach(el => {
                    el.nextElementSibling.classList.add('error');
                });
                hasError = true;
            } else {
                document.querySelectorAll('input[name="appointment_time"]').forEach(el => {
                    el.nextElementSibling.classList.remove('error');
                });
            }

            if (hasError) {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                })
                return false;
            }

            return true;
        }
    </script>
@endpush
