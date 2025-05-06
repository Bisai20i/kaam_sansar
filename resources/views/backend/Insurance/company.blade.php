@extends('backend.layouts.main')

@section('title', 'Insurance')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <h4 class="fw-bold mb-4"><span class="text-muted fw-light"> </span>Insurance Company</h4>
            <!-- Main Content -->
            <div class="row">
                <!-- Form to Add/Edit Job Category -->
                <div class="col-12 col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">{{ isset($insuranceCompany) ? 'Edit' : 'Add' }} Insurance Company</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('insuranceCompany.store') }}" id="insuranceCompanyForm">
                                @csrf


                                <div class="mb-3">
                                    <label for="company Name" class="form-label">
                                        Company Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="name" required
                                            placeholder="Add Company Name" style="flex: 2;">

                                        <select class="form-select" name="status" style="flex: 1;" required>
                                            <option>--Choose Publish Status--</option>
                                            <option value="1">Published</option>
                                            <option value="0">Unpublished</option>
                                        </select>

                                    </div>

                                    <div id="inputError" class="text-danger mt-1" style="display: none;"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="Company Thumbnail" class="form-label">
                                        Company Thumbnail
                                    </label>
                                    <input type="file" class="form-control" id="taskThumbnail" name="thumbnail"
                                        onchange="previewImage(this)" placeholder="Company Thumbnail" accept="image/*">
                                    <img src="" alt="company" class="d-none img-fluid mt-2"
                                        style="max-width:200px;" id="companyThumbnail" alt="">
                                </div>

                                <script>
                                    previewImage = (input) => {
                                        const companyThumbnail = input.parentElement.querySelector('img');
                                        companyThumbnail.src = URL.createObjectURL(input.files[0]);
                                        companyThumbnail.classList.remove('d-none');
                                    }
                                </script>





                                <div class="d-flex align-items-center">

                                    <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center">
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

                <!-- Insurance Companies List (For Reference) -->
                <div class="col-12 col-md-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Companies</h5>
                            <small class="text-muted float-end">List of Insurance Companies</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Company Name</th>
                                            <th>Company Thumbnail</th>
                                            <th>Publish Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($companies as $company)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $company->name }}</td>
                                                <td>
                                                    @if ($company->thumbnail)
                                                        <img src="{{ asset('storage/' . $company->thumbnail) }}"
                                                            width="100" height="auto" alt="Company Image">
                                                    @else
                                                        No image
                                                    @endif
                                                </td>
                                                <td>
                                                    <p
                                                        class="text-capitalize  badge {{ $company->publishStatus == '1' ? 'bg-success' : 'bg-danger' }} m-2">
                                                        {{ $company->publishStatus == '1' ? 'Published' : 'Unpublished' }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0  dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">

                                                            <a class="dropdown-item text-{{ $company->publishStatus == '1' ? 'danger' : 'success' }}"
                                                                href="javascript:void(0);" data-bs-toggle="modal"
                                                                data-bs-target="#publishUnpublishModal"
                                                                onclick="setPublishUnpublishFormAction({{ $company->id }}, '{{ $company->publishStatus }}', '{{ $company->name }}')">
                                                                <i
                                                                    class="bx bx-{{ $company->publishStatus == '1' ? 'x' : 'check' }} me-1"></i>
                                                                {{ $company->publishStatus == '1' ? 'Unpublish' : 'Publish' }}
                                                            </a>

                                                            <!-- Edit Trigger -->
                                                            <a class="dropdown-item text-primary" href="#"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editvisaCountryListModal{{ $company->id }}">
                                                                <i class="bx bx-edit me-1"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item text-primary" href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                onclick="setCategoryId({{ $company->id }} , '{{ $company->name }}')"
                                                                data-bs-target="#manageCategoriesModal">
                                                                <i class="bx bx-edit me-1"></i> Manage Categories
                                                            </a>
                                                            <!-- Delete Trigger -->
                                                            <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                                onclick="setDeleteFormAction({{ $company->id }})">
                                                                <i class="bx bx-trash me-1"></i> Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="editvisaCountryListModal{{ $company->id }}"
                                                tabindex="-1" aria-labelledby="editvisaCountryListModalLabel"
                                                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form id="editvisaCountryListForm" enctype="multipart/form-data"
                                                            action="{{ route('insuranceCompany.update', ['insuranceCompany' => $company->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="editvisaCountryListModalLabel">
                                                                    Edit Company</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="editvisaCountryListName"
                                                                        class="form-label">Comany Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="editvisaCountryListName" name="name"
                                                                        value="{{ $company->name }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editvisaCountryListStatus"
                                                                        class="form-label">Publish Status</label>
                                                                    <select class="form-select"
                                                                        id="editvisaCountryListStatus" name="status"
                                                                        required>
                                                                        <option value="1"
                                                                            {{ $company->publishStatus == '1' ? 'selected' : '' }}>
                                                                            Published</option>
                                                                        <option value="0"
                                                                            {{ $company->publishStatus == '0' ? 'selected' : '' }}>
                                                                            Unpublished</option>
                                                                    </select>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="editvisaCountryListStatus"
                                                                        class="form-label">Thumbnail</label>
                                                                    <input type="file" class="form-control"
                                                                        name="thumbnail" accept="image/*"
                                                                        onchange="previewImage(this)">
                                                                    <img src="{{ asset('storage/' . $company->thumbnail) }}"
                                                                        alt="company" class="img-fluid mt-2"
                                                                        style="max-width:200px;">
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
                                {{ $companies->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Manage Categories Modal -->

    <div class="modal fade" id="manageCategoriesModal" tabindex="-1" aria-labelledby="emanageCategoriesModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content  p-3 mt-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="manageCategoriesModalLabel">
                        Manage Categories for <span id="company_name"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="manageCategoriesForm" action="#">

                        <hr>
                        <input type="hidden" name="category_lists" id="insuranceCategories">
                        <input type="hidden" name="company_id" value="{{ $company->id }}" id="company_id">
                        <div class="mb-3">
                            <label for="subTask" class="form-label">
                                Category Name <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="subTask" placeholder="Add Category Name"
                                    style="flex: 2;">
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
                                    <th>Category Name</th>
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
                                <div id="loaderSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                        </div>

                    </form>

                    <hr>

                    <table class="table table-bordered mt-3 mb-3" id="categoryListTable">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Publish Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Health Insurance</th>
                                <th><span class="badge bg-success">Published</span></th>
                                <th>
                                    <button class="btn btn-danger btn-sm">Remove</button>
                                    <button class="btn btn-primary btn-sm">Details</button>
                                </th>
                            </tr>
                        </tbody>
                    </table>

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


    <script>
        function setCategoryId(id, name) {

            document.getElementById('company_id').value = id;
            document.getElementById('company_name').innerHTML = name;
            loadRelatedCategories(id)
        }


        async function loadRelatedCategories(id) {
            console.log("fetch category with",id)

            try {
                let response = await fetch(window.location.protocol + "//" + window.location.host +
                    "/superadmin/insurance/" + id + "/category", {
                        method: "GET",
                        headers: {
                            'X-CSRF-TOKEN':"{{ csrf_token() }}",
                            "Accept": "application/json"
                        }
                    })

                let data = await response.json();
                if(data.status){
                    let responseCategories = document.querySelector("#categoryListTable tbody")
                    responseCategories.innerHTML = "";
                    let addedCategories = data.data;

                    if (addedCategories.length > 0) {
                        
                        addedCategories.forEach(category => {
                            const newRow = document.createElement("tr");
                            newRow.innerHTML = `
                                <td>${category.name}</td>
                                <td>${category.publishStatus == 1 ? 'Published' : 'Unpublished'}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm" onclick="deleteCategory(this)" data-category-id="${category.id}">Remove</button>
                                    <button class="btn btn-primary btn-sm"  data-category-id="${category.id}" onclick="viewCategoryDetails(this)">Details</button>
                                </td>
                            `;
                            responseCategories.appendChild(newRow);
                        });
                    }
                    else{
                        const newRow = document.createElement("tr");
                        newRow.innerHTML = `
                            <td colspan="3" class="text-center no-category-found">No categories found</td>
                        `;
                        responseCategories.appendChild(newRow);
                    }
                }
                console.log(data)

            } catch (error) {
                console.error(error)
            }
        }


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
            console.log(tableBody.children.length)
            submitButton.disabled = tableBody.children.length === 0;

        }

        // Collect job categories and their status before form submission
        document.getElementById("manageCategoriesForm").onsubmit = async function(event) {

            event.preventDefault();
            const categories = [];
            const rows = document.querySelectorAll("#taskTable tbody tr");

            rows.forEach(row => {
                const categoryName = row.cells[0].textContent;
                const categoryStatus = row.cells[1].getAttribute("data-status"); // Get numeric status
                categories.push({
                    name: categoryName,
                    status: categoryStatus,
                    company_id: document.getElementById('company_id').value
                });
            });


            try {


                const response = await fetch("{{ route('insuranceCategory.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json", // optional but helpful
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify({categories})
                });

                let data = await response.json();

                console.log(data);

                if (data.status) {
                    document.querySelector("#taskTable tbody").innerHTML = "";

                    responseCategories = document.querySelector("#categoryListTable tbody")

                    if(responseCategories.querySelector('tr.no-category-found')){
                        responseCategories.querySelector('tr.no-category-found').remove();
                    }
                    // if(responseCategories){
                    //     responseCategories.innerHTML = "";
                    // }

                    let addedCategories = data.data;

                    if (addedCategories.length > 0) {
                        addedCategories.forEach(category => {
                            const newRow = document.createElement("tr");
                            newRow.innerHTML = `
                                <td>${category.name}</td>
                                <td>${category.publishStatus == 1 ? 'Published' : 'Unpublished'}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm" onclick="deleteCategory(this)" data-category-id="${category.id}">Remove</button>
                                    <button class="btn btn-primary btn-sm" data-category-id="${category.id}" onclick="viewCategoryDetails(this)">Details</button>
                                </td>
                            `;
                            responseCategories.appendChild(newRow);
                        });
                    }

                }
                else{
                    alert(data.message,data.data);
                }
                


            } catch (error) {
                alert(error)
            }

            // document.getElementById("category_lists").value = JSON.stringify(categories);
        };
    </script>

    <!-- Delete a specific category -->

    <script>

        async function deleteCategory(button) {
            try {
                let id = button.getAttribute('data-category-id')
                const response = await fetch(window.location.protocol + "//" + window.location.host +
                "/superadmin/insurance/category/destroy/" + id, {
                    method: "POST",
                    headers: {
                        "Accept": "application/json", // optional but helpful
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-HTTP-Method-Override": "DELETE"
                    }
                });

                let data = await response.json();

                console.log(data)

                if(data.status){
                    let parentRow = button.parentElement.parentElement;
                    parentRow.remove();
                }
                else{
                    alert(data.message,data.data);
                }
            }
            catch (error) {
                alert(error)
            }
        }
    </script>

    <script>
        // Function to set the form action for the delete button
        function setDeleteFormAction(id) {
            document.getElementById('deleteForm').action = '{{ route('insuranceCompany.destroy', '') }}/' + id;
        }
    </script>

    <script>
        const form = document.getElementById('insuranceCompanyForm');
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
        const viewDetails = @json(route('insurance.manage', ['id' => '__ID__']));
        // URLs for publish and unpublish routes
        const publishUrl = @json(route('insuranceCompany.publish', ['id' => '__ID__']));
        const unpublishUrl = @json(route('insuranceCompany.unpublish', ['id' => '__ID__']));

        function viewCategoryDetails(button) {
            const id = button.getAttribute('data-category-id');
            window.location.href = viewDetails.replace('__ID__', id);
        }

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
    </script>
@endsection
