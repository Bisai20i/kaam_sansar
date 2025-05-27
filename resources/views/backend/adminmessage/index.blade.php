@extends('backend.layouts.main')

@section('title', 'Horoscope Reply')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold mb-4">Horoscope Reply</h4>

    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Horoscope Reply</h5>
            <a href="{{ route('admin-messages.create') }}" class="btn btn-primary btn-sm">Send New Reply</a>
        </div>

        <div class="card-body">
            <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Admin</th>
                            <th>Jyotish</th>
                            <th>Jobseeker</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($adminMessages as $message)
                        <tr>
                            <td>{{ $loop->iteration + ($adminMessages->currentPage() - 1) * $adminMessages->perPage() }}</td>
                            <td>{{ $message->admin->fullName ?? 'N/A' }}</td>
                            <td>{{ $message->jyotish->name ?? ($message->jyotish->firstName . ' ' . $message->jyotish->lastName ?? 'N/A') }}</td>
                            <td>{{ $message->jobseeker->firstName ?? '' }} {{ $message->jobseeker->lastName ?? '' }}</td>

                            <td>{{ $message->title }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item text-primary" href="{{ route('admin-messages.show', $message->id) }}">
                                                <i class="bx bx-show me-1"></i> View
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-warning" href="{{ route('admin-messages.edit', $message->id) }}">
                                                <i class="bx bx-edit me-1"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                onclick="setDeleteFormAction({{ $message->id }})">
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No admin messages found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $adminMessages->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Admin Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this admin message?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function setDeleteFormAction(id) {
        const deleteForm = document.getElementById('deleteForm');
        let url = "{{ route('admin-messages.destroy', '__ID__') }}";
        url = url.replace('__ID__', id);
        deleteForm.action = url;
    }
</script>
@endpush