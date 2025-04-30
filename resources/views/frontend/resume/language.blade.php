<div id="language" class="section-content" style="display:none;">
    <h4 class="mb-3 your-project-text">Language Proficiency</h4>
    <div class="card p-3">
        <form id="languageForm">
            @csrf
            <h3>Language</h3>
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" class="form-control custom-input border-end-0"
                            id="Language" placeholder="Language" name="languageName" required>

                        <select class="form-select custom-input border-start-0 text-end me-3"
                            id="languageLevel" name="languageProficiency">
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
                <button type="submit" class="btn text-center skip-btn mx-2">Skip</button>
                <button type="button" class="btn text-center next-btn" id="submitLanguage">Save & Continue</button>
            </div>
        </form>
    </div>
    <div class="container mt-4 p-0">
        <div class="languageList"></div>
        @if($languages->isNotEmpty())
        @foreach($languages as $language)
        <div class="card mb-3 mt-3 p-3 bg-light rounded w-100">
            <div class="d-flex justify-content-between">
                <div>
                    <h5>{{ $language->languageName }}</h5>
                </div>
                <div>
                    <a href="{{ route('languages.edit', $language->id) }}" class="btn fw-semibold" style="color: #0064A7;">
                        Edit
                    </a>
                    <form action="{{ route('languages.destroy', $language->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn text-danger fw-semibold">
                            Delete
                        </button>
                    </form>
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
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function collectLanguageData() {
                return {
                    languageName: document.getElementsByName('languageName')[0].value,
                    languageProficiency: document.getElementsByName('languageProficiency')[0].value
                };
            }

            async function saveLanguageData(languageData) {
                try {
                    const response = await fetch("{{ route('languages.store') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(languageData)
                    });
                    return await response.json();
                } catch (error) {
                    console.error("Error saving language data:", error);
                    return {
                        success: false
                    };
                }
            }

            function appendLanguageCard(language) {
                const card = document.createElement('div');
                card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
                card.innerHTML = `
            <div class="d-flex justify-content-between">
                <div>
                    <h5>${language.languageName}</h5>
                </div>
                <div>
                    <a href="/languages/${language.id}/edit" class="btn fw-semibold" style="color: #0064A7;">Edit</a>
                    <form action="/languages/${language.id}" method="POST" style="display:inline;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn text-danger fw-semibold">Delete</button>
                    </form>
                </div>
            </div>
            <div class="text-black-50">
                <p class="m-0">Proficiency: ${language.languageProficiency}</p>
            </div>
        `;
                document.querySelector('.languageList').appendChild(card);
            }

            // Prevent default form submit
            document.getElementById('languageForm').addEventListener('submit', function(e) {
                e.preventDefault();
            });

            // "+ Add Language" button
            document.getElementById('addLanguage').addEventListener('click', async function(e) {
                e.preventDefault();
                const languageData = collectLanguageData();
                const result = await saveLanguageData(languageData);
                if (result.success) {
                    document.getElementById('languageForm').reset();
                    appendLanguageCard(result.language);
                }
            });

            // "Save & Continue" button
            document.getElementById('submitLanguage').addEventListener('click', async function(e) {
                e.preventDefault();
                const languageData = collectLanguageData();
                const result = await saveLanguageData(languageData);
                if (result.success) {
                    appendLanguageCard(result.language);
                    document.getElementById('language').style.display = 'none';
                    document.getElementById('training').style.display = 'block'; // 👈 update this if next section is different
                    document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                    document.getElementById('trainingLink').classList.add('active'); // 👈 update ID as per your nav
                }
            });
        })
    </script>  
    @endpush
   