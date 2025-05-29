<div id="profile" class="section-content">
    <h4 class="mb-3 your-project-text">About Yourself</h4>
    <div class="card p-4">
        <form id="profilesForm" enctype="multipart/form-data">
            @csrf

            <div class="d-flex align-items-center mb-3">
                <!-- Profile Picture -->
                @if(isset($profile->profileImg) && $profile->profileImg)
                <img id="profilePreview" src="{{ asset($profile->profileImg) }}"
                    class="img-fluid rounded-circle overflow-hidden"
                    style="aspect-ratio: 1; width:5rem; object-fit: cover;" alt="Profile Picture">
                @elseif(Auth::guard('job_seekers')->user()->profileImg)
                <img id="profilePreview" src="{{ asset( Auth::guard('job_seekers')->user()->profileImg) }}"
                    class="img-fluid rounded-circle overflow-hidden"
                    style="aspect-ratio: 1; width:5rem; object-fit: cover;" alt="Profile Picture">
                @else
                <img id="profilePreview" src="{{ asset('images/default-profile.png') }}"
                    class="img-fluid rounded-circle overflow-hidden"
                    style="aspect-ratio: 1; width:5rem; object-fit: cover;" alt="Profile Picture">
                @endif

                <!-- Upload Button -->
                <label for="profileUpload" class="btn btn-primary border-0 bg-transparent"
                    style="color:#0064A7;">
                    <i class="fas fa-upload"></i> Upload Your Image
                </label>
                <input type="file" class="file-input" id="profileUpload" accept="image/*" name="profileImg" onchange="previewProfileImage(event)" hidden>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="first-name" class="form-label">First Name <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" name="firstName" id="firstname" value="{{ $profile->firstName ?? Auth::guard('job_seekers')->user()->firstName ?? '' }}"
                        placeholder="Enter your First Name" required>
                </div>
                <div class="col-md-6">
                    <label for="last-name" class="form-label">Last Name <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" name="lastName" id="last-name" value="{{ $profile->lastName ?? Auth::guard('job_seekers')->user()->lastName ?? '' }}"
                        placeholder="Enter your Last Name" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="designation" class="form-label">Designation <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" name="designation" id="designation" value="{{ $profile->designation ?? Auth::guard('job_seekers')->user()->designation ?? '' }}"
                        placeholder="Enter your Position" required>
                </div>
            </div>

            <!-- Row 3: Country and Address -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="address" class="form-label">Address <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" name="address" id="address" value="{{ $profile->address ?? Auth::guard('job_seekers')->user()->address ?? '' }}"
                        placeholder="Enter your Address" required>
                </div>
                <div class="col-md-6">
                    <label for="country" class="form-label">Country <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" name="country" id="country" value="{{ $profile->country ?? Auth::guard('job_seekers')->user()->country ?? '' }}"
                        placeholder="Enter your Nationality" required />
                </div>
            </div>

            <!-- Row 4: Email & Phone -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email <span
                            class="text-danger">*</span></label>
                    <input type="email" class="form-control custom-input" name="email" id="email" value="{{ $profile->email ?? Auth::guard('job_seekers')->user()->email ?? '' }}"
                        placeholder="Enter your Email" required />
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" name="phoneNumber" id="phone" value="{{ $profile->phoneNumber ?? Auth::guard('job_seekers')->user()->phoneNumber ?? '' }}"
                        placeholder="Enter your Phone" required />
                </div>
            </div>

            <!-- Row 5: Summary (Full Width) -->
            <div class="row mb-3">
                <div class="col-12">
                    <label for="summary" class="form-label">Summary <span
                            class="text-danger">*</span></label>
                    <textarea class="form-control custom-input" id="summary" name="bio" rows="3"
                        placeholder="Give summary of your personal Information..." required>{{ $profile->bio ?? Auth::guard('job_seekers')->user()->bio ?? '' }}</textarea>
                </div>
            </div>
            <div class="text-end">
                <button type="button" class="btn text-center skip-btn mx-2 float-end border-primary text-primary" id="saveProfile" data-current="profile" data-next="visa" data-link="visaLink">
                    save and continue
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Function to preview selected image
    function previewProfileImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profilePreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    // Save profile data including image
    document.addEventListener('DOMContentLoaded', function() {
        // Load temporary image if exists
        const tempImage = localStorage.getItem('tempProfileImage');
        if (tempImage) {
            document.getElementById('profilePreview').src = tempImage;
        }

        document.getElementById('saveProfile').addEventListener('click', function() {
            const form = document.getElementById('profilesForm');
            const formData = new FormData(form);

            fetch("{{ route('profiles.store') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw err;
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Clear temporary image storage
                        localStorage.removeItem('tempProfileImage');
                        // Show success message
                    }
                .catch(error => {
                    console.error(error);
                    console.error('something wents worng')
                });
        });
    });
</script>
@endpush