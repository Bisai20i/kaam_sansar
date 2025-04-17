@extends('backend.layouts.main')

@section('title', 'Dashboard')

@section('content')
    <style>
        #visa-type-results,
        #visa-country-results {
            z-index: 1000;
            max-height: 100px;
            overflow-y: auto;
            background-color: #fff;
            display: none;
            max-width: 400px;
            position: absolute;
            border: 1px solid #ccc;
        }

        #visa-type-results .list-group-item,
        #visa-country-results .list-group-item {
            cursor: pointer;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        #visa-type-results .list-group-item:hover,
        #visa-country-results .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .remove-selected-item {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #dc3545;
            font-size: 18px;

        }

        .remove-selected-item:hover {
            color: #bd2130;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <h4 class="fw-bold mb-4"><span class="text-muted fw-light"> </span> Visa Details</h4>

            <!-- Main Content -->
            <div class="row">
                <div class="col-12 ">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">{{ isset($visaDetails) ? 'Edit' : 'Add' }} Visa Details</h5>

                            <a href="{{ route('visadetails.index') }}" class="btn btn-primary btn-sm  text-white"><i
                                    class="bx bx-arrow-back" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                action="{{ isset($visaDetails) ? route('visadetails.update', ['visadetail' => $visaDetails->id]) : route('visadetails.store') }}"
                                id="JobForm" enctype="multipart/form-data">
                                @csrf
                                @if (isset($visaDetails))
                                    @method('PUT')
                                @endif

                                <div class="row">


                                    <div class="mb-3 col-md-6 position-relative">
                                        <label for="visaTypeSearch" class="form-label">Search Visa Type <span
                                                class="text-danger">*</span></label>
                                        <div class="position-relative">
                                            <input type="text" id="visaTypeSearch"
                                                class="form-control{{ $errors->has('visaTypeId') ? ' is-invalid' : '' }}"
                                                placeholder="Search Visa Type"
                                                value="{{ old('visaTypeSearch', $visaDetails->visaType->visaTypeName ?? '') }}">
                                            <span id="removeVisaType" class="remove-selected-item d-none">&times;</span>
                                            <div id="visa-type-results" class="list-group"></div>
                                        </div>
                                        <input type="hidden" name="visaTypeId" id="visaTypeId"
                                            value="{{ old('visaTypeId', $visaDetails->visaTypeId ?? '') }}">
                                        @error('visaTypeId')
                                            <div class="text-danger m-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6 position-relative">
                                        <label for="visaCountrySearch" class="form-label">Search Visa Country <span
                                                class="text-danger">*</span></label>
                                        <div class="position-relative">
                                            <input type="text" id="visaCountrySearch"
                                                class="form-control{{ $errors->has('visaCountryId') ? ' is-invalid' : '' }}"
                                                placeholder="Search Visa Country"
                                                value="{{ old('visaCountrySearch', $visaDetails->visaCountry->countryName ?? '') }}">
                                            <span id="removeVisaCountry" class="remove-selected-item d-none">&times;</span>
                                            <div id="visa-country-results" class="list-group"></div>
                                        </div>
                                        <input type="hidden" name="visaCountryId" id="visaCountryId"
                                            value="{{ old('visaCountryId', $visaDetails->visaCountryId ?? '') }}">

                                        @error('visaCountryId')
                                            <div class="text-danger m-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="demoVideoLink" class="form-label">Demo Video Link</label>
                                        <input type="text" name="demoVideoLink" id="demoVideoLink"
                                            class="form-control{{ $errors->has('demoVideoLink') ? ' is-invalid' : '' }}"
                                            value="{{ old('demoVideoLink', $visaDetails->demoVideoLink ?? '') }}"
                                            placeholder="Enter your demo video link">

                                        @error('demoVideoLink')
                                            <div class="text-danger m-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="demoVideoThumbnail" class="form-label">Demo Video Thumbnail</label>
                                        <input type="file" name="demoVideoThumbnail" id="demoVideoThumbnail"
                                            class="form-control {{ $errors->has('demoVideoThumbnail') ? ' is-invalid' : '' }}"
                                            accept="image/*" onchange="loadThumbnail(event)">
                                        <!-- Hidden input for Base64 thumbnail -->
                                        <input type="hidden" id="croppedThumbnailBase64" name="croppedThumbnailBase64">
                                        @if (@$visaDetails->demoVideoThumbnail != null)
                                            <img src="{{ asset('storage/' . $visaDetails->demoVideoThumbnail) }}"
                                                alt=""
                                                srcset=""style="max-width: 200px;  border: 1px solid #ddd; padding: 5px; border-radius: 5px;  margin-top: 10px;">
                                        @endif
                                        <!-- Thumbnail Preview -->
                                        <div class="mt-3">
                                            <img id="thumbnailPreview" src="" alt="Selected Thumbnail Image"
                                                style="max-width: 200px; display: none; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                        </div>

                                        @error('demoVideoThumbnail')
                                            <div class="text-danger m-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="embassyFee" class="form-label">Embassy Fee</label>
                                        <input type="text" name="embassyFee" id="embassyFee"
                                            class="form-control {{ $errors->has('embassyFee') ? ' is-invalid' : '' }}"
                                            value="{{ old('embassyFee', $visaDetails->embassyFee ?? '') }}"
                                            placeholder="Enter your embassy fee">

                                        @error('embassyFee')
                                            <div class="text-danger m-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="serviceFee" class="form-label">Service Fee</label>
                                        <input type="text" name="serviceFee" id="serviceFee"
                                            class="form-control{{ $errors->has('serviceFee') ? ' is-invalid' : '' }}"
                                            value="{{ old('serviceFee', $visaDetails->serviceFee ?? '') }}"
                                            placeholder="Enter your service fee">

                                        @error('serviceFee')
                                            <div class="text-danger m-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description"
                                            class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{ old('description', $visaDetails->description ?? '') }}</textarea>

                                        @error('description')
                                            <div class="text-danger m-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cropper Modal -->
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

            // Load thumbnail into cropper when file input changes
            $('#demoVideoThumbnail').change(function(e) {
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
                    aspectRatio: 16 / 9, // Set your desired aspect ratio for thumbnails
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

            // Crop the thumbnail and display the result
            $('#crop-button').click(function() {
                if (!cropper) return;

                var canvas = cropper.getCroppedCanvas({
                    width: 800, // Set your desired width
                    height: 450 // Set your desired height
                });

                canvas.toBlob(function(blob) {
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        $('#thumbnailPreview').attr('src', base64data).show();
                        $('#croppedThumbnailBase64').val(
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
    <script>
        $(document).ready(function() {
            // Fetch Visa Types on search
            $('#visaTypeSearch').on('input', function() {
                var query = $(this).val();
                if (query.length > 0) {
                    $.ajax({
                        url: '{{ route('fetch.visa.types') }}',
                        method: 'GET',
                        data: {
                            search: query
                        },
                        success: function(response) {
                            $('#visa-type-results').empty().show();
                            response.forEach(function(visaType) {
                                $('#visa-type-results').append(
                                    `<div class="list-group-item" data-id="${visaType.id}" data-name="${visaType.visaTypeName}">${visaType.visaTypeName}</div>`
                                );
                            });
                        }
                    });
                } else {
                    $('#visa-type-results').empty().hide();
                }
            });

            // Select Visa Type and Show Remove Button
            $(document).on('click', '#visa-type-results .list-group-item', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                $('#visaTypeSearch').val(name);
                $('#visaTypeId').val(id);
                $('#removeVisaType').removeClass('d-none'); // Show remove button
                $('#visa-type-results').empty().hide();
            });

            // Remove selected Visa Type
            $('#removeVisaType').on('click', function() {
                $('#visaTypeSearch').val('');
                $('#visaTypeId').val('');
                $(this).addClass('d-none'); // Hide remove button
            });

            // Fetch Visa Countries on search
            $('#visaCountrySearch').on('input', function() {
                var query = $(this).val();
                if (query.length > 0) {
                    $.ajax({
                        url: '{{ route('fetch.visa.countries') }}',
                        method: 'GET',
                        data: {
                            search: query
                        },
                        success: function(response) {
                            $('#visa-country-results').empty().show();
                            response.forEach(function(country) {
                                $('#visa-country-results').append(
                                    `<div class="list-group-item" data-id="${country.id}" data-name="${country.countryName}">${country.countryName}</div>`
                                );
                            });
                        }
                    });
                } else {
                    $('#visa-country-results').empty().hide();
                }
            });

            // Select Visa Country and Show Remove Button
            $(document).on('click', '#visa-country-results .list-group-item', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                $('#visaCountrySearch').val(name);
                $('#visaCountryId').val(id);
                $('#removeVisaCountry').removeClass('d-none'); // Show remove button
                $('#visa-country-results').empty().hide();
            });

            // Remove selected Visa Country
            $('#removeVisaCountry').on('click', function() {
                $('#visaCountrySearch').val('');
                $('#visaCountryId').val('');
                $(this).addClass('d-none'); // Hide remove button
            });

            $('#description').summernote({
                placeholder: 'Write your  description here...',
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
