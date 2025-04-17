@extends('frontend.layouts.main')

@section('title', 'Horoscope')

@section('content')
<style>
   

    .btn-check:checked+.btn {
        background-color: var(--bs-primary);
    }

    .date-picker {
        width: 100% !important;
        border: none;
    }

    .prform .form-check-input {
        border: 1px solid #000;
    }

    .prform .rd-container {
        border: none;
        padding: 0;
        box-shadow: none;
    }

    .prform .payment .pay_btn {
        width: 15rem;
        height: 6rem;
    }
</style>

<section class="ad_banner p-4 border border-1 border-dark-subtle mt-5 text-center mb-4">
    <h2 class="py-4">Advertisement Banner</h2>
</section>


<section class="prform">
    <div class="container-fluid container-lg">
        <div id="form-container"
            class="container-fluid container-lg border border-1 border-dark-subtle rounded-4 p-md-5 py-5">
            <!-- Form 1 -->
            <div id="multiStepForm1" class="multi-step-form" style="display:block;">
                <div class="d-flex">
                    <div class="col-auto">
                        <a href="#">
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
                <div class="text-center my-4">
                    <div class="d-md-inline-flex justify-content-center align-items-center gap-3 bg-light fs-4">
                        <p class="p-lg-2 rounded-2 text-white m-0" style="background-color: #0064a7;">Select Service
                            &
                            Read
                            Instructions
                        </p>
                        <p class="p-2 bg-light rounded-2 m-0">Book Appointment</p>
                        <p class="p-2 bg-light rounded-2 m-0">Fill Application</p>
                        <p class="p-2 bg-light rounded-2 m-0">Payment</p>
                    </div>
                </div>
                <div class="mt-5 border border-1 border-dark-subtle rounded-4 p-3 p-md-5">
                    <div>
                        <h2 style="color:#0064a7;">Select Service Type</h2>
                        <p class="fs-4 my-3">Please select one of following passport type:</p>
                    </div>
                    <div class="mb-3">
                        <div class="nav nav-pills mb-3 row gap-5" id="pills-tab" role="tablist">
                            <div class="col-auto nav-item" role="presentation">
                                <button class="nav-link  h-100 py-4 border border-1 border-dark-subtle fs-5"
                                    id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                                    type="button" role="tab" aria-controls="pills-home" aria-selected="true">First
                                    Issuance</button>
                            </div>
                            <div class="col-auto nav-item" role="presentation">
                                <button class="nav-link h-100 py-4 border border-1 border-dark-subtle fs-5"
                                    id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                                    type="button" role="tab" aria-controls="pills-home" aria-selected="true">Renewal
                                    Issuance</button>
                            </div>
                            <div class="col-auto nav-item" role="presentation">
                                <button class="nav-link h-100 py-4 border border-1 border-dark-subtle fs-5"
                                    id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                                    type="button" role="tab" aria-controls="pills-home" aria-selected="true">Renew
                                    Issuance</button>
                            </div>
                            <div class="col-auto nav-item" role="presentation">
                                <button class="nav-link h-100 py-4 border border-1 border-dark-subtle fs-5"
                                    id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                                    type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">Replacement</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <h2 style="color:#0064a7;">Read Instructions</h2>
                        <p class="fs-4 my-3">Read before pre-enrollment</p>
                        <p class="fs-5 text-black-50">Lorem ipsum dolor sit amet consectetur adipisicing elit.
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
                        <h3 style="color:#0064a7;">Please choose from the following available Passport Types</h3>
                        <form class="">
                            <div class="d-flex flex-column flex-md-row m-3">
                                <div class="col form-check">
                                    <input class="form-check-input fs-4" type="radio" name="option" id="option1"
                                        value="1" checked>
                                    <label class="form-check-label fs-4" for="option1">
                                        Ordinary 34 Pages
                                    </label>
                                </div>
                                <div class="col form-check">
                                    <input class="form-check-input fs-4" type="radio" name="option" id="option2"
                                        value="2">
                                    <label class="form-check-label fs-4" for="option2">
                                        Ordinary 66 Pages
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <button class="btn btn-light btn-lg py-3 px-5">Cancel</button>
                                <button class="btn btn-lg py-3 px-5 text-white btn-next"
                                    style="background-color: #0064a7;" type="button"
                                    onclick="showNextForm(2)">Next</button>
                            </div>
                        </form>

                    </div>

                </div>

            </div>

            <!-- Form 2 -->
            <div id="multiStepForm2" class="multi-step-form" style="display:none;">
                <div class="d-flex">
                    <div class="col-auto">
                        <a onclick="showPreviousForm(2)" style="cursor: pointer;">
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
                <div class="text-center my-4">
                    <div class="d-lg-inline-flex justify-content-center align-items-center gap-3 bg-light fs-4">
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
                        <h2 style="color:#0064a7;">Book Appointment</h2>

                    </div>
                    <div>
                        <form action="">
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
                                    <div class="border border-1 border-secondary-subtle
                                         rounded-4 p-4 h-100">
                                        <div class="row row-cols-auto g-4">
                                            <div class="col">
                                                <input type="radio" class="btn-check" name="options-time"
                                                    id="btn-check-1" autocomplete="off">
                                                <label class="btn btn-outline-secondary fs-5 pt-2 w-auto h-auto"
                                                    for="btn-check-1">10:30</label>
                                            </div>
                                            <div class="col">
                                                <input type="radio" class="btn-check" name="options-time"
                                                    id="btn-check-2" autocomplete="off">
                                                <label class="btn btn-outline-secondary fs-5 pt-2 w-auto h-auto"
                                                    for="btn-check-2">11:30</label>
                                            </div>
                                            <div class="col">
                                                <input type="radio" class="btn-check" name="options-time"
                                                    id="btn-check-3" autocomplete="off">
                                                <label class="btn btn-outline-secondary fs-5 pt-2 w-auto h-auto"
                                                    for="btn-check-3">12:30</label>
                                            </div>
                                            <div class="col">
                                                <input type="radio" class="btn-check" name="options-time"
                                                    id="btn-check-4" autocomplete="off">
                                                <label class="btn btn-outline-secondary fs-5 pt-2 w-auto h-auto"
                                                    for="btn-check-4">13:30</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="d-flex justify-content-between mt-5">
                        <button class="btn btn-light btn-lg py-3 px-5">Cancel</button>
                        <button class="btn btn-lg py-3 px-5 text-white btn-next" style="background-color: #0064a7;"
                            type="button" onclick="showNextForm(3)">Next</button>
                    </div>
                </div>

            </div>

            <!-- Form 3 -->
            <div id="multiStepForm3" class="multi-step-form" style="display:none;">
                <div class="d-flex">
                    <div class="col-auto">
                        <a onclick="showPreviousForm(3)" style="cursor: pointer;">
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
                <div class="text-center my-4">
                    <div class="d-lg-inline-flex justify-content-center align-items-center gap-3 bg-light fs-4">
                        <p class="p-2 bg-light rounded-2 m-0">Select Service &
                            Read
                            Instructions
                        </p>
                        <p class="p-2 bg-light rounded-2 m-0">Book Appointment
                        </p>
                        <p class="p-2 rounded-2 text-white m-0" style="background-color: #0064a7;">Fill Application
                        </p>
                        <p class="p-2 bg-light rounded-2 m-0">Payment</p>
                    </div>
                </div>

                <div class="accordion" id="accordionExample">


                    <div class="mt-5 border border-1 border-dark-subtle rounded-4 p-3 p-md-5">
                        {{-- <form>
                            <div class="accordion-item">
                                <h2 class="d-inline py-2 accordion-header">
                                    <button class="accordion-button fs-4 bg-body-tertiary" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        Personal
                                        Information</button>
                                </h2>

                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div
                                        class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                        <div class="col">
                                            <label for="firstname" class="form-label fs-5">First Name:</label>
                                            <input type="text" class="form-control" id="firstname"
                                                placeholder="John" aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <label for="midname" class="form-label fs-5">Middle Name:</label>
                                            <input type="text" class="form-control" id="midname"
                                                placeholder="Bahadur" aria-label="Middle name">
                                        </div>
                                        <div class="col">
                                            <label for="lastname" class="form-label fs-5">Last Name:</label>
                                            <input type="text" class="form-control" id="lastname" placeholder="Doe"
                                                aria-label="Last name">
                                        </div>

                                        <div class="flatpickr-container flatpickr col d-flex flex-column">
                                            <label for="dateOfBirth" class="fs-5 mb-1">Date of Birth (AD):</label>
                                            <div
                                                class=" d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                                <input type="text" placeholder="1990-10-01" id="dateOfBirth"
                                                    class="date-picker fs-6" style="outline: none;">
                                                <!-- input is mandatory -->

                                                <label for="dateOfBirth" class="input-button " title="toggle"
                                                    data-toggle>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24">
                                                        <path fill="#000"
                                                            d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                                    </svg>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="flatpickr col d-flex flex-column">
                                            <label for="datePicker2" class="fs-5 mb-1">Date of Birth (BS):</label>
                                            <div
                                                class=" d-flex border border-1 border-light-subtle justify-content-between align-items-center rounded-2 h-100 p-2 my-1">
                                                <input type="text" placeholder="1990-10-01" id="datePicker2"
                                                    class="date-picker fs-6" style="outline: none;">
                                                <!-- input is mandatory -->

                                                <label for="datePicker2" class="input-button" title="toggle"
                                                    data-toggle>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24">
                                                        <path fill="#000"
                                                            d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                                    </svg>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="birthplace" class="form-label fs-5">Birthplace (District/
                                                Country if
                                                abroad):</label>
                                            <input type="text" class="form-control" id="birthplace"
                                                placeholder="Kaski"
                                                aria-label="Birthplace (District/ Country if abroad):">
                                        </div>


                                        <div class="col">
                                            <label for="gender" class="form-label fs-5">Gender:</label>
                                            <select class="form-select fs-5" id="gender"
                                                aria-label="Default select example">
                                                <option selected>Male</option>
                                                <option value="1">Female</option>
                                                <option value="2">Other</option>

                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="age" class="form-label fs-5">Age:</label>
                                            <input type="text" class="form-control" id="age"
                                                placeholder="Enter your DOB above" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="nationality" class="form-label fs-5">Nationality:</label>
                                            <input type="text" class="form-control" id="nationality"
                                                placeholder="Nepali" aria-label="Nationality">
                                        </div>

                                        <div class="col">
                                            <label for="religion" class="form-label fs-5">Religion:</label>
                                            <input type="text" class="form-control" id="religion"
                                                placeholder="Hindu" aria-label="Religion">
                                        </div>
                                        <div class="col">
                                            <label for="birthCountry" class="form-label fs-5">Birth Country:</label>
                                            <input type="text" class="form-control" id="birthCountry"
                                                placeholder="Nepal" aria-label="Birth Country">
                                        </div>
                                        <div class="col">
                                            <label for="fathername" class="form-label fs-5">Father's Name:</label>
                                            <input type="text" class="form-control" id="fathername"
                                                placeholder="Elon Doe" aria-label="Father's Name:">
                                        </div>

                                        <div class="col">
                                            <label for="mothername" class="form-label fs-5">Mother's Name:</label>
                                            <input type="text" class="form-control" id="mothername"
                                                placeholder="Joana Doe" aria-label="Mother's Name:">
                                        </div>
                                        <div class="col">
                                            <label for="status" class="form-label fs-5">Marital Status:</label>
                                            <select class="form-select fs-5" id="status"
                                                aria-label="Default select example">
                                                <option selected>Unmarried</option>
                                                <option value="1">Married</option>
                                                <option value="2">Divorced</option>
                                                <option value="3">Widowed</option>

                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="spousename" class="form-label fs-5">Spouse's Name:</label>
                                            <input type="text" class="form-control" id="spousename"
                                                placeholder="Jane Doe" aria-label="Spouse's Name:">
                                        </div>
                                        <div class="col">
                                            <label for="noOfChildren" class="form-label fs-5">No. of
                                                Children:</label>
                                            <input type="number" class="form-control" id="noOfChildren"
                                                placeholder="2" aria-label="No. of Children">
                                        </div>
                                        <div class="col">
                                            <label for="spouseAge" class="form-label fs-5">Spouse's Age:</label>
                                            <input type="number" class="form-control" id="spouseAge"
                                                placeholder="20" aria-label="Spouse's Age:">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header d-inline py-2">
                                    <button class="accordion-button fs-4 bg-body-tertiary collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                        aria-expanded="false" aria-controls="collapseTwo">
                                        Citizenship
                                        Information</button>
                                </h2>

                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">

                                    <div
                                        class=" accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                        <div class="col">
                                            <label for="natID" class="form-label fs-5">National Identify No.
                                                (NIN-Only
                                                Digits):</label>
                                            <input type="text" class="form-control" id="natID"
                                                placeholder="XXXXXXXXX"
                                                aria-label="National Identify No(NIN-Only Digits)">
                                        </div>
                                        <div class="col">
                                            <label for="ctznNo" class="form-label fs-5">Citizenship or Permit
                                                Number:</label>
                                            <input type="text" class="form-control" id="ctznNo"
                                                placeholder="XXXXXXXX" aria-label="Citizenship or Permit Number">
                                        </div>
                                        <div class="flatpickr col d-flex flex-column">
                                            <label for="datePicker3" class="fs-5 mb-1">Citizenship Date of
                                                Issue(AD/BS):</label>
                                            <div
                                                class=" d-flex border border-1 border-secondary-subtle justify-content-between align-items-center rounded-2 p-2 my-1">
                                                <input type="text" placeholder="1990-10-01" id="datePicker3"
                                                    class="date-picker fs-6" style="outline: none;">
                                                <!-- input is mandatory -->

                                                <label for="datePicker3" class="input-button" title="toggle"
                                                    data-toggle>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24">
                                                        <path fill="#000"
                                                            d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                                    </svg>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label for="ctznPlace" class="form-label fs-5">Citizenship Place of
                                                Issue(District):</label>
                                            <input type="text" class="form-control" id="ctznPlace"
                                                placeholder="Kaski"
                                                aria-label="Citizenship Place of Issue(District)">
                                        </div>
                                        <div class="col">
                                            <label for="ctznPlaceAbroad" class="form-label fs-5">Citizenship Place
                                                of
                                                Issue(Abroad):</label>
                                            <input type="text" class="form-control" id="ctznPlaceAbroad"
                                                placeholder="Texas" aria-label="Citizenship Place of Issue(Abroad)">
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header d-inline py-2">
                                    <button class="accordion-button fs-4 bg-body-tertiary collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        Current
                                        Passport
                                        Details
                                        </h4>
                                        <div id="collapseThree" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionExample">
                                            <div
                                                class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                                <div class="col">
                                                    <label for="ppNo" class="form-label fs-5">Passport
                                                        Number:</label>
                                                    <input type="text" class="form-control" id="ppNo"
                                                        placeholder="XXXXXXXXX" aria-label="Passport Number">
                                                </div>
                                                <div class="col">
                                                    <label for="ppType" class="form-label fs-5">Pasport
                                                        Type:</label>
                                                    <select class="form-select fs-5" id="ppType"
                                                        aria-label="Pasport Type">
                                                        <option selected>Select Type</option>
                                                        <option value="1">Type 1</option>
                                                        <option value="2">Type 2</option>
                                                        <option value="3">Type 3</option>

                                                    </select>
                                                </div>
                                                <div class="flatpickr col d-flex flex-column">
                                                    <label for="datePicker4" class="fs-5 mb-1">Issue Date:</label>
                                                    <div
                                                        class=" d-flex border border-1 border-secondary-subtle justify-content-between align-items-center rounded-2 p-2 my-1">
                                                        <input type="text" placeholder="1990-10-01" id="datePicker4"
                                                            class="date-picker fs-6" style="outline: none;">
                                                        <!-- input is mandatory -->

                                                        <label for="datePicker4" class="input-button" title="toggle"
                                                            data-toggle>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24">
                                                                <path fill="#000"
                                                                    d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                                            </svg>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="flatpickr col d-flex flex-column">
                                                    <label for="datePicker5" class="fs-5 mb-1">Expiry Date:</label>
                                                    <div
                                                        class=" d-flex border border-1 border-secondary-subtle justify-content-between align-items-center rounded-2 p-2 my-1">
                                                        <input type="text" placeholder="1990-10-01" id="datePicker5"
                                                            class="date-picker fs-6" style="outline: none;">
                                                        <!-- input is mandatory -->

                                                        <label for="datePicker5" class="input-button" title="toggle"
                                                            data-toggle>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24">
                                                                <path fill="#000"
                                                                    d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                                            </svg>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label for="ppIssuePlace" class="form-label fs-5">Place of
                                                        Issue:</label>
                                                    <input type="text" class="form-control" id="ppIssuePlace"
                                                        placeholder="Nepal" aria-label="Place of Issue">
                                                </div>
                                                <div class="col">
                                                    <label for="issueAuth" class="form-label fs-5">Issuing
                                                        Authority:</label>
                                                    <input type="text" class="form-control" id="issueAuth"
                                                        placeholder="DOP" aria-label="Issuing Authority">
                                                </div>

                                            </div>
                                        </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fs-4 bg-body-tertiary collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        Contact Information
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div
                                        class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                        <div class="col">
                                            <label for="emailAdd" class="form-label fs-5">Email Address:</label>
                                            <input type="email" class="form-control" id="emailAdd"
                                                placeholder="john.doe@gmail.com" aria-label="Email Address">
                                        </div>

                                        <div class="col">
                                            <label for="ciCountry" class="form-label fs-5">Country:</label>
                                            <select class="form-select fs-5" id="ciCountry" aria-label="Country">
                                                <option selected>Nepal</option>
                                                <option value="1">USA</option>
                                                <option value="2">Other</option>
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="ciState" class="form-label fs-5">State/Province:</label>
                                            <select class="form-select fs-5" id="ciState"
                                                aria-label="State/Province">
                                                <option selected>Gandaki</option>
                                                <option value="1">Karnali</option>
                                                <option value="2">Bagmati</option>
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="ciDistrict" class="form-label fs-5">District:</label>
                                            <select class="form-select fs-5" id="ciDistrict" aria-label="District">
                                                <option selected>Kaski</option>
                                                <option value="1">Etc</option>
                                                <option value="2">Bagmati</option>
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="ciCity" class="form-label fs-5">City:</label>
                                            <input type="text" class="form-control" id="ciCity"
                                                placeholder="Pokhara" aria-label="Place of Issue">
                                        </div>

                                        <div class="col">
                                            <label for="ciPhone" class="form-label fs-5">Phone Number:</label>
                                            <input type="tel" class="form-control" id="ciPhone"
                                                placeholder="98XXXXXXXX" aria-label="Phone">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fs-4 bg-body-tertiary collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                        aria-expanded="false" aria-controls="collapseFive">
                                        Emergency Contact
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div
                                        class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                        <div class="col">
                                            <label for="ecFullName" class="form-label fs-5">Full Name:</label>
                                            <input type="text" class="form-control" id="ecFullName"
                                                placeholder="Jane Doe" aria-label="Full Name">
                                        </div>

                                        <div class="col">
                                            <label for="ecRelation" class="form-label fs-5">Relationship:</label>
                                            <input type="text" class="form-control" id="ecRelation"
                                                placeholder="Cousin" aria-label="Relationship">
                                        </div>

                                        <div class="col">
                                            <label for="ecCountry" class="form-label fs-5">Country:</label>
                                            <select class="form-select fs-5" id="ecCountry" aria-label="Country">
                                                <option selected>Nepal</option>
                                                <option value="1">Other</option>
                                                <option value="2">USA</option>
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="ecState" class="form-label fs-5">State/Province:</label>
                                            <select class="form-select fs-5" id="ecState"
                                                aria-label="State/Province">
                                                <option selected>Gandaki</option>
                                                <option value="1">Karnali</option>
                                                <option value="2">Bagmati</option>
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="ecDistrict" class="form-label fs-5">District:</label>
                                            <select class="form-select fs-5" id="ecDistrict" aria-label="District">
                                                <option selected>Kaski</option>
                                                <option value="1">Etc</option>
                                                <option value="2">Bagmati</option>
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="ecCity" class="form-label fs-5">City:</label>
                                            <input type="text" class="form-control" id="ecCity"
                                                placeholder="Pokhara" aria-label="City">
                                        </div>

                                        <div class="col">
                                            <label for="ecEmail" class="form-label fs-5">Email:</label>
                                            <input type="email" class="form-control" id="ecEmail"
                                                placeholder="contact@gmail.com" aria-label="Contact Email">
                                        </div>

                                        <div class="col">
                                            <label for="ecPhone" class="form-label fs-5">Phone Number:</label>
                                            <input type="tel" class="form-control" id="ecPhone"
                                                placeholder="98XXXXXXXX" aria-label="Phone">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fs-4 bg-body-tertiary collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                        aria-expanded="false" aria-controls="collapseSix">
                                        Required Documents
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row py-3 row-cols-1 row-cols-lg-2 row-gap-4 gx-5">
                                            <div class="col">
                                                <label for="upCitizenFront" class="form-label fs-5">Citizenship
                                                    Front:</label>
                                                <br>
                                                <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf
                                                    format)</label>
                                                <input type="file" class="form-control" id="upCitizenFront">
                                            </div>

                                            <div class="col">
                                                <label for="upCitizenBack" class="form-label fs-5">Citizenship
                                                    Back:</label>
                                                <br>
                                                <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf
                                                    format)</label>
                                                <input type="file" class="form-control" id="upCitizenBack">
                                            </div>

                                            <div class="col">
                                                <label for="upAcedemicCert" class="form-label fs-5">Academic
                                                    Certificate:</label>
                                                <br>
                                                <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf
                                                    format)</label>
                                                <input type="file" class="form-control" id="upAcedemicCert">
                                            </div>

                                            <div class="col">
                                                <label for="upMarriageRegistration" class="form-label fs-5">Marriage
                                                    Registration:</label>
                                                <br>
                                                <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf
                                                    format)</label>
                                                <input type="file" class="form-control" id="upMarriageRegistration">
                                            </div>

                                            <div class="col">
                                                <label for="upDivorceCert" class="form-label fs-5">Divorce
                                                    Certificate:</label>
                                                <br>
                                                <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf
                                                    format)</label>
                                                <input type="file" class="form-control" id="upDivorceCert">
                                            </div>

                                            <div class="col">
                                                <label for="upNatID" class="form-label fs-5">National eID:</label>
                                                <br>
                                                <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf
                                                    format)</label>
                                                <input type="file" class="form-control" id="upNatID">
                                            </div>

                                            <div class="col">
                                                <label for="upOther" class="form-label fs-5">Any Other Supporting
                                                    Document:</label>
                                                <br>
                                                <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf
                                                    format)</label>
                                                <input type="file" class="form-control" id="upOther">
                                            </div>

                                            <div class="col">
                                                <label for="upPrevPP" class="form-label fs-5">Previous
                                                    Passport:</label>
                                                <br>
                                                <label class="form-label fs-6 mb-3">(Should be in jpg, png or pdf
                                                    format)</label>
                                                <input type="file" class="form-control" id="upPrevPP">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="my-4 border border-1 border-secondary"></div>
                            <div class="d-flex flex-column mx-3 mb-5">
                                <div class="form-check">
                                    <input class="form-check-input fs-5" type="checkbox" value="" id="checkCorrect"
                                        required>
                                    <label class="form-check-label fs-5" for="checkCorrect">
                                        I confirm that all information provided is accurate and complete. I
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
                                        I agree to the Terms and Conditions and Privacy Policy of
                                        Kamsansar's
                                        passport
                                        renewal service.
                                    </label>
                                </div>
                            </div>
                        </form> --}}




                        <form id="passportRenewalForm" enctype="multipart/form-data">
                            @csrf
                            <!-- Personal Information -->
                            <div class="accordion-item">
                                <h2 class="d-inline py-2 accordion-header">
                                    <button class="accordion-button fs-4 bg-body-tertiary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Personal Information
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    <div class="accordion-body row py-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-gap-3">
                                        <!-- First Name -->
                                        <div class="col">
                                            <label for="firstname" class="form-label fs-5">First Name:</label>
                                            <input type="text" class="form-control required" id="firstname" name="first_name" placeholder="John">
                                        </div>
                                        <!-- Middle Name -->
                                        <div class="col">
                                            <label for="midname" class="form-label fs-5">Middle Name:</label>
                                            <input type="text" class="form-control" id="midname" name="middle_name" placeholder="Bahadur">
                                        </div>
                                        <!-- Last Name -->
                                        <div class="col">
                                            <label for="lastname" class="form-label fs-5">Last Name:</label>
                                            <input type="text" class="form-control required" id="lastname" name="last_name" placeholder="Doe">
                                        </div>
                                        <!-- Date of Birth (AD) -->
                                        <div class="col">
                                            <label for="dateOfBirth" class="form-label fs-5">Date of Birth (AD):</label>
                                            <input type="date" class="form-control required" id="dateOfBirth" name="date_of_birth_ad">
                                        </div>
                                        <!-- Date of Birth (BS) -->
                                        <div class="col">
                                            <label for="datePicker2" class="form-label fs-5">Date of Birth (BS):</label>
                                            <input type="date" class="form-control required" id="datePicker2" name="date_of_birth_bs">
                                        </div>
                                        <!-- Birthplace -->
                                        <div class="col">
                                            <label for="birthplace" class="form-label fs-5">Birthplace (District/Country if abroad):</label>
                                            <input type="text" class="form-control required" id="birthplace" name="birthplace" placeholder="Kaski">
                                        </div>
                                        <!-- Gender -->
                                        <div class="col">
                                            <label for="gender" class="form-label fs-5">Gender:</label>
                                            <select class="form-select required" id="gender" name="gender">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <!-- Age -->
                                        <div class="col">
                                            <label for="age" class="form-label fs-5">Age:</label>
                                            <input type="number" class="form-control required" id="age" name="age" readonly>
                                        </div>
                                        <!-- Nationality -->
                                        <div class="col">
                                            <label for="nationality" class="form-label fs-5">Nationality:</label>
                                            <input type="text" class="form-control required" id="nationality" name="nationality" placeholder="Nepali">
                                        </div>
                                        <!-- Religion -->
                                        <div class="col">
                                            <label for="religion" class="form-label fs-5">Religion:</label>
                                            <input type="text" class="form-control" id="religion" name="religion" placeholder="Hindu">
                                        </div>
                                        <!-- Birth Country -->
                                        <div class="col">
                                            <label for="birthCountry" class="form-label fs-5">Birth Country:</label>
                                            <input type="text" class="form-control required" id="birthCountry" name="birth_country" placeholder="Nepal">
                                        </div>
                                        <!-- Father's Name -->
                                        <div class="col">
                                            <label for="fathername" class="form-label fs-5">Father's Name:</label>
                                            <input type="text" class="form-control required" id="fathername" name="father_name" placeholder="Elon Doe">
                                        </div>
                                        <!-- Mother's Name -->
                                        <div class="col">
                                            <label for="mothername" class="form-label fs-5">Mother's Name:</label>
                                            <input type="text" class="form-control required" id="mothername" name="mother_name" placeholder="Joana Doe">
                                        </div>
                                        <!-- Marital Status -->
                                        <div class="col">
                                            <label for="status" class="form-label fs-5">Marital Status:</label>
                                            <select class="form-select required" id="status" name="marital_status">
                                                <option value="Unmarried">Unmarried</option>
                                                <option value="Married">Married</option>
                                                <option value="Divorced">Divorced</option>
                                                <option value="Widowed">Widowed</option>
                                            </select>
                                        </div>
                                        <!-- Spouse's Name -->
                                        <div class="col">
                                            <label for="spousename" class="form-label fs-5">Spouse's Name:</label>
                                            <input type="text" class="form-control" id="spousename" name="spouse_name" placeholder="Jane Doe">
                                        </div>
                                        <!-- Number of Children -->
                                        <div class="col">
                                            <label for="noOfChildren" class="form-label fs-5">No. of Children:</label>
                                            <input type="number" class="form-control" id="noOfChildren" name="no_of_children" placeholder="2">
                                        </div>
                                        <!-- Spouse's Age -->
                                        <div class="col">
                                            <label for="spouseAge" class="form-label fs-5">Spouse's Age:</label>
                                            <input type="number" class="form-control" id="spouseAge" name="spouse_age" placeholder="20">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Repeat similar structure for other sections (Citizenship Information, Current Passport Details, Contact Information, Emergency Contact, Required Documents) -->
                        
                            <!-- Validation Errors -->
                            <div id="validationErrors" class="alert alert-danger" style="display:none;"></div>
                        
                            <!-- Form Buttons -->
                            <div class="d-flex justify-content-between mt-2">
                                <button class="btn btn-light btn-lg py-3 px-5" type="button" onclick="resetForm()">Cancel</button>
                                <button class="btn btn-lg py-3 px-5 text-white btn-next" style="background-color: #0064a7;" type="button" onclick="submitForm()">Next</button>
                            </div>
                        </form>











                        <div class="d-flex justify-content-between mt-2">
                            <button class="btn btn-light btn-lg py-3 px-5">Cancel</button>
                            <button class="btn btn-lg py-3 px-5 text-white btn-next"
                                style="background-color: #0064a7;" type="button"
                                onclick="showNextForm(4)">Next</button>
                        </div>
                    </div>
                </div>


            </div>

            <!-- Form 4 -->
            <div id="multiStepForm4" class="multi-step-form" style="display:none;">
                <div class="d-flex">
                    <div class="col-auto">
                        <a onclick="showPreviousForm(4)" style="cursor: pointer;">
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
                <div class="text-center my-4">
                    <div class="d-lg-inline-flex justify-content-center align-items-center gap-3 bg-light fs-4">
                        <p class="p-2 bg-light rounded-2 m-0">Select Service &
                            Read
                            Instructions
                        </p>
                        <p class="p-2 bg-light rounded-2 m-0">Book Appointment
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
                            <table class="table table-borderless">

                                <tbody>
                                    <tr>
                                        <td>Service Type:</td>
                                        <td class="text-end">Passport Renewal</td>
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
                                <input type="radio" class="btn-check" name="options-pay" id="btn-pay-1"
                                    autocomplete="off">
                                <label class="btn btn-outline-secondary fs-5 p-2 pay_btn" for="btn-pay-1"><img
                                        src="Images/esewa-logo-DA36F8FD2F-seeklogo.com 3.jpg"
                                        class="img-fluid w-100 h-100 rounded-2"></label>
                            </div>
                            <div class="col">
                                <input type="radio" class="btn-check" name="options-pay" id="btn-pay-2"
                                    autocomplete="off">
                                <label class="btn btn-outline-secondary fs-5 p-2 pay_btn" for="btn-pay-2"><img
                                        src="Images/appstore.png" class="img-fluid w-100 h-100 rounded-2"></label>
                            </div>
                            <div class="col">
                                <input type="radio" class="btn-check" name="options-pay" id="btn-pay-3"
                                    autocomplete="off">
                                <label class="btn btn-outline-secondary fs-5 p-2 pay_btn" for="btn-pay-3"><img
                                        src="Images/logolast.png" class="img-fluid w-100 h-100 rounded-2"></label>
                            </div>
                            <div class="col">
                                <input type="radio" class="btn-check" name="options-pay" id="btn-pay-4"
                                    autocomplete="off">
                                <label class="btn btn-outline-secondary fs-5 p-2 pay_btn" for="btn-pay-4"><img
                                        src="Images/esewa-logo-DA36F8FD2F-seeklogo.com 3.jpg"
                                        class="img-fluid w-100 h-100 rounded-2"></label>
                            </div>
                        </div>

                    </form>

                    <div class="d-flex justify-content-end mt-5">
                        <button class="btn btn-lg py-3 px-5 text-white btn-next" style="background-color: #0064a7;"
                            type="button">Process payment</button>
                    </div>
                </div>

            </div>
        </div>


