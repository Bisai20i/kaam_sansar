<div id="profile" class="section-content">
    <h3 class="mb-3">About Yourself</h3>
    <div class="card p-4">
        <form id="profileForm" enctype="multipart/form-data">
            @csrf

            <div class="d-flex align-items-center mb-3">
                <!-- Profile Picture -->
                <img id="profilePreview" src="https://via.placeholder.com/100"
                    class="profile-picture border border-secondary" alt="Profile Picture">

                <!-- Upload Button -->
                <label for="profileUpload" class="btn btn-primary border-0 bg-transparent"
                    style="color:#0064A7;">
                    <i class="fas fa-upload"></i> Upload Your Image
                </label>
                <input type="file" class="file-input" id="profileUpload" accept="image/*" name="profileImg"
                    onchange="previewProfile(event)">
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="first-name" class="form-label">First Name <span
                            class="text-danger">*</span></label>

                    <input type="text" class="form-control custom-input" name="firstName" id="firstname" value="{{ $profile->firstName ?? '' }}"
                        placeholder="Enter your First Name" required>

                </div>
                <div class="col-md-6">
                    <label for="last-name" class="form-label">Last Name <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" name="lastName" id="last-name" value="{{ $profile->lastName ?? '' }}"
                        placeholder="Enter your Last Name" required>

                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="designation" class="form-label">Designation <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" name="designation" id="designation" value="{{ $profile->designation ?? '' }}"
                        placeholder="Enter your Position" required>

                </div>
            </div>

            <!-- Row 3: Country and Address -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="address" class="form-label">Address <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" name="address" id="address" value="{{ $profile->address ?? '' }}"
                        placeholder="Enter your Address" required>

                </div>
                <div class="col-md-6">
                    <label for="country" class="form-label">Country <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" name="country" id="country" value="{{ $profile->country ?? '' }}"
                        placeholder="Enter your Nationality" required />

                </div>
            </div>

            <!-- Row 4: Email & Phone -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email <span
                            class="text-danger">*</span></label>
                    <input type="email" class="form-control custom-input" name="email" id="email" value="{{ $profile->email ?? '' }}"
                        placeholder="Enter your Email" required />

                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" name="phoneNumber" id="phone" value="{{ $profile->phoneNumber ?? '' }}"
                        placeholder="Enter your Phone" required />

                </div>
            </div>

            <!-- Row 5: Summary (Full Width) -->
            <div class="row mb-3">
                <div class="col-12">
                    <label for="summary" class="form-label">Summary <span
                            class="text-danger">*</span></label>
                    <textarea class="form-control custom-input" id="summary" name="bio" rows="3"
                        placeholder="Give summary of your personal Information..." required> {{ $profile->bio ?? '' }}</textarea>

                </div>
            </div>
            <div class="text-end">
            <button type="submit" class="btn text-center skip-btn mx-2 next-btn" data-current="profile" data-next="visa" data-link="visaLink"  id="nextProfile">continue</button>
                <button type="submit" class="btn next-btn">save & continue</button>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script>
    function previewProfile(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('profilePreview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);
            fetch("{{ route('profiles.store') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    console.log(response);
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        const p = data.profile;
                        document.getElementById('overviewName').textContent = `${p.firstName} ${p.lastName}`;
                        document.getElementById('overviewRole').textContent = p.designation;
                        document.getElementById('overviewImage').src = p.profileImg ? `/${p.profileImg}` : 'images/default-profile.png';
                        document.getElementById('overviewContent').innerHTML = `
                            <p><strong>Address:</strong> ${p.address}</p>
                            <p><strong>Country:</strong> ${p.country}</p>
                            <p><strong>Email:</strong> ${p.email}</p>
                            <p><strong>Phone:</strong> ${p.phoneNumber}</p>
                            <p><strong>Summary:</strong> ${p.bio}</p>
                        `;
                        document.getElementById('profile').style.display = 'none';
                        document.getElementById('visa').style.display = 'block';
                        document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                        document.getElementById('visaLink').classList.add('active');
                    } else {
                        console.log("Error saving profile.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    })
</script>

@endpush