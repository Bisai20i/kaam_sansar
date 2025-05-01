    <div id="skill" class="section-content" style="display: none;">
        <h4 class="mb-3 your-project-text ">Your Skills</h4>
        <div class="card p-3">
            <form id="skillForm">
                @csrf
                <h3>Skills</h3>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control custom-input border-end-0"
                                id="skillName" name="skillName" placeholder="Skill" required>
                            <select class="form-select custom-input border-start-0 text-end me-3"
                                id="skillProficiency" name="skillProficiency" required>
                                <option>Beginner</option>
                                <option>Intermediate</option>
                                <option>Advanced</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn add-project float-start" id="addSkill">
                        + Add skill
                    </button>
                    <div class="text-end">
                        <button type="submit" class="btn text-center skip-btn mx-2" data-current="skill" data-next="achievement" data-link="achievementLink">Skip</button>
                        <button type="button" class="btn text-center next-btn" id="submitSkill">Save & Continue</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="container mt-4 p-0">
            <div id="skillList"></div>
            @if($skills->isNotEmpty())
            @foreach($skills as $skill)
            <div class="card mb-3 mt-3 p-3 bg-light rounded w-100">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>{{ $skill->skillName }}</h5>
                    </div>
                    <div>
                        <a href="{{ route('skills.edit', $skill->id) }}" class="btn fw-semibold" style="color: #0064A7;">
                            Edit
                        </a>
                        <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn text-danger fw-semibold">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                <div class="text-black-50">
                    <p class="m-0">Proficiency: {{ $skill->skillProficiency }}</p>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function collectSkillData() {
                return {
                    skillName: document.getElementsByName('skillName')[0].value,
                    skillProficiency: document.getElementsByName('skillProficiency')[0].value
                };
            }
            async function saveSkillData(skillData) {
                try {
                    const response = await fetch("{{ route('skills.store') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(skillData)
                    });
                    return await response.json();
                } catch (error) {
                    console.error("Error saving skill:", error);
                    return {
                        success: false
                    };
                }
            }
            function appendSkillCard(skill) {
                const card = document.createElement('div');
                card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
                card.innerHTML = `
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5>${skill.skillName}</h5>
                                <p class="text-muted m-0">${skill.skillProficiency}</p>
                            </div>
                            <div>
                                <a href="/skills/${skill.id}/edit" class="btn fw-semibold" style="color: #0064A7;">Edit</a>
                                <form action="/skills/${skill.id}" method="POST" style="display:inline;">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn text-danger fw-semibold">Delete</button>
                                </form>
                            </div>
                        </div>
                    `;
                document.getElementById('skillList')?.appendChild(card); // optional chaining for safety
            }

            document.getElementById('skillForm').addEventListener('submit', function(e) {
                e.preventDefault();
            });

            document.getElementById('addSkill').addEventListener('click', async function(e) {
                e.preventDefault();
                const skillData = collectSkillData();
                const result = await saveSkillData(skillData);
                if (result.success) {
                    const skill = result.skill;
                    document.getElementById('overviewSkills').innerHTML = `
                        <p><strong>Skill:</strong> ${skill.skillName}</p>
                        <p><strong>Proficiency:</strong> ${skill.skillProficiency}</p>
                    `;
                    document.getElementById('skillForm').reset();
                    appendSkillCard(result.skill);
                }
            });

            document.getElementById('submitSkill').addEventListener('click', async function(e) {
                e.preventDefault();
                const skillData = collectSkillData();
                const result = await saveSkillData(skillData);
                if (result.success) {
                    const skill = result.skill;
                    document.getElementById('overviewSkill').innerHTML = `
                        <p><strong>Skill:</strong> ${skill.skillName}</p>
                        <p><strong>Proficiency:</strong> ${skill.skillProficiency}</p>
                    `;
                    appendSkillCard(result.skill);
                    document.getElementById('skill').style.display = 'none';
                    document.getElementById('achievement').style.display = 'block';
                    document.querySelectorAll(".profile-link").forEach(link => link.classList.remove("active"));
                    document.getElementById('achievementLink').classList.add('active');
                }
            });

        })
    </script>
    @endpush