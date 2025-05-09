<!-- resources/views/sections/education.blade.php -->

<div id="education" class="section-content" style="display: none;">
    <h4 class="mb-3 your-project-text">Your Education</h4>
    <div class="card p-4 card-center">
        <form id="educationForm">
            @csrf
            <h3>School/Institution</h3>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="schoolName" class="form-label">School Name</label>
                    <input type="text" class="form-control custom-input" id="schoolName" name="schoolName" placeholder="California University" required />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="degree" class="form-label">Degree <span class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" id="degree" name="degree" placeholder="Bachelor" required />
                </div>
                <div class="col-md-6">
                    <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" id="city" name="city" placeholder="Pokhara" required />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="startDate" class="form-label">Start Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control custom-input" id="startDate" name="startDate" required />
                </div>
                <div class="col-md-6">
                    <label for="graduationDate" class="form-label">Graduation Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control custom-input" id="graduationDate" name="graduationDate" required />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label for="educationDescription" class="form-label">Summary <span class="text-danger">*</span></label>
                    <textarea class="form-control custom-input" id="educationDescription" name="educationDescription" rows="3" required placeholder="Give a summary of your education..."></textarea>
                </div>
            </div>
            <button type="button" class="btn add-project float-start" id="addEducation">+ Add Education</button>
            <div class="text-end">
                <button type="submit" class="btn text-center skip-btn mx-2" data-current="education" data-next="project" data-link="projectLink">Skip</button>
                <button type="button" class="btn text-center next-btn" id="submitEducation">Save & Continue</button>
            </div>
        </form>
    </div>

    <!-- Existing Education List -->
    <div class="container mt-4 p-0">
        <div id="educationList">
            @foreach($educations as $education)
            <div class="card mb-3 mt-3 p-3 bg-light rounded w-100" id="card_id_{{  $education->id}}">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>{{ $education->degree }}</h5>
                    </div>
                    <div>
                        <a href="{{ route('educations.edit', $education->id) }}" class="btn fw-semibold" style="color: #0064A7;">Edit</a>
                        <button type="button" class="btn text-danger fw-semibold delete-education" data-id="{{$education->id  }}">Delete</button>
                    </div>
                </div>
                <div class="text-black-50">
                    <p class="m-0">{{ $education->schoolName }} – {{ $education->city }}</p>
                    <p class="m-0">{{ \Carbon\Carbon::parse($education->startDate)->format('M Y') }} – {{ \Carbon\Carbon::parse($education->graduationDate)->format('M Y') }}</p>
                    <p class="m-0">{{ $education->educationDescription }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function collectEducationData() {
            return {
                schoolName: document.getElementById('schoolName').value,
                degree: document.getElementById('degree').value,
                city: document.getElementById('city').value,
                startDate: document.getElementById('startDate').value,
                graduationDate: document.getElementById('graduationDate').value,
                educationDescription: document.getElementById('educationDescription').value
            };
        }

        function formatDate(dateStr) {
            const date = new Date(dateStr);
            return date.toLocaleDateString('en-US', {
                month: 'short',
                year: 'numeric'
            });
        }

        function appendEducationCard(education) {
            const card = document.createElement('div');
            card.className = 'card mb-3 mt-3 p-3 bg-light rounded w-100';
            card.innerHTML = `
            <div class="d-flex justify-content-between">
                <div><h5>${education.degree}</h5></div>
                <div>
                    <a href="/educations/${education.id}/edit" class="btn fw-semibold" style="color: #0064A7;">Edit</a>
                    <button type="button" class="btn text-danger fw-semibold delete-education" data-id="${education.id}">Delete</button>
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

        async function saveEducationData(data) {
            const response = await fetch("{{ route('educations.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            });

            // Try to parse JSON only if response is OK
            if (!response.ok) {
                const text = await response.text();
                console.error(text);
                return {
                    success: false
                };
            }

            return await response.json();
        }

        document.getElementById('addEducation').addEventListener('click', async function(e) {
            e.preventDefault();
            const data = collectEducationData();
            const result = await saveEducationData(data);
            if (result.success) {
                appendEducationCard(result.education);
                document.getElementById('educationForm').reset();
            } else {
                alert('Error saving education');
            }
        });

        document.getElementById('submitEducation').addEventListener('click', async function(e) {
            e.preventDefault();
            const data = collectEducationData();
            const result = await saveEducationData(data);
            if (result.success) {
                appendEducationCard(result.education);
                document.getElementById('educationForm').reset();
                document.getElementById('education').style.display = 'none';
                document.getElementById('project').style.display = 'block';
                document.querySelectorAll('.profile-link').forEach(l => l.classList.remove('active'));
                document.getElementById('projectLink').classList.add('active');
            } else {
                alert('Error saving education');
            }
        });

        async function deleteEducationData(id) {


            try {
                const response = await fetch(`/jobseeker/educations/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        request_type: 'mobile' // to get the mobile response
                    })
                });

                // Check if the response is JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new Error('Server did not return JSON');
                }

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Failed to delete education');
                }

                return data;
            } catch (error) {
                console.error('Error:', error);
                throw error;
            }
        }

        // Delete education event delegation
        // document.getElementById('educationList').addEventListener('click', async function(e) {
        //     if (e.target.classList.contains('delete-education')) {
        //         const id = e.target.dataset.id;

        //         // alert(id);

        //         if (confirm('Are you sure you want to delete this education entry?')) {
        //             try {
        //                 const result = await deleteEducationData(id);
        //                 if (result.success) {
        //                     e.target.closest('.card').remove();
        //                     alert('Education deleted successfully!');
        //                 }
        //             } catch (error) {
        //                 alert('Error deleting education: ' + error.message);
        //             }
        //         }
        //     }
        // });



        // Use event delegation on a static parent element
        document.addEventListener('click', async function(e) {
            if (e.target.classList.contains('delete-education')) {
                e.preventDefault();
                const id = e.target.dataset.id;

                if (confirm('Are you sure you want to delete this education entry?')) {
                    try {
                        const result = await deleteEducationData(id);

                        // alert(result.toString());
                        if (result.status) {
                            e.target.closest('.card').remove();
                            alert('Education deleted successfully!');
                        }
                    } catch (error) {
                        alert('Error deleting education: ' + error.message);
                    }
                }
            }
        });

    });
</script>
@endpush