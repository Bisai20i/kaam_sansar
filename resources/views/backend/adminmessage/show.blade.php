@extends('backend.layouts.main')

@section('title', 'Admin Message Details')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Admin Message Details</h4>
        <a href="{{ route('admin-messages.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="mb-3">
                <label class="form-label fw-bold">Admin:</label>
                <div>{{ $adminMessage->admin->fullName ?? 'N/A' }}</div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Jyotish:</label>
                <div>{{ $adminMessage->jyotish->name ?? 'N/A' }}</div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Jobseeker:</label>
                <div>{{ $adminMessage->jobseeker->firstName ?? '' }} {{ $adminMessage->jobseeker->lastName ?? '' }}</div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Message:</label>
                <div>{{ $adminMessage->title }}</div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Description:</label>
                <div class="border p-3" style="background: #f8f9fa;">
                    {!! $adminMessage->description !!}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection