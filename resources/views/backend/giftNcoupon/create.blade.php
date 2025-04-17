@extends('backend.layouts.main')

@section('title', 'Gift and Coupon')

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
            <h4 class="fw-bold mb-4"><span class="text-muted fw-light"> </span> Gift and Coupon</h4>

            <!-- Main Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0 text-capitalize">{{ isset($giftCoupon) ? 'Edit' : 'Add' }}
                                {{ isset($type) ? $type == '0'? 'Gift': 'Coupon' : '' }}</h5>
                            <a href="{{ route('giftNcoupon.index') }}" class="btn btn-primary btn-sm text-white">
                                <i class="bx bx-arrow-back" aria-hidden="true"></i> Back
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="POST" id="giftNcouponForm"
                                action="{{ isset($giftCoupon) ? route('giftNcoupon.update',['giftNcoupon'=> $giftCoupon->id]) : route('giftNcoupon.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @if (isset($giftCoupon))
                                    @method('PUT')
                                @endif

                                <div class="row">
                                    <!-- Gift or Coupon Type -->
                                    <div class="mb-3 col-md-6">
                                        <label for="giftOrCoupon" class="form-label">Type <span
                                                class="text-danger">*</span></label>
                                        <select id="giftOrCoupon" name="type" autofocus
                                            class="form-select {{ $errors->has('type') ? 'is-invalid' : '' }}">
                                            <option value="0"
                                                {{ old('type', isset($giftCoupon) ? $giftCoupon->type : '') == '0' ? 'selected' : '' }}>
                                                Gift
                                            </option>
                                            <option value="1"
                                                {{ old('type', isset($giftCoupon) ? $giftCoupon->type : '') == '1' ? 'selected' : '' }}>
                                                Coupon
                                            </option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    

                                    <div class="mb-3 col-md-6">
                                        <label for="gift category" class="form-label">Category <span
                                                class="text-danger">*</span></label>
                                        <select id="giftCategory" name="giftCategoryId" autofocus
                                            class="form-select {{ $errors->has('giftCategoryId') ? 'is-invalid' : '' }}">
                                            <option> -- Select Category --</option>
                                            @foreach ($giftcategories as $category)
                                            <option value="{{$category->id}}"
                                                {{ old('type', isset($giftCoupon) ? $giftCoupon->giftCategoryId : '') == $category->id ? 'selected' : '' }}>
                                                {{$category->giftCategoryTitle}}	
                                            </option>
                                            @endforeach
                                            
                                        </select>
                                        @error('type')
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
                                            value="{{ old('title', isset($giftCoupon) ? $giftCoupon->title : '') }}"
                                            required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Country -->
                                    <div class="mb-3 col-md-6">
                                        <label for="title" class="form-label">Country <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}"
                                            id="country" name="country" placeholder="Enter Country"
                                            value="{{ old('country', isset($giftCoupon) ? $giftCoupon->country : '') }}"
                                            required>
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="title" class="form-label">City <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                                            id="city" name="city" placeholder="Enter City"
                                            value="{{ old('city', isset($giftCoupon) ? $giftCoupon->city : '') }}"
                                            required>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="mb-3 col-md-6">
                                        <label for="title" class="form-label">Item Code <span
                                                class="text-danger">{{isset($giftCoupon)?"":"*"}}</span></label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('itemCode') ? 'is-invalid' : '' }}"
                                            id="itemCode" name="itemCode" placeholder="Enter Item Code"
                                            value="{{ old('itemCode', isset($giftCoupon) ? $giftCoupon->itemCode : '') }}"
                                            {{isset($giftCoupon)?"":"required"}}>
                                        @error('itemCode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="title" class="form-label">Discount Percentage</label>
                                        <input type="number"
                                            class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}"
                                            id="discount" name="discount" placeholder="Enter discount Percentage"
                                            value="{{ old('discount', isset($giftCoupon) ? $giftCoupon->discount : '') }}"
                                            required min="0" max="100" step="0.01">
                                        @error('discount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="title" class="form-label">Quantity <span
                                                class="text-danger">*</span></label>
                                        <input type="number"
                                            class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}"
                                            id="quantity" name="quantity" placeholder="Enter Quantity"
                                            value="{{ old('quantity', isset($giftCoupon) ? $giftCoupon->quantity : '') }}"
                                            required>
                                        @error('quantity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="title" class="form-label">Price <span
                                                class="text-danger">*</span></label>
                                        <input type="number"
                                            class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                            id="price" name="price" placeholder="Enter price"
                                            value="{{ old('price', isset($giftCoupon) ? $giftCoupon->price : '') }}"
                                            required>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="customApplied" class="form-label">Custom Applied<span
                                                class="text-danger">*</span></label>
                                        <select id="customApplied" name="customApplied" autofocus
                                            class="form-select {{ $errors->has('customApplied') ? 'is-invalid' : '' }}">
                                            <option value="0" selected
                                                {{ old('customApplied', isset($giftCoupon) ? $giftCoupon->customApplied : '') == '0' ? 'selected' : '' }}>
                                                No
                                            </option>
                                            <option value="1"
                                                {{ old('customApplied', isset($giftCoupon) ? $giftCoupon->customApplied : '') == '1' ? 'selected' : '' }}>
                                                Yes
                                            </option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="mb-3 col-md-6">
                                        <label for="imageUrl" class="form-label">Thumbnail <span
                                                class="text-danger">{{isset($giftCoupon)?'':'*'}}</span></label>
                                        <input type="file"
                                            class="form-control {{ $errors->has('file') ? 'is-invalid' : '' }}"
                                            id="imageUrl" name="imageUrl" accept="image/*" onchange="loadImage(event)"
                                            {{ isset($giftCoupon) && $giftCoupon->thumbnail ? '' : 'required' }}>
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
                                                src="{{ isset($giftCoupon) && $giftCoupon->thumbnail ? asset('storage/'.$giftCoupon->thumbnail) : '' }}"
                                                alt="Selected Profile Image"
                                                style="max-width: 200px; display: {{ isset($giftCoupon) && $giftCoupon->thumbnail ? 'block' : 'none' }}; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                        </div>
                                    </div>

                                    <style>
                                        .input-group-text {
                                            cursor: pointer;
                                            background-color: #f8f9fa;
                                            max-height: 40px;
                                        }
                                    </style>
                                    

                                    <div class="mb-3 col-md-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea id="description" name="description"
                                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Enter description">{{ old('description', isset($giftCoupon) ? $giftCoupon->description : '') }}</textarea>
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
                                        const form = document.getElementById('giftNcouponForm');
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
                placeholder: 'Write the description for your item here...',
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
