@extends('backend.layouts.main')

@section('content')
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
                        <h4 class="fw-bold m-0">Kundali detail for {{ $kundali->personName }}</h4>
                        <a href="{{ route('astrologer.index') }}" class="btn btn-primary btn-sm text-white">
                            <i class="bx bx-arrow-back" aria-hidden="true"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr><th>Phone Number:</th><td>{{ $kundali->phoneNumber }}</td></tr>
                <tr><th>Email:</th><td>{{ $kundali->emailAddress }}</td></tr>
                <tr><th>Date of Birth:</th><td>{{ $kundali->personDateOfBirth }}</td></tr>
                <tr><th>Place of Birth:</th><td>{{ $kundali->personPlaceOfBirth }}</td></tr>
                <tr><th>Time of Birth:</th><td>{{ $kundali->personTimeOfBirth }}</td></tr>

                <tr>
                    <th>Current Video:</th>
                    <td>
                        @if(isset($astrologer) && $astrologer->astroVideoLink)
                            <a href="{{ $astrologer->astroVideoLink }}" target="_blank">Watch Video</a>
                        @else
                            No video uploaded yet.
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Status:</th>
                    <td>
                        <span class="badge 
                            {{ isset($astrologer) ? ($astrologer->status == 'Approved' ? 'bg-success' : ($astrologer->status == 'Rejected' ? 'bg-danger' : 'bg-warning')) : 'bg-warning' }}">
                            {{ $astrologer->status ?? 'Review' }}
                        </span>
                    </td>
                </tr>
            </table>

            <h5 class="mt-4 col-md-6">Upload Video</h5>
            <form method="POST" 
                action="{{ isset($astrologer) ? route('astrologer.update', $astrologer->id) : route('astrologer.store') }}" 
                enctype="multipart/form-data">
                @csrf
                @if (isset($astrologer))
                    @method('PUT')
                @endif

                <input type="hidden" name="kundaliId" value="{{ $kundali->id }}">
                <input type="hidden" name="kundaliMatchingId" value="{{ $kundaliMatching->id ?? '' }}">

                <div class="row">
                    <!-- Astrologer Name -->
                    <div class="mb-3 col-md-6">
                        <label for="astrologerName" class="form-label">Astrologer Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('astrologerName') is-invalid @enderror" id="astrologerName" name="astrologerName"
                            value="{{ old('astrologerName', $astrologer->astrologerName ?? '') }}"
                            placeholder="Enter Astrologer Name" required>
                        @error('astrologerName')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Astrologer Phone -->
                    <div class="mb-3 col-md-6">
                        <label for="astrologerPhone" class="form-label">Phone Number<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('astrologerPhone') is-invalid @enderror" id="astrologerPhone" name="astrologerPhone"
                            value="{{ old('astrologerPhone', $astrologer->astrologerPhone ?? '') }}"
                            placeholder="Enter Phone Number" required>
                        @error('astrologerPhone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Astrologer Location -->
                    <div class="mb-3 col-md-6">
                        <label for="astrologerLocation" class="form-label">Location<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('astrologerLocation') is-invalid @enderror" id="astrologerLocation" name="astrologerLocation"
                            value="{{ old('astrologerLocation', $astrologer->astrologerLocation ?? '') }}"
                            placeholder="Enter Astrologer Location" required>
                        @error('astrologerLocation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Video Link -->
                    <div class="mb-3 col-md-6">
                        <label for="astroVideoLink" class="form-label">Video Link<span class="text-danger">*</span></label>
                        <input type="url" class="form-control @error('astroVideoLink') is-invalid @enderror" id="astroVideoLink" name="astroVideoLink"
                            value="{{ old('astroVideoLink', $astrologer->astroVideoLink ?? '') }}"
                            placeholder="Enter Video Link" required>
                        @error('astroVideoLink')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3 col-md-6">
                        <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="Review" {{ old('status', $astrologer->status ?? '') == 'Review' ? 'selected' : '' }}>Review</option>
                            <option value="Approved" {{ old('status', $astrologer->status ?? '') == 'Approved' ? 'selected' : '' }}>Approved</option>
                            <option value="Rejected" {{ old('status', $astrologer->status ?? '') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Publish Status -->
                    <div class="mb-3 col-md-6">
                        <label for="publishStatus" class="form-label">Publish Status<span class="text-danger">*</span></label>
                        <select class="form-control @error('publishStatus') is-invalid @enderror" id="publishStatus" name="publishStatus" required>
                            <option value="publish" {{ old('publishStatus', $astrologer->publishStatus ?? '') == 'publish' ? 'selected' : '' }}>Publish</option>
                            <option value="unpublish" {{ old('publishStatus', $astrologer->publishStatus ?? '') == 'unpublish' ? 'selected' : '' }}>Unpublish</option>
                        </select>
                        @error('publishStatus')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save Video</button>
            </form>
        </div>
    </div>
</div>
@endsection
