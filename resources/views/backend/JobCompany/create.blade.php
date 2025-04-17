@extends('backend.layouts.main')

@section('title', 'Dashboard')

@section('content')
    <style>
        #industry-results {
            z-index: 1000;
            max-height: 100px;
            overflow-y: auto;
            background-color: #fff;
            display: none;
            max-width: 400px;
            display: flex;
            align-items: center;
            position: relative;
        }

        #industry-results .list-group-item {
            cursor: pointer;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        #industry-results .list-group-item:hover {
            background-color: #f8f9fa;
        }

        #industry-wrapper {
            position: relative;
        }

        .remove-selected-industry {
            position: absolute;
            top: 30%;
            right: 3%;
            cursor: pointer;
            color: #dc3545;
            font-size: 20px;
        }

        .remove-selected-industry:hover {
            color: #bd2130;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <h4 class="fw-bold mb-4"><span class="text-muted fw-light"> </span> Job Company</h4>


            <!-- Main Content -->
            <div class="row">
                <div class="col-12 ">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">{{ isset($jobCompany) ? 'Edit' : 'Add' }} Job Company</h5>

                            <a href="{{ route('jobCompany.index') }}" class="btn btn-primary btn-sm  text-white"><i
                                    class="bx bx-arrow-back" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                action="{{ isset($jobCompany) ? route('jobCompany.update', ['jobCompany' => $jobCompany->id]) : route('jobCompany.store') }}"
                                id="JobForm" enctype="multipart/form-data">
                                @csrf
                                @if (isset($jobCompany))
                                    @method('PUT')
                                @endif

                                <!-- Hidden input to store the job categories -->
                                <input type="hidden" name="job_categories" id="jobCategories">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="companyName" class="form-label"> Job Company Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text "
                                            class="form-control {{ $errors->has('companyName') ? 'is-invalid' : '' }}"
                                            id="companyName" name="companyName"
                                            value="{{ old('companyName', isset($jobCompany) ? $jobCompany->companyName : '') }}"
                                            placeholder="Job Company Name">

                                        @error('companyName')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6	">
                                        <label for="email" class="form-label"> Email Address
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="email"
                                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                            id="email" name="email"
                                            value="{{ old('email', isset($jobCompany) ? $jobCompany->email : '') }}"
                                            placeholder="Email Address">

                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6	">
                                        <label for="phone" class="form-label"> Phone
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="phoneNumber"
                                            class="form-control {{ $errors->has('phoneNumber') ? 'is-invalid' : '' }}"
                                            id="phoneNumber" name="phoneNumber"
                                            value="{{ old('phoneNumber', isset($jobCompany) ? $jobCompany->phoneNumber : '') }}"
                                            placeholder="phoneNumber Address">

                                        @error('phoneNumber')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- <div class="mb-3 col-md-6">
                                        <label for="industry" class="form-label"> Industry
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div id="industry-wrapper" class="">
                                            <input type="text" class="form-control" id="industry" name="industry"
                                                placeholder="Search for an industry..." autocomplete="off">

                                            <input type="hidden" id="industry_id" name="industry_id">
                                            <i class="bx bx-x remove-selected-industry" id="clear-industry"
                                                style="display: none;"></i>

                                        </div>
                                        <div id="industry-results" class="list-group"></div>
                                    </div> --}}

                                    <div class="mb-3 col-md-6">
                                        <label for="industry" class="form-label"> Industry
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div id="industry-wrapper" class="">
                                            <!-- Populate the industry input with old value -->
                                            <input type="text"
                                                class="form-control {{ $errors->has('industry') || $errors->has('industry_id') ? 'is-invalid' : '' }}"
                                                id="industry" name="industry" placeholder="Search for an industry..."
                                                autocomplete="off" value="{{ old('industry', $selectedIndustry ?? '') }}">

                                            @if ($errors->has('industry') || $errors->has('industry_id'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('industry') ?: $errors->first('industry_id') }}
                                                </div>
                                            @endif

                                            <!-- Populate the industry_id hidden input with old value -->
                                            <input type="hidden" id="industry_id" name="industry_id"
                                                value="{{ old('industry_id', $selectedIndustryId ?? '') }}">

                                            <!-- Show the clear icon if an industry is selected -->
                                            <i class="bx bx-x remove-selected-industry" id="clear-industry"
                                                style="{{ old('industry_id', $selectedIndustryId ?? '') ? 'display: inline-block;' : 'display: none;' }}"></i>
                                        </div>
                                        <div id="industry-results" class="list-group"></div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="rating" class="form-label">Rating <span
                                                class="text-danger">*</span></label>
                                        <select id="rating" name="rating"
                                            class="form-select {{ $errors->has('rating') ? 'is-invalid' : '' }}">
                                            <option value="" disabled {{ old('rating') == '' ? 'selected' : '' }}>
                                                Select a rating</option>
                                            <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>⭐</option>
                                            <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>⭐⭐</option>
                                            <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>⭐⭐⭐
                                            </option>
                                            <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐
                                            </option>
                                            <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐
                                            </option>
                                        </select>
                                        @error('rating')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror


                                    </div>


                                    <div class="mb-3 col-md-6">
                                        <label for="link" class="form-label">Links
                                            <span class="text-danger">(max 3 links)</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control {{ $errors->has('links') ? 'is-invalid' : '' }}"
                                                id="link" placeholder="Add Link" style="flex: 2;">
                                            <input type="hidden" name="links" id="links"
                                                value="{{ old('links', '[]') }}">

                                            <button class="btn btn-primary" type="button" onclick="addToTable()"
                                                style="flex: 0 0 auto;">
                                                <i class="bx bx-plus" aria-hidden="true"></i>
                                            </button>
                                            @if ($errors->has('links'))
                                                <div class="invalid-feedback d-block">
                                                    {{ $errors->first('links') }}
                                                </div>
                                            @endif
                                        </div>



                                        <div id="inputError" class="text-danger mt-1" style="display: none;"></div>
                                        <table class="table table-bordered mt-3 mb-3" id="taskTable"
                                            style="display: none;">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Link</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="file" class="form-label">Profile Image <span
                                                class="text-danger">*</span></label>
                                        <input type="file"
                                            class="form-control {{ $errors->has('file') ? 'is-invalid' : '' }}"
                                            id="file" name="file" accept="image/*" onchange="loadImage(event)">
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
                                                src="{{ isset($jobCompany) && $jobCompany->file ? asset($jobCompany->file) : '' }}"
                                                alt="Selected Profile Image"
                                                style="max-width: 200px; display: {{ isset($jobCompany) && $jobCompany->file ? 'block' : 'none' }}; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                        </div>
                                    </div>

                                    <!-- First, add these in your layout file or header -->


                                    <!-- The textarea component with Summernote -->
                                    <div class="mb-3 col-md-6">
                                        <label for="companyDescription" class="form-label">
                                            Company Description <span class="text-danger">*</span>
                                        </label>
                                        <textarea name="companyDescription" id="companyDescription"
                                            class="form-control @error('companyDescription') is-invalid @enderror">{{ old('companyDescription') }}</textarea>
                                        @error('companyDescription')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <!-- Modal for Cropping -->
                                    <div class="modal fade" id="cropper-modal" tabindex="-1" role="dialog"
                                        aria-labelledby="cropperModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="cropperModalLabel">Crop Image</h5>
                                                    <button type="button" class="btn btn-secondary"
                                                        id="close-modal">Cancel</button>
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
                                                                <div class="preview"
                                                                    style="width: 150px; height: 150px; overflow: hidden;">
                                                                    <img id="preview-image" style="max-width: 100%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary"
                                                        id="crop-button">Crop</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="d-flex align-items-center">
                                        <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center"
                                            id="submitButton">
                                            <span id="buttonText">Submit</span>
                                            <div id="loaderSpinner" class="spinner-border spinner-border-sm d-none"
                                                role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </button>
                                    </div>

                                    <script>
                                        const form = document.getElementById('JobForm');
                                        const submitButton = document.getElementById('submitButton');
                                        const buttonText = document.getElementById('buttonText');
                                        const loaderSpinner = document.getElementById('loaderSpinner');

                                        form.addEventListener('submit', function() {
                                            submitButton.disabled = true;
                                            loaderSpinner.classList.remove('d-none');
                                            buttonText.style.display = 'none';
                                        });
                                    </script>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
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
                    width: 800, // Set your desired width
                    height: 200 // Set your desired height
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
            $('#companyDescription').summernote({
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
    <script>
        // Initialize the links array
        let linksArray = [];

        // Populate the table with old values when the page loads
        $(document).ready(function() {
            const oldLinks = JSON.parse($('#links').val() || '[]'); // Get the old links from the hidden input
            linksArray = oldLinks;

            // Add each link to the table
            oldLinks.forEach(link => {
                $('#taskTable tbody').append(`
                    <tr>
                        <td>${link}</td>
                        <td>
                            <i class="bx bx-x" onclick="removeRow(this, '${link}')" style="cursor: pointer; color: #bd2130;"></i>
                        </td>
                    </tr>
                `);
            });

            // Show the table if there are old links
            toggleTableVisibility();
        });

        function addToTable() {
            const link = $('#link').val().trim();

            if (!link) {
                $('#inputError').text('Please provide a link.').show();
                return;
            }

            // Check if the link is a valid URL
            if (!isValidUrl(link)) {
                $('#inputError').text('Please provide a valid URL.').show();
                return;
            }

            // Check if the link already exists in the array
            if (linksArray.includes(link)) {
                $('#inputError').text('This link already exists.').show();
                return;
            }

            // Check if the maximum number of links (3) has been reached
            if (linksArray.length >= 3) {
                $('#inputError').text('Maximum of 3 links allowed.').show();
                return;
            }

            $('#inputError').hide();

            // Add the link to the array
            linksArray.push(link);

            // Update the hidden input field with the current links
            updateHiddenInput();

            // Add the link to the table with a remove icon
            $('#taskTable tbody').append(`
                <tr>
                    <td>${link}</td>
                    <td>
                        <i class="bx bx-x" onclick="removeRow(this, '${link}')" style="cursor: pointer; color: #bd2130;"></i>
                    </td>
                </tr>
            `);

            // Clear the input field
            $('#link').val('');

            // Check if there are rows in the table and show or hide the table accordingly
            toggleTableVisibility();
        }

        function removeRow(button, link) {
            $(button).closest('tr').remove();

            // Remove the link from the array
            linksArray = linksArray.filter(item => item !== link);

            // Update the hidden input field with the current links
            updateHiddenInput();

            // Check if there are rows in the table and show or hide the table accordingly
            toggleTableVisibility();
        }

        function toggleTableVisibility() {
            const rowsCount = $('#taskTable tbody tr').length;

            // If there are no rows, hide the table, otherwise show it
            if (rowsCount === 0) {
                $('#taskTable').hide();
            } else {
                $('#taskTable').show();
            }
        }

        function updateHiddenInput() {
            $('#links').val(JSON.stringify(linksArray));
        }

        function isValidUrl(url) {
            try {
                new URL(url);
                return true;
            } catch (e) {
                return false;
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            const industryInput = $('#industry');
            const industryIdInput = $('#industry_id');
            const industryResults = $('#industry-results');
            const clearIndustryIcon = $('#clear-industry');

            // Check if an industry is already selected (old value)
            const selectedIndustry = industryInput.val();
            const selectedIndustryId = industryIdInput.val();


            // Show the clear icon if an industry is already selected
            if (selectedIndustryId) {
                clearIndustryIcon.show();
            }

            // Fetch industries on typing
            industryInput.on('input', function() {
                const query = $(this).val().trim();

                if (query.length > 0) {
                    fetchIndustries(query);
                } else {
                    industryResults.hide().empty();
                    clearIndustryIcon.hide();
                }
            });

            // Handle selection of an industry
            industryResults.on('click', '.list-group-item', function() {
                const selectedIndustry = $(this).data('industry');
                const selectedIndustryId = $(this).data('id');

                industryInput.val(selectedIndustry);
                industryIdInput.val(selectedIndustryId);

                // Show the remove icon
                clearIndustryIcon.show();

                // Hide the results dropdown
                industryResults.hide().empty();
            });

            // Remove selected industry
            clearIndustryIcon.on('click', function() {
                industryInput.val('');
                industryIdInput.val('');
                $(this).hide();
            });


            // Fetch industries from the backend
            function fetchIndustries(query) {
                $.ajax({
                    url: '{{ url('superadmin/industries') }}', // Replace with your API endpoint
                    method: 'GET',
                    data: {
                        q: query
                    },
                    success: function(response) {
                        if (Array.isArray(response) && response.length > 0) {
                            industryResults.empty();
                            response.forEach(function(industry) {
                                industryResults.append(
                                    `<div class="list-group-item w-100" data-id="${industry.id}" data-industry="${industry.industryName}">
                                        ${industry.industryName}
                                    </div>`
                                );
                            });
                            industryResults.show();
                        } else {
                            industryResults.hide().empty();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to fetch industries:', error);
                        industryResults.hide().empty();
                    },
                });
            }
        });
    </script>

@endsection
