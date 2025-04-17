@extends('frontend.layouts.main')
@section('title', 'My Documents')
@section('content')

    <!-- Image preview modal -->
    <div class="modal-lg modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true" style="width: 100%;max-width: 100%;">
        <button type="button" class="btn-close position-absolute top-0 end-0 me-5 mt-5" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content position-relative border-0" style="background: transparent;">
                {{-- <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> --}}
                <div class="modal-body text-center p-0" style="max-width: 100%;">
                    <!-- Image will be dynamically inserted here -->
                    <img id="preview-image" src="" class="img-fluid " alt="Full Image" />
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4 py-5">
        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this image? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-0">
            <!-- Sidebar -->
            <div class="card-basic border">
                <h5 class="text-start m-2">My Document</h5>
            </div>
            <div class="row g-0">
                <!-- Sidebar -->
                <div class="col-md-3">
                    <div class="list-group">
                        <a href="{{ route('profile.documents', 'passport') }}"
                            class="list-group-item list-group-item-action {{ $document_type == 'passport' ? 'active-profile' : '' }}"
                            data-target="passport-section">Passport</a>

                        <a href="{{ route('profile.documents','citizenship') }}"
                            class="list-group-item list-group-item-action {{ $document_type == 'citizenship' ? 'active-profile' : '' }}"
                            data-target="citizenship-section">Citizenship</a>

                        <a href="{{ route('profile.documents','boarding_pass') }}"
                            class="list-group-item list-group-item-action {{ $document_type == 'boarding_pass' ? 'active-profile' : '' }}"
                            data-target="boarding-pass-section">Boarding Pass</a>

                        <a href="{{ route('profile.documents','certificate') }}"
                            class="list-group-item list-group-item-action {{ $document_type == 'certificate' ? 'active-profile' : '' }}"
                            data-target="certificate-section">Certificate</a>
                    </div>

                </div>

                <!-- Content Area -->
                <div class="col-md-9">

                    <div id="profileContent" class="content-section">

                        {{-- @yield('document-content') --}}

                        <form action="{{ route('profile.documents.upload') }}" class="px-4" method="POST" enctype="multipart/form-data"
                            style="border:1px solid #ccc; border-radius: 5px; padding-bottom: 10px;">
                            @csrf
                            @if(!$images->isEmpty())
                                <div class="row mt-4">
                                    @foreach ($images as $image)
                                        <div class="col-md-4 my-1 flex-1">
                                            <div class="image-container rounded overflow-hidden position-relative">
                                                <img src="{{ asset($image->image_path) }}" alt="BoardingPass" class="img-fluid" data-bs-toggle="modal" data-bs-modal-width="100%" data-bs-target="#imagePreviewModal" data-image="{{ asset($image->image_path) }}" style="cursor: pointer;">
                                                <button type="button"
                                                    class="delete-image-btn position-absolute top-0 start-0 p-1 text-center text-danger rounded rounded-circle btn"
                                                    style="height: 50px; width: 50px; font-size: 22px;" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal"
                                                    data-delete-url="{{ route('document.destroy', ['id' => $image->id]) }}">
                                                    &times;
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="d-flex flex-wrap gap-2 my-4"></div>
                            <div class="container d-flex flex-column align-items-center justify-content-center mt-5 px-4 rounded" style="min-height: 260px;">
                                <div class="text-center upload-box1">
                                    <!-- Upload Button -->
                                    <label for="imageUpload" id="uploadText1" >
                                        <i class="bi bi-cloud-arrow-up-fill" style=" font-size: 36px;color: #0064A7;"></i><br> Select Files
                                    </label>
                                    <input type="hidden" name="document_type" value="{{$document_type}}">
                                    <input type="file" id="imageUpload" name="images[]" accept="image/*" multiple class="d-none"
                                        onchange="previewImages()">
                                </div>
                                <!-- Image Previews Section -->
                                <div id="imagePreviewContainer" class="d-flex flex-wrap justify-content-center justify-content-center gap-2 my-4"></div>
                            </div>

                            <div class="text-center mb-2">
                                <button type="submit" class="btn px-4" style="width:max-content">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





        {{-- <script>
            // Function to handle passport file preview and removal
            function previewFile1() {
                const fileInput = document.getElementById('passportFile1');
                const previewDiv = document.getElementById('filePreview1');
                const uploadText = document.getElementById('uploadText1');
                const removeBtn = document.getElementById('removeBtn1');
                const file = fileInput.files[0];

                if (file) {
                    const validTypes = ['image/jpeg', 'image/png', 'application/pdf'];

                    if (!validTypes.includes(file.type)) {
                        alert('Only JPG, PNG, or PDF files are allowed.');
                        fileInput.value = "";
                        return;
                    }

                    if (file.size > 2 * 1024 * 1024) { // 2MB limit
                        alert('File size must be less than 2MB.');
                        fileInput.value = "";
                        return;
                    }

                    uploadText.style.display = "none"; // Hide upload text
                    removeBtn.style.display = "block"; // Show remove button

                    if (file.type.startsWith("image/")) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewDiv.innerHTML =
                                `<img src="${e.target.result}" class="preview-img" alt="Passport Preview">`;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        previewDiv.innerHTML =
                            `<p class="text-success"><strong>${file.name}</strong> uploaded successfully.</p>`;
                    }
                }
            }

            // Function to handle removal of passport file with confirmation
            function removePassportFile() {
                // Show the confirmation popup for passport file deletion
                document.getElementById('overlay').style.display = 'block';
                document.getElementById('deleteConfirmationPopup').style.display = 'block';
                // Set the file type for confirmation (passport or citizenship)
                window.fileToDelete = 'passport';
            }

            // Function to handle citizenship file preview and removal (multiple files)
            function previewFiles() {
                const fileInput = document.getElementById('citizenshipFile');
                const previewDiv = document.getElementById('filePreview2');
                const uploadText = document.getElementById('uploadText2');
                const removeBtn = document.getElementById('removeBtn2');
                const files = fileInput.files;

                // Clear previous previews and reset states
                previewDiv.innerHTML = '';
                uploadText.style.display = "none"; // Hide upload text
                removeBtn.style.display = "block"; // Show remove button

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const validTypes = ['image/jpeg', 'image/png', 'application/pdf'];

                    if (!validTypes.includes(file.type)) {
                        alert('Only JPG, PNG, or PDF files are allowed.');
                        fileInput.value = "";
                        return;
                    }

                    if (file.size > 2 * 1024 * 1024) { // 2MB limit
                        alert('File size must be less than 2MB.');
                        fileInput.value = "";
                        return;
                    }

                    if (file.type.startsWith("image/")) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const filePreview = document.createElement('div');
                            filePreview.innerHTML =
                                `<img src="${e.target.result}" class="preview-img" alt="Citizenship Preview">`;
                            previewDiv.appendChild(filePreview);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        const filePreview = document.createElement('div');
                        filePreview.innerHTML =
                            `<p class="text-success"><strong>${file.name}</strong> uploaded successfully.</p>`;
                        previewDiv.appendChild(filePreview);
                    }
                }
            }

            // Function to handle removal of citizenship files with confirmation
            function removeCitizenshipFile() {
                // Show the confirmation popup for citizenship file deletion
                document.getElementById('overlay').style.display = 'block';
                document.getElementById('deleteConfirmationPopup').style.display = 'block';
                // Set the file type for confirmation (passport or citizenship)
                window.fileToDelete = 'citizenship';
            }

            // Confirm the deletion of the file(s)
            function confirmDelete(fileType) {
                if (fileType === 'passport') {
                    const fileInput = document.getElementById('passportFile1');
                    const previewDiv = document.getElementById('filePreview1');
                    const uploadText = document.getElementById('uploadText1');
                    const removeBtn = document.getElementById('removeBtn1');

                    // Clear the preview and reset the state
                    previewDiv.innerHTML = "";
                    uploadText.style.display = "block"; // Show upload text
                    removeBtn.style.display = "none"; // Hide remove button

                    // Hide the popup and overlay
                    closePopup();
                } else if (fileType === 'citizenship') {
                    const fileInput = document.getElementById('citizenshipFile');
                    const previewDiv = document.getElementById('filePreview2');
                    const uploadText = document.getElementById('uploadText2');
                    const removeBtn = document.getElementById('removeBtn2');

                    // Clear the preview and reset the state
                    previewDiv.innerHTML = "";
                    uploadText.style.display = "block"; // Show upload text
                    removeBtn.style.display = "none"; // Hide remove button

                    // Hide the popup and overlay
                    closePopup();
                }
            }

            // Close popup and overlay without deleting
            function closePopup() {
                document.getElementById('overlay').style.display = 'none';
                document.getElementById('deleteConfirmationPopup').style.display = 'none';
            }
        </script>

        <script>
            let selectedBoardingPassImages = [];
            let selectedCertificateImages = [];
            const MAX_IMAGES = 20; // Max images to upload for both boarding pass and certificate

            // Helper function to handle file uploads
            function handleFiles(files, type) {
                if (type === 'boardingPass' && selectedBoardingPassImages.length >= MAX_IMAGES) {
                    alert(`You can upload a maximum of ${MAX_IMAGES} boarding pass images.`);
                    return;
                }

                if (type === 'certificate' && selectedCertificateImages.length >= MAX_IMAGES) {
                    alert(`You can upload a maximum of ${MAX_IMAGES} certificates.`);
                    return;
                }

                for (let file of files) {
                    if (file.size > 2 * 1024 * 1024) {
                        showError(type, `${file.name} exceeds 2MB.`);
                        continue;
                    }

                    const reader = new FileReader();
                    reader.onload = e => {
                        const imageWrapper = document.createElement('div');
                        imageWrapper.classList.add('image-wrapper');

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('uploaded-image');

                        const removeBtn = document.createElement('button');
                        removeBtn.innerHTML = "&times;";
                        removeBtn.classList.add('remove-btn');
                        removeBtn.onclick = () => removeImage(type, imageWrapper, file.name);

                        imageWrapper.appendChild(img);
                        imageWrapper.appendChild(removeBtn);

                        if (type === 'boardingPass') {
                            document.getElementById('boardingPassPreview').insertBefore(imageWrapper, document
                                .getElementById('uploadBoardingPassBox'));
                            selectedBoardingPassImages.push(file.name);
                            toggleUploadButton('boardingPass');
                        } else {
                            document.getElementById('certificatePreview').insertBefore(imageWrapper, document
                                .getElementById('uploadCertificateBox'));
                            selectedCertificateImages.push(file.name);
                            toggleUploadButton('certificate');
                        }
                    };
                    reader.readAsDataURL(file);
                }

                // Reset input value to allow future selections
                setTimeout(() => resetInput(type), 100); // Delay resetting input to allow browser to process the file selection
            }

            // Reset the file input after upload completion
            function resetInput(type) {
                const inputBox = (type === 'boardingPass') ? document.getElementById('boardingPassUploadBox') : document
                    .getElementById('certificateUploadBox');
                inputBox.value = ''; // Reset file input
            }

            // Remove image from preview
            function removeImage(type, wrapper, name) {
                wrapper.remove();
                if (type === 'boardingPass') {
                    selectedBoardingPassImages = selectedBoardingPassImages.filter(img => img !== name);
                    toggleUploadButton('boardingPass');
                } else {
                    selectedCertificateImages = selectedCertificateImages.filter(img => img !== name);
                    toggleUploadButton('certificate');
                }
            }

            // Show error message
            function showError(type, message) {
                const errorDiv = document.getElementById(type + 'Error');
                errorDiv.innerHTML = message;
                errorDiv.style.display = message ? 'block' : 'none';
            }

            // Toggle visibility of the upload button based on the number of images
            function toggleUploadButton(type) {
                if (type === 'boardingPass') {
                    document.getElementById('uploadBoardingPassBox').style.display = selectedBoardingPassImages.length <
                        MAX_IMAGES ? 'block' : 'none';
                } else {
                    document.getElementById('uploadCertificateBox').style.display = selectedCertificateImages.length <
                        MAX_IMAGES ? 'block' : 'none';
                }
            }

            // Event listener for boarding pass image selection
            document.getElementById('boardingPassUploadBox').addEventListener('change', function() {
                let files = this.files;
                if (files.length) {
                    handleFiles(files, 'boardingPass');
                }
            });

            // Event listener for certificate image selection
            document.getElementById('certificateUploadBox').addEventListener('change', function() {
                let files = this.files;
                if (files.length) {
                    handleFiles(files, 'certificate');
                }
            }); 

            // Initialize
            toggleUploadButton('boardingPass');
            toggleUploadButton('certificate');
        </script>
 --}}

