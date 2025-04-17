@extends('frontend.layouts.main')

@section('title', 'Otp')
@section('content')
    <style>
        .otp-container {
            max-width: 500px;
            margin: 100px auto;
            display: block;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        }

        .otp-inputs {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .otp-inputs input {
            width: 60px;
            height: 60px;
            text-align: center;
            font-size: 1.5rem;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .otp-inputs input:focus {
            border-color: #0099ff;
            outline: none;
            box-shadow: 0 0 4px rgba(0, 153, 255, 0.5);
        }

        #timerText {
            font-size: 0.9rem;
            color: #555;
        }

        .otp-container .btn-primary,
        .btn-outline-secondary {
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 8px;
        }

        .otp-container .btn-outline-secondary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }


        .otp-container .btn-hover:hover {
            transition: background-color 0.3s ease;
            background-color: #0064A7;
            color: #fff !important;
        }
    </style>

    <div class="container">


        <div class="otp-container">
            <div class="text-center mb-3">
                <img src="{{ asset('frontend/assets/Images/otp.png') }}" alt="OTP Verification" class="img-fluid"
                    style="max-width: 150px;">
            </div>
            <h5 class="text-center text-primary">OTP Verification</h5>
            <p class="text-center text-muted">Enter the code we sent to: <strong id="otpPhoneNumber">
                    @if ($user->email_or_phone == 'email')
                        {{ $user->emailAddress }}
                    @else
                        {{ $user->phoneNumber }}
                    @endif
                </strong>
            </p>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif



            <form id="otpForm" method="POST"
                action="{{ Auth::guard('job_seekers')->check() ? route('jobseeker.otp_verify') : route('jobseeker.verify-otp') }}">
                @csrf
                <input type="hidden" name="phone_number" value="{{ session('phone_number') }}">
                <input type="hidden" name="country_code" value="{{ session('country_code') }}">
                <div class="otp-inputs mb-3">
                    <input type="text" name="otp[]" maxlength="1" oninput="moveFocus(this)" />
                    <input type="text" name="otp[]" maxlength="1" oninput="moveFocus(this)" />
                    <input type="text" name="otp[]" maxlength="1" oninput="moveFocus(this)" />
                    <input type="text" name="otp[]" maxlength="1" oninput="moveFocus(this)" />
                </div>
                <div class="errors mb-3" style="color: red; text-align: center;">
                    @error('otp')
                        {{ $message }}
                    @enderror
                </div>
                <!-- Hidden input to store concatenated OTP -->
                <input type="hidden" name="otp" id="concatenatedOtp" />
                <button type="submit" class="btn-create w-100 mt-3">Verify</button>
            </form>



            <div class="text-center mt-2">
                <p id="timerText">
                    @if ($canResend)
                        You can now resend the code
                    @else
                        Resend code in <span id="countdown">{{ $timeLeftInSeconds }}</span> seconds
                    @endif
                </p>
            </div>

            <form id="otpForm" method="POST"
                action="{{ Auth::guard('job_seekers')->check()
                    ? route('jobseeker.resend-otp')
                    : route('jobseeker.forgot-password.resend-otp') }}">
                @csrf

                @if (!Auth::guard('job_seekers')->check())
                    <input type="hidden" name="phone_number" value="{{ session('phone_number') }}">
                    <input type="hidden" name="country_code" value="{{ session('country_code') }}">
                @endif

                <button type="submit" class="btn btn-outline-secondary btn-hover w-100 text-dark" id="resendOtpBtn"
                    @if (!$canResend) disabled @endif>
                    Resend Code
                </button>
            </form>
        </div>
    </div>

    <script>
        // Function to move focus to the next or previous input
        function moveFocus(input) {
            if (input.value.length === 1 && input.nextElementSibling) {
                input.nextElementSibling.focus();
            } else if (input.value.length === 0 && input.previousElementSibling) {
                input.previousElementSibling.focus();
            }
        }

        // Function to concatenate OTP inputs and set hidden input value
        function concatenateOtp() {
            const otpInputs = document.querySelectorAll('input[name="otp[]"]');
            let concatenatedOtp = '';
            otpInputs.forEach(input => {
                concatenatedOtp += input.value;
            });
            document.getElementById('concatenatedOtp').value = concatenatedOtp;
        }

        // Attach event listener to the form
        document.getElementById('otpForm').addEventListener('submit', function(event) {
            concatenateOtp();
        });

        // Timer functionality (existing code)
        let countdown = {{ $timeLeftInSeconds }};
        const timerText = document.getElementById('timerText');
        const resendOtpBtn = document.getElementById('resendOtpBtn');

        function startTimer() {
            if (countdown > 0) {
                resendOtpBtn.disabled = true;
                const interval = setInterval(() => {
                    countdown--;
                    timerText.textContent = `Resend code in ${countdown} seconds`;

                    if (countdown <= 0) {
                        clearInterval(interval);
                        resendOtpBtn.disabled = false;
                        timerText.textContent = 'You can now resend the code';
                    }
                }, 1000);
            } else {
                timerText.textContent = 'You can now resend the code';
                resendOtpBtn.disabled = false;
            }
        }

        window.onload = startTimer;
    </script>

@endsection
