@extends('frontend.layouts.main')

@section('title', 'Passport Renewal')

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
                <h2 style="color:#0064a7;">Passport Renewal Form</h2>
                <p class="fs-3 mb-2">Complete the form below to start your passport renewal process</p>
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
                <p class="title p-lg-2 rounded-2 m-0 activeTitle" id="firstFormTitle">Select Service
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
                            <input type="hidden" name="service_type" id="service_type" value="apply" required>
                            <div class="col-auto nav-item" role="presentation">
                                <button class="nav-link border border-1 border-dark-subtle fs-6 active"
                                    data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                                    aria-controls="pills-home" aria-selected="true"
                                    onclick="document.getElementById('service_type').value = 'apply'">First
                                    Issuance</button>
                            </div>
                            <div class="col-auto nav-item" role="presentation">
                                <button class="nav-link border border-1 border-dark-subtle fs-6" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true"
                                    onclick="document.getElementById('service_type').value = 'renewal'">Renewal
                                    Issuance</button>
                            </div>

                            <div class="col-auto nav-item" role="presentation">
                                <button class="nav-link border border-1 border-dark-subtle fs-6" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true"
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
                                    value="34_pages" checked>
                                <label class="form-check-label fs-6" for="option1">
                                    Ordinary 34 Pages
                                </label>
                            </div>
                            <div class="col form-check">
                                <input class="form-check-input fs-6" type="radio" name="passport_pages" id="option2"
                                    value="66_pages">
                                <label class="form-check-label fs-6" for="option2">
                                    Ordinary 66 Pages
                                </label>
                            </div>
                        </div>
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
                                <label for="app_country" class="required">Appointment Country:</label>
                                <select class="form-select my-2" aria-label="Default select example" id="app_country"
                                    required name="country">
                                    <option value="">Select Country</option>
                                    <option value="nepal">Nepal</option>
                                    <option value="1">Other</option>

                                </select>
                            </div>
                            <div class="col">
                                <label for="app_province" class="required">Appointment Province:</label>
                                <select class="form-select my-2" aria-label="Default select example" id="app_province"
                                    name="state" required>
                                    <option value="">Select Provience</option>
                                    <option>Gandaki</option>
                                    <option value="1">Other</option>

                                </select>
                            </div>

                            <div class="col">
                                <label for="app_district" class="required">Select District:</label>
                                <select class="form-select my-2" aria-label="Default select example" name="district"
                                    id="app_district" required>
                                    <option value=""></option>
                                    <option>Kaski</option>
                                    <option value="1">Other</option>

                                </select>
                            </div>
                            <div class="col">
                                <label for="app_province" class="required">Appointment Location:</label>
                                <select class="form-select my-2" aria-label="Default select example" id="app_location"
                                    name="location" required>
                                    <option selected>Department of Passports</option>
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
                            <input type="hidden" id="appointment_date" name="appointment_date">
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
                                    <div class="row row-cols-auto g-4">
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

                    <h4 class="d-inline py-2 accordion-header fs-5 text-semibold" style="color:#0064a7;">

                        Personal
                        Information
                    </h4>
                    <div class="row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 gx-3">
                        <div class="col">
                            <label for="First Name" class="form-label fs-6 required">First Name</label>
                            <br>

                            <input type="text" class="form-control" id="first_name" name="first_name" required
                                value="{{ old('first_name', Auth::guard('job_seekers')->user()->firstName ?? '') }}">
                        </div>
                        <div class="col">
                            <label for="Middle Name" class="form-label fs-6 ">Middle Name</label>
                            <br>

                            <input type="text" class="form-control" id="middle_name" name="middle_name">
                        </div>
                        <div class="col">
                            <label for="Last Name" class="form-label fs-6 required">Last Name</label>
                            <br>

                            <input type="text" class="form-control" id="last_name" name="last_name" required
                                value="{{ old('last_name', Auth::guard('job_seekers')->user()->lastName ?? '') }}">
                        </div>
                        <div class="col">
                            <label for="phone" class="form-label fs-6 required">Phone Number</label>
                            <br>

                            <input type="text" class="form-control" id="phone_no" name="phone" required
                                value="{{ old('phone', Auth::guard('job_seekers')->user()->phoneNumber ?? '') }}">
                        </div>
                        <div class="col">
                            <label for="email" class="form-label fs-6 required">Email</label>
                            <br>

                            <input type="text" class="form-control" id="email" name="email" required
                                value="{{ old('email', Auth::guard('job_seekers')->user()->emailAddress ?? '') }}">
                        </div>
                        <div class="col">
                            <label for="Emergency Phone" class="form-label fs-6 required">Emergency Contact
                                Phone</label>
                            <br>

                            <input type="text" class="form-control" name="emergency_contact_phone" required>
                        </div>
                        <div class="col">
                            <label for="emergencey email" class="form-label fs-6 required">Emergency Contact
                                Email</label>
                            <br>

                            <input type="email" class="form-control" name="emergency_contact_email" required>
                        </div>
                        <br>


                    </div>
                    <h4 class="py-2 accordion-header d-inline fs-5" style="color:#0064a7;">
                        Required Documents
                    </h4>
                    <div class="row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3 gx-3">
                        <div class="col">
                            <label for="citizenship_front" class="form-label fs-6 required">Citizenship
                                Front:</label>
                            <br>

                            <input type="file" class="form-control" id="citizenship_front" name="citizenship_front"
                                accept=".jpg,.jpeg,.png,.pdf" required accept=".jpg,.jpeg,.png,.pdf"
                                onchange="handleImagePreview(this)">
                            <img src="#" alt="preview Image" class="img img-fluid my-2 d-none">
                        </div>

                        <div class="col">
                            <label for="citizenship_back" class="form-label fs-6 required">Citizenship
                                Back:</label>
                            <br>

                            <input type="file" class="form-control" id="citizenship_back" name="citizenship_back"
                                required accept=".jpg,.jpeg,.png,.pdf" onchange="handleImagePreview(this)">
                            <img src="#" alt="preview Image" class="img img-fluid my-2 d-none">
                        </div>

                        <div class="col">
                            <label for="previous_passport" class="form-label fs-6 required">Previous
                                Passport:</label>
                            <br>

                            <input type="file" class="form-control" id="previous_passport" name="previous_passport"
                                accept=".jpg,.jpeg,.png,.pdf" onchange="handleImagePreview(this)" required>
                            <img src="#" alt="preview Image" class="img img-fluid my-2 d-none">
                        </div>

                        <div class="col">
                            <label for="other_document" class="form-label fs-6">Any
                                Other
                                Supporting
                                Document:</label>
                            <br>

                            <input type="file" class="form-control" id="other_document" name="other_document"
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
                                disabled>Renew</button>
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
        // datepicker initializer 
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr(".date-picker", {
                dateFormat: "Y-m-d",
                allowInput: true
            });
        });



        document.addEventListener("DOMContentLoaded", function() {
            var calendar = rome(inline_cal, {
                time: false, // Only date
                inputFormat: 'YYYY-MM-DD'
            });

            document.getElementById('appointment_date').value = calendar.getMoment().format('YYYY-MM-DD')
            // Listen for date change and update hidden input
            calendar.on('data', function(value) {
                document.getElementById('appointment_date').value = value;
                console.log(document.getElementById('appointment_date').value)
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
                alert("Please fill all required fields.");
                return false;
            }

            return true;
        }
    </script>
@endpush