@endsection

@push('scripts')
    <script>
        // Listen for image clicks
        const imageElements = document.querySelectorAll('.image-container img');
        imageElements.forEach(image => {
            image.addEventListener('click', function() {
                // Get the image URL from the clicked image
                const imageUrl = image.getAttribute('data-image');
                // Set the image URL into the preview modal
                document.getElementById('preview-image').src = imageUrl;
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        let deleteButtons = document.querySelectorAll(".delete-image-btn");
        let confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function() {
                let deleteUrl = this.getAttribute("data-delete-url");
                confirmDeleteBtn.setAttribute("href", deleteUrl);
            });
        });
    });
    </script>
    <script>
        let selectedFiles = [];

        function previewImages() {
            let input = document.getElementById('imageUpload');
            Array.from(input.files).forEach(file => {
                if (!selectedFiles.some(f => f.name === file.name)) {
                    selectedFiles.push(file);
                }
            });
            updatePreview();
        }

        function updatePreview() {
            let previewContainer = document.getElementById('imagePreviewContainer');
            previewContainer.innerHTML = '';

            selectedFiles.forEach((file, index) => {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let imageWrapper = document.createElement('div');
                    imageWrapper.classList.add('position-relative', 'border', 'rounded', 'overflow-hidden', 'col-md-4', 'm-1', 'flex-1', 'col-sm-6');


                    let imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.classList.add('w-100', 'h-100', 'rounded');
                    imgElement.style.objectFit = 'cover';

                    let removeButton = document.createElement('button');
                    removeButton.style.all = 'unset';
                    removeButton.style.cursor = 'pointer';
                    removeButton.innerHTML = '&times;';
                    removeButton.classList.add('btn','btn-danger','position-absolute','text-danger', 'top-0', 'end-0',
                        'pe-1', 'rounded-circle');
                    removeButton.style.fontSize = '24px';
                    
                    removeButton.onclick = function() {
                        removeImage(index);
                    };

                    imageWrapper.appendChild(imgElement);
                    imageWrapper.appendChild(removeButton);
                    previewContainer.appendChild(imageWrapper);
                };
                reader.readAsDataURL(file);
            });

            updateInput();
        }

        function removeImage(index) {
            selectedFiles.splice(index, 1);
            updatePreview();
        }

        function updateInput() {
            let input = document.getElementById('imageUpload');
            let dataTransfer = new DataTransfer();

            selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });

            input.files = dataTransfer.files;
            console.log(input.files);
        }
    </script>
@endpush
