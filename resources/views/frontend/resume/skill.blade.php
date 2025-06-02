<div id="skill" class="section-content" style="display: none;">
    <h4 class="mb-3 your-project-text">Your Skills</h4>
    <div class="card p-4 card-center">
        <form id="skillForm">
            @csrf
            <input type="hidden" id="skillId" name="id" value="">
            <h3>Skills</h3>
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="input-group">
                        <input
                            type="text"
                            class="form-control rounded border-end-0"
                            id="skillName"
                            name="skillName"
                            placeholder=" Enter Skill"
                            required
                            style="background-color: #E6E7E7; height: 50px; cursor: pointer;">
                        <select
                            class="form-select border-start-0 text-end text-center me-1"
                            id="skillProficiency"
                            name="skillProficiency"
                            required
                            style="background-color: #E6E7E7; height: 50px; cursor: pointer;">
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <div class="text-end">
                    <button type="button" class="btn text-center skip-btn mx-2" data-current="skill" data-next="achievement" data-link="achievementLink">Skip</button>
                </div>
                <button type="button" class="btn add-project float-start" id="addSkill">+ Add Skill</button>

            </div>
        </form>
    </div>

    <div class="container mt-4 p-0">
        <div id="skillList">
            @foreach($skills as $skill)
            <div class="card mb-3 mt-3 p-3 bg-light rounded w-100" id="skill_card_{{ $skill->id }}">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>{{ $skill->skillName }}</h5>
                    </div>
                    <div>
                        <button type="button" class="btn fw-semibold edit-skill" style="color: #0064A7;" data-id="{{ $skill->id }}">Edit</button>
                        <button type="button" class="btn text-danger fw-semibold delete-skill" data-id="{{ $skill->id }}" data-bs-toggle="modal" data-bs-target="#deleteSkillModal">Delete</button>
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

<!-- Delete Skill Modal -->
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
            const response = await fetch(`/jobseeker/skills/${id}/edit`);
            if (!response.ok) throw new Error('Failed to fetch skill data');
            return await response.json();
        }

        function populateSkillForm(data) {
            document.getElementById('skillId').value = data.id;
            document.getElementById('skillName').value = data.skillName;
            document.getElementById('skillProficiency').value = data.skillProficiency;

            isEditingSkill = true;
            currentSkillId = data.id;
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

            if (!response.ok) throw new Error(await response.text());
            return await response.json();
        }

        function appendSkillCard(data) {
            const card = document.createElement('div');
            card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
            card.id = `skill_card_${data.id}`;
            card.innerHTML = `
            <div class="d-flex justify-content-between">
                <div><h5>${data.skillName}</h5></div>
                <div>
                    <button type="button" class="btn fw-semibold edit-skill" style="color: #0064A7;" data-id="${data.id}">Edit</button>
                    <button type="button" class="btn text-danger fw-semibold delete-skill" data-id="${data.id}" data-bs-toggle="modal" data-bs-target="#deleteSkillModal">Delete</button>
                </div>
            </div>
            <div class="text-black-50">
                <p class="m-0">Proficiency: ${data.skillProficiency}</p>
            </div>`;
            document.getElementById('skillList').appendChild(card);
        }

        function updateSkillCard(data) {
            const card = document.getElementById(`skill_card_${data.id}`);
            if (card) {
                card.innerHTML = `
                <div class="d-flex justify-content-between">
                    <div><h5>${data.skillName}</h5></div>
                    <div>
                        <button type="button" class="btn fw-semibold edit-skill" style="color: #0064A7;" data-id="${data.id}">Edit</button>
                        <button type="button" class="btn text-danger fw-semibold delete-skill" data-id="${data.id}" data-bs-toggle="modal" data-bs-target="#deleteSkillModal">Delete</button>
                    </div>
                </div>
                <div class="text-black-50">
                    <p class="m-0">Proficiency: ${data.skillProficiency}</p>
                </div>`;
            }
        }

        // Handle delete modal opening
        document.getElementById('skillList').addEventListener('click', function(e) {
            if (e.target.classList.contains('delete-skill')) {
                const skillId = e.target.getAttribute('data-id');
                document.getElementById('deleteSkillId').value = skillId;
                document.getElementById('deleteSkillForm').action = `/jobseeker/skills/${skillId}`;
            }
        });

        // Handle form submission for delete
        document.getElementById('deleteSkillForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const form = e.target;
            const skillId = document.getElementById('deleteSkillId').value;

            try {
                const response = await fetch(form.action, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: skillId
                    })
                });

                if (!response.ok) throw new Error('Failed to delete skill');

                const result = await response.json();
                if (result.success) {
                    document.getElementById(`skill_card_${skillId}`).remove();
                    if (currentSkillId === parseInt(skillId)) {
                        resetSkillForm();
                    }
                    // Hide the modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('deleteSkillModal'));
                    modal.hide();
                }
            } catch (error) {
                console.error(error);
                console.error('something wents worng')
            }
        });

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
                console.error('something wents worng')
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
                    .catch(err => console.error('something wents worng'));
            }
        });
    });
</script>
@endpush