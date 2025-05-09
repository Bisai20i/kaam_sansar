@extends('frontend.layouts.main')

@section('title', 'Broker Account')

@section('content')

<section class="ad_banner p-4 border border-1 border-dark-subtle mt-5 text-center mb-4">
    <h2 class="py-4">Advertisement Banner</h2>
</section>

<section class="prform mt-4">
    <div class="container-fluid container-lg">
        <div id="form-container" class="container-fluid container-lg border border-1 border-dark-subtle rounded-4 p-md-5 py-5">
            <!-- Broker Account Form -->
            <div id="brokerAccountForm" class="multi-step-form">
                <div class="d-flex">
                    <div class="col text-center">
                        <h3 style="color:#0064a7;">Broker Account Opening Form</h3>
                    </div>
                </div>
                <!-- Form 1 - Personal Information -->
                <div id="moneyexchangeForm1" class="multi-step-form" style="display: block;">
                    <div class="d-flex">
                        <div class="col text-center">
                            <h3 style="color:#0064a7;">Nepal Stock Exchange Trade Management System</h3>
                            <p class="fw-normal" style="font-size: 24px;">Online Registration Form</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <form id="brokerAccount" action="{{ route('brokerAccounts.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="jobSeekerId" value="{{ auth()->user()->id ?? '' }}">

                            <!-- Account Information Section -->
                            <div class="attestation">
                                <div class="">
                                    <h4 class="py-1 border-bottom border-2 border-primary d-inline-block" id="headingOne">Depository Details</h4>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                        <div class="col">
                                            <label for="boid" class="form-label fs-6">
                                                BOID: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-da fs-6" id="boid" name="boid" required maxlength="255">
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block">Account Information</h4>
                                </div>
                                <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                    <div class="col">
                                        <label for="referralCode" class="form-label fs-6">Referral Code:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="referralCode" name="referralCode" maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="clientType" class="form-label fs-6">Client Type <span class="text-danger">*</span>:</label>
                                        <select class="form-select form-control-da fs-6" id="clientType" name="clientType" required>
                                            <option value="">-- Select Type --</option>
                                            <option value="individual">Individual</option>
                                            <option value="institutional">Institutional</option>
                                            <option value="minor">Minor</option>
                                            <option value="foreign">Foreign</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="mobileNumber" class="form-label fs-6">Mobile Number <span class="text-danger">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="mobileNumber" name="mobileNumber" required maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="branchName" class="form-label fs-6">Branch Name <span class="text-danger">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="branchName" name="branchName" required maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="panNumber" class="form-label fs-6">PAN Number:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="panNumber" name="panNumber" maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="emailAddress" class="form-label fs-6">Email Address <span class="text-danger">*</span>:</label>
                                        <input type="email" class="form-control form-control-da fs-6" id="emailAddress" name="emailAddress" required maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="whatsappNumber" class="form-label fs-6">WhatsApp Number:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="whatsappNumber" name="whatsappNumber" maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="viberNumber" class="form-label fs-6">Viber Number:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="viberNumber" name="viberNumber" maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="facebookLink" class="form-label fs-6">Facebook Link:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="facebookLink" name="facebookLink" maxlength="255">
                                    </div>
                                </div>
                            </div>

                            <!-- Bank Details Section -->
                            <div class="attestation">
                                <div class="">
                                    <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Bank Details</h4>
                                </div>
                                <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                    <div class="col">
                                        <label for="bankName" class="form-label fs-6">Bank Name <span class="text-danger">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="bankName" name="bankName" required maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="bankBranch" class="form-label fs-6">Bank Branch <span class="text-danger">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="bankBranch" name="bankBranch" required maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="accountType" class="form-label fs-6">Account Type <span class="text-danger">*</span>:</label>
                                        <select class="form-select form-control-da fs-6" id="accountType" name="accountType" required>
                                            <option value="">-- Select Type --</option>
                                            <option value="saving">Saving</option>
                                            <option value="current">Current</option>
                                            <option value="fixed">Fixed</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="accountNumber" class="form-label fs-6">Account Number <span class="text-danger">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="accountNumber" name="accountNumber" required maxlength="255">
                                    </div>
                                </div>
                            </div>

                            <!-- Investment Information Section -->
                            <div class="attestation">
                                <div class="">
                                    <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Investment Information</h4>
                                </div>
                                <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                    <div class="col">
                                        <label for="investmentSource" class="form-label fs-6">Investment Source:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="investmentSource" name="investmentSource" maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="companyName" class="form-label fs-6">Company Name:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="companyName" name="companyName" maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="jobBusinessYears" class="form-label fs-6">Job/Business Years:</label>
                                        <input type="number" class="form-control form-control-da fs-6" id="jobBusinessYears" name="jobBusinessYears">
                                    </div>
                                    <div class="col">
                                        <label for="investmentAmount" class="form-label fs-6">Investment Amount (NPR):</label>
                                        <input type="number" step="0.01" class="form-control form-control-da fs-6" id="investmentAmount" name="investmentAmount">
                                    </div>
                                    <div class="col">
                                        <label class="form-label fs-6 d-block">Trading Knowledge:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="tradingKnowledge" id="tradingKnowledge_yes" value="1">
                                            <label class="form-check-label" for="tradingKnowledge_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="tradingKnowledge" id="tradingKnowledge_no" value="0" checked>
                                            <label class="form-check-label" for="tradingKnowledge_no">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Permanent Address Section -->
                            <div class="attestation">
                                <div class="">
                                    <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Permanent Address</h4>
                                </div>
                                <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                    <div class="col">
                                        <label for="permanentCountry" class="form-label fs-6">Country <span class="text-danger">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="permanentCountry" name="permanentCountry" required maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="permanentProvince" class="form-label fs-6">Province <span class="text-danger">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="permanentProvince" name="permanentProvince" required maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="permanentDistrict" class="form-label fs-6">District <span class="text-danger">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="permanentDistrict" name="permanentDistrict" required maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="permanentMunicipality" class="form-label fs-6">Municipality <span class="text-danger">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="permanentMunicipality" name="permanentMunicipality" required maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="permanentWard" class="form-label fs-6">Ward No <span class="text-danger">*</span>:</label>
                                        <input type="number" class="form-control form-control-da fs-6" id="permanentWard" name="permanentWard" required>
                                    </div>
                                    <div class="col">
                                        <label for="permanentCity" class="form-label fs-6">City <span class="text-danger">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="permanentCity" name="permanentCity" required maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="permanentTole" class="form-label fs-6">Tole <span class="text-danger">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="permanentTole" name="permanentTole" required maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="permanentStreet" class="form-label fs-6">Street:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="permanentStreet" name="permanentStreet" maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="permanentHouseNo" class="form-label fs-6">House No:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="permanentHouseNo" name="permanentHouseNo" maxlength="255">
                                    </div>
                                </div>
                            </div>

                            <!-- Temporary Address Section -->
                            <div class="attestation">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Temporary Address</h4>
                                    </div>
                                    <div class="form-check mt-4">
                                        <input class="form-check-input fs-6" type="checkbox" value="1" id="sameAsPermanent" name="sameAsPermanent">
                                        <label class="form-check-label fs-6" for="sameAsPermanent">Same as Permanent Address</label>
                                    </div>
                                </div>
                                <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                    <div class="col">
                                        <label for="temporaryCountry" class="form-label fs-6">Country <span class="text-danger">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="temporaryCountry" name="temporaryCountry" required maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="temporaryProvince" class="form-label fs-6">Province <span class="text-danger">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="temporaryProvince" name="temporaryProvince" required maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="temporaryDistrict" class="form-label fs-6">District <span class="text-danger">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="temporaryDistrict" name="temporaryDistrict" required maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="temporaryMunicipality" class="form-label fs-6">Municipality <span class="text-danger">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="temporaryMunicipality" name="temporaryMunicipality" required maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="temporaryWard" class="form-label fs-6">Ward No <span class="text-danger">*</span>:</label>
                                        <input type="number" class="form-control form-control-da fs-6" id="temporaryWard" name="temporaryWard" required>
                                    </div>
                                    <div class="col">
                                        <label for="temporaryCity" class="form-label fs-6">City <span class="text-danger">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="temporaryCity" name="temporaryCity" required maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="temporaryTole" class="form-label fs-6">Tole <span class="text-danger">*</span>:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="temporaryTole" name="temporaryTole" required maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="temporaryStreet" class="form-label fs-6">Street:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="temporaryStreet" name="temporaryStreet" maxlength="255">
                                    </div>
                                    <div class="col">
                                        <label for="temporaryHouseNo" class="form-label fs-6">House No:</label>
                                        <input type="text" class="form-control form-control-da fs-6" id="temporaryHouseNo" name="temporaryHouseNo" maxlength="255">
                                    </div>
                                </div>
                            </div>

                            <!-- Documents Section -->
                            <div class="attestation">
                                <div class="">
                                    <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Required Documents</h4>
                                </div>
                                <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-2 row-gap-3">
                                    <div class="col">
                                        <label for="kycForm" class="form-label fs-6">KYC Form:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                        <input type="file" class="form-control form-control-da fs-6" id="kycForm" name="kycForm" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>
                                    <div class="col">
                                        <label for="citizenCertificate" class="form-label fs-6">Citizenship Certificate <span class="text-danger">*</span>:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                        <input type="file" class="form-control form-control-da fs-6" id="citizenCertificate" name="citizenCertificate" accept=".jpg,.jpeg,.png,.pdf" required>
                                    </div>
                                    <div class="col">
                                        <label for="birthCertificate" class="form-label fs-6">Birth Certificate:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                        <input type="file" class="form-control form-control-da fs-6" id="birthCertificate" name="birthCertificate" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>
                                    <div class="col">
                                        <label for="visaPassport" class="form-label fs-6">Visa/Passport:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                        <input type="file" class="form-control form-control-da fs-6" id="visaPassport" name="visaPassport" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>
                                    <div class="col">
                                        <label for="selfieWithId" class="form-label fs-6">Selfie with ID:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                        <input type="file" class="form-control form-control-da fs-6" id="selfieWithId" name="selfieWithId" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>
                                    <div class="col">
                                        <label for="guardianCitizenship" class="form-label fs-6">Guardian Citizenship:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                        <input type="file" class="form-control form-control-da fs-6" id="guardianCitizenship" name="guardianCitizenship" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>
                                    <div class="col">
                                        <label for="ppSizePhoto" class="form-label fs-6">Passport Size Photo <span class="text-danger">*</span>:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                        <input type="file" class="form-control form-control-da fs-6" id="ppSizePhoto" name="ppSizePhoto" accept=".jpg,.jpeg,.png,.pdf" required>
                                    </div>
                                    <div class="col">
                                        <label for="tradingAgreement" class="form-label fs-6">Trading Agreement:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                        <input type="file" class="form-control form-control-da fs-6" id="tradingAgreement" name="tradingAgreement" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>
                                    <div class="col">
                                        <label for="idCard" class="form-label fs-6">ID Card:</label>
                                        <br>
                                        <label class="form-label fs-6 mb-3">(Should be in .jpg, .jpeg, .png, .pdf format)</label>
                                        <input type="file" class="form-control form-control-da fs-6" id="idCard" name="idCard" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end py-4">
                                <button type="submit" class="btn btn" style="background-color: #0064a7; color: white;">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>

