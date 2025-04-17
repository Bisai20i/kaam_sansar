@extends('backend.layouts.main')

@section('title', 'Horoscopes List')

@section('content')

<style>
    .btn-sm.active {
        border-color:rgb(43, 167, 132);
        background-color:rgb(66, 73, 107);
        color: white;
        border-width: 4px;  /* Thicker border */

    }
</style>

<div class="container py-4">
    <h4 class="fw-bold m-4">Horoscopes List</h4>

    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title">Horoscope Details</h4>
                </div>
                <div>
                    <a href="{{ route('horoscope.create') }}" class="btn btn-primary btn-sm text-white">Add Horoscope</a>
                </div>
            </div>
        </div>
        <div class="card-body">

            <section class="section">
                <!-- Filter Buttons Container -->
                <div class="d-flex justify-content-start mb-3">
                    <a href="{{ route('horoscope.index', ['type' => 'daily']) }}" class="btn btn-info me-1 btn-sm {{ $type == 'daily' ? 'active' : '' }}">Daily</a>
                    <a href="{{ route('horoscope.index', ['type' => 'weekly']) }}" class="btn btn-primary me-1 btn-sm {{ $type == 'weekly' ? 'active' : '' }}">Weekly</a>
                    <a href="{{ route('horoscope.index', ['type' => 'monthly']) }}" class="btn btn-warning me-1 btn-sm {{ $type == 'monthly' ? 'active' : '' }}">Monthly</a>
                    <a href="{{ route('horoscope.index', ['type' => 'yearly']) }}" class="btn btn-success me-1 btn-sm {{ $type == 'yearly' ? 'active' : '' }}">Yearly</a>
                </div>
            </section>

            <!-- Horoscope List -->
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Zodiac Sign Image </th>

                            <th>Zodiac Sign</th>
                            <th>Type</th>
                            <th>Zodiac Sign Description(Eng)</th>
                            <th>Publish Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="horoscope-list">
                        @foreach ($horoscopes as $horoscope)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                                    @if ($horoscope->zodiacImgEnglish)
                                                        <img src="{{ asset($horoscope->zodiacImgEnglish) }}"
                                                            width="100" height="auto" alt="Horoscope">
                                                    @else
                                                        No image
                                                    @endif
                                                </td>
                                <td>{{ $horoscope->zodiacSignEnglish }}-{{ $horoscope->zodiacSignNepali }}</td>
                                <td>{{ ucfirst($horoscope->type) }}</td>
                                <td>{{ Str::limit(strip_tags($horoscope->contentEn), 30) }}</td>
                              
                                <td>{{ $horoscope->publishDate }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('horoscope.edit', $horoscope->id) }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                            <a class="dropdown-item text-danger" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $horoscope->id }}">
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                             <!-- Delete Modal -->
                             <div class="modal fade" id="deleteModal{{ $horoscope->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Confirmation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('horoscope.destroy', $horoscope->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    Are you sure you want to delete this horoscope?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </tbody>
                </table>
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
                width: 64, // Set your desired width
                height: 64 // Set your desired height
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
