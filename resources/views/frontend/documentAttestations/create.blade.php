@extends('frontend.layouts.main')

@section('title', 'Broker Account')
@push('head') <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')

<section class="ad_banner p-4 border border-1 border-dark-subtle mt-5 text-center mb-4">
    <h2 class="py-4">Advertisement Banner</h2>
</section>

<section class="daform">
    <div class="container-fluid container-lg">
        <div id="form-container"
            class="container-fluid container-lg border border-1 border-dark-subtle rounded-4 p-md-5 py-5 mb-5 mt-5">
            <form id="form" method="POST" action="{{ route('documentAttestations.store') }}">
                @csrf
                <div id="multiStepForm1" class="multi-step-form" style="display:block;">
                    <div class="d-flex">
                        <div class="col-auto">
                            <a href="#" class="">
                                <i class="fa fa-chevron-left text-black fs-4 ms-2" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col text-center">
                            <h3 style="color:#0064a7;">Documentation Attestaion</h3>
                        </div>
                    </div>
                    <div class="text-center my-4">
                        <div class="d-md-inline-flex justify-content-center align-items-center gap-3 bg-light fs-6">
                            <p class="p-2 rounded-2 text-white m-0" style="background-color: #0064a7;">Select Service
                                &
                                Read
                                Instructions
                            </p>
                            <p class="p-2 bg-light rounded-2 m-0">Select Country</p>
                            <p class="p-2 bg-light rounded-2 m-0">Fill Application</p>
                            <p class="p-2 bg-light rounded-2 m-0">Payment</p>
                        </div>
                    </div>
                    <div class="mt-5 border border-1 border-dark-subtle rounded-4 p-3 p-md-5">
                        <div>
                            <h5 style="color:#0064a7;">Select Document Type</h5>
                        </div>
                        <div class="mb-3">
                            <label for="documentType" class="form-label">Select Type <span class="text-danger">*</span></label>
                            <select id="documentType" name="documentType" class="form-select w-50" aria-label="Default select example" required>
                                <option selected>Nagrita</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="subType" class="form-label">Select Sub-type <span class="text-danger">*</span></label>
                            <select id="subType" name="subType" class="form-select w-50" aria-label="Default select example" required>
                                <option selected>Photocopy</option>
                            </select>
                        </div>
                        <div class="mt-5">
                            <h5 style="color:#0064a7;">Conditions of Use</h5>
                            <p class="fs-5 my-3">Read before pre-enrollment</p>
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
                            <h5 style="color:#0064a7;">Required Documents</h5>
                            <li class="ms-3 text-justify text-secondary">
                                Lorem ipsum dolor sit amet. Inventore libero repellendus quo. Consectetur vel placeat
                                sit temporibus ab ex explicabo, dicta officia, pariatur aspernatur.
                            </li>
                            <li class="ms-3 text-justify text-secondary">
                                Lorem ipsum dolor sit amet. Inventore libero repellendus quo. Consectetur vel placeat
                                sit temporibus ab ex explicabo, dicta officia, pariatur aspernatur.
                            </li>
                        </div>
                        <div class="mt-5">
                            <h5 style="color:#0064a7;">Service Completion Duration</h5>

                            <div class="mb-3 text-secondary">
                                Lorem ipsum dolor sit amet. Inventore libero repellendus quo. Consectetur vel
                                placeat sit temporibus ab ex explicabo, dicta officia, pariatur aspernatur.
                            </div>
                            <div class="d-flex justify-content-between mt-5">
                                <button class="btn btn-light">Cancel</button>
                                <button class="btn text-white border-0"
                                    style="background-color: #0064a7;" type="button"
                                    onclick="showNextForm(2)">Next</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form 2 -->
                <div id="multiStepForm2" class="multi-step-form" style="display:none;">
                    <div class="d-flex">
                        <div class="col-auto">
                            <a onclick="showPreviousForm(2)" style="cursor: pointer;">
                                <i class="fa fa-chevron-left fs-4 ms-2" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col text-center">
                            <h3 style="color:#0064a7;">Documentation Attestation</h3>
                        </div>
                    </div>
                    <div class="text-center my-4">
                        <div class="d-lg-inline-flex justify-content-center align-items-center gap-3 bg-light fs-6">
                            <p class="p-2 bg-light rounded-2 m-0">Select Service & Read Instructions</p>
                            <p class="p-2 rounded-2 text-white m-0" style="background-color: #0064a7;">Select Country</p>
                            <p class="p-2 bg-light rounded-2 m-0">Fill Application</p>
                            <p class="p-2 bg-light rounded-2 m-0">Payment</p>
                        </div>
                    </div>
                    <div class="mt-5 border border-1 border-dark-subtle rounded-4 p-3 p-md-5">
                        <div>
                            <h4 style="color:#0064a7;">Select Country for Attestation</h4>
                            <p class="text-muted">First, please select the country where you live:</p>
                        </div>
                        <div>
                            <div class="row row-cols-1">
                                <div class="col">
                                    <label for="applicantCountry">Select Country: <span class="text-danger">*</span></label>
                                    <select id="applicantCountry" name="applicantCountry" class="form-select my-2 w-50" aria-label="Default select example" required>
                                        <option selected>Nepal</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <p class="text-muted">Then, select the country where your documents to be attested:</p>
                                </div>
                                <div class="col">
                                    <label for="attestationCountry">Select Country: <span class="text-danger">*</span></label>
                                    <select id="attestationCountry" name="attestationCountry" class="form-select w-50 my-2" aria-label="Default select example" required>
                                        <option selected>USA</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <p class="text-muted">Also, enter the name of applicant.</p>
                                </div>
                                <div class="col">
                                    <label for="applicantName">Applicant Name: <span class="text-danger">*</span></label>
                                    <input id="applicantName" name="applicantName" type="text" class="form-control form-control-da fs-6 mt-2 my-0 w-50 text-muted" placeholder="Enter applicant Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-5">
                            <button class="btn btn-light">Cancel</button>
                            <button class="btn text-white border-0" style="background-color: #0064a7;" type="button" onclick="showNextForm(3)">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Form 3 -->
                <div id="multiStepForm3" class="multi-step-form" style="display:none;">
                    <div class="d-flex">
                        <div class="col-auto">
                            <a onclick="showPreviousForm(3)" style="cursor: pointer;">
                                <i class="fa fa-chevron-left fs-4 ms-2" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col text-center">
                            <h3 style="color:#0064a7;">Documentation Attestation</h3>
                        </div>
                    </div>
                    <div class="text-center my-4">
                        <div class="d-lg-inline-flex justify-content-center align-items-center gap-3 bg-light fs-6">
                            <p class="p-2 bg-light rounded-2 m-0">Select Service & Read Instructions</p>
                            <p class="p-2 bg-light rounded-2 m-0">Select Country</p>
                            <p class="p-2 rounded-2 text-white m-0" style="background-color: #0064a7;">Fill Application</p>
                            <p class="p-2 bg-light rounded-2 m-0">Payment</p>
                        </div>
                    </div>

                    <div class="mt-5 border border-1 border-dark-subtle rounded-4 p-3 p-md-5">
                        <div class="attestation">
                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block">Attestation Requirement</h4>
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-2 row-gap-3">
                                <div class="col">
                                    <label for="countryAttestation" class="form-label fs-6">Country for Attestation: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-da fs-6" id="countryAttestation" name="countryAttestation" required maxlength="255" placeholder="Enter country where attestation is required">
                                </div>
                                <div class="col">
                                    <label for="purpose" class="form-label fs-6">Purpose of Attestation: <span class="text-danger">*</span></label>
                                    <select class="form-select text-muted fs-6" id="purpose" name="purpose" required>
                                        <option value="">Select Purpose</option>
                                        <option value="something">Something</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="Delivery Address">
                            <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block">Delivery Address Details</h4>
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                <div class="col">
                                    <label for="deliveryCountry" class="form-label fs-6">Country Name: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-da fs-6" id="deliveryCountry" name="deliveryCountry" required maxlength="255" placeholder="Enter Country Name">
                                </div>
                                <div class="col">
                                    <label for="deliveryCity" class="form-label fs-6">City: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-da fs-6" id="deliveryCity" name="deliveryCity" required maxlength="255" placeholder="Enter city Name">
                                </div>
                                <div class="col">
                                    <label for="deliveryStreet" class="form-label fs-6">Street Name: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-da fs-6" id="deliveryStreet" name="deliveryStreet" required maxlength="255" placeholder="Enter Street Name">
                                </div>
                                <div class="col">
                                    <label for="deliveryApartment" class="form-label fs-6">Apartment Number:</label>
                                    <input type="text" class="form-control form-control-da fs-6" id="deliveryApartment" name="deliveryApartment" maxlength="255" placeholder="Enter Apartment Number">
                                </div>
                                <div class="col">
                                    <label for="deliveryLandmark" class="form-label fs-6">Landmark:</label>
                                    <input type="text" class="form-control form-control-da fs-6" id="deliveryLandmark" name="deliveryLandmark" maxlength="255" placeholder="Enter Landmark">
                                </div>
                                <div class="col">
                                    <label for="primaryContact" class="form-label fs-6">Primary Contact Number: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-da fs-6" id="primaryContact" name="primaryContact" required maxlength="255" placeholder="Enter Contact Number">
                                </div>
                                <div class="col">
                                    <label for="secondaryContact" class="form-label fs-6">Alternative Contact Number:</label>
                                    <input type="text" class="form-control form-control-da fs-6" id="secondaryContact" name="secondaryContact" maxlength="255" placeholder="Enter Contact Number">
                                </div>
                                <div class="col">
                                    <label for="email" class="form-label fs-6">Email Address: <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-da fs-6" id="email" name="email" required maxlength="255" placeholder="Enter email address">
                                </div>
                            </div>
                        </div>

                        <div class="workaddress">
                            <div class="">
                                <h4 class="pt-4 pb-1 d-inline-block">
                                    Work Address (If Different from Delivery Address)
                                </h4>
                            </div>
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                <div class="col">
                                    <label for="workCountry" class="form-label fs-6">Country Name: </label>
                                    <input type="text" class="form-control form-control-da fs-6" id="workCountry" name="workCountry" maxlength="255" placeholder="Enter country Name">
                                </div>
                                <div class="col">
                                    <label for="workCity" class="form-label fs-6">City: </label>
                                    <input type="text" class="form-control form-control-da fs-6" id="workCity" name="workCity" maxlength="255" placeholder="Enter city name">
                                </div>

                                <div class="col">
                                    <label for="workStreet" class="form-label fs-6">Street Name: </label>
                                    <input type="text" class="form-control form-control-da fs-6" id="workStreet" name="workStreet" maxlength="255" placeholder="Enter Street Name">
                                </div>

                                <div class="col">
                                    <label for="workApartment" class="form-label fs-6">Apartment Number: </label>
                                    <input type="text" class="form-control form-control-da fs-6" id="workApartment" name="workApartment" maxlength="255" placeholder="Enter Apartment Number">
                                </div>

                                <div class="col">
                                    <label for="workLandmark" class="form-label fs-6">Landmark: </label>
                                    <input type="text" class="form-control form-control-da fs-6" id="workLandmark" name="workLandmark" maxlength="255" placeholder="Enter Landmark">
                                </div>
                            </div>
                        </div>
                        <div class="attestation">
                            <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Required Documents</h4>
                            <div class="accordion-body row py-3 row-cols-1 row-cols-lg-2 row-gap-4 gx-5">
                                <div class="col">
                                    <label for="identification" class="form-label fs-6">Identification Document:</label>
                                    <input type="file" class="form-control form-control-da fs-6" id="identification" name="identification" accept=".jpg,.jpeg,.png,.pdf">
                                </div>
                                <div class="col">
                                    <label for="visa" class="form-label fs-6">Visa:</label>
                                    <input type="file" class="form-control form-control-da fs-6" id="visa" name="visa" accept=".jpg,.jpeg,.png,.pdf">
                                </div>
                                <div class="col">
                                    <label for="citizenshipFront" class="form-label fs-6">Citizenship Front: <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control form-control-da fs-6" id="citizenshipFront" name="citizenshipFront" accept=".jpg,.jpeg,.png,.pdf" required>
                                </div>
                                <div class="col">
                                    <label for="citizenshipBack" class="form-label fs-6">Citizenship Back: <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control form-control-da fs-6" id="citizenshipBack" name="citizenshipBack" accept=".jpg,.jpeg,.png,.pdf" required>
                                </div>
                                <div class="col">
                                    <label for="passport" class="form-label fs-6">Passport:</label>
                                    <input type="file" class="form-control form-control-da fs-6" id="passport" name="passport" accept=".jpg,.jpeg,.png,.pdf">
                                </div>
                                <div class="col">
                                    <label for="photo" class="form-label fs-6">Passport-size Photo:</label>
                                    <input type="file" class="form-control form-control-da fs-6" id="photo" name="photo" accept=".jpg,.jpeg,.png,.pdf">
                                </div>
                                <div class="col">
                                    <label for="document1" class="form-label fs-6">Document 1:</label>
                                    <input type="file" class="form-control form-control-da fs-6" id="document1" name="document1" accept=".jpg,.jpeg,.png,.pdf">
                                </div>
                                <div class="col">
                                    <label for="document2" class="form-label fs-6">Document 2:</label>
                                    <input type="file" class="form-control form-control-da fs-6" id="document2" name="document2" accept=".jpg,.jpeg,.png,.pdf">
                                </div>
                                <div class="col">
                                    <label for="document3" class="form-label fs-6">Document 3:</label>
                                    <input type="file" class="form-control form-control-da fs-6" id="document3" name="document3" accept=".jpg,.jpeg,.png,.pdf">
                                </div>
                                <div class="col">
                                    <label for="document4" class="form-label fs-6">Document 4:</label>
                                    <input type="file" class="form-control form-control-da fs-6" id="document4" name="document4" accept=".jpg,.jpeg,.png,.pdf">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-4 border border-1 border-secondary"></div>
                    <div class="d-flex flex-column mx-3 mb-5">
                        <div class="form-check">
                            <input class="form-check-input fs-6" type="checkbox" value="" id="checkCorrect" required>
                            <label class="form-check-label fs-6" for="checkCorrect">
                                <span class="required"></span> I confirm that all
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
                            <input class="form-check-input fs-6" type="checkbox" value="" id="checkTerms" required>
                            <label class="form-check-label fs-6" for="checkTerms">
                                <span class="required"></span> I agree to the Terms
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
                                style="background-color: #0064a7;"
                                type="submit"
                                id="form3NextBtn">Apply Now</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    function showNextForm(formNumber) {
        document.getElementById('multiStepForm' + (formNumber - 1)).style.display = 'none';
        document.getElementById('multiStepForm' + formNumber).style.display = 'block';
    }

    function showPreviousForm(formNumber) {
        document.getElementById('multiStepForm' + formNumber).style.display = 'none';
        document.getElementById('multiStepForm' + (formNumber - 1)).style.display = 'block';
    }

    document.getElementById('form').addEventListener('submit', function(e) {
        e.preventDefault();

        // Ensure checkboxes are checked
        if (!document.getElementById('checkCorrect').checked ||
            !document.getElementById('checkTerms').checked) {
            return alert('Please agree to the terms and confirm the information is correct');
        }

        const formData = new FormData(this);

        fetch(this.action, {
            method: this.method,
            credentials: 'same-origin',           // send cookies for CSRF
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                'X-Requested-With': 'XMLHttpRequest',  // mark as AJAX
                'Accept': 'application/json'           // request JSON response
            },
            body: formData
        })
        .then(res => {
            if (!res.ok) {
                // if Laravel returns JSON errors
                return res.json().then(err => Promise.reject(err));
            }
            return res.json();
        })
        .then(data => {
            alert('Document Attestaion submitted Successfully! ');
             window.location = '/documentAttestations/create';
        })
        .catch(err => {
            console.error('Error response:', err);
            alert(err.message || 'Something went wrong');
        });
    });
</script>

@endsection