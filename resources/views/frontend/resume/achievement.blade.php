<div id="achievement" class="section-content" style="display:none;">
    <h4 class="mb-3 your-project-text">Your Achievements</h4>
    <div class="card p-3">
        <form id="achievementForm">
            @csrf
            <h3>Achievements</h3>
            <div class="row mb-3 mb-5">
                <div class="col-md-12 mb-3">
                    <label for="achievement-title" class="form-label">Achievement
                        Title</label>
                    <input type="text" class="form-control custom-input" name="achievementTitle"
                        id="achievement-title" placeholder="Enter Achievement Title" required>
                </div>

                <div class="col-md-12">
                    <label for="achievement-description" class="form-label">Description <span
                            class="text-danger">*</span></label>
                    <textarea class="form-control custom-input" id="achievement-description" name="achievementDescription" rows="3"
                        placeholder="Describe your achievement..."> </textarea>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" class="btn add-project float-start" id="addAchievement">
                    + AddAchievement
                </button>
                <div class="text-end">
                    <button type="submit" class="btn text-center skip-btn mx-2" data-current="achievement" data-next="experience" data-link="experienceLink">Skip</button>
                    <button type="button" class="btn text-center next-btn" id="submitAchievement">Save & Continue</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container mt-4 p-0">
        <div id="achievementList"></div>
        @if($achievements->isNotEmpty())
        @foreach($achievements as $achievement)
        <div class="card mb-3 mt-3 p-3 bg-light rounded w-100">
            <div class="d-flex justify-content-between">
                <div>
                    <h5>{{ $achievement->achievementTitle }}</h5>
                </div>
                <div>
                    <a href="{{ route('achievements.edit', $achievement->id) }}" class="btn fw-semibold" style="color: #0064A7;">
                        Edit
                    </a>
                    <form action="{{ route('achievements.destroy', $achievement->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn text-danger fw-semibold">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="text-black-50">
                <p class="m-0">{{ $achievement->achievementDescription }}</p>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function collectAchievementData() {
            return {
                achievementTitle: document.getElementsByName('achievementTitle')[0].value,
                achievementDescription: document.getElementsByName('achievementDescription')[0].value
            };
        }

        async function saveAchievementData(achievementData) {
            try {
                const response = await fetch("{{ route('achievements.store') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(achievementData)
                });
                return await response.json();
            } catch (error) {
                console.error("Error saving data:", error);
                return {
                    success: false
                };
            }
        }

        function appendAchievementCard(achievement) {
            const card = document.createElement('div');
            card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
            card.innerHTML = `
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5>${achievement.achievementTitle}</h5>
                        </div>
                        <div>
                            <a href="/achievements/${achievement.id}/edit" class="btn fw-semibold" style="color: #0064A7;">Edit</a>
                            <form action="/achievements/${achievement.id}" method="POST" style="display:inline;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn text-danger fw-semibold">Delete</button>
                            </form>
                        </div>
                    </div>
                    <div class="text-black-50">
                        <p class="m-0">${achievement.achievementDescription}</p>
                    </div>
                `;
            document.getElementById('achievementList').appendChild(card);
        }

        document.getElementById('achievementForm').addEventListener('submit', function(e) {
            e.preventDefault();
        });

        document.getElementById('addAchievement').addEventListener('click', async function(e) {
            e.preventDefault();
            const achievementData = collectAchievementData();
            const result = await saveAchievementData(achievementData);
            if (result.success) {
                document.getElementById('achievementForm').reset();
                appendAchievementCard(result.achievement);
            }
        });

        document.getElementById('submitAchievement').addEventListener('click', async function(e) {
            e.preventDefault();
            const achievementData = collectAchievementData();
            const result = await saveAchievementData(achievementData);
            if (result.success) {
                appendAchievementCard(result.achievement);
                document.getElementById('achievement').style.display = 'none';
                document.getElementById('language').style.display = 'block';
                document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                document.getElementById('languageLink').classList.add('active');
            }
        });

    })
</script>  
@endpush