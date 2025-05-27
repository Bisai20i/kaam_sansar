@extends('frontend.layouts.main')

@section('title', 'work Permit')

@section('content')


<!-- Form 3 -->
<div id="multiStepForm3" class="container multi-step-form mt-5 pt-3">
    <div class="row">
        <div class="col-auto">
            <a href="{{ route('index') }}" style="cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="36" viewBox="0 0 12 24">
                    <path fill="#000" fill-rule="evenodd"
                        d="m3.343 12l7.071 7.071L9 20.485l-7.778-7.778a1 1 0 0 1 0-1.414L9 3.515l1.414 1.414z" />
                </svg>
            </a>
        </div>
        <div class="col text-center">
            <h2 style="color:#0064a7;">Work Permit</h2>
            <p class="fs-3 mb-2">Complete the form below to start your Work Permit Renewal process</p>
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

        <form id="passportRenewalForm" action="{{ route('workPermits.store') }}" enctype="multipart/form-data"
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
                        <input type="hidden" name="serviceType" id="serviceType" value="apply" required>
                        <div class="col-auto nav-item" role="presentation">
                            <button class="nav-link border border-1 border-dark-subtle fs-6 active"
                                data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                                aria-controls="pills-home" aria-selected="true"
                                onclick="document.getElementById('serviceType').value = 'apply'"> New Work Permit
                                Issuance</button>
                        </div>
                        <div class="col-auto nav-item" role="presentation">
                            <button class="nav-link border border-1 border-dark-subtle fs-6" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true"
                                onclick="document.getElementById('serviceType').value = 'renewal'">Renewal work Permit</button>
                        </div>

                        <div class="col-auto nav-item" role="presentation">
                            <button class="nav-link border border-1 border-dark-subtle fs-6" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true"
                                onclick="document.getElementById('serviceType').value = 'replacement'">Legalization</button>
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

                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('index') }}" class="btn btn-light btn-lg py-2 px-4" type="button">Cancel</a>
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
                                <option value="{{ $province->provienceName}}">{{ $province->provienceName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label for="appDistrict" class="required">Select District:</label>
                            <select class="form-select my-2" aria-label="Default select example" name="appDistrict" id="appDistrict" required>
                                <option value="">Select District</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="appLocation" class="required">Appointment Location:</label>
                            <select class="form-select my-2" aria-label="Default select example" id="appLocation" name="appLocation" required>
                                <option value="">Select Location</option>
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
                    </button> Required Information
                </h2>

                <hr>

                <h4 class="d-inline py-2 accordion-header fs-5 text-semibold" style="color:#0064a7;">

                    Personal
                    Information
                </h4>
                <div class="row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 gx-3">
                    <div class="col">
                        <label for="firstName" class="form-label fs-6 required">First Name</label>
                        <br>

                        <input type="text" class="form-control" id="firstName" name="firstName" required
                            value="{{ old('firstName', Auth::guard('job_seekers')->user()->firstName ?? '') }}">
                    </div>
                    <div class="col">
                        <label for="middleName" class="form-label fs-6 ">Middle Name</label>
                        <br>

                        <input type="text" class="form-control" id="middleName" name="middleName">
                    </div>
                    <div class="col">
                        <label for="lastName" class="form-label fs-6 required">Last Name</label>
                        <br>

                        <input type="text" class="form-control" id="lastName" name="lastName" required
                            value="{{ old('lastName', Auth::guard('job_seekers')->user()->lastName ?? '') }}">
                    </div>
                    <div class="col">
                        <label for="phoneNo" class="form-label fs-6 required">Phone Number</label>
                        <br>

                        <input type="text" class="form-control" id="phoneNo" name="phoneNo" required>
                    </div>
                    <div class="col">
                        <label for="email" class="form-label fs-6 required">Email</label>
                        <br>

                        <input type="text" class="form-control" id="email" name="email" required
                            value="{{ old('email', Auth::guard('job_seekers')->user()->emailAddress ?? '') }}">
                    </div>
                    <div class="col">
                        <label for="emergencyContactPhone" class="form-label fs-6 required">Emergency Contact
                            Phone</label>
                        <br>
                        <input type="text" class="form-control" name="emergencyContactPhone" id="emergencyContactPhone" required>
                    </div>
                    <div class="col">
                        <label for="emergencyContactEmail" class="form-label fs-6 required">Emergency Contact
                            Email</label>
                        <br>
                        <input type="email" class="form-control" name="emergencyContactEmail" id="emergencyContactEmail" required>
                    </div>
                    <div class="col">
                        <label for="contCountry" class="form-label fs-6 required"> Contact Country
                        </label>
                        <br>
                        <input type="text" class="form-control" name="contCountry" id="contCountry" required>
                    </div>
                    <div class="col">
                        <label for="state" class="form-label fs-6 required">State/Provience</label>
                        <br>
                        <input type="text" class="form-control" name="state" id="state" required>
                    </div>
                    <div class="col">
                        <label for="contdistrict" class="form-label fs-6 required">District</label>
                        <br>
                        <input type="text" class="form-control" name="contdistrict" id="contdistrict" required>
                    </div>
                    <div class="col">
                        <label for="contCity" class="form-label fs-6 required">City</label>
                        <br>
                        <input type="text" class="form-control" name="contCity" id="contCity" required>
                    </div>
                    <br>


                </div>
                <h4 class="py-2 accordion-header d-inline fs-5" style="color:#0064a7;">
                    Required Documents
                </h4>
                <div class="row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 gx-3">
                    <div class="col">
                        <label for="passportPhoto" class="form-label fs-6 required">Passport Photo:</label>
                        <br>
                        <input type="file" class="form-control" id="passportPhoto" name="passportPhoto"
                            accept=".jpg,.jpeg,.png,.pdf" required accept=".jpg,.jpeg,.png,.pdf"
                            onchange="handleImagePreview(this)">
                        <img src="#" alt="preview Image" class="img img-fluid my-2 d-none">
                    </div>

                    <div class="col">
                        <label for="visaPhoto" class="form-label fs-6 required">Visa Photo</label>
                        <br>

                        <input type="file" class="form-control" id="visaPhoto" name="visaPhoto"
                            required accept=".jpg,.jpeg,.png,.pdf" onchange="handleImagePreview(this)">
                        <img src="#" alt="preview Image" class="img img-fluid my-2 d-none">
                    </div>
                    <div class="col">
                        <label for="otherDocumentsPhoto" class="form-label fs-6">Any
                            Other
                            Supporting
                            Document:</label>
                        <br>
                        <input type="file" class="form-control" id="otherDocumentsPhoto" name="otherDocumentsPhoto"
                            accept=".jpg,.jpeg,.png,.pdf" onchange="handleImagePreview(this)">

                        <img src="#" alt="preview Image" class="img img-fluid my-2 d-none">
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
                            work permit service.
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
                            disabled>Renew Work Permit</button>
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
<script>
    // Function to handle form navigation
    function goToForm(currentFormId, nextFormId) {
        // Hide current form
        document.getElementById(currentFormId).classList.add('d-none');

        // Show next form
        document.getElementById(nextFormId).classList.remove('d-none');

        // Update active title indicator
        document.querySelectorAll('.title').forEach(title => {
            title.classList.remove('activeTitle');
            title.classList.add('bg-light');
        });

        // Highlight current step title
        document.getElementById(nextFormId + 'Title').classList.add('activeTitle');
        document.getElementById(nextFormId + 'Title').classList.remove('bg-light');
    }

    // Form validation before proceeding
    function validateAppointmentForm() {
        // Add your validation logic here
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
            if (checkCorrect.checked && checkTerms.checked) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        }

        checkCorrect.addEventListener('change', checkSubmitConditions);
        checkTerms.addEventListener('change', checkSubmitConditions);
    });

    // Image preview handler
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

    // Pass PHP data to JavaScript
    const cascadingData = {
        provinces: @json($provinces),
        districts: @json($districts),
        locations: @json($locations),
    };

    // Initialize dropdowns
    document.addEventListener('DOMContentLoaded', function() {
        const provinceSelect = document.getElementById('appProvince');
        const districtSelect = document.getElementById('appDistrict');
        const locationSelect = document.getElementById('appLocation');

        // Province → District → Location cascading
        provinceSelect?.addEventListener('change', populateDistricts);
        districtSelect?.addEventListener('change', populateLocations);

        // Populate districts based on selected province
        function populateDistricts() {
            const provinceName = provinceSelect.value;
            districtSelect.innerHTML = '<option value="">Select District</option>';
            districtSelect.disabled = !provinceName;

            if (!provinceName) return;

            const filteredDistricts = cascadingData.districts.filter(
                district => district.provienceName === provinceName
            );

            filteredDistricts.forEach(district => {
                districtSelect.innerHTML += `
                <option value="${district.districtName}">${district.districtName}</option>
            `;
            });
        }

        // Populate locations based on selected district
        function populateLocations() {
            const districtName = districtSelect.value;
            locationSelect.innerHTML = '<option value="">Select Location</option>';
            locationSelect.disabled = !districtName;

            if (!districtName) return;

            const filteredLocations = cascadingData.locations.filter(
                location => location.districtName === districtName
            );

            filteredLocations.forEach(location => {
                locationSelect.innerHTML += `
                <option value="${location.locationName}">${location.locationName}</option>
            `;
            });
        }
    });
</script>
@endpush