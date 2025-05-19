@extends('backend.layouts.main')

@section('title', 'Manage Passport Renewal Country')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <h4 class="fw-bold mb-4 d-flex align-items-center justify-content-between">
                <span>Manage Date Time for {{ ucfirst($location->locationName) }}</span>

                <a href="{{ route('passportLocationList.index', ['district_id' => $location->district_id]) }}" class="btn btn-primary"><i class='bx bx-chevron-left'></i>Back</a>
            
            </h4>

                
            <!-- Main Content -->
            <div class="row">
                <!-- Form to Add/Edit Job Category -->
                <div class="col-12 col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Location Lists</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('passportDateTime.store') }}" id="JobForm">
                                @csrf


                                <div class="form-group">
                                    <label for="subTask" class="form-label">
                                        Insert Date <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control" name="date" required>

                                </div>

                                <!-- Hidden input to store the job categories -->
                                <input type="hidden" name="times" id="jobCategories">
                                <input type="hidden" name="location_id" value="{{ $location->id }}">

                                <div class="mb-3">
                                    <label for="subTask" class="form-label">
                                        Insert Time<span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="time" class="form-control" id="subTask" placeholder="Add time">

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
                                            <th>Time</th>
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
                            <h5 class="mb-0">Date and Times</h5>
                            <small class="text-muted float-end">List of Date Time</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Date</th>
                                            <th>Times</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dateTimes as $dateTime)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{  $dateTime->format('Y-m-d') }}</td>
                                                <td>
                                                    @if ($dateTime->time)
                                                        @foreach ($dateTime->time as $time)
                                                            {{ $time['time'] }} ,
                                                        @endforeach
                                                    @endif
                                                </td>

                                                <td>
                                                    <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                        onclick="setDeleteFormAction({{ $dateTime->id }})">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="pagination m-3 mx-0" style="float: right;">
                                {{ $dateTimes->links() }}
                            </div>
                        </div>
                    </div>
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
                        Are you sure you want to delete this Date ?
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
            const taskName = taskNameInput.value.trim();
            const errorElement = document.getElementById("inputError");

            taskNameInput.classList.remove("is-invalid");
            errorElement.style.display = "none";



            if (!taskName) {
                errorElement.style.display = "block";
                errorElement.textContent = "Please fill in all fields.";
                return;
            }

            const tableBody = document.querySelector("#taskTable tbody");
            const newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td>${taskName}</td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button>
                </td>
            `;

            tableBody.appendChild(newRow);

            // Clear input fields
            taskNameInput.value = "";

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
                jobCategories.push({
                    time: categoryName,
                });
            });

            document.getElementById("jobCategories").value = JSON.stringify(jobCategories);
        };
    </script>

    <script>
        // Function to set the form action for the delete button
        function setDeleteFormAction(id) {
            document.getElementById('deleteForm').action = '{{ route('passportDateTime.destroy', '') }}/' + id;
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


@endsection
