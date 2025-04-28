@extends('backend.layouts.main')

@section('title', isset($adsManager) ? 'Edit Ads' : 'Create Ads')

@section('content')
    <div class="container py-4">
        <h4 class="fw-bold m-4">{{ isset($adsManager) ? 'Edit Ads' : 'Create Ads' }}</h4>

        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ isset($adsManager) ? 'Edit Ads Manager' : 'Add New Ads Manager' }}</h4>
                    <a href="{{ route('ads-manager.index') }}" class="btn btn-secondary btn-sm text-white">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('ads-manager.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="mb-3 col-md-6">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    <div class="d-flex flex-wrap">
                        <!-- Title -->
                        <div class="mb-3 col-12 col-md-6 px-2">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" placeholder="Title">
                        </div>

                        <!-- Link -->
                        <div class="mb-3 col-12 col-md-6 px-2">
                            <label class="form-label">Ad Link <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" name="link" placeholder="Ad URL">
                        </div>
                    </div>

                    <div class="d-flex flex-wrap">
                        <!-- Which Page -->
                        <div class="mb-3 col-12 col-md-6 px-2">
                            <label class="form-label">Which Page <span class="text-danger">*</span></label>
                            <select class="form-control" name="which_page">
                                <option value="home">Home</option>
                                <option value="jobs">Jobs Page</option>
                                <option value="resume">Resume</option>
                                <option value="abroad">Abroad Deals</option>
                                <option value="visa">Visa HQ</option>
                                <option value="insurance">Insurance</option>
                                <option value="forex">Forex Calculator</option>
                                <option value="horoscope">Horoscope</option>
                                <option value="gift">Gift & Coupons</option>
                                <option value="advertisement">Advertisement</option>
                                <option value="forum">Discussion Forum</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <!-- Position -->
                        <div class="mb-3 col-12 col-md-6 px-2">
                            <label class="form-label">Position <span class="text-danger">*</span></label>
                            <select class="form-control" name="position" id="selectPosition">
                                <option value="left">Left</option>
                                <option value="right">Right</option>
                                <option value="top">Top</option>
                                <option value="bottom">Bottom</option>
                                <option value="middle">Middle</option>
                            </select>
                        </div>
                    </div>



                    <div class="d-flex flex-wrap">
                        <!-- Publish or Not -->
                        <div class="mb-3 col-12 col-md-6 px-2">
                            <label class="form-label">Publish Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="publish_or_not">
                                <option value="1">Publish</option>
                                <option value="0">Unpublish</option>
                            </select>
                        </div>

                        <!-- Active Status -->
                        <div class="mb-3 col-12 col-md-6 px-2">
                            <label class="form-label">Active Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="active">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>


                    <!-- Image -->

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Ad Image <span id="aspectRatioInfo"
                            class="text-danger-subtle ms-2"></span></label>
        
                        <input type="file" class="form-control"
                            id="imageUrl" name="imageUrl" accept="image/*" required>
                        <!-- Hidden input for Base64 image -->
                        <input type="hidden" id="croppedImageBase64" name="image">
                        <!-- Image Preview -->
                        <div class="mt-3">
                            <img id="imagePreview"
                                src="#" alt="Selected Profile Image"
                                style="max-width: 200px; display: none; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                        </div>
                    </div>
                    {{-- <div class="mb-3 col-md-6">
                        <label class="form-label">Ad Image <span id="aspectRatioInfo"
                                class="text-danger-subtle ms-2"></span></label>
                        <input type="file" class="form-control" name="image">
                    </div> --}}

                    <button type="submit" class="btn btn-success">Save</button>
                </form>

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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>

    <script>
        let ratio = 1/3;
        document.getElementById('selectPosition').addEventListener('change', (e) => {

            if (document.getElementById('selectPosition').value === 'left' || document.getElementById('selectPosition').value === 'right') {
                document.getElementById('aspectRatioInfo').textContent = "( Aspect Ratio: 1:3 )"
                ratio = 1/3;
            } else {
                document.getElementById('aspectRatioInfo').textContent = "( Aspect Ratio: 4:1 )"
                ratio = 4/1;
            }

            console.log(ratio)

        })

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
                    aspectRatio: ratio, // Set your desired aspect ratio
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
        });
    </script>


@endsection
