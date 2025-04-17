@extends('backend.layouts.main')

@section('title', isset($aboard) ? 'Edit Product' : 'Create Product')

@section('content')

<div class="container py-5">
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
                        <h4 class="fw-bold m-0">{{ isset($aboard) ? 'Edit Product' : 'Create Product' }}</h4>
                        <a href="{{ route('aboards.index') }}" class="btn btn-primary btn-sm text-white">
                            <i class="bx bx-arrow-back" aria-hidden="true"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="card-body">
            <section class="section">
                <form id="formAuthentication" class="mb-3" novalidate
                    action="{{ isset($aboard) ? route('aboards.update', $aboard->id) : route('aboards.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($aboard))
                    @method('PUT')
                    @endif

                    <div class="row">

                        <!-- Product Title -->
                        <div class="mb-3 col-md-6">
                            <label for="productTitle" class="form-label">Product Title<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('productTitle') is-invalid @enderror" id="productTitle" name="productTitle"
                                value="{{ old('productTitle', $aboard->productTitle ?? '') }}"
                                placeholder="Enter Product Title" required>
                            @error('productTitle')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Product Category -->
                        <div class="mb-3 col-md-6">
                            <label for="productCategoryId" class="form-label">Product Category<span class="text-danger">*</span></label>
                            <select class="form-select @error('productCategoryId') is-invalid @enderror" id="productCategoryId" name="productCategoryId" required>
                                <option value="">Select Product Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('productCategoryId', $aboard->productCategoryId ?? '') == $category->id ? 'selected' : '' }}>{{ $category->product->CategoryTitle }}</option>
                                @endforeach
                            </select>
                            @error('productCategoryId')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Product Owner Name -->
                        <div class="mb-3 col-md-6">
                            <label for="productOwnerName" class="form-label">Product Owner Name</label>
                            <input type="text" class="form-control @error('productOwnerName') is-invalid @enderror" id="productOwnerName" name="productOwnerName"
                                value="{{ old('productOwnerName', $aboard->productOwnerName ?? '') }}"
                                placeholder="Enter Product Owner Name">
                            @error('productOwnerName')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contact Number -->
                        <div class="mb-3 col-md-6">
                            <label for="contactNumber" class="form-label">Contact Number</label>
                            <input type="text" class="form-control @error('contactNumber') is-invalid @enderror" id="contactNumber" name="contactNumber"
                                value="{{ old('contactNumber', $aboard->contactNumber ?? '') }}"
                                placeholder="Enter Contact Number">
                            @error('contactNumber')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pricing -->
                        <div class="mb-3 col-md-6">
                            <label for="pricing" class="form-label">Pricing<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('pricing') is-invalid @enderror" id="pricing" name="pricing"
                                value="{{ old('pricing', $aboard->pricing ?? '') }}" placeholder="Enter Product Pricing" required>
                            @error('pricing')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                       <!-- Ads Thumbnail -->
                       <div class="mb-3 col-md-6">
                                        <label for="file" class="form-label">Product Thumbnail</label>
                                        <input type="file"
                                            class="form-control @error('productThumbnail') is-invalid @enderror"
                                            id="file"
                                            name="productThumbnail" accept="image/*"
                                            onchange="loadImage(event)">

                                        @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <!-- Hidden input for Base64 -->
                                        <input type="hidden" id="croppedImageBase64" name="croppedImageBase64">
                                        <!-- Image Preview -->
                                        <div class="mt-3">
                                            <img id="imagePreview"
                                                src="{{ isset($aboard) && $aboard->productThumbnail ? asset('storage/' . $aboard->productThumbnail) : '' }}"
                                                alt="Selected Profile Image"
                                                style="max-width: 200px; display: {{ isset($aboard) && $aboard->productThumbnail ? 'block' : 'none' }}; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                        </div>

                                        @error('adsThumbnail')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                        <!-- Status -->
                        <div class="mb-3 col-md-6">
                            <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="Available" {{ old('status', $aboard->status ?? '') == 'Available' ? 'selected' : '' }}>Available</option>
                                <option value="Pre-Order" {{ old('status', $aboard->status ?? '') == 'Pre-Order' ? 'selected' : '' }}>Pre Order</option>
                                <option value="Back-Order" {{ old('status', $aboard->status ?? '') == 'Back-Order' ? 'selected' : '' }}>Back Order</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Publish Status -->
                        <div class="mb-3 col-md-6">
                            <label for="publishStatus" class="form-label">Publish Status</label>
                            <select class="form-select @error('publishStatus') is-invalid @enderror" id="publishStatus" name="publishStatus">
                                <option value="publish" {{ old('publishStatus', $aboard->publishStatus ?? '') == 'publish' ? 'selected' : '' }}>Publish</option>
                                <option value="unpublish" {{ old('publishStatus', $aboard->publishStatus ?? '') == 'unpublish' ? 'selected' : '' }}>Unpublish</option>
                            </select>
                            @error('publishStatus')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                           <!-- Product Description -->
                           <div class="mb-3 col-md-6">
                            <label for="productDescription" class="form-label">Product Description<span class="text-danger">*</span></label>
                            <textarea class="form-control @error('productDescription') is-invalid @enderror" id="productDescription" name="productDescription" rows="3"
                                placeholder="Enter Product Description" required>{{ old('productDescription', $aboard->productDescription ?? '') }}</textarea>
                            @error('productDescription')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                    </div>
                       <!-- Submit Button -->
                       <div class="mb-3 col-md-6">
                                    <button type="submit" class="btn btn-primary btn-sm" id="submitButton">
                                        <span id="buttonText">{{ isset($aboard) ? 'Update Product' : 'Create Product' }}</span>
                                        <div id="loaderSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                </div>

                </form>
            </section>
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
        $('#productDescription').summernote({
            placeholder: 'Write your description here...',
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
