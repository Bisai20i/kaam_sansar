<div id="education" class="section-content" style="display: none;">
    <h4 class="mb-3 your-project-text">Your Education</h4>
    <div class="card p-4 card-center">
        <form id="educationForm">
            @csrf
            <input type="hidden" id="educationId" name="id" value="">
            <h3>School/Institution</h3>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="schoolName" class="form-label">School Name</label>
                    <input type="text" class="form-control custom-input" id="schoolName" name="schoolName" placeholder="California University" required />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="degree" class="form-label">Degree <span class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" id="degree" name="degree" placeholder="Bachelor" required />
                </div>
                <div class="col-md-6">
                    <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" id="city" name="city" placeholder="Pokhara" required />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="startDate" class="form-label">Start Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control custom-input" id="startDate" name="startDate" required />
                </div>
                <div class="col-md-6">
                    <label for="graduationDate" class="form-label">Graduation Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control custom-input" id="graduationDate" name="graduationDate" required />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label for="educationDescription" class="form-label">Summary <span class="text-danger">*</span></label>
                    <textarea class="form-control custom-input" id="educationDescription" name="educationDescription" rows="3" required placeholder="Give a summary of your education..."></textarea>
                </div>
            </div>
            <button type="button" class="btn add-project float-start" id="addEducation">+ Add Education</button>
            <div class="text-end">
                <button type="submit" class="btn text-center skip-btn mx-2" data-current="education" data-next="project" data-link="projectLink">Skip</button>
            </div>
        </form>
    </div>

    <!-- Existing Education List -->
    <div class="container mt-4 p-0">
        <div id="educationList">
            @foreach($educations as $education)
            <div class="card mb-3 mt-3 p-3 bg-light rounded w-100" id="card_id_{{ $education->id }}">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>{{ $education->degree }}</h5>
                    </div>
                    <div>
                        <button type="button" class="btn fw-semibold edit-education" style="color: #0064A7;" data-id="{{ $education->id }}">Edit</button>
                        <button type="button" class="btn text-danger fw-semibold delete-education" data-id="{{ $education->id }}">Delete</button>
                    </div>
                </div>
                <div class="text-black-50">
                    <p class="m-0">{{ $education->schoolName }} – {{ $education->city }}</p>
                    <p class="m-0">{{ \Carbon\Carbon::parse($education->startDate)->format('M Y') }} – {{ \Carbon\Carbon::parse($education->graduationDate)->format('M Y') }}</p>
                    <p class="m-0">{{ $education->educationDescription }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Delete Modal for Education -->
<div class="modal fade" id="deleteEducationModal" tabindex="-1" aria-labelledby="deleteEducationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="deleteEducationForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <input type="hidden" id="deleteEducationId" name="id" value="">
             <div class="modal-content p-4 rounded-4 border-0 shadow-lg text-center">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-3">
                    <div class="mx-auto rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                        <i class="bi bi-trash-fill text-danger fs-3"></i>
                    </div>
                </div>
                <h4 class="fw-bold">Are you sure?</h4>
                <p class="text-secondary mb-4">Are you sure you want to delete this education? This action cannot be undone.</p>
                <div class="d-flex justify-content-center align-items-center">
                    <button type="button" class="btn border-secondary-subtle rounded-3 px-4 py-2 col-6 me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger rounded-3 px-4 py-2 col-6 ms-1">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let isEditing = false;
        let currentEducationId = null;

        function collectEducationData() {
            return {
                id: document.getElementById('educationId').value,
                schoolName: document.getElementById('schoolName').value,
                degree: document.getElementById('degree').value,
                city: document.getElementById('city').value,
                startDate: document.getElementById('startDate').value,
                graduationDate: document.getElementById('graduationDate').value,
                educationDescription: document.getElementById('educationDescription').value
            };
        }

        function formatDate(dateStr) {
            const date = new Date(dateStr);
            return date.toLocaleDateString('en-US', {
                month: 'short',
                year: 'numeric'
            });
        }

        function resetForm() {
            document.getElementById('educationForm').reset();
            document.getElementById('educationId').value = '';
            isEditing = false;
            currentEducationId = null;
            document.getElementById('addEducation').textContent = '+ Add Education';
        }

        async function fetchEducationData(id) {
            try {
                const response = await fetch(`/jobseeker/educations/${id}/edit`);
                if (!response.ok) {
                    throw new Error('Failed to fetch education data');
                }
                return await response.json();
            } catch (error) {
                console.error('Error:', error);
                throw error;
            }
        }

        function populateForm(education) {
            document.getElementById('educationId').value = education.id;
            document.getElementById('schoolName').value = education.schoolName;
            document.getElementById('degree').value = education.degree;
            document.getElementById('city').value = education.city;
            document.getElementById('startDate').value = education.startDate;
            document.getElementById('graduationDate').value = education.graduationDate;
            document.getElementById('educationDescription').value = education.educationDescription;
            
            isEditing = true;
            currentEducationId = education.id;
            document.getElementById('addEducation').textContent = 'Update Education';
        }

        async function saveEducationData(data) {
            const url = data.id ? `/jobseeker/educations/${data.id}` : "{{ route('educations.store') }}";
            const method = data.id ? 'PUT' : 'POST';

            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                const text = await response.text();
                console.error(text);
                return { success: false };
            }

            return await response.json();
        }

        function appendEducationCard(education) {
            const card = document.createElement('div');
            card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
            card.id = `card_id_${education.id}`;
            card.innerHTML = `
                <div class="d-flex justify-content-between">
                    <div><h5>${education.degree}</h5></div>
                    <div>
                        <button type="button" class="btn fw-semibold edit-education" style="color: #0064A7;" data-id="${education.id}">Edit</button>
                        <button type="button" class="btn text-danger fw-semibold delete-education" data-id="${education.id}">Delete</button>
                    </div>
                </div>
                <div class="text-black-50">
                    <p class="m-0">${education.schoolName} – ${education.city}</p>
                    <p class="m-0">${formatDate(education.startDate)} – ${formatDate(education.graduationDate)}</p>
                    <p class="m-0">${education.educationDescription}</p>
                </div>
            `;
            document.getElementById('educationList').appendChild(card);
        }

        function updateEducationCard(education) {
            const card = document.getElementById(`card_id_${education.id}`);
            if (card) {
                card.innerHTML = `
                    <div class="d-flex justify-content-between">
                        <div><h5>${education.degree}</h5></div>
                        <div>
                            <button type="button" class="btn fw-semibold edit-education" style="color: #0064A7;" data-id="${education.id}">Edit</button>
                            <button type="button" class="btn text-danger fw-semibold delete-education" data-id="${education.id}">Delete</button>
                        </div>
                    </div>
                    <div class="text-black-50">
                        <p class="m-0">${education.schoolName} – ${education.city}</p>
                        <p class="m-0">${formatDate(education.startDate)} – ${formatDate(education.graduationDate)}</p>
                        <p class="m-0">${education.educationDescription}</p>
                    </div>
                `;
            }
        }

        document.getElementById('addEducation').addEventListener('click', async function(e) {
            e.preventDefault();
            const data = collectEducationData();
            
            if (!data.schoolName || !data.degree || !data.city || !data.startDate || !data.graduationDate || !data.educationDescription) {
                alert('Please fill all required fields');
                return;
            }

            const result = await saveEducationData(data);
            if (result.success) {
                if (isEditing) {
                    updateEducationCard(result.education);
                    alert('Education updated successfully!');
                } else {
                    appendEducationCard(result.education);
                }
                resetForm();
            } else {
                alert('Error saving education');
            }
        });

        // Event delegation for both edit and delete buttons
        document.getElementById('educationList').addEventListener('click', function(e) {
            const id = e.target.dataset.id;
            if (!id) return;

            // Handle edit button
            if (e.target.classList.contains('edit-education')) {
                e.preventDefault();
                fetchEducationData(id)
                    .then(education => {
                        populateForm(education);
                        document.getElementById('educationForm').scrollIntoView({
                            behavior: 'smooth'
                        });
                    })
                    .catch(error => {
                        alert('Error fetching education data: ' + error.message);
                    });
            }
            
            // Handle delete button
            else if (e.target.classList.contains('delete-education')) {
                e.preventDefault();
                // Set the form action and ID
                document.getElementById('deleteEducationId').value = id;
                document.getElementById('deleteEducationForm').action = `/jobseeker/educations/${id}`;
                
                // Show the modal
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteEducationModal'));
                deleteModal.show();
            }
        });

        // Handle form submission for delete modal
        document.getElementById('deleteEducationForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const id = document.getElementById('deleteEducationId').value;
            const form = this;
            
            try {
                const res = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ _method: 'DELETE', id: id })
                });
                
                const json = await res.json();
                if (json.success) {
                    document.getElementById(`card_id_${id}`).remove();
                    if (currentEducationId === parseInt(id)) {
                        resetForm();
                    }
                    
                    // Hide the modal
                    const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteEducationModal'));
                    deleteModal.hide();
                } else {
                    alert('Error deleting education');
                }
            } catch (error) {
                console.error('Delete error:', error);
                alert('Error deleting education');
            }
        });

        async function deleteEducationData(id) {
            try {
                const response = await fetch(`/jobseeker/educations/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        request_type: 'mobile'
                    })
                });

                if (!response.ok) {
                    throw new Error('Failed to delete education');
                }

                return await response.json();
            } catch (error) {
                console.error('Error:', error);
                throw error;
            }
        }
    });
</script>
@endpush