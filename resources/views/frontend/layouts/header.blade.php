<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kaam Sansar - @yield('title')</title>
    {{-- <link rel="stylesheet" href="{{ asset('frontend/assets/CSS/style.css') }}">  --}}
    {{-- <link rel="stylesheet" href="{{ asset('frontend/assets/frontend/CSS/styles.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('frontend/frontend/CSS/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/CSS/rome.css') }}">
    <link rel="shortcut icon" href="{{ asset('frontend/assets/Images/favicon.ico') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{asset('frontend/assets/CSS/bootstrap.min.css')}}"> --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/flag-icon-css@4.1.7/css/flag-icons.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flag-icon-css@4.1.7/css/flag-icons.min.css" rel="stylesheet">




    {{-- for calender --}}
    <link rel="stylesheet" href="https://preview.colorlib.com/theme/bootstrap/calendar-16/fonts/icomoon/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    {{--  --}}

    <style>
        /* Loader Container */
        #loader {
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgb(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Loader Animation */
        .spinner {
            width: 60px;
            height: 60px;
            border: 8px solid #3498db;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);

            }
        }

        .notification-container {
            position: absolute;
            width: max-content;
            right: 0;
            top: 0;
            padding: 10px;
            z-index: 99999;
        }
        
    </style>
</head>

<body class="min-vh-100">

    <!-- <div id="loader">
        <div class="spinner"></div>
    </div> -->


    <div class="notification-container">
        @if (session('success'))
            <div id="successAlert"
                class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-4" role="alert">
                <i class="fas fa-check-circle fa-2x"></i>
                <span>{{ session('success') }}</span>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            </div>
        @endif

        @if (session('info'))
            <div id="infoAlert" class="alert alert-info alert-dismissible fade show d-flex align-items-center gap-4"
                role="alert">
                <i class="fas fa-info-circle fa-2x"></i>
                <span>{{ session('info') }}</span>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            </div>
        @endif

        @if (session('error'))
            <div id="errorAlert" class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-4"
                role="alert">
                <i class="fas fa-exclamation-circle fa-2x"></i>
                <span>{{ session('error') }}</span>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            </div>
        @endif
    </div>

    <script>
        // Auto-dismiss notifications after 4 seconds
        setTimeout(() => {
            document.querySelectorAll(".alert").forEach(alert => alert.classList.add("d-none"));
        }, 5000);
    </script>
