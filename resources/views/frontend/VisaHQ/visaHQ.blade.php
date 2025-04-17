@extends('frontend.layouts.main')

@section('title', 'Visa HQ')

@section('content')
    <style>
        .visahq {
            width: 100%;
            height: 650px;
            background: url("{{ asset('frontend/assets/Images/visa.png') }}") no-repeat center center;
            background-size: 100% 100%;
            background-color: white;
        }
    </style>


    <form action="{{ route('visaDetails') }}" id="visaForm" method="GET">
        @csrf
        <div class="profile-header visahq py-5 mt-5">
            <div class="container d-flex flex-column align-items-center justify-content-center">
                <div class="d-flex flex-wrap justify-content-center form-container" style="margin-top: 150px!important;">
                    <!-- Citizenship Dropdown -->
                    <div class="dropdown-container">
                        <div class="dropdown-label">Your citizenship</div>
                        <select class="form-select{{ $errors->has('citizenship') ? ' is-invalid' : '' }} visa" id="citizenship"
                            name="citizenship" required>
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
                        <select class="form-select{{ $errors->has('passport') ? ' is-invalid' : '' }} visa" id="passport"
                            name="passport" required>
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
                                    {{ old('destination-country') == $item->slug || (isset($fetchedData) && $fetchedData->slug == $item->slug) ? 'selected' : '' }}>
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
                        <select class="form-select{{ $errors->has('visa-type') ? ' is-invalid' : '' }} visa" id="visaType"
                            name="visa-type" required>
                            <option value="" selected>--Choose Visa Type--</option>
                            @foreach ($visaTypes as $item)
                                <option value="{{ $item->slug }}"
                                    {{ old('visa-type') == $item->slug || (isset($fetchedData) && $fetchedData->visaTypeId == $item->id) ? 'selected' : '' }}>
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
