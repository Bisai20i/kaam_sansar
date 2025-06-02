<div id="training" class="section-content" style="display:none;">
    <h4 class="mb-3 your-project-text">Trainings/Certifications</h4>
    <div class="card p-4 card-center">
        <form id="trainingForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="trainingId" name="id" value="">

            <h3>Certification</h3>
            <div class="row mb-3">
                <div class="col-md-12 mb-3">
                    <label for="training-title" class="form-label">Training/Certification Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" id="training-title" name="trainingTitle" placeholder="Enter training title" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="training-organization" class="form-label">Institution/Organization <span class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" id="training-organization" name="institutionName" placeholder="Enter Institution name" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="training-date" class="form-label">Completion Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control custom-input" id="training-date" name="completionDate" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="certificate" class="form-label fs-6">Training Certificate<span class="text-danger">*</span></label><br>
                    <input type="file" class="form-control form-control-da fs-6 w-100" id="certificate" name="certificate" accept=".jpg,.jpeg,.png,.pdf">
                    <div id="certificatePreview" class="d-flex mt-1"></div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <div class="text-end">
                    <button type="button" class="btn text-center skip-btn mx-2" data-current="training" data-next="language" data-link="languageLink">Skip</button>
                </div>
                <button type="button" class="btn add-project float-start" id="addTraining">+ Add Training</button>

            </div>
        </form>
    </div>

    <div class="container mt-4 p-0">
        <div id="trainingList">
            @foreach($trainings as $training)
            <div class="card mb-3 mt-3 p-3 bg-light rounded w-100" id="card_training_{{ $training->id }}">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>{{ $training->trainingTitle }}</h5>
                    </div>
                    <div>
                        <button type="button" class="btn fw-semibold edit-training" style="color: #0064A7;" data-id="{{ $training->id }}">Edit</button>
                        <button type="button" class="btn text-danger fw-semibold delete-training" data-id="{{ $training->id }}">Delete</button>
                    </div>
                </div>
                <div class="text-black-50">
                    <p class="m-0">{{ $training->institutionName }}</p>
                    <p class="m-0">{{ \Carbon\Carbon::parse($training->completionDate)->format('M Y') }}</p>
                    @if($training->certificate)
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Delete Modal for Training -->
<div class="modal fade" id="deleteTrainingModal" tabindex="-1" aria-labelledby="deleteTrainingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="deleteTrainingForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <input type="hidden" id="deleteTrainingId" name="id" value="">
            <div class="modal-content p-4 rounded-4 border-0 shadow-lg text-center">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-3">
                    <div class="mx-auto rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                        <i class="bi bi-trash-fill text-danger fs-3"></i>
                    </div>
                </div>
                <h4 class="fw-bold">Are you sure?</h4>
                <p class="text-secondary mb-4">Are you sure you want to delete this Training? This action cannot be undone.</p>
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
        let isEditingTraining = false;
        let currentTrainingId = null;

        // Image preview for certificate
        document.getElementById('certificate').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('certificatePreview');
            preview.innerHTML = ''; // Clear previous preview

            if (file) {
                if (file.type.startsWith('image/')) {
                    // For image files, show thumbnail preview
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        preview.innerHTML = `
                        <div class="position-relative" style="width: 100px;">
                            <img src="${evt.target.result}" 
                                 style="height: 80px; width: 100px; border-radius: 6px; object-fit: cover;" 
                                 class="img-thumbnail" />
                            <button type="button" class="btn-close position-absolute top-0 end-0 bg-white rounded-circle p-1" 
                                    style="transform: translate(30%, -30%);" 
                                    onclick="document.getElementById('certificatePreview').innerHTML = ''; document.getElementById('certificate').value = '';">
                            </button>
                        </div>
                        </div>`;
                    };
                    reader.readAsDataURL(file);
                } else if (file.type === 'application/pdf') {
                    // For PDF files, show a PDF icon
                    preview.innerHTML = `
                    <div class="position-relative" style="width: 100px;">
                        <div class="bg-light d-flex align-items-center justify-content-center" 
                             style="height: 80px; width: 100px; border-radius: 6px;">
                            <i class="fas fa-file-pdf fa-2x text-danger"></i>
                        </div>
                        <button type="button" class="btn-close position-absolute top-0 end-0 bg-white rounded-circle p-1" 
                                style="transform: translate(30%, -30%);" 
                                onclick="document.getElementById('certificatePreview').innerHTML = ''; document.getElementById('certificate').value = '';">
                        </button>
                    </div>
                    <div class="ms-2 align-self-center">
                    </div>`;
                }
            }
        });

        function collectTrainingData() {
            const form = document.getElementById('trainingForm');
            const formData = new FormData(form);
            formData.set('id', document.getElementById('trainingId').value);
            if (isEditingTraining) formData.set('_method', 'PUT');
            return formData;
        }

        function resetTrainingForm() {
            document.getElementById('trainingForm').reset();
            document.getElementById('trainingId').value = '';
            document.getElementById('certificatePreview').innerHTML = '';
            isEditingTraining = false;
            currentTrainingId = null;
            document.getElementById('addTraining').textContent = '+ Add Training';
        }

        async function fetchTrainingData(id) {
            const res = await fetch(`/jobseeker/trainings/${id}/edit`);
            if (!res.ok) throw new Error('Failed to fetch training data');
            return res.json();
        }

        function populateTrainingForm(data) {
            document.getElementById('trainingId').value = data.id;
            document.getElementById('training-title').value = data.trainingTitle;
            document.getElementById('training-organization').value = data.institutionName;
            document.getElementById('training-date').value = data.completionDate;

            // Update the preview for existing certificate
            const preview = document.getElementById('certificatePreview');
            preview.innerHTML = '';

            if (data.certificate) {
                let url = data.certificate.startsWith('storage/') ? `/storage/${data.certificate.split('storage/')[1]}` : data.certificate;

                // Check if it's a PDF or image
                if (url.toLowerCase().endsWith('.pdf')) {
                    preview.innerHTML = `
                    <div class="position-relative" style="width: 100px;">
                        <div class="bg-light d-flex align-items-center justify-content-center" 
                             style="height: 80px; width: 100px; border-radius: 6px;">
                                <i class="fas fa-file-pdf fa-2x text-danger"></i>
                        </div>
                        <button type="button" class="btn-close position-absolute top-0 end-0 bg-white rounded-circle p-1" 
                                style="transform: translate(30%, -30%);" 
                                onclick="document.getElementById('certificatePreview').innerHTML = ''; document.getElementById('certificate').value = '';">
                        </button>
                    </div>
                    <div class="ms-2 align-self-center">
                    </div>`;
                } else {
                    preview.innerHTML = `
                    <div class="position-relative" style="width: 100px;">
                        <img src="${url}" 
                             style="height: 80px; width: 100px; border-radius: 6px; object-fit: cover;" 
                             class="img-thumbnail" />
                        <button type="button" class="btn-close position-absolute top-0 end-0 bg-white rounded-circle p-1" 
                                style="transform: translate(30%, -30%);" 
                                onclick="document.getElementById('certificatePreview').innerHTML = ''; document.getElementById('certificate').value = '';">
                        </button>
                    </div>
                    <div class="ms-2 align-self-center">
                    </div>`;
                }
            }

            isEditingTraining = true;
            currentTrainingId = data.id;
            document.getElementById('addTraining').textContent = 'Update Training';
        }

        async function saveTrainingData(formData) {
            const id = formData.get('id');
            const url = id ? `/jobseeker/trainings/${id}` : "{{ route('trainings.store') }}";
            const res = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData
            });
            if (!res.ok) throw new Error('Save failed');
            return res.json();
        }

        function appendTrainingCard(t) {
            const container = document.getElementById('trainingList');
            const card = document.createElement('div');
            card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
            card.id = `card_training_${t.id}`;
            card.innerHTML = `
            <div class="d-flex justify-content-between">
                <div><h5>${t.trainingTitle}</h5></div>
                <div>
                    <button type="button" class="btn fw-semibold edit-training" style="color: #0064A7;" data-id="${t.id}">Edit</button>
                    <button type="button" class="btn text-danger fw-semibold delete-training" data-id="${t.id}">Delete</button>
                </div>
            </div>
            <div class="text-black-50">
                <p class="m-0">${t.institutionName}</p>
                <p class="m-0">${new Date(t.completionDate).toLocaleDateString('en-US',{month:'short',year:'numeric'})}</p>
                   </div>`;
            container.appendChild(card);
        }

        function updateTrainingCard(t) {
            const card = document.getElementById(`card_training_${t.id}`);
            if (!card) return;
            card.innerHTML = `
            <div class="d-flex justify-content-between">
                <div><h5>${t.trainingTitle}</h5></div>
                <div>
                    <button type="button" class="btn fw-semibold edit-training" style="color: #0064A7;" data-id="${t.id}">Edit</button>
                    <button type="button" class="btn text-danger fw-semibold delete-training" data-id="${t.id}">Delete</button>
                </div>
            </div>
            <div class="text-black-50">
                <p class="m-0">${t.institutionName}</p>
                <p class="m-0">${new Date(t.completionDate).toLocaleDateString('en-US',{month:'short',year:'numeric'})}</p>
     </div>`;
        }

        document.getElementById('addTraining').addEventListener('click', async function(e) {
            e.preventDefault();
            const formData = collectTrainingData();
            try {
                const result = await saveTrainingData(formData);
                if (isEditingTraining) {
                    updateTrainingCard(result.training);
                } else {
                    appendTrainingCard(result.training);
                }
                resetTrainingForm();
            } catch (err) {
                console.error(err);
                console.error('something wents worng')
            }
        });

        document.getElementById('trainingList').addEventListener('click', async function(e) {
            const id = e.target.dataset.id;
            if (!id) return;

            if (e.target.classList.contains('edit-training')) {
                try {
                    const data = await fetchTrainingData(id);
                    populateTrainingForm(data);
                    document.getElementById('trainingForm').scrollIntoView({
                        behavior: 'smooth'
                    });
                } catch (err) {
                    console.error('something wents worng')
                }
            }

            if (e.target.classList.contains('delete-training')) {
                // Set the form action and ID
                document.getElementById('deleteTrainingId').value = id;
                document.getElementById('deleteTrainingForm').action = `/jobseeker/trainings/${id}`;

                // Show the modal
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteTrainingModal'));
                deleteModal.show();
            }
        });

        // Handle form submission for delete modal
        document.getElementById('deleteTrainingForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const id = document.getElementById('deleteTrainingId').value;
            const form = this;

            try {
                const res = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        _method: 'DELETE',
                        id: id
                    })
                });

                const json = await res.json();
                if (json.success) {
                    document.getElementById(`card_training_${id}`).remove();
                    if (currentTrainingId == parseInt(id)) resetTrainingForm();

                    // Hide the modal
                    const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteTrainingModal'));
                    deleteModal.hide();
                } else {
                    console.error('something wents worng')
                }
            } catch (error) {
                console.error('Delete error:', error);
                console.error('something wents worng')
            }
        });
    });
</script>
@endpush