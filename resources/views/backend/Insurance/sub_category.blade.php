@extends('backend.layouts.main')

@section('title', 'Insurance')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <h4 class="fw-bold mb-4">
                <span class="fw-light"><a class="text-muted" href="{{ route('insurance.company') }}"> Insurance /</a> <a
                        href="{{ route('insurance.manage', ['id' => $category->id]) }}"
                        class="text-muted">{{ $category->name }}</a> /</span>
                Manage Sub Categories
            </h4>
            <!-- Main Content -->
            <div class="row">


                <!-- Insurance Companies List (For Reference) -->
                <div class="col-12 col-md-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Sub Categories</h5>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#manageDetailModal">
                                <i class="bx bx-plus"></i> Add Sub Category
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Sub Category Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Publish Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($sub_categories->count() > 0)


                                            @foreach ($sub_categories as $sub)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $sub->name }}</td>
                                                    <td>
                                                        {!! $sub->description !!}
                                                    </td>
                                                    <td>
                                                        {{ $sub->price }}
                                                    </td>
                                                    <td>
                                                        <p
                                                            class="text-capitalize  badge {{ $sub->publishStatus == '1' ? 'bg-success' : 'bg-danger' }} m-2">
                                                            {{ $sub->publishStatus == '1' ? 'Published' : 'Unpublished' }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0  dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">

                                                                <a class="dropdown-item text-{{ $sub->publishStatus == '1' ? 'danger' : 'success' }}"
                                                                    href="javascript:void(0);" data-bs-toggle="modal"
                                                                    data-bs-target="#publishUnpublishModal"
                                                                    onclick="setPublishUnpublishFormAction({{ $sub->id }}, '{{ $sub->publishStatus }}')">
                                                                    <i
                                                                        class="bx bx-{{ $sub->publishStatus == '1' ? 'x' : 'check' }} me-1"></i>
                                                                    {{ $sub->publishStatus == '1' ? 'Unpublish' : 'Publish' }}
                                                                </a>

                                                                <!-- Edit Trigger -->
                                                                <a class="dropdown-item text-primary" href="#"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editSubCategoryModal{{ $sub->id }}">
                                                                    <i class="bx bx-edit me-1"></i> Edit
                                                                </a>
                                                                
                                                                <!-- Delete Trigger -->
                                                                <a class="dropdown-item text-danger"
                                                                    href="javascript:void(0);" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal"
                                                                    onclick="setDeleteFormAction({{ $sub->id }})">
                                                                    <i class="bx bx-trash me-1"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="editSubCategoryModal{{ $sub->id }}"
                                                    tabindex="-1" aria-labelledby="editvisaCountryListModalLabel"
                                                    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form id="editSubCategory" enctype="multipart/form-data"
                                                                action="{{ route('insuranceSubCategory.update', ['id' => $sub->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                
                                                                    <div class="mb-3">
                                                                        <label class="form-label">SubCategory Name</label>
                                                                        <input type="text" name="sub_category_name" value="{{ $sub->name }}"
                                                                            class="form-control">
                                                                    </div>
                                            
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Price</label>
                                                                        <input type="number" name="price" value="{{ $sub->price }}"
                                                                            class="form-control">
                                                                    </div>
                                            
                                                                    <div class="mb-3">
                                                                        <label for="description" class="form-label">Description <span
                                                                                class="text-danger">*</span></label>
                                                                        <textarea id="description" name="description" class="form-control" rows="5" required>
                                                                            {{ $sub->description }}
                                                                        </textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        Changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center">No Sub Category Found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Publish/Unpublish Modal -->
    <div class="modal fade" id="publishUnpublishModal" tabindex="-1" aria-labelledby="publishUnpublishModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="publishUnpublishModalLabel">
                        Change Insurance Company Publish Status to <strong id="modalTitle"></strong> Status
                    </h5>
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
                        <button type="submit" id="modalActionButton" class="btn">
                            <span id="loader" class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true" style="display: none;"></span>
                            <span id="buttonText">Submit</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        Are you sure you want to delete this category ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" id="deleteButton">
                            <span id="deleteLoader" class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true" style="display: none;"></span>
                            Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Manage Detail Modal (for both Add and Edit) -->
    <div class="modal fade" id="manageDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Category Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="detailForm" method="POST"
                    action="{{ route('insuranceSubCategory.store', ['id' => $category->id]) }}">
                    @csrf

                    <div class="modal-body">
                        <input type="hidden" name="category_id"
                            id="insurance_category_id" value="{{ $category->id }}">

                        <div class="mb-3">
                            <label class="form-label">SubCategory Name</label>
                            <input type="text" name="sub_category_name"
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" name="price"
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span
                                    class="text-danger">*</span></label>
                            <textarea id="description" name="description" class="form-control" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <span id="buttonText">Submit</span>
                            <span id="buttonSpinner" class="spinner-border spinner-border-sm d-none"
                                role="status"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function setDeleteFormAction(id) {
            console.log("{{ route('insuranceSubCategory.destroy', '') }}/'"+ id)
            document.getElementById('deleteForm').action = '{{ route('insuranceSubCategory.destroy', '') }}/' + id;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
    
    <script>
        const publishUrl = @json(route('insuranceSubCategory.publish', ['id' => '__ID__']));
        const unpublishUrl = @json(route('insuranceSubCategory.unpublish', ['id' => '__ID__']));


        // Function to dynamically update modal content
        function setPublishUnpublishFormAction(companyId, currentStatus) {
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const actionButton = document.getElementById('modalActionButton');
            const buttonText = document.getElementById('buttonText');
            const publishUnpublishForm = document.getElementById('publishUnpublishForm');

            if (currentStatus === '1') {
                // Set content for unpublishing
                modalTitle.textContent = 'Unpublished';
                modalMessage.textContent = 'Are you sure you want to unpublish this Insurance Company?';
                actionButton.classList.remove('btn-success');
                actionButton.classList.add('btn-warning');
                buttonText.textContent = 'Unpublish';
                publishUnpublishForm.action = unpublishUrl.replace('__ID__', companyId);
            } else {
                // Set content for publishing
                modalTitle.textContent = 'Published';
                modalMessage.textContent = 'Are you sure you want to publish this Insurance Company?';
                actionButton.classList.remove('btn-warning');
                actionButton.classList.add('btn-success');
                buttonText.textContent = 'Publish';
                publishUnpublishForm.action = publishUrl.replace('__ID__', companyId);
            }
        }

        // Handle loader visibility during form submission
        document.getElementById('publishUnpublishForm').addEventListener('submit', function() {
            const loader = document.getElementById('loader');
            const buttonText = document.getElementById('buttonText');

            // Show loader and hide button text
            loader.style.display = 'inline-block';
            buttonText.style.display = 'none';
        });

        $(document).ready(function() {
            $('#description').summernote({
                placeholder: 'Enter sub category description...',
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>


    <script>
        // Global variables
        let manageDetailModal = new bootstrap.Modal(document.getElementById('manageDetailModal'));
        let deleteConfirmationModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));


        // Confirm deletion
        function confirmDelete(detailId) {
            document.getElementById('deleteForm').action = `/admin/insurance/category-details/${detailId}`;
            deleteConfirmationModal.show();
        }

        // Preview thumbnail when file is selected
        document.getElementById('thumbnail').addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('thumbnailPreview').src = e.target.result;
                    document.getElementById('thumbnailPreviewContainer').style.display = 'block';
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Handle form submission
        document.getElementById('detailForm').addEventListener('submit', function(e) {
            let submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            document.getElementById('buttonText').textContent = 'Processing...';
            document.getElementById('buttonSpinner').classList.remove('d-none');
        });

        
    </script>
@endsection
