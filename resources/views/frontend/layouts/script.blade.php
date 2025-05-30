@stack('scripts')

<script src="{{ asset('frontend/assets/JS/home.js') }}"></script>
{{-- <script src="{{ asset('frontend/assets/JS/script.js') }}"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Add this before closing body tag -->
<script src="{{ asset('frontend/assets/JS/loader.js') }}"></script>

<script>
    function setRedirectUrl() {
            fetch('/set-redirect', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    redirect_url: window.location.href
                })
            });
        }
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize modals only once
        const loginModalElement = document.getElementById('loginModal');
        const registerModalElement = document.getElementById('registerModal');
        const loginModal = new bootstrap.Modal(loginModalElement);
        const registerModal = new bootstrap.Modal(registerModalElement);



        // Initialize other functionalities
        initializePhoneInputs();
        setupPasswordToggles();
        handleModalSwitching(loginModal, registerModal);
        handleFormErrors(loginModal, registerModal); // Pass modal instances to handleFormErrors
    });


    // function handleFormErrors(loginModal, registerModal) {
    //     // Check for error indicators within the login form
    //     const loginForm = document.querySelector('#loginForm');
    //     const hasLoginErrors = loginForm && (loginForm.querySelector('.is-invalid') || loginForm.querySelector(
    //         '#loginError'));

    //     // Check for error indicators within the register form
    //     const registerForm = document.querySelector('#registerForm');
    //     const hasRegisterErrors = registerForm && (registerForm.querySelector('.is-invalid') || registerForm
    //         .querySelector('#registerError'));

    //     console.log(hasRegisterErrors);

    //     // Hide both modals initially
    //     loginModal.hide();
    //     registerModal.hide();

    //     // Show the appropriate modal based on the presence of errors
    //     if (hasRegisterErrors) {
    //         registerModal.show();
    //     } else if (hasLoginErrors) {
    //         loginModal.show();
    //     }
    // }

    function handleFormErrors(loginModal, registerModal) {
        // Check for error indicators within the login form
        const loginForm = document.querySelector('#loginForm');
        const hasLoginErrors = loginForm && (loginForm.querySelector('.is-invalid') || loginForm.querySelector(
            '#loginError'));

        // Check for error indicators within the register form
        const registerForm = document.querySelector('#registerForm');
        const hasRegisterErrors = registerForm && (registerForm.querySelector('.is-invalid') || registerForm
            .querySelector('#registerError'));

        // Get the email_or_phone value from the hidden input or server response
        const emailOrPhone = document.querySelector('input[name="email_or_phone"]')?.value;

        // Hide both modals initially
        loginModal.hide();
        registerModal.hide();

        // Show the appropriate modal based on the presence of errors and email_or_phone value
        if (hasRegisterErrors) {
            registerModal.show();

            // Toggle between email and phone forms in the register modal
            if (emailOrPhone === 'email') {
                toggleRegisterForm(true);
            } else if (emailOrPhone === 'phone') {
                toggleRegisterForm(false);
            }
        } else if (hasLoginErrors) {
            loginModal.show();

            // Toggle between email and phone forms in the login modal
            if (emailOrPhone === 'email') {
                toggleLoginForm(true);
            } else if (emailOrPhone === 'phone') {
                toggleLoginForm(false);
            }
        }
    }

    function handleModalSwitching(loginModal, registerModal) {
        document.querySelectorAll('[data-bs-toggle="modal"]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetModalId = this.getAttribute('data-bs-target');
                const targetModalElement = document.querySelector(targetModalId);

                if (targetModalElement === loginModal._element) {
                    registerModal.hide();
                    loginModal.show();
                } else if (targetModalElement === registerModal._element) {
                    loginModal.hide();
                    registerModal.show();
                }
            });
        });
    }


    function initializePhoneInputs() {

        const loginPhone = document.querySelector("#loginPhone");
        const registerPhone = document.querySelector("#registerPhone");
        const forgotPasswordPhone = document.querySelector("#forgotPasswordPhone");
        const editProfilePhone = document.querySelector("#editProfilePhone");
        const phoneNumber = document.querySelector("#phoneNumber");



        if (loginPhone) {
            const itiLogin = window.intlTelInput(loginPhone, {
                initialCountry: "NP",
                separateDialCode: true,
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/js/utils.js",
            });
            setupPhoneHandler(loginPhone, document.querySelector("#country_code"), itiLogin);
        }

        if (registerPhone) {
            const itiRegister = window.intlTelInput(registerPhone, {
                initialCountry: "NP",
                separateDialCode: true,
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/js/utils.js",
            });
            setupPhoneHandler(registerPhone, document.querySelector("#registerCountryCode"), itiRegister);
        }

        if (forgotPasswordPhone) {
            const itiForgotPassword = window.intlTelInput(forgotPasswordPhone, {
                initialCountry: "NP",
                separateDialCode: true,
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/js/utils.js",
            });
            setupPhoneHandler(forgotPasswordPhone, document.querySelector("#forgotPasswordCountryCode"),
                itiForgotPassword);
        }


        if (editProfilePhone) {

            const itiEditProfile = window.intlTelInput(editProfilePhone, {
                initialCountry: "NP",
                separateDialCode: true,
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/js/utils.js",
            });
            setupPhoneHandler(editProfilePhone, document.querySelector("#editProfileCountryCode"), itiEditProfile);
        }
        if (phoneNumber) {

            const itiPhone = window.intlTelInput(phoneNumber, {
                initialCountry: "NP",
                separateDialCode: true,
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/js/utils.js",
            });
        }
    }

    function setupPhoneHandler(phoneInput, countryCodeInput, iti) {
        phoneInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, ''); // Allow only digits
            const countryData = iti.getSelectedCountryData();
            countryCodeInput.value = countryData.iso2.toUpperCase();
        });
    }

    function setupPasswordToggles() {
        const toggleConfigs = [{
                inputId: 'loginPassword',
                iconId: 'eyeIcon'
            },
            {
                inputId: 'registerPassword',
                iconId: 'registerEyeIcon'
            },
            {
                inputId: 'confirmRegisterPassword',
                iconId: 'confirmRegisterEyeIcon'
            }
        ];

        toggleConfigs.forEach(config => {
            const toggleBtn = document.querySelector(
                `[onclick="togglePasswordVisibility('${config.inputId}')"]`);
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    togglePassword(config.inputId, config.iconId);
                });
            }
        });
    }

    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input && icon) {
            input.type = input.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }
    }
</script>


</body>

</html>
