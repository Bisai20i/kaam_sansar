@extends('backend.layouts.main')

@section('title', isset($detail) ? 'Edit Insurance Category Detail' : 'Add Insurance Category Detail')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <h4 class="fw-bold mb-4">
                <span class="text-muted fw-light">Insurance / {{$category->name}} /</span> 
                Manage Sub Categories
            </h4>

            {{-- <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">{{ isset($detail) ? 'Edit' : 'Add' }} Category Details</h5>
                    <a href="{{ route('insurance.companies.index') }}" class="btn btn-sm btn-primary">
                        <i class="bx bx-arrow-back"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <form method="POST" 
                          action="{{ isset($detail) ? route('insurance.category.details.update', $detail->id) : route('insurance.category.details.store') }}" 
                          enctype="multipart/form-data">
                        @csrf
                        @if(isset($detail))
                            @method('PUT')
                        @endif

                        <input type="hidden" name="insurance_category_id" value="{{ $category->id }}">

                        <div class="row">
                            <!-- Category Name (Readonly) -->
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Category Name</label>
                                <input type="text" class="form-control" value="{{ $category->name }}" readonly>
                            </div>

                            <!-- Publish Status -->
                            <div class="mb-3 col-md-6">
                                <label for="publishStatus" class="form-label">Publish Status <span class="text-danger">*</span></label>
                                <select class="form-select" id="publishStatus" name="publishStatus" required>
                                    <option value="1" {{ (isset($detail) && $detail->publishStatus) ? 'selected' : '' }}>Published</option>
                                    <option value="0" {{ (isset($detail) && !$detail->publishStatus) ? 'selected' : '' }}>Unpublished</option>
                                </select>
                            </div>

                            <!-- Thumbnail Upload -->
                            <div class="mb-3 col-md-6">
                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
                                @if(isset($detail) && $detail->thumbnail)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/'.$detail->thumbnail) }}" alt="Current Thumbnail" class="img-thumbnail" style="max-width: 200px;">
                                        <p class="text-muted mt-1">Current thumbnail</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Description -->
                            <div class="mb-3 col-md-12">
                                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea id="description" name="description" class="form-control" rows="5" required>{{ isset($detail) ? $detail->description : old('description') }}</textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex align-items-center">
                                <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center">
                                    <span id="buttonText">{{ isset($detail) ? 'Update' : 'Submit' }}</span>
                                    <div id="loaderSpinner" class="spinner-border spinner-border-sm d-none ms-2" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}
        </div>
    </div>

    <script>
        // Form submission loader
        const form = document.querySelector('form');
        const submitButton = form.querySelector('button[type="submit"]');
        const buttonText = submitButton.querySelector('#buttonText');
        const loaderSpinner = submitButton.querySelector('#loaderSpinner');

        form.addEventListener('submit', function() {
            submitButton.disabled = true;
            loaderSpinner.classList.remove('d-none');
            buttonText.textContent = "{{ isset($detail) ? 'Updating...' : 'Submitting...' }}";
        });

        // Initialize Summernote for description
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: 'Enter category description...',
                height: 200,
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