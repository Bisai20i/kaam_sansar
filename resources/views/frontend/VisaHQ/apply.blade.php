@extends('frontend.layouts.main')

@section('title', 'Visa HQ Apply')

@section('content')
    <style>
        .iti__country-list {
            max-width: 250px;
            overflow-x: hidden;
            z-index: 9999;
        }

        .invalid-feedback {
            display: block;
        }
    </style>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card justify-content-center mt-5 border-0 w-100" style="max-width: 600px;">
            <div class="card-body">
                <h2 class="text-center visa-application">Application Form</h2>

                <!-- Step Progress -->
                <div class="d-flex justify-content-around mb-3 position-relative step-container">
                    <div class="step-highlight" id="highlight"></div>
                    <button class="btn step-button active1" onclick="setActive(0)">
                        <i class="bi bi-file-earmark-text fs-2"></i>
                        <span>Application</span>
                        <span>Step 1</span>
                    </button>
                    <button class="btn step-button" onclick="setActive(1)">
                        <i class="bi bi-credit-card fs-2"></i>
                        <span>Payment</span>
                        <span>Step 2</span>
                    </button>
                </div>

                <!-- Application Form -->
                <form class="border rounded px-4" id="applicationForm" action="{{ route('visaDetails.apply.pay') }}"
                    method="POST">
                    @csrf
                    <input type="hidden" name="job_seeker_id" value="{{ Auth::guard('job_seekers')->user()->id }}">
                    <div class="row mt-3 mb-3">
                        <div class="col-md-6 col-12">
                            <label class="form-label">Full Name <span class="text-danger">(as per passport)</span></label>
                            <input type="text"
                                class="form-control{{ $errors->has('fullName') ? ' is-invalid' : '' }} visa-input" required
                                placeholder="Enter your first name" name="fullName"
                                value="{{ old('fullName', Auth::guard('job_seekers')->user()->firstName . ' ' . Auth::guard('job_seekers')->user()->lastName) }}">
                            @error('fullName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">Passport Number <span class="text-danger">(as per
                                    passport)</span></label>
                            <input type="text"
                                class="form-control visa-input {{ $errors->has('passportNumber') ? ' is-invalid' : '' }}"
                                required name="passportNumber" placeholder="Enter your Passport Number"
                                value="{{ old('passportNumber') }}">
                            @error('passportNumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-12">
                            <label class="form-label">Email</label>
                            <input type="email"
                                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} visa-input" required
                                value="{{ old('email', Auth::guard('job_seekers')->user()->emailAddress) }}" name="email"
                                placeholder="Enter your email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">Phone</label>
                            <input type="tel" name="phone" id="phoneNumber"
                                class="form-control @error('phone') is-invalid @enderror visa-input"
                                placeholder="Enter Your Phone" inputmode="numeric" pattern="[0-9]*"
                                title="Phone number should be 10 digits" autocomplete="off"
                                value="{{ old('phone', Auth::guard('job_seekers')->user()->phoneNumber) }}">
                            <input type="hidden" name="country_code" id="phoneCountryCode"
                                value="{{ old('country_code', Auth::guard('job_seekers')->user()->countryCode) }}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Visa Type</label>
                        <input type="text"
                            class="form-control {{ $errors->has('visaType') ? ' is-invalid' : '' }} visa-input"
                            value="{{ json_decode($selectedData)->visa_type->visaTypeName }}" readonly name="visaType">
                        <input type="hidden" name="visa_type_id" value="{{ json_decode($selectedData)->visa_type->id }}">
                        @error('visaType')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Citizenship (as per passport)</label>
                        <select class="form-control{{ $errors->has('citizenship') ? ' is-invalid' : '' }} visa-input"
                            required id="citizenship" name="citizenship">
                            <option value="" selected disabled>Select Country</option>
                        </select>
                        @error('citizenship')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Date of Entry</label>
                        <input type="date"
                            class="form-control{{ $errors->has('date_of_entry') ? ' is-invalid' : '' }} visa-input"
                            name="date_of_entry" value="{{ old('date_of_entry', date('Y-m-d')) }}"
                            min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+1 year')) }}">
                        @error('date_of_entry')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Image Upload Section -->
                    <div class="mb-4">
                        <label class="form-label">Upload Images (Max 2MB each, 5 images)</label>
                        <input type="file" class="form-control" id="imageUpload" name="images[]" multiple
                            accept="image/*" onchange="previewImages(event)">
                        <small class="form-text text-muted">You can upload up to 5 images, each with a maximum size of
                            2MB.</small>
                        <div id="imageError" class="text-danger mt-2" style="display:none;"></div>
                    </div>

                    <!-- Image Preview Section -->
                    <div class="image-preview" id="imagePreview" style="display: flex; gap: 10px; flex-wrap: wrap;">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-apply mb-3" onclick="saveAndProceed()">Next</button>
                    </div>
                </form>

                <!-- Payment Section (Initially hidden) -->
                <div class="px-4 rounded border d-none" id="paymentSection">
                    <div class="row mt-3 mb-3">
                        <h5 class="mb-3">Visa Service</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Embassy fee</span>
                            <span>NPR {{ json_decode($selectedData)->embassyFee }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Service fee</span>
                            <span>NPR {{ json_decode($selectedData)->serviceFee }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-semibold fs-5">Total</span>
                            <span class="fw-semibold fs-5">NPR
                                {{ json_decode($selectedData)->embassyFee + json_decode($selectedData)->serviceFee }}</span>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <span>Select Payment Wallet:</span>
                        </div>
                        <div class="mb-3">
                            <img src="{{ asset('frontend/assets/Images/esewa.png') }}" alt="eSewa logo with QR Code"
                                class="img-fluid img-payment">
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button type="button" class="btn-apply w-92 h-34 rounded"
                                onclick="submitForm()">Pay</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            loadCountries();
            loadStoredFormData();
            initImagePreview();
            handleRouteChange();

            // Clear local storage when the user navigates away from the page
            // Track the current route
            const currentRoute = window.location.pathname;
            const previousRoute = sessionStorage.getItem("previousRoute");

            // If the user comes from another route or external source, clear local storage
            if (previousRoute && previousRoute !== currentRoute) {
                clearAllLocalStorage();
                window.location.reload(); // Reload the page
            }

            // Update the previous route in sessionStorage
            sessionStorage.setItem("previousRoute", currentRoute);

            // Clear local storage when the user navigates away (but not on refresh)
            window.addEventListener("beforeunload", function(event) {
                const isPageRefresh = performance.navigation.type === 1; // 1 means page refresh

                if (!isPageRefresh) {
                    clearAllLocalStorage();
                    window.location.reload(); // Reload the page
                }
            });
        });

        function loadCountries() {
            fetch("https://restcountries.com/v3.1/all")
                .then((response) => response.json())
                .then((data) => {
                    const countries = data.map((country) => country.name.common).sort((a, b) => a.localeCompare(b));

                    const citizenshipDropdown = document.getElementById("citizenship");
                    citizenshipDropdown.innerHTML = `<option value="" selected disabled>Select Country</option>`;

                    countries.forEach((country) => {
                        const option = document.createElement("option");
                        option.value = country;
                        option.textContent = country;
                        citizenshipDropdown.appendChild(option);
                    });

                    const storedData = JSON.parse(localStorage.getItem("visaApplicationData")) || {};
                    if (storedData.citizenship) {
                        citizenshipDropdown.value = storedData.citizenship;
                    }
                })
                .catch((error) => {
                    console.error("Error fetching countries:", error);
                    document.getElementById("citizenship").innerHTML =
                        `<option selected>Failed to load countries. Please try again later.</option>`;
                });
        }

        function initImagePreview() {
            document.getElementById("imageUpload").addEventListener("change", previewImages);
        }

        function previewImages(event) {
            const preview = document.getElementById("imagePreview");
            preview.innerHTML = ""; // Clear previous previews
            const files = event.target.files;
            const errorElem = document.getElementById("imageError");

            errorElem.style.display = "none";
            errorElem.textContent = "";

            if (files.length > 5) {
                errorElem.textContent = "You can upload a maximum of 5 images.";
                errorElem.style.display = "block";
                event.target.value = "";
                return;
            }

            let imageArray = [];

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                if (file.size > 2 * 1024 * 1024) {
                    errorElem.textContent = "Each image must be less than 2MB.";
                    errorElem.style.display = "block";
                    preview.innerHTML = "";
                    event.target.value = "";
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    if (!imageArray.includes(e.target.result)) {
                        imageArray.push(e.target.result);
                        createImagePreview(e.target.result, preview, imageArray);
                        localStorage.setItem("visaApplicationImages", JSON.stringify(imageArray));
                    }
                };
                reader.readAsDataURL(file);
            }
        }

        function createImagePreview(imageSrc, preview, imageArray) {
            const existingImages = Array.from(preview.querySelectorAll("img")).map((img) => img.src);
            if (existingImages.includes(imageSrc)) return;

            const imgContainer = document.createElement("div");
            imgContainer.className = "image-preview-container";
            imgContainer.style.position = "relative";
            imgContainer.style.width = "100px";
            imgContainer.style.height = "100px";
            imgContainer.style.margin = "5px";

            const img = document.createElement("img");
            img.src = imageSrc;
            img.style.width = "100%";
            img.style.height = "100%";
            img.style.objectFit = "cover";
            img.style.borderRadius = "4px";

            const removeIcon = document.createElement("span");
            removeIcon.innerHTML = '<i class="fa fa-times-circle"></i>';
            removeIcon.style.position = "absolute";
            removeIcon.style.top = "0";
            removeIcon.style.right = "0";
            removeIcon.style.cursor = "pointer";
            removeIcon.style.color = "red";
            removeIcon.style.backgroundColor = "white";
            removeIcon.style.opacity = "0.7";
            removeIcon.style.borderRadius = "50%";
            removeIcon.style.padding = "2px 6px";
            removeIcon.style.fontSize = "16px";

            removeIcon.onclick = function() {
                preview.removeChild(imgContainer);
                const newImages = imageArray.filter((img) => img !== imageSrc);
                localStorage.setItem("visaApplicationImages", JSON.stringify(newImages));
            };

            imgContainer.appendChild(img);
            imgContainer.appendChild(removeIcon);
            preview.appendChild(imgContainer);
        }

        function saveAndProceed() {
            const form = document.getElementById("applicationForm");
            const inputs = form.querySelectorAll("input:not([type='file']), select");
            let isValid = true;

            form.querySelectorAll(".invalid-feedback").forEach((elem) => elem.remove());

            const formData = {};
            inputs.forEach((input) => {
                if (input.required && !input.value) {
                    isValid = false;
                    input.classList.add("is-invalid");

                    const errorSpan = document.createElement("span");
                    errorSpan.className = "invalid-feedback";
                    errorSpan.innerHTML = "<strong>This field is required.</strong>";
                    input.parentNode.appendChild(errorSpan);
                } else {
                    input.classList.remove("is-invalid");
                    formData[input.name] = input.value;
                }
            });

            if (isValid) {
                localStorage.setItem("visaApplicationData", JSON.stringify(formData));
                setActive(1);
            }
        }

        function loadStoredFormData() {
            const storedData = JSON.parse(localStorage.getItem("visaApplicationData")) || {};
            Object.keys(storedData).forEach((key) => {
                const input = document.querySelector(`[name="${key}"]`);
                if (input) {
                    input.value = storedData[key];
                }
            });

            const storedImages = JSON.parse(localStorage.getItem("visaApplicationImages")) || [];
            const preview = document.getElementById("imagePreview");
            preview.innerHTML = "";
            storedImages.forEach((imageSrc) => createImagePreview(imageSrc, preview, storedImages));
        }

        function handleRouteChange() {
            // Store the current route when the page loads
            const currentRoute = window.location.pathname;
            console.log('Current route:', currentRoute);
            const previousRoute = localStorage.getItem("previousRoute");
            console.log('Previous route:', previousRoute);

            // Check if we've navigated to a different page
            if (previousRoute && currentRoute !== previousRoute) {
                console.log('Route has changed, clearing localStorage');
                // Clear localStorage regardless of payment status
                clearAllLocalStorage();
            }

            // Always update the previous route
            localStorage.setItem("previousRoute", currentRoute);

            // Handle browser back/forward navigation
            window.addEventListener("popstate", function() {
                console.log('Browser navigation detected, clearing localStorage');
                clearAllLocalStorage();
            });
        }

        // Add a helper function to clear all related localStorage items
        function clearAllLocalStorage() {
            localStorage.removeItem("visaApplicationData");
            localStorage.removeItem("visaApplicationImages");
            localStorage.removeItem("paymentStatus");
        }

        function submitForm() {
            const storedData = localStorage.getItem("visaApplicationData");
            if (!storedData) {
                alert("Please fill out the application form first.");
                setActive(0);
                return;
            }

            const form = document.getElementById("applicationForm");
            const data = JSON.parse(storedData);

            Object.keys(data).forEach((key) => {
                const input = form.querySelector(`[name="${key}"]`);
                if (input) {
                    input.value = data[key];
                }
            });

            // Set payment status before submitting the form
            localStorage.setItem("paymentStatus", "success");
            form.submit();
        }

        function setActive(index) {
            document.querySelectorAll(".step-button").forEach((btn, i) => {
                btn.classList.toggle("active1", i === index);
            });
            document.getElementById("highlight").style.left = `${index * 50}%`;
            document.getElementById("applicationForm").classList.toggle("d-none", index === 1);
            document.getElementById("paymentSection").classList.toggle("d-none", index === 0);
        }
    </script>
@endsection
