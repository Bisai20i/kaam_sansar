@extends('frontend.layouts.main')

@section('title', 'Exit Poll')
@section('content')
<main class="d-flex flex-column flex-grow-1 justify-content-center align-items-center bg-white text-center py-5">
    <div class="text-primary display-3 mb-4 mt-5">
        <i class="fas fa-exclamation-triangle"></i>
    </div>
    <h1 class="fs-2 fw-semibold mb-3">No {{ $message }} availabe at the moment</h1>
    <p class="text-secondary">We couldn’t find the {{ strtolower($message) }} you are searching for.</p>
    <p class="text-secondary mb-4">Please try navigating using the options below.</p>
    <div class="d-flex gap-3">
        <a href="{{ url()->previous() ?? route('index') }}" class="btn-create d-flex align-items-center justify-content-center gap-3 p-2"  style="text-decoration: none;">
            <i class="fas fa-arrow-left ms-2"></i>
            <span class="me-1 fw-semibold">Go Back</span>
        </a>

        <a href="{{ route('index') }}" class="btn-create d-flex align-items-center justify-content-center gap-2 p-2" style="text-decoration: none;">
            <i class="fas fa-home ms-2"></i>
            <span class="me-1 fw-semibold">Homepage</span>
        </a>

    </div>
</main>

@endsection