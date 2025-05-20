@extends('backend.layouts.main')

@section('title', 'Create Jyotish')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="content-wrapper">
        <h4 class="fw-bold mb-4">Create New Jyotish</h4>

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Add Jyotish</h5>
                <a href="{{ route('jyotishs.index') }}" class="btn btn-primary btn-sm text-white">
                    <i class="bx bx-arrow-back" aria-hidden="true"></i> Back
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('jyotishs.store') }}" method="POST" enctype="multipart/form-data" id="JyotishForm">
                    @csrf
                    <div class="row">
                        <!-- Name -->
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-3 col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" id="phone" name="phone" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Photo -->
                        <div class="mb-3 col-md-6">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" id="photo" name="photo" 
                                   class="form-control @error('photo') is-invalid @enderror" 
                                   accept="image/*">
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 d-flex align-items-center gap-2">
                            <button type="submit" class="btn btn-primary" id="submitButton">
                                <span id="buttonText">Create</span>
                                <div id="loaderSpinner" class="spinner-border spinner-border-sm d-none ms-2" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                            <a href="{{ route('jyotishs.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('JyotishForm');
    const submitButton = document.getElementById('submitButton');
    const buttonText = document.getElementById('buttonText');
    const loaderSpinner = document.getElementById('loaderSpinner');

    if (form) {
        form.addEventListener('submit', function () {
            submitButton.disabled = true;
            loaderSpinner.classList.remove('d-none');
            buttonText.style.display = 'none';
        });
    }
});
</script>

@endsection
