<div id="visa" class="section-content" style="display:none;">
    <h4 class="mb-3 your-project-text">Visa</h4>
    <div class="card p-4 card-center">
        <form id="visaForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="visaId" name="id" value="">

            <h3>Visa Details</h3>
            <div class="row mb-3">
                <div class="col-md-12 mb-3">
                    <label for="visa-details" class="form-label">Visa Details <span class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" id="visa-details" name="visaDetails" placeholder="California University" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="visa-expire" class="form-label">Visa Expiry <span class="text-danger">*</span></label>
                    <input type="date" class="form-control custom-input" id="visa-expire" name="visaExpire" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="visa-country" class="form-label">Country <span class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" id="visa-country" name="country" placeholder="Pokhara" required>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <p class="flex-grow-1 my-auto text-black-50 mb-0" style="font-size: 0.9rem;">Upload Visa Photo</p>
                        <div class="d-flex align-items-center gap-2">
                            <label for="visa-file" class="primary_color_text m-0" style="cursor: pointer;">
                                <i class="fa-solid fa-image fa-lg"></i>
                            </label>
                            <input type="file" id="visa-file" accept="image/*" class="d-none form-control custom-input" name="visaImage">
                        </div>
                    </div>
                    <div id="visaPreview" class="d-flex mt-1" style="height: 80px;"></div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" class="btn add-project float-start" id="addVisa">+ Add Visa</button>
                <div class="text-end">
                    <button type="button" class="btn text-center skip-btn mx-2" data-current="visa" data-next="education" data-link="educationLink">Continue to Education</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-4 p-0">
        <div id="visaList">
        @foreach($visas as $visa)
        <div class="card mb-3 mt-3 p-3 bg-light rounded w-100" id="card_visa_{{ $visa->id }}">
                <div class="d-flex justify-content-between">
                    <div><h5>{{ $visa->visaDetails ?? '' }}</h5></div>
                    <div>
                        <button type="button" class="btn fw-semibold edit-visa" style="color: #0064A7;" data-id="{{ $visa->id }}">Edit</button>
                        <button type="button" class="btn text-danger fw-semibold delete-visa" data-id="{{ $visa->id }}">Delete</button>
                    </div>
                </div>
                <div class="text-black-50">
                    <p class="m-0">Expiry: {{ \Carbon\Carbon::parse($visa->visaExpire ?? '')->format('M Y') }}</p>
                    <p class="m-0">Country: {{ $visa->country ?? '' }}</p>
                    @if($visa->visaImage ?? '')
                    <p class="m-0"><a href="{{ asset($visa->visaImage ?? '') }}" target="_blank">View Visa Photo</a></p>
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
        let isEditingVisa = false;
        let currentVisaId = null;

        // Image preview
        document.getElementById('visa-file').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('visaPreview');
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
            if (data.visaImage) {
                let url = data.visaImage.startsWith('storage/') ? `/storage/${data.visaImage.split('storage/')[1]}` : data.visaImage;
                document.getElementById('visaPreview').innerHTML = `
                    <img src="${url}" style="height:100%; width:30%; border-radius:6px; object-fit:cover;" onerror="this.style.display='none'" />`;
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
                    ${v.visaImage ? `<p class="m-0"><a href="${v.visaImage}" target="_blank">View Visa Photo</a></p>` : ''}
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
                    ${v.visaImage ? `<p class="m-0"><a href="${v.visaImage}" target="_blank">View Visa Photo</a></p>` : ''}
                </div>`;
        }

        document.getElementById('addVisa').addEventListener('click', async function(e) {
            e.preventDefault();
            const formData = collectVisaData();
            console.log(collectVisaData());
            if (!formData.get('visaDetails') || !formData.get('visaExpire') || !formData.get('country')) {
                alert('Please fill all required fields');
                return;
            }
            try {
                const result = await saveVisaData(formData);
                if (isEditingVisa) {
                    updateVisaCard(result.visa);
                    alert('Visa updated successfully!');
                } else {
                    appendVisaCard(result.visa);
                }
                resetVisaForm();
            } catch (err) {
                console.error(err);
                alert('Error saving visa');
            }
        });

        document.getElementById('visaList').addEventListener('click', async function(e) {
            const id = e.target.dataset.id;
            if (!id) return;

            if (e.target.classList.contains('edit-visa')) {
                try {
                    const data = await fetchVisaData(id);
                    populateVisaForm(data);
                    document.getElementById('visaForm').scrollIntoView({ behavior: 'smooth' });
                } catch (err) {
                    alert('Error fetching visa data');
                }
            }

            if (e.target.classList.contains('delete-visa')) {
                if (!confirm('Delete this visa?')) return;
                try {
                    const res = await fetch(`/jobseeker/visas/${id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ _method: 'DELETE' })
                    });
                    const json = await res.json();
                    if (json.success) {
                        document.getElementById(`card_visa_${id}`).remove();
                        if (currentVisaId == parseInt(id)) resetVisaForm();
                    } else {
                        alert('Error deleting visa');
                    }
                } catch (error) {
                    console.error('Delete error:', error);
                    alert('Error deleting visa');
                }
            }
        });
    });
</script>
@endpush
