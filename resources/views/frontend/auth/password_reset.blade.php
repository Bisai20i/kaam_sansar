@extends('frontend.layouts.main')
@section('title', 'Change Password')
@section('content')



    <div class="container">
        <div class="password-card">
            <div class="text-center">
                <div class="fs-1 text-primary mb-3">
                    <i class="fas fa-lock"></i>
                </div>
                <h2 class="mb-2">Reset Password</h2>
                <p class="text-muted">Enter your current password and set a new one.</p>
            </div>
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

                <div class="alert-danger alert-dismissible fade show custom-alert timeout-none mb-3" role="alert">
                    <button type="button" class="alert-close" onclick="closeAlert(this)">&times;</button>
                    <strong>Error!</strong> {{ session('error') }}
                </div>

                <script>
                    // Function to manually close the alert
                    function closeAlert(button) {
                        // Find the parent alert and fade it out
                        const alert = button.closest('.custom-alert');
                        alert.style.display = 'none';
                    }

                    // Optional: Auto hide the alert after a certain time (e.g., 5 seconds)
                    setTimeout(function() {
                        const alert = document.querySelector('.custom-alert');
                        if (alert) {
                            alert.style.display = 'none'; // Hide the alert after 5 seconds
                        }
                    }, 5000); // 5000ms = 5 seconds
                </script>
            @endif
            <form action="{{ route('jobseeker.password-reset') }}" method="POST" id="changePasswordForm">
                @csrf
                @method('PATCH')

                <!-- Hidden username field to prevent browser warnings -->
                <input type="text" name="username" autocomplete="username" value="dummy_user" style="display: none;">

                <input type="hidden" name="phone_number" value="{{ session('phone_number') }}">
                <input type="hidden" name="country_code" value="{{ session('country_code') }}">

                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="new_password" id="new_password"
                            class="form-control @error('new_password') is-invalid @enderror" placeholder="New Password"
                            autocomplete="new-password">
                        <span class="input-group-text toggle-password" data-target="#new_password">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    <small id="password-strength" class="text-muted"></small>
                    @error('new_password')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm New Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="confirmation_password" id="password_confirmation"
                            class="form-control @error('confirmation_password') is-invalid @enderror"
                            placeholder="Confirm New Password" autocomplete="new-password">
                        <span class="input-group-text toggle-password" data-target="#password_confirmation">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    @error('confirmation_password')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-create w-100">Change Password</button>
            </form>


        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Toggle password visibility
            document.querySelectorAll(".toggle-password").forEach(button => {
                button.addEventListener("click", function() {
                    const targetInput = document.querySelector(this.dataset.target);
                    if (targetInput) {
                        targetInput.type = targetInput.type === "password" ? "text" : "password";
                        this.innerHTML = targetInput.type === "password" ?
                            '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                    }
                });
            });

            // Password strength meter
            const passwordInput = document.getElementById("new_password");
            const strengthText = document.getElementById("password-strength");

            if (passwordInput && strengthText) {
                passwordInput.addEventListener("input", function() {
                    const value = this.value;
                    let strength = "Weak";
                    let strengthClass = "text-danger";

                    if (value.length >= 8 && /[A-Z]/.test(value) && /\d/.test(value) && /[\W]/.test(
                            value)) {
                        strength = "Strong";
                        strengthClass = "text-success";
                    } else if (value.length >= 6 && (/[A-Z]/.test(value) || /\d/.test(value))) {
                        strength = "Medium";
                        strengthClass = "text-warning";
                    }

                    strengthText.textContent = `Password Strength: ${strength}`;
                    strengthText.className = strengthClass;
                });
            }
        });
    </script>

@endsection
