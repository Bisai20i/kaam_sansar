@extends('backend.layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <h4 class="fw-bold mb-4"><span class="text-muted fw-light"> </span> Job Category</h4>

            <!-- Main Content -->
            <div class="row">
                <!-- Form to Add/Edit Job Category -->
                <div class="col-12 col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">{{ isset($JobCategory) ? 'Edit' : 'Add' }} Job Category</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                action="{{ isset($JobCategory)
                                    ? route('jobCategory.update', ['JobCategory' => $JobCategory->id])
                                    : route('jobCategory.store') }}"
                                id="JobForm">
                                @csrf
                                @if (isset($JobCategory))
                                    @method('PUT')
                                @endif

                                <!-- Hidden input to store the job categories -->
                                <input type="hidden" name="job_categories" id="jobCategories">

                                <div class="mb-3">
                                    <label for="subTask" class="form-label">
                                        Job Category Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="subTask"
                                            placeholder="Add Job Category" style="flex: 2;">
                                        <select class="form-select" id="taskStatus" style="flex: 1; border-left: none;">
                                            <option>--Choose Status--</option>
                                            <option>Active</option>
                                            <option>Inactive</option>
                                            <option>Pending</option>
                                        </select>
                                        <button class="btn btn-primary" type="button" onclick="addToTable()"
                                            style="flex: 0 0 auto;">
                                            <i class="bx bx-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div id="inputError" class="text-danger mt-1" style="display: none;"></div>
                                </div>

                                <table class="table table-bordered mt-3 mb-3" id="taskTable">
                                    <thead>
                                        <tr>
                                            <th>Job Category Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>



                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center"
                                        id="submitButton" disabled>
                                        <span id="buttonSubmitText">Submit</span>
                                        <div id="loaderSpinner" class="spinner-border spinner-border-sm d-none"
                                            role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Job Categories List (For Reference) -->
                <div class="col-12 col-md-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Job Categories</h5>
                            <small class="text-muted float-end">List of Job Categories</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Job Category Name</th>
                                            <th>Status</th>
                                            <th>Publish Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jobCategories as $Jobcategory)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $Jobcategory->jobCategoryName }}</td>
                                                <td>
                                                    <p
                                                        class="text-capitalize  badge {{ $Jobcategory->status == 'active' ? 'bg-success' : 'bg-danger' }} m-2">
                                                        {{ $Jobcategory->status }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p
                                                        class="text-capitalize badge  {{ $Jobcategory->publishStatus == 'published' ? 'bg-success' : 'bg-danger' }} m-2">
                                                        {{ $Jobcategory->publishStatus }}</p>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0  dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">

                                                            <a class="dropdown-item text-{{ $Jobcategory->publishStatus == 'published' ? 'danger' : 'success' }}"
                                                                href="javascript:void(0);" data-bs-toggle="modal"
                                                                data-bs-target="#publishUnpublishModal"
                                                                onclick="setPublishUnpublishFormAction({{ $Jobcategory->id }}, '{{ $Jobcategory->publishStatus }}', '{{ $Jobcategory->jobCategoryName }}')">
                                                                <i
                                                                    class="bx bx-{{ $Jobcategory->publishStatus == 'published' ? 'x' : 'check' }} me-1"></i>
                                                                {{ $Jobcategory->publishStatus == 'published' ? 'Unpublish' : 'Publish' }}
                                                            </a>

                                                            <!-- Edit Trigger -->
                                                            <a class="dropdown-item text-primary" href="#"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editJobCategoryModal{{ $Jobcategory->id }}">
                                                                <i class="bx bx-edit me-1"></i> Edit
                                                            </a>
                                                            <!-- Delete Trigger -->
                                                            <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                                onclick="setDeleteFormAction({{ $Jobcategory->id }})">
                                                                <i class="bx bx-trash me-1"></i> Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="editJobCategoryModal{{ $Jobcategory->id }}"
                                                tabindex="-1" aria-labelledby="editJobCategoryModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form id="editJobCategoryForm"
                                                            action="{{ route('jobCategory.update', ['jobCategory' => $Jobcategory->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editJobCategoryModalLabel">Edit
                                                                    Job Category</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="editJobCategoryName"
                                                                        class="form-label">Job Category Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="editJobCategoryName" name="name"
                                                                        value="{{ $Jobcategory->jobCategoryName }}"
                                                                        required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editJobCategoryStatus"
                                                                        class="form-label">Status</label>
                                                                    <select class="form-select" id="editJobCategoryStatus"
                                                                        name="status" required>
                                                                        <option value="active"
                                                                            {{ $Jobcategory->status == 'active' ? 'selected' : '' }}>
                                                                            Active</option>
                                                                        <option value="inactive"
                                                                            {{ $Jobcategory->status == 'inactive' ? 'selected' : '' }}>
                                                                            Inactive</option>
                                                                        <option value="pending"
                                                                            {{ $Jobcategory->status == 'pending' ? 'selected' : '' }}>
                                                                            Pending</option>
                                                                    </select>
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
                                    </tbody>
                                </table>
                            </div>

                            <div class="pagination m-3 mx-0" style="float: right;">
                                {{ $jobCategories->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->

    <!-- Publish/Unpublish Modal -->
    <div class="modal fade" id="publishUnpublishModal" tabindex="-1" aria-labelledby="publishUnpublishModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="publishUnpublishModalLabel">
                        Change Job Category Publish Status to <strong id="modalTitle"></strong> Status
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
    <script>
        function addToTable() {
            const taskNameInput = document.getElementById("subTask");
            const taskStatusSelect = document.getElementById("taskStatus");
            const taskName = taskNameInput.value.trim();
            const taskStatus = taskStatusSelect.value;
            const errorElement = document.getElementById("inputError");
            const submitButton = document.getElementById("submitButton");

            taskNameInput.classList.remove("is-invalid");
            taskStatusSelect.classList.remove("is-invalid");
            errorElement.style.display = "none";

            if (taskStatus === "--Choose Status--" || taskStatus === "") {
                taskStatusSelect.classList.add("is-invalid");
                taskNameInput.classList.add("is-invalid");
            } else {
                taskStatusSelect.classList.remove("is-invalid");
                taskNameInput.classList.remove("is-invalid");
            }

            if (!taskName || taskStatus === "--Choose Status--") {
                errorElement.style.display = "block";
                errorElement.textContent = "Please fill in all fields.";
                return;
            }

            const tableBody = document.querySelector("#taskTable tbody");
            const newRow = document.createElement("tr");
            newRow.innerHTML = `
        <td>${taskName}</td>
        <td>${taskStatus}</td>
        <td>
            <button class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button>
        </td>
    `;

            tableBody.appendChild(newRow);

            // Clear input fields
            taskNameInput.value = "";
            taskStatusSelect.value = "--Choose Status--";

            // Enable the submit button since data is added
            toggleSubmitButton();
        }

        function removeRow(button) {
            const row = button.parentElement.parentElement;
            row.remove();

            // Disable the submit button if no rows remain
            toggleSubmitButton();
        }

        // Function to enable/disable the submit button based on table rows
        function toggleSubmitButton() {
            const tableBody = document.querySelector("#taskTable tbody");
            const submitButton = document.getElementById("submitButton");
            if (tableBody.children.length > 0) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }

        // Function to collect job categories and their status before form submission
        document.getElementById("JobForm").onsubmit = function(event) {
            const jobCategories = [];
            const rows = document.querySelectorAll("#taskTable tbody tr");

            rows.forEach(row => {
                const categoryName = row.cells[0].textContent;
                const categoryStatus = row.cells[1].textContent;
                jobCategories.push({
                    name: categoryName,
                    status: categoryStatus
                });
            });

            // Set the collected data in the hidden input field
            document.getElementById("jobCategories").value = JSON.stringify(jobCategories);
        };
    </script>

    <script>
        // Function to set the form action for the delete button
        function setDeleteFormAction(id) {
            document.getElementById('deleteForm').action = '{{ route('jobCategory.destroy', '') }}/' + id;
        }
    </script>

    <script>
        const form = document.getElementById('JobForm');
        const submitButton = document.getElementById('submitButton');
        const buttonText = document.getElementById('buttonSubmitText');
        const loaderSpinner = document.getElementById('loaderSpinner');

        form.addEventListener('submit', function() {
            submitButton.disabled = true;
            loaderSpinner.classList.remove('d-none');
            buttonText.style.display = 'none';
        });
    </script>
    <script>
        // URLs for publish and unpublish routes
        const publishUrl = @json(route('jobCategory.publish', ['id' => '__ID__']));
        const unpublishUrl = @json(route('jobCategory.unpublish', ['id' => '__ID__']));

        // Function to dynamically update modal content
        function setPublishUnpublishFormAction(jobCategoryId, currentStatus) {
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const actionButton = document.getElementById('modalActionButton');
            const buttonText = document.getElementById('buttonText');
            const publishUnpublishForm = document.getElementById('publishUnpublishForm');

            if (currentStatus === 'published') {
                // Set content for unpublishing
                modalTitle.textContent = 'Unpublished';
                modalMessage.textContent = 'Are you sure you want to unpublish this job category?';
                actionButton.classList.remove('btn-success');
                actionButton.classList.add('btn-warning');
                buttonText.textContent = 'Unpublish';
                publishUnpublishForm.action = unpublishUrl.replace('__ID__', jobCategoryId);
            } else {
                // Set content for publishing
                modalTitle.textContent = 'Published';
                modalMessage.textContent = 'Are you sure you want to publish this job category?';
                actionButton.classList.remove('btn-warning');
                actionButton.classList.add('btn-success');
                buttonText.textContent = 'Publish';
                publishUnpublishForm.action = publishUrl.replace('__ID__', jobCategoryId);
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
