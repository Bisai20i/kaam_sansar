@extends('frontend.giftNcoupon.giftMain')

@section('giftContent')
    <!-- Main Content -->
    <section class="prform mt-4">
        <div class="container-fluid container-lg">
            <div id="form-container"
                class="container-fluid container-lg border border-1 border-dark-subtle rounded-4 p-md-5 py-5">

                <!-- Form 1 - Personal Information -->
                <div id="moneyexchangeForm1" class="multi-step-form" style="display: block;">
                    <div class="d-flex">
                        <div class="col text-center">
                            <h3 style="color:#0064a7;">Become A Money Exchanger</h3>
                            <p>Complete the form below to start become a money exchanger</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center fs-4" id="tab-container">
                        <p id="info-tab" class="tab p-lg-2 rounded-2 bg-primary text-white m-0 px-3 py-2 ">
                            Informations
                        </p>

                        <p id="docs-tab" class="tab p-2  rounded-2 m-0 px-3 py-2" style="background-color: #F6F6F6;">
                            Documents
                        </p>

                    </div>


                    <div class="mt-3 border border-1 border-dark-subtle rounded-4 p-3 p-md-5">
                        <!-- Form 1 Content -->
                        <form id="passportForm  ">
                            <div class="attestation">
                                <div class="">
                                    <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block"
                                        id="headingOne">Personal Information</h4>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                        <div class="col">
                                            <label for="first_name" class="form-label fs-6">
                                                First Name: </label>
                                            <input type="text" class="form-control form-control-da fs-6" id="first_name"
                                                name="first_name" required maxlength="255" placeholder="@.com">
                                        </div>
                                        <div class="col">
                                            <label for="last_name" class="form-label fs-6">
                                                Last Name: </label>
                                            <input type="text" class="form-control form-control-da fs-6" id="last_name"
                                                name="last_name" required maxlength="255" placeholder="Doe">
                                        </div>
                                        <div class="col">
                                            <label for="email" class="form-label fs-6">
                                                Email Address: </label>
                                            <input type="text" class="form-control form-control-da fs-6" id="last_name"
                                                name="last_name" required maxlength="255" placeholder="Doe">
                                        </div>
                                        <div class="col">
                                            <label for="phone" class="form-label fs-6">
                                                Phone Number: </label>
                                            <input type="text" class="form-control form-control-da fs-6" id="phone"
                                                name="phone" required maxlength="255" placeholder="9876543210">
                                        </div>
                                        <div class="col">
                                            <label for="phone" class="form-label fs-6">
                                                WhatsApp Number: </label>
                                            <input type="text" class="form-control form-control-da fs-6" id="phone"
                                                name="phone" required maxlength="255" placeholder="9876543210">
                                        </div>
                                        <div class="col">
                                            <label for="country" class="form-label fs-6">Select Country:</label>
                                            <select class="form-select form-control-da fs-6" id="country" name="country"
                                                required>
                                                <option value="">-- Select Country --</option>
                                                <option value="NP">Nepal (+977)</option>
                                                <option value="IN">India (+91)</option>
                                                <option value="US">United States (+1)</option>
                                                <option value="UK">United Kingdom (+44)</option>
                                            </select>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="attestation">
                                <div class="">
                                    <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block"
                                        id="headingOne"> Bank Details</h4>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                        <div class="col">
                                            <label for="bank" class="form-label fs-6">Bank Name:</label>
                                            <select class="form-select form-control-da fs-6" id="bank" name="bank"
                                                required>
                                                <option value="">-- Bank Name --</option>
                                                <option value="Nabil Bank">Nabil Bank</option>
                                                <option value="NIC Asia">NIC Asia</option>
                                                <option value="Global IME Bank">Global IME Bank</option>
                                                <option value="Nepal Bank">Nepal Bank</option>
                                                <option value="Siddhartha Bank">Siddhartha Bank</option>
                                                <option value="Everest Bank">Everest Bank</option>
                                                <option value="Prabhu Bank">Prabhu Bank</option>
                                                <!-- Add more banks as needed -->
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="name" class="form-label fs-6">
                                                Bank Holder Name: </label>
                                            <input type="text" class="form-control form-control-da fs-6"
                                                id="name" name="name" required maxlength="255"
                                                placeholder="Tukisoft">
                                        </div>
                                        <div class="col">
                                            <label for="number" class="form-label fs-6">
                                                Bank Number </label>
                                            <input type="text" class="form-control form-control-da fs-6"
                                                id="number" name="number" required maxlength="255"
                                                placeholder="XXXXXXXXXXXXXX">
                                        </div>
                                        <div class="col">
                                            <label for="number" class="form-label fs-6">
                                                IBAN Number </label>
                                            <input type="text" class="form-control form-control-da fs-6"
                                                id="number" name="number" required maxlength="255"
                                                placeholder="XXXXXXXXXXXXXX">
                                        </div>
                                        <div class="col">
                                            <label for="number" class="form-label fs-6">
                                                Swift Code </label>
                                            <input type="text" class="form-control form-control-da fs-6"
                                                id="number" name="number" required maxlength="255"
                                                placeholder="XXXXXXXXXXXXXX">
                                        </div>
                                        <div class="col">
                                            <label for="country" class="form-label fs-6">Bank Location(Country):</label>
                                            <select class="form-select form-control-da fs-6" id="country"
                                                name="country" required>
                                                <option value="">-- Select Country --</option>
                                                <option value="NP">Nepal (+977)</option>
                                                <option value="IN">India (+91)</option>
                                                <option value="US">United States (+1)</option>
                                                <option value="UK">United Kingdom (+44)</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="country" class="form-label fs-6">Branch Location:</label>
                                            <select class="form-select form-control-da fs-6" id="country"
                                                name="country" required>
                                                <option value="">-- Select Country --</option>
                                                <option value="NP">Nepal (+977)</option>
                                                <option value="IN">India (+91)</option>
                                                <option value="US">United States (+1)</option>
                                                <option value="UK">United Kingdom (+44)</option>
                                            </select>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="attestation">
                                <div class="">
                                    <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block"
                                        id="headingOne">Bussiness Details</h4>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                        <div class="col">
                                            <label for="first_name" class="form-label fs-6">
                                                Business Name: </label>
                                            <input type="text" class="form-control form-control-da fs-6"
                                                id="first_name" name="first_name" required maxlength="255"
                                                placeholder="Tukisoft">
                                        </div>
                                        <div class="col">
                                            <label for="country" class="form-label fs-6">Bussiness Type:</label>
                                            <select class="form-select form-control-da fs-6" id="country"
                                                name="country" required>
                                                <option value="">-- Select Country --</option>
                                                <option value="NP">Nepal (+977)</option>
                                                <option value="IN">India (+91)</option>
                                                <option value="US">United States (+1)</option>
                                                <option value="UK">United Kingdom (+44)</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="address" class="form-label fs-6">
                                                Business Address: </label>
                                            <input type="number" class="form-control form-control-da fs-6"
                                                id="number" name="number" required maxlength="255"
                                                placeholder="XXXXXXXXXXXXX">
                                        </div>
                                        <div class="col">
                                            <label for="address" class="form-label fs-6">
                                                Website or Social Media Link:</label>
                                            <input type="text" class="form-control form-control-da fs-6"
                                                id="url" name="url" required maxlength="255"
                                                placeholder="URL">
                                        </div>
                                        <div class="col">
                                            <label for="email" class="form-label fs-6">
                                                Address: </label>
                                            <input type="text" class="form-control form-control-da fs-6"
                                                id="last_name" name="last_name" required maxlength="255"
                                                placeholder="XXXXXXXXXXX">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="attestation">
                                <div class="">
                                    <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block"
                                        id="headingOne"> Product Details</h4>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                        <div class="col">
                                            <label for="name" class="form-label fs-6">Product Category:</label>
                                            <select class="form-select form-control-da fs-6" id="bank"
                                                name="bank" required>
                                                <option value="">Cake</option>
                                                <option value="Nabil Bank">Nabil Bank</option>
                                                <option value="NIC Asia">NIC Asia</option>
                                                <option value="Global IME Bank">Global IME Bank</option>
                                                <option value="Nepal Bank">Nepal Bank</option>
                                                <option value="Siddhartha Bank">Siddhartha Bank</option>
                                                <option value="Everest Bank">Everest Bank</option>
                                                <option value="Prabhu Bank">Prabhu Bank</option>
                                                <!-- Add more banks as needed -->
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="time" class="form-label fs-6">Estimated Delivery Time:</label>
                                            <select class="form-select form-control-da fs-6" id="country"
                                                name="country" required>
                                                <option value="">------</option>
                                                <option value="NP">Nepal (+977)</option>
                                                <option value="IN">India (+91)</option>
                                                <option value="US">United States (+1)</option>
                                                <option value="UK">United Kingdom (+44)</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="country" class="form-label fs-6">Targeted Selling
                                                Country:</label>
                                            <select class="form-select form-control-da fs-6" id="country"
                                                name="country" required>
                                                <option value="">-- Select Country --</option>
                                                <option value="NP">Nepal (+977)</option>
                                                <option value="IN">India (+91)</option>
                                                <option value="US">United States (+1)</option>
                                                <option value="UK">United Kingdom (+44)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class=" py-5 ">
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
                        <p id="info-tab" class="tab p-lg-2 rounded-2 m-0 px-3 py-2 " style="background-color: #F6F6F6;">
                            Informations
                        </p>

                        <p id="docs-tab" class="tab p-2 bg-primary text-white  rounded-2 m-0 px-3 py-2">
                            Documents
                        </p>

                    </div>

                    <div class="mt-3 border border-1 border-dark-subtle rounded-4 p-3 p-md-5">
                        <!-- Form 2 Content -->
                        <form id="documentForm">
                            <div class="attestation">
                                <div class="">
                                    <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block"
                                        id="headingOne">Personal Documents</h4>
                                </div>

                                <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-2 row-gap-4 gx-5">
                                    <div class="col">
                                        <label for="Identify" class="form-label fs-6">Citizen</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should
                                            be in
                                            jpg, png
                                            or pdf
                                            format)</label>
                                        <input type="file" class="form-control form-control-da fs-6"
                                            id="citizenship_front" name="Identification" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>

                                    <div class="col">
                                        <label for="Visa" class="form-label fs-6">Passport</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should
                                            be in
                                            jpg, png
                                            or pdf
                                            format)</label>
                                        <input type="file" class="form-control form-control-da fs-6"
                                            id="citizenship_front" name="Visa" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>

                                    <div class="col">
                                        <label for="citizenship_front" class="form-label fs-6">Visa</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should
                                            be in
                                            jpg, png
                                            or pdf
                                            format)</label>
                                        <input type="file" class="form-control form-control-da fs-6"
                                            id="citizenship_back" name="citizenship_front" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>

                                    <div class="col">
                                        <label for="citizenship_back" class="form-label fs-6">Resident ID</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should
                                            be in
                                            jpg, png
                                            or pdf
                                            format)</label>
                                        <input type="file" class="form-control form-control-da fs-6"
                                            id="citizenship_back" name="citizenship_back" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>


                                </div>
                            </div>
                            <div class="attestation">
                                <div class="">
                                    <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block"
                                        id="headingOne">Bussiness Documents</h4>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-2 row-gap-3">
                                        <div class="col">
                                            <label for="passport" class="form-label fs-6">Registration Document
                                                1:</label>
                                            <br>
                                            <label class="form-label fs-6 mb-3">(Should
                                                be in
                                                jpg, png
                                                or pdf
                                                format)</label>
                                            <input type="file" class="form-control form-control-da fs-6"
                                                id="passport" name="passport" accept=".jpg,.jpeg,.png,.pdf">
                                        </div>
                                        <div class="col">
                                            <label for="passport" class="form-label fs-6">Registration Document
                                                1:</label>
                                            <br>
                                            <label class="form-label fs-6 mb-3">(Should                                      be in
                                                jpg, png
                                                or pdf
                                                format)</label>
                                            <input type="file" class="form-control form-control-da fs-6"
                                                id="passport" name="passport" accept=".jpg,.jpeg,.png,.pdf">
                                        </div>
                                        <div class="col">
                                            <label for="passport" class="form-label fs-6">Registration Document
                                                1:</label>
                                            <br>
                                            <label class="form-label fs-6 mb-3">(Should
                                                be in
                                                jpg, png
                                                or pdf
                                                format)</label>
                                            <input type="file" class="form-control form-control-da fs-6"
                                                id="passport" name="passport" accept=".jpg,.jpeg,.png,.pdf">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="attestation">
                                <div class="">
                                    <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block"
                                        id="headingOne"> Show Picture</h4>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-2 row-gap-3">
                                        <div class="col">
                                            <label for="passport" class="form-label fs-6">Show Pic 1:</label>
                                            <br>
                                            <label class="form-label fs-6 mb-3">(Should
                                                be in
                                                jpg, png
                                                or pdf
                                                format)</label>
                                            <input type="file" class="form-control form-control-da fs-6"
                                                id="passport" name="passport" accept=".jpg,.jpeg,.png,.pdf">
                                        </div>
                                        <div class="col">
                                            <label for="passport" class="form-label fs-6">Show Pic 1:</label>
                                            <br>
                                            <label class="form-label fs-6 mb-3">(Should
                                                be in
                                                jpg, png
                                                or pdf
                                                format)</label>
                                            <input type="file" class="form-control form-control-da fs-6"
                                                id="passport" name="passport" accept=".jpg,.jpeg,.png,.pdf">
                                        </div>
                                        <div class="col">
                                            <label for="passport" class="form-label fs-6"> Show Pic 1:</label>
                                            <br>
                                            <label class="form-label fs-6 mb-3">(Should
                                                be in
                                                jpg, png
                                                or pdf
                                                format)</label>
                                            <input type="file" class="form-control form-control-da fs-6"
                                                id="passport" name="passport" accept=".jpg,.jpeg,.png,.pdf">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                        <div class="my-4 border border-1 border-secondary"></div>
                        <div class="d-flex flex-column mx-3 mb-3">

                            <div class="form-check">
                                <input class="form-check-input fs-6" type="checkbox" value="" id="checkCorrect"
                                    required>
                                <label class="form-check-label fs-6" for="checkCorrect">
                                    I agree to the Terms and Conditions and Privacy Policy
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2 py-4 fw-semibold">
                            <button class="btn btn-light px-3" style="background-color: #EEEEEE;"
                                type="button">Cancel</button>
                            <button class="btn text-white border-0 mt-0 px-4 fw-semibold"
                                style="background-color: #0064a7;" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Form Navigation Functions
        function showNextForm(currentFormNumber) {
            // Hide current form
            document.getElementById(`moneyexchangeForm${currentFormNumber}`).style.display = 'none';
            // Show next form
            const nextFormNumber = currentFormNumber + 1;
            document.getElementById(`moneyexchangeForm${nextFormNumber}`).style.display = 'block';
        }

        function showPreviousForm(currentFormNumber) {
            // Hide current form
            document.getElementById(`moneyexchangeForm${currentFormNumber}`).style.display = 'none';
            // Show previous form
            const prevFormNumber = currentFormNumber - 1;
            document.getElementById(`moneyexchangeForm${prevFormNumber}`).style.display = 'block';
        }

        // Form Validation (Example)
        document.getElementById('passportForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add validation logic here
        });

        // Initialize any needed plugins
        document.addEventListener('DOMContentLoaded', function() {
            // Initialization code
        });
    </script>
@endpush
