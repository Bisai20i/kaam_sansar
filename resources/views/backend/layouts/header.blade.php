<!DOCTYPE html>



<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Kaam Sansar - @yield('title') </title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.png') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/core.css') }}"
    
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- jQuery -->


    <!-- Cropper.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">

    <!-- Cropper.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">

    <!-- Include Summernote CSS/JS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
    {{-- text-editor-end --}}


    <!-- Icons. Uncomment required icon fonts -->

    <!-- Core CSS -->

    <!-- Vendors CSS -->

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Include Summernote CSS/JS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
    {{-- text-editor-end --}}


    <script src="{{ asset('backend/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('backend/assets/js/config.js') }}"></script>
    <script src="{{ asset('backend/assets/js/menu.js') }}"></script>
    <style>
        /* Define root variables for primary and secondary colors */
        :root {
            --primary: #196BA6 !important;
            --secondary: #FAAC24 !important;
        }

        /* Background color for elements with .bg-primary class */
        .bg-primary {
            background-color: var(--primary) !important;
            color: #fff !important;
            /* Ensure text is white for better contrast */
        }

        /* Button styles for primary buttons */
        .btn-primary {
            background-color: var(--primary) !important;
            color: #fff !important;
            border-color: var(--primary) !important;
            /* Ensure border color matches background */
        }

        /* Active state styles */
        /* .active {
            background-color: var(--secondary) !important;
            color: #fff !important;
            /* Ensure text is white for better contrast
        } */

        /* Menu item link styles */
        .menu-item a {
            color: var(--primary) !important;
            text-decoration: none;
            /* Remove underline from links */
        }

        .menu-item a:hover {
            color: var(--secondary) !important;
            /* Change color on hover for better interactivity */
        }


        .menu-item.active a {
            color: var(--secondary) !important;


        }

        .bg-menu-theme .menu-inner>.menu-item.active:before {
            background: var(--secondary) !important;
        }

        .bg-menu-theme .menu-inner>.menu-item.active>.menu-link {
            color: var(--secondary) !important;
            background-color: rgba(210, 211, 233, 0.16) !important;
        }

        /* Outline button styles */
        .btn-outline-primary {
            color: var(--primary) !important;
            border-color: var(--primary) !important;
            background-color: transparent !important;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary) !important;
            color: #fff !important;
        }

        /* Text color for elements with .text-primary class */
        .text-primary {
            color: var(--primary) !important;
        }

        /* Additional utility classes for secondary color */
        .bg-secondary {
            background-color: var(--secondary) !important;
            color: #fff !important;
        }

        .text-secondary {
            color: var(--secondary) !important;
        }

        .btn-secondary {
            background-color: var(--secondary) !important;
            color: #fff !important;
            border-color: var(--secondary) !important;
        }

        .btn-outline-secondary {
            color: var(--secondary) !important;
            border-color: var(--secondary) !important;
            background-color: transparent !important;
        }

        .btn-outline-secondary:hover {
            background-color: var(--secondary) !important;
            color: #fff !important;
        }

        .bs-toast {
            position: fixed;
            top: 1.5rem;
            right: 1.5rem;
            z-index: 9999;
            width: auto;
        }

        .bg-menu-theme .menu-sub>.menu-item.active>.menu-link:not(.menu-toggle):before {
            background-color: var(--secondary) !important;
            border: 3px solid #e7e7ff !important;
        }

        /* .form-control:focus,
        .form-select:focus {
            box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.3);
            outline: none;
            background-color: #f4f8fc;
            border: 1px solid #cce5ff;
        } */
    </style>
</head>

<body>
    <div id="toastMessage" class="bs-toast toast fade show " role="alert" aria-live="assertive" aria-atomic="true"
        style="display: none">
        <div class="toast-header">
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toastBody">
        </div>
    </div>
