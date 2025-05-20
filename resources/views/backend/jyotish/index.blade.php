@extends('backend.layouts.main')

@section('title', 'Jyotish List')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="content-wrapper">
        <h4 class="fw-bold mb-4">Jyotish List</h4>

        <div class="row">
            <div class="col-12">
                <a href="{{ route('jyotishs.create') }}" class="btn btn-primary btn-sm mb-3">
                    <i class="bx bx-plus"></i> Add New Jyotish
                </a>


                <div class="card mb-4">
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Photo</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jyotishs as $jyotish)
                                    <tr>
                                        <td>{{ $jyotish->name }}</td>
                                        <td>{{ $jyotish->phone }}</td>
                                        <td>{{ $jyotish->email }}</td>
                                        <td>
                                            @if($jyotish->photo)
                                                <img src="{{ asset('storage/' . $jyotish->photo) }}" alt="Photo" width="50" height="50" class="rounded-circle">
                                            @else
                                                <span>No photo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item text-warning" href="{{ route('jyotishs.edit', $jyotish) }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                           data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                           onclick="setDeleteFormAction({{ $jyotish->id }})">
                                                           <i class="bx bx-trash me-1"></i> Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                    @if($jyotishs->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center">No Jyotish found.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $jyotishs->links() }}
                        </div>
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete Jyotish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Jyotish?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function setDeleteFormAction(id) {
        const deleteForm = document.getElementById('deleteForm');
        const deleteUrl = "{{ route('jyotishs.destroy', '__ID__') }}";
        const updatedUrl = deleteUrl.replace('__ID__', id);
        deleteForm.action = updatedUrl;

        // Show the modal (optional, Bootstrap 5 auto-handles toggle on button click)
        var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }
</script>
@endpush
