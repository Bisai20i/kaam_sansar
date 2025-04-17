@extends('backend.layouts.main')

@section('title', 'Blogs and Podcasts')

@section('content')

    <style>
        .input-group {
            max-width: 300px;
            /* Adjust as needed */
        }

        .input-group-text {
            background-color: #f8f9fa;
            /* Light gray background */
            border: 1px solid #ced4da;
            /* Match Bootstrap's input border */
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <h4 class="fw-bold mb-4"><span class="text-muted fw-light"> </span> Blogs and Podcasts</h4>

            <!-- Main Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0 text-capitalize">{{ isset($blogsAndPodcast) ? 'Edit' : 'Add' }}
                                {{ isset($type) ? $type : '' }}</h5>
                            <a href="{{ route('blogsAndPodcast.index') }}" class="btn btn-primary btn-sm text-white">
                                <i class="bx bx-arrow-back" aria-hidden="true"></i> Back
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="POST" id="BlogOrPodcastForm"
                                action="{{ isset($blogsAndPodcast) ? route('blogsAndPodcast.update', ['blogsAndPodcast' => $blogsAndPodcast->id]) : route('blogsAndPodcast.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @if (isset($blogsAndPodcast))
                                    @method('PUT')
                                @endif

                                <div class="row">
                                    <!-- Blog or Podcast Type -->
                                    {{-- <div class="mb-3 col-md-6">
                                        <label for="blogOrPodcast" class="form-label">Type <span
                                                class="text-danger">*</span></label>
                                        <select id="blogOrPodcast" name="blogOrPodcast" autofocus
                                            class="form-select {{ $errors->has('blogOrPodcast') ? 'is-invalid' : '' }}">
                                            <option value="blog"
                                                {{ old('blogOrPodcast', isset($blogsAndPodcast) ? $blogsAndPodcast->blogOrPodcast : '') == 'blog' ? 'selected' : '' }}>
                                                Blog
                                            </option>
                                            <option value="podcast"
                                                {{ old('blogOrPodcast', isset($blogsAndPodcast) ? $blogsAndPodcast->blogOrPodcast : '') == 'podcast' ? 'selected' : '' }}>
                                                Podcast
                                            </option>
                                        </select>
                                        @error('blogOrPodcast')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div> --}}



                                    <div class="mb-3 col-md-6">
                                        <label for="blogOrPodcast" class="form-label">Type <span class="text-danger">*</span></label>
                                        <select id="blogOrPodcast" name="blogOrPodcast" autofocus
                                            class="form-select {{ $errors->has('blogOrPodcast') ? 'is-invalid' : '' }}">
                                            <option value="blog"
                                                {{ old('blogOrPodcast', isset($blogsAndPodcast) ? $blogsAndPodcast->blogOrPodcast : '') == 'blog' ? 'selected' : '' }}>
                                                Blog
                                            </option>
                                            <option value="podcast"
                                                {{ old('blogOrPodcast', isset($blogsAndPodcast) ? $blogsAndPodcast->blogOrPodcast : '') == 'podcast' ? 'selected' : '' }}>
                                                Podcast
                                            </option>
                                        </select>
                                        @error('blogOrPodcast')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Message Box -->
                                    <div id="messageBox" class="alert alert-info mt-2" style="display: none;"></div>
                                    <!-- Title -->
                                    <div class="mb-3 col-md-6">
                                        <label for="title" class="form-label">Title <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                            id="title" name="title" placeholder="Enter title"
                                            value="{{ old('title', isset($blogsAndPodcast) ? $blogsAndPodcast->title : '') }}"
                                            required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="mb-3 col-md-6">
                                        <label for="imageUrl" class="form-label">Thumbnail <span
                                                class="text-danger">*</span></label>
                                        <input type="file"
                                            class="form-control {{ $errors->has('file') ? 'is-invalid' : '' }}"
                                            id="imageUrl" name="imageUrl" accept="image/*" onchange="loadImage(event)"
                                            {{ isset($blogsAndPodcast) && $blogsAndPodcast->imageUrl ? '' : 'required' }}>
                                        @error('imageUrl')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <!-- Hidden input for Base64 image -->
                                        <input type="hidden" id="croppedImageBase64" name="croppedImageBase64">
                                        <!-- Image Preview -->
                                        <div class="mt-3">
                                            <img id="imagePreview"
                                                src="{{ isset($blogsAndPodcast) && $blogsAndPodcast->imageUrl ? asset('storage/' . $blogsAndPodcast->imageUrl) : '' }}"
                                                alt="Selected Profile Image"
                                                style="max-width: 200px; display: {{ isset($blogsAndPodcast) && $blogsAndPodcast->imageUrl ? 'block' : 'none' }}; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                        </div>
                                    </div>

                                    <style>
                                        .input-group-text {
                                            cursor: pointer;
                                            background-color: #f8f9fa;
                                            max-height: 40px;
                                        }
                                    </style>
                                    <!-- Image URL, Link URL, and Podcast Time (Visible for Podcast) -->
                                    {{-- @if (isset($blogsAndPodcast) && $blogsAndPodcast->blogOrPodcast === 'podcast') --}}
                                    <div class="mb-3 col-md-6" id="podcastFields">
                                        {{-- <label for="linkUrl" class="form-label">Podcast URL</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('linkUrl') ? 'is-invalid' : '' }}"
                                            id="linkUrl" name="linkUrl" placeholder="Enter podcast link URL"
                                            value="{{ old('linkUrl', $blogsAndPodcast->linkUrl ?? '') }}">
                                        @error('linkUrl')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror --}}







                                        <div class="mb-3 col-md-6" id="podcastUrlField" style="display: none;">
                                            <label for="linkUrl" class="form-label">Podcast URL <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('linkUrl') ? 'is-invalid' : '' }}"
                                                id="linkUrl" name="linkUrl" placeholder="Enter podcast link URL"
                                                value="{{ old('linkUrl', $blogsAndPodcast->linkUrl ?? '') }}">
                                            @error('linkUrl')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function () {
                                                let typeSelect = document.getElementById("blogOrPodcast");
                                                let podcastField = document.getElementById("podcastUrlField");
                                                let linkUrlInput = document.getElementById("linkUrl");
                                        
                                                function togglePodcastField() {
                                                    if (typeSelect.value === "podcast") {
                                                        podcastField.style.display = "block";
                                                        linkUrlInput.setAttribute("required", "required");
                                                    } else {
                                                        podcastField.style.display = "none";
                                                        linkUrlInput.removeAttribute("required");
                                                    }
                                                }
                                        
                                                typeSelect.addEventListener("change", togglePodcastField);
                                                togglePodcastField(); // Run on page load to handle preselected values
                                            });
                                        </script>





                                        <label for="podcastTime" class="form-label">Podcast Time</label>
                                        <div class="input-group">
                                            @php
                                                $podcastTime = isset($blogsAndPodcast->podcastTime)
                                                    ? explode(':', $blogsAndPodcast->podcastTime)
                                                    : ['00', '00', '00'];
                                            @endphp

                                            <!-- Hours -->
                                            <div class="d-flex flex-column text-center">
                                                <input type="number" class="form-control rounded-0 border-end-0"
                                                    id="hours" name="hours" min="0" max="24"
                                                    placeholder="HH" value="{{ old('hours', $podcastTime[0] ?? '00') }}">
                                                <small class="form-text text-primary">Hours</small>
                                            </div>

                                            <span class="input-group-text rounded-0 border-end-0">:</span>

                                            <!-- Minutes -->
                                            <div class="d-flex flex-column text-center">
                                                <input type="number" class="form-control rounded-0 border-end-0"
                                                    id="minutes" name="minutes" min="0" max="59"
                                                    placeholder="MM" value="{{ old('minutes', $podcastTime[1] ?? '00') }}">
                                                <small class="form-text text-primary">Minutes</small>
                                            </div>

                                            <span class="input-group-text rounded-0">:</span>

                                            <!-- Seconds -->
                                            <div class="d-flex flex-column text-center">
                                                <input type="number" class="form-control rounded-0" id="seconds"
                                                    name="seconds" min="0" max="59" placeholder="SS"
                                                    value="{{ old('seconds', $podcastTime[2] ?? '00') }}">
                                                <small class="form-text text-primary">Seconds</small>
                                            </div>
                                        </div>

                                        <!-- Hidden input to store the formatted time -->
                                        <input type="hidden" id="podcastTime" name="podcastTime"
                                            value="{{ old('podcastTime', $blogsAndPodcast->podcastTime ?? '') }}">

                                        <!-- Validation Error -->
                                        @error('podcastTime')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- @endif --}}

                                    <div class="mb-3 col-md-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea id="description" name="description"
                                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Enter description">{{ old('description', isset($blogsAndPodcast) ? $blogsAndPodcast->description : '') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
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
                                        const form = document.getElementById('BlogOrPodcastForm');
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
                            </form>
                        </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hoursInput = document.getElementById('hours');
            const minutesInput = document.getElementById('minutes');
            const secondsInput = document.getElementById('seconds');
            const podcastTimeInput = document.getElementById('podcastTime');

            // Function to update the hidden input with the formatted time
            function updatePodcastTime() {
                const hours = String(hoursInput.value).padStart(2, '0');
                const minutes = String(minutesInput.value).padStart(2, '0');
                const seconds = String(secondsInput.value).padStart(2, '0');
                podcastTimeInput.value = `${hours}:${minutes}:${seconds}`;
            }

            // Add event listeners to update the hidden input whenever the values change
            hoursInput.addEventListener('input', updatePodcastTime);
            minutesInput.addEventListener('input', updatePodcastTime);
            secondsInput.addEventListener('input', updatePodcastTime);

            // Initialize the hidden input value on page load
            updatePodcastTime();
        });
    </script>

    <script>
        $(document).ready(function() {
            var $modal = $('#cropper-modal');
            var image = document.getElementById('cropper-image');
            var cropper;

            // Load image into cropper when file input changes
            $('#imageUrl').change(function(e) {
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
                    width: 600, // Set your desired width
                    height: 400 // Set your desired height
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
            $('#description').summernote({
                placeholder: 'Write your blog and podcast description here...',
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

    <!-- Script to Show/Hide Podcast Time Field -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to toggle fields based on selection
            function toggleFields() {
                const selectedType = $('#blogOrPodcast').val();
                if (selectedType === 'blog') {
                    $('#imageFileField').show(); // Show image file upload for blog
                    $('#podcastFields').hide(); // Hide podcast-specific fields
                } else if (selectedType === 'podcast') {
                    $('#imageFileField').hide(); // Hide image file upload for podcast
                    $('#podcastFields').show(); // Show podcast-specific fields
                }
            }
            // Initial call to set the correct fields on page load
            toggleFields();

            // Event listener for changes in the dropdown
            $('#blogOrPodcast').change(function() {
                toggleFields();
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const blogOrPodcastDropdown = document.getElementById('blogOrPodcast');
            const podcastFields = document.getElementById('podcastFields');
            const imageFileField = document.getElementById('imageFileField');
            const linkUrlInput = document.getElementById('linkUrl');
            const hoursInput = document.getElementById('hours');
            const minutesInput = document.getElementById('minutes');
            const secondsInput = document.getElementById('seconds');

            // Function to toggle fields based on selection
            function toggleFields() {
                const selectedType = blogOrPodcastDropdown.value;

                if (selectedType === 'blog') {
                    // Show image file upload for blog
                    imageFileField.style.display = 'block';
                    // Hide podcast-specific fields
                    podcastFields.style.display = 'none';

                    // Remove required attribute from podcast fields
                    linkUrlInput.removeAttribute('required');
                    hoursInput.removeAttribute('required');
                    minutesInput.removeAttribute('required');
                    secondsInput.removeAttribute('required');
                } else if (selectedType === 'podcast') {
                    // Hide image file upload for podcast
                    imageFileField.style.display = 'none';
                    // Show podcast-specific fields
                    podcastFields.style.display = 'block';

                    // Add required attribute to podcast fields
                    linkUrlInput.setAttribute('required', true);
                    hoursInput.setAttribute('required', true);
                    minutesInput.setAttribute('required', true);
                    secondsInput.setAttribute('required', true);
                }
            }

            // Initial call to set the correct fields on page load
            toggleFields();

            // Event listener for changes in the dropdown
            blogOrPodcastDropdown.addEventListener('change', toggleFields);
        });
    </script>
@endsection
