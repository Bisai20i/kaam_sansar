<div id="visa" class="section-content" style="display:none;">
    <h4 class="mb-3 your-project-text">Visa</h4>
    <div class="card p-4 card-center">
        <form id="visaForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="visaId" min="1" max="24" step="0.001" name="id" value="">

            <h3>Visa Details</h3>
            <div class="row mb-3">
                <div class="col-md-12 mb-3">
                    <label for="visa-details" class="form-label">Visa Details <span class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" id="visa-details" name="visaDetails" placeholder=" Enter visa details" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="visa-expire" class="form-label">Visa Expiry <span class="text-danger">*</span></label>
                    <input type="date" class="form-control custom-input" id="visa-expire" name="visaExpire" placeholder="Enter visa Expire" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="visa-country" class="form-label">Country <span class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" id="visa-country" name="country" placeholder="Enter Country" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="visaImage" class="form-label fs-6">Visa Photo  <span class="text-danger">*</span></label><br>
                    <input type="file" class="form-control form-control-da fs-6 w-100" id="visaImage" name="visaImage" accept=".jpg,.jpeg,.png,.pdf" required>
                    <div id="visaPreview" class="d-flex mt-1"></div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <div class="text-end">
                    <button type="button" class="btn text-center skip-btn mx-2" data-current="visa" data-next="education" data-link="educationLink">skip</button>
                </div>
                <button type="button" class="btn add-project float-start" id="addVisa">+Add Visa</button>
            </div>
        </form>
    </div>

    <div class="container mt-4 p-0">
        <div id="visaList">
            @foreach($visas as $visa)
            <div class="card mb-3 mt-3 p-3 bg-light rounded w-100" id="card_visa_{{ $visa->id }}">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>{{ $visa->visaDetails ?? '' }}</h5>
                    </div>
                    <div>
                        <button type="button" class="btn fw-semibold edit-visa" style="color: #0064A7;" data-id="{{ $visa->id }}">Edit</button>
                        <button type="button" class="btn text-danger fw-semibold delete-visa" data-id="{{ $visa->id }}">Delete</button>
                    </div>
                </div>
                <div class="text-black-50">
                    <p class="m-0">Expiry: {{ \Carbon\Carbon::parse($visa->visaExpire ?? '')->format('M Y') }}</p>
                    <p class="m-0">Country: {{ $visa->country ?? '' }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Delete Modal for Visa -->
<div class="modal fade" id="deleteVisaModal" tabindex="-1" aria-labelledby="deleteVisaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="deleteVisaForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <input type="hidden" id="deleteVisaId" name="id" value="">
            <div class="modal-content p-4 rounded-4 border-0 shadow-lg text-center">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-3">
                    <div class="mx-auto rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                        <i class="bi bi-trash-fill text-danger fs-3"></i>
                    </div>
                </div>
                <h4 class="fw-bold">Are you sure?</h4>
                <p class="text-secondary mb-4">Are you sure you want to delete this Visa? This action cannot be undone.</p>
                <div class="d-flex justify-content-center align-items-center">
                    <button type="button" class="btn border-secondary-subtle rounded-3 px-4 py-2 col-6 me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger rounded-3 px-4 py-2 col-6 ms-1">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>


<style>
    .btn-close {
        opacity: 1;
        font-size: 0.7rem;
    }

    .btn-close:hover {
        opacity: 0.8;
    }

    .img-thumbnail {
        padding: 0;
        border: 1px solid #dee2e6;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let isEditingVisa = false;
        let currentVisaId = null;

        // Image preview for visa
        document.getElementById('visaImage').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('visaPreview');
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
                                    onclick="document.getElementById('visaPreview').innerHTML = ''; document.getElementById('visaImage').value = '';">
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
                                onclick="document.getElementById('visaPreview').innerHTML = ''; document.getElementById('visaImage').value = '';">
                        </button>
                    </div>
                    <div class="ms-2 align-self-center">
                    </div>`;
                }
            }
        });

        function collectVisaData() {
            const form = document.getElementById('visaForm');
            const formData = new FormData(form);
            formData.set('id', document.getElementById('visaId').value);
            if (isEditingVisa) formData.set('_method', 'PUT');
            return formData;
        }

        function resetVisaForm() {
            document.getElementById('visaForm').reset();
            document.getElementById('visaId').value = '';
            document.getElementById('visaPreview').innerHTML = '';
            isEditingVisa = false;
            currentVisaId = null;
            document.getElementById('addVisa').textContent = '+ Add Visa';
        }

        async function fetchVisaData(id) {
            const res = await fetch(`/jobseeker/visas/${id}/edit`);
            if (!res.ok) throw new Error('Failed to fetch visa data');
            return res.json();
        }

        function populateVisaForm(data) {
            document.getElementById('visaId').value = data.id;
            document.getElementById('visa-details').value = data.visaDetails;
            document.getElementById('visa-expire').value = data.visaExpire;
            document.getElementById('visa-country').value = data.country;

            // Update the preview for existing image
            const preview = document.getElementById('visaPreview');
            preview.innerHTML = '';

            if (data.visaImage) {
                let url = data.visaImage.startsWith('storage/') ? `/storage/${data.visaImage.split('storage/')[1]}` : data.visaImage;

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
                                onclick="document.getElementById('visaPreview').innerHTML = ''; document.getElementById('visaImage').value = '';">
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
                                onclick="document.getElementById('visaPreview').innerHTML = ''; document.getElementById('visaImage').value = '';">
                        </button>
                    </div>
                    <div class="ms-2 align-self-center">
                    </div>`;
                }
            }

            isEditingVisa = true;
            currentVisaId = data.id;
            document.getElementById('addVisa').textContent = 'Update Visa';
        }

        async function saveVisaData(formData) {
            const id = formData.get('id');
            const url = id ? `/jobseeker/visas/${id}` : "{{ route('visas.store') }}";
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

        function appendVisaCard(v) {
            const container = document.getElementById('visaList');
            const card = document.createElement('div');
            card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
            card.id = `card_visa_${v.id}`;
            card.innerHTML = `
            <div class="d-flex justify-content-between">
                <div><h5>${v.visaDetails}</h5></div>
                <div>
                    <button type="button" class="btn fw-semibold edit-visa" style="color: #0064A7;" data-id="${v.id}">Edit</button>
                    <button type="button" class="btn text-danger fw-semibold delete-visa" data-id="${v.id}">Delete</button>
                </div>
            </div>
            <div class="text-black-50">
                <p class="m-0">Expiry: ${new Date(v.visaExpire).toLocaleDateString('en-US',{month:'short',year:'numeric'})}</p>
                <p class="m-0">Country: ${v.country}</p>
                
            </div>`;
            container.appendChild(card);
        }

        function updateVisaCard(v) {
            const card = document.getElementById(`card_visa_${v.id}`);
            if (!card) return;
            card.innerHTML = `
            <div class="d-flex justify-content-between">
                <div><h5>${v.visaDetails}</h5></div>
                <div>
                    <button type="button" class="btn fw-semibold edit-visa" style="color: #0064A7;" data-id="${v.id}">Edit</button>
                    <button type="button" class="btn text-danger fw-semibold delete-visa" data-id="${v.id}">Delete</button>
                </div>
            </div>
            <div class="text-black-50">
                <p class="m-0">Expiry: ${new Date(v.visaExpire).toLocaleDateString('en-US',{month:'short',year:'numeric'})}</p>
                <p class="m-0">Country: ${v.country}</p>
            </div>`;
        }

        document.getElementById('addVisa').addEventListener('click', async function(e) {
            e.preventDefault();
            const formData = collectVisaData();
            try {
                const result = await saveVisaData(formData);
                if (isEditingVisa) {
                    updateVisaCard(result.visa);
                } else {
                    appendVisaCard(result.visa);
                }
                resetVisaForm();
            } catch (err) {
                console.error(err);
                console.error('something wents worng')
            }
        });

        document.getElementById('visaList').addEventListener('click', async function(e) {
            const id = e.target.dataset.id;
            if (!id) return;

            if (e.target.classList.contains('edit-visa')) {
                try {
                    const data = await fetchVisaData(id);
                    populateVisaForm(data);
                    document.getElementById('visaForm').scrollIntoView({
                        behavior: 'smooth'
                    });
                } catch (err) {
                    console.error('something wents worng')
                }
            }

            if (e.target.classList.contains('delete-visa')) {
                // Set the form action and ID
                document.getElementById('deleteVisaId').value = id;
                document.getElementById('deleteVisaForm').action = `/jobseeker/visas/${id}`;

                // Show the modal
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteVisaModal'));
                deleteModal.show();
            }
        });

        // Handle form submission for delete modal
        document.getElementById('deleteVisaForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const id = document.getElementById('deleteVisaId').value;
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
                    document.getElementById(`card_visa_${id}`).remove();
                    if (currentVisaId == parseInt(id)) resetVisaForm();

                    // Hide the modal
                    const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteVisaModal'));
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