<div id="language" class="section-content" style="display:none;">
    <h4 class="mb-3 your-project-text">Language Proficiency</h4>
    <div class="card p-3">
        <form id="languageForm">
            @csrf
            <h3>Language</h3>
            <div class="row mb-3">
                <div class="col-md-12">
                    <input type="hidden" id="languageId" name="id" value="">
                    <div class="input-group">
                        <input type="text" class="form-control custom-input border-end-0"
                            id="languageName" placeholder="Language" name="languageName" required>

                        <select class="form-select custom-input border-start-0 text-end me-3"
                            id="languageProficiency" name="languageProficiency">
                            <option>Beginner</option>
                            <option>Intermediate</option>
                            <option>Proficient</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="button" class="btn add-project float-start" id="addLanguage">
                + Add Language
            </button>
            <div class="text-end">
                <button type="button" class="btn text-center next-btn" id="submitLanguage">Submit Resume</button>
            </div>
        </form>
    </div>
    <div class="container mt-4 p-0">
        <div id="languageList">
            @if($languages->isNotEmpty())
            @foreach($languages as $language)
            <div class="card mb-3 mt-3 p-3 bg-light rounded w-100" id="card_id_{{ $language->id }}">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>{{ $language->languageName }}</h5>
                    </div>
                    <div>
                        <button type="button"
                            class="btn fw-semibold edit-language"
                            style="color: #0064A7;"
                            data-id="{{ $language->id }}">
                            Edit
                        </button>
                        <button type="button" class="btn text-danger fw-semibold delete-language" data-id="{{ $language->id }}">Delete</button>
                    </div>
                </div>
                <div class="text-black-50">
                    <p class="m-0">
                        Proficiency: {{ $language->languageProficiency }}
                    </p>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let isEditing = false;
        let currentLanguageId = null;

        function collectLanguageData() {
            return {
                id: document.getElementById('languageId').value,
                languageName: document.getElementById('languageName').value,
                languageProficiency: document.getElementById('languageProficiency').value
            };
        }

        function resetForm() {
            document.getElementById('languageForm').reset();
            document.getElementById('languageId').value = '';
            isEditing = false;
            currentLanguageId = null;
            document.getElementById('addLanguage').textContent = '+ Add Language';
        }

        async function fetchLanguageData(id) {
            const res = await fetch(`/jobseeker/languages/${id}/edit`);
            if (!res.ok) throw new Error('Failed to fetch language');
            return await res.json();
        }

        function populateForm(lang) {
            document.getElementById('languageId').value = lang.id;
            document.getElementById('languageName').value = lang.languageName;
            document.getElementById('languageProficiency').value = lang.languageProficiency;
            isEditing = true;
            currentLanguageId = lang.id;
            document.getElementById('addLanguage').textContent = 'Update Language';
        }

        async function saveLanguageData(data) {
            const url = data.id ?
                `/jobseeker/languages/${data.id}` :
                `/jobseeker/languages`;
            const method = data.id ? 'PUT' : 'POST';

            const res = await fetch(url, {
                method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            return res.ok ? await res.json() : {
                success: false
            };
        }

        async function deleteLanguageData(id) {
            const res = await fetch(`/jobseeker/languages/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    request_type: 'mobile'
                })
            });
            if (!res.ok) throw new Error('Failed to delete language');
            return await res.json();
        }

        function appendLanguageCard(lang) {
            const card = document.createElement('div');
            card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
            card.id = `card_id_${lang.id}`;
            card.innerHTML = `
                        <div class="d-flex justify-content-between">
                            <div><h5>${lang.languageName}</h5></div>
                            <div>
                            <button type="button" class="btn fw-semibold edit-language" style="color:#0064A7" data-id="${lang.id}">Edit</button>
                            <button type="button" class="btn text-danger fw-semibold delete-language" data-id="${lang.id}">Delete</button>
                            </div>
                        </div>
                        <div class="text-black-50">
                            <p class="m-0">Proficiency: ${lang.languageProficiency}</p>
                        </div>`;
            document.getElementById('languageList').appendChild(card);
        }

        function updateLanguageCard(lang) {
            const card = document.getElementById(`card_id_${lang.id}`);
            if (!card) return;
            card.innerHTML = `
                <div class="d-flex justify-content-between">
                    <div><h5>${lang.languageName}</h5></div>
                    <div>
                    <button type="button" class="btn fw-semibold edit-language" style="color:#0064A7" data-id="${lang.id}">Edit</button>
                    <button type="button" class="btn text-danger fw-semibold delete-language" data-id="${lang.id}">Delete</button>
                    </div>
                </div>
                <div class="text-black-50">
                    <p class="m-0">Proficiency: ${lang.languageProficiency}</p>
                </div>`;
        }

        // Add or Update
        document.getElementById('addLanguage').addEventListener('click', async function(e) {
            e.preventDefault();
            const data = collectLanguageData();
            if (!data.languageName) {
                return alert('Please enter a language');
            }
            const result = await saveLanguageData(data);
            if (result.success) {
                if (isEditing) {
                    updateLanguageCard(result.language);
                } else {
                    appendLanguageCard(result.language);
                }
                resetForm();
            } else {
                alert('Error saving language');
            }
        });

        // Edit & Delete
        document.getElementById('languageList').addEventListener('click', function(e) {
            const btn = e.target;
            const id = btn.dataset.id;

            if (btn.classList.contains('edit-language')) {
                e.preventDefault();
                fetchLanguageData(id)
                    .then(populateForm)
                    .catch(err => alert('Error fetching language: ' + err.message));
            }

            if (btn.classList.contains('delete-language')) {
                e.preventDefault();
                if (!confirm('Delete this language?')) return;

                deleteLanguageData(id)
                    .then(result => {
                        if (result.status) {
                            document.getElementById(`card_id_${id}`).remove();
                            if (currentLanguageId === parseInt(id)) {
                                resetForm();
                            }
                        }
                    })
                    .catch(error => {
                        alert('Error deleting language: ' + error.message);
                    });
            }
        });
    });
</script>
@endpush