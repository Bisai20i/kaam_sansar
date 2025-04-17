@extends('frontend.layouts.main')

@section('title', 'Visa Details')

@section('content')
    <style>
        .profile-header {
            background-color: #196BA6;
            color: white;
            padding: 20px;
            padding-top: 70px;
            flex-direction: column;
            position: relative;
            flex-wrap: wrap;
        }

        .visa-header {
            border-bottom: 2px solid #196BA6 !important;
            padding-bottom: 10px;
        }

        .video-container {
            width: 50%;
            height: 50%;

            margin: auto;
            display: block;
        }

        .aspect-w-16 {
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            /* 16:9 Aspect Ratio */
        }

        .aspect-w-16 video,
        .aspect-w-16 iframe,
        .aspect-w-16 img,
        .aspect-w-16 div {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .requirement {
            padding: 20px;
        }

        .visa-title {
            font-size: 24px;
            font-weight: bold;
        }

        .btn-apply,
        .btn-apply-1 {
            background: #0064A7;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            padding: 10px 20px;
            border: 0.5px solid #ffffff;
            margin-top: 20px;
        }

        .btn-apply-1:hover {
            border: 1px solid #0064A7;
            background: #ffffff;
            color: #0064A7;
        }

        @media (max-width: 768px) {
            .profile-header {
                padding-top: 50px;
            }

            .visa-title {
                font-size: 20px;
            }

            .btn-apply,
            .btn-apply-1 {
                font-size: 14px;
                padding: 8px 16px;
            }

            .requirement {
                padding: 10px;
            }
        }

        @media (max-width: 576px) {
            .profile-header {
                padding-top: 30px;
            }

            .visa-title {
                font-size: 18px;
            }

            .btn-apply,
            .btn-apply-1 {
                font-size: 12px;
                padding: 6px 12px;
            }

            .requirement {
                padding: 5px;
            }
        }
    </style>
    <section>
        <!-- Profile Header -->
        <form action="{{ route('visaDetails') }}" id="visaForm" method="GET">
            @csrf
            <div class="profile-header visa py-5">
                <div class="container d-flex flex-column align-items-center justify-content-center">
                    <div class="d-flex flex-wrap justify-content-center form-container" style="margin-top: 150px!important;">
                        <!-- Citizenship Dropdown -->
                        <div class="dropdown-container">
                            <div class="dropdown-label">Your citizenship</div>
                            <select class="form-select{{ $errors->has('citizenship') ? ' is-invalid' : '' }} visa"
                                id="citizenship" name="citizenship" required>
                                @if (old('citizenship') || isset($citizenship))
                                    <option value="{{ old('citizenship', @$citizenship) }}" selected>
                                        {{ old('citizenship', @$citizenship) }}
                                    </option>
                                @else
                                    <option value="" selected>Loading countries...</option>
                                @endif
                            </select>
                            @error('citizenship')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Passport Dropdown -->
                        <div class="dropdown-container">
                            <div class="dropdown-label">Your passport</div>
                            <select class="form-select{{ $errors->has('passport') ? ' is-invalid' : '' }} visa"
                                id="passport" name="passport" required>
                                @if (old('passport') || isset($passport))
                                    <option value="{{ old('passport', @$passport) }}" selected>
                                        {{ old('passport', @$passport) }}
                                    </option>
                                @else
                                    <option value="" selected>Loading countries...</option>
                                @endif
                            </select>
                            @error('passport')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Living Dropdown -->
                        <div class="dropdown-container">
                            <div class="dropdown-label">Currently Living</div>
                            <select class="form-select{{ $errors->has('living') ? ' is-invalid' : '' }} visa" id="living"
                                name="living" required>
                                @if (old('living') || isset($living))
                                    <option value="{{ old('living', @$living) }}" selected>
                                        {{ old('living', @$living) }}
                                    </option>
                                @else
                                    <option value="" selected>Loading countries...</option>
                                @endif
                            </select>
                            @error('living')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Destination Dropdown -->
                        <div class="dropdown-container">
                            <div class="dropdown-label">Your destination</div>
                            <select class="form-select{{ $errors->has('destination-country') ? ' is-invalid' : '' }} visa"
                                name="destination-country" id="destination" required>
                                <option value="" selected>Choose your destination</option>
                                @foreach ($countryLists as $item)
                                    <option value="{{ $item->slug }}"
                                        {{ old('destination-country', isset($fetchedData) ? $fetchedData->visaCountry->slug : '') == $item->slug ? 'selected' : '' }}>
                                        {{ $item->countryName }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('destination-country'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('destination-country') }}
                                </div>
                            @endif
                        </div>

                        <!-- Visa Type Dropdown -->
                        <div class="dropdown-container">
                            <div class="dropdown-label">Visa Type</div>
                            <select class="form-select{{ $errors->has('visa-type') ? ' is-invalid' : '' }} visa"
                                id="visaType" name="visa-type" required>
                                <option value="" selected>--Choose Visa Type--</option>
                                @foreach ($visaTypes as $item)
                                    <option value="{{ $item->slug }}"
                                        {{ old('visa-type', isset($fetchedData) ? $fetchedData->visaType->slug : '') == $item->slug ? 'selected' : '' }}>
                                        {{ $item->visaTypeName }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('visa-type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('visa-type') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn-apply mt-4">Apply Now</button>
                </div>
            </div>
        </form>

        <!-- Visa Requirements Section -->
        @if (isset($fetchedData))
            <div id="visaRequirements" class="container bg-white mt-3">
                <div class="requirement">
                    <div class="visa-header d-flex justify-content-between align-items-center">
                        <h2 class="visa-title">{{ $fetchedData->visaType->visaTypeName }}</h2>
                    </div>
                    <h1 class="mt-3 mb-3" style="font-size: 28px;">
                        {{ $fetchedData->visaType->visaTypeName }} Requirements
                    </h1>
                    <div class=" video-container">
                        <div id="video-container" class="aspect-w-16 aspect-h-9 cursor-pointer" onclick="loadVideo()">
                            <?php
                            // Extract the video ID from the YouTube link
                            parse_str(parse_url($fetchedData->demoVideoLink, PHP_URL_QUERY), $yt_params);
                            $video_id = $yt_params['v'] ?? '';
                            ?>
                            <img id="video-thumbnail" src="{{ asset('storage/' . $fetchedData->demoVideoThumbnail) }}"
                                alt="YouTube Video Thumbnail" class="object-cover img-fluid">

                            <!-- Centered Play Icon -->
                            <div class="absolute inset-0 d-flex items-center justify-center bg-black bg-opacity-50">
                                <i class="fa-solid fa-circle-play fa-4x text-white m-auto"></i>
                            </div>
                        </div>

                        <script>
                            function loadVideo() {
                                const container = document.getElementById('video-container');
                                const videoUrl = "{{ $fetchedData->demoVideoLink }}";

                                if (videoUrl.includes("youtube.com") || videoUrl.includes("youtu.be")) {
                                    // Extract YouTube video ID
                                    const videoId = new URL(videoUrl).searchParams.get("v") || videoUrl.split("/").pop();
                                    container.innerHTML = `
                                        <iframe class="w-full h-full" 
                                            src="https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0" 
                                            title="YouTube video player" frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                            allowfullscreen></iframe>`;
                                } else if (videoUrl.includes("drive.google.com")) {
                                    // Extract Google Drive File ID
                                    const match = videoUrl.match(/\/d\/(.+?)\//);
                                    const fileId = match ? match[1] : null;

                                    if (fileId) {
                                        container.innerHTML = `
                                            <video class="w-full h-full" controls autoplay>
                                                <source src="https://drive.google.com/uc?export=download&id=${fileId}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>`;
                                    } else {
                                        console.error("Invalid Google Drive URL");
                                    }
                                } else {
                                    console.error("Unsupported video source");
                                }
                            }
                        </script>
                    </div>
                    <p class="mb-3">{!! $fetchedData->description !!}</p>

                    {{-- @auth('job_seekers')
                        <form action="{{ route('visaDetails.apply') }}" method="POST">
                            @csrf
                            <input type="hidden" name="fetchData" value="{{ $fetchedData }}">
                            <button class="btn-apply-1 mt-0 mb-3">Apply Now</button>
                        </form>
                    @else
                        <p>{{ url()->current() }}</p>
                        <form id="redirectForm" action="{{ route('set.redirect') }}" method="POST">
                            @csrf
                            <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                        </form>
                        <a href="#" onclick="document.getElementById('redirectForm').submit(); " class="apply-button">
                            Apply Now
                        </a>
                    @endauth --}}

                    @auth('job_seekers')
                        <form action="{{ route('visaDetails.apply') }}" method="POST">
                            @csrf
                            <input type="hidden" name="fetchData" value="{{ $fetchedData }}">
                            <button class="btn-apply-1 mt-0 mb-3">Apply Now</button>
                        </form>
                    @else
                        @php
                            $queryParams = request()->query();
                            $redirectUrl = url()->current() . '?' . http_build_query($queryParams);
                        @endphp

                        <form id="redirectForm" action="{{ route('set.redirect') }}" method="POST">
                            @csrf
                            <input type="hidden" name="redirect_url" value="{{ $redirectUrl }}">
                        </form>

                        <a href="#" onclick="document.getElementById('redirectForm').submit(); " class="apply-button">
                            Apply Now
                        </a>
                    @endauth

                </div>
            </div>
        @else
            <div class="container bg-white mt-3">
                <div class="requirement text-center m-5">
                    <p class="mb-3 fs-3">No data found in our system.</p>
                </div>
            </div>
        @endif
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch countries from REST Countries API
            fetch("https://restcountries.com/v3.1/all")
                .then((response) => response.json())
                .then((data) => {
                    // Extract country names and sort them alphabetically
                    const countries = data
                        .map((country) => country.name.common)
                        .sort((a, b) => a.localeCompare(b));

                    // Function to populate dropdowns
                    function populateDropdown(selector, data, defaultText, selectedValue) {
                        const dropdown = document.querySelector(selector);
                        dropdown.innerHTML = `<option value="" selected>${defaultText}</option>`;
                        data.forEach((item) => {
                            const option = document.createElement("option");
                            option.value = item;
                            option.textContent = item;
                            if (item === selectedValue) {
                                option.selected = true;
                            }
                            dropdown.appendChild(option);
                        });
                    }

                    // Populate all dropdowns with the fetched countries
                    populateDropdown("#citizenship", countries, "Choose your citizenship",
                        "{{ old('citizenship', @$citizenship) }}");
                    populateDropdown("#passport", countries, "Choose your passport",
                        "{{ old('passport', @$passport) }}");
                    populateDropdown("#living", countries, "Choose your current location",
                        "{{ old('living', @$living) }}");
                })
                .catch((error) => {
                    console.error("Error fetching countries:", error);
                    // Display an error message in the dropdowns if the fetch fails
                    const dropdowns = document.querySelectorAll(".form-select");
                    dropdowns.forEach((dropdown) => {
                        dropdown.innerHTML =
                            `<option selected>Failed to load countries. Please try again later.</option>`;
                    });
                });
        });
    </script>
@endsection
