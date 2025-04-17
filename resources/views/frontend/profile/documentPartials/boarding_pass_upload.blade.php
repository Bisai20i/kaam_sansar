@extends('frontend.profile.documentPartials.jobseeker_document_dashboard')

@section('document-content')
    
    <form action="{{ route('profile.documents.upload') }}" class="px-4" method="POST" enctype="multipart/form-data"
        style="border:1px solid #ccc; border-radius: 5px; padding-bottom: 10px;">
        @csrf
        @if (!$images->isEmpty())
            <div class="row mt-4">
                @foreach ($images as $image)
                    <div class="col-md-4 my-1 flex-1">
                        <div class="image-container rounded overflow-hidden position-relative">
                            <img src="{{ asset($image->image_path) }}" alt="BoardingPass" class="img-fluid" data-bs-toggle="modal" data-bs-target="#imagePreviewModal" data-image="{{ asset($image->image_path) }}" style="cursor: pointer;">

                            <!-- Delete Button that triggers modal -->
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
        <div class="container d-flex flex-column align-items-center justify-content-center mt-5 px-4 rounded"
            style="min-height: 260px;">
            <div class="text-center upload-box1">
                <!-- Upload Button -->
                <label for="imageUpload" id="uploadText1" >
                    <i class="bi bi-cloud-arrow-up-fill" style=" font-size: 36px;color: #0064A7;"></i><br> Select Files
                </label>
                <input type="hidden" name="document_type" value="boarding_pass">
                <input type="hidden" name="jobSeekerId" value="{{ Auth::guard('job_seekers')->user()->id }}">
                <input type="file" id="imageUpload" name="images[]" accept="image/*" multiple class="d-none"
                    onchange="previewImages()">
            </div>
            <!-- Image Previews Section -->
            <div id="imagePreviewContainer" class="d-flex flex-wrap justify-content-center gap-0 my-4"></div>
        </div>

        <div class="text-center mb-2">
            <button type="submit" class="btn px-4" style="width:max-content">Upload</button>
        </div>
    </form>
@endsection
{{-- @push('scripts')
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
@endpush --}}
{{-- 
@push('scripts')

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
                    imageWrapper.classList.add('position-relative', 'border', 'rounded', 'overflow-hidden', 'col-md-3', 'my-1');


                    let imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.classList.add('img-fluid', 'w-100', 'h-100', 'rounded');
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
@endpush --}}