<script src="{{ asset('JS/home.js') }}"></script>
<script src="{{ asset('JS/script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://preview.colorlib.com/theme/bootstrap/calendar-16/js/jquery-3.3.1.min.js"></script>
<script src="https://preview.colorlib.com/theme/bootstrap/calendar-16/js/popper.min.js"></script>
<script src="https://preview.colorlib.com/theme/bootstrap/calendar-16/js/bootstrap.min.js"></script>
<script src="https://preview.colorlib.com/theme/bootstrap/calendar-16/js/rome.js"></script>

<script src="https://preview.colorlib.com/theme/bootstrap/calendar-16/js/main.js"></script>
<script defer
    src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
    integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
    data-cf-beacon='{"rayId":"91b7e635cdf99888","serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2025.1.0","token":"cd0b4b3a733644fc843ef0b185f98241"}'
    crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Same as permanent address functionality
    $(document).ready(function() {
        $('#sameAsPermanent').change(function() {
            if (this.checked) {
                // Copy permanent address to temporary address
                $('#temporaryCountry').val($('#permanentCountry').val());
                $('#temporaryProvince').val($('#permanentProvince').val());
                $('#temporaryDistrict').val($('#permanentDistrict').val());
                $('#temporaryMunicipality').val($('#permanentMunicipality').val());
                $('#temporaryWard').val($('#permanentWard').val());
                $('#temporaryCity').val($('#permanentCity').val());
                $('#temporaryTole').val($('#permanentTole').val());
                $('#temporaryStreet').val($('#permanentStreet').val());
                $('#temporaryHouseNo').val($('#permanentHouseNo').val());

             // Optionally disable them so user can't edit
             $('#form-container .accordion-body input[id^="temporary"]').prop('readonly', true);
            } else {
                // Clear values and re-enable
                $('#form-container .accordion-body input[id^="temporary"]').val('').prop('readonly', false);
            }
        });
    });
</script>
@endsection