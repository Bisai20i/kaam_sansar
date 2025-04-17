@extends('backend.layouts.main')

@section('title', 'Edit Job Company')

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
            <h4 class="fw-bold mb-4"><span class="text-muted fw-light"> </span> Edit Job Company</h4>

            <!-- Main Content -->
            <div class="row">
                <div class="col-12 ">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Edit Job Company</h5>

                            <a href="{{ route('jobCompany.index') }}" class="btn btn-primary btn-sm  text-white"><i
                                    class="bx bx-arrow-back" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                action="{{ route('jobCompany.update', ['jobCompany' => $jobCompany->id]) }}" id="JobForm"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

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
                                            value="{{ old('companyName', $jobCompany->companyName) }}"
                                            placeholder="Job Company Name">

                                        @error('companyName')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label"> Email Address
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="email"
                                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                            id="email" name="email" value="{{ old('email', $jobCompany->email) }}"
                                            placeholder="Email Address">

                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="industry" class="form-label">Industry
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div id="industry-wrapper" class="">
                                            <!-- Populate the industry input with old value or selected value -->
                                            <input type="text"
                                                class="form-control {{ $errors->has('industry_id') ? 'is-invalid' : '' }}"
                                                id="industry" name="industry_id" placeholder="Search for an industry..."
                                                autocomplete="off" value="{{ old('industry', $selectedIndustry) }}">

                                            <!-- Hidden input for industry_id value -->
                                            <input type="hidden" id="industry_id" name="industry_id"
                                                value="{{ old('industry_id', $jobCompany->industryCategoryId) }}">

                                            <!-- Display error message if industry_id has an error -->
                                            @if ($errors->has('industry_id'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('industry_id') }}
                                                </div>
                                            @endif

                                            <!-- Clear button icon that shows if an industry is selected -->
                                            <i class="bx bx-x remove-selected-industry" id="clear-industry"
                                                style="{{ old('industry_id', $selectedIndustryId) ? 'display: inline-block;' : 'display: none;' }}"
                                                onclick="clearIndustry()"></i>
                                        </div>

                                        <!-- Industry search results container (e.g., for a live search feature) -->
                                        <div id="industry-results" class="list-group"></div>
                                    </div>

                                    <script>
                                        // Function to clear selected industry
                                        function clearIndustry() {
                                            document.getElementById('industry').value = ''; // Clear the input field
                                            document.getElementById('industry_id').value = ''; // Clear the hidden industry_id field
                                            document.getElementById('clear-industry').style.display = 'none'; // Hide the clear icon
                                        }

                                        // Optional: Add an event listener to hide or show the clear button based on the input field's value
                                        document.getElementById('industry').addEventListener('input', function() {
                                            const industryValue = document.getElementById('industry').value;
                                            const clearIcon = document.getElementById('clear-industry');
                                            if (industryValue) {
                                                clearIcon.style.display = 'inline-block'; // Show the clear button when there is a value
                                            } else {
                                                clearIcon.style.display = 'none'; // Hide the clear button if the input is empty
                                            }
                                        });
                                    </script>


                                    <div class="mb-3 col-md-6">
                                        <label for="rating" class="form-label">Rating <span
                                                class="text-danger">*</span></label>
                                        <select id="rating" name="rating"
                                            class="form-select {{ $errors->has('rating') ? 'is-invalid' : '' }}">
                                            <option value="" disabled {{ old('rating') == '' ? 'selected' : '' }}>
                                                Select a rating</option>
                                            <option value="1"
                                                {{ old('rating', $jobCompany->reviewStatus) == '1' ? 'selected' : '' }}>⭐
                                            </option>
                                            <option value="2"
                                                {{ old('rating', $jobCompany->reviewStatus) == '2' ? 'selected' : '' }}>⭐⭐
                                            </option>
                                            <option value="3"
                                                {{ old('rating', $jobCompany->reviewStatus) == '3' ? 'selected' : '' }}>⭐⭐⭐
                                            </option>
                                            <option value="4"
                                                {{ old('rating', $jobCompany->reviewStatus) == '4' ? 'selected' : '' }}>
                                                ⭐⭐⭐⭐
                                            </option>
                                            <option value="5"
                                                {{ old('rating', $jobCompany->reviewStatus) == '5' ? 'selected' : '' }}>
                                                ⭐⭐⭐⭐⭐
                                            </option>
                                        </select>
                                        @error('rating')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- <div class="mb-3 col-md-6">
                                        <label for="link" class="form-label">Links
                                            <span class="text-danger">(max 3 links)</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control {{ $errors->has('links') ? 'is-invalid' : '' }}"
                                                id="link" placeholder="Add Link" style="flex: 2;">
                                            <input type="hidden" name="links" id="links"
                                                value="{{ old('links', $links ?? '[]') }}">
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
                                        <div class="table-responsive">
                                            <table class="table table-bordered mt-3 mb-3" id="taskTable">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th class="text-wrap" style="max-width: 600px;">Link</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (json_decode($links, true) ?? [] as $item)
                                                        @if (!empty($item))
                                                            <tr>
                                                                <td class="text-wrap" style="max-width: 600px;">
                                                                    <a href="{{ $item }}" target="_blank"
                                                                        class="text-decoration-none text-dark">{{ $item }}</a>
                                                                </td>
                                                                <td class="text-center">
                                                                    <i class="bx bx-x remove-link" aria-hidden="true"
                                                                        data-link="{{ $item }}"
                                                                        onclick="removeRow(this, '{{ $item }}')"></i>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> --}}
                                    <div class="mb-3 col-md-6">
                                        <label for="link" class="form-label">Links <span class="text-danger">(max 3
                                                links)</span></label>
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control {{ $errors->has('links') ? 'is-invalid' : '' }}"
                                                id="link" placeholder="Add Link" style="flex: 2;">
                                            <input type="hidden" name="links" id="links"
                                                value="{{ old('links', json_encode(array_filter(json_decode($links ?? '[]', true) ?? []))) }}">
                                            <button class="btn btn-primary" type="button" onclick="addToTable()"
                                                style="flex: 0 0 auto;">
                                                <i class="bx bx-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <div id="inputError" class="text-danger mt-1" style="display: none;"></div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered mt-3 mb-3" id="taskTable">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th class="text-wrap" style="max-width: 600px;">Link</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $decodedLinks = json_decode($links ?? '[]', true) ?? [];
                                                        $filteredLinks = array_filter($decodedLinks);
                                                    @endphp
                                                    {{-- @foreach ($filteredLinks as $item)
                                                        <tr>
                                                            <td class="text-wrap" style="max-width: 600px;">
                                                                <a href="{{ $item }}" target="_blank"
                                                                    class="text-decoration-none text-dark">{{ $item }}</a>
                                                            </td>
                                                            <td class="text-center">
                                                                <i class="bx bx-x remove-link"
                                                                    onclick="openDeleteModal('{{ $item }}', '{{ $jobCompany->id ?? '' }}')"
                                                                    style="cursor: pointer; color: red;"></i>
                                                            </td>
                                                        </tr>
                                                    @endforeach --}}
                                                </tbody>
                                            </table>
                                        </div>
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
                                                src="{{ isset($jobCompany) && $jobCompany->companyProfileImg ? asset('storage/' . $jobCompany->companyProfileImg) : '' }}"
                                                alt="Selected Profile Image"
                                                style="max-width: 200px; display: {{ isset($jobCompany) && $jobCompany->companyProfileImg ? 'block' : 'none' }}; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="companyDescription" class="form-label">
                                            Company Description <span class="text-danger">*</span>
                                        </label>
                                        <textarea name="companyDescription" id="companyDescription"
                                            class="form-control @error('companyDescription') is-invalid @enderror">{{ old('companyDescription', $jobCompany->companyDescription) }}</textarea>
                                        @error('companyDescription')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center"
                                            id="submitButton">
                                            <span id="buttonText">Update</span>
                                            <div id="loaderSpinner" class="spinner-border spinner-border-sm d-none"
                                                role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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


        <div class="modal fade" id="deleteLinkModal" tabindex="-1" aria-labelledby="deleteLinkModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteLinkModalLabel">Confirm Deletion
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to remove this link?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
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
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let existingLinks = [];

            try {
                existingLinks = JSON.parse($('#links').val()) || [];
            } catch (e) {
                existingLinks = [];
            }

            let linksArray = existingLinks.filter(link => link.trim() !== ""); // Remove empty links

            // Populate the table with existing links
            linksArray.forEach(link => addLinkToTable(link));

            window.addToTable = function() {
                const link = $('#link').val().trim();
                if (!link) {
                    $('#inputError').text('Please provide a link.').show();
                    return;
                }

                // Validate duplicate link check
                if (linksArray.some(existingLink => existingLink.toLowerCase() === link.toLowerCase())) {
                    $('#inputError').text('Duplicate links are not allowed.').show();
                    return;
                }

                const urlPattern = /^(https?:\/\/[^\s/$.?#].[^\s]*)$/i;
                if (!urlPattern.test(link)) {
                    $('#inputError').text('Please provide a valid URL.').show();
                    return;
                }

                // Ensure max 3 links
                if (linksArray.length >= 3) {
                    $('#inputError').text('Maximum of 3 links allowed.').show();
                    return;
                }

                $('#inputError').hide();
                linksArray.push(link);
                updateHiddenInput();
                addLinkToTable(link);
                $('#link').val('');
            };

            window.removeRow = function(button, link) {
                $(button).closest('tr').remove();
                linksArray = linksArray.filter(item => item !== link);
                updateHiddenInput();
            };

            function addLinkToTable(link) {
                $('#taskTable tbody').append(`
            <tr>
                <td><a href="${link}" target="_blank" class="text-decoration-none text-dark">${link}</a></td>
                <td class="text-center">
                    <i class="bx bx-x remove-link" onclick="removeRow(this, '${link}')" style="cursor: pointer; color: red;"></i>
                </td>
            </tr>
        `);
            }

            function updateHiddenInput() {
                $('#links').val(JSON.stringify(linksArray.length > 0 ? linksArray : []));
            }
        });
    </script>
    <script>
        // Function to open the delete confirmation modal
        function openDeleteModal(link, jobId) {
            // Save the link and job ID in the confirm button's dataset
            const confirmButton = document.getElementById('confirmDeleteButton');
            confirmButton.setAttribute('data-link', link);
            confirmButton.setAttribute('data-id', jobId);

            // Show the modal (Bootstrap's JS)
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteLinkModal'));
            deleteModal.show();
        }

        // Function to remove the link via AJAX
        function removeLink() {
            const confirmButton = document.getElementById('confirmDeleteButton');
            const link = confirmButton.getAttribute('data-link');
            const jobId = confirmButton.getAttribute('data-id');
            $.ajax({
                url: "{{ route('links.delete') }}", // Laravel route helper
                method: "POST",
                data: {
                    link: link,
                    jobId: jobId,
                    _token: '{{ csrf_token() }}' // CSRF token for Laravel
                },
                success: function(response) {
                    if (response.success) {
                        // Remove the corresponding row from the table
                        $(`[data-link='${link}']`).closest('tr').remove();

                        // Update any associated state variables (optional)
                        linksArray = linksArray.filter(item => item !== link);
                        updateHiddenInput(); // Custom function to update the hidden input
                        toggleTableVisibility(); // Custom function to toggle table visibility

                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error deleting the link:", xhr.responseText);
                    alert("Failed to delete the link. Please try again.");
                }
            });

            // Hide the modal (Bootstrap's JS)
            const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteLinkModal'));
            deleteModal.hide();
        }

        // Attach click event listener to the confirm delete button
        document.getElementById('confirmDeleteButton').addEventListener('click', removeLink);
    </script>
    <script>
        $(document).ready(function() {
            const industryInput = $('#industry');
            const industryIdInput = $('#industry_id');
            const industryResults = $('#industry-results');
            const clearIndustryIcon = $('#clear-industry');

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
                    url: '{{ route('fetchIndustries') }}', // Replace with your API endpoint
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
