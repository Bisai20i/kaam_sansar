@extends('backend.layouts.main')

@section('title', 'Aboard Products')

@section('content')

    <div class="container py-5">
        <h4 class="fw-bold mb-4">Aboard Products</h4>

        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title">Aboard Products</h4>
                    </div>
                    <div>
                        <a href="{{ route('aboards.create') }}" class="btn btn-primary btn-sm text-white">Create Product</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Product Title</th>
                                <th>Product Category</th>
                                <th> Product Image</th>
                                <th> Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($aboards as $aboard)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $aboard->productTitle }}</td>
                                    <td>{{ $aboard->productCategory->productCategoryTitle }}</td>
                                    <td>
                                        @if ($aboard->productThumbnail)
                                            <img src="{{ asset($aboard->productThumbnail) }}" alt="Thumbnail" style="width: 100px; height: auto;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $aboard->publishStatus == 'publish' ? 'bg-success' : 'bg-warning' }}">
                                            {{ ucfirst($aboard->publishStatus) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item text-{{ $aboard->publishStatus == 'publish' ? 'danger' : 'success' }}"
                                                    href="javascript:void(0);" data-bs-toggle="modal"
                                                    data-bs-target="#publishUnpublishModal"
                                                    onclick="setPublishUnpublishFormAction({{ $aboard->id }}, '{{ $aboard->publishStatus }}')">
                                                    <i class="bx bx-{{ $aboard->publishStatus == 'publish' ? 'x' : 'check' }} me-1"></i>
                                                    {{ $aboard->publishStatus == 'publish' ? 'Unpublish' : 'Publish' }}
                                                </a>
                                                <a class="dropdown-item" href="{{ route('aboards.edit', $aboard->id) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <a class="dropdown-item text-danger" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $aboard->id }}">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $aboard->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Confirmation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('aboards.destroy', $aboard->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    Are you sure you want to delete this product?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{ $aboards->links() }}
        </div>
    </div>

    <!-- Publish/Unpublish Modal -->
    <div class="modal fade" id="publishUnpublishModal" tabindex="-1" aria-labelledby="publishUnpublishModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="publishUnpublishModalLabel">Change Publish Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="publishUnpublishForm" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success" id="modalActionButton">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const publishUrl = @json(route('aboards.publish', ['id' => '__ID__']));
        const unpublishUrl = @json(route('aboards.unpublish', ['id' => '__ID__']));

        function setPublishUnpublishFormAction(aboardId, currentStatus) {
            const modalMessage = document.getElementById('modalMessage');
            const actionButton = document.getElementById('modalActionButton');
            const publishUnpublishForm = document.getElementById('publishUnpublishForm');

            if (currentStatus === 'publish') {
                modalMessage.textContent = 'Are you sure you want to unpublish this product?';
                actionButton.classList.remove('btn-success');
                actionButton.classList.add('btn-warning');
                publishUnpublishForm.action = unpublishUrl.replace('__ID__', aboardId);
            } else {
                modalMessage.textContent = 'Are you sure you want to publish this product?';
                actionButton.classList.remove('btn-warning');
                actionButton.classList.add('btn-success');
                publishUnpublishForm.action = publishUrl.replace('__ID__', aboardId);
            }
        }
    </script>

@endsection
