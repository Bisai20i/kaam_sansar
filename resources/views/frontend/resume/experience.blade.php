<div id="experience" class="section-content" style="display:none;">
    <h4 class="mb-3 your-project-text">Your Experiences</h4>
    <div class="card p-3">
        <form id="experienceForm">
            @csrf
            <h3>Job Title</h3>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="experience-job-title" class="form-label">Job Title</label>
                    <input type="text" class="form-control custom-input"
                        id="experience-job-title" name="jobTitle" placeholder="Software Engineer" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="experience-company-name" class="form-label">Company
                        Name</label>
                    <input type="text" class="form-control custom-input" name="companyName"
                        id="experience-company-name" placeholder="Google Inc." required>
                </div>
                <div class="col-md-6">
                    <label for="experience-location" class="form-label">Location</label>
                    <input type="text" class="form-control custom-input" name="location"
                        id="experience-location" placeholder="San Francisco, CA" required>
                </div>
                <div class="col-md-6">
                    <label for="experience-start-date" class="form-label">startDate</label>
                    <input type="date" class="form-control custom-input" name="startDate"
                        id="experience-start-date" required>
                </div>
                <div class="col-md-6">
                    <label for="experience-end-date" class="form-label">End Date</label>
                    <input type="date" class="form-control custom-input" name="endDate"
                        id="experience-end-date" required>
                </div>
                <div class="col-md-12">
                    <label for="experience-description" class="form-label">Description</label>
                    <textarea class="form-control custom-input" id="experience-description" name="experienceDescription" rows="3"
                        placeholder="Describe your job role and achievements..." required> </textarea>
                </div>

                <div>
                    <p>Optional <span class="custom-orange">(It will not be shown on your
                            resume):</span></p>

                    <!-- Salary Rating -->
                    <div>
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="mb-0">How do you rate the salary pay?</label>
                            <div class="rating">
                                <input type="radio" id="salary-5" name="salaryRating" value="5"><label
                                    for="salary-5">&#9733;</label>
                                <input type="radio" id="salary-4" name="salaryRating" value="4"><label
                                    for="salary-4">&#9733;</label>
                                <input type="radio" id="salary-3" name="salaryRating" value="3"><label
                                    for="salary-3">&#9733;</label>
                                <input type="radio" id="salary-2" name="salaryRating" value="2"><label
                                    for="salary-2">&#9733;</label>
                                <input type="radio" id="salary-1" name="salaryRating" value="1"
                                    checked><label for="salary-1">&#9733;</label>
                            </div>

                        </div>

                        <input type="text" class="form-control" placeholder="salary feedback" name="salaryFeedback">
                    </div>


                    <!-- Work Environment Rating -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="mb-0">How do you rate the working
                                environment?</label>
                            <div class="rating">
                                <input type="radio" id="work-5" name="workingEnvironmentRating" value="5"><label
                                    for="work-5">&#9733;</label>
                                <input type="radio" id="work-4" name="workingEnvironmentRating" value="4"><label
                                    for="work-4">&#9733;</label>
                                <input type="radio" id="work-3" name="workingEnvironmentRating" value="3"><label
                                    for="work-3">&#9733;</label>
                                <input type="radio" id="work-2" name="workingEnvironmentRating" value="2"><label
                                    for="work-2">&#9733;</label>
                                <input type="radio" id="work-1" name="workingEnvironmentRating" value="1"
                                    checked><label for="work-1">&#9733;</label>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="work Environment feedback" name="workingEnvironmentFeedback">
                    </div>

                    <!-- Extra Benefits Rating -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="mb-0">Extra benefits/allowances rating?</label>
                            <div class="rating">
                                <input type="radio" id="benefits-5" name="benefitsRating"
                                    value="5"><label for="benefits-5">&#9733;</label>
                                <input type="radio" id="benefits-4" name="benefitsRating"
                                    value="4"><label for="benefits-4">&#9733;</label>
                                <input type="radio" id="benefits-3" name="benefitsRating"
                                    value="3"><label for="benefits-3">&#9733;</label>
                                <input type="radio" id="benefits-2" name="benefitsRating"
                                    value="2"><label for="benefits-2">&#9733;</label>
                                <input type="radio" id="benefits-1" name="benefitsRating" value="1"
                                    checked><label for="benefits-1">&#9733;</label>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="benefits Rating feedback" name="benefitsFeedback">
                    </div>
                </div>

            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn add-project float-start" id="addExperienceBtn">
                    + Add Experience
                </button>
                <div class="text-end">
                    <button type="submit" class="btn text-center skip-btn mx-2" data-current="experience" data-next="training" data-link="trainingLink">Skip</button>
                    <button type="button" class="btn text-center next-btn" id="submitExperience">Save & Continue</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container mt-4 p-0">
        <div id="experienceList"></div>
        @if($experiences->isNotEmpty())
        <h3>Experience</h3>

        @foreach($experiences as $experience)
        <div class="card mb-3 mt-3 p-3 bg-light rounded w-100">
            <div class="d-flex justify-content-between">
                <div>
                    <h5>{{ $experience->jobTitle }}</h5>
                </div>
                <div>
                    <a href="{{ route('experiences.edit', $experience->id) }}" class="btn fw-semibold" style="color: #0064A7;">
                        Edit
                    </a>
                    <form action="{{ route('experiences.destroy', $experience->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn text-danger fw-semibold">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="text-black-50">
                <p class="m-0"><strong>{{ $experience->companyName }}</strong> – {{ $experience->location }}</p>
                <p class="m-0">
                    {{ \Carbon\Carbon::parse($experience->startDate)->format('M Y') }} –
                    {{ \Carbon\Carbon::parse($experience->endDate)->format('M Y') }}
                </p>
                <p class="m-0">{{ $experience->experienceDescription }}</p>
                <hr class="my-2">
                <p class="m-0"><strong>Salary Rating:</strong> {{ $experience->salaryRating }}/5</p>
                <p class="m-0">{{ $experience->salaryFeedback }}</p>
                <p class="m-0"><strong>Environment Rating:</strong> {{ $experience->workingEnvironmentRating }}/5</p>
                <p class="m-0">{{ $experience->workingEnvironmentFeedback }}</p>
                <p class="m-0"><strong>Benefits Rating:</strong> {{ $experience->benefitsRating }}/5</p>
                <p class="m-0">{{ $experience->benefitsFeedback }}</p>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        function getSelectedRatingValue(name) {
            const selected = document.querySelector(`input[name="${name}"]:checked`);
            return selected ? selected.value : null;
        }

        // Collect all experience data from form inputs
        function collectExperienceData() {
            return {
                jobTitle: document.getElementsByName('jobTitle')[0].value,
                companyName: document.getElementsByName('companyName')[0].value,
                location: document.getElementsByName('location')[0].value,
                startDate: document.getElementsByName('startDate')[0].value,
                endDate: document.getElementsByName('endDate')[0].value,
                experienceDescription: document.getElementsByName('experienceDescription')[0].value,
                salaryRating: getSelectedRatingValue('salaryRating'),
                salaryFeedback: document.getElementsByName('salaryFeedback')[0].value,
                workingEnvironmentRating: getSelectedRatingValue('workingEnvironmentRating'),
                workingEnvironmentFeedback: document.getElementsByName('workingEnvironmentFeedback')[0].value,
                benefitsRating: getSelectedRatingValue('benefitsRating'),
                benefitsFeedback: document.getElementsByName('benefitsFeedback')[0].value
            };
        }

        // Save experience data to server
        async function saveExperienceData(experienceData) {
            try {
                const response = await fetch("{{ route('experiences.store') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(experienceData)
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                return await response.json();
            } catch (error) {
                console.error("Error saving experience data:", error);
                alert('Error saving experience. Please check console for details.');
                return {
                    success: false
                };
            }
        }

        // Append the newly added experience to the DOM
        function appendExperienceCard(experience) {
            const card = document.createElement('div');
            card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
            card.innerHTML = `
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5>${experience.jobTitle}</h5>
                            <p class="m-0 text-muted">${experience.companyName} – ${experience.location}</p>
                            <p class="m-0 text-muted">${experience.startDate} – ${experience.endDate}</p>
                            <p>${experience.experienceDescription}</p>
                        </div>
                        <div>
                            <a href="/experiences/${experience.id}/edit" class="btn fw-semibold" style="color: #0064A7;">Edit</a>
                            <form action="/experiences/${experience.id}" method="POST" style="display:inline;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn text-danger fw-semibold">Delete</button>
                            </form>
                        </div>
                    </div>
                `;
            document.getElementById('experienceList')?.appendChild(card);
        }

        // Prevent default form submission
        document.getElementById('experienceForm').addEventListener('submit', function(e) {
            e.preventDefault();
        });

        // "Add Experience" button click
        document.getElementById('addExperienceBtn').addEventListener('click', async function(e) {
            e.preventDefault();
            const experienceData = collectExperienceData();
            const result = await saveExperienceData(experienceData);
            if (result.success) {
                const experience = result.experience;
                document.getElementById('overviewExperiences').innerHTML = `
                    <p><strong>Job Title:</strong> ${experience.jobTitle ?? ''}</p>
                    <p><strong>Company Name:</strong> ${experience.companyName ?? ''}</p>
                    <p><strong>Location:</strong> ${experience.location ?? ''}</p>
                    <p><strong>Start Date:</strong> ${experience.startDate ?? ''}</p>
                    <p><strong>End Date:</strong> ${experience.endDate ?? ''}</p>
                    <p><strong>Description:</strong> ${experience.experienceDescription ?? ''}</p>
                    <p><strong>Salary Rating:</strong> ${experience.salaryRating ?? ''}</p>
                    <p><strong>Salary Feedback:</strong> ${experience.salaryFeedback ?? ''}</p>
                    <p><strong>Working Environment Rating:</strong> ${experience.workingEnvironmentRating ?? ''}</p>
                    <p><strong>Working Environment Feedback:</strong> ${experience.workingEnvironmentFeedback ?? ''}</p>
                    <p><strong>Benefits Rating:</strong> ${experience.benefitsRating ?? ''}</p>
                    <p><strong>Benefits Feedback:</strong> ${experience.benefitsFeedback ?? ''}</p>
                    <hr>
                `;
                document.getElementById('experienceForm').reset(); // Reset inputs
                document.querySelectorAll('input[type="radio"]:checked').forEach(radio => radio.checked = false); // Reset radios
                appendExperienceCard(result.experience);
                console.log("Experience added successfully!");
            }
        });

        // "Save & Continue" button click
        document.getElementById('submitExperience').addEventListener('click', async function(e) {
            e.preventDefault();
            const experienceData = collectExperienceData();
            const result = await saveExperienceData(experienceData);
            if (result.success) {
                const experience = result.experience;
                document.getElementById('overviewExperience').innerHTML = `
                    <p><strong>Job Title:</strong> ${experience.jobTitle ?? ''}</p>
                    <p><strong>Company Name:</strong> ${experience.companyName ?? ''}</p>
                    <p><strong>Location:</strong> ${experience.location ?? ''}</p>
                    <p><strong>Start Date:</strong> ${experience.startDate ?? ''}</p>
                    <p><strong>End Date:</strong> ${experience.endDate ?? ''}</p>
                    <p><strong>Description:</strong> ${experience.experienceDescription ?? ''}</p>
                    <p><strong>Salary Rating:</strong> ${experience.salaryRating ?? ''}</p>
                    <p><strong>Salary Feedback:</strong> ${experience.salaryFeedback ?? ''}</p>
                    <p><strong>Working Environment Rating:</strong> ${experience.workingEnvironmentRating ?? ''}</p>
                    <p><strong>Working Environment Feedback:</strong> ${experience.workingEnvironmentFeedback ?? ''}</p>
                    <p><strong>Benefits Rating:</strong> ${experience.benefitsRating ?? ''}</p>
                    <p><strong>Benefits Feedback:</strong> ${experience.benefitsFeedback ?? ''}</p>
                    <hr>
                `;
                appendExperienceCard(result.experience);
                document.getElementById('experience').style.display = 'none';
                document.getElementById('training').style.display = 'block';
                document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                document.getElementById('trainingLink').classList.add('active');
                console.log("Experience saved and moved to next section!");
            }
        });
    })
</script>
@endpush