@extends('frontend.giftNcoupon.giftMain')

@section('giftContent')
<!-- Main Content -->
<section class="prform mt-4">
    <div class="container-fluid container-lg mt-5">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('become.money_exchanger') }}" id="form-container" class="container-fluid container-lg border border-1 border-dark-subtle rounded-4 p-md-5 py-5" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Form 1 - Personal Information -->
            <div id="moneyexchangeForm1" class="multi-step-form" style="display: block;">
                <div class="d-flex">
                    <div class="col text-center">
                        <h3 style="color:#0064a7;">Become A Money Exchanger</h3>
                        <p>Complete the form below to start become a money exchanger</p>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center fs-4" id="tab-container">
                    <p id="info-tab" class="tab p-lg-2 rounded-2 bg-primary text-white m-0 px-3 py-2">
                        Informations
                    </p>

                    <p id="docs-tab" class="tab p-2 rounded-2 m-0 px-3 py-2" style="background-color: #F6F6F6;">
                        Documents
                    </p>
                </div>


                <div class="mt-3 border border-1 border-dark-subtle rounded-4 p-3 p-md-5">
                    <!-- Form 1 Content -->
                    <div id="personalInfoForm">
                        <div class="attestation">
                            <div class="">
                                <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block">Personal Information</h4>
                            </div>
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                <div class="col">
                                    <label for="first_name" class="form-label fs-6">
                                        First Name: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-da fs-6" id="first_name"
                                        name="first_name" required maxlength="255" placeholder="John">
                                </div>
                                <div class="col">
                                    <label for="last_name" class="form-label fs-6">
                                        Last Name: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-da fs-6" id="last_name"
                                        name="last_name" required maxlength="255" placeholder="Doe">
                                </div>
                                <div class="col">
                                    <label for="email" class="form-label fs-6">
                                        Email Address: </label>
                                    <input type="email" class="form-control form-control-da fs-6" id="email"
                                        name="email" maxlength="255" placeholder="john@example.com">
                                </div>
                                <div class="col">
                                    <label for="phone" class="form-label fs-6">
                                        Phone Number: <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control form-control-da fs-6" id="phone"
                                        name="phone" required maxlength="255" placeholder="9800000000">
                                </div>
                                <div class="col">
                                    <label for="whatsapp" class="form-label fs-6">
                                        WhatsApp Number: </label>
                                    <input type="tel" class="form-control form-control-da fs-6" id="whatsapp"
                                        name="whatsapp_number" maxlength="255" placeholder="9800000000">
                                </div>
                                <div class="col">
                                    <label for="country" class="form-label fs-6">Select Country: <span class="text-danger">*</span></label>
                                    <select class="form-select form-control-da fs-6" required id="country" name="country">
                                        <option value="">-- Select Country --</option>
                                        <option value="NP">Nepal (+977)</option>
                                        <option value="IN">India (+91)</option>
                                        <option value="US">United States (+1)</option>
                                        <option value="UK">United Kingdom (+44)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="attestation">
                            <div class="">
                                <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Bank Details </h4>
                            </div>
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                <div class="col">
                                    <label for="bank" class="form-label fs-6">Bank Name: <span class="text-danger">*</span></label>
                                    <select class="form-select form-control-da fs-6" id="bank" required name="bank_name">
                                        <option value="">-- Bank Name --</option>
                                        <option value="Nabil Bank">Nabil Bank</option>
                                        <option value="NIC Asia">NIC Asia</option>
                                        <option value="Global IME Bank">Global IME Bank</option>
                                        <option value="Nepal Bank">Nepal Bank</option>
                                        <option value="Siddhartha Bank">Siddhartha Bank</option>
                                        <option value="Everest Bank">Everest Bank</option>
                                        <option value="Prabhu Bank">Prabhu Bank</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="account_name" class="form-label fs-6">
                                        Bank Holder Name: <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control form-control-da fs-6" id="account_name"
                                        name="bank_holder_name" required maxlength="255" placeholder="Tukisoft">
                                </div>
                                <div class="col">
                                    <label for="account_number" class="form-label fs-6">
                                        Bank Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-da fs-6" id="account_number"
                                        name="bank_account_number" required maxlength="255" placeholder="XXXXXXXXXXXXXX">
                                </div>
                                <div class="col">
                                    <label for="iban_number" class="form-label fs-6">
                                        IBAN Number </label>
                                    <input type="text" class="form-control form-control-da fs-6" id="iban_number"
                                        name="iban_number" maxlength="255" placeholder="XXXXXXXXXXXXXX">
                                </div>
                                <div class="col">
                                    <label for="swift_code" class="form-label fs-6">
                                        Swift Code </label>
                                    <input type="text" class="form-control form-control-da fs-6" id="swift_code"
                                        name="swift_code" maxlength="255" placeholder="XXXXXXXXXXXXXX">
                                </div>
                                <div class="col">
                                    <label for="bank_country" class="form-label fs-6">Bank Location(Country): </label>
                                    <select class="form-select form-control-da fs-6" id="bank_country" name="bank_country">
                                        <option value="">-- Select Country --</option>
                                        <option value="NP">Nepal (+977)</option>
                                        <option value="IN">India (+91)</option>
                                        <option value="US">United States (+1)</option>
                                        <option value="UK">United Kingdom (+44)</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="branch_location" class="form-label fs-6">Branch Location:</label>
                                    <select class="form-select form-control-da fs-6" id="branch_location" name="branch_location">
                                        <option value="">-- Select Location --</option>
                                        <option value="Kathmandu">Kathmandu</option>
                                        <option value="Pokhara">Pokhara</option>
                                        <option value="Lalitpur">Lalitpur</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="attestation">
                            <div class="">
                                <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Business Details </h4>
                            </div>
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                <div class="col">
                                    <label for="business_name" class="form-label fs-6">
                                        Business Name: <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control form-control-da fs-6" id="business_name"
                                        name="business_name" maxlength="255" required placeholder="Tukisoft">
                                </div>

                                <div class="col">
                                    <label for="business_address" class="form-label fs-6">
                                        Business Address: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-da fs-6" id="business_address"
                                        name="business_address" maxlength="255" required placeholder="123 Business St">
                                </div>

                                <div class="col">
                                    <label for="business_telephone" class="form-label fs-6">
                                        Business Telephone: <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control form-control-da fs-6" id="business_telephone"
                                        name="business_telephone" maxlength="255" required placeholder="9800000000">
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="py-5">
                        <button class="btn text-white border-0 mt-0 px-4 fw-semibold float-end"
                            style="background-color: #0064a7;" onclick="showNextForm(1)" type="button">Next</button>
                    </div>
                </div>
            </div>

            <!-- Form 2 - Documents Upload -->
            <div id="moneyexchangeForm2" class="multi-step-form" style="display: none;">
                <div class="d-flex">
                    <div class="col-auto">
                        <a onclick="showPreviousForm(2)" style="cursor: pointer;">
                            <i class="fa fa-chevron-left text-black fs-4 ms-2"></i>
                        </a>
                    </div>
                    <div class="col text-center">
                        <h3 style="color:#0064a7;">Become A Money Exchanger</h3>
                        <p>Complete the form below to start become a money exchanger</p>
                    </div>

                </div>
                <div class="d-flex justify-content-center align-items-center fs-4" id="tab-container">
                    <p id="info-tab" class="tab p-lg-2 rounded-2 m-0 px-3 py-2" style="background-color: #F6F6F6;">
                        Informations
                    </p>

                    <p id="docs-tab" class="tab p-2 bg-primary text-white rounded-2 m-0 px-3 py-2">
                        Documents
                    </p>
                </div>

                <div class="mt-3 border border-1 border-dark-subtle rounded-4 p-3 p-md-5">
                    <!-- Form 2 Content -->
                    <div id="documentForm">
                        <div class="attestation">
                            <div class="">
                                <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block">Personal Documents </h4>
                            </div>

                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-2 row-gap-4 gx-5">
                                <div class="col">
                                    <label for="citizenship" class="form-label fs-6">Citizenship </label>
                                    <br>
                                    <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf format)</label>
                                    <input type="file" onchange="abc(this);" id="citizenship" accept=".jpg,.jpeg,.png,.pdf" >
                                    <small id="fileError" style="color: red; display: none;"></small>

                                </div>

                                <div class="col">
                                    <label for="passport" class="form-label fs-6">Passport </label>
                                    <br>
                                    <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf format)</label>
                                    <input type="file" class="form-control form-control-da fs-6"
                                        id="passport" onchange="abc(this);" name="passport_document" accept=".jpg,.jpeg,.png,.pdf">
                                    <small id="fileError" style="color: red; display: none;"></small>

                                </div>

                                <div class="col">
                                    <label for="visa" class="form-label fs-6">Visa </label>
                                    <br>
                                    <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf format)</label>
                                    <input type="file" class="form-control form-control-da fs-6"
                                        id="visa" onchange="abc(this);" name="visa_document" accept=".jpg,.jpeg,.png,.pdf">
                                    <small id="fileError" style="color: red; display: none;"></small>

                                </div>

                                <div class="col">
                                    <label for="resident_id" class="form-label fs-6">Resident ID </label>
                                    <br>
                                    <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf format)</label>
                                    <input type="file" class="form-control form-control-da fs-6"
                                        id="resident_id" onchange="abc(this);" name="resident_id_document" accept=".jpg,.jpeg,.png,.pdf">
                                    <small id="fileError" style="color: red; display: none;"></small>

                                </div>
                            </div>
                        </div>
                        <div class="attestation">
                            <div class="">
                                <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Business Documents </h4>
                            </div>
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-2 row-gap-3">
                                <div class="col">
                                    <label for="reg_doc1" class="form-label fs-6">Registration Document 1: </label>
                                    <br>
                                    <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf format)</label>
                                    <input type="file" class="form-control form-control-da fs-6" id="reg_doc1" onchange="abc(this);"
                                        name="registration_doc1" accept=".jpg,.jpeg,.png,.pdf">
                                    <small id="fileError" style="color: red; display: none;"></small>

                                </div>
                                <div class="col">
                                    <label for="reg_doc2" class="form-label fs-6">Registration Document 2:</label>
                                    <br>
                                    <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf format)</label>
                                    <input type="file" class="form-control form-control-da fs-6" id="reg_doc2"
                                        onchange="abc(this);" name="registration_doc2" accept=".jpg,.jpeg,.png,.pdf">
                                    <small id="fileError" style="color: red; display: none;"></small>

                                </div>
                                <div class="col">
                                    <label for="reg_doc3" class="form-label fs-6">Registration Document 3: </label>
                                    <br>
                                    <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf format)</label>
                                    <input type="file" class="form-control form-control-da fs-6" id="reg_doc3"
                                        onchange="abc(this);" name="registration_doc3" accept=".jpg,.jpeg,.png,.pdf">
                                    <small id="fileError" style="color: red; display: none;"></small>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="my-4 border border-1 border-secondary"></div>
                    <div class="d-flex flex-column mx-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input fs-6" type="checkbox" name="terms_accepted" value="1" id="checkCorrect" required>
                            <label class="form-check-label fs-6" for="checkCorrect">
                                I agree to the Terms and Conditions and Privacy Policy
                            </label>
                        </div>

                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-2 py-4 fw-semibold">
                        <button class="btn btn-light px-3" style="background-color: #EEEEEE;"
                            type="button" onclick="window.location.href='/giftNCoupon/home'">Cancel</button>

                        <!-- <button class="btn btn-light px-3" style="background-color: #EEEEEE;"
                            type="button" onclick="showPreviousForm(2)">Cancel</button> -->
                        <div class="col-md-1 d-grid">
                            <button class="btn btn-search w-100" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>
