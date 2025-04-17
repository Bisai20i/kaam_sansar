@extends('frontend.profile.documentPartials.jobseeker_document_dashboard')


@section('document-content')
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
                <input type="hidden" name="document_type" value="passport">
                <input type="hidden" name="jobSeekerId" value="{{ Auth::guard('job_seekers')->user()->id }}">
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
@endsection


