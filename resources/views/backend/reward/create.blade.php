@extends('backend.layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <h4 class="fw-bold mb-4"><span class="text-muted fw-light"> </span> Create Reward</h4>

            <!-- Main Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Add Reward</h5>
                            <a href="{{ route('rewards.index') }}" class="btn btn-primary btn-sm text-white">
                                <i class="bx bx-arrow-back" aria-hidden="true"></i> Back
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('rewards.store') }}" id="RewardForm">
                                @csrf
                                <div class="row">
                                    <!-- Job Seeker -->
                                    <div class="mb-3 col-md-6">
                                        <label for="job_seeker" class="form-label">Job Seeker <span class="text-danger">*</span></label>
                                        <select class="form-control {{ $errors->has('job_seekers_id') ? 'is-invalid' : '' }}" 
                                                id="job_seeker" name="job_seekers_id">
                                            <option value="">Select Job Seeker</option>
                                            @foreach($jobSeekers as $jobSeeker)
                                                <option value="{{ $jobSeeker->id }}" 
                                                    {{ old('job_seekers_id') == $jobSeeker->id ? 'selected' : '' }}>
                                                    {{ $jobSeeker->firstName . ' ' . $jobSeeker->lastName }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('job_seekers_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Reward Points -->
                                    <div class="mb-3 col-md-6">
                                        <label for="reward_points" class="form-label">Reward Points <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control {{ $errors->has('reward_points') ? 'is-invalid' : '' }}"
                                               id="reward_points" name="reward_points" value="{{ old('reward_points') }}" 
                                               placeholder="Reward Points">
                                        @error('reward_points')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="d-flex align-items-center">
                                        <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center" id="submitButton">
                                            <span id="buttonText">Submit</span>
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
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('RewardForm');
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
