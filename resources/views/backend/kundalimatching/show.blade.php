@extends('backend.layouts.main')

@section('content')
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
                        <h4 class="fw-bold m-0">Kundali Matching Detail</h4>
                        <a href="{{ route('kundalimatching.index') }}" class="btn btn-primary btn-sm text-white">
                            <i class="bx bx-arrow-back" aria-hidden="true"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <h5>Girl's Information</h5>
            <table class="table table-bordered mb-4">
                <tr><th>Name</th><td>{{ $kundaliMatching->girlName }}</td></tr>
                <tr><th>Date of Birth</th><td>{{ $kundaliMatching->girlDateOfBirth }}</td></tr>
                <tr><th>Place of Birth</th><td>{{ $kundaliMatching->girlPlaceOfBirth }}</td></tr>
                <tr><th>Time of Birth</th><td>{{ $kundaliMatching->girlTimeOfBirth }}</td></tr>
            </table>

            <h5>Boy's Information</h5>
            <table class="table table-bordered mb-4">
                <tr><th>Name</th><td>{{ $kundaliMatching->boyName }}</td></tr>
                <tr><th>Date of Birth</th><td>{{ $kundaliMatching->boyDateOfBirth }}</td></tr>
                <tr><th>Place of Birth</th><td>{{ $kundaliMatching->boyPlaceOfBirth }}</td></tr>
                <tr><th>Time of Birth</th><td>{{ $kundaliMatching->boyTimeOfBirth }}</td></tr>
            </table>

            <h5>User Queries</h5>
            <table class="table table-bordered mb-4">
                <tr><th>Query 1</th><td>{{ $kundaliMatching->Query1 ?? 'N/A' }}</td></tr>
                <tr><th>Query 2</th><td>{{ $kundaliMatching->Query2 ?? 'N/A' }}</td></tr>
                <tr><th>Query 3</th><td>{{ $kundaliMatching->Query3 ?? 'N/A' }}</td></tr>
            </table>

            @if(isset($astrologer))
            <h5>Astrologer's Video & Status</h5>
            <table class="table table-bordered mb-4">
                <tr>
                    <th>Video Link</th>
                    <td>
                        @if($astrologer->astroVideoLink)
                            <a href="{{ $astrologer->astroVideoLink }}" target="_blank">Watch Video</a>
                        @else
                            No video uploaded yet.
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge 
                            {{ $astrologer->status == 'Approved' ? 'bg-success' : ($astrologer->status == 'Rejected' ? 'bg-danger' : 'bg-warning') }}">
                            {{ $astrologer->status ?? 'Review' }}
                        </span>
                    </td>
                </tr>
            </table>
            @endif

            <h5 class="mt-4 col-md-6">Upload/Update Astrologer Video</h5>
            <form method="POST" 
                action="{{ isset($astrologer) ? route('astrologer.update', $astrologer->id) : route('astrologer.store') }}" 
                enctype="multipart/form-data">
                @csrf
                @if (isset($astrologer))
                    @method('PUT')
                @endif

                <input type="hidden" name="kundaliMatchingId" value="{{ $kundaliMatching->id }}">

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="astrologerName" class="form-label">Astrologer Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('astrologerName') is-invalid @enderror" name="astrologerName"
                            value="{{ old('astrologerName', $astrologer->astrologerName ?? '') }}" required>
                        @error('astrologerName')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="astrologerPhone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('astrologerPhone') is-invalid @enderror" name="astrologerPhone"
                            value="{{ old('astrologerPhone', $astrologer->astrologerPhone ?? '') }}" required>
                        @error('astrologerPhone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="astrologerLocation" class="form-label">Location <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('astrologerLocation') is-invalid @enderror" name="astrologerLocation"
                            value="{{ old('astrologerLocation', $astrologer->astrologerLocation ?? '') }}" required>
                        @error('astrologerLocation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="astroVideoLink" class="form-label">Video Link <span class="text-danger">*</span></label>
                        <input type="url" class="form-control @error('astroVideoLink') is-invalid @enderror" name="astroVideoLink"
                            value="{{ old('astroVideoLink', $astrologer->astroVideoLink ?? '') }}" required>
                        @error('astroVideoLink')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status" required>
                            <option value="Review" {{ old('status', $astrologer->status ?? '') == 'Review' ? 'selected' : '' }}>Review</option>
                            <option value="Approved" {{ old('status', $astrologer->status ?? '') == 'Approved' ? 'selected' : '' }}>Approved</option>
                            <option value="Rejected" {{ old('status', $astrologer->status ?? '') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="publishStatus" class="form-label">Publish Status <span class="text-danger">*</span></label>
                        <select class="form-control @error('publishStatus') is-invalid @enderror" name="publishStatus" required>
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
