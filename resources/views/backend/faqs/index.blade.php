@extends('backend.layouts.main')

@section('title', 'FAQs')

@section('content')

<div class="container">
    <!-- Content -->
    <h4 class="fw-bold m-4"><span class="text-muted fw-light">Frequently Ask Question</span></h4>

    <!-- Basic Bootstrap Table -->
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title">FAQs List</h4>
                </div>
                <div>
                    <a href="{{ route('faqs.create') }}" class="btn btn-primary btn-sm text-white">Create FAQ</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="border-right: 1px solid #dee2e6;">S.N</th>
                            <th style="border-right: 1px solid #dee2e6;">Question</th>
                            <th style="border-right: 1px solid #dee2e6;">Answer</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($faqs as $faq)
                        <tr>
                            <td style="border-right: 1px solid #dee2e6;">{{ $loop->iteration }}</td>
                            <td style="border-right: 1px solid #dee2e6;">{{ $faq->question }}</td>
                            <td style="border-right: 1px solid #dee2e6;">
                                {!! Str::limit(strip_tags($faq->answer), 100) !!}
                                @if(strlen(strip_tags($faq->answer)) > 100)
                                <span class="text-muted">...</span>
                                @endif
                            </td>
                            <td style="border-right: 1px solid #dee2e6;">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('faqs.edit', $faq->id) }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <button type="button" class="dropdown-item text-danger"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            data-url="{{ route('faqs.destroy', $faq->id) }}">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @if ($faqs->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">No FAQs found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Warning Icon -->
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle text-warning" style="font-size: 50px;"></i>
                </div>
                <p class="text-center bold"><strong>
                        <h4>Are you sure you want to delete this FAQ?</h4>
                    </strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" action="" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    rel="stylesheet">

<script>
    // Set the delete form action when opening the modal
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const url = button.getAttribute('data-url');
        document.getElementById('deleteForm').action = url;
    });
</script>

@endsection