</section>

@endsection

@push('scripts')

<script>
    function abc(input) {
        const allowedTypes = ["image/jpeg", "image/png", "application/pdf"];
        const maxSize = 2 * 1024 * 1024; // 2MB

        const file = input.files[0];
        const errorMsg = input.nextElementSibling; // assumes <small> follows input

        errorMsg.style.display = "none";

        if (file) {
            if (!allowedTypes.includes(file.type)) {
                errorMsg.textContent = "Invalid format. Only JPG, PNG, and PDF allowed.";
                errorMsg.style.display = "block";
                input.value = ""; // reset file
            } else if (file.size > maxSize) {
                errorMsg.textContent = "File must be less than 2MB.";
                errorMsg.style.display = "block";
                input.value = ""; // reset file
            }
        }
    }
</script>


<script>
    // Form Navigation Functions
    function showNextForm(currentFormNumber) {
        const currentForm = document.getElementById(`moneyexchangeForm${currentFormNumber}`);
        if (!currentForm) return;

        const requiredFields = currentForm.querySelectorAll('[required]');
        let allValid = true;

        requiredFields.forEach(field => {
            field.classList.remove('is-invalid');
            const isCheckbox = field.type === 'checkbox';

            // Basic validation
            if (!field.value.trim()) {
                allValid = false;
                field.classList.add('is-invalid');
            }
        });

        if (!allValid) {
            const firstInvalid = currentForm.querySelector('.is-invalid');
            if (firstInvalid) firstInvalid.focus();
            return;
        }

        currentForm.style.display = 'none';
        const nextFormNumber = currentFormNumber + 1;
        const nextForm = document.getElementById(`moneyexchangeForm${nextFormNumber}`);
        if (nextForm) {
            nextForm.style.display = 'block';
        }
    }

    function showPreviousForm(currentFormNumber) {
        document.getElementById(`moneyexchangeForm${currentFormNumber}`).style.display = 'none';
        const prevFormNumber = currentFormNumber - 1;
        const prevForm = document.getElementById(`moneyexchangeForm${prevFormNumber}`);
        if (prevForm) {
            prevForm.style.display = 'block';
        }
    }

    // Optional form submit hook for final step
    document.getElementById('moneyexchangeFormFinal')?.addEventListener('submit', function(e) {
        e.preventDefault();
        // Add submission logic here
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Any JS plugin initialization, if needed
    });
</script>



@endpush