@extends('backend.layouts.main')

@section('title', 'Create Admin Message')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="content-wrapper">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light"></span> Create Admin Message</h4>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Add Message</h5>
                        <a href="{{ route('admin-messages.index') }}" class="btn btn-primary btn-sm text-white">
                            <i class="bx bx-arrow-back" aria-hidden="true"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin-messages.store') }}" id="AdminMessageForm">
                            @csrf
                            <div class="row">

                                <!-- Admin -->
                                <div class="mb-3 col-md-6">
                                    <label for="admin_id" class="form-label">Admin <span class="text-danger">*</span></label>
                                    <select name="admin_id" id="admin_id" class="form-control {{ $errors->has('admin_id') ? 'is-invalid' : '' }}" required>
                                        <option value="" disabled {{ old('admin_id') ? '' : 'selected' }}>Select Admin</option>
                                        @foreach($admins as $admin)
                                        <option value="{{ $admin->id }}" {{ old('admin_id') == $admin->id ? 'selected' : '' }}>
                                            {{ $admin->fullName }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('admin_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>



                                <!-- Jyotish  -->
                                <div class="mb-3 col-md-6">
                                    <label for="jyotish_id" class="form-label">Jyotish <span class="text-danger">*</span></label>
                                    <select name="jyotish_id" id="jyotish_id" class="form-control {{ $errors->has('jyotish_id') ? 'is-invalid' : '' }}">
                                        <option value="" selected>Select Jyotish</option>
                                        @foreach($jyotishs as $jyotish)
                                        <option value="{{ $jyotish->id }}" {{ old('jyotish_id') == $jyotish->id ? 'selected' : '' }}>
                                            {{ $jyotish->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('jyotish_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>





                                <!-- Jobseeker -->
                                <div class="mb-3 col-md-6">
                                    <label for="jobseeker_id" class="form-label">Jobseeker <span class="text-danger">*</span></label>
                                    <select name="jobseeker_id" id="jobseeker_id" class="form-control {{ $errors->has('jobseeker_id') ? 'is-invalid' : '' }}" required>
                                        <option value="" disabled {{ old('jobseeker_id') ? '' : 'selected' }}>Select Jobseeker</option>
                                        @foreach($jobseekers as $jobseeker)
                                        <option value="{{ $jobseeker->id }}" {{ old('jobseeker_id') == $jobseeker->id ? 'selected' : '' }}>
                                            {{ $jobseeker->firstName }} {{ $jobseeker->lastName }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('jobseeker_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Message Title -->
                                <div class="mb-3 col-md-12">
                                    <label for="title" class="form-label">Message  <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" required value="{{ old('title') }}">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Message Description -->
                                <div class="mb-3 col-md-12">
                                    <label for="description" class="form-label">Message Description <span class="text-danger">*</span></label>
                                    <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" required>{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center" id="submitButton">
                                        <span id="buttonText">Send Message</span>
                                        <div id="loaderSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Summernote + Loader Script -->
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#description').summernote({
            height: 200,
            placeholder: 'Write your message here...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'video', 'picture', 'table']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        const form = document.getElementById('AdminMessageForm');
        const submitButton = document.getElementById('submitButton');
        const buttonText = document.getElementById('buttonText');
        const loaderSpinner = document.getElementById('loaderSpinner');

        if (form) {
            form.addEventListener('submit', function() {
                submitButton.disabled = true;
                loaderSpinner.classList.remove('d-none');
                buttonText.style.display = 'none';
            });
        }
    });

    
</script>
@endpush
@endsection