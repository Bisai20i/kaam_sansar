@extends('backend.layouts.main')

@section('title', isset($horoscope) ? 'Edit Horoscope' : 'Create Horoscope')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold m-4">{{ isset($horoscope) ? 'Edit Horoscope' : 'Create Horoscope' }}</h4>

    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">{{ isset($horoscope) ? 'Edit Horoscope' : 'Add New Horoscope' }}</h4>
                <a href="{{ route('horoscope.index') }}" class="btn btn-secondary btn-sm text-white">Back</a>
            </div>
        </div>
        <div class="card-body">
            <form id="formAuthentication" class="mb-3" novalidate method="POST" action="{{ isset($horoscope) ? route('horoscope.update', $horoscope->id) : route('horoscope.store') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($horoscope))
                    @method('PUT') <!-- Indicating update for existing horoscope -->
                @endif

                <div class="row">
                    <div class="mb-3 col-md-6">

                        <label for="zodiacSignEnglish" class="form-label">Zodiac Sign [English]       <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('zodiacSignEnglish') is-invalid @enderror" id="zodiacSignEnglish" name="zodiacSignEnglish" value="{{ old('zodiacSignEnglish', $horoscope->zodiacSignEnglish ?? '') }}"  
                        placeholder="Enter here zodiac sign name in English"
                        required>
                        @error('zodiacSignEnglish')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">

                        <label for="zodiacSignNepali" class="form-label">Zodiac Sign [Nepali]       <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('zodiacSignNepali') is-invalid @enderror" id="zodiacSignNepali" name="zodiacSignNepali" value="{{ old('zodiacSignNepali', $horoscope->zodiacSignNepali ?? '') }}"  
                        placeholder="Enter here zodiac sign name in Nepali"
                        required>
                        @error('zodiacSignNepali')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
    <label for="birthMonth" class="form-label">Birth Month <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('birthMonth') is-invalid @enderror" 
           id="birthMonth" name="birthMonth" 
           value="{{ old('birthMonth', $horoscope->birthMonth ?? '') }}"
           placeholder='Enter birth month range ( "March 19 - April 4")' required>
    @error('birthMonth')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                    <div class="mb-3 col-md-6">
                    <span class="text-danger">*</span>

                        <label for="type" class="form-label">Type</label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type"
                        required>
                            <option value="daily" {{ old('type', $horoscope->type ?? '') == 'daily' ? 'selected' : '' }}>Daily</option>
                            <option value="weekly" {{ old('type', $horoscope->type ?? '') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                            <option value="monthly" {{ old('type', $horoscope->type ?? '') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                            <option value="yearly" {{ old('type', $horoscope->type ?? '') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                                                             

                        <label for="contentEn" class="form-label">Zodiac Sign Content (English)        <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('contentEn') is-invalid @enderror" id="contentEn" name="contentEn" rows="4" 
                        placeholder="Enter here zodiac sign description in English"
                        required>{{ old('contentEn', $horoscope->contentEn ?? '') }}</textarea>
                        @error('contentEn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="contentNp" class="form-label">Zodaic Sign Content (Nepali)       <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('contentNp') is-invalid @enderror" id="contentNp" name="contentNp" rows="4"
                        placeholder="Enter here zodiac sign description in Nepali"

                        >{{ old('contentNp', $horoscope->contentNp ?? '') }}</textarea>
                        @error('contentNp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
    <label for="publishDate" class="form-label">Publish Date <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('publishDate') is-invalid @enderror" 
           id="publishDate" name="publishDate" 
           value="{{ old('publishDate', $horoscope->publishDate ?? '') }}" required>

    @error('publishDate')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let publishDateInput = document.getElementById("publishDate");
        let typeSelect = document.getElementById("type"); // Assuming there's a dropdown with id="type"

        function updatePublishDate() {
            let today = new Date();
            let selectedType = typeSelect.value;
            let formattedDateEn = ""; // English formatted date

            if (selectedType === "daily") {
                // Format: YYYY-MM-DD for English
                formattedDateEn = today.toISOString().split('T')[0];
            } 
            else if (selectedType === "weekly") {
                // Calculate the start and end of the week (Sunday to Saturday)
                let startDate = getStartOfWeek(today);
                let endDate = getEndOfWeek(today);

                let monthEnStart = startDate.toLocaleString('default', { month: 'long' });
                let monthEnEnd = endDate.toLocaleString('default', { month: 'long' });

                // Format: "15 February - 21 February" for English
                formattedDateEn = `${startDate.getDate()} ${monthEnStart} - ${endDate.getDate()} ${monthEnEnd}`;
            } 
            else if (selectedType === "monthly") {
    // Get the English month and year
    let monthEn = today.toLocaleString('default', { month: 'long' });
    let yearEn = today.getFullYear();
    
    // Format: "February 2025" for English
    formattedDateEn = `${monthEn} ${yearEn}`;
}

            else if (selectedType === "yearly") {
                // Format: YYYY for English
                formattedDateEn = today.getFullYear();
            }

            // Set value but allow user modification
            publishDateInput.value = formattedDateEn;
        }

        // Function to calculate the start of the week (Sunday)
        function getStartOfWeek(date) {
            let day = date.getDay(),
                diff = date.getDate() - day; // Adjust for Sunday
            let startOfWeek = new Date(date.setDate(diff));
            startOfWeek.setHours(0, 0, 0, 0); // Set time to start of the day
            return startOfWeek;
        }

        // Function to calculate the end of the week (Saturday)
        function getEndOfWeek(date) {
            let day = date.getDay(),
                diff = date.getDate() - day + 6; // Adjust for Saturday
            let endOfWeek = new Date(date.setDate(diff));
            endOfWeek.setHours(23, 59, 59, 999); // Set time to end of the day
            return endOfWeek;
        }

        // Trigger on load and on type change
        updatePublishDate();
        typeSelect.addEventListener("change", updatePublishDate);

        // Allow users to modify the date if needed
        publishDateInput.addEventListener("input", function() {
            this.setAttribute("data-modified", "true"); // Mark as modified by user
        });

        typeSelect.addEventListener("change", function() {
            if (!publishDateInput.hasAttribute("data-modified")) {
                updatePublishDate();
            }
        });

    });
</script>





                    <div class="mb-3 col-md-6">
                        <label for="nameStartLetter" class="form-label">Name Start Letter       <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nameStartLetter') is-invalid @enderror" id="nameStartLetter" name="nameStartLetter" value="{{ old('nameStartLetter', $horoscope->nameStartLetter ?? '') }}" 
                        placeholder='Enter here astro letter like "चु", "चे", "चो", "ला", "लि", "लु", "ले", "लो"'                        required>
                        @error('nameStartLetter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="mb-3 col-md-6">
    <label for="zodiacImgNepali" class="form-label">Nepali Rashifal Image<span class="text-danger">*</span></label>
    <input type="file" class="form-control @error('zodiacImgNepali') is-invalid @enderror" id="fileNepali" name="zodiacImgNepali" accept="image/*" onchange="previewImage(event, 'imagePreviewNepali')">
    @error('zodiacImgNepali')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    
    <!-- Image Preview -->
    <div class="mt-3">
        <img id="imagePreviewNepali"
            src="{{ isset($horoscope) && $horoscope->zodiacImgNepali ? asset('storage/' . $horoscope->zodiacImgNepali) : '' }}"
            alt="Selected Zodiac Image"
            style="max-width: 150px; display: {{ isset($horoscope) && $horoscope->zodiacImgNepali ? 'block' : 'none' }}; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
    </div>
</div>

<!-- Zodiac Image English -->
<div class="mb-3 col-md-6">
    <label for="zodiacImgEnglish" class="form-label">Zodiac Image English</label>
    <input type="file"
        class="form-control @error('zodiacImgEnglish') is-invalid @enderror"
        id="fileEnglish"
        name="zodiacImgEnglish" accept="image/*"
        onchange="previewImage(event, 'imagePreviewEnglish')">

    @error('zodiacImgEnglish')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    
    <!-- Image Preview -->
    <div class="mt-3">
        <img id="imagePreviewEnglish"
            src="{{ isset($horoscope) && $horoscope->zodiacImgEnglish ? asset('storage/' . $horoscope->zodiacImgEnglish) : '' }}"
            alt="Selected Zodiac Image"
            style="max-width: 200px; display: {{ isset($horoscope) && $horoscope->zodiacImgEnglish ? 'block' : 'none' }}; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
    </div>
</div>

<script>
function previewImage(event, previewId) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById(previewId);
        output.src = reader.result;
        output.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

                    </div>
 

                <!-- Submit Button -->
                <div class="mb-3 col-md-6">
                    <button type="submit" class="btn btn-primary btn-sm" id="submitButton">
                        <span id="buttonText">{{ isset($horoscope) ? 'Update Horoscope' : 'Create Horoscope' }}</span>
                        <div id="loaderSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
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
                            <img id="cropper-image" src="" style="width: 100%; max-height: 600px; object-fit: contain;">
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

            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>

<!-- <script>
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
        

        const form = document.getElementById('formAuthentication');
        const submitButton = document.getElementById('submitButton');
        const buttonText = document.getElementById('buttonText');
        const loaderSpinner = document.getElementById('loaderSpinner');

        // Disable the submit button and show loader spinner during form submission
        form.addEventListener('submit', function() {
            submitButton.disabled = true;
            loaderSpinner.classList.remove('d-none');
            buttonText.style.display = 'none';
        });

        // Initialize Summernote for both textareas
        $('#contentEn,#contentNp').summernote({
            placeholder: 'Write your horoscope content here...',
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
</script> -->
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
            // Load image into cropper for Nepali Rashifal Image
            $('#fileNepali').change(function(e) {
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
                    $('#croppedImageBase64').val(base64data); // Set the base64 data to the hidden input
                    
                    $modal.modal('hide');
                };
            });
        });

        // Close the modal
        $('#close-modal').click(function() {
            $modal.modal('hide');
        });

        // Disable the submit button and show loader spinner during form submission
        const form = document.getElementById('formAuthentication');
        const submitButton = document.getElementById('submitButton');
        const buttonText = document.getElementById('buttonText');
        const loaderSpinner = document.getElementById('loaderSpinner');

        form.addEventListener('submit', function() {
            submitButton.disabled = true;
            loaderSpinner.classList.remove('d-none');
            buttonText.style.display = 'none';
        });

        // Initialize Summernote for both textareas
        $('#contentEn,#contentNp').summernote({
            placeholder: 'Write your horoscope content here...',
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
