@extends('backend.layouts.main')

@section('title', 'Money Exchanger Applications')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="content-wrapper">
        <h4 class="fw-bold mb-4">Money Exchanger Applications</h4>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Money Exchanger Application List</h5>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($moneyExchangers as $exchanger)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $exchanger->first_name }} {{ $exchanger->last_name }}</td>
                                        <td>{{ $exchanger->email }}</td>
                                        <td>{{ $exchanger->phone }}</td>
                                        <td>{{ ucfirst($exchanger->status) }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item text-primary" href="{{ route('superadmin.moneyexchangers.show', $exchanger->id) }}">
                                                            <i class="bx bx-show me-1"></i> View
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);" 
                                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                            onclick="setDeleteFormAction({{ $exchanger->id }})">
                                                            <i class="bx bx-trash me-1"></i> Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $moneyExchangers->links() }}
                            </div>
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
                    <h5 class="modal-title">Delete Money Exchanger Application</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this money exchanger application?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST">
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
        const deleteUrl = "{{ route('superadmin.moneyexchangers.destroy', '__ID__') }}";
        deleteForm.action = deleteUrl.replace('__ID__', id);
    }
</script>
@endpush
