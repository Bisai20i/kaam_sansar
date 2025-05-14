  <tbody>
                                    @foreach ($districts as $district)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $district->provience->provienceName }}</td>
                                            <td>{{ $district->districtName }}</td>
                                            <td>
                                                <p class="text-capitalize badge {{ $district->publishStatus ? 'bg-success' : 'bg-danger' }} m-2">
                                                    {{ $district->publishStatus ? 'Published' : 'Unpublished' }}
                                                </p>
                                            </td>
                                            <td>
                                                <a href="{{ route('workPermitLocation.index', ['district_id' => $district->id]) }}" 
                                                    class="btn btn-info btn-sm text-white">Manage Locations</a>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" 
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item text-{{ $district->publishStatus ? 'danger' : 'success' }}" 
                                                            href="javascript:void(0);" data-bs-toggle="modal"
                                                            data-bs-target="#publishUnpublishModal"
                                                            onclick="setPublishUnpublishFormAction({{ $district->id }}, '{{ $district->publishStatus }}')">
                                                            <i class="bx bx-{{ $district->publishStatus ? 'x' : 'check' }} me-1"></i>
                                                            {{ $district->publishStatus ? 'Unpublish' : 'Publish' }}
                                                        </a>
                                                        <a class="dropdown-item text-primary" href="#"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editDistrictModal{{ $district->id }}">
                                                            <i class="bx bx-edit me-1"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                            onclick="setDeleteFormAction({{ $district->id }})">
                                                            <i class="bx bx-trash me-1"></i> Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <!-- Edit Modal for each district -->
                                        <div class="modal fade" id="editDistrictModal{{ $district->id }}" 
                                            tabindex="-1" aria-labelledby="editDistrictModalLabel" aria-hidden="true" 
                                            data-bs-backdrop="static" data-bs-keyboard="false">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form id="editDistrictForm" 
                                                        action="{{ route('workPermitDistrict.update', $district->id) }}" 
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editDistrictModalLabel">
                                                                Edit District</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Province</label>
                                                                <select class="form-select" name="provience_id" required>
                                                                    @foreach($provinces as $province)
                                                                        <option value="{{ $province->id }}" {{ $district->provience_id == $province->id ? 'selected' : '' }}>
                                                                            {{ $province->provienceName }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">District Name</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    value="{{ $district->districtName }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Publish Status</label>
                                                                <select class="form-select" name="status" required>
                                                                    <option value="1" {{ $district->publishStatus ? 'selected' : '' }}>
                                                                        Published</option>
                                                                    <option value="0" {{ !$district->publishStatus ? 'selected' : '' }}>
                                                                        Unpublished</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                                <script>
    // URLs for publish and unpublish routes
    const publishUrl = @json(route('workPermitDistrict.publish', ['id' => '__ID__']));
    const unpublishUrl = @json(route('workPermitDistrict.unpublish', ['id' => '__ID__']));

    // Function to dynamically update modal content
    function setPublishUnpublishFormAction(districtId, currentStatus) {
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
            publishUnpublishForm.action = unpublishUrl.replace('__ID__', districtId);
        } else {
            // Set content for publishing
            modalTitle.textContent = 'Published';
            modalMessage.textContent = 'Are you sure you want to publish this District?';
            actionButton.classList.remove('btn-warning');
            actionButton.classList.add('btn-success');
            buttonText.textContent = 'Publish';
            publishUnpublishForm.action = publishUrl.replace('__ID__', districtId);
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
</script> <script>
    // Function to set the form action for the delete button
    function setDeleteFormAction(id) {
        document.getElementById('deleteForm').action = '{{ route('workPermitDistricts.destroy', '') }}/' + id;
    }
</script> 
<script>
    function addDistrict() {
        const form = document.getElementById('addDistrictForm');
        const formData = new FormData(form);
        const errorElement = document.getElementById('inputError');

        // Reset error
        errorElement.style.display = 'none';

        // Validate
        if (!formData.get('provience_id') || !formData.get('name') || !formData.get('publishStatus')) {
            errorElement.style.display = 'block';
            errorElement.textContent = 'Please fill all required fields';
            return;
        }

        // Add loading state
        const addButton = document.querySelector('#addDistrictForm button[type="button"]');
        const originalText = addButton.innerHTML;
        addButton.innerHTML = '<i class="bx bx-loader bx-spin"></i> Adding...';
        addButton.disabled = true;

        // AJAX request
        fetch("{{ route('workPermitDistricts.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Add new row to table
                    const tableBody = document.querySelector('#districtsTable tbody');
                    const newRow = document.createElement('tr');
                    newRow.id = 'districtRow' + data.district.id;
                    newRow.innerHTML = `
                    <td>${tableBody.children.length + 1}</td>
                    <td>${data.provienceName}</td>
                    <td>${data.district.districtName}</td>
                    <td>
                        <span class="badge bg-${data.district.publishStatus ? 'success' : 'danger'}">
                            ${data.district.publishStatus ? 'Published' : 'Unpublished'}
                        </span>
                    </td>
                    <td>
                        <a href="/admin/work-permit-locations?district_id=${data.district.id}" 
                            class="btn btn-info btn-sm">Locations</a>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);" 
                                    onclick="toggleDistrictStatus(${data.district.id}, ${data.district.publishStatus})">
                                    <i class="bx bx-${data.district.publishStatus ? 'x' : 'check'} me-1"></i>
                                    ${data.district.publishStatus ? 'Unpublish' : 'Publish'}
                                </a>
                                <a class="dropdown-item" href="javascript:void(0);" 
                                    onclick="editDistrict(${data.district.id})">
                                    <i class="bx bx-edit me-1"></i> Edit
                                </a>
                                <a class="dropdown-item" href="javascript:void(0);" 
                                    onclick="deleteDistrict(${data.district.id})">
                                    <i class="bx bx-trash me-1"></i> Delete
                                </a>
                            </div>
                        </div>
                    </td>
                `;
                    tableBody.appendChild(newRow);

                    // Reset form
                    form.reset();
                } else {
                    errorElement.style.display = 'block';
                    errorElement.textContent = data.message || 'Error adding district';
                }
            })
            .catch(error => {
                errorElement.style.display = 'block';
                errorElement.textContent = 'An error occurred';
            })
            .finally(() => {
                addButton.innerHTML = originalText;
                addButton.disabled = false;
            });
    }

    function editDistrict(id) {
        // Fetch district data
        fetch(`/admin/work-permit-districts/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Populate modal
                    document.getElementById('editDistrictId').value = data.district.id;
                    document.getElementById('editDistrictName').value = data.district.districtName;
                    document.getElementById('editProvienceId').value = data.district.provience_id;
                    document.getElementById('editPublishStatus').value = data.district.publishStatus;

                    // Show modal
                    const modal = new bootstrap.Modal(document.getElementById('editDistrictModal'));
                    modal.show();
                }
            });
    }

    // Handle edit form submission
    document.getElementById('editDistrictForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const id = formData.get('id');
        const submitButton = this.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;

        submitButton.innerHTML = '<i class="bx bx-loader bx-spin"></i> Saving...';
        submitButton.disabled = true;

        fetch(`/admin/work-permit-districts/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-HTTP-Method-Override': 'PUT'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update row in table
                    const row = document.getElementById(`districtRow${id}`);
                    if (row) {
                        row.cells[1].textContent = data.provienceName;
                        row.cells[2].textContent = data.district.districtName;
                        row.cells[3].innerHTML = `
                        <span class="badge bg-${data.district.publishStatus ? 'success' : 'danger'}">
                            ${data.district.publishStatus ? 'Published' : 'Unpublished'}
                        </span>
                    `;

                        // Update dropdown actions
                        const dropdownMenu = row.querySelector('.dropdown-menu');
                        dropdownMenu.innerHTML = `
                        <a class="dropdown-item" href="javascript:void(0);" 
                            onclick="toggleDistrictStatus(${data.district.id}, ${data.district.publishStatus})">
                            <i class="bx bx-${data.district.publishStatus ? 'x' : 'check'} me-1"></i>
                            ${data.district.publishStatus ? 'Unpublish' : 'Publish'}
                        </a>
                        <a class="dropdown-item" href="javascript:void(0);" 
                            onclick="editDistrict(${data.district.id})">
                            <i class="bx bx-edit me-1"></i> Edit
                        </a>
                        <a class="dropdown-item" href="javascript:void(0);" 
                            onclick="deleteDistrict(${data.district.id})">
                            <i class="bx bx-trash me-1"></i> Delete
                        </a>
                    `;
                    }

                    // Hide modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editDistrictModal'));
                    modal.hide();
                }
            })
            .finally(() => {
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
            });
    });

    function toggleDistrictStatus(id, currentStatus) {
        if (confirm(`Are you sure you want to ${currentStatus ? 'unpublish' : 'publish'} this district?`)) {
            fetch(`/admin/work-permit-districts/${id}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-HTTP-Method-Override': 'PUT'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update status in table
                        const row = document.getElementById(`districtRow${id}`);
                        if (row) {
                            row.cells[3].innerHTML = `
                            <span class="badge bg-${data.newStatus ? 'success' : 'danger'}">
                                ${data.newStatus ? 'Published' : 'Unpublished'}
                            </span>
                        `;

                            // Update dropdown actions
                            const dropdownMenu = row.querySelector('.dropdown-menu');
                            dropdownMenu.innerHTML = `
                            <a class="dropdown-item" href="javascript:void(0);" 
                                onclick="toggleDistrictStatus(${id}, ${data.newStatus})">
                                <i class="bx bx-${data.newStatus ? 'x' : 'check'} me-1"></i>
                                ${data.newStatus ? 'Unpublish' : 'Publish'}
                            </a>
                            <a class="dropdown-item" href="javascript:void(0);" 
                                onclick="editDistrict(${id})">
                                <i class="bx bx-edit me-1"></i> Edit
                            </a>
                            <a class="dropdown-item" href="javascript:void(0);" 
                                onclick="deleteDistrict(${id})">
                                <i class="bx bx-trash me-1"></i> Delete
                            </a>
                        `;
                        }
                    }
                });
        }
    }

    function deleteDistrict(id) {
        if (confirm('Are you sure you want to delete this district?')) {
            fetch(`/admin/work-permit-districts/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-HTTP-Method-Override': 'DELETE'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove row from table
                        const row = document.getElementById(`districtRow${id}`);
                        if (row) {
                            row.remove();
                        }

                        // Renumber the SN column
                        const rows = document.querySelectorAll('#districtsTable tbody tr');
                        rows.forEach((row, index) => {
                            row.cells[0].textContent = index + 1;
                        });
                    }
                });
        }
    }
</script>