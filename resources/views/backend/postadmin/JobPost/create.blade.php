@extends('backend.layouts.main')

@section('title', 'Dashboard')

@section('content')
    <style>
        .company-list-item {
            cursor: pointer;
            padding: 8px 12px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            margin-top: -1px;
        }

        .company-list-item:hover {
            background-color: #e7f1ff;
        }

        .company-list-item.active {
            background-color: #ffffff;
            color: #007bff;

        }

        .highlight {
            background-color: #cfe2ff;
            padding: 0 2px;
        }

        .not-found {
            padding: 8px 12px;
            color: #6c757d;
            background-color: #f8f9fa;
            text-align: center;
            border: 1px solid #dee2e6;
        }

        /* Add this to your existing styles */
        .scroll-list {
            max-height: 144px;
            /* Height of 3 items (3 * 48px) */
            overflow-y: auto;
        }
    </style>

    <div class="container py-5 ">

        <!-- Basic Bootstrap Table -->
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex justify-content-between align-items-center py-3 mb-4">
                            <h4 class="fw-bold m-0">
                                {{ isset($jobPost) ? 'Edit Job Post' : 'Create Job Post' }}
                            </h4>
                            <a href="{{ route('jobPost.index') }}" class="btn btn-primary btn-sm text-white">
                                <i class="bx bx-arrow-back" aria-hidden="true"></i> Back
                            </a>
                        </div>

                        <!-- Main Content -->
                        <div class="main-content">
                            <section class="section">
                                <form id="formAuthentication" class="mb-3 " novalidate
                                    action="{{ isset($jobPost) ? route('jobPost.update', $jobPost->id) : route('jobpost.store') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if (isset($jobPost))
                                        @method('PUT')
                                    @endif

                                    <input type="hidden" name="jobpostuserid"
                                        value="{{ Auth::guard('admin')->user()->id }}">

                                    <div class="row">
                                        <!-- Left Column -->

                                        <div class="mb-3 col-md-6">
                                            <label for="jobTitle" class="form-label">Job Title <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control{{ $errors->has('jobTitle') ? ' is-invalid' : '' }}"
                                                id="jobTitle" name="jobTitle" placeholder="Enter your job title"
                                                value="{{ old('jobTitle', isset($jobPost) ? $jobPost->jobTitle : '') }}"
                                                autofocus required />
                                            @error('jobTitle')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="jobCompanyId" class="form-label">Job Company <span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <input type="text"
                                                    class="form-control {{ $errors->has('jobCompanyId') ? 'is-invalid' : '' }}"
                                                    id="companySearch" placeholder="Search company..." autocomplete="off">
                                                <select class="form-select d-none" id="jobCompanyId" name="jobCompanyId"
                                                    required>
                                                    <option value="" disabled selected>Select Job Company
                                                    </option>
                                                    {{-- @foreach ($companies as $company)
                                                        <option value="{{ $company->id }}"
                                                            {{ isset($jobPost) && $jobPost->jobCompanyId == $company->id ? 'selected' : '' }}>
                                                            {{ $company->companyName }}
                                                        </option>
                                                    @endforeach --}}

                                                    @foreach ($companies as $company)
                                                        <option value="{{ $company->id }}"
                                                            {{ old('jobCompanyId', isset($jobPost) ? $jobPost->jobCompanyId : '') == $company->id ? 'selected' : '' }}>
                                                            {{ $company->companyName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <ul class="list-group position-absolute w-100 shadow-sm" id="companyList"
                                                    style="max-height: 200px; overflow-y: auto; display: none; z-index: 1000; ">
                                                </ul>
                                                @error('jobCompanyId')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="jobLevel" class="form-label">Job level <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select {{ $errors->has('jobLevel') ? 'is-invalid' : '' }}"
                                                id="jobLevel" name="jobLevel" required>
                                                <option value="" disabled selected>Select Job Level</option>
                                                <option value="Entry Level"
                                                    {{ old('jobLevel', isset($jobPost) ? $jobPost->jobLevel : '') == 'Entry Level' ? 'selected' : '' }}>
                                                    Entry Level</option>
                                                <option value="Mid Level"
                                                    {{ old('jobLevel', isset($jobPost) ? $jobPost->jobLevel : '') == 'Mid Level' ? 'selected' : '' }}>
                                                    Mid Level</option>
                                                <option value="Senior Level"
                                                    {{ old('jobLevel', isset($jobPost) ? $jobPost->jobLevel : '') == 'Senior Level' ? 'selected' : '' }}>
                                                    Senior Level</option>
                                            </select>
                                            @error('jobLevel')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="jobCategoryId" class="form-label">Job Category <span
                                                    class="text-danger">*</span></label>
                                            <select
                                                class="form-select {{ $errors->has('jobCategoryId') ? 'is-invalid' : '' }}}"
                                                id="jobCategoryId" name="jobCategoryId" required>
                                                <option value="" disabled selected>Select Job Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('jobCategoryId', isset($jobPost) ? $jobPost->jobCategoryId : '') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->jobCategoryName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('jobCategoryId')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="jobType" class="form-label">Job Type <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select {{ $errors->has('jobType') ? 'is-invalid' : '' }}"
                                                id="jobType" name="jobType" required>
                                                <option value="" disabled selected>Select Job Type</option>
                                                <option value="trainee"
                                                    {{ old('jobType', isset($jobPost) ? $jobPost->jobType : '') == 'trainee' ? 'selected' : '' }}>
                                                    Trainee</option>
                                                <option value="parttime"
                                                    {{ old('jobType', isset($jobPost) ? $jobPost->jobType : '') == 'parttime' ? 'selected' : '' }}>
                                                    Part Time</option>
                                                <option value="fulltime"
                                                    {{ old('jobType', isset($jobPost) ? $jobPost->jobType : '') == 'fulltime' ? 'selected' : '' }}>
                                                    Full Time</option>
                                            </select>
                                            <div class="invalid-feedback">This field is required.</div>
                                        </div>
                                        <div class="mb-3 col-md-6 ">
                                            <label for="file" class="form-label">Job Banner<span
                                                    class="text-danger">*</span></label>
                                            <input type="file"
                                                class="form-control {{ $errors->has('jobBanner') ? 'is-invalid' : '' }}"
                                                id="file" name="jobBanner" accept="image/*"
                                                onchange="loadImage(event)">
                                            @error('file')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <!-- Hidden input for Base64 image -->
                                            <input type="hidden" id="croppedImageBase64" name="croppedImageBase64">
                                            <!-- Image Preview -->
                                            <div class="mt-3">
                                                <img id="imagePreview"
                                                    src="{{ isset($jobPost) && $jobPost->jobBanner ? asset('storage/' . $jobPost->jobBanner) : '' }}"
                                                    alt="Selected Profile Image"
                                                    style="max-width: 200px; display: {{ isset($jobPost) && $jobPost->jobBanner ? 'block' : 'none' }}; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                            </div>

                                            @error('jobBanner')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="jobLocation" class="form-label">Job Location <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control{{ $errors->has('jobLocation') ? ' is-invalid' : '' }}"
                                                id="jobLocation" name="jobLocation"
                                                value="{{ old('jobLocation', isset($jobPost) ? $jobPost->jobLocation : '') }}"
                                                placeholder="Enter job location" required />
                                            @error('jobLocation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="jobdeadline" class="form-label">Job Deadline</label>
                                            <input type="date"
                                                class="form-control{{ $errors->has('jobdeadline') ? ' is-invalid' : '' }}"
                                                id="jobdeadline" name="jobdeadline"
                                                value="{{ old('jobdeadline', isset($jobPost) ? $jobPost->jobDeadline : '') }}"
                                                placeholder="Enter job Post deadline" required />
                                            @error('jobdeadline')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="Experience" class="form-label">Experience</label>
                                            <input type="text"
                                                class="form-control{{ $errors->has('experience') ? ' is-invalid' : '' }}"
                                                name="experience"
                                                value="{{ old('experience', isset($jobPost) ? $jobPost->experience : '') }}"
                                                placeholder="Enter experience in years" />
                                            @error('experience')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>



                                        <div class="mb-3 col-md-6">
                                            <label for="skills" class="form-label">Skills <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control{{ $errors->has('skills') ? ' is-invalid' : '' }}"
                                                id="skills" name="skills"
                                                value="{{ old('skills', isset($jobPost) ? $jobPost->skills : '') }}"
                                                placeholder="Enter job skills" required />


                                            <small class="text-muted">Enter skills separated by commas, e.g., Skill 1,
                                                Skill 2...</small>

                                            @error('skills')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror


                                        </div>



                                        <div class="mb-3 col-md-6">
                                            <label for="vacancynumber" class="form-label">No of Vacancy <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="number"
                                                class="form-control{{ $errors->has('vacancynumber') ? ' is-invalid' : '' }}"
                                                id="vacancynumber" name="vacancynumber"
                                                value="{{ old('vacancynumber', isset($jobPost) ? $jobPost->noOfVacancy : '') }}"
                                                placeholder="Enter no of vacancy" required />
                                            @error('vacancynumber')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="offeredSalary" class="form-label">Salary</label>
                                            <input type="number"
                                                class="form-control{{ $errors->has('offeredSalary') ? ' is-invalid' : '' }}"
                                                id="offeredSalary" name="offeredSalary"
                                                value="{{ old('offeredSalary', isset($jobPost) ? $jobPost->offeredSalary : '') }}"
                                                placeholder="Enter Employee Salary" />

                                            @error('offeredSalary')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>

                                        @php
                                            $employeeTime =
                                                isset($jobPost) && $jobPost->employeeTime
                                                    ? explode(' - ', $jobPost->employeeTime)
                                                    : ['', ''];
                                        @endphp

                                        <div class="mb-3 col-md-6">
                                            <label for="employeeTime" class="form-label">Employee Time <span
                                                    class="text-danger">*</span></label>
                                            <div class="d-flex gap-2">
                                                <span class="align-self-center">from</span>
                                                <input type="time"
                                                    class="form-control{{ $errors->has('employeeStartTime') ? ' is-invalid' : '' }}"
                                                    id="employeeStartTime" name="employeeStartTime"
                                                    value="{{ old('employeeStartTime', isset($jobPost) ? explode(' - ', $jobPost->employeeTime)[0] : '') }}"
                                                    required />
                                                <span class="align-self-center">to</span>
                                                <input type="time"
                                                    class="form-control{{ $errors->has('employeeEndTime') ? ' is-invalid' : '' }}"
                                                    id="employeeEndTime"
                                                    name="employeeEndTime"
                                                    value="{{ old('employeeEndTime', isset($jobPost) && strpos($jobPost->employeeTime, ' - ') !== false ? explode(' - ', $jobPost->employeeTime)[1] : '') }}"
                                                    required />
                                            </div>

                                            @if ($errors->has('employeeStartTime') || $errors->has('employeeEndTime'))
                                                <div class="invalid-feedback" style="display: block">
                                                    {{ $errors->first('employeeStartTime') . ' ' . ' ' . $errors->first('employeeEndTime') }}
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="jobDescription" class="form-label">Job Description
                                        </label>
                                        <textarea class=" form-control{{ $errors->has('jobDescription') ? ' is-invalid' : '' }}" id="jobDescription"
                                            name="jobDescription" rows="3">{{ old('jobDescription', isset($jobPost) ? $jobPost->jobDescription : '') }} </textarea>

                                        @error('jobDescription')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="mb-3 col-md-6">
                                            <label for="qualification" class="form-label">Qualification <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control @error('qualification') is-invalid @enderror" id="qualification" name="qualification"
                                                rows="3" required>{{ old('qualification', isset($jobPost) ? $jobPost->qualification : '') }}</textarea>
                                            @error('qualification')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div> --}}


                        </div>
                        <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center"
                            id="submitButton">
                            <span id="buttonText">{{ isset($jobPost) ? 'Update' : 'Create Job Post' }}</span>
                            <div id="loaderSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                        <script>
                            const form = document.getElementById('formAuthentication');
                            const submitButton = document.getElementById('submitButton');
                            const buttonText = document.getElementById('buttonText');
                            const loaderSpinner = document.getElementById('loaderSpinner');

                            form.addEventListener('submit', function() {
                                submitButton.disabled = true;
                                loaderSpinner.classList.remove('d-none');
                                buttonText.style.display = 'none';
                            });
                        </script>
                    </div>
                </div>
            </div>
            </form>
            </section>
        </div>
    </div>

    <!-- Modal for Cropping -->
    <div class="modal fade" id="cropper-modal" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropperModalLabel">Crop Image</h5>
                    <button type="button" class="btn btn-secondary" id="close-modal">Cancel</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="img-container">
                                <img id="cropper-image" src=""
                                    style="width: 100%; max-height: 600px; object-fit: contain;">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="preview-container mt-3">
                                <h6>Live Preview:</h6>
                                <div class="preview" style="width: 150px; height: 150px; overflow: hidden;">
                                    <img id="preview-image" style="max-width: 100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="crop-button">Crop</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>


    <script>
        $(document).ready(function() {
            var $modal = $('#cropper-modal');
            var image = document.getElementById('cropper-image');
            var cropper;

            // Load image into cropper when file input changes
            $('#file').change(function(e) {
                var files = e.target.files;
                if (files && files.length > 0) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        image.src = event.target.result;
                        $modal.modal('show');
                    };
                    reader.readAsDataURL(files[0]);
                }
            });

            // Initialize cropper when modal is shown
            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 1.5, // Set your desired aspect ratio
                    viewMode: 3,
                    preview: '.preview',
                    autoCropArea: 1,
                    responsive: true,
                });
            }).on('hidden.bs.modal', function() {
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
            });

            // Crop the image and display the result
            $('#crop-button').click(function() {
                if (!cropper) return;

                var canvas = cropper.getCroppedCanvas({
                    width: 500, // Set your desired width
                    height: 150 // Set your desired height
                });

                canvas.toBlob(function(blob) {
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        $('#imagePreview').attr('src', base64data).show();
                        $('#croppedImageBase64').val(
                            base64data); // Set the base64 data to the hidden input
                        $modal.modal('hide');
                    };
                });
            });

            // Close the modal
            $('#close-modal').click(function() {
                $modal.modal('hide');
            });
            // Initialize Summernote
            $('#jobDescription,#qualification,#Experience').summernote({
                placeholder: 'Write your company description here...',
                height: 200, // Set editor height
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });


        });
    </script>
    {{--
        <script>
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    const form = document.getElementById('formAuthentication');
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                }, false);
            })();
        </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('companySearch');
            const companyList = document.getElementById('companyList');
            const selectElement = document.getElementById('jobCompanyId');

            // Get all companies from the select options
            const companies = Array.from(selectElement.options).slice(1).map(option => ({
                id: option.value,
                name: option.text
            }));

            // Initialize with selected value if exists
            const selectedOption = selectElement.querySelector('option:checked');
            if (selectedOption && selectedOption.value) {
                searchInput.value = selectedOption.text;
            }

            function highlightMatch(text, search) {
                if (!search) return text;
                const regex = new RegExp(`(${search})`, 'gi');
                return text.replace(regex, '<span class="highlight">$1</span>');
            }

            function filterCompanies(searchText) {
                return companies.filter(company =>
                    company.name.toLowerCase().includes(searchText.toLowerCase())
                );
            }

            function displayCompanies(filteredCompanies, searchText) {
                companyList.innerHTML = '';

                if (filteredCompanies.length === 0) {
                    const noResults = document.createElement('li');
                    noResults.className = 'not-found';
                    noResults.textContent = 'No matching companies found';
                    companyList.appendChild(noResults);
                } else {
                    // Add scroll class if more than 3 items
                    companyList.className = filteredCompanies.length > 3 ? 'list-group scroll-list' : 'list-group';

                    filteredCompanies.forEach(company => {
                        const li = document.createElement('li');
                        li.className = 'company-list-item';
                        li.innerHTML = highlightMatch(company.name, searchText);

                        li.addEventListener('click', () => {
                            searchInput.value = company.name;
                            selectElement.value = company.id;
                            companyList.style.display = 'none';
                        });

                        li.addEventListener('mouseenter', () => {
                            li.classList.add('active');
                        });

                        li.addEventListener('mouseleave', () => {
                            li.classList.remove('active');
                        });

                        companyList.appendChild(li);
                    });
                }

                companyList.style.display = 'block';
            }

            searchInput.addEventListener('input', (e) => {
                const searchText = e.target.value;
                const filteredCompanies = filterCompanies(searchText);
                displayCompanies(filteredCompanies, searchText);
            });

            searchInput.addEventListener('focus', () => {
                if (searchInput.value) {
                    const filteredCompanies = filterCompanies(searchInput.value);
                    displayCompanies(filteredCompanies, searchInput.value);
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!searchInput.contains(e.target) && !companyList.contains(e.target)) {
                    companyList.style.display = 'none';
                }
            });
        });
    </script>



    </body>


@endsection