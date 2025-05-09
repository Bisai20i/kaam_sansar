<div id="project" class="section-content" style="display:none;">
    <h4 class="mb-3 your-project-text">Your Projects</h4>
    <div class="card p-4 card-center">
        <form id="projectForm">
            @csrf
            <input type="hidden" id="projectId" name="id" value="">
            <h3>Project Details</h3>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="projectTitle" class="form-label">Project Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" name="projectTitle" id="projectTitle" placeholder="" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="projectLink" class="form-label">Project Link <span class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" name="projectLink" id="projectLink" placeholder="" required>

                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label for="projectDescription" class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control custom-input" rows="4" id="projectDescription" name="projectDescription" placeholder="" required></textarea>
                </div>
            </div>
            <button type="button" class="btn add-project float-start" id="addProject">+ Add Project</button>
            <div class="text-end">
                <button type="submit" class="btn text-center skip-btn mx-2" data-current="project" data-next="skill" data-link="skillLink">Continue to Skills</button>
            </div>
        </form>
    </div>

    <!-- Existing Project List -->
    <div class="container mt-4 p-0">
        <div id="projectList">
            @foreach($projects as $project)
            <div class="card mb-3 mt-3 p-3 bg-light rounded w-100" id="project_card_{{ $project->id }}">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>{{ $project->projectTitle }}</h5>
                    </div>
                    <div>
                        <button type="button" class="btn fw-semibold edit-project" style="color: #0064A7;" data-id="{{ $project->id }}">Edit</button>
                        <button type="button" class="btn text-danger fw-semibold delete-project" data-id="{{ $project->id }}">Delete</button>
                    </div>
                </div>
                <div class="text-black-50">
                    @if($project->projectLink)
                    <p class="m-0">
                        <a href="{{ $project->projectLink }}" target="_blank" style="color: #0064A7;">
                            {{ $project->projectLink }}
                        </a>
                    </p>
                    @endif
                    <p class="m-0">{{ $project->projectDescription }}</p>
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
    let currentProjectId = null;

    function collectProjectData() {
        return {
            id: document.getElementById('projectId').value,
            projectTitle: document.getElementById('projectTitle').value,
            projectLink: document.getElementById('projectLink').value,
            projectDescription: document.getElementById('projectDescription').value,
            request_type: 'mobile'    // ← crucial!
        };
    }

    async function saveProjectData(data) {
        const url    = data.id
            ? `/jobseeker/projects/${data.id}`
            : "{{ route('projects.store') }}";
        const method = data.id ? 'PUT' : 'POST';

        const res = await fetch(url, {
            method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify(data),
        });
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        return await res.json();
    }

    function appendProjectCard(p) {
        const card = document.createElement('div');
        card.id    = `project_card_${p.id}`;
        card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
        card.innerHTML = `
            <div class="d-flex justify-content-between">
                <h5>${p.projectTitle}</h5>
                <div>
                  <button class="btn fw-semibold edit-project" data-id="${p.id}" style="color:#0064A7">Edit</button>
                  <button class="btn text-danger fw-semibold delete-project" data-id="${p.id}">Delete</button>
                </div>
            </div>
            <div class="text-black-50">
              ${p.projectLink
                ? `<p class="m-0"><a href="${p.projectLink}" target="_blank">${p.projectLink}</a></p>`
                : ''}
              <p class="m-0">${p.projectDescription}</p>
            </div>
        `;
        document.getElementById('projectList').appendChild(card);
    }

    function updateProjectCard(p) {
        const card = document.getElementById(`project_card_${p.id}`);
        if (!card) return;
        card.innerHTML = `
            <div class="d-flex justify-content-between">
                <h5>${p.projectTitle}</h5>
                <div>
                  <button class="btn fw-semibold edit-project" data-id="${p.id}" style="color:#0064A7">Edit</button>
                  <button class="btn text-danger fw-semibold delete-project" data-id="${p.id}">Delete</button>
                </div>
            </div>
            <div class="text-black-50">
              ${p.projectLink
                ? `<p class="m-0"><a href="${p.projectLink}" target="_blank">${p.projectLink}</a></p>`
                : ''}
              <p class="m-0">${p.projectDescription}</p>
            </div>
        `;
    }

    document.getElementById('addProject').addEventListener('click', async (e) => {
        e.preventDefault();
        const data = collectProjectData();
        if (!data.projectTitle || !data.projectDescription) {
            return alert('Please fill all required fields');
        }
        try {
            const result = await saveProjectData(data);
            if (result.status === 'success') {
                const proj = result.data;
                isEditing ? updateProjectCard(proj) : appendProjectCard(proj);
                document.getElementById('projectForm').reset();
                isEditing = false;
                document.getElementById('addProject').textContent = '+ Add Project';
            } else {
                alert('Error: ' + (result.message || 'Unknown'));
            }
        } catch (err) {
            console.error(err);
            alert('Save failed: ' + err.message);
        }
    });

    // Edit & Delete handlers (mirror the Education pattern)
    document.getElementById('projectList').addEventListener('click', async (e) => {
        const id = e.target.dataset.id;
        // EDIT
        if (e.target.classList.contains('edit-project')) {
            const res = await fetch(`/jobseeker/projects/${id}/edit`);
            const proj = await res.json();
            document.getElementById('projectId').value          = proj.id;
            document.getElementById('projectTitle').value       = proj.projectTitle;
            document.getElementById('projectLink').value        = proj.projectLink;
            document.getElementById('projectDescription').value = proj.projectDescription;
            isEditing = true;
            document.getElementById('addProject').textContent = 'Update Project';
        }
        // DELETE
        else if (e.target.classList.contains('delete-project')) {
            if (!confirm('Delete this project?')) return;
            const res = await fetch(`/jobseeker/projects/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ request_type: 'mobile' })
            });
            const result = await res.json();
            if (result.status === 'success') {
                document.getElementById(`project_card_${id}`).remove();
            } else {
                alert('Delete failed: ' + (result.message || 'Unknown'));
            }
        }
    });
});
</script>
@endpush
