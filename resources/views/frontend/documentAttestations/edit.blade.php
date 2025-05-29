@extends('frontend.layouts.main')

@section('title', 'Edit Document Attestation')
@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')

<section class="ad_banner p-4 border border-1 border-dark-subtle mt-5 text-center mb-4">
    <h2 class="py-4">Advertisement Banner</h2>
</section>
<style>
    .documentattestation img .img {
        max-width: 250px;
        max-height: 250px;
        object-fit: contain;
    }
</style>
<section class="daform">
    <div class="container-fluid container-lg">
        <div id="form-container"
            class="container-fluid container-lg border border-1 border-dark-subtle rounded-4 p-md-5 py-5 mb-5 mt-5">
            <form id="form" method="POST" action="{{ route('documentAttestations.update', $attestation->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                                @forelse ($documentTypes as $documentType)
                                <option value="{{ $documentType->documentType }}"
                                    {{ old('documentType', $document->documentType ?? '') == $documentType->documentType ? 'selected' : '' }}>
                                    {{ $documentType->documentType }}
                                </option>
                                @empty
                                <option disabled>No data available</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="subType" class="form-label">Select Sub-type <span class="text-danger">*</span></label>
                            <select id="subType" name="subType" class="form-select w-50" aria-label="Default select example" required>
                                @forelse ($documentSubtypes as $documentSubtype)
                                <option value="{{ $documentSubtype->documentSubtype }}"
                                    {{ old('subType', $document->subType ?? '') == $documentSubtype->documentSubtype ? 'selected' : '' }}>
                                    {{ $documentSubtype->documentSubtype }}
                                </option>
                                @empty
                                <option disabled>No data available</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="mt-5">
                            <div class="mt-5">
                                <h5 style="color:#0064a7;">Conditions of Use</h5>
                                <p class="fs-5 my-3">Read before pre-enrollment</p>
                                <p class="fs-6 text-black-50">
                                    By requesting document attestation services, you agree to provide accurate and verifiable information.
                                    The documents submitted must be authentic, legible, and free from tampering or falsification.
                                    The attestation process may involve verification with issuing authorities, and any discrepancies can result
                                    in service rejection without refund. It is the applicant’s responsibility to ensure all forms and
                                    supporting documents are properly filled out and submitted within the stated deadlines.
                                    <br><br>
                                    The service is intended strictly for personal, academic, or professional purposes. Misuse of attested documents
                                    for fraudulent activities may lead to legal consequences. By proceeding, you consent to data processing for
                                    verification purposes under our privacy policy.
                                </p>
                            </div>

                            <div class="mt-5">
                                <h5 style="color:#0064a7;">Required Documents</h5>
                                <li class="ms-3 text-justify text-secondary">
                                    Original and photocopy of the citizenship certificate requiring attestation.
                                </li>
                                <li class="ms-3 text-justify text-secondary">
                                    Valid government-issued document to be attestated.
                                </li>
                            </div>

                            <div class="mt-5">
                                <h5 style="color:#0064a7;">Service Completion Duration</h5>
                                <div class="mb-3 text-secondary">
                                    The document attestation process typically takes between 3 to 7 working days from the date of submission.
                                    Delays may occur in cases where additional verification is required or during public holidays.
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-5">
                                <button class="btn btn-light">Cancel</button>
                                <button class="btn text-white border-0"
                                    style="background-color: #0064a7;" type="button"
                                    onclick="if(validateForm1())showNextForm(2)">Next</button>
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
                            <p class="text-muted">First, please enter the country where you live:</p>
                        </div>
                        <div>
                            <div class="row row-cols-1">
                                <div class="col">
                                    <label for="applicantCountry">Enter Country: <span class="text-danger fw-bold">*</span></label>
                                    <select id="applicantCountry" name="applicantCountry" class="form-control my-2 w-50" required
                                        data-selected="{{ $attestation->applicantCountry }}">
                                        <option value="">Select your country</option>
                                    </select>
                                    <p class="text-muted">Then, select the country where your documents are to be attested:</p>
                                </div>

                                <div class="col">
                                    <label for="attestationCountry">Enter Country: <span class="text-danger fw-bold">*</span></label>
                                    <select id="attestationCountry" name="attestationCountry" class="form-control my-2 w-50" required
                                        data-selected="{{ $attestation->attestationCountry }}">
                                        <option value="">Select attestation country</option>
                                    </select>
                                    <p class="text-muted">Also, enter the name of applicant.</p>
                                </div>


                                <div class="col">
                                    <label for="applicantName">Applicant Name: <span class="text-danger fw-bold">*</span></label>
                                    <input id="applicantName" name="applicantName" type="text" class="form-control form-control-da fs-6 mt-2 my-0 w-50 text-muted" placeholder="Enter applicant Name" required value="{{ $attestation->applicantName }}">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-5">
                            <button class="btn btn-light">Cancel</button>
                            <button class="btn text-white border-0" style="background-color: #0064a7;" type="button" onclick="if(validateForm2())showNextForm(3)">Next</button>
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
                                    <label for="countryAttestation" class="form-label fs-6">Country for Attestation: <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control form-control-da fs-6" id="countryAttestation" name="countryAttestation" required maxlength="255" placeholder="Enter country where attestation is required" value="{{ $attestation->countryAttestation }}">
                                </div>
                                <div class="col">
                                    <label for="purpose" class="form-label fs-6">Purpose of Attestation: <span class="text-danger fw-bold">*</span></label>
                                    <select id="purpose" name="purpose" class="form-select w-50" aria-label="Default select example" required>
                                        <option value="" disabled {{ old('purpose', $document->purpose ?? '') == '' ? 'selected' : '' }}>Select purpose</option>
                                        @forelse ($documentPurposes as $documentPurpose)
                                        <option value="{{ $documentPurpose->documentPurpose }}"
                                            {{ old('purpose', $document->purpose ?? '') == $documentPurpose->documentPurpose ? 'selected' : '' }}>
                                            {{ $documentPurpose->documentPurpose }}
                                        </option>
                                        @empty
                                        <option disabled>No data available</option>
                                        @endforelse
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="Delivery Address">
                            <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block">Delivery Address Details</h4>
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                <div class="col">
                                    <label for="deliveryCountry" class="form-label fs-6">Country Name: <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control form-control-da fs-6" id="deliveryCountry" name="deliveryCountry" required maxlength="255" placeholder="Enter Country Name" value="{{ $attestation->deliveryCountry }}">
                                </div>
                                <div class="col">
                                    <label for="deliveryCity" class="form-label fs-6">City: <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control form-control-da fs-6" id="deliveryCity" name="deliveryCity" required maxlength="255" placeholder="Enter city Name" value="{{ $attestation->deliveryCity }}">
                                </div>
                                <div class="col">
                                    <label for="deliveryStreet" class="form-label fs-6">Street Name: <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control form-control-da fs-6" id="deliveryStreet" name="deliveryStreet" required maxlength="255" placeholder="Enter Street Name" value="{{ $attestation->deliveryStreet }}">
                                </div>
                                <div class="col">
                                    <label for="deliveryApartment" class="form-label fs-6">Apartment Number:</label>
                                    <input type="text" class="form-control form-control-da fs-6" id="deliveryApartment" name="deliveryApartment" maxlength="255" placeholder="Enter Apartment Number" value="{{ $attestation->deliveryApartment }}">
                                </div>
                                <div class="col">
                                    <label for="deliveryLandmark" class="form-label fs-6">Landmark:</label>
                                    <input type="text" class="form-control form-control-da fs-6" id="deliveryLandmark" name="deliveryLandmark" maxlength="255" placeholder="Enter Landmark" value="{{ $attestation->deliveryLandmark }}">
                                </div>
                                <div class="col">
                                    <label for="primaryContact" class="form-label fs-6">Primary Contact Number: <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control form-control-da fs-6" id="primaryContact" name="primaryContact" required maxlength="255" placeholder="Enter Contact Number" value="{{ $attestation->primaryContact }}">
                                </div>
                                <div class="col">
                                    <label for="secondaryContact" class="form-label fs-6">Alternative Contact Number:</label>
                                    <input type="text" class="form-control form-control-da fs-6" id="secondaryContact" name="secondaryContact" maxlength="255" placeholder="Enter Contact Number" value="{{ $attestation->secondaryContact }}">
                                </div>
                                <div class="col">
                                    <label for="email" class="form-label fs-6">Email Address: <span class="text-danger fw-bold">*</span></label>
                                    <input type="email" class="form-control form-control-da fs-6" id="email" name="email" required maxlength="255" placeholder="Enter email address" value="{{ $attestation->email }}">
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
                                    <input type="text" class="form-control form-control-da fs-6" id="workCountry" name="workCountry" maxlength="255" placeholder="Enter country Name" value="{{ $attestation->workCountry }}">
                                </div>
                                <div class="col">
                                    <label for="workCity" class="form-label fs-6">City: </label>
                                    <input type="text" class="form-control form-control-da fs-6" id="workCity" name="workCity" maxlength="255" placeholder="Enter city name" value="{{ $attestation->workCity }}">
                                </div>

                                <div class="col">
                                    <label for="workStreet" class="form-label fs-6">Street Name: </label>
                                    <input type="text" class="form-control form-control-da fs-6" id="workStreet" name="workStreet" maxlength="255" placeholder="Enter Street Name" value="{{ $attestation->workStreet }}">
                                </div>

                                <div class="col">
                                    <label for="workApartment" class="form-label fs-6">Apartment Number: </label>
                                    <input type="text" class="form-control form-control-da fs-6" id="workApartment" name="workApartment" maxlength="255" placeholder="Enter Apartment Number" value="{{ $attestation->workApartment }}">
                                </div>

                                <div class="col">
                                    <label for="workLandmark" class="form-label fs-6">Landmark: </label>
                                    <input type="text" class="form-control form-control-da fs-6" id="workLandmark" name="workLandmark" maxlength="255" placeholder="Enter Landmark" value="{{ $attestation->workLandmark }}">
                                </div>
                            </div>
                        </div>
                        <div class="documentattestation">
                            <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Required Documents</h4>
                            <div class="accordion-body">
                                <div class="row py-3 row-cols-1 row-cols-lg-2 row-gap-4 gx-5">
                                    <!-- Identification Document -->
                                    <div class="col">
                                        <label for="identification" class="form-label fs-6">Identification Document:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf format)</label>
                                        <input type="file" class="form-control" id="identification"
                                            name="identification" accept=".jpg,.jpeg,.png,.pdf"
                                            onchange="handleImagePreview(this)">
                                        @if(!empty($attestation->identification))
                                        <img src="{{ asset($attestation->identification) }}" alt=""
                                            class="img-fluid img mt-2 rounded" style="width:250px; height:250px; object-fit:contain;">
                                        @endif
                                    </div>

                                    <!-- Visa -->
                                    <div class="col">
                                        <label for="visa" class="form-label fs-6">Visa:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf format)</label>
                                        <input type="file" class="form-control" id="visa"
                                            name="visa" accept=".jpg,.jpeg,.png,.pdf"
                                            onchange="handleImagePreview(this)">
                                        @if(!empty($attestation->visa))
                                        <img src="{{ asset($attestation->visa) }}" alt=""
                                            class="img-fluid img mt-2 rounded" style="width:250px; height:250px; object-fit:contain;">
                                        @endif
                                    </div>

                                    <!-- Citizenship Front -->
                                    <div class="col">
                                        <label for="citizenshipFront" class="form-label fs-6">Citizenship Front:<span class="text-danger  fw-bold">*</span></label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf format)</label>
                                        <input type="file" class="form-control" id="citizenshipFront"
                                            name="citizenshipFront" accept=".jpg,.jpeg,.png,.pdf"
                                            onchange="handleImagePreview(this)">
                                        @if(!empty($attestation->citizenshipFront))
                                        <img src="{{ asset($attestation->citizenshipFront) }}" alt=""
                                            class="img-fluid img mt-2 rounded" style="width:250px; height:250px; object-fit:contain;">
                                        @endif
                                    </div>

                                    <!-- Citizenship Back -->
                                    <div class="col">
                                        <label for="citizenshipBack" class="form-label fs-6">Citizenship Back:<span class="text-danger  fw-bold">*</span></label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf format)</label>
                                        <input type="file" class="form-control" id="citizenshipBack"
                                            name="citizenshipBack" accept=".jpg,.jpeg,.png,.pdf"
                                            onchange="handleImagePreview(this)">
                                        @if(!empty($attestation->citizenshipBack))
                                        <img src="{{ asset($attestation->citizenshipBack) }}" alt=""
                                            class="img-fluid img mt-2 rounded" style="width:250px; height:250px; object-fit:contain;">
                                        @endif
                                    </div>

                                    <!-- Passport -->
                                    <div class="col">
                                        <label for="passport" class="form-label fs-6">Passport:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf format)</label>
                                        <input type="file" class="form-control" id="passport"
                                            name="passport" accept=".jpg,.jpeg,.png,.pdf"
                                            onchange="handleImagePreview(this)">
                                        @if(!empty($attestation->passport))
                                        <img src="{{ asset($attestation->passport) }}" alt=""
                                            class="img-fluid img mt-2 rounded" style="width:250px; height:250px; object-fit:contain;">
                                        @endif
                                    </div>

                                    <!-- Photo -->
                                    <div class="col">
                                        <label for="photo" class="form-label fs-6">Passport-size Photo:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf format)</label>
                                        <input type="file" class="form-control" id="photo"
                                            name="photo" accept=".jpg,.jpeg,.png,.pdf"
                                            onchange="handleImagePreview(this)">
                                        @if(!empty($attestation->photo))
                                        <img src="{{ asset($attestation->photo) }}" alt=""
                                            class="img-fluid img mt-2 rounded" style="width:250px; height:250px; object-fit:contain;">
                                        @endif
                                    </div>

                                    <!-- Documents 1-4 -->
                                    <div class="col">
                                        <label for="document1" class="form-label fs-6">Document to be attestated I:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf format)</label>
                                        <input type="file" class="form-control" id="document1"
                                            name="document1" accept=".jpg,.jpeg,.png,.pdf"
                                            onchange="handleImagePreview(this)">
                                        @if(!empty($attestation->document1))
                                        <img src="{{ asset($attestation->document1) }}" alt=""
                                            class="img-fluid img mt-2 rounded" style="width:250px; height:250px; object-fit:contain;">
                                        @endif
                                    </div>

                                    <div class="col">
                                        <label for="document2" class="form-label fs-6">Document to be attestated II>:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf format)</label>
                                        <input type="file" class="form-control" id="document2"
                                            name="document2" accept=".jpg,.jpeg,.png,.pdf"
                                            onchange="handleImagePreview(this)">
                                        @if(!empty($attestation->document2))
                                        <img src="{{ asset($attestation->document2) }}" alt=""
                                            class="img-fluid img mt-2 rounded" style="width:250px; height:250px; object-fit:contain;">
                                        @endif
                                    </div>

                                    <div class="col">
                                        <label for="document3" class="form-label fs-6">Document to be attestated III:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf format)</label>
                                        <input type="file" class="form-control" id="document3"
                                            name="document3" accept=".jpg,.jpeg,.png,.pdf"
                                            onchange="handleImagePreview(this)">
                                        @if(!empty($attestation->document3))
                                        <img src="{{ asset($attestation->document3) }}" alt=""
                                            class="img-fluid img mt-2 rounded" style="width:250px; height:250px; object-fit:contain;">
                                        @endif
                                    </div>

                                    <div class="col">
                                        <label for="document4" class="form-label fs-6">Document to be attestated IV:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf format)</label>
                                        <input type="file" class="form-control" id="document4"
                                            name="document4" accept=".jpg,.jpeg,.png,.pdf"
                                            onchange="handleImagePreview(this)">
                                        @if(!empty($attestation->document4))
                                        <img src="{{ asset($attestation->document4) }}" alt=""
                                            class="img-fluid img mt-2 rounded" style="width:250px; height:250px; object-fit:contain;">
                                        @endif
                                    </div>
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
                                <span class="required"></span> I agree to the Terms and Conditions and Privacy Policy of Kamsansar's Document Attestaion service.
                            </label>
                        </div>
                        <div class="required-fields-message text-danger fw-bold fw-bold">* - Required fields -
                            Please
                            fill all
                            required fields before proceeding.</div>
                    </div>
                    <div class="d-flex justify-content-end py-4">
                        <button type="submit" class="btn btn" id="submitBtn" disabled style="background-color: #0064a7; color: white;">
                            Update Appication
                        </button>
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

    function handleForm1Next() {
        const isValid = validateForm1();
        if (isValid) {
            showNextForm(2);
        }
    }

    function validateForm1() {
        const requiredFields = document.querySelectorAll('#multiStepForm1 [required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('error');

                field.style.transition = 'border 0.3s ease';
                field.style.border = '2px solid red';
                window.scrollTo({
                    top: 10,
                    behavior: 'smooth'
                })
                setTimeout(() => {
                    field.style.border = '';
                    field.style.transition = '';
                }, 4000);

                isValid = false;
            } else {
                field.classList.remove('error');
                field.style.border = '';
                field.style.transition = '';
            }
        });

        return isValid;
    }

    function handleForm2Next() {
        const isValid = validateForm2();
        if (isValid) {
            showNextForm(3);
        }
    }

    function validateForm2() {
        const requiredFields = document.querySelectorAll('#multiStepForm2 [required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('error');

                field.style.transition = 'border 0.3s ease';
                field.style.border = '2px solid red';

                setTimeout(() => {
                    field.style.border = '';
                    field.style.transition = '';
                }, 2000);

                isValid = false;
            } else {
                field.classList.remove('error');
                field.style.border = '';
                field.style.transition = '';
            }
        });

        return isValid;
    }



    document.getElementById('submitBtn').addEventListener('click', function(e) {

        let hasError = false;

        // Check all required fields
        const fields = document.getElementById('multiStepForm3').querySelectorAll('[required]');

        fields.forEach(field => {
            //field.style.transition = 'border 0.3s ease';

            if (!field.value.trim()) {
                // field.classList.add('is-invalid')
                field.classList.add('error');
                field.style.transition = 'border 0.3s ease';
                field.style.border = '2px solid red';
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

    document.addEventListener('DOMContentLoaded', function() {
        const checkCorrect = document.getElementById('checkCorrect');
        const checkTerms = document.getElementById('checkTerms');
        const submitBtn = document.getElementById('submitBtn');

        function toggleSubmitButton() {
            submitBtn.disabled = !(checkCorrect.checked && checkTerms.checked);
        }

        checkCorrect.addEventListener('change', toggleSubmitButton);
        checkTerms.addEventListener('change', toggleSubmitButton);

        const applicantCountrySelect = document.getElementById("applicantCountry");
        const attestationCountrySelect = document.getElementById("attestationCountry");

        fetch("https://restcountries.com/v3.1/all")
            .then(response => response.json())
            .then(countries => {
                // Sort countries alphabetically by name
                countries.sort((a, b) => a.name.common.localeCompare(b.name.common));

                countries.forEach(country => {
                    const option1 = document.createElement("option");
                    option1.value = country.name.common;
                    option1.textContent = country.name.common;

                    const option2 = option1.cloneNode(true); // Clone for second dropdown

                    applicantCountrySelect.appendChild(option1);
                    attestationCountrySelect.appendChild(option2);
                });
            })
            .catch(error => {
                console.error("Error fetching countries:", error);
            });
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

@endsection