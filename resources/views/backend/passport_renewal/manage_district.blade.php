@extends('backend.layouts.main')

@section('title', 'Manage Passport Renewal Country')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <h4 class="fw-bold mb-4"><a href="{{ route('passport.renewal') }}" class="text-muted fw-semibold">Passport Renewals /</a> 
                <a href="{{ route('passportCountryList.index') }}" class="text-muted fw-semibold">{{ ucfirst($provience->passportCountryList->countryName) }} /</a>
                <a href="{{ route('passportProvienceList.index', ['country_id' => $provience->country_id]) }}" class="text-muted fw-semibold">{{ ucfirst($provience->provienceName) }} /</a>
                 Districts</h4>
            <!-- Main Content -->
            <div class="row">
                <!-- Form to Add/Edit Job Category -->
                <div class="col-12 col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0"> District Lists</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                action="{{ route('passportDistrictList.store') }}"
                                id="JobForm">
                                @csrf
                                @if (isset($passportDistrictList))
                                    @method('PUT')
                                @endif

                                <!-- Hidden input to store the job categories -->
                                <input type="hidden" name="district_lists" id="jobCategories">
                                <input type="hidden" name="provience_id" value="{{ $provience->id }}" id="provience_id">

                                <div class="mb-3">
                                    <label for="subTask" class="form-label">
                                        District Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="subTask"
                                            placeholder="Add District Name" style="flex: 2;">
                                        <select class="form-select" id="taskStatus" style="flex: 1; border-left: none;">
                                            <option>--Choose Publish Status--</option>
                                            <option value="1">Published</option>
                                            <option value="0">Unpublished</option>
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
                                            <th>District Name</th>
                                            <th>Publish Status</th>
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
                            <h5 class="mb-0">Districts</h5>
                            <small class="text-muted float-end">List of Districts</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>District Name</th>
                                            <th>Publish Status</th>
                                            <th>Manage Locations</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($passportDistrictLists as $passportDistrictList)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $passportDistrictList->districtName }}</td>
                                                <td>
                                                    <p
                                                        class="text-capitalize  badge {{ $passportDistrictList->publishStatus == '1' ? 'bg-success' : 'bg-danger' }} m-2">
                                                        {{ $passportDistrictList->publishStatus == '1' ? 'Published' : 'Unpublished' }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <a href="{{ route('passportLocationList.index', ['district_id' => $passportDistrictList->id]) }}"
                                                        class="btn btn-info btn-sm  text-white">Manage Locations</a>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0  dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">

                                                            <a class="dropdown-item text-{{ $passportDistrictList->publishStatus == '1' ? 'danger' : 'success' }}"
                                                                href="javascript:void(0);" data-bs-toggle="modal"
                                                                data-bs-target="#publishUnpublishModal"
                                                                onclick="setPublishUnpublishFormAction({{ $passportDistrictList->id }}, '{{ $passportDistrictList->publishStatus }}')">
                                                                <i
                                                                    class="bx bx-{{ $passportDistrictList->publishStatus == '1' ? 'x' : 'check' }} me-1"></i>
                                                                {{ $passportDistrictList->publishStatus == '1' ? 'Unpublish' : 'Publish' }}
                                                            </a>

                                                            <!-- Edit Trigger -->
                                                            <a class="dropdown-item text-primary" href="#"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editvisaCountryListModal{{ $passportDistrictList->id }}">
                                                                <i class="bx bx-edit me-1"></i> Edit
                                                            </a>
                                                            <!-- Delete Trigger -->
                                                            <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                                onclick="setDeleteFormAction({{ $passportDistrictList->id }})">
                                                                <i class="bx bx-trash me-1"></i> Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="editvisaCountryListModal{{ $passportDistrictList->id }}"
                                                tabindex="-1" aria-labelledby="editvisaCountryListModalLabel"
                                                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form id="editvisaCountryListForm"
                                                            action="{{ route('passportDistrictList.update', ['passportDistrictList' => $passportDistrictList->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editvisaCountryListModalLabel">
                                                                    Edit District</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="editvisaCountryListName"
                                                                        class="form-label">District Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="editvisaCountryListName" name="name"
                                                                        value="{{ $passportDistrictList->districtName }}"
                                                                        required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editvisaCountryListStatus"
                                                                        class="form-label">Publish Status</label>
                                                                    <select class="form-select"
                                                                        id="editvisaCountryListStatus" name="status"
                                                                        required>
                                                                        <option value="1"
                                                                            {{ $passportDistrictList->publishStatus == '1' ? 'selected' : '' }}>
                                                                            Published</option>
                                                                        <option value="0"
                                                                            {{ $passportDistrictList->publishStatus == '0' ? 'selected' : '' }}>
                                                                            Unpublished</option>

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
                                {{ $passportDistrictLists->links() }}
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
                        Change Passport Provience Publish Status to <strong id="modalTitle"></strong> Status
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
                        Are you sure you want to delete this District ?
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

            taskNameInput.classList.remove("is-invalid");
            taskStatusSelect.classList.remove("is-invalid");
            errorElement.style.display = "none";

            if (taskStatus === "--Choose Publish Status--" || taskStatus === "") {
                taskStatusSelect.classList.add("is-invalid");
                taskNameInput.classList.add("is-invalid");
            } else {
                taskStatusSelect.classList.remove("is-invalid");
                taskNameInput.classList.remove("is-invalid");
            }

            if (!taskName || taskStatus === "--Choose Publish Status--") {
                errorElement.style.display = "block";
                errorElement.textContent = "Please fill in all fields.";
                return;
            }

            // Convert numeric status to readable format
            const displayStatus = taskStatus === "1" ? "Published" : "Unpublished";

            const tableBody = document.querySelector("#taskTable tbody");
            const newRow = document.createElement("tr");
            newRow.innerHTML = `
        <td>${taskName}</td>
        <td data-status="${taskStatus}">${displayStatus}</td>
        <td>
            <button class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button>
        </td>
    `;

            tableBody.appendChild(newRow);

            // Clear input fields
            taskNameInput.value = "";
            taskStatusSelect.value = "--Choose Publish Status--";

            toggleSubmitButton();
        }

        function removeRow(button) {
            const row = button.parentElement.parentElement;
            row.remove();
            toggleSubmitButton();
        }

        function toggleSubmitButton() {
            const tableBody = document.querySelector("#taskTable tbody");
            const submitButton = document.getElementById("submitButton");
            submitButton.disabled = tableBody.children.length === 0;
        }

        // Collect job categories and their status before form submission
        document.getElementById("JobForm").onsubmit = function(event) {
            const jobCategories = [];
            const rows = document.querySelectorAll("#taskTable tbody tr");

            rows.forEach(row => {
                const categoryName = row.cells[0].textContent;
                const categoryStatus = row.cells[1].getAttribute("data-status"); // Get numeric status
                jobCategories.push({
                    name: categoryName,
                    status: categoryStatus
                });
            });

            document.getElementById("jobCategories").value = JSON.stringify(jobCategories);
        };
    </script>

    <script>
        // Function to set the form action for the delete button
        function setDeleteFormAction(id) {
            document.getElementById('deleteForm').action = '{{ route('passportDistrictList.destroy', '') }}/' + id;
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
        const publishUrl = @json(route('passportDistrictList.publish', ['id' => '__ID__']));
        const unpublishUrl = @json(route('passportDistrictList.unpublish', ['id' => '__ID__']));

        // Function to dynamically update modal content
        function setPublishUnpublishFormAction(visaCountryListId, currentStatus) {
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const actionButton = document.getElementById('modalActionButton');
            const buttonText = document.getElementById('buttonText');
            const publishUnpublishForm = document.getElementById('publishUnpublishForm');

            if (currentStatus === '1') {
                // Set content for unpublishing
                modalTitle.textContent = 'Unpublished';
                modalMessage.textContent = 'Are you sure you want to unpublish this District?';
                actionButton.classList.remove('btn-success');
                actionButton.classList.add('btn-warning');
                buttonText.textContent = 'Unpublish';
                publishUnpublishForm.action = unpublishUrl.replace('__ID__', visaCountryListId);
            } else {
                // Set content for publishing
                modalTitle.textContent = 'Published';
                modalMessage.textContent = 'Are you sure you want to publish this District?';
                actionButton.classList.remove('btn-warning');
                actionButton.classList.add('btn-success');
                buttonText.textContent = 'Publish';
                publishUnpublishForm.action = publishUrl.replace('__ID__', visaCountryListId);
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
