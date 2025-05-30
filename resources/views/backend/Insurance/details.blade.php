@extends('backend.layouts.main')

@section('title', 'Insurance Category Details')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <h4 class="fw-bold mb-4 d-flex align-items-center justify-content-between">
                <span> <a href="{{  route('insurance.company')  }}" class="fw-light text-muted">Insurance / </a>  <strong class="fw-semibold text-dark">{{ ucfirst($category->name) }}</strong></span>
                <a href="{{ route('insurance.sub_categories', ['id' => $category->id]) }}" class="btn btn-primary btn-sm"> Manage Sub Categories <i class='bx bx-right-arrow-alt'></i></a> 
            </h4>

            <!-- Main Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Category Details <span
                                    class="badge bg-label-{{ $category->publishStatus ? 'success' : 'danger' }}">{{ $category->publishStatus ? 'Published' : 'Unpublished' }}</span>
                            </h5>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#manageDetailModal">
                                    <i class="bx bx-plus"></i>{{ $detail ? 'Edit Details' : 'Add Details' }}
                                </button>
                                <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#publishUnpublishModal"
                                    onclick="setPublishUnpublishFormAction({{ $category->id }}, '{{ $category->publishStatus }}')">
                                    {{ $category->publishStatus ? 'Unpublish' : 'Publish' }}
                                </button>
                            </div>

                        </div>
                        <div class="card-body">
                            <h3>Thumbnail</h3>
                            @if ($detail)
                                <img class="img img-fluid w-100 rounded-2 mb-2 overflow-hidden" style="max-width: 500px"
                                    src="{{ asset('storage/' . $detail->thumbnail) }}">
                            @else
                                <span class="text-danger">No Thumbnail Uploaded</span>
                            @endif

                            <hr>
                            <h3>Description</h3>
                            @if ($detail)
                                {!! $detail->description !!}
                            @else
                                <span class="text-danger">No details added</span>
                            @endif

                        </div>
                    </div>
                </div>
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
                <form id="detailForm" method="POST" enctype="multipart/form-data"
                    action="{{ isset($detail) ? route('insuranceCategory.update', $detail->id) : route('insuranceDetails.store') }}">
                    @csrf
                    @if (isset($detail))
                        @method('PUT')
                    @endif
                    <div id="methodField"></div> <!-- For PUT method when editing -->

                    <div class="modal-body">
                        <input type="hidden" name="{{ isset($detail) ? 'detail_id' : 'category_id' }}"
                            id="insurance_category_id" value="{{ isset($detail) ? $detail->id : $category->id }}">

                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" {{ isset($detail) ? '' : 'readonly' }} name="category_name"
                                class="form-control" id="categoryNameDisplay" value="{{ $category->name }}">
                        </div>



                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail ( Prefered Ratio: 16:9 | MAX: 2MB )</label>
                            <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
                            <div class="mt-2" id="thumbnailPreviewContainer"
                                style="display: {{ isset($detail) && $detail->thumbnail ? 'block' : 'none' }};">

                                <img id="thumbnailPreview"
                                    src="{{ isset($detail) && $detail->thumbnail ? asset('storage/' . $detail->thumbnail) : '' }}"
                                    class="img-thumbnail" style="max-height: 200px;" >
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span
                                    class="text-danger">*</span></label>
                            <textarea id="description" name="description" class="form-control" rows="5" required>{{ isset($detail) ? $detail->description : '' }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <span id="buttonText">Submit</span>
                            <span id="buttonSpinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
                        </button>
                    </div>
                </form>
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
                        Want to Toggle Insurance Category Publish Status ?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="publishUnpublishForm" method="POST"
                        action="{{ $category->publishStatus ? route('insuranceCategory.unpublish', $category->id) : route('insuranceCategory.publish', $category->id) }}">
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
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this category detail? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Simple Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Form Errors</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                        onclick="bootstrap.Modal.getInstance(document.getElementById('manageDetailModal')).show()">
                        Go to Form
                    </button>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>

    <script>
        // Show error modal if there are validation errors
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->any())
                // Show error modal
                const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();

                // Show form modal and populate with old input
                const formModal = new bootstrap.Modal(document.getElementById('manageDetailModal'));
                formModal.show();
            @endif
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

                if(this.files[0].size > 2* 1024 * 1024){
                    this.classList.add('is-invalid');
                    this.value = '';
                    if(this.parentElement.querySelector('.invalid-feedback')){
                        this.parentElement.querySelector('.invalid-feedback').remove();
                    }
                    let feedback = document.createElement('small');
                    feedback.classList.add('invalid-feedback', 'text-danger');
                    feedback.textContent = 'File size should be less than 2MB';
                    this.parentElement.appendChild(feedback);
                    document.getElementById('thumbnailPreviewContainer').style.display = 'none'
                    return;
                }
                this.classList.remove('is-invalid');
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

        $(document).ready(function() {
            $('#description').summernote({
                placeholder: 'Enter category description...',
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
        // URLs for publish and unpublish routes
        const publishUrl = @json(route('insuranceCategory.publish', ['id' => '__ID__']));
        const unpublishUrl = @json(route('insuranceCategory.unpublish', ['id' => '__ID__']));

        // Function to dynamically update modal content
        function setPublishUnpublishFormAction(companyId, currentStatus) {
            const modalMessage = document.getElementById('modalMessage');
            const actionButton = document.getElementById('modalActionButton');
            const buttonText = document.getElementById('buttonText');
            const publishUnpublishForm = document.getElementById('publishUnpublishForm');

            if (currentStatus === '1') {
                // Set content for unpublishing';
                modalMessage.textContent = 'Are you sure you want to unpublish this Insurance Category?';
                actionButton.classList.remove('btn-success');
                actionButton.classList.add('btn-warning');
                buttonText.textContent = 'Unpublish';
                publishUnpublishForm.action = unpublishUrl.replace('__ID__', companyId);
            } else {
                // Set content for publishing
                modalMessage.textContent = 'Are you sure you want to publish this Insurance Category?';
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
    </script>
@endsection
