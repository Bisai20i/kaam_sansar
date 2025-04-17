@extends('backend.layouts.main')

@section('title', isset($ads) ? 'Edit Advertisement' : 'Create Advertisement')

@section('content')

<div class="container py-5">
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
                        <h4 class="fw-bold m-0">{{ isset($ads) ? 'Edit Advertisement' : 'Create Advertisement' }}</h4>
                        <a href="{{ route('ads.index') }}" class="btn btn-primary btn-sm text-white">
                            <i class="bx bx-arrow-back" aria-hidden="true"></i> Back
                        </a>
                    </div>


                    <!-- Main Content -->
                    <div class="main-content">
                        <section class="section">
                            <form id="formAuthentication" class="mb-3" novalidate
                                action="{{ isset($ads) ? route('ads.update', $ads->id) : route('ads.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($ads))
                                @method('PUT')
                                @endif
                                <div class="row ">
                                    <!-- Advertisement Title -->
                                    <div class="mb-3 col-md-6">
                                        <label for="adsTitle" class="form-label">Advertisement Title<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('adsTitle') is-invalid @enderror" id="adsTitle" name="adsTitle"
                                            value="{{ old('adsTitle', $ads->adsTitle ?? '') }}"
                                            placeholder="Enter Ads title"
                                            required>

                                        @error('adsTitle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Category -->
                                    <div class="mb-3 col-md-6">
                                        <label for="adsCategoryId" class="form-label">Ads Category<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('adsCategoryId') is-invalid @enderror" id="adsCategoryId" name="adsCategoryId" required>
                                            <option value="">Select ads Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('adsCategoryId', $ads->adsCategoryId ?? '') == $category->id ? 'selected' : '' }}>{{ $category->adsCategoryTitle }}</option>
                                            @endforeach
                                        </select>
                                        @error('adsCategoryId')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Location -->
                                    <div class="mb-3 col-md-6">
                                        <label for="location" class="form-label">Location<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location"
                                            value="{{ old('location', $ads->location ?? '') }}"
                                            placeholder="Enter Ads Location "
                                            required>
                                        @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>



                                    <!-- Ads Owner -->
                                    <div class="mb-3 col-md-6">
                                        <label for="adsOwner" class="form-label">Ads Owner</label>
                                        <input type="text" class="form-control @error('adsOwner') is-invalid @enderror" id="adsOwner" name="adsOwner"
                                            value="{{ old('adsOwner', $ads->adsOwner ?? '') }}"
                                            placeholder="Enter name of ads Owner">
                                        @error('adsOwner')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>



                                    <!-- Pricing -->
                                    <div class="mb-3 col-md-6">
                                        <label for="pricing" class="form-label">Pricing<span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('pricing') is-invalid @enderror" id="pricing" name="pricing"
                                            value="{{ old('pricing', $ads->pricing ?? '') }}"
                                            placeholder="Enter pricing value"

                                            required>
                                        @error('pricing')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="mb-3 col-md-6">
                                        <label for="status" class="form-label">Status<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                            <option value="active" {{ old('status', $ads->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ old('status', $ads->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>

                                        @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <!-- Publish Status
                            <div class="mb-3 col-md-6">
                                <label for="publishStatus" class="form-label">Publish Status</label>
                                <input type="text" class="form-control @error('publishStatus') is-invalid @enderror" id="publishStatus" name="publishStatus" value="{{ old('publishStatus', $ads->publishStatus ?? '') }}" required>
                                @error('publishStatus')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> -->




                                    <!-- Contact Number -->
                                    <div class="mb-3 col-md-6">
                                        <label for="contactNumber" class="form-label">Contact Number<span
                                                class="text-danger">*</span></label>
                                        <input type="tel" class="form-control @error('contactNumber') is-invalid @enderror" id="contactNumber" name="contactNumber" value="{{ old('contactNumber', $ads->contactNumber ?? '') }}"
                                            pattern="[0-9]{10}"
                                            placeholder="Enter 10-digit phone number"
                                            required>
                                        @error('contactNumber')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Ads Thumbnail -->
                                    <div class="mb-3 col-md-6">
                                        <label for="file" class="form-label">Advertisement Thumbnail</label>
                                        <input type="file"
                                            class="form-control @error('adsThumbnail') is-invalid @enderror"
                                            id="file"
                                            name="adsThumbnail" accept="image/*"
                                            onchange="loadImage(event)">

                                        @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <!-- Hidden input for Base64 -->
                                        <input type="hidden" id="croppedImageBase64" name="croppedImageBase64">
                                        <!-- Image Preview -->
                                        <div class="mt-3">
                                            <img id="imagePreview"
                                                src="{{ isset($ads) && $ads->adsThumbnail ? asset('storage/' . $ads->adsThumbnail) : '' }}"
                                                alt="Selected Profile Image"
                                                style="max-width: 200px; display: {{ isset($ads) && $ads->adsThumbnail ? 'block' : 'none' }}; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                        </div>

                                        @error('adsThumbnail')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!-- Comment
                                    <div class="mb-3 col-md-6">
                                        <label for="comment" class="form-label">Comment</label>
                                        <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="3">{{ old('comment', $ads->comment ?? '') }}</textarea>
                                        @error('comment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div> -->

                                    <!-- Description -->
                                    <div class="mb-3 col-md-6">
                                        <label for="adsDescription" class="form-label">Description<span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control @error('adsDescription') is-invalid @enderror" id="adsDescription" name="adsDescription" rows="3"
                                            required>{{ old('adsDescription', $ads->adsDescription ?? '') }}</textarea>
                                        @error('adsDescription')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Position Title
                                    <div class="mb-3 col-md-6">
                                        <label for="positionTitle" class="form-label">Position Title<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('positionTitle') is-invalid @enderror" id="positionTitle" name="positionTitle" required>
                                            <option value="leftsidebar" {{ old('positionTitle', $ads->positionTitle ?? '') == 'leftsidebar' ? 'selected' : '' }}>Left Sidebar</option>
                                            <option value="rightsidebar" {{ old('positionTitle', $ads->positionTitle ?? '') == 'rightsidebar' ? 'selected' : '' }}>Right Sidebar</option>
                                            <option value="top" {{ old('positionTitle', $ads->positionTitle ?? '') == 'top' ? 'selected' : '' }}>Top</option>
                                            <option value="center" {{ old('positionTitle', $ads->positionTitle ?? '') == 'center' ? 'selected' : '' }}>Center</option>
                                            <option value="bottom" {{ old('positionTitle', $ads->positionTitle ?? '') == 'bottom' ? 'selected' : '' }}>Bottom</option>
                                            <option value="others" {{ old('positionTitle', $ads->positionTitle ?? '') == 'others' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('positionTitle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror -->

                                        <!-- Coordinates Section (Initially Hidden)
                                        <div id="coordinatesSection" style="display: none;">
                                            <div class="mb-3 col-md-6">
                                                <label for="xCoordinate" class="form-label">X Coordinate<span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control @error('xCoordinate') is-invalid @enderror" id="xCoordinate" name="xCoordinate" value="{{ old('xCoordinate', $ads->xCoordinate ?? '') }}">
                                                @error('xCoordinate')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="yCoordinate" class="form-label">Y Coordinate<span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control @error('yCoordinate') is-invalid @enderror" id="yCoordinate" name="yCoordinate" value="{{ old('yCoordinate', $ads->yCoordinate ?? '') }}">
                                                @error('yCoordinate')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div> -->
                                    </div>




                                </div>

                                <!-- Submit Button -->
                                <div class="mb-3 col-md-6">
                                    <button type="submit" class="btn btn-primary btn-sm" id="submitButton">
                                        <span id="buttonText">{{ isset($ads) ? 'Update' : 'Create Advertisement' }}</span>
                                        <div id="loaderSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                </div>



                    </div>
                    </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
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
<!-- JavaScript to show/hide coordinates and custom fields -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const positionTitle = document.getElementById('positionTitle');
        const coordinatesSection = document.getElementById('coordinatesSection');

        // Function to toggle visibility of coordinates section
        function toggleCoordinatesSection() {
            if (positionTitle.value === 'other') {
                coordinatesSection.style.display = 'block'; // Show coordinates section
            } else {
                coordinatesSection.style.display = 'none'; // Hide coordinates section
            }
        }

        // Trigger on page load to ensure correct visibility
        toggleCoordinatesSection();

        // Event listener for positionTitle change
        positionTitle.addEventListener('change', toggleCoordinatesSection);
    });
</script>

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
        $('#adsDescription,#comment').summernote({
            placeholder: 'Write your message/description here...',
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
@endsection