</section>

< <script src="JS/home.js"></script>
<script src="JS/script.js"></script>
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
    function submitForm() {
        if (!validateForm()) {
            $('#validationErrors').html('Please fill all required fields.').show();
            return;
        }

        const form = $('#passportRenewalForm');
        const formData = new FormData(form[0]);

        $.ajax({
            url: '#',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    window.location.href = response.redirect;
                }
            },
            error: function(xhr) {
                const errors = xhr.responseJSON.errors;
                let errorHtml = '<ul>';
                $.each(errors, function(key, value) {
                    errorHtml += '<li>' + value + '</li>';
                });
                errorHtml += '</ul>';
                $('#validationErrors').html(errorHtml).show();
            }
        });
    }

    function validateForm() {
        let isValid = true;
        $('#passportRenewalForm .required').each(function() {
            if ($(this).val() === '') {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        return isValid;
    }

    function resetForm() {
        $('#passportRenewalForm')[0].reset();
        $('#validationErrors').hide();
    }
</script>





<script>

    // datepicker initializer 
    document.addEventListener("DOMContentLoaded", function () {
        flatpickr(".date-picker", {
            dateFormat: "Y-m-d",
            allowInput: true
        });
    });


    // age calculator 
    document.addEventListener("DOMContentLoaded", function () {
        flatpickr("#dateOfBirth", {
            dateFormat: "Y-m-d",
            allowInput: true,
            onChange: function (selectedDates, dateStr, instance) {
                calculateAge(dateStr);
            }
        });
    });

    function calculateAge(dateOfBirth) {
        const birthDate = new Date(dateOfBirth);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        document.getElementById("age").value = age;
    }


    // js for passport renewal form

    function showNextForm(formNumber) {
        console.log("showNextForm called with formNumber:", formNumber);

        // Hide the current form
        const currentForm = document.getElementById(
            "multiStepForm" + (formNumber - 1)
        );
        if (currentForm) {
            currentForm.style.display = "none";
        }

        // Show the next form
        const nextForm = document.getElementById("multiStepForm" + formNumber);
        if (nextForm) {
            nextForm.style.display = "block";
        } else {
            console.error("Form with id 'multiStepForm" + formNumber + "' not found.");
        }
    }

    function showPreviousForm(formNumber) {
        console.log("showPreviousForm called with formNumber:", formNumber);

        // Hide the current form
        const currentForm = document.getElementById("multiStepForm" + formNumber);
        if (currentForm) {
            currentForm.style.display = "none";
        }

        // Show the previous form
        const previousForm = document.getElementById(
            "multiStepForm" + (formNumber - 1)
        );
        if (previousForm) {
            previousForm.style.display = "block";
        } else {
            console.error(
                "Form with id 'multiStepForm" + (formNumber - 1) + "' not found."
            );
        }
    }

</script>

@endsection
