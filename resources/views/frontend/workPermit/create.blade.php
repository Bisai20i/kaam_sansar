@extends('frontend.layouts.main')

@section('title', 'Work Permit')
@push('head') <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')

<section class="ad_banner p-4 border border-1 border-dark-subtle mt-5 text-center mb-4">
    <h2 class="py-4">Advertisement Banner</h2>
</section>

<section class="work_permit_form">
        <div class="container-fluid container-lg">
            <div id="form-container"
                class="container-fluid container-lg border border-1 border-dark-subtle rounded-4 p-md-5 py-5 mb-5 mt-5">
                <!-- Form 1 -->
                <div id="workpermitForm1" class="multi-step-form" style="display:block;">
                    <div class="d-flex">
                        <div class="col-auto">
                            <a href="#" class="">
                                <i class="fa fa-chevron-left text-black fs-4 ms-2" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col text-center">
                            <h3 style="color:#0064a7;">Work Permit Renewed</h3>
                            <p>Complete the form to start your work permit process</p>
                        </div>


                    </div>
                    <div class="text-center my-4">
                        <div class="d-md-inline-flex justify-content-center align-items-center gap-3 bg-light fs-6">
                            <p class="p-2 rounded-2 text-white m-0" style="background-color: #0064a7;">Select Service
                                &
                                Read
                                Instructions
                            </p>
                            <p class="p-2 bg-light rounded-2 m-0">Book Appointmenr</p>
                            <p class="p-2 bg-light rounded-2 m-0">Fill Application</p>
                            <p class="p-2 bg-light rounded-2 m-0">Payment</p>
                        </div>
                    </div>
                    <div class="mt-5 border border-1 border-dark-subtle rounded-4 p-3 p-md-5">
                        <div>
                            <h5 style="color:#0064a7;">Select Service Type</h5>
                            <p>Please select one of following passport type:</p>
                            <div class="mb-3">
                                <div class="nav nav-pills mb-3 row gap-2" id="pills-tab" role="tablist">
                                    <div class="col-auto nav-item" role="presentation">
                                        <button class="nav-link  h-100 border border-1 border-dark-subtle fs-6"
                                            id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                                            type="button" role="tab" aria-controls="pills-home" aria-selected="true">New Work Permit</button>
                                    </div>
                                    <div class="col-auto nav-item" role="presentation">
                                        <button class="nav-link h-100 border border-1 border-dark-subtle fs-6"
                                            id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                                            type="button" role="tab" aria-controls="pills-home" aria-selected="true">Renew Work Permit</button>
                                    </div>
                                    <div class="col-auto nav-item" role="presentation">
                                        <button class="nav-link h-100 border border-1 border-dark-subtle fs-6"
                                            id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                                            type="button" role="tab" aria-controls="pills-home" aria-selected="true">Legalization</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <h5 style="color:#0064a7;">Read Instructions</h5>
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
                        
                        <div class="d-flex justify-content-between mt-5">
                            <button class="btn btn-light">Cancel</button>
                            <button class="btn text-white border-0" style="background-color: #0064a7;" type="button" onclick="showNextForm(2)">Next</button>
                         </div>
                    </div>

                </div>

                <!-- Form 2 -->
                <div id="workpermitForm2" class="multi-step-form" style="display:none;">
                    <div class="d-flex">
                        <div class="col-auto">
                            <a onclick="showPreviousForm(2)" style="cursor: pointer;">
                                <i class="fa fa-chevron-left fs-4 ms-2" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col text-center">
                            <h3 style="color:#0064a7;">Work Permit Renewed</h3>
                            <p>Complete the form to start your work permit renewal process</p>
                        </div>


                    </div>
                    <div class="text-center my-4">
                        <div class="d-lg-inline-flex justify-content-center align-items-center gap-3 bg-light fs-6">
                            <p class="p-2 bg-light rounded-2 m-0">Select Service &
                                Read
                                Instructions
                            </p>
                            <p class="p-2 rounded-2 text-white m-0" style="background-color: #0064a7;">Book Appointment
                            </p>
                            <p class="p-2 bg-light rounded-2 m-0">Fill Application</p>
                            <p class="p-2 bg-light rounded-2 m-0">Payment</p>
                        </div>
                    </div>
                    <div class="mt-5 border border-1 border-dark-subtle rounded-4 p-3 p-md-5">
                        <div>
                            <h4 class="text-primary mb-4">Book Appointment</h4>
                        </div>
                        <div>
                            <form action="">
                                <div class="row row-cols-2">
                                    <div class="col mb-3">
                                        <label for="app_country">Appointment Country:</label>
                                        <select class="form-select my-2" aria-label="Default select example">
                                            <option selected>Nepal</option>
                                            <option value="1">Other</option>

                                        </select>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="app_province">Appointment Province: </label>
                                        <select class="form-select my-2" aria-label="Default select example">
                                            <option selected>Gandaki</option>
                                            <option value="1">Other</option>

                                        </select>
                                    </div>

                                    <div class="col mb-3">
                                        <label for="app_district">Appointment District:</label>
                                        <select class="form-select my-2" aria-label="Default select example">
                                            <option selected>Gandaki</option>
                                            <option value="1">Other</option>

                                        </select>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="app_location">Appointment Location:</label>
                                        <select class="form-select my-2" aria-label="Default select example">
                                            <option selected>Department of Passports</option>
                                            <option value="1">Other</option>

                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <button class="btn btn-light">Cancel</button>
                            <button class="btn text-white border-0" style="background-color: #0064a7;"
                                type="button" onclick="showNextForm(3)">Next</button>
                        </div>
                    </div>

                </div>

                <!-- Form 3 -->
                <div id="workpermitForm3" class="multi-step-form" style="display: none;">
                    <div class="d-flex">
                        <div class="col-auto">
                            <a onclick="showPreviousForm(3)" style="cursor: pointer;">
                                <i class="fa fa-chevron-left fs-4 ms-2" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col text-center">
                            <h3 style="color:#0064a7;">Work Permit Renewed</h3>
                            <p>Complete the form to start your work permit renewal process</p>
                        </div>


                    </div>
                    <div class="text-center my-4">
                        <div class="d-lg-inline-flex justify-content-center align-items-center gap-3 bg-light fs-6">
                            <p class="p-2 bg-light rounded-2 m-0">Select Service &
                                Read
                                Instructions
                            </p>
                            <p class="p-2 bg-light rounded-2 m-0">Select Country
                            </p>
                            <p class="p-2 rounded-2 text-white m-0" style="background-color: #0064a7;">Fill Application
                            </p>
                            <p class="p-2 bg-light rounded-2 m-0">Payment</p>
                        </div>
                    </div>

                    <div class="mt-5 border border-1 border-dark-subtle rounded-4 p-3 p-md-5">
                        <form id="passportForm">
                            <div class="">
                                <form>
                                    <div class="work-permit">
                                        <div class="">
                                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block"
                                                id="headingOne">Personal Information</h4>
                                        </div>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            data-bs-parent="#accordionExample">
                                            <div
                                                class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">
                                                <div class="col">
                                                    <label for="first_name" class="form-label">First
                                                        Name:</label>
                                                    <input type="text" class="form-control fs-6" id="first_name"
                                                        name="first_name" required maxlength="255"
                                                        placeholder="John">
                                                </div>
                                                <div class="col">
                                                    <label for="middle_name" class="form-label" >Middle
                                                        Name:</label>
                                                    <input type="text" class="form-control fs-6" id="middle_name"
                                                        name="middle_name" maxlength="255" placeholder="Bahadur">
                                                </div>
                                                <div class="col">
                                                    <label for="last_name" class="form-label">Last
                                                        Name:</label>
                                                    <input type="text" class="form-control fs-6" id="last_name"
                                                        name="last_name" required maxlength="255" placeholder="Doe">
                                                </div>

                                                <div class="flatpickr-container flatpickr col d-flex flex-column">
                                                    <label for="date_of_birth_ad" class="mb-1">Date of
                                                        Birth
                                                        (AD):</label>
                                                    <div
                                                        class=" d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                                        <input type="text" placeholder="1990-10-01"
                                                            id="date_of_birth_ad" name="date_of_birth_ad"
                                                            class="date-picker fs-6" required>
                                                        <label for="date_of_birth_ad" class="input-button"
                                                            title="toggle" data-toggle>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24">
                                                                <path fill="#000"
                                                                    d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                                            </svg>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="flatpickr-container flatpickr col d-flex flex-column">
                                                    <label for="date_of_birth_bs" class="mb-1">Date of
                                                        Birth
                                                        (BS):</label>
                                                    <div
                                                        class=" d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 p-2 my-1">
                                                        <input type="text" placeholder="1990-10-01"
                                                            id="date_of_birth_bs" name="date_of_birth_bs"
                                                            class="date-picker fs-6" required>
                                                        <label for="date_of_birth_bs" class="input-button"
                                                            title="toggle" data-toggle>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24">
                                                                <path fill="#000"
                                                                    d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                                            </svg>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label for="birthplace" class="form-label">Birthplace(District/Country if abroad):</label>
                                                    <input type="text" class="form-control fs-6" id="birthplace"
                                                        name="birthplace" required maxlength="255" placeholder="Doe">
                                                </div>

                                                <div class="col">
                                                    <label for="gender" class="form-label">Gender</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Male</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="age" class="form-label">Age:</label>
                                                    <input type="number" class="form-control fs-6" id="age"
                                                        name="age" required maxlength="255" placeholder="Doe">
                                                </div>

                                                <div class="col">
                                                    <label for="nationality" class="form-label">Nationality</label>
                                                    <input type="text" class="form-control fs-6" id="nationality"
                                                        name="Nationality" required maxlength="255" placeholder="Nepali">
                                                </div>

                                                <div class="col">
                                                    <label for="religion" class="form-label">Religion:</label>
                                                    <input type="text" class="form-control fs-6" id="religion"
                                                        name="religion" required maxlength="255" placeholder="Hindu">
                                                </div>

                                                <div class="col">
                                                    <label for="Birth_Country" class="form-label">Birth Country:</label>
                                                    <input type="text" class="form-control fs-6" id="Birth_Country"
                                                        name="Birth_Country" required maxlength="255" placeholder="Nepal">
                                                </div>

                                                <div class="col">
                                                    <label for="father" class="form-label">Father's Name:</label>
                                                    <input type="text" class="form-control fs-6" id="father"
                                                        name="father" required maxlength="255" placeholder="Doe">
                                                </div>

                                                <div class="col">
                                                    <label for="mother" class="form-label">Mother's Name:</label>
                                                    <input type="text" class="form-control fs-6" id="mother"
                                                        name="mother" required maxlength="255" placeholder="Nepali">
                                                </div>

                                                <div class="col">
                                                    <label for="Status" class="form-label">Status:</label>
                                                    <input type="text" class="form-control fs-6" id="Status"
                                                        name="Status" required maxlength="255" placeholder="Single">
                                                </div>

                                                <div class="col">
                                                    <label for="spouse" class="form-label">Spouse Name:</label>
                                                    <input type="text" class="form-control fs-6" id="spouse_name"
                                                        name="spouse" required maxlength="255" placeholder="Simran Ale">
                                                </div>

                                                <div class="col">
                                                    <label for="child" class="form-label">No. of Children:</label>
                                                    <input type="number" class="form-control fs-6" id="child"
                                                        name="child" required maxlength="255" placeholder="4">
                                                </div>

                                                <div class="col">
                                                    <label for="Spouse_age" class="form-label">Spouse Age:</label>
                                                    <input type="number" class="form-control fs-6" id="Spouse_age"
                                                        name="Spouse_age" required maxlength="255" placeholder="40">
                                                </div>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="Bank Details">
                                        <div class="">
                                            <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block"
                                                id="headingOne">Bank Details</h4>
                                        </div>
                                        <div
                                            class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                            <div class="col">
                                                <label for="Bank_Account" class="form-label">Bank Account:</label>
                                                <select class="form-select form-control fs-6" aria-label="Default select example">
                                                    <option selected>Self</option>
                                                </select>
                                            </div>

                                            <div class="col">
                                                <label for="bank_name" class="form-label fs-6">
                                                    Bank Name: </label>
                                                <input type="text" class="form-control form-control-da fs-6" id="bank_name"
                                                    name="bank_name" required maxlength="255"
                                                    placeholder="Nabil Bank">
                                            </div>

                                            <div class="col">
                                                <label for="Account-Type" class="form-label">Account Type:</label>
                                                <select class="form-select form-control fs-6" aria-label="Default select example">
                                                    <option selected>Saving</option>
                                                </select>
                                            </div>

                                            <div class="col">
                                                <label for="Bank_Branch" class="form-label">Bank Branch:</label>
                                                <select class="form-select form-control fs-6" aria-label="Default select example">
                                                    <option selected>Amarsingh</option>
                                                </select>
                                            </div>

                                            <div class="col">
                                                <label for="bank_no" class="form-label fs-6">
                                                    Bank No: </label>
                                                <input type="number" class="form-control form-control-da fs-6" id="bank_no"
                                                    name="bank_no" required maxlength="255"
                                                    placeholder="00000000000">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="citizenship_info">
                                        <div class="">
                                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block"
                                                id="headingOne">Citizenship Information</h4>
                                        </div>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            data-bs-parent="#accordionExample">
                                            <div
                                                class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">
                                                <div class="col">
                                                    <label for="NIN" class="form-label">National Identity No (NIN-Only Digits):</label>
                                                    <input type="number" class="form-control fs-6" id="NIN"
                                                        name="NIN" required maxlength="255"
                                                        placeholder="1234567890">
                                                </div>
                                                <div class="col">
                                                    <label for="Citizenship_Num" class="form-label">Citizenship or Permit Number:</label>
                                                    <input type="number" class="form-control fs-6" id="Citizenship_Num"
                                                        name="Citizenship_Num" required maxlength="255"
                                                        placeholder="1234567890">
                                                </div>

                                                <div class="flatpickr-container flatpickr col d-flex flex-column">
                                                    <label for="date_of_birth_ad" class="mb-1">Citizenship Date of Issue (AD/BS):</label>
                                                    <div
                                                        class=" d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                                        <input type="text" placeholder="1990-10-01"
                                                            id="date_of_birth_ad" name="date_of_birth_ad"
                                                            class="date-picker fs-6" required>
                                                        <label for="date_of_birth_ad" class="input-button"
                                                            title="toggle" data-toggle>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24">
                                                                <path fill="#000"
                                                                    d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                                            </svg>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label for="citizen_district" class="form-label fs-6">
                                                        Citizenship Place of Issue (District): </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="citizen_district"
                                                        name="citizen_district" required maxlength="255"
                                                        placeholder="Kaksi">
                                                </div>


                                                <div class="col">
                                                    <label for="citizen_abroad" class="form-label fs-6">
                                                        Citizenship Place of Issue (Id=f Abroad): </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="citizen_district"
                                                        name="citizen_district" required maxlength="255"
                                                        placeholder="India">
                                                </div>

                                               
                                                </div>
                                            </div>
                                    </div>

                                    <div class="Company Info">
                                            <div class="">
                                                <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block"
                                                    id="headingOne">Company Info</h4>
                                            </div>
                                            <div
                                                class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                                <div class="col">
                                                    <label for="Country" class="form-label">Country:</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Nepal</option>
                                                    </select>
                                                </div>
    
                                                <div class="col">
                                                    <label for="company_name" class="form-label fs-6">
                                                        Company Name: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="company_name"
                                                        name="company_name" required maxlength="255"
                                                        placeholder="TukiSoft">
                                                </div>
    
                                                <div class="col">
                                                    <label for="Currency" class="form-label">Currency:</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Nepalese Rupee</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="Facility Details">
                                            <div class="">
                                                <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block"
                                                    id="headingOne">Facility Details</h4>
                                            </div>
                                            <div
                                                class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                                <div class="col">
                                                    <label for="skill" class="form-label fs-6">
                                                        Skill: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="skill"
                                                        name="skill" required maxlength="255"
                                                        placeholder="Enter Skill">
                                                </div>

                                                <div class="col">
                                                    <label for="Salary" class="form-label fs-6">
                                                        Salary: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="Salary"
                                                        name="Salary" required maxlength="255"
                                                        placeholder="Enter Salary">
                                                </div>

                                                <div class="col">
                                                    <label for="Work_Type" class="form-label fs-6">
                                                        Work Type: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="Work_Type"
                                                        name="Work_Type" required maxlength="255"
                                                        placeholder="Enter Work Type">
                                                </div>

                                                <div class="col">
                                                    <label for="Food" class="form-label">Food:</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>No</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="Accomodation" class="form-label">Accomodation:</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>No</option>
                                                    </select>
                                                </div>
    
                                                <div class="col">
                                                    <label for="daily-work-hour" class="form-label fs-6">
                                                        Daily Work Hour: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="daily-work-hour"
                                                        name="daily-work-hour" required maxlength="255"
                                                        placeholder="8">
                                                </div>

                                                <div class="col">
                                                    <label for="weekly-work-hour" class="form-label fs-6">
                                                        Weekly Work Day: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="weekly-work-hour"
                                                        name="weekly-work-hour" required maxlength="255"
                                                        placeholder="Monday">
                                                </div>
    
                                                <div class="col">
                                                    <label for="Over Time" class="form-label">Over Time:</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>No</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="Other Allowance" class="form-label">Other Allowance:</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="Other Faciility">
                                            <div class="">
                                                <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block"
                                                    id="headingOne">Other Faciility</h4>
                                            </div>
                                            <div
                                                class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                                <div class="col">
                                                    <label for="Transportation" class="form-label">Transportation:</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>No</option>
                                                    </select>
                                                </div>
    
                                                <div class="col">
                                                    <label for="Health Insurance" class="form-label">Health Insurance:</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="Visa_info">
                                            <div class="">
                                                <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block"
                                                    id="headingOne">Visa Information</h4>
                                            </div>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                data-bs-parent="#accordionExample">
                                                <div
                                                    class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">
                                                    <div class="col">
                                                        <label for="NIN" class="form-label">Visa No:</label>
                                                        <input type="number" class="form-control fs-6" id="NIN"
                                                            name="NIN" required maxlength="255"
                                                            placeholder="Enter Visa No.">
                                                    </div>
                                                    <div class="col">
                                                        <label for="Citizenship_Num" class="form-label">Citizenship or Permit Number:</label>
                                                        <input type="number" class="form-control fs-6" id="Citizenship_Num"
                                                            name="Citizenship_Num" required maxlength="255"
                                                            placeholder="1234567890">
                                                    </div>
    
                                                    <div class="flatpickr-container flatpickr col d-flex flex-column">
                                                        <label for="date_of_birth_ad" class="mb-1">Citizenship Date of Issue (AD/BS):</label>
                                                        <div
                                                            class=" d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                                            <input type="text" placeholder="1990-10-01"
                                                                id="date_of_birth_ad" name="date_of_birth_ad"
                                                                class="date-picker fs-6" required>
                                                            <label for="date_of_birth_ad" class="input-button"
                                                                title="toggle" data-toggle>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24">
                                                                    <path fill="#000"
                                                                        d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                                                </svg>
                                                            </label>
                                                        </div>
                                                    </div>
    
                                                    <div class="col">
                                                        <label for="citizen_district" class="form-label fs-6">
                                                            Citizenship Place of Issue (District): </label>
                                                        <input type="text" class="form-control form-control-da fs-6" id="citizen_district"
                                                            name="citizen_district" required maxlength="255"
                                                            placeholder="Kaksi">
                                                    </div>

                                                    <div class="col">
                                                        <label for="citizen_district" class="form-label fs-6">
                                                            Citizenship Place of Issue (Abroad): </label>
                                                        <input type="text" class="form-control form-control-da fs-6" id="citizen_district"
                                                            name="citizen_district" required maxlength="255"
                                                            placeholder="India">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                  
                                    
                                    <div class="Nominee Info">
                                            <div class="">
                                                <h4 class="pt-4 pb-1 border-bottom border-2 border-primary d-inline-block"
                                                    id="headingOne">Nominee Info</h4>
                                            </div>
                                            <div
                                                class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                                
                                                <div class="col">
                                                    <label for="Nominee" class="form-label">Import Nominee:</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Spouse</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="Nominee_Name" class="form-label fs-6">
                                                        Nominee Name: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="Nominee_Name"
                                                        name="Nominee_Name" required maxlength="255"
                                                        placeholder="Hari Maya">
                                                </div>

                                                <div class="col">
                                                    <label for="Nominee_Relation" class="form-label fs-6">
                                                        Nominee Relation: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="Nominee_Relation"
                                                        name="Nominee_Relation" required maxlength="255"
                                                        placeholder="Spouse">
                                                </div>

                                                <div class="col">
                                                    <label for="Country" class="form-label fs-6">
                                                        Country: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="Country"
                                                        name="Country" required maxlength="255"
                                                        placeholder="Nepal">
                                                </div>

                                                <div class="col">
                                                    <label for="Province" class="form-label">Province:</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Gandaki</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="District" class="form-label fs-6">
                                                        District: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="District"
                                                        name="District" required maxlength="255"
                                                        placeholder="Enter District">
                                                </div>

    
                                                <div class="col">
                                                    <label for="city" class="form-label fs-6">
                                                        City: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="city"
                                                        name="city" required maxlength="255"
                                                        placeholder="Pokhara ">
                                                </div>

                                                <div class="col">
                                                    <label for="email" class="form-label fs-6">
                                                       Email Address: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="email"
                                                        name="email" required maxlength="255"
                                                        placeholder="Monday">
                                                </div>

                                                <div class="col">
                                                    <label for="phone" class="form-label fs-6">
                                                       Phone Number: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="phone"
                                                        name="phone" required maxlength="255"
                                                        placeholder="1234567890">
                                                </div>
    
                                               
                                            </div>
                                    </div>

                                    <div class="Passport_info">
                                        <div class="">
                                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block"
                                                id="headingOne">Passport Information</h4>
                                        </div>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            data-bs-parent="#accordionExample">
                                            <div
                                                class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">
                                                <div class="col">
                                                    <label for="pp_num" class="form-label">Passport Number:</label>
                                                    <input type="number" class="form-control fs-6" id="pp_num"
                                                        name="pp_num" required maxlength="255"
                                                        placeholder="XXXXXXXXXXXXXXXX">
                                                </div>

                                                <div class="col">
                                                    <label for="Nominee" class="form-label">Passport Type:</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Nepali</option>
                                                    </select>
                                                </div>

                                                <div class="flatpickr-container flatpickr col d-flex flex-column">
                                                    <label for="date_of_birth_ad" class="mb-1">Issue Date:</label>
                                                    <div
                                                        class=" d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                                        <input type="text" placeholder="1990-10-01"
                                                            id="date_of_birth_ad" name="date_of_birth_ad"
                                                            class="date-picker fs-6" required>
                                                        <label for="date_of_birth_ad" class="input-button"
                                                            title="toggle" data-toggle>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24">
                                                                <path fill="#000"
                                                                    d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                                            </svg>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="flatpickr-container flatpickr col d-flex flex-column">
                                                    <label for="date_of_birth_ad" class="mb-1">Expiry Date:</label>
                                                    <div
                                                        class=" d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                                        <input type="text" placeholder="1990-10-01"
                                                            id="date_of_birth_ad" name="date_of_birth_ad"
                                                            class="date-picker fs-6" required>
                                                        <label for="date_of_birth_ad" class="input-button"
                                                            title="toggle" data-toggle>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24">
                                                                <path fill="#000"
                                                                    d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                                            </svg>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label for="pp_issue" class="form-label fs-6">
                                                        Place of Issue: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="pp_issue"
                                                        name="pp_issue" required maxlength="255"
                                                        placeholder="Kaksi">
                                                </div>


                                                <div class="col">
                                                    <label for="issue_authority" class="form-label fs-6">
                                                       Issuing Authority: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="issue_authority"
                                                        name="issue_authority" required maxlength="255"
                                                        placeholder="Department of Foreign Affairs">
                                                </div>

                                               
                                                </div>
                                            </div>
                                    </div>

                                    <div class="Contact_info">
                                        <div class="">
                                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block"
                                                id="headingOne">Contact Information</h4>
                                        </div>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            data-bs-parent="#accordionExample">
                                            <div
                                                class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">
                                                <div class="col">
                                                    <label for="email" class="form-label">Email Number:</label>
                                                    <input type="text" class="form-control fs-6" id="email"
                                                        name="email" required maxlength="255"
                                                        placeholder="dev@gmail.com">
                                                </div>

                                                <div class="col">
                                                    <label for="Country" class="form-label">Country:</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Nepal</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="State" class="form-label">State/Province:</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Gandaki</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="district" class="form-label">District: </label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Kaski</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="city" class="form-label fs-6">
                                                        City: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="city"
                                                        name="city" required maxlength="255"
                                                        placeholder="Pokhara">
                                                </div>

                                                
                                                <div class="col">
                                                    <label for="email" class="form-label fs-6">
                                                        Email Address: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="email"
                                                        name="email" required maxlength="255"
                                                        placeholder="dev@gmail.com">
                                                </div>


                                                <div class="col">
                                                    <label for="phone" class="form-label fs-6">
                                                       Phone Number: </label>
                                                    <input type="number" class="form-control form-control-da fs-6" id="phone"
                                                        name="phone" required maxlength="255"
                                                        placeholder="1234567890">
                                                </div>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="Permanent_address">
                                        <div class="">
                                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block"
                                                id="headingOne">Permanent Address</h4>
                                        </div>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            data-bs-parent="#accordionExample">
                                            <div
                                                class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">
                                                
                                                <div class="col">
                                                    <label for="Country" class="form-label">Country:</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Nepal</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="State" class="form-label">Province:</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Gandaki</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="district" class="form-label">District: </label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Kaski</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="municipality" class="form-label">Municipality: </label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Pokhara Lekhnath</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="ward-no" class="form-label fs-6">
                                                        Ward No: </label>
                                                    <input type="number m " class="form-control form-control-da fs-6" id="ward-no"
                                                        name="ward-no" required maxlength="255"
                                                        placeholder="08">
                                                </div>

                                                <div class="col">
                                                    <label for="city" class="form-label fs-6">
                                                        City: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="city"
                                                        name="city" required maxlength="255"
                                                        placeholder="Pokhara">
                                                </div>

                                                
                                                <div class="col">
                                                    <label for="Tole" class="form-label fs-6">
                                                        Tole: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="Tole"
                                                        name="Tole" required maxlength="255"
                                                        placeholder="Rambazar">
                                                </div>

                                                <div class="col">
                                                    <label for="Street" class="form-label fs-6">
                                                        Street: </label>
                                                    <input type="number" class="form-control form-control-da fs-6" id="Street"
                                                        name="Street" required maxlength="255"
                                                        placeholder="09">
                                                </div>

                                                <div class="col">
                                                    <label for="House_no" class="form-label fs-6">
                                                        House No:: </label>
                                                    <input type="number" class="form-control form-control-da fs-6" id="House_no"
                                                        name="House_no" required maxlength="255"
                                                        placeholder="255">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="Temporary_address">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block"
                                                id="headingOne">Temporary Address</h4>

                                                <div class="form-check pt-3 pb-1">
                                                    <input class="form-check-input fs-6" type="checkbox" value="" id="checkCorrect"
                                                        required>
                                                    <label class="form-check-label fs-6" for="checkCorrect">
                                                         Same as Permanent Address
                                                    </label>
                                                </div>
                                            
                                        </div>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            data-bs-parent="#accordionExample">
                                            <div
                                                class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">
                                                
                                                <div class="col">
                                                    <label for="Country" class="form-label">Country:</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Nepal</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="State" class="form-label">Province:</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Gandaki</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="district" class="form-label">District: </label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Kaski</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="municipality" class="form-label">Municipality: </label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Pokhara Lekhnath</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="ward-no" class="form-label fs-6">
                                                        Ward No: </label>
                                                    <input type="number m " class="form-control form-control-da fs-6" id="ward-no"
                                                        name="ward-no" required maxlength="255"
                                                        placeholder="08">
                                                </div>

                                                <div class="col">
                                                    <label for="city" class="form-label fs-6">
                                                        City: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="city"
                                                        name="city" required maxlength="255"
                                                        placeholder="Pokhara">
                                                </div>

                                                
                                                <div class="col">
                                                    <label for="Tole" class="form-label fs-6">
                                                        Tole: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="Tole"
                                                        name="Tole" required maxlength="255"
                                                        placeholder="Rambazar">
                                                </div>

                                                <div class="col">
                                                    <label for="Street" class="form-label fs-6">
                                                        Street: </label>
                                                    <input type="number" class="form-control form-control-da fs-6" id="Street"
                                                        name="Street" required maxlength="255"
                                                        placeholder="09">
                                                </div>

                                                <div class="col">
                                                    <label for="House_no" class="form-label fs-6">
                                                        House No:: </label>
                                                    <input type="number" class="form-control form-control-da fs-6" id="House_no"
                                                        name="House_no" required maxlength="255"
                                                        placeholder="255">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="Emergency Contact">
                                        <div class="">
                                            <h4 class="pt-3 pb-1 border-bottom border-2 border-primary d-inline-block"
                                                id="headingOne">Emergency Contact</h4>

                                                  
                                        </div>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            data-bs-parent="#accordionExample">
                                            <div
                                                class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-2">
                                                
                                                <div class="col">
                                                    <label for="full_name" class="form-label fs-6">
                                                        Full Name: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="full_name"
                                                        name="full_name" required maxlength="255"
                                                        placeholder="Ram">
                                                </div>

                                                <div class="col">
                                                    <label for="relation" class="form-label fs-6">
                                                        Relationship: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="relation"
                                                        name="relation" required maxlength="255"
                                                        placeholder="Ram">
                                                </div>

                                                <div class="col">
                                                    <label for="Country" class="form-label">Country:</label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Nepal</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="state" class="form-label">State/Province: </label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Bagmati</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="district" class="form-label">District: </label>
                                                    <select class="form-select form-control fs-6" aria-label="Default select example">
                                                        <option selected>Kaski</option>
                                                    </select>
                                                </div>


                                                <div class="col">
                                                    <label for="city" class="form-label fs-6">
                                                        City: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="city"
                                                        name="city" required maxlength="255"
                                                        placeholder="Pokhara">
                                                </div>

                                                
                                                <div class="col">
                                                    <label for="email" class="form-label fs-6">
                                                        Email Address: </label>
                                                    <input type="text" class="form-control form-control-da fs-6" id="email"
                                                        name="email" required maxlength="255"
                                                        placeholder="ram@gmail.com">
                                                </div>

                                                <div class="col">
                                                    <label for="phone-no" class="form-label fs-6">
                                                        Phone No: </label>
                                                    <input type="number m " class="form-control form-control-da fs-6" id="phone-no"
                                                        name="phone-no" required maxlength="255"
                                                        placeholder="1234567890">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="work-documents">
                                        <div class="">
                                            <h4 class="pt-5 pb-1 border-bottom border-2 border-primary d-inline-block"
                                                id="headingOne">Required Documents</h4>
                                        </div>

                                        <div class="accordion-body row py-3 row-cols-1 row-cols-lg-2 row-gap-4 gx-5">
                                            <div class="col">
                                                <label for="pp" class="form-label fs-6">Passport Photo:</label>
                                                <br>
                                                <label class="form-label fs-6 mb-3">(Should
                                                    be in
                                                    jpg, png
                                                    or pdf
                                                    format)</label>
                                                <input type="file" class="form-control form-control-da fs-6" id="pp"
                                                    name="pp" accept=".jpg,.jpeg,.png,.pdf">
                                            </div>

                                            <div class="col">
                                                <label for="bap" class="form-label fs-6">Bank Account Photo</label>
                                                <br>
                                                <label class="form-label fs-6 mb-3">(Should
                                                    be in
                                                    jpg, png
                                                    or pdf
                                                    format)</label>
                                                <input type="file" class="form-control form-control-da fs-6" id="bpa"
                                                    name="bpa" accept=".jpg,.jpeg,.png,.pdf">
                                            </div>

                                            <div class="col">
                                                <label for="visa" class="form-label fs-6">Visa Photo:</label>
                                                <br>
                                                <label class="form-label fs-6 mb-3">(Should
                                                    be in
                                                    jpg, png
                                                    or pdf
                                                    format)</label>
                                                <input type="file" class="form-control form-control-da fs-6" id="visa"
                                                    name="visa" accept=".jpg,.jpeg,.png,.pdf">
                                            </div>

                                            <div class="col">
                                                <label for="cheque" class="form-label fs-6">Cheque Photo:</label>
                                                <br>
                                                <label class="form-label fs-6 mb-3">(Should
                                                    be in
                                                    jpg, png
                                                    or pdf
                                                    format)</label>
                                                <input type="file" class="form-control form-control-da fs-6" id="cheque"
                                                    name="cheque" accept=".jpg,.jpeg,.png,.pdf">
                                            </div>

                                            <div class="col">
                                                <label for="agreement" class="form-label fs-6">Agreement Paper Photo:</label>
                                                <br>
                                                <label class="form-label fs-6 mb-3">(Should
                                                    be in
                                                    jpg, png
                                                    or pdf
                                                    format)</label>
                                                <input type="file" class="form-control form-control-da fs-6" id="agreement" name="agreement"
                                                    accept=".jpg,.jpeg,.png,.pdf">
                                            </div>

                                            <div class="col">
                                                <label for="arrival" class="form-label fs-6">Arrival Stamp Photo:</label>
                                                <br>
                                                <label class="form-label fs-6 mb-3">(Should
                                                    be in
                                                    jpg, png
                                                    or pdf
                                                    format)</label>
                                                <input type="file" class="form-control form-control-da fs-6" id="arrival" name="arrival"
                                                    accept=".jpg,.jpeg,.png,.pdf">
                                            </div>

                                            <div class="col">
                                                <label for="embassy" class="form-label fs-6">Embassy Letter Photo:</label>
                                                <br>
                                                <label class="form-label fs-6 mb-3">(Should
                                                    be in
                                                    jpg, png
                                                    or pdf
                                                    format)</label>
                                                <input type="file" class="form-control form-control-da fs-6" id="embassy" name="embassy"
                                                    accept=".jpg,.jpeg,.png,.pdf">
                                            </div>

                                            <div class="col">
                                                <label for="departure" class="form-label fs-6">Departure Stamp Photo:</label>
                                                <br>
                                                <label class="form-label fs-6 mb-3">(Should
                                                    be in
                                                    jpg, png
                                                    or pdf
                                                    format)</label>
                                                <input type="file" class="form-control form-control-da fs-6" id="departure" name="departure"
                                                    accept=".jpg,.jpeg,.png,.pdf">
                                            </div>

                                            <div class="col">
                                                <label for="old-labor" class="form-label fs-6">Old Labor Approval Photo:</label>
                                                <br>
                                                <label class="form-label fs-6 mb-3">(Should
                                                    be in
                                                    jpg, png
                                                    or pdf
                                                    format)</label>
                                                <input type="file" class="form-control form-control-da fs-6" id="old-labor" name="old-labor"
                                                    accept=".jpg,.jpeg,.png,.pdf">
                                            </div>

                                            <div class="col">
                                                <label for="other" class="form-label fs-6">Others:</label>
                                                <br>
                                                <label class="form-label fs-6 mb-3">(Should
                                                    be in
                                                    jpg, png
                                                    or pdf
                                                    format)</label>
                                                <input type="file" class="form-control form-control-da fs-6" id="other" name="other"
                                                    accept=".jpg,.jpeg,.png,.pdf">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>



                            <div class="my-4 border border-1 border-secondary"></div>
                            <div class="d-flex flex-column mx-3 mb-5">

                                <div class="form-check">
                                    <input class="form-check-input fs-6" type="checkbox" value="" id="checkCorrect"
                                        required>
                                    <label class="form-check-label fs-6" for="checkCorrect">
                                        I confirm that all
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
                                    <input class="form-check-input fs-6" type="checkbox" value="" id="checkTerms"
                                        required>
                                    <label class="form-check-label fs-6" for="checkTerms">
                                        I agree to the Terms
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
                        </form>

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <button class="btn btn-light" type="button">Cancel</button>
                            <div class="d-block">
                                <button class="btn text-white border-0 mt-0"
                                    style="background-color: #0064a7; " type="button" form="passportForm"
                                    id="form3NextBtn" onclick="showNextForm(4)">Next</button>
                            </div>
                        </div>
                    </div>
                

                 <!-- Form 4 -->
        <div id="workpermitForm4" class="multi-step-form container" style="display:none;">
            <div class="d-flex">
                <div class="col-auto">
                    <a onclick="showPreviousForm(4)" style="cursor: pointer;">
                        <i class="fa fa-chevron-left fs-4 ms-2" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="col text-center">
                    <h3 style="color:#0064a7;">Work Permit Renewed</h3>
                    <p>Complete the form to start your work permit process</p>
                </div>


            </div>
            <div class="text-center my-4">
                <div class="d-lg-inline-flex justify-content-center align-items-center gap-3 bg-light fs-6">
                    <p class="p-2 bg-light rounded-2 m-0">Select Service &
                        Read
                        Instructions
                    </p>
                    <p class="p-2 bg-light rounded-2 m-0">Select Country
                    </p>
                    <p class="p-2 bg-light rounded-2 m-0">Fill Application
                    </p>
                    <p class="p-2 rounded-2 text-white m-0" style="background-color: #0064a7;">Payment</p>
                </div>
            </div>
            <div class="mt-5 border border-1 border-dark-subtle rounded-4 p-3 p-md-5">
                <form>
                    <div class="mb-2">
                        <h4 class="d-inline py-2" style="border-bottom: 1px solid #0064a7;">Service Summary
                        </h4>
                    </div>
                    <div class="p-lg-5">
                        <table class="table table-borderless bg-secondary">

                            <tbody>
                                <tr>
                                    <td>Service Type:</td>
                                    <td class="text-end">Work Permit Renewal</td>
                                </tr>
                                <tr>
                                    <td>Service Fee:</td>
                                    <td class="text-end">NPR 5,000</td>
                                </tr>
                                <tr>
                                    <td>Government Fee:</td>
                                    <td class="text-end">NPR 5,000</td>
                                </tr>
                                <tr class="table-bordered">
                                    <td>Kamsansar Fee:</td>
                                    <td class="text-end">NPR 5,000</td>
                                </tr>
                                <tr class="border-top">
                                    <td>Total Amount:</td>
                                    <td class="text-end fw-bold">NPR 15,000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-2">
                        <h4 class="d-inline py-2" style="border-bottom: 1px solid #0064a7;">Payment Method
                        </h4>
                    </div>

                    <div class="row row-cols-auto gap-2 payment mt-5">
                        <div class="col">
                            <input type="radio" class="btn-check" name="options-pay" id="btn-pay-1" autocomplete="off">
                            <label class="btn btn-outline-secondary fs-6 p-2 pay_btn" for="btn-pay-1"><img
                                    src="Images/esewa-logo-DA36F8FD2F-seeklogo.com 3.jpg"
                                    class="img-fluid w-100 h-100 rounded-2"></label>
                        </div>
                        <div class="col">
                            <input type="radio" class="btn-check" name="options-pay" id="btn-pay-2" autocomplete="off">
                            <label class="btn btn-outline-secondary fs-6 p-2 pay_btn" for="btn-pay-2"><img
                                    src="Images/appstore.png" class="img-fluid w-100 h-100 rounded-2"></label>
                        </div>
                        <div class="col">
                            <input type="radio" class="btn-check" name="options-pay" id="btn-pay-3" autocomplete="off">
                            <label class="btn btn-outline-secondary fs-6 p-2 pay_btn" for="btn-pay-3"><img
                                    src="Images/logolast.png" class="img-fluid w-100 h-100 rounded-2"></label>
                        </div>
                        <div class="col">
                            <input type="radio" class="btn-check" name="options-pay" id="btn-pay-4" autocomplete="off">
                            <label class="btn btn-outline-secondary fs-6 p-2 pay_btn" for="btn-pay-4"><img
                                    src="Images/esewa-logo-DA36F8FD2F-seeklogo.com 3.jpg"
                                    class="img-fluid w-100 h-100 rounded-2"></label>
                        </div>
                    </div>

                </form>

                <div class="d-flex justify-content-end mt-5">
                    <button class="btn text-white" style="background-color: #0064a7;"
                        type="button">Process payment</button>
                </div>
            </div>

        </div>
            </div>
        </div>

       
    </div>

    </section>
    <script>


