<div id="education" class="section-content" style="display: none;">
    <h4 class="mb-3 your-project-text">Your Education</h4>
    <div class="card p-4 card-center">
        <form id="educationForm">
            @csrf
            <h3>School/Institution</h3>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="schoolName" class="form-label">School Name</label>
                    <input type="text" class="form-control custom-input" id="schoolName" name="schoolName"
                        placeholder="California University" required />
                    @error('schoolName')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="degree" class="form-label">Degree <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" id="degree" name="degree"
                        placeholder="Bachelor" required />
                    @error('degree')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="city" class="form-label">City <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" id="city" name="city"
                        placeholder="Pokhara" required />
                    @error('city')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="startDate" class="form-label">Start Date <span
                            class="text-danger">*</span></label>
                    <input type="date" class="form-control custom-input" id="startDate" name="startDate"
                        placeholder="yy-mm-dd" required />
                    @error('startDate')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="gradDate" class="form-label">Graduation Date <span
                            class="text-danger">*</span></label>
                    <input type="date" class="form-control custom-input" id="graduationDate" name="graduationDate"
                        placeholder="yy-mm-dd" required />
                    @error('graduationDate')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div id="hiddenEducationInputs"></div>
            <div class="row mb-3">
                <div class="col-12">
                    <label for="summary" class="form-label">Summary <span
                            class="text-danger">*</span></label>
                    <textarea class="form-control custom-input" id="educationDescription" rows="3" name="educationDescription"
                        placeholder="Give a summary of your education..." required>
                                            </textarea>
                </div>
            </div>
            <!-- Change button types to prevent default form submission -->
            <button type="button" class="btn add-project float-start" id="addEducation">
                + Add Education
            </button>
            <div class="text-end ">
                <button type="submit" class="btn text-center skip-btn mx-2" data-current="education" data-next="project" data-link="projectLink">Skip</button>
                <button type="button" class="btn text-center next-btn" id="submitEducation">Save & Continue</button>
            </div>
    </div>
    <div class="container mt-4 p-0">
        <div id="educationList"></div>
        @if($educations->isNotEmpty())
        @foreach($educations as $education)
        <div class="card mb-3 mt-3 p-3 bg-light rounded w-100">
            <div class="d-flex justify-content-between">
                <div>
                    <h5>{{ $education->degree }}</h5>
                </div>
                <div>
                    <a href="{{ route('educations.edit', $education->id) }}"
                        class="btn fw-semibold"
                        style="color: #0064A7;">
                        Edit
                    </a>
                    <form action="{{ route('educations.destroy', $education->id) }}"
                        method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="btn text-danger fw-semibold">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="text-black-50">
                <p class="m-0">
                    {{ $education->schoolName }} – {{ $education->city }}
                </p>
                <p class="m-0">
                    {{ \Carbon\Carbon::parse($education->startDate)->format('M Y') }}
                    –
                    {{ \Carbon\Carbon::parse($education->graduationDate)->format('M Y') }}
                </p>
                <p class="m-0">
                    {{ $education->educationDescription }}
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
        function collectEducationData() {
            return {
                schoolName: document.getElementsByName('schoolName')[0].value,
                degree: document.getElementsByName('degree')[0].value,
                city: document.getElementsByName('city')[0].value,
                startDate: document.getElementsByName('startDate')[0].value,
                graduationDate: document.getElementsByName('graduationDate')[0].value,
                educationDescription: document.getElementsByName('educationDescription')[0].value
            };
        }

        async function saveEducationData(educationData) {
            try {
                const response = await fetch("{{ route('educations.store') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(educationData)
                });
                return await response.json();
            } catch (error) {
                console.error("Error saving data:", error);
                return {
                    success: false
                };
            }
        }

        function formatDate(dateStr) {
            const date = new Date(dateStr);
            const options = {
                year: 'numeric',
                month: 'short'
            };
            return date.toLocaleDateString('en-US', options);
        }

        function appendEducationCard(education) {
            const card = document.createElement('div');
            card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
            card.innerHTML = `
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5>${education.degree}</h5>
                                </div>
                                <div>
                                    <a href="/educations/${education.id}/edit" class="btn fw-semibold" style="color: #0064A7;">Edit</a>
                                    <form action="/educations/${education.id}" method="POST" style="display:inline;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn text-danger fw-semibold">Delete</button>
                                    </form>
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

        document.getElementById('educationForm').addEventListener('submit', function(e) {
            e.preventDefault();
        });

        document.getElementById('addEducation').addEventListener('click', async function(e) {
            e.preventDefault();
            const educationData = collectEducationData();
            const result = await saveEducationData(educationData);
            if (result.success) {
                document.getElementById('educationForm').reset();
                appendEducationCard(result.education);
            }
        });

        document.getElementById('submitEducation').addEventListener('click', async function(e) {
            e.preventDefault();
            const educationData = collectEducationData();
            const result = await saveEducationData(educationData);
            if (result.success) {
                appendEducationCard(result.education);
                document.getElementById('education').style.display = 'none';
                document.getElementById('project').style.display = 'block';
                document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                document.getElementById('projectLink').classList.add('active');
            }
        });

    })
</script>  
@endpush