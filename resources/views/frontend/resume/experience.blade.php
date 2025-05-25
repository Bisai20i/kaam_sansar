<div id="experience" class="section-content" style="display: none;">
  <h4 class="mb-3 your-project-text">Your Experiences</h4>
  <div class="card p-4 card-center">
    <form id="experienceForm">
      @csrf
      <input type="hidden" id="id" name="id" value="">

      <h3>Job Title</h3>
      <div class="row mb-3">
        <div class="col-md-12">
          <label for="jobTitle" class="form-label">Job Title</label>
          <input type="text" class="form-control custom-input"
            id="jobTitle" name="jobTitle"
            placeholder="Software Engineer" required />
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="companyName" class="form-label">Company Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control custom-input"
            id="companyName" name="companyName"
            placeholder="Google Inc." required />
        </div>
        <div class="col-md-6">
          <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
          <input type="text" class="form-control custom-input"
            id="location" name="location"
            placeholder="San Francisco, CA" required />
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="startDate" class="form-label">Start Date <span class="text-danger">*</span></label>
          <input type="date" class="form-control custom-input"
            id="start_Date" name="startDate" required />
        </div>
        <div class="col-md-6">
          <label for="endDate" class="form-label">End Date <span class="text-danger">*</span></label>
          <input type="date" class="form-control custom-input"
            id="endDate" name="endDate" required />
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-12">
          <label for="experienceDescription" class="form-label">Description <span class="text-danger">*</span></label>
          <textarea class="form-control custom-input"
            id="experienceDescription"
            name="experienceDescription"
            rows="3"
            placeholder="Describe your job role and achievements..."
            required></textarea>
        </div>
      </div>

      <p>Optional <span class="custom-orange">(Not shown on your resume):</span></p>
      <div class="row mb-3">
        <div class="col-md-12 mb-2">
          <div class="d-flex justify-content-between align-items-center">
            <label class="mb-0">Salary Rating</label>
            <div class="rating">
              <input type="radio" id="salaryRating5" name="salaryRating" value="5"><label for="salaryRating5">&#9733;</label>
              <input type="radio" id="salaryRating4" name="salaryRating" value="4"><label for="salaryRating4">&#9733;</label>
              <input type="radio" id="salaryRating3" name="salaryRating" value="3"><label for="salaryRating3">&#9733;</label>
              <input type="radio" id="salaryRating2" name="salaryRating" value="2"><label for="salaryRating2">&#9733;</label>
              <input type="radio" id="salaryRating1" name="salaryRating" value="1" checked><label for="salaryRating1">&#9733;</label>
            </div>
          </div>
          <input type="text" id="salaryFeedback" name="salaryFeedback" class="form-control custom-input mt-2" placeholder="Salary feedback" />
        </div>

        <div class="col-md-12 mb-2">
          <div class="d-flex justify-content-between align-items-center">
            <label class="mb-0">Environment Rating</label>
            <div class="rating">
              <input type="radio" id="workingEnvironmentRating5" name="workingEnvironmentRating" value="5"><label for="workingEnvironmentRating5">&#9733;</label>
              <input type="radio" id="workingEnvironmentRating4" name="workingEnvironmentRating" value="4"><label for="workingEnvironmentRating4">&#9733;</label>
              <input type="radio" id="workingEnvironmentRating3" name="workingEnvironmentRating" value="3"><label for="workingEnvironmentRating3">&#9733;</label>
              <input type="radio" id="workingEnvironmentRating2" name="workingEnvironmentRating" value="2"><label for="workingEnvironmentRating2">&#9733;</label>
              <input type="radio" id="workingEnvironmentRating1" name="workingEnvironmentRating" value="1" checked><label for="workingEnvironmentRating1">&#9733;</label>
            </div>
          </div>
          <input type="text" id="workingEnvironmentFeedback" name="workingEnvironmentFeedback" class="form-control custom-input mt-2" placeholder="Environment feedback" />
        </div>

        <div class="col-md-12">
          <div class="d-flex justify-content-between align-items-center">
            <label class="mb-0">Benefits Rating</label>
            <div class="rating">
              <input type="radio" id="benefitsRating5" name="benefitsRating" value="5"><label for="benefitsRating5">&#9733;</label>
              <input type="radio" id="benefitsRating4" name="benefitsRating" value="4"><label for="benefitsRating4">&#9733;</label>
              <input type="radio" id="benefitsRating3" name="benefitsRating" value="3"><label for="benefitsRating3">&#9733;</label>
              <input type="radio" id="benefitsRating2" name="benefitsRating" value="2"><label for="benefitsRating2">&#9733;</label>
              <input type="radio" id="benefitsRating1" name="benefitsRating" value="1" checked><label for="benefitsRating1">&#9733;</label>
            </div>
          </div>
          <input type="text" id="benefitsFeedback" name="benefitsFeedback" class="form-control custom-input mt-2" placeholder="Benefits feedback" />
        </div>
      </div>

      <button type="button" class="btn add-project float-start" id="addExperience">+ Add Experience</button>
      <div class="text-end">
        <button type="submit"
          class="btn text-center skip-btn mx-2"
          data-current="experience"
          data-next="training"
          data-link="trainingLink">
          Skip
        </button>
      </div>
    </form>
  </div>

  <div class="container mt-4 p-0">
    <div id="experienceList">
      @foreach($experiences as $experience)
      <div class="card mb-3 mt-3 p-3 bg-light rounded w-100" id="card_id_{{ $experience->id }}">
        <div class="d-flex justify-content-between">
          <div>
            <h5>{{ $experience->jobTitle }}</h5>
          </div>
          <div>
            <button type="button" class="btn fw-semibold edit-experience" style="color:#0064A7" data-id="{{ $experience->id }}">Edit</button>
            <button type="button" class="btn text-danger fw-semibold delete-experience" data-id="{{ $experience->id }}">Delete</button>
          </div>
        </div>
        <div class="text-black-50">
          <p class="m-0"><strong>{{ $experience->companyName }}</strong> – {{ $experience->location }}</p>
          <p class="m-0">{{ \Carbon\Carbon::parse($experience->startDate)->format('M Y') }} – {{ \Carbon\Carbon::parse($experience->endDate)->format('M Y') }}</p>
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
    </div>
  </div>
</div>

<!-- Delete Modal for Experience -->
<div class="modal fade" id="deleteExperienceModal" tabindex="-1" aria-labelledby="deleteExperienceModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="deleteExperienceForm" method="POST" action="">
      @csrf
      @method('DELETE')
      <input type="hidden" id="deleteExperienceId" name="id" value="">
      <div class="modal-content p-4 rounded-4 border-0 shadow-lg text-center">
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="mb-3">
          <div class="mx-auto rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
            <i class="bi bi-trash-fill text-danger fs-3"></i>
          </div>
        </div>
        <h4 class="fw-bold">Are you sure?</h4>
        <p class="text-secondary mb-4">Are you sure you want to delete this experiance? This action cannot be undone.</p>
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
    let currentExperienceId = null;

    function collectExperienceData() {
      return {
        id: document.getElementById('id').value,
        jobTitle: document.getElementById('jobTitle').value,
        companyName: document.getElementById('companyName').value,
        location: document.getElementById('location').value,
        startDate: document.getElementById('start_Date').value,
        endDate: document.getElementById('endDate').value,
        experienceDescription: document.getElementById('experienceDescription').value,
        salaryRating: document.querySelector('input[name="salaryRating"]:checked').value,
        salaryFeedback: document.getElementById('salaryFeedback').value,
        workingEnvironmentRating: document.querySelector('input[name="workingEnvironmentRating"]:checked').value,
        workingEnvironmentFeedback: document.getElementById('workingEnvironmentFeedback').value,
        benefitsRating: document.querySelector('input[name="benefitsRating"]:checked').value,
        benefitsFeedback: document.getElementById('benefitsFeedback').value
      };
    }

    function formatDate(s) {
      return new Date(s).toLocaleDateString('en-US', {
        month: 'short',
        year: 'numeric'
      });
    }

    function resetForm() {
      document.getElementById('experienceForm').reset();
      document.getElementById('id').value = '';
      isEditing = false;
      currentExperienceId = null;
      document.getElementById('addExperience').textContent = '+ Add Experience';
    }

    async function fetchExperienceData(id) {
      const res = await fetch(`/jobseeker/experiences/${id}/edit`);
      if (!res.ok) throw new Error('Fetch failed');
      return await res.json();
    }

    function populateForm(exp) {
      document.getElementById('id').value = exp.id;
      document.getElementById('jobTitle').value = exp.jobTitle;
      document.getElementById('companyName').value = exp.companyName;
      document.getElementById('location').value = exp.location;
      document.getElementById('start_Date').value = exp.startDate;
      document.getElementById('endDate').value = exp.endDate;
      document.getElementById('experienceDescription').value = exp.experienceDescription;
      document.querySelector(`input[name="salaryRating"][value="${exp.salaryRating}"]`).checked = true;
      document.getElementById('salaryFeedback').value = exp.salaryFeedback;
      document.querySelector(`input[name="workingEnvironmentRating"][value="${exp.workingEnvironmentRating}"]`).checked = true;
      document.getElementById('workingEnvironmentFeedback').value = exp.workingEnvironmentFeedback;
      document.querySelector(`input[name="benefitsRating"][value="${exp.benefitsRating}"]`).checked = true;
      document.getElementById('benefitsFeedback').value = exp.benefitsFeedback;

      isEditing = true;
      currentExperienceId = exp.id;
      document.getElementById('addExperience').textContent = 'Update Experience';
    }

    async function saveExperienceData(data) {
      const url = data.id ?
        `/jobseeker/experiences/${data.id}` :
        "{{ route('experiences.store') }}";
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

    document.getElementById('addExperience').addEventListener('click', async function(e) {
      e.preventDefault();
      const data = collectExperienceData();
      console.log(collectExperienceData());
      const result = await saveExperienceData(data);
      if (result.success) {
        if (isEditing) {
          updateExperienceCard(result.experience);
        } else {
          appendExperienceCard(result.experience);
        }
        resetForm();
      } else {
        alert('Error saving experience');
      }
    });

    document.getElementById('experienceList').addEventListener('click', function(e) {
      const id = e.target.dataset.id;
      if (!id) return;

      if (e.target.classList.contains('edit-experience')) {
        e.preventDefault();
        fetchExperienceData(id)
          .then(populateForm)
          .catch(err => alert('Error fetching experience: ' + err.message));
      } else if (e.target.classList.contains('delete-experience')) {
        e.preventDefault();
        // Set the form action and ID
        document.getElementById('deleteExperienceId').value = id;
        document.getElementById('deleteExperienceForm').action = `/jobseeker/experiences/${id}`;

        // Show the modal
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteExperienceModal'));
        deleteModal.show();
      }
    });

    // Handle form submission for delete modal
    document.getElementById('deleteExperienceForm').addEventListener('submit', async function(e) {
      e.preventDefault();

      const id = document.getElementById('deleteExperienceId').value;
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
          document.getElementById(`card_id_${id}`).remove();
          if (currentExperienceId === parseInt(id)) {
            resetForm();
          }

          // Hide the modal
          const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteExperienceModal'));
          deleteModal.hide();
        } else {
          alert('Error deleting experience');
        }
      } catch (error) {
        console.error('Delete error:', error);
        alert('Error deleting experience');
      }
    });

    function appendExperienceCard(exp) {
      const card = document.createElement('div');
      card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
      card.id = `card_id_${exp.id}`;
      card.innerHTML = `
      <div class="d-flex justify-content-between">
        <div><h5>${exp.jobTitle}</h5></div>
        <div>
          <button type="button" class="btn fw-semibold edit-experience" style="color:#0064A7" data-id="${exp.id}">Edit</button>
          <button type="button" class="btn text-danger fw-semibold delete-experience" data-id="${exp.id}">Delete</button>
        </div>
      </div>
      <div class="text-black-50">
        <p class="m-0"><strong>${exp.companyName}</strong> – ${exp.location}</p>
        <p class="m-0">${formatDate(exp.startDate)} – ${formatDate(exp.endDate)}</p>
        <p class="m-0">${exp.experienceDescription}</p>
        <hr class="my-2">
        <p class="m-0"><strong>Salary Rating:</strong> ${exp.salaryRating}/5</p>
        <p class="m-0">${exp.salaryFeedback}</p>
        <p class="m-0"><strong>Environment Rating:</strong> ${exp.workingEnvironmentRating}/5</p>
        <p class="m-0">${exp.workingEnvironmentFeedback}</p>
        <p class="m-0"><strong>Benefits Rating:</strong> ${exp.benefitsRating}/5</p>
        <p class="m-0">${exp.benefitsFeedback}</p>
      </div>`;
      document.getElementById('experienceList').appendChild(card);
    }

    function updateExperienceCard(exp) {
      const card = document.getElementById(`card_id_${exp.id}`);
      if (!card) return;
      card.innerHTML = `
      <div class="d-flex justify-content-between">
        <div><h5>${exp.jobTitle}</h5></div>
        <div>
          <button type="button" class="btn fw-semibold edit-experience" style="color:#0064A7" data-id="${exp.id}">Edit</button>
          <button type="button" class="btn text-danger fw-semibold delete-experience" data-id="${exp.id}">Delete</button>
        </div>
      </div>
      <div class="text-black-50">
        <p class="m-0"><strong>${exp.companyName}</strong> – ${exp.location}</p>
        <p class="m-0">${formatDate(exp.startDate)} – ${formatDate(exp.endDate)}</p>
        <p class="m-0">${exp.experienceDescription}</p>
        <hr class="my-2">
        <p class="m-0"><strong>Salary Rating:</strong> ${exp.salaryRating}/5</p>
        <p class="m-0">${exp.salaryFeedback}</p>
        <p class="m-0"><strong>Environment Rating:</strong> ${exp.workingEnvironmentRating}/5</p>
        <p class="m-0">${exp.workingEnvironmentFeedback}</p>
        <p class="m-0"><strong>Benefits Rating:</strong> ${exp.benefitsRating}/5</p>
        <p class="m-0">${exp.benefitsFeedback}</p>
      </div>`;
    }
  });
</script>
@endpush