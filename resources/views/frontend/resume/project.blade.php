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
                    <input type="text" class="form-control custom-input" name="projectTitle" id="projectTitle" placeholder="Enter project title" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="pl" class="form-label">Project Link</label>
                    <input type="url" class="form-control custom-input" name="pl" id="pl" placeholder="https://example.com">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label for="projectDescription" class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control custom-input" rows="4" id="projectDescription" name="projectDescription" placeholder="Describe your project" required></textarea>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn add-project float-start" id="addProject">+ Add Project</button>
                <div class="text-end">
                    <button type="button" class="btn text-center skip-btn mx-2" data-current="project" data-next="skill" data-link="skillLink">Skip</button>
                </div>
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
                        <button type="button" class="btn text-danger fw-semibold delete-project" data-id="{{ $project->id }}" data-bs-toggle="modal" data-bs-target="#deleteProjectModal">Delete</button>
                    </div>
                </div>
                <div class="text-black-50">
                    @if($project->pl)
                    <p class="m-0">
                        <a href="{{ $project->pl }}" target="_blank" style="color: #0064A7;">
                            {{ $project->pl }}
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

<!-- Delete Modal for Project -->
<div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="deleteProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="deleteProjectForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <input type="hidden" id="deleteProjectId" name="id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this project?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let isEditingProject = false;
    let currentProjectId = null;

    // Collect form data
    function collectProjectData() {
        return {
            id: document.getElementById('projectId').value,
            projectTitle: document.getElementById('projectTitle').value,
            pl: document.getElementById('pl').value,
            projectDescription: document.getElementById('projectDescription').value
        };
    }

    // Reset form to initial state
    function resetProjectForm() {
        document.getElementById('projectForm').reset();
        document.getElementById('projectId').value = '';
        isEditingProject = false;
        currentProjectId = null;
        document.getElementById('addProject').textContent = '+ Add Project';
    }

    // Fetch project data for editing
    async function fetchProjectData(id) {
        try {
            const response = await fetch(`/jobseeker/projects/${id}/edit`);
            if (!response.ok) throw new Error('Failed to fetch project data');
            return await response.json();
        } catch (error) {
            console.error('Error fetching project:', error);
            throw error;
        }
    }

    // Save project data (create or update)
    async function saveProjectData(data) {
        const url = data.id ? `/jobseeker/projects/${data.id}` : "{{ route('projects.store') }}";
        const method = data.id ? 'PUT' : 'POST';

        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to save project');
            }

            return await response.json();
        } catch (error) {
            console.error('Error saving project:', error);
            throw error;
        }
    }

    // Create HTML for project card
    function createProjectCard(project) {
        const card = document.createElement('div');
        card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
        card.id = `project_card_${project.id}`;
        card.innerHTML = `
            <div class="d-flex justify-content-between">
                <div><h5>${project.projectTitle}</h5></div>
                <div>
                    <button type="button" class="btn fw-semibold edit-project" style="color: #0064A7;" data-id="${project.id}">Edit</button>
                    <button type="button" class="btn text-danger fw-semibold delete-project" data-id="${project.id}" data-bs-toggle="modal" data-bs-target="#deleteProjectModal">Delete</button>
                </div>
            </div>
            <div class="text-black-50">
                ${project.pl ? `
                <p class="m-0">
                    <a href="${project.pl}" target="_blank" style="color: #0064A7;">
                        ${project.pl}
                    </a>
                </p>` : ''}
                <p class="m-0">${project.projectDescription}</p>
            </div>`;
        return card;
    }

    // Update existing project card
    function updateProjectCard(project) {
        const card = document.getElementById(`project_card_${project.id}`);
        if (card) {
            card.innerHTML = `
                <div class="d-flex justify-content-between">
                    <div><h5>${project.projectTitle}</h5></div>
                    <div>
                        <button type="button" class="btn fw-semibold edit-project" style="color: #0064A7;" data-id="${project.id}">Edit</button>
                        <button type="button" class="btn text-danger fw-semibold delete-project" data-id="${project.id}" data-bs-toggle="modal" data-bs-target="#deleteProjectModal">Delete</button>
                    </div>
                </div>
                <div class="text-black-50">
                    ${project.pl ? `
                    <p class="m-0">
                        <a href="${project.pl}" target="_blank" style="color: #0064A7;">
                            ${project.pl}
                        </a>
                    </p>` : ''}
                    <p class="m-0">${project.projectDescription}</p>
                </div>`;
        }
    }

    // Add/Update Project button handler
    document.getElementById('addProject').addEventListener('click', async function() {
        const data = collectProjectData();
      console.log(collectProjectData());

        try {
            const result = await saveProjectData(data);
            if (result.success) {
                if (isEditingProject) {
                    updateProjectCard(result.project);
                } else {
                    document.getElementById('projectList').prepend(createProjectCard(result.project));
                }
                resetProjectForm();
            }
        } catch (error) {
            console.error('Error:', error);
            alert(error.message || 'Error saving project');
        }
    });

    // Edit Project handler
    document.getElementById('projectList').addEventListener('click', async function(e) {
        if (e.target.classList.contains('edit-project')) {
            const projectId = e.target.dataset.id;
            try {
                const project = await fetchProjectData(projectId);
                
                // Populate form
                document.getElementById('projectId').value = project.id;
                document.getElementById('projectTitle').value = project.projectTitle;
                document.getElementById('pl').value = project.pl;
                document.getElementById('projectDescription').value = project.projectDescription;

                // Update state
                isEditingProject = true;
                currentProjectId = project.id;
                document.getElementById('addProject').textContent = 'Update Project';

                // Scroll to form
                document.getElementById('projectForm').scrollIntoView({ behavior: 'smooth' });
            } catch (error) {
                console.error('Error:', error);
                alert(error.message || 'Error loading project');
            }
        }
    });

    // Delete Project handler
    document.getElementById('projectList').addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-project')) {
            const projectId = e.target.dataset.id;
            document.getElementById('deleteProjectId').value = projectId;
            document.getElementById('deleteProjectForm').action = `/jobseeker/projects/${projectId}`;
        }
    });

    // Delete form submission handler
    document.getElementById('deleteProjectForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const projectId = document.getElementById('deleteProjectId').value;

        try {
            const response = await fetch(this.action, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ id: projectId })
            });

            if (!response.ok) throw new Error('Failed to delete project');

            const result = await response.json();
            if (result.success) {
                document.getElementById(`project_card_${projectId}`).remove();
                if (currentProjectId === parseInt(projectId)) {
                    resetProjectForm();
                }
                // Hide the modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('deleteProjectModal'));
                modal.hide();
            }
        } catch (error) {
            console.error('Error:', error);
            alert(error.message || 'Error deleting project');
        }
    });
});
</script>
@endpush