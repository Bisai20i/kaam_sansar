
@section('title', 'Bank Account')

@section('content')


<section class="prform mt-4">
    <div class="container-fluid container-lg">
        <div id="form-container"
            class="container-fluid container-lg border border-1 border-dark-subtle rounded-4 p-md-5 py-5">

            <!-- Form 1 - Personal Information -->
            <div id="moneyexchangeForm1" class="multi-step-form">
                <div class="d-flex">
                    <div class="col text-center">
                        <h3 style="color:#0064a7;">Account Opening Form</h3>
                    </div>
                </div>

                <div class="mt-4">
                    <form id="bankAccount" class="p-3">
                        <!-- Applicant Type Section -->
                        <div class="attestation">
                            <div class="">
                                <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block">Applicant Type</h4>
                            </div>
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                <div class="col">
                                    <label class="form-label fs-6">Applicant Type:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->applicantType ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Salutation:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->salutation ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Nepali Citizen:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->nepaleseCitizen ? 'Yes' : 'No' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Applicant Purpose:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->applicantPurpose ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Preferred Bank:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->preferredBank ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Branch:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->branch ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Details Section -->
                        <div class="attestation">
                            <div class="">
                                <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Personal Details</h4>
                            </div>
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                <div class="col">
                                    <label class="form-label fs-6">First Name:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->firstName ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Middle Name:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->middleName ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Last Name:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->lastName ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Mobile Number:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->mobileNumber ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Phone Number:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->phoneNumber ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Email Address:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->email ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Date of Birth (BS):</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->nepaliDob ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Date of Birth (AD):</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->englishDob ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Apply From Country:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->applyFromCountry ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Contact Medium:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->contactMedium ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Other Contact Details:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->otherContactDetail ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Family Details Section -->
                        <div class="attestation">
                            <div class="">
                                <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Family Details</h4>
                            </div>
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                <div class="col">
                                    <label class="form-label fs-6">Father's Name:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->fatherName ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Mother's Name:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->motherName ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Grandfather's Name:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->grandfatherName ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Spouse Name:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->spouse ?? 'N/A' }}</div>
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
                                    <label class="form-label fs-6">Country:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->permanentcountry ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Province:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->permanentProvince ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">District:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->permanentDistrict ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Municipality:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->permanentMunicipality ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">City:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->permanentCity ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Ward No:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->permanentWardNo ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Street:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->permanentWStreet ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">State:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->permanentState ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Tole:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->permanentTole ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">House No:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->permanentHouseNo ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Temporary Address Section -->
                        <div class="attestation">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Temporary Address</h4>
                                </div>
                            </div>
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                <div class="col">
                                    <label class="form-label fs-6">Country:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->temporaryCountry ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Province:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->temporaryProvince ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">District:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->temporaryDistrict ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Municipality:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->temporaryMunicipality ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">City:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->temporaryCity ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Ward No:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->temporaryWardNo ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Street:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->temporaryWStreet ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">State:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->temporaryState ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Tole:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->temporaryTole ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">House No:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->temporaryHouseNo ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Job Details Section -->
                        <div class="attestation">
                            <div class="">
                                <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block">Job Details</h4>
                            </div>
                            <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                <div class="col">
                                    <label class="form-label fs-6">Job Title:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->jobTitle ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Job City:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->jobCity ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Company Name:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->companyName ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Yearly Salary:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->yearlySalary ?? 'N/A' }}</div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Monthly Salary:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">{{ $bankAccount->monthlySalary ?? 'N/A' }}</div>
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
                                    <label class="form-label fs-6">Signature Photo:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">
                                        @if($bankAccount->signature)
                                        Document Uploaded
                                        @else
                                        N/A
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label fs-6">Thumb Print Photo:</label>
                                    <div class="form-control form-control-da fs-6 bg-light">
                                        @if($bankAccount->fingerPrint)
                                        Document Uploaded
                                        @else
                                        N/A
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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