@extends('frontend.layouts.main')
@section('title')
Resume Maker
@endsection
@section('content')
<main>
    <section>
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="container">
                <h5>Hi, Utsav Dhungana</h5>
                <img class="resume-img">
                <p class="d-flex">
                    <i class="fas fa-envelope  pt-1"></i> utsavdhungana2@gmail.com
                    <i class="fas fa-phone-alt ps-4  pt-1"></i> 9856015044
                </p>
                <h4>Create Your Resume Today and Find The Perfect Job for You</h4>

                <!-- Add d-flex to align buttons in a row -->
                <div class="d-flex gap-2">
                    <button class="btn btn-edit">Edit <i class="fas fa-edit text-light ps-2"></i></button>
                    <button class="btn btn-share">Share <i class="fas fa-share text-light ps-2"></i></button>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="row d-flex flex-wrap align-items-start">
                <!-- Sidebar -->
                <div class="col-md-4 col-lg-3 col-sm-12 col-12">
                    <div class="card card-first border border-0">
                        <div class="sidebox">
                            <ul class="nav flex-column">
                                <li><a href="#" class="profile-link active" id="profileLink" data-sectionId="profile">
                                        <i class="bi bi-person"></i> Profile Information
                                        <i class="fas fa-angle-right arrow"></i></a></li>
                                <li><a href="#" class="profile-link" id="visaLink" data-sectionId="visa">
                                        <i class="bi bi-credit-card"></i> Visa
                                        <i class="fas fa-angle-right arrow"></i></a></li>
                                <li><a href="#" class="profile-link" id="educationLink" data-sectionId="education">
                                        <i class="bi bi-mortarboard"></i> Education
                                        <i class="fas fa-angle-right arrow"></i></a></li>
                                <li><a href="#" class="profile-link" id="projectLink" data-sectionId="project">
                                        <i class="bi bi-clipboard-check"></i> Project
                                        <i class="fas fa-angle-right arrow"></i></a></li>
                                <li><a href="#" class="profile-link" id="skillLink" data-sectionId="skill">
                                        <i class="bi bi-tools"></i> Skills
                                        <i class="fas fa-angle-right arrow"></i></a></li>
                                <li><a href="#" class="profile-link" id="achievementLink" data-sectionId="achievement">
                                        <i class="bi bi-trophy"></i> Achievements
                                        <i class="fas fa-angle-right arrow"></i></a></li>
                                <li><a href="#" class="profile-link" id="experienceLink" data-sectionId="experience">
                                        <i class="bi bi-briefcase"></i> Experience
                                        <i class="fas fa-angle-right arrow"></i></a></li>
                                <li><a href="#" class="profile-link" id="trainingLink" data-sectionId="training">
                                        <i class="bi bi-journal"></i> Trainings
                                        <i class="fas fa-angle-right arrow"></i></a></li>
                                <li><a href="#" class="profile-link" id="languageLink" data-sectionId="language">
                                        <i class="bi bi-globe"></i> Language
                                        <i class="fas fa-angle-right arrow"></i></a></li>
                            </ul>

                        </div>
                    </div>
                </div>

                <!-- Forms -->
                <div class="col-md-8 col-lg-6 col-sm-12 col-12">
                    <div id="contentArea">
                        <!-- Profile Section (Initially hidden) -->
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
                                        <input type="file" class="file-input" id="profileUpload" accept="image/*"
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
                                        <button type="submit" class="btn next-btn" id="nextProfile">save & continue</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Visa Section (Initially hidden) -->
                        <div id="visa" class="section-content" style="display:none;">
                            <h4 class="mb-3 your-project-text">Visa</h4>
                            <div class="card p-3 card-center">
                                <form id="visaForm" enctype="multipart/form-data">
                                    @csrf
                                    <h3>Visa Details</h3>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="first-name" class="form-label">Visa Details</label>
                                            <input type="text" class="form-control custom-input" name="visaDetails" id="first-name"
                                                placeholder="California University" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6 mb-3">
                                            <label for="date" class="form-label">Visa Expiry <span
                                                    class="">*</span></label>
                                            <input type="date" class="form-control custom-input" name="visaExpire" id="date"
                                                placeholder="Bachelor" required />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="Country" class="form-label">Country <span
                                                    class="">*</span></label>
                                            <input type="text" class="form-control custom-input" name="country" id="Country"
                                                placeholder="Pokhara" required />
                                        </div>
                                        <!-- Top row -->
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <p class="flex-grow-1 my-auto text-black-50 mb-0" style="font-size: 0.9rem;">Upload Visa Photo</p>

                                                <!-- Image upload trigger -->
                                                <div class="d-flex align-items-center gap-2">
                                                    <label for="fileInput" class="primary_color_text m-0" style="cursor: pointer;">
                                                        <i class="fa-solid fa-image fa-lg"></i>
                                                    </label>
                                                    <input type="file" id="fileInput" accept="image/*" class="form-control  d-none custom-input" name="visaImage" required />
                                                </div>
                                            </div>
                                            <!-- Image Preview (small) -->
                                            <div id="imagePreview" class="d-flex mt-1" style="height: 80px;"></div>
                                        </div>
                                    </div>

                                    <script>
                                        const fileInput = document.getElementById('fileInput');
                                        const imagePreview = document.getElementById('imagePreview');

                                        fileInput.addEventListener('change', (event) => {
                                            const file = event.target.files[0];
                                            if (file && file.type.startsWith('image/')) {
                                                const reader = new FileReader();
                                                reader.onload = function(e) {
                                                    imagePreview.innerHTML = `
                                                    <img src="${e.target.result}" alt="Preview" style="height: 100%; width:30%; border-radius: 6px; object-fit: cover;">
                                                    `;
                                                };
                                                reader.readAsDataURL(file);
                                            } else {
                                                imagePreview.innerHTML = '';
                                            }
                                        });
                                    </script>
                                    <div class="text-end ">
                                        <button type="submit" class="btn text-center skip-btn mx-2" data-current="visa" data-next="education" data-link="educationLink">Skip</button>
                                        <button type="submit" class="btn text-center next-btn">Save & Continue</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <style>
                            .profile-picture {
                                width: 80px;
                                height: 80px;
                                border-radius: 50%;
                                object-fit: cover;
                            }

                            .rating {
                                direction: rtl;
                                display: flex;
                            }

                            .rating input {
                                display: none;
                            }

                            .rating label {
                                font-size: 24px !important;
                                color: lightgray;
                                cursor: pointer;
                                padding: 2px;
                            }

                            .rating input:checked~label,
                            .rating label:hover,
                            .rating label:hover~label {
                                color: #FAAC24;
                            }

                            .card-center .next-btn {
                                border: 1px solid #0064a7 !important;
                                color: #fff;
                                font-size: 16px;
                                font-weight: 600;
                                background-color: #0064A7;
                                transition: all 0.3s ease-in-out;
                            }

                            .card-center .skip-btn {
                                border: 1px solid #0064A7 !important;
                                color: #0064A7;
                                font-size: 16px;
                                font-weight: 600;
                                background-color: #fff;
                                transition: all 0.3s ease-in-out;
                            }

                            .card-center .next-btn:hover {
                                background-color: #fff;
                                color: #0064A7;
                            }

                            .card-center .skip-btn:hover {
                                background-color: #0064A7;
                                color: #fff;
                                border: 1px solid #0064A7 !important;
                            }

                            .custom-orange {
                                color: #FAAC24 !important;
                            }
                        </style>

                        <!--Education Section-->
                        <div id="education" class="section-content" style="display: none;">
                            <h4 class="mb-3 your-project-text">Your Education</h4>
                            <div class="card p-4 card-center">
                                <form id="educationForm">
                                    @csrf
                                    <h3>School/Institution</h3>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="schoolName" class="form-label">School Name</label>
                                            <input type="text" class="form-control custom-input" id="schoolName" name="schoolName"
                                                placeholder="California University" required />
                                            @error('schoolName')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="degree" class="form-label">Degree <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control custom-input" id="degree" name="degree"
                                                placeholder="Bachelor" required />
                                            @error('degree')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="city" class="form-label">City <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control custom-input" id="city" name="city"
                                                placeholder="Pokhara" required />
                                            @error('city')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="startDate" class="form-label">Start Date <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control custom-input" id="startDate" name="startDate"
                                                placeholder="yy-mm-dd" required />
                                            @error('startDate')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="gradDate" class="form-label">Graduation Date <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control custom-input" id="graduationDate" name="graduationDate"
                                                placeholder="yy-mm-dd" required />
                                            @error('graduationDate')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div id="hiddenEducationInputs"></div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="summary" class="form-label">Summary <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control custom-input" id="educationDescription" rows="3" name="educationDescription"
                                                placeholder="Give a summary of your education..." required>
                                            </textarea>
                                        </div>
                                    </div>
                                    <!-- Change button types to prevent default form submission -->
                                    <button type="button" class="btn add-project float-start" id="addEducation">
                                        + Add Education
                                    </button>
                                    <div class="text-end ">
                                        <button type="submit" class="btn text-center skip-btn mx-2" data-current="education" data-next="project" data-link="projectLink">Skip</button>
                                        <button type="button" class="btn text-center next-btn" id="submitEducation">Save & Continue</button>
                                    </div>
                            </div>
                        </div>

                        <!-- Project Section (Initially Hidden) -->
                        <div id="project" class="section-content" style="display:none;">
                            <h4 class="mb-3 your-project-text">Your Projects</h4>
                            <div class="card card-center">
                                <form id="projectForm">

                                    <div class="mb-3">
                                        <h1>Projects</h1>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Project Title</label>
                                        <input type="url" class="form-control custom-input" name="projectTitle" id="projectTitle"
                                            placeholder="">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Project Link</label>
                                        <input type="url" class="form-control custom-input" name="projectLink" id="projectLink"
                                            placeholder="">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control custom-input" rows="4" id="projectDescription" name="projectDescription" placeholder=""></textarea>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn add-project float-start" id="addProject">
                                            + Add Project
                                        </button>
                                        <div class="text-end">
                                            <button type="submit" class="btn text-center skip-btn mx-2" data-current="project" data-next="skill" data-link="skillLink">Skip</button>
                                            <button type="button" class="btn text-center next-btn" id="submitProject">Save & Continue</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Skills Section (Initially hidden) -->
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
                        </div>

                        <!-- Achievements Section (Initially hidden) -->
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

                        </div>

                        <!-- Experience Section (Initially hidden) -->
                        <div id="experience" class="section-content" style="display:none;">
                            <h4 class="mb-3 your-project-text">Your Experiences</h4>
                            <div class="card p-3">
                                <form id="experienceForm">
                                    @csrf
                                    <h3>Job Title</h3>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="experience-job-title" class="form-label">Job Title</label>
                                            <input type="text" class="form-control custom-input"
                                                id="experience-job-title" name="jobTitle" placeholder="Software Engineer" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="experience-company-name" class="form-label">Company
                                                Name</label>
                                            <input type="text" class="form-control custom-input" name="companyName"
                                                id="experience-company-name" placeholder="Google Inc." required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="experience-location" class="form-label">Location</label>
                                            <input type="text" class="form-control custom-input" name="location"
                                                id="experience-location" placeholder="San Francisco, CA" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="experience-start-date" class="form-label">Start Date</label>
                                            <input type="date" class="form-control custom-input" name="startDate"
                                                id="experience-start-date" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="experience-end-date" class="form-label">End Date</label>
                                            <input type="date" class="form-control custom-input" name="endDate"
                                                id="experience-end-date" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="experience-description" class="form-label">Description</label>
                                            <textarea class="form-control custom-input" id="experience-description" name="experienceDescription" rows="3"
                                                placeholder="Describe your job role and achievements..." required> </textarea>
                                        </div>

                                        <div>
                                            <p>Optional <span class="custom-orange">(It will not be shown on your
                                                    resume):</span></p>

                                            <!-- Salary Rating -->
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="mb-0">How do you rate the salary pay?</label>
                                                    <div class="rating">
                                                        <input type="radio" id="salary-5" name="salaryRating">
                                                        <input type="radio" id="salary-4" name="salaryRating">
                                                        <input type="radio" id="salary-3" name="salaryRating">
                                                        <input type="radio" id="salary-2" name="salaryRating">
                                                        <input type="radio" id="salary-1" name="salaryRating">
                                                    </div>
                                                </div>

                                                <input type="text" class="form-control" placeholder="salary feedback" name="salaryFeedback">
                                            </div>


                                            <!-- Work Environment Rating -->
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="mb-0">How do you rate the working
                                                        environment?</label>
                                                    <div class="rating">
                                                        <input type="radio" id="work-5" name="workingEnvironmentRating"><label for="work-5">&#9733;</label>
                                                        <input type="radio" id="work-4" name="workingEnvironmentRating"><label for="work-4">&#9733;</label>
                                                        <input type="radio" id="work-3" name="workingEnvironmentRating"><label for="work-3">&#9733;</label>
                                                        <input type="radio" id="work-2" name="workingEnvironmentRating"><label for="work-2">&#9733;</label>
                                                        <input type="radio" id="work-1" name="workingEnvironmentRating"><label for="work-1">&#9733;</label>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" placeholder="work Environment feedback" name="workingEnvironmentFeedback">
                                            </div>

                                            <!-- Extra Benefits Rating -->
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="mb-0">Extra benefits/allowances rating?</label>
                                                    <div class="rating">
                                                        <input type="radio" id="benefits-5" name="benefitsRating"><label for="benefits-5">&#9733;</label>
                                                        <input type="radio" id="benefits-4" name="benefitsRating"><label for="benefits-4">&#9733;</label>
                                                        <input type="radio" id="benefits-3" name="benefitsRating"><label for="benefits-3">&#9733;</label>
                                                        <input type="radio" id="benefits-2" name="benefitsRating"><label for="benefits-2">&#9733;</label>
                                                        <input type="radio" id="benefits-1" name="benefitsRating"><label for="benefits-1">&#9733;</label>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" placeholder="benefits Rating feedback" name="benefitsFeedback">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn add-project float-start" id="addExperienceBtn">
                                            + Add Education
                                        </button>
                                        <div class="text-end">
                                            <button type="submit" class="btn text-center skip-btn mx-2" data-current="experience" data-next="training" data-link="trainingLink">Skip</button>
                                            <button type="button" class="btn text-center next-btn" id="submitExperience">Save & Continue</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Trainings Section (Initially hidden) -->
                        <div id="training" class="section-content" style="display:none;">
                            <h4 class="mb-3 your-project-text">Trainings/Certification</h4>
                            <div class="card p-3">
                                <form id="trainingForm" enctype="multipart/form-data">
                                    @csrf
                                    <h3>Certification</h3>
                                    <div class="row mb-3">
                                        <div class="col-md-12 mb-3">
                                            <label for="training-title" class="form-label">Training/Certification
                                                Title</label>
                                            <input type="text" class="form-control custom-input" name="trainingTitle"
                                                id="training-title" placeholder="" required>

                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="training-organization"
                                                class="form-label">Institution/Organization</label>
                                            <input type="text" class="form-control custom-input" name="institutionName"
                                                id="training-organization" placeholder="" required>

                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="training-date" class="form-label">Completion Date</label>
                                            <input type="date" class="form-control custom-input" name="completionDate"
                                                id="training-date" placeholder="" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <p class="flex-grow-1 my-auto text-black-50 mb-0" style="font-size: 0.9rem;">Upload Training certificate</p>

                                            <!-- Image upload trigger -->
                                            <div class="d-flex align-items-center gap-2">
                                                <label for="certificate" class="primary_color_text m-0" style="cursor: pointer;">
                                                    <i class="fa-solid fa-image fa-lg"></i>
                                                </label>
                                                <input type="file" id="certificate" accept="image/*" class="d-none form-control custom-input" name="certificate">
                                            </div>
                                        </div>
                                        <!-- Image Preview (small) -->
                                        <div id="imgPreview" class="d-flex mt-1" style="height: 80px;"></div>
                                    </div>
                                    <script>
                                        const certificate = document.getElementById('certificate');
                                        const imgPreview = document.getElementById('imgPreview');

                                        certificate.addEventListener('change', (event) => {
                                            const file = event.target.files[0];
                                            if (file && file.type.startsWith('image/')) {
                                                const reader = new FileReader();
                                                reader.onload = function(e) {
                                                    imgPreview.innerHTML = `
                                    <img src="${e.target.result}" alt="Preview" style="height: 100%; width: 30%; border-radius: 6px; object-fit: cover;">
                                    `;
                                                };
                                                reader.readAsDataURL(file);
                                            } else {
                                                imgPreview.innerHTML = '';
                                            }
                                        });
                                    </script>
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn add-project float-start" id="addTraining">
                                            + Add Training
                                        </button>
                                        <div class="text-end">
                                            <button type="submit" class="btn text-center skip-btn mx-2" data-current="training" data-next="language" data-link="languageLink">Skip</button>
                                            <button type="button" class="btn text-center next-btn" id="submitTraining">Save & Continue</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <!--Language-->
                        <div id="language" class="section-content" style="display:none;">
                            <h4 class="mb-3 your-project-text">Language Proficiency</h4>
                            <div class="card p-3">
                                <form id="languageForm">
                                    @csrf
                                    <h3>Language</h3>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input type="text" class="form-control custom-input border-end-0"
                                                    id="Language" placeholder="Language" name="languageName" required>

                                                <select class="form-select custom-input border-start-0 text-end me-3"
                                                    id="languageLevel" name="languageProficiency">
                                                    <option>Beginner</option>
                                                    <option>Intermediate</option>
                                                    <option>Proficient</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn add-project float-start" id="addLanguage">
                                        + Add Language
                                    </button>
                                    <div class="text-end">
                                        <button type="submit" class="btn text-center skip-btn mx-2">Skip</button>
                                        <button type="button" class="btn text-center next-btn" id="submitLanguage">Save & Continue</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Overview Section -->
        <div class="col-md-3 col-lg-3 col-sm-12 col-12">

        </div>

        </div>

        </div>
    </section>

    <style>
        /* Custom button styling */
        .next-btn {
            border: 1px solid #0064a7 !important;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            background-color: #0064A7;
            transition: all 0.3s ease-in-out;
        }

        .next-btn:hover {
            background-color: #fff;
            color: #000;
        }
    </style>
</main>
@endsection

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
        // If needed, you can still do additional setup here
    });
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll(".profile-link");
        links.forEach(link => {
            link.addEventListener("click", (e) => {
                e.preventDefault();

                links.forEach(l => l.classList.remove("active"));

                link.classList.add("active");

                const sectionId = link.getAttribute('data-sectionId')

                console.log(sectionId)

                const sections = document.querySelectorAll(".section-content");
                sections.forEach(section => section.style.display = "none");
                const targetSection = document.getElementById(sectionId);
                targetSection.style.display = "block";

            });
        });

        function skipSection(currentSectionId, nextSectionId, linkId) {
            document.getElementById(currentSectionId).style.display = 'none'; // Hide current section
            document.getElementById(nextSectionId).style.display = 'block'; // Show next section
            document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
            document.getElementById(linkId).classList.add('active');
            console.log(`Skipped ${currentSectionId} and moved to ${nextSectionId}!`);
        }

        document.body.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('skip-btn')) {
                const currentSection = e.target.getAttribute('data-current');
                const nextSection = e.target.getAttribute('data-next');
                const linkId = e.target.getAttribute('data-link');
                skipSection(currentSection, nextSection, linkId);
            }
        });
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

        document.getElementById('visaForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            const formData = new FormData(this);
            console.log('Form Submitted'); // Add this line for debugging

            fetch("{{ route('visas.store') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    console.log(response);
                    return response.json(); // This might throw the error
                })
                .then(data => {
                    console.log(data); // Log the JSON data here
                    if (data.success) {
                        document.getElementById('visa').style.display = 'none';
                        document.getElementById('education').style.display = 'block';
                        document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                        document.getElementById('educationLink').classList.add('active');
                    } else {
                        alert("Error saving profile.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        // Simply collects form data without validation
        function collectEducationData() {
            return {
                schoolName: document.getElementsByName('schoolName')[0].value,
                degree: document.getElementsByName('degree')[0].value,
                city: document.getElementsByName('city')[0].value,
                startDate: document.getElementsByName('startDate')[0].value,
                graduationDate: document.getElementsByName('graduationDate')[0].value,
                educationDescription: document.getElementsByName('educationDescription')[0].value
            };
        }

        async function saveEducationData(educationData) {
            console.log("Sending data:", educationData); // Debug log
            try {
                const response = await fetch("{{ route('educations.store') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(educationData) // Changed from {education: [educationData]}
                });
                const result = await response.json();
                console.log("Server response:", result); // Debug log
                return result;
            } catch (error) {
                console.error("Error saving data:", error);
                return {
                    success: false
                };
            }
        }

        document.getElementById('educationForm').addEventListener('submit', function(e) {
            e.preventDefault();
        });

        document.getElementById('addEducation').addEventListener('click', async function(e) {
            e.preventDefault();
            const educationData = collectEducationData();
            console.log("Collected data:", educationData); // Debug log
            const result = await saveEducationData(educationData);
            if (result.success) {
                document.getElementById('educationForm').reset();
                console.log("Education added successfully!");
            }
        });

        document.getElementById('submitEducation').addEventListener('click', async function(e) {
            e.preventDefault();
            const educationData = collectEducationData();
            console.log("Collected data:", educationData); // Debug log
            const result = await saveEducationData(educationData);
            if (result.success) {
                document.getElementById('education').style.display = 'none';
                document.getElementById('project').style.display = 'block';
                document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                document.getElementById('projectLink').classList.add('active');
                console.log("Saved and moved to next section!");
            }
        });

        function collectProjectData() {
            return {
                projectTitle: document.getElementsByName('projectTitle')[0].value,
                projectLink: document.getElementsByName('projectLink')[0].value,
                projectDescription: document.getElementsByName('projectDescription')[0].value
            };
        }

        async function saveProjectData(projectData) {
            console.log("Sending project data:", projectData); // Debug log
            try {
                const response = await fetch("{{ route('projects.store') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(projectData)
                });
                const result = await response.json();
                console.log("Server response:", result); // Debug log
                return result;
            } catch (error) {
                console.error("Error saving project data:", error);
                return {
                    success: false
                };
            }
        }
        document.getElementById('submitProject').addEventListener('click', async function(e) {
            e.preventDefault();
            const projectData = collectProjectData();
            console.log("Collected project data:", projectData); // Debug log
            try {
                const result = await saveProjectData(projectData);
                if (result.success) {
                    document.getElementById('project').style.display = 'none';
                    document.getElementById('skill').style.display = 'block'; // Assuming next section is 'experience'
                    document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                    document.getElementById('skillLink').classList.add('active');
                    console.log("Project saved and moved to skill section!");
                } else {
                    console.log("Error saving project:", result);
                }
            } catch (error) {
                console.error("Error in saving project:", error);
            }
        });

        // document.getElementById('projectForm').addEventListener('submit', function(e) {
        //     e.preventDefault();
        // });

        document.getElementById('addProject').addEventListener('click', async function(e) {
            e.preventDefault(); // Always prevent default form submission behavior

            try {
                const result = await saveProjectData(collectProjectData());
                console.log(result.success);

                if (result.success) {
                    const form = document.getElementById('projectForm');

                    // Debugging: Check if form exists
                    console.log('Form element:', form);

                    if (form) {
                        // Method 1: Standard reset (preferred)
                        form.reset();

                        // Method 2: Manual reset (fallback)
                        // const inputs = form.querySelectorAll('input, textarea');
                        // inputs.forEach(input => input.value = '');

                        console.log("Project added successfully!");
                    } else {
                        console.error("Error: Form not found in DOM");
                    }
                } else {
                    console.log("Error saving project:", result);
                }
            } catch (error) {
                console.error("Error in saving project:", error);
            }
        });


        // Collect skill data from the form
        function collectSkillData() {
            return {
                skillName: document.getElementsByName('skillName')[0].value,
                skillProficiency: document.getElementsByName('skillProficiency')[0].value
            };
        }

        // Save skill data to the server
        async function saveSkillData(skillData) {
            console.log("Sending skill data:", skillData); // Debug log
            try {
                const response = await fetch("{{ route('skills.store') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(skillData)
                });
                const result = await response.json();
                console.log("Server response:", result); // Debug log
                return result;
            } catch (error) {
                console.error("Error saving skill data:", error);
                return {
                    success: false
                };
            }
        }

        // Prevent default form submission
        document.getElementById('skillForm').addEventListener('submit', function(e) {
            e.preventDefault();
        });

        // Add Skill button handler
        document.getElementById('addSkill').addEventListener('click', async function(e) {
            e.preventDefault();
            const skillData = collectSkillData();
            console.log("Collected skill data:", skillData); // Debug log
            try {
                const result = await saveSkillData(skillData);
                if (result.success) {
                    // Reset the form after saving
                    const form = document.getElementById('skillForm');
                    const formData = new FormData(form);
                    for (let [name, _] of formData) {
                        const input = form.querySelector(`[name="${name}"]`);
                        if (input) input.value = '';
                    }
                    console.log("Skill added successfully!");
                } else {
                    console.log("Error saving skill:", result);
                }
            } catch (error) {
                console.error("Error saving skill:", error);
            }
        });
        document.getElementById('submitSkill').addEventListener('click', async function(e) {
            e.preventDefault();
            const skillData = collectSkillData();
            console.log("Collected skill data:", skillData); // Debug log
            try {
                const result = await saveSkillData(skillData);
                if (result.success) {
                    document.getElementById('skill').style.display = 'none';
                    document.getElementById('achievement').style.display = 'block'; // Assuming next section is 'experience'
                    document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                    document.getElementById('achievementLink').classList.add('active');
                    console.log("Skill saved and moved to experience section!");
                } else {
                    console.log("Error saving skill:", result);
                }
            } catch (error) {
                console.error("Error in saving skill:", error);
            }
        });

        // Save and Continue (Next) button handler
        // Collect Achievement Data
        function collectAchievementData() {
            return {
                achievementTitle: document.getElementsByName('achievementTitle')[0].value,
                achievementDescription: document.getElementsByName('achievementDescription')[0].value
            };
        }

        // Save Achievement Data to the server
        async function saveAchievementData(achievementData) {
            console.log("Sending achievement data:", achievementData); // Debug log
            try {
                const response = await fetch("{{ route('achievements.store') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(achievementData)
                });
                const result = await response.json();
                console.log("Server response:", result); // Debug log
                return result;
            } catch (error) {
                console.error("Error saving achievement data:", error);
                return {
                    success: false
                };
            }
        }

        // Prevent default form submission
        document.getElementById('achievementForm').addEventListener('submit', function(e) {
            e.preventDefault();
        });

        // Add Achievement button handler
        document.getElementById('addAchievement').addEventListener('click', async function(e) {
            e.preventDefault();
            const achievementData = collectAchievementData();
            console.log("Collected achievement data:", achievementData); // Debug log
            try {
                const result = await saveAchievementData(achievementData);
                if (result.success) {
                    // Reset the form after saving
                    const form = document.getElementById('achievementForm');
                    const formData = new FormData(form);
                    for (let [name, _] of formData) {
                        const input = form.querySelector(`[name="${name}"]`);
                        if (input) input.value = '';
                    }
                    console.log("Achievement added successfully!");
                } else {
                    console.log("Error saving achievement:", result);
                }
            } catch (error) {
                console.error("Error saving achievement:", error);
            }
        });

        // Save and Continue (Next) button handler
        document.getElementById('submitAchievement').addEventListener('click', async function(e) {
            e.preventDefault();
            const achievementData = collectAchievementData();
            console.log("Collected achievement data:", achievementData); // Debug log
            try {
                const result = await saveAchievementData(achievementData);
                if (result.success) {
                    document.getElementById('achievement').style.display = 'none';
                    document.getElementById('experience').style.display = 'block'; // Assuming next section is 'experience'
                    document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                    document.getElementById('experienceLink').classList.add('active');
                    console.log("Achievement saved and moved to experience section!");
                } else {
                    console.log("Error saving achievement:", result);
                }
            } catch (error) {
                console.error("Error in saving achievement:", error);
            }
        });

        function collectExperienceData() {
            return {
                jobTitle: document.getElementsByName('jobTitle')[0].value,
                companyName: document.getElementsByName('companyName')[0].value,
                location: document.getElementsByName('location')[0].value,
                startDate: document.getElementsByName('startDate')[0].value,
                endDate: document.getElementsByName('endDate')[0].value,
                experienceDescription: document.getElementsByName('experienceDescription')[0].value,
                salaryRating: document.querySelector('input[name="salaryRating"]:checked') ? document.querySelector('input[name="salaryRating"]:checked').id : '',
                salaryFeedback: document.getElementsByName('salaryFeedback')[0].value,
                workingEnvironmentRating: document.querySelector('input[name="workingEnvironmentRating"]:checked') ? document.querySelector('input[name="workingEnvironmentRating"]:checked').id : '',
                workingEnvironmentFeedback: document.getElementsByName('workingEnvironmentFeedback')[0].value,
                benefitsRating: document.querySelector('input[name="benefitsRating"]:checked') ? document.querySelector('input[name="benefitsRating"]:checked').id : '',
                benefitsFeedback: document.getElementsByName('benefitsFeedback')[0].value
            };
        }

        async function saveExperienceData(experienceData) {
            console.log("Sending experience data:", experienceData); // Debug log
            try {
                const response = await fetch("{{ route('experiences.store') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(experienceData)
                });
                const result = await response.json();
                console.log("Server response:", result); // Debug log
                return result;
            } catch (error) {
                console.error("Error saving experience data:", error);
                return {
                    success: false
                };
            }
        }

        // Prevent default form submission
        document.getElementById('experienceForm').addEventListener('submit', function(e) {
            e.preventDefault();
        });

        // Add Experience button handler
        document.getElementById('addExperienceBtn').addEventListener('click', async function(e) {
            e.preventDefault();
            const experienceData = collectExperienceData();
            console.log("Collected experience data:", experienceData); // Debug log
            try {
                const result = await saveExperienceData(experienceData);
                if (result.success) {
                    // Reset the form after saving
                    const form = document.getElementById('experienceForm');
                    const formData = new FormData(form);
                    for (let [name, _] of formData) {
                        const input = form.querySelector(`[name="${name}"]`);
                        if (input) input.value = '';
                    }
                    console.log("Experience added successfully!");
                } else {
                    console.log("Error saving experience:", result);
                }
            } catch (error) {
                console.error("Error saving experience:", error);
            }
        });

        // Save and Continue (Next) button handler
        document.getElementById('submitExperience').addEventListener('click', async function(e) {
            e.preventDefault();
            const experienceData = collectExperienceData();
            console.log("Collected experience data:", experienceData); // Debug log
            try {
                const result = await saveExperienceData(experienceData);
                if (result.success) {
                    document.getElementById('experience').style.display = 'none';
                    document.getElementById('training').style.display = 'block';
                    document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                    document.getElementById('trainingLink').classList.add('active');
                    console.log("Experience saved and moved to next section!");
                } else {
                    console.log("Error saving experience:", result);
                }
            } catch (error) {
                console.error("Error in saving experience:", error);
            }
        });
        // Collecting Training Form Data
        function collectTrainingData() {
            return {
                trainingTitle: document.getElementById('training-title').value,
                institutionName: document.getElementById('training-organization').value,
                completionDate: document.getElementById('training-date').value,
                certificate: document.getElementById('certificate').files[0], // Handle file upload
            };
        }

        // Save Training Data to the Server
        async function saveTrainingData(trainingData) {
            console.log("Sending training data:", trainingData); // Debug log
            const formData = new FormData();
            formData.append('trainingTitle', trainingData.trainingTitle);
            formData.append('institutionName', trainingData.institutionName);
            formData.append('completionDate', trainingData.completionDate);
            if (trainingData.certificate) {
                formData.append('certificate', trainingData.certificate);
            }

            try {
                const response = await fetch("{{ route('trainings.store') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: formData,
                });

                const result = await response.json();
                console.log("Server response:", result); // Debug log
                return result;
            } catch (error) {
                console.error("Error saving training data:", error);
                return {
                    success: false
                };
            }
        }

        // Prevent Default Form Submission
        document.getElementById('trainingForm').addEventListener('submit', function(e) {
            e.preventDefault();
        });

        // Add Training Button Handler
        document.getElementById('addTraining').addEventListener('click', async function(e) {
            e.preventDefault();
            const trainingData = collectTrainingData();
            console.log("Collected training data:", trainingData); // Debug log
            try {
                const result = await saveTrainingData(trainingData);
                if (result.success) {
                    // Reset the form after saving
                    const form = document.getElementById('trainingForm');
                    form.reset();
                    imgPreview.innerHTML = ''; // Clear image preview
                    console.log("Training added successfully!");
                } else {
                    console.log("Error saving training:", result);
                }
            } catch (error) {
                console.error("Error saving training:", error);
            }
        });

        // Save and Continue (Next) Button Handler
        document.getElementById('submitTraining').addEventListener('click', async function(e) {
            e.preventDefault();
            const trainingData = collectTrainingData();
            console.log("Collected training data:", trainingData); // Debug log
            try {
                const result = await saveTrainingData(trainingData);
                if (result.success) {
                    document.getElementById('training').style.display = 'none';
                    document.getElementById('language').style.display = 'block'; // Assuming next section is 'nextSection'
                    document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                    document.getElementById('languageLink').classList.add('active');
                    console.log("Training saved and moved to next section!");
                } else {
                    console.log("Error saving training:", result);
                }
            } catch (error) {
                console.error("Error in saving training:", error);
            }
        });


        // Collect language data from form
        function collectLanguageData() {
            return {
                languageName: document.getElementsByName('languageName')[0].value,
                languageProficiency: document.getElementsByName('languageProficiency')[0].value
            };
        }

        // Save language data to the server
        async function saveLanguageData(languageData) {
            console.log("Sending language data:", languageData); // Debug log
            try {
                const response = await fetch("{{ route('languages.store') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(languageData)
                });
                const result = await response.json();
                console.log("Server response:", result); // Debug log
                return result;
            } catch (error) {
                console.error("Error saving language data:", error);
                return {
                    success: false
                };
            }
        }

        // Prevent default form submission
        document.getElementById('languageForm').addEventListener('submit', function(e) {
            e.preventDefault();
        });

        // Add Language button handler
        document.getElementById('addLanguage').addEventListener('click', async function(e) {
            e.preventDefault();
            const languageData = collectLanguageData();
            console.log("Collected language data:", languageData); // Debug log
            try {
                const result = await saveLanguageData(languageData);
                if (result.success) {
                    // Reset the form after saving
                    const form = document.getElementById('languageForm');
                    const formData = new FormData(form);
                    for (let [name, _] of formData) {
                        const input = form.querySelector(`[name="${name}"]`);
                        if (input) input.value = '';
                    }
                    console.log("Language added successfully!");
                } else {
                    console.log("Error saving language:", result);
                }
            } catch (error) {
                console.error("Error saving language:", error);
            }
        });

        // Submit button (Save and continue)
        document.querySelector('#submitLanguage').addEventListener('click', async function(e) {
            e.preventDefault();
            const languageData = collectLanguageData();
            console.log("Collected language data:", languageData); // Debug log
            try {
                const result = await saveLanguageData(languageData);
                if (result.success) {
                    document.getElementById('language').style.display = 'none';
                    document.getElementById('profile').style.display = 'block'; // change 'nextSectionId' to your next form id
                    document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                    document.getElementById('profileLink').classList.add('active'); // change 'nextSectionLinkId' accordingly
                    console.log("Language saved and moved to next section!");
                } else {
                    console.log("Error saving language:", result);
                }
            } catch (error) {
                console.error("Error in saving language:", error);
            }
        });

    });
</script>
@endpush