@extends('frontend.layouts.main')
@section('title', 'Change Password')
@section('content')
    @if (session('error'))
        <style>
            .custom-alert {
                background-color: #f8d7da;
                color: #721c24;
                border-color: #f5c6cb;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
                padding: 15px;
                position: relative;
                display: inline-block;
                width: 100%;
            }

            .custom-alert .alert-close {
                position: absolute;
                top: 10px;
                right: 10px;
                border: none;
                background: transparent;
                font-size: 18px;
                cursor: pointer;
            }
        </style>
    @endif
    <div class="container my-5 pt-3">
        <div class="password-card forgot-password">
            <div class="text-center">
                <div class="bg-primary text-white rounded-circle px-3 py-2 mb-3 d-inline-block">
                    <i class="fas fa-question fa-2x"></i>
                </div>
                <h2 class="mb-1">Forget Password?</h2>
                <p style="color:#9C9C9C; font-size: 16px;">Don’t worry. We can help.</p>
            </div>

            @if (session('error'))
                <div class="alert-danger alert-dismissible fade show custom-alert timeout-none mb-3" role="alert">
                    <button type="button" class="alert-close" onclick="closeAlert(this)">&times;</button>
                    <strong>Error!</strong> {{ session('error') }}
                </div>
            @endif

            <div class="d-flex justify-content-center w-100 mb-3">
                <button type="button" class="btn-outline-secondary border-email active" id="email-btn-forgot">
                    <i class="fa fa-envelope"></i> Email
                </button>
                <button type="button" class="btn-outline-secondary border-phone" id="phone-btn-forgot">
                    <i class="fas fa-phone"></i> Phone
                </button>
            </div>

            <form action="{{ route('jobseeker.verify-phone') }}" method="POST" class="row g-3 w-100" id="forgotPasswordForm">
                @csrf
                <!-- Hidden input to store email_or_phone value -->
                <input type="hidden" name="email_or_phone" id="email_or_phone" value="email">

                <div id="forgot-email-container">
                    <div class="mb-3 col-12">
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #fff!important">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" name="forgot_email" id="loginEmail"
                                class="form-control @error('forgot_email') is-invalid @enderror py-2" placeholder="Enter Your Email"
                                autocomplete="off" value="{{ old('forgot_email') }}">
                            @error('forgot_email')
                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div id="forgot-phone-container" style="display: none;">
                    <div class="mb-3 col-12">
                        <input type="tel" name="forgot_phone_number" id="forgotPasswordPhone"
                            class="form-control @error('forgot_phone_number') is-invalid @enderror" placeholder="Enter Your Phone"
                            minlength="10" maxlength="10" inputmode="numeric" pattern="[0-9]*"
                            title="Phone number should be 10 digits" autocomplete="off">
                        <input type="hidden" name="country_code" id="forgotPasswordCountryCode">
                        @error('forgot_phone_number')
                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn-create w-100 mt-2">Verify</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const emailBtn = document.getElementById("email-btn-forgot");
            const phoneBtn = document.getElementById("phone-btn-forgot");
            const emailContainer = document.getElementById("forgot-email-container");
            const phoneContainer = document.getElementById("forgot-phone-container");
            const emailOrPhoneInput = document.getElementById("email_or_phone");

            // Function to toggle between email and phone
            function toggleForm(method) {
                if (method === "email") {
                    emailContainer.style.display = "block";
                    phoneContainer.style.display = "none";
                    emailBtn.classList.add("active");
                    phoneBtn.classList.remove("active");
                    emailOrPhoneInput.value = "email";
                } else {
                    phoneContainer.style.display = "block";
                    emailContainer.style.display = "none";
                    phoneBtn.classList.add("active");
                    emailBtn.classList.remove("active");
                    emailOrPhoneInput.value = "phone";
                }
            }

            // Event listeners for buttons
            emailBtn.addEventListener("click", function() {
                toggleForm("email");
            });

            phoneBtn.addEventListener("click", function() {
                toggleForm("phone");
            });

            // Set default state based on hidden input value
            toggleForm(emailOrPhoneInput.value || "email");

            // Function to close alert
            window.closeAlert = function(button) {
                button.closest('.custom-alert').style.display = 'none';
            };

            // Auto-hide alert after 5 seconds
            setTimeout(function() {
                const alert = document.querySelector('.custom-alert');
                if (alert) {
                    alert.style.display = 'none';
                }
            }, 5000);
        });
    </script>

@endsection