// js for passport renewal form

function showNextForm(formNumber) {
    console.log("showNextForm called with formNumber:", formNumber);

    // Hide the current form
    const currentForm = document.getElementById(
        "workpermitForm" + (formNumber - 1)
    );
    if (currentForm) {
        currentForm.style.display = "none";
    }

    // Show the next form
    const nextForm = document.getElementById("workpermitForm" + formNumber);
    if (nextForm) {
        nextForm.style.display = "block";
    } else {
        console.error("Form with id 'workpermitForm" + formNumber + "' not found.");
    }
}

function showPreviousForm(formNumber) {
    console.log("showPreviousForm called with formNumber:", formNumber);

    // Hide the current form
    const currentForm = document.getElementById("workpermitForm" + formNumber);
    if (currentForm) {
        currentForm.style.display = "none";
    }

    // Show the previous form
    const previousForm = document.getElementById(
        "workpermitForm" + (formNumber - 1)
    );
    if (previousForm) {
        previousForm.style.display = "block";
    } else {
        console.error(
            "Form with id 'workpermitForm" + (formNumber - 1) + "' not found."
        );
    }
}

// function validateForm(event) {
//     event.preventDefault();

   
//     const form = document.getElementById('passportForm');
//     const nextButton = document.getElementById('form3NextBtn');

//     if (form.checkValidity()) {
        
//         showNextForm(4);
//         return true;
//     } else {
        
//         form.reportValidity();
//         return false;
//     }
// }

// Add event listener to enable/disable next button based on form validity
// document.addEventListener('DOMContentLoaded', function () {
//     const form = document.getElementById('passportForm');
//     const nextButton = document.getElementById('form3NextBtn');

//     if (form && nextButton) {
        
//         nextButton.disabled = !form.checkValidity();

       
//         form.addEventListener('input', function () {
//             nextButton.disabled = !form.checkValidity();
//         });

        
//         form.addEventListener('change', function () {
//             nextButton.disabled = !form.checkValidity();
//         });
//     }
// });

</script>
@endsection