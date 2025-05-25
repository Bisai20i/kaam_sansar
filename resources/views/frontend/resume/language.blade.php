<div id="language" class="section-content" style="display:none;">
    <h4 class="mb-3 your-project-text">Language Proficiency</h4>
    <div class="card p-4 card-center">
        <form id="languageForm">
            @csrf
            <input type="hidden" id="languageId" name="id" value="">
            <h3>Language</h3>
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" class="form-control rounded custom-input border-end-0" id="languageName" name="languageName" placeholder="Language" required>
                        <select class="form-select custom-input border-start-0 text-end text-center me-1" id="languageProficiency" name="languageProficiency" required>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Proficient">Proficient</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" class="btn add-project float-start" id="addLanguage">+ Add Language</button>
                <div class="text-end">
                    <button type="button" class="btn text-center skip-btn mx-2" data-current="language" data-next="certification" data-link="certificationLink">Skip</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-4 p-0">
        <div id="languageList">
            @foreach($languages as $language)
            <div class="card mb-3 mt-3 p-3 bg-light rounded w-100" id="language_card_{{ $language->id }}">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>{{ $language->languageName }}</h5>
                    </div>
                    <div>
                        <button type="button" class="btn fw-semibold edit-language" style="color: #0064A7;" data-id="{{ $language->id }}">Edit</button>
                        <button type="button" class="btn text-danger fw-semibold delete-language" data-id="{{ $language->id }}" data-bs-toggle="modal" data-bs-target="#deleteLanguageModal">Delete</button>
                    </div>
                </div>
                <div class="text-black-50">
                    <p class="m-0">Proficiency: {{ $language->languageProficiency }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Delete Language Modal -->
<div class="modal fade" id="deleteLanguageModal" tabindex="-1" aria-labelledby="deleteLanguageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="deleteLanguageForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <input type="hidden" id="deleteLanguageId" name="id" value="">
            <div class="modal-content p-4 rounded-4 border-0 shadow-lg text-center">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-3">
                    <div class="mx-auto rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                        <i class="bi bi-trash-fill text-danger fs-3"></i>
                    </div>
                </div>
                <h4 class="fw-bold">Are you sure?</h4>
                <p class="text-secondary mb-4">Are you sure you want to delete this Language? This action cannot be undone.</p>
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
        let isEditingLanguage = false;
        let currentLanguageId = null;

        function collectLanguageData() {
            return {
                id: document.getElementById('languageId').value,
                languageName: document.getElementById('languageName').value,
                languageProficiency: document.getElementById('languageProficiency').value
            };
        }

        function resetLanguageForm() {
            document.getElementById('languageForm').reset();
            document.getElementById('languageId').value = '';
            isEditingLanguage = false;
            currentLanguageId = null;
            document.getElementById('addLanguage').textContent = '+ Add Language';
        }

        async function fetchLanguageData(id) {
            const response = await fetch(`/jobseeker/languages/${id}/edit`);
            if (!response.ok) throw new Error('Failed to fetch language data');
            return await response.json();
        }

        function populateLanguageForm(data) {
            document.getElementById('languageId').value = data.id;
            document.getElementById('languageName').value = data.languageName;
            document.getElementById('languageProficiency').value = data.languageProficiency;

            isEditingLanguage = true;
            currentLanguageId = data.id;
            document.getElementById('addLanguage').textContent = 'Update Language';
        }

        async function saveLanguageData(data) {
            const url = data.id ? `/jobseeker/languages/${data.id}` : "{{ route('languages.store') }}";
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

            if (!response.ok) throw new Error(await response.text());
            return await response.json();
        }

        function appendLanguageCard(data) {
            const card = document.createElement('div');
            card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
            card.id = `language_card_${data.id}`;
            card.innerHTML = `
            <div class="d-flex justify-content-between">
                <div><h5>${data.languageName}</h5></div>
                <div>
                    <button type="button" class="btn fw-semibold edit-language" style="color: #0064A7;" data-id="${data.id}">Edit</button>
                    <button type="button" class="btn text-danger fw-semibold delete-language" data-id="${data.id}" data-bs-toggle="modal" data-bs-target="#deleteLanguageModal">Delete</button>
                </div>
            </div>
            <div class="text-black-50">
                <p class="m-0">Proficiency: ${data.languageProficiency}</p>
            </div>`;
            document.getElementById('languageList').appendChild(card);
        }

        function updateLanguageCard(data) {
            const card = document.getElementById(`language_card_${data.id}`);
            if (card) {
                card.innerHTML = `
                <div class="d-flex justify-content-between">
                    <div><h5>${data.languageName}</h5></div>
                    <div>
                        <button type="button" class="btn fw-semibold edit-language" style="color: #0064A7;" data-id="${data.id}">Edit</button>
                        <button type="button" class="btn text-danger fw-semibold delete-language" data-id="${data.id}" data-bs-toggle="modal" data-bs-target="#deleteLanguageModal">Delete</button>
                    </div>
                </div>
                <div class="text-black-50">
                    <p class="m-0">Proficiency: ${data.languageProficiency}</p>
                </div>`;
            }
        }

        // Handle delete modal opening
        document.getElementById('languageList').addEventListener('click', function(e) {
            if (e.target.classList.contains('delete-language')) {
                const languageId = e.target.getAttribute('data-id');
                document.getElementById('deleteLanguageId').value = languageId;
                document.getElementById('deleteLanguageForm').action = `/jobseeker/languages/${languageId}`;
            }
        });

        // Handle form submission for delete
        document.getElementById('deleteLanguageForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const form = e.target;
            const languageId = document.getElementById('deleteLanguageId').value;

            try {
                const response = await fetch(form.action, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: languageId
                    })
                });

                if (!response.ok) throw new Error('Failed to delete language');

                const result = await response.json();
                if (result.success) {
                    document.getElementById(`language_card_${languageId}`).remove();
                    if (currentLanguageId === parseInt(languageId)) {
                        resetLanguageForm();
                    }
                    // Hide the modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('deleteLanguageModal'));
                    modal.hide();
                }
            } catch (error) {
                console.error(error);
                alert('Error deleting language');
            }
        });

        document.getElementById('addLanguage').addEventListener('click', async function(e) {
            e.preventDefault();
            const data = collectLanguageData();

            if (!data.languageName || !data.languageProficiency) {
                alert('Please fill all required fields');
                return;
            }

            try {
                const result = await saveLanguageData(data);
                if (result.success) {
                    if (isEditingLanguage) {
                        updateLanguageCard(result.language);
                    } else {
                        appendLanguageCard(result.language);
                    }
                    resetLanguageForm();
                }
            } catch (error) {
                console.error(error);
                alert('Error saving language');
            }
        });

        document.getElementById('languageList').addEventListener('click', function(e) {
            if (e.target.classList.contains('edit-language')) {
                e.preventDefault();
                const id = e.target.dataset.id;
                fetchLanguageData(id)
                    .then(data => {
                        populateLanguageForm(data);
                        document.getElementById('languageForm').scrollIntoView({
                            behavior: 'smooth'
                        });
                    })
                    .catch(err => alert('Error loading data: ' + err.message));
            }
        });
    });
</script>
@endpush