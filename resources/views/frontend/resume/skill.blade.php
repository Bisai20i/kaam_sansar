<div id="skill" class="section-content" style="display: none;">
    <h4 class="mb-3 your-project-text">Your Skills</h4>
    <div class="card-center border p-3">
        <form id="skillForm">
            @csrf
            <h3>Skills</h3>
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="hidden" id="skillId" name="id" value="">
                        <input type="text" class="form-control rounded custom-input border-end-0" id="skillName" name="skillName" placeholder="Skill" required>
                        <select class="form-select custom-input border-start-0 text-end text-center me-1" id="skillProficiency" name="skillProficiency" required>
                            <option>Beginner</option>
                            <option>Intermediate</option>
                            <option>Advanced</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" class="btn add-project float-start" id="addSkill">+ Add Skill</button>
                <div class="text-end">
                    <button type="submit" class="btn text-center skip-btn mx-2" data-current="skill" data-next="achievement" data-link="achievementLink">Skip</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-4 p-0">
        <div id="skillList">
            @foreach($skills as $skill)
            <div class="card mb-3 mt-3 p-3 bg-light rounded w-100" id="card_id_{{ $skill->id }}">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>{{ $skill->skillName }}</h5>
                    </div>
                    <div>
                        <button type="button" class="btn fw-semibold edit-skill" style="color: #0064A7;" data-id="{{ $skill->id }}">Edit</button>
                        <button type="button" class="btn text-danger fw-semibold delete-skill" data-id="{{ $skill->id }}">Delete</button>
                    </div>
                </div>
                <div class="text-black-50">
                    <p class="m-0">Proficiency: {{ $skill->skillProficiency }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Delete Modal for Skill -->
<div class="modal fade" id="deleteSkillModal" tabindex="-1" aria-labelledby="deleteSkillModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="deleteSkillForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <input type="hidden" id="deleteSkillId" name="id" value="">
             <div class="modal-content p-4 rounded-4 border-0 shadow-lg text-center">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-3">
                    <div class="mx-auto rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                        <i class="bi bi-trash-fill text-danger fs-3"></i>
                    </div>
                </div>
                <h4 class="fw-bold">Are you sure?</h4>
                <p class="text-secondary mb-4">Are you sure you want to delete this Skill? This action cannot be undone.</p>
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
        let isEditingSkill = false;
        let currentSkillId = null;

        function collectSkillData() {
            return {
                id: document.getElementById('skillId').value,
                skillName: document.getElementById('skillName').value,
                skillProficiency: document.getElementById('skillProficiency').value
            };
        }

        function resetSkillForm() {
            document.getElementById('skillForm').reset();
            document.getElementById('skillId').value = '';
            isEditingSkill = false;
            currentSkillId = null;
            document.getElementById('addSkill').textContent = '+ Add Skill';
        }

        async function fetchSkillData(id) {
            try {
                const response = await fetch(`/jobseeker/skills/${id}/edit`);
                if (!response.ok) {
                    throw new Error('Failed to fetch skill data');
                }
                return await response.json();
            } catch (error) {
                console.error('Error:', error)
                throw error
            }
        }

        function populateSkillForm(skill) {
            document.getElementById('skillId').value = skill.id;
            document.getElementById('skillName').value = skill.skillName;
            document.getElementById('skillProficiency').value = skill.skillProficiency;

            isEditingSkill = true;
            currentSkillId = skill.id;
            document.getElementById('addSkill').textContent = 'Update Skill';
        }

        async function saveSkillData(data) {
            const url = data.id ? `/jobseeker/skills/${data.id}` : "{{ route('skills.store') }}";
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
            if (!response.ok) {
                const text = await response.text();
                console.error(text);
                return { success: false };
            }

            return await response.json();
        }

        function appendSkillCard(data) {
            const card = document.createElement('div');
            card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
            card.id = `card_id_${data.id}`;
            card.innerHTML = `
            <div class="d-flex justify-content-between">
                <div><h5>${data.skillName}</h5></div>
                <div>
                    <button type="button" class="btn fw-semibold edit-skill" style="color: #0064A7;" data-id="${data.id}">Edit</button>
                    <button type="button" class="btn text-danger fw-semibold delete-skill" data-id="${data.id}">Delete</button>
                </div>
            </div>
            <div class="text-black-50">
                <p class="m-0">Proficiency: ${data.skillProficiency}</p>
            </div>`;
            document.getElementById('skillList').appendChild(card);
        }

        function updateSkillCard(data) {
            const card = document.getElementById(`card_id_${data.id}`);
            if (card) {
                card.innerHTML = `
                <div class="d-flex justify-content-between">
                    <div><h5>${data.skillName}</h5></div>
                    <div>
                        <button type="button" class="btn fw-semibold edit-skill" style="color: #0064A7;" data-id="${data.id}">Edit</button>
                        <button type="button" class="btn text-danger fw-semibold delete-skill" data-id="${data.id}">Delete</button>
                    </div>
                </div>
                <div class="text-black-50">
                    <p class="m-0">Proficiency: ${data.skillProficiency}</p>
                </div>`;
            }
        }

        document.getElementById('addSkill').addEventListener('click', async function(e) {
            e.preventDefault();
            const data = collectSkillData();


            try {
                const result = await saveSkillData(data);
                if (result.success) {
                    if (isEditingSkill) {
                        updateSkillCard(result.skill);
                    } else {
                        appendSkillCard(result.skill);
                    }
                    resetSkillForm();
                }
            } catch (error) {
                console.error(error);
                alert('Error saving skill');
            }
        });

        document.getElementById('skillList').addEventListener('click', function(e) {
            if (e.target.classList.contains('edit-skill')) {
                e.preventDefault();
                const id = e.target.dataset.id;
                fetchSkillData(id)
                    .then(data => {
                        populateSkillForm(data);
                        document.getElementById('skillForm').scrollIntoView({
                            behavior: 'smooth'
                        });
                    })
                    .catch(err => alert('Error loading data: ' + err.message));
            } else if (e.target.classList.contains('delete-skill')) {
                e.preventDefault();
                const id = e.target.dataset.id;
                
                // Set the form action and ID
                document.getElementById('deleteSkillId').value = id;
                document.getElementById('deleteSkillForm').action = `/jobseeker/skills/${id}`;
                
                // Show the modal
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteSkillModal'));
                deleteModal.show();
            }
        });

        // Handle form submission for delete modal
        document.getElementById('deleteSkillForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const id = document.getElementById('deleteSkillId').value;
            const form = this;
            
            try {
                const res = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ _method: 'DELETE', id: id })
                });
                
                const json = await res.json();
                if (json.success) {
                    document.getElementById(`card_id_${id}`).remove();
                    if (currentSkillId === parseInt(id)) {
                        resetSkillForm();
                    }
                    
                    // Hide the modal
                    const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteSkillModal'));
                    deleteModal.hide();
                } else {
                    alert('Error deleting skill');
                }
            } catch (error) {
                console.error('Delete error:', error);
                alert('Error deleting skill');
            }
        });

        async function deleteSkillData(id) {
            const response = await fetch(`/jobseeker/skills/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    request_type: 'mobile'
                })
            });

            if (!response.ok) throw new Error('Failed to delete skill');
            return await response.json();
        }
    });
</script>
@endpush