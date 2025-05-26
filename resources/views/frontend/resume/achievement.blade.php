<div id="achievement" class="section-content" style="display:none;">
    <h4 class="mb-3 your-project-text">Your Achievements</h4>
    <div class="card p-4 card-center">
        <form id="achievementForm">
            @csrf
            <input type="hidden" id="achievementId" name="id" value="">
            <h3>Achievements</h3>
            <div class="row mb-3">
                <div class="col-md-12 mb-3">
                    <label for="achievement-title" class="form-label">Achievement Title</label>
                    <input type="text" class="form-control custom-input" name="achievementTitle"
                        id="achievement-title" placeholder="Enter Achievement Title" required>
                </div>

                <div class="col-md-12">
                    <label for="achievement-description" class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control custom-input" id="achievement-description" name="achievementDescription" rows="3"
                        placeholder="Describe your achievement..." required></textarea>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" class="btn add-project float-start" id="addAchievement">+ Add Achievement</button>
                <div class="text-end">
                    <button type="submit" class="btn text-center skip-btn mx-2" data-current="achievement" data-next="experience" data-link="experienceLink">Skip</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-4 p-0">
        <div id="achievementList">
            @foreach($achievements as $achievement)
            <div class="card mb-3 mt-3 p-3 bg-light rounded w-100" id="achievement_card_{{ $achievement->id }}">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>{{ $achievement->achievementTitle }}</h5>
                    </div>
                    <div>
                        <button type="button" class="btn fw-semibold edit-achievement" style="color: #0064A7;" data-id="{{ $achievement->id }}">Edit</button>
                        <button type="button" class="btn text-danger fw-semibold delete-achievement" data-id="{{ $achievement->id }}" data-bs-toggle="modal" data-bs-target="#deleteAchievementModal">Delete</button>
                    </div>
                </div>
                <div class="text-black-50">
                    <p class="m-0">{{ $achievement->achievementDescription }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Delete Achievement Modal -->
<div class="modal fade" id="deleteAchievementModal" tabindex="-1" aria-labelledby="deleteAchievementModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="deleteAchievementForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <input type="hidden" id="deleteAchievementId" name="id" value="">
            <div class="modal-content p-4 rounded-4 border-0 shadow-lg text-center">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-3">
                    <div class="mx-auto rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                        <i class="bi bi-trash-fill text-danger fs-3"></i>
                    </div>
                </div>
                <h4 class="fw-bold">Are you sure?</h4>
                <p class="text-secondary mb-4">Are you sure you want to delete this achievement? This action cannot be undone.</p>
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
        let isEditingAchievement = false;
        let currentAchievementId = null;

        function collectAchievementData() {
            return {
                id: document.getElementById('achievementId').value,
                achievementTitle: document.getElementById('achievement-title').value,
                achievementDescription: document.getElementById('achievement-description').value
            };
        }

        function resetAchievementForm() {
            document.getElementById('achievementForm').reset();
            document.getElementById('achievementId').value = '';
            isEditingAchievement = false;
            currentAchievementId = null;
            document.getElementById('addAchievement').textContent = '+ Add Achievement';
        }

        async function fetchAchievementData(id) {
            const response = await fetch(`/jobseeker/achievements/${id}/edit`);
            if (!response.ok) throw new Error('Failed to fetch achievement data');
            return await response.json();
        }

        function populateAchievementForm(data) {
            document.getElementById('achievementId').value = data.id;
            document.getElementById('achievement-title').value = data.achievementTitle;
            document.getElementById('achievement-description').value = data.achievementDescription;

            isEditingAchievement = true;
            currentAchievementId = data.id;
            document.getElementById('addAchievement').textContent = 'Update Achievement';
        }

        async function saveAchievementData(data) {
            const url = data.id ? `/jobseeker/achievements/${data.id}` : "{{ route('achievements.store') }}";
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

        function appendAchievementCard(data) {
            const card = document.createElement('div');
            card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
            card.id = `achievement_card_${data.id}`;
            card.innerHTML = `
            <div class="d-flex justify-content-between">
                <div><h5>${data.achievementTitle}</h5></div>
                <div>
                    <button type="button" class="btn fw-semibold edit-achievement" style="color: #0064A7;" data-id="${data.id}">Edit</button>
                    <button type="button" class="btn text-danger fw-semibold delete-achievement" data-id="${data.id}" data-bs-toggle="modal" data-bs-target="#deleteAchievementModal">Delete</button>
                </div>
            </div>
            <div class="text-black-50">
                <p class="m-0">${data.achievementDescription}</p>
            </div>`;
            document.getElementById('achievementList').appendChild(card);
        }

        function updateAchievementCard(data) {
            const card = document.getElementById(`achievement_card_${data.id}`);
            if (card) {
                card.innerHTML = `
                <div class="d-flex justify-content-between">
                    <div><h5>${data.achievementTitle}</h5></div>
                    <div>
                        <button type="button" class="btn fw-semibold edit-achievement" style="color: #0064A7;" data-id="${data.id}">Edit</button>
                        <button type="button" class="btn text-danger fw-semibold delete-achievement" data-id="${data.id}" data-bs-toggle="modal" data-bs-target="#deleteAchievementModal">Delete</button>
                    </div>
                </div>
                <div class="text-black-50">
                    <p class="m-0">${data.achievementDescription}</p>
                </div>`;
            }
        }

        // Handle delete modal opening
        document.getElementById('achievementList').addEventListener('click', function(e) {
            if (e.target.classList.contains('delete-achievement')) {
                const achievementId = e.target.getAttribute('data-id');
                document.getElementById('deleteAchievementId').value = achievementId;
                document.getElementById('deleteAchievementForm').action = `/jobseeker/achievements/${achievementId}`;
            }
        });

        // Handle form submission for delete
        document.getElementById('deleteAchievementForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const form = e.target;
            const achievementId = document.getElementById('deleteAchievementId').value;

            try {
                const response = await fetch(form.action, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: achievementId
                    })
                });

                if (!response.ok) throw new Error('Failed to delete achievement');

                const result = await response.json();
                if (result.success) {
                    document.getElementById(`achievement_card_${achievementId}`).remove();
                    if (currentAchievementId === parseInt(achievementId)) {
                        resetAchievementForm();
                    }
                    // Hide the modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('deleteAchievementModal'));
                    modal.hide();
                }
            } catch (error) {
                console.error(error);
                console.error('something wents worng')
            }
        });

        document.getElementById('addAchievement').addEventListener('click', async function(e) {
            e.preventDefault();
            const data = collectAchievementData();


            try {
                const result = await saveAchievementData(data);
                console.log(result)
                if (result.success) {
                    if (isEditingAchievement) {
                        updateAchievementCard(result.achievement);
                    } else {
                        appendAchievementCard(result.achievement);
                    }
                    resetAchievementForm();
                }
            } catch (error) {
                console.error(error);
            }
        });

        document.getElementById('achievementList').addEventListener('click', function(e) {
            if (e.target.classList.contains('edit-achievement')) {
                e.preventDefault();
                const id = e.target.dataset.id;
                fetchAchievementData(id)
                    .then(data => {
                        populateAchievementForm(data);
                        document.getElementById('achievementForm').scrollIntoView({
                            behavior: 'smooth'
                        });
                    })
                console.error('something wents worng')
            }
        });
    });
</script>
@endpush