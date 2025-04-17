<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        @auth
            <div class="mb-2 mb-md-0 text-center">
                Copyright ©
                <script>
                    document.write(new Date().getFullYear());
                </script>
                All rights reserved. Designed by
                <a href="https://tukisoft.com.np" target="_blank" class="footer-link fw-bolder">TukiSoft</a>
            </div>
        @endauth

    </div>
</footer>
@stack('scripts')
<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('/backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('/backend/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('/backend/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('/backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('/backend/assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('/backend/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('/backend/assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('/backend/assets/js/dashboards-analytics.js') }}"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        // General toast function
        function showToast(type, message, title = 'Notification') {
            const toast = $('#toastMessage'); // Get the toast container

            // Reset previous classes and add the correct type class
            toast.removeClass('bg-success bg-danger').addClass(`bg-${type}`);


            // Set message and title
            $('#toastBody').text(message);

            // Display the toast
            toast.fadeIn().show();

            // Hide the toast after 10 seconds
            setTimeout(function() {
                toast.fadeOut();
            }, 5000);
        }

        // Show success toast
        function showSuccessToast(message) {
            showToast('success', message, 'Success');
        }

        // Show error toast
        function showErrorToast(message) {
            showToast('danger', message, 'Error');
        }

        // Example usage (from session flash messages)
        @if (Session::has('success'))
            showSuccessToast('{{ Session::get('success') }}');
        @endif

        @if (Session::has('error'))
            showErrorToast('{{ Session::get('error') }}');
        @endif
    });
</script>

</body>

</html>