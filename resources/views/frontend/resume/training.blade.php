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
                    <input type="text" class="form-control custom-input" id="training-title" name="trainingTitle" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="training-organization" class="form-label">Institution/Organization <span class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" id="training-organization" name="institutionName" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="training-date" class="form-label">Completion Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control custom-input" id="training-date" name="completionDate" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="d-flex align-items-center gap-3">
                    <p class="flex-grow-1 my-auto text-black-50 mb-0" style="font-size: 0.9rem;">Upload Training Certificate</p>
                    <div class="d-flex align-items-center gap-2">
                        <label for="certificate" class="primary_color_text m-0" style="cursor: pointer;">
                            <i class="fa-solid fa-image fa-lg"></i>
                        </label>
                        <input type="file" id="certificate" accept="image/*" class="d-none form-control custom-input" name="certificate">
                    </div>
                </div>
                <div id="imgPreview" class="d-flex mt-1" style="height: 80px;"></div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" class="btn add-project float-start" id="addTraining">+ Add Training</button>
                <div class="text-end">
                    <button type="button" class="btn text-center skip-btn mx-2" data-current="training" data-next="language" data-link="languageLink">Continue to training</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Existing Training List -->
    <div class="container mt-4 p-0">
        <div id="trainingList">
            @foreach($trainings as $training)
            <div class="card mb-3 mt-3 p-3 bg-light rounded w-100" id="card_id_{{ $training->id }}">
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
                    <p class="m-0"><a href="{{ asset($training->certificate) }}" target="_blank">View certificate</a></p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let isEditing = false;
        let currentTrainingId = null;

        document.getElementById('certificate').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('imgPreview');
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    preview.innerHTML = `<img src="${evt.target.result}" style="height:100%; width:30%; border-radius:6px; object-fit:cover;" />`;
                };
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = '';
            }
        });

        function collectTrainingData() {
            const form = document.getElementById('trainingForm');
            const formData = new FormData(form);
            formData.set('id', document.getElementById('trainingId').value);
            if (isEditing) {
                formData.set('_method', 'PUT');
            }
            return formData;
        }

        function resetForm() {
            document.getElementById('trainingForm').reset();
            document.getElementById('trainingId').value = '';
            document.getElementById('imgPreview').innerHTML = '';
            isEditing = false;
            currentTrainingId = null;
            document.getElementById('addTraining').textContent = '+ Add Training';
        }

        async function fetchTrainingData(id) {
            try {
                const response = await fetch(`/jobseeker/trainings/${id}/edit`);
                if (!response.ok) {
                    throw new Error('Failed to fetch education data');
                }
                return await response.json();
            } catch (error) {
                console.error('Error:', error);
                throw error;
            }
        }

        function populateForm(data) {
            document.getElementById('trainingId').value = data.id;
            document.getElementById('training-title').value = data.trainingTitle;
            document.getElementById('training-organization').value = data.institutionName;
            document.getElementById('training-date').value = data.completionDate;
            if (data.certificate) {
                let imageUrl = data.certificate;
                if (imageUrl.startsWith('storage/')) {
                    imageUrl = `/storage/${imageUrl.split('storage/')[1]}`;
                }
                document.getElementById('imgPreview').innerHTML = `
            <img src="${imageUrl}" 
                 style="height:100%; width:30%; border-radius:6px; object-fit:cover;"
                 onerror="this.style.display='none'"
            />`;
            } else {
                document.getElementById('imgPreview').innerHTML = '';
            }
            isEditing = true;
            currentTrainingId = data.id;
            document.getElementById('addTraining').textContent = 'Update Training';
        }

        async function saveTrainingData(formData) {
            const id = formData.get('id');
            const url = id ? `/jobseeker/trainings/${id}` : "{{ route('trainings.store') }}";
            const method = id ? 'POST' : 'POST'; // always POST when using FormData, use _method for PUT

            const response = await fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData
            });

            if (!response.ok) {
                const text = await response.text();
                console.error(text);
                return {
                    success: false
                };
            }

            return await response.json();
        }



        function appendTrainingCard(t) {
            const container = document.getElementById('trainingList');
            const card = document.createElement('div');
            card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
            card.id = `card_id_${t.id}`;
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
                ${t.certificate ? `<p class="m-0"><a href="${t.certificate}" target="_blank">View certificate</a></p>` : ''}
            </div>`;
            container.appendChild(card);
        }

        function updateTrainingCard(t) {
            const card = document.getElementById(`card_id_${t.id}`);
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
                ${t.certificate ? `<p class="m-0"><a href="${t.certificate}" target="_blank">View certificate</a></p>` : ''}
            </div>`;
        }

        document.getElementById('addTraining').addEventListener('click', async function(e) {
            e.preventDefault();
            const formData = collectTrainingData();
            if (!formData.get('trainingTitle') || !formData.get('institutionName') || !formData.get('completionDate')) {
                alert('Please fill all required fields');
                return;
            }
            const result = await saveTrainingData(formData);
            if (result.success) {
                if (isEditing) {
                    updateTrainingCard(result.training);
                    alert('Training updated successfully!');
                } else {
                    appendTrainingCard(result.training);
                }
                resetForm();
            } else {
                alert('Error saving training');
            }
        });

        document.getElementById('trainingList').addEventListener('click', async function(e) {
            const id = e.target.dataset.id;
            if (e.target.classList.contains('edit-training')) {
                try {
                    const data = await fetchTrainingData(id);
                    populateForm(data);
                    document.getElementById('trainingForm').scrollIntoView({
                        behavior: 'smooth'
                    });
                } catch (err) {
                    alert('Error fetching training: ' + err.message);
                }
            }

            if (e.target.classList.contains('delete-training')) {
                if (!confirm('Delete this training?')) return;
                const res = await fetch(`/jobseeker/trainings/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        _method: 'DELETE'
                    })
                });

                const json = await res.json();
                if (json.success || json.status) {
                    document.getElementById(`card_id_${id}`).remove();
                    alert('Training deleted successfully!');
                    if (currentTrainingId == parseInt(id)) resetForm();
                } else {
                    alert('Error deleting training');
                }
            }
        });

        document.getElementById('submitTraining').addEventListener('click', () => {
            document.getElementById('trainingForm').dispatchEvent(new Event('submit'));
        });
    });
</script>
@endpush