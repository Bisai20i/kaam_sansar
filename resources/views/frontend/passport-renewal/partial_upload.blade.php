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
                <p class="fs-3">Complete the form below to start your passport renewal process</p>
            </div>


        </div>


        <div class="my-3 mb-5 border border-1 border-dark-subtle rounded-4 p-3 p-md-5">

            <form id="passportRenewalForm" action="{{ route('passport.renew.partial') }}" enctype="multipart/form-data"
                method="POST" class="accordion">

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
                            <input type="hidden" name="service_type" id="service_type" required>
                            <div class="col-auto nav-item" role="presentation">
                                <button class="nav-link border border-1 border-dark-subtle fs-6"
                                    data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                                    aria-controls="pills-home" aria-selected="true"
                                    onclick="document.getElementById('service_type').value = 'apply'">First
                                    Issuance</button>
                            </div>
                            <div class="col-auto nav-item" role="presentation">
                                <button class="nav-link border border-1 border-dark-subtle fs-6"
                                    data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                                    aria-controls="pills-home" aria-selected="true"
                                    onclick="document.getElementById('service_type').value = 'renewal'">Renewal
                                    Issuance</button>
                            </div>

                            <div class="col-auto nav-item" role="presentation">
                                <button class="nav-link border border-1 border-dark-subtle fs-6"
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
                            <button class="btn btn-lg py-2 px-4 text-white btn-next mt-0">Cancel</button>
                            <button class="btn btn-lg py-2 px-4 text-white btn-next mt-0" style="background-color: #0064a7;"
                                type="button" onclick="goToForm('firstForm','secondForm')">Next</button>
                        </div>

                    </div>

                </div>

                <div id="secondForm" class="d-none">

                    <div>
                        <h4 style="color:#0064a7;">Book Appointment</h4>

                    </div>
                    <div>

                            <div class="row row-cols-1 row-cols-md-2">
                                <div class="col">
                                    <label for="app_country">Appointment Country:</label>
                                    <select class="form-select my-2" aria-label="Default select example">
                                        <option selected>Nepal</option>
                                        <option value="1">Other</option>

                                    </select>
                                </div>
                                <div class="col">
                                    <label for="app_province">Appointment Province:</label>
                                    <select class="form-select my-2" aria-label="Default select example">
                                        <option selected>Gandaki</option>
                                        <option value="1">Other</option>

                                    </select>
                                </div>

                                <div class="col">
                                    <label for="app_district">Select District:</label>
                                    <select class="form-select my-2" aria-label="Default select example">
                                        <option selected>Kaski</option>
                                        <option value="1">Other</option>

                                    </select>
                                </div>
                                <div class="col">
                                    <label for="app_province">Appointment Location:</label>
                                    <select class="form-select my-2" aria-label="Default select example">
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
                                <div class="col">
                                    <h4>Select a Date</h4>
                                    <div class="content border border-1 border-secondary-subtle rounded-4 h-100 pt-2"
                                        style="margin-bottom: -2rem;">
                                        <div class="container text-left">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12 text-center">
                                                    <form action="#" class="row align-items-center">
                                                        <div class="col">
                                                            <div id="inline_cal"></div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <h4>Select an hour</h4>
                                    <div
                                        class="border border-1 border-secondary-subtle
                                         rounded-4 p-4 h-100">
                                        <div class="row row-cols-auto g-4">
                                            <div class="col">
                                                <input type="radio" class="btn-check" name="options-time"
                                                    id="btn-check-1" autocomplete="off">
                                                <label class="btn btn-outline-secondary fs-6 pt-2 w-auto h-auto"
                                                    for="btn-check-1">10:30</label>
                                            </div>
                                            <div class="col">
                                                <input type="radio" class="btn-check" name="options-time"
                                                    id="btn-check-2" autocomplete="off">
                                                <label class="btn btn-outline-secondary fs-6 pt-2 w-auto h-auto"
                                                    for="btn-check-2">11:30</label>
                                            </div>
                                            <div class="col">
                                                <input type="radio" class="btn-check" name="options-time"
                                                    id="btn-check-3" autocomplete="off">
                                                <label class="btn btn-outline-secondary fs-6 pt-2 w-auto h-auto"
                                                    for="btn-check-3">12:30</label>
                                            </div>
                                            <div class="col">
                                                <input type="radio" class="btn-check" name="options-time"
                                                    id="btn-check-4" autocomplete="off">
                                                <label class="btn btn-outline-secondary fs-6 pt-2 w-auto h-auto"
                                                    for="btn-check-4">13:30</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                    </div>
                    <div class="d-flex justify-content-between mt-5">
                        <button class="btn btn-light" onclick="goToForm('secondForm','firstForm')">Back</button>
                        <button class="btn text-white border-0" style="background-color: #0064a7;" type="button"
                            onclick="goToForm('secondForm','mainForm')">Next</button>
                    </div>

                </div>


                <div id="mainForm" class="d-none">
                    @csrf

                    <h2 class=" fs-4 text-semibold" style="color:#0064a7;">
                        <button style="all:unset;cursor: pointer; margin-right:10px;"
                            onclick="goToNextPhase('secondForm')">
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
    <script>
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

            let sections = document.querySelectorAll('.form-section');

            sections.forEach(section => {
                section.classList.add('d-none');
            })

            document.getElementById(current).classList.add('d-none');
            document.getElementById(next).classList.remove('d-none');
            document.getElementById(next).scrollIntoView({
                behavior: "smooth"
            });
            
        }

        // function goToNextForm(id) {
        //     let sections = document.querySelectorAll('.form-section');

        //     section.forEach(section => {
        //         section.classList.add('d-none');
        //     })

        //     let inputs = document.getElementById('service_type').value;
        //     document.getElementById(current).classList.add('d-none');
        //     document.getElementById(id).classList.remove('d-none');
        //     document.getElementById(id).scrollIntoView({
        //         behavior: "smooth"
        //     });
        // }
    </script>
@endpush
