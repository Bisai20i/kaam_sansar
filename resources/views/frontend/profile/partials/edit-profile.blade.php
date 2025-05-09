@extends('frontend.profile.jobseeker-dashboard')

@section('profileSection')

<style>
    .modalLink{
        text-decoration: none;

    }
    .modalLink:hover{
        outline: 1px solid #0064A7;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="photoActionModal" tabindex="-1" aria-labelledby="photoActionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="photoActionModalLabel">Photo Actions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>What would you like to do with this photo?</p>

                <!-- Buttons for actions -->
                <div class="d-flex justify-content-between">

                    <a href="#" class="modalLink rounded rounded-2 px-4 py-2 bg-secondary-subtle text-secondary" id="setProfilePicture" >Set as Profile Photo</a>
                    <a href="#" class="modalLink rounded rounded-2 px-4 py-2 bg-danger-subtle text-danger" id="deleteIndexPicture" >Delete Photo</a>
                </div>
            </div>
        </div>
    </div>
</div>
    <div id="editProfile" class="profile-section">
        <div class="edit-profile-card border py-3">
            <div class="d-flex align-items-center mb-4 upload-profile-image ">
                <img src="{{ Auth::guard('job_seekers')->user()->userThumbnail
                    ? asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail[0])
                    : asset('frontend/assets/Images/profile.jpg') }}"
                    class="rounded-circle border border-4 border-primary-subtle my-3 mx-1" id="primary-photo" onclick="document.getElementById('primaryProfileImageBtn').click()" style="cursor: pointer;">
                    <button type="button" id="primaryProfileImageBtn" class="toggleModalButton btn rounded rounded-circle bg-primary-subtle d-none"
                            style="cursor: pointer; z-index: 99; left:0;" data-delete-route="{{route('jobseeker.deleteImage',['index'=>0])}}"
                            data-bs-toggle="modal" data-bs-target="#photoActionModal" data-setProfile-route="{{route('jobseeker.setProfile',['index'=>0])}}">

                        </button>
                @if (Auth::guard('job_seekers')->user()->userThumbnail)


                @if (count(Auth::guard('job_seekers')->user()->userThumbnail) > 1)
                    @for ($i = 1; $i < count(Auth::guard('job_seekers')->user()->userThumbnail); $i++)

                    <div class="position-relative">
                        <img src="{{ asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail[$i]) }}"
                            class="rounded-circle my-3 mx-1">
                        <button type="button" class="toggleModalButton btn rounded rounded-circle bg-primary-subtle position-absolute"
                            style="cursor: pointer; z-index: 99; left:0;" data-delete-route="{{route('jobseeker.deleteImage',['index'=>$i])}}"
                            data-bs-toggle="modal" data-bs-target="#photoActionModal" data-setProfile-route="{{route('jobseeker.setProfile',['index'=>$i])}}">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                    </div>

                    @endfor

                @endif

                @endif

                {{-- <img src="{{ Auth::guard('job_seekers')->user()->userThumbnail
                    ? asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail)
                    : asset('frontend/assets/Images/profile.jpg') }}"
                    class="rounded-circle my-3 mx-1" id="primary-photo"> --}}

                <div class="photo-grid" id="additional-photos"
                    data-acceptedImages = "{{ Auth::guard('job_seekers')->user()->userThumbnail ? (5- count(Auth::guard('job_seekers')->user()->userThumbnail)):5 }}"></div>
                <button class="btn edit-profile-upload-btn my-3 mx-1"
                    onclick="document.getElementById('file-input').click()" type="button">
                    <i class="bi bi-camera"></i>
                </button>
                <!-- Hidden File Input -->

            </div>
            <h1>Upload up to 5 photos. Click to select primary photo </h1>
            <form action="{{ route('jobseeker.profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="file" id="file-input" accept="image/*" multiple class="d-none" name="images[]"
                    onchange="handleFiles(this.files)">
                <div class="mb-3">
                    <input type="text" class="form-control" name="fullName"
                        placeholder="Full Name: {{ Auth::guard('job_seekers')->user()->firstName . ' ' . Auth::guard('job_seekers')->user()->lastName }}">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="temporaryLocation"
                        placeholder="Current Address: {{ Auth::guard('job_seekers')->user()->temporaryLocation }}">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="permanentLocation"
                        placeholder="Permanent Address: {{ Auth::guard('job_seekers')->user()->permanentLocation }}">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="phoneNumber"
                        placeholder="Mobile No.: {{ Auth::guard('job_seekers')->user()->phoneNumber }}">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="profession"
                        placeholder="Designation: {{ Auth::guard('job_seekers')->user()->profession }}">
                </div>
                <div class="mb-3 d-flex align-items-center justify-content-center">
                    <label for="gender" class="text-nowrap me-2" style="width: max-content;">Gender:</label>
                    <select name="gender" class="form-control m-0 border-1 border-dark-subtle" style="cursor: pointer">
                        <option value="male"
                            {{ Auth::guard('job_seekers')->user()->gender === 'male' ? 'selected' : '' }}>
                            Male</option>
                        <option value="female"
                            {{ Auth::guard('job_seekers')->user()->gender === 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other"
                            {{ Auth::guard('job_seekers')->user()->gender === 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="mb-3 d-flex align-items-center justify-content-center">
                    <label for="whoamI" class="text-nowrap me-2" style="width: max-content;">I am a:</label>
                    <select name="whoAmI" class="form-control m-0 border-1 border-dark-subtle" style="cursor: pointer">
                        <option value="student"
                            {{ Auth::guard('job_seekers')->user()->whoAmI === 'student' ? 'selected' : '' }}>
                            Student</option>
                        <option value="worker"
                            {{ Auth::guard('job_seekers')->user()->whoAmI === 'worker' ? 'selected' : '' }}>Worker</option>
                        <option value="consultant"
                            {{ Auth::guard('job_seekers')->user()->whoAmI === 'consultant' ? 'selected' : '' }}>Consultant</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="number" name="luckyNumber" class="form-control" placeholder="Lucky Number: {{Auth::guard('job_seekers')->user()->luckyNumber}}">
                </div>
                <div class="mb-3 d-flex align-items-center justify-content-center">
                    <label for="dob" class="text-nowrap me-2" style="width: max-content;">Date of Birth:</label>
                    <input type="date" name="dob" class="form-control m-0" style="cursor: pointer" value="{{Auth::guard('job_seekers')->user()->dateOfBirth}}">
                </div>
                <div class="save-btn">
                    <button type="submit" class="save-changes-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>


    {{-- <div id="editProfile" class="content-section">
        <style>
            .edit-profile-card .form-label {
                margin-bottom: 0px !important;
            }

            .icon {
                position: absolute;
                bottom: 10px;
                right: 10px;
                cursor: pointer;
                width: 35px;
                height: 35px;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #fff;
                border-radius: 50%;
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
                transition: background 0.2s ease-in-out;
            }

            .icon:hover {
                background-color: #f0f0f0;
            }
        </style>

        <div class="edit-profile-card border py-3">





            <form action="{{ route('jobseeker.profile.update', Auth::guard('job_seekers')->user()->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- Profile Image Section -->
                <div class="position-relative d-inline-block">
                    <input type="hidden" name="previous_state" value="{{ Auth::guard('job_seekers')->user()->state }}">

                    <!-- Profile Image Preview -->
                    <img id="profileImagePreview"
                        src="{{ Auth::guard('job_seekers')->user()->userThumbnail
                            ? asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail)
                            : asset('frontend/assets/Images/profile.jpg') }}"
                        class="rounded-circle mb-3 border" alt="Profile Picture"
                        style="width: 150px; height: 150px; object-fit: cover; background-color: #ddd;">


                    <!-- Edit Icon -->
                    <label for="profileImageInput" class="icon" aria-label="Edit Profile Picture">
                        <i class="fas fa-pencil-alt" style="color: #0064A7;"></i>
                    </label>

                    <!-- Hidden File Input -->
                    <input type="file" id="profileImageInput" name="profile_image" accept="image/*" class="d-none">
                </div>

                <!-- JavaScript for Image Preview -->
                <script>
                    document.getElementById('profileImageInput').addEventListener('change', function(event) {
                        let reader = new FileReader();
                        reader.onload = function() {
                            document.getElementById('profileImagePreview').src = reader.result;
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    });
                </script>

                <!-- Full Name -->
                <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control{{ $errors->has('fullName') ? ' is-invalid' : '' }}"
                        id="fullName" name="fullName"
                        value="{{ old('fullName', Auth::guard('job_seekers')->user()->firstName . ' ' . Auth::guard('job_seekers')->user()->lastName) }}" />
                    @if ($errors->has('fullName'))
                        <div class="invalid-feedback" style="display: block;">
                            {{ $errors->first('fullName') }}
                        </div>
                    @endif
                </div>

                <!-- Gender -->
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" id="gender"
                        name="gender">
                        <option value=""> Select Gender</option>
                        <option value="male" {{ Auth::guard('job_seekers')->user()->gender == 'male' ? 'selected' : '' }}>
                            Male</option>
                        <option value="female"
                            {{ Auth::guard('job_seekers')->user()->gender == 'female' ? 'selected' : '' }}>Female
                        </option>
                        <option value="other"
                            {{ Auth::guard('job_seekers')->user()->gender == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @if ($errors->has('gender'))
                        <div class="invalid-feedback" style="display: block;">
                            {{ $errors->first('gender') }}
                        </div>
                    @endif
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <?php
                use libphonenumber\PhoneNumberUtil;
                use libphonenumber\PhoneNumberFormat;
                use Illuminate\Support\Facades\Auth;

                function formatPhoneNumberForDisplay($phoneNumber, $countryCode)
                {
                    if (empty($phoneNumber) || empty($countryCode)) {
                        return '';
                    }

                    try {
                        $phoneUtil = PhoneNumberUtil::getInstance();
                        $parsedNumber = $phoneUtil->parse($phoneNumber, strtoupper($countryCode));
                        $formattedNumber = $phoneUtil->format($parsedNumber, PhoneNumberFormat::NATIONAL);
                        $removedhyphens = str_replace('-', '', $formattedNumber);

                        return preg_replace('/[^0-9]/', '', $formattedNumber); // Ensure only digits remain
                    } catch (Exception $e) {
                        return preg_replace('/[^0-9]/', '', $phoneNumber); // Return sanitized original if parsing fails
                    }
                }

                function getCountryFromPhone($phoneNumber)
                {
                    if (empty($phoneNumber)) {
                        return 'NP';
                    }

                    $phoneUtil = PhoneNumberUtil::getInstance();
                    try {
                        $parsedNumber = $phoneUtil->parse($phoneNumber, null);
                        return $phoneUtil->getRegionCodeForNumber($parsedNumber) ?? 'NP';
                    } catch (Exception $e) {
                        return 'NP';
                    }
                }

                $phoneNumber = Auth::guard('job_seekers')->user()->phoneNumber;
                $countryIso = getCountryFromPhone($phoneNumber);
                $formattedPhoneNumber = formatPhoneNumberForDisplay($phoneNumber, $countryIso);
                ?>

                <div class="mb-3">
                    <label for="editProfilePhone" class="form-label">Phone Number</label>
                    <input type="tel" name="phone_number" id="editProfilePhone"
                        class="form-control @error('phone_number') is-invalid @enderror" placeholder="Enter Your Phone"
                        inputmode="numeric" pattern="[0-9]+" title="Enter a valid phone number" autocomplete="off"
                        value="{{ old('phone_number', $formattedPhoneNumber) ?? '' }}"
                        @if (Auth::guard('job_seekers')->user()->phoneNumber) @readonly(true) @endif />
                    <input type="hidden" name="country_code" id="editProfileCountryCode" value="{{ $countryIso }}">
                    <input type="hidden" id="storedCountryCode" value="{{ $countryIso }}">
                    @error('phone_number')
                        <div class="invalid-feedback" style="display: block;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Email Address (Readonly if already set) -->
                <div class="mb-3">
                    <label for="emailAddress" class="form-label">Email Address</label>
                    <input type="email" class="form-control {{ $errors->has('emailAddress') ? 'is-invalid' : '' }}"
                        id="emailAddress" name="emailAddress"
                        value="{{ old('emailAddress', Auth::guard('job_seekers')->user()->emailAddress) }}"
                        @if (Auth::guard('job_seekers')->user()->emailAddress) readonly @endif />
                    @if ($errors->has('emailAddress'))
                        <div class="invalid-feedback" style="display: block;">
                            {{ $errors->first('emailAddress') }}
                        </div>
                    @endif
                </div>

                <!-- Address Fields -->
                <div class="mb-3">
                    <label for="temporaryLocation" class="form-label">Current Address</label>
                    <input type="text" class="form-control {{ $errors->has('temporaryLocation') ? 'is-invalid' : '' }}"
                        id="temporaryLocation" name="temporaryLocation"
                        value="{{ old('temporaryLocation', Auth::guard('job_seekers')->user()->temporaryLocation) }}" />
                    @if ($errors->has('temporaryLocation'))
                        <div class="invalid-feedback" style="display: block;">
                            {{ $errors->first('temporaryLocation') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="permanentLocation" class="form-label">Permanent Address</label>
                    <input type="text" class="form-control {{ $errors->has('permanentLocation') ? 'is-invalid' : '' }}"
                        id="permanentLocation" name="permanentLocation"
                        value="{{ old('permanentLocation', Auth::guard('job_seekers')->user()->permanentLocation) }}" />
                    @if ($errors->has('permanentLocation'))
                        <div class="invalid-feedback" style="display: block;">
                            {{ $errors->first('permanentLocation') }}
                        </div>
                    @endif

                </div>

                <!-- Date of Birth -->
                <div class="mb-3">
                    <label for="dateOfBirth" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control {{ $errors->has('dateOfBirth') ? 'is-invalid' : '' }}"
                        id="dateOfBirth" name="dateOfBirth"
                        value="{{ old('dateOfBirth', Auth::guard('job_seekers')->user()->dateOfBirth) }}" />
                    @if ($errors->has('dateOfBirth'))
                        <div class="invalid-feedback" style="display: block;">
                            {{ $errors->first('dateOfBirth') }}
                        </div>
                    @endif
                </div>

                <!-- Profession -->
                <div class="mb-3">
                    <label for="profession" class="form-label">Profession</label>
                    <input type="text" class="form-control {{ $errors->has('profession') ? 'is-invalid' : '' }}"
                        id="profession" name="profession"
                        value="{{ old('profession', Auth::guard('job_seekers')->user()->profession) }}" />

                    @if ($errors->has('profession'))
                        <div class="invalid-feedback" style="display: block;">
                            {{ $errors->first('profession') }}
                        </div>
                    @endif
                </div>

                <!-- Expected Salary -->
                <div class="mb-3">
                    <label for="expectedSalary" class="form-label">Expected Salary</label>
                    <input type="text" class="form-control {{ $errors->has('expectedSalary') ? 'is-invalid' : '' }}"
                        id="expectedSalary" name="expectedSalary"
                        value="{{ old('expectedSalary', Auth::guard('job_seekers')->user()->expectedSalary) }}" />

                    @if ($errors->has('expectedSalary'))
                        <div class="invalid-feedback" style="display: block;">
                            {{ $errors->first('expectedSalary') }}
                        </div>
                    @endif
                </div>

                <!-- Save Button -->
                <div class="save-btn">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div> --}}
@endsection


@push('scripts')
    <script>


        let toggleBtns = document.querySelectorAll('.toggleModalButton')

        toggleBtns.forEach(btn => {
            btn.addEventListener('click',()=>{
                let setProfileLink = btn.getAttribute('data-setProfile-route')
                let deleteLink = btn.getAttribute('data-delete-route')
                document.getElementById('setProfilePicture').setAttribute('href',setProfileLink)
                document.getElementById('deleteIndexPicture').setAttribute('href', deleteLink)

            })

        });


        let uploadedImages = [];
        // window.onload = function() {
        //     const element = document.getElementById('additional-photos');
        //     const acceptedImages = element.getAttribute('data-acceptedImages');
        //     alert(parseInt(acceptedImages));
        // };
        // function handleDelete(e){
        //     alert("hello")
        // }
        // function handleImageIndex(){
        //     document.getElementById('deletePhotoBtn').setAttribute('data-id',e.target.getAttribute('data-id'))
        //     console.log(e.target.getAttribute('data-id'))


        // }
        // document.
        function handleFiles(files) {
            for (let i = 0; i < files.length; i++) {
                if (uploadedImages.length >= parseInt(document.getElementById('additional-photos').getAttribute('data-acceptedImages')))
                    break; // Limit to 5 images
                uploadedImages.push(files[i]);
            }
            updatePhotoDisplay();
        }

        function updatePhotoDisplay() {
            const primaryPhoto = document.getElementById('primary-photo');

            const additionalPhotos = document.getElementById('additional-photos');
            additionalPhotos.innerHTML = '';

            if (uploadedImages.length > 0) {
                // primaryPhoto.src = URL.createObjectURL(uploadedImages[0]);

                for (let i = 0; i < uploadedImages.length; i++) {
                    const container = document.createElement("div");
                    container.classList.add("uploaded-photo-container");

                    const img = document.createElement('img');
                    img.className = 'profile-photo';
                    img.src = URL.createObjectURL(uploadedImages[i]);
                    img.alt = `Additional photo ${i}`;
                    img.onclick = () => setPrimaryPhoto(i);

                    const options = document.createElement("div");
                    options.classList.add("photo-options");

                    // const selectBtn = document.createElement("button");
                    // selectBtn.classList.add("btn", "btn-select");
                    // selectBtn.innerHTML = '<i class="bi bi-check-circle"></i>';
                    // selectBtn.onclick = () => setPrimaryPhoto(i);

                    const deleteBtn = document.createElement("button");
                    deleteBtn.classList.add("btn", "btn-delete");
                    deleteBtn.innerHTML = '<i class="bi bi-trash"></i>';
                    deleteBtn.onclick = () => deletePhoto(i);

                    // options.appendChild(selectBtn);
                    options.appendChild(deleteBtn);
                    container.appendChild(img);
                    container.appendChild(options);
                    additionalPhotos.appendChild(container);
                }

                additionalPhotos.classList.toggle('hidden', uploadedImages.length <= 0);
            } else {
                // primaryPhoto.src = 'https://placehold.co/100x100';
                additionalPhotos.classList.add('hidden');
            }
        }

        function setPrimaryPhoto(index) {
            [uploadedImages[0], uploadedImages[index]] = [uploadedImages[index], uploadedImages[0]];
            updatePhotoDisplay();
        }

        function deletePhoto(index) {
            uploadedImages.splice(index, 1);
            updatePhotoDisplay();
        }
    </script>
@endpush
