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
                                        <img id="profilePreview" class="profile-picture border border-secondary" alt="Profile Picture">

                                        <!-- Upload Button -->
                                        <label for="profileUpload" class="btn btn-primary border-0 bg-transparent"
                                            style="color:#0064A7;">
                                            <i class="fas fa-upload"></i> Upload Your Image
                                        </label>
                                        <input type="file" class="file-input" id="profileUpload" name="profileImg" accept="image/*"

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
                                        <button type="submit" class="btn next-btn" id="nextProfile">Next</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Visa Section (Initially hidden) -->
                        <div id="visa" class="section-content" style="display:none;">
                            <h4 class="mb-3 your-project-text">Visa</h4>
                            <div class="card p-3">
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
                                    <button type="submit" class="btn next-btn float-end"
                                        id="submitVisa">Next</button>
                                </form>
                            </div>
                        </div>


                        <style>
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

                            .custom-orange {
                                color: #FAAC24 !important;
                            }
                        </style>

                        <!--Education Section-->
                        <div id="education" class="section-content" style="display: none;">
                            <h4 class="mb-3 your-project-text">Your Education</h4>
                            <div class="card p-4">
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
                                    <button type="button" class="btn add-project float-start" id="addEducation">+
                                        Add
                                        Education</button>
                                    <button type="submit" class="btn next-btn float-end"
                                        id="submitEducation">Next</button>
                                </form>
                            </div>
                            <div id="overviewEducation" class="mt-4"></div>
                            <div class="container mt-4">
                                <!-- Display existing education records (skipping the first one) -->
                                @if ($educations->count() > 0)
                                @foreach ($educations as $education)
                                <div class="card mb-3">
                                    <div class="card-header">
                                        {{ $education->schoolName ?? 'School Name' }}
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Degree:</strong> {{ $education->degree ?? 'N/A' }}</p>
                                        <p><strong>City:</strong> {{ $education->city ?? 'N/A' }}</p>
                                        <p><strong>Start Date:</strong> {{ $education->startDate ?? 'N/A' }}</p>
                                        <p><strong>Graduation Date:</strong> {{ $education->graduationDate ?? 'N/A' }}</p>
                                        <p><strong>Summary:</strong> {{ $education->educationDescription ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>

                        </div>

                        <!-- Project Section (Initially Hidden) -->
                        <div id="project" class="section-content" style="display:none;">
                            <h4 class="mb-3 your-project-text">Your Projects</h4>
                            <div class="card card-center">
                                <form id="projectForm">
                                    @csrf
                                    <div class="mb-3">
                                        <h1>Projects</h1>
                                        <label class="form-label">Project Title</label>
                                        <input type="text" class="form-control custom-input" name="projectTitle" id="projectTitle"
                                            placeholder="" required>
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
                                    <button type="button" id="addProject" class="btn add-project">+ Add
                                        Project</button>
                                    <button type="submit" id="submitProject"
                                        class="btn next-btn btn-primary float-end">Next</button>
                                </form>
                            </div>
                            <div id="overviewProject"></div>
                            <div class="container mt-4">
                                <!-- Display additional project entries -->
                                @if ($projects->count() > 0)
                                @foreach ($projects as $project)
                                <div class="card mb-3">
                                    <div class="card-header">
                                        {{ $project->projectTitle ?? 'Project Title' }}
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Project Link:</strong>
                                            @if ($project->projectLink)
                                            <a href="{{ $project->projectLink }}" target="_blank">{{ $project->projectLink }}</a>
                                            @else
                                            N/A
                                            @endif
                                        </p>
                                        <p><strong>Description:</strong> {{ $project->projectDescription ?? 'No description provided.' }}</p>
                                    </div>
                                </div>
                                @endforeach
                                @endif
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
                                    <button type="button" class="btn add-project float-start" id="addSkill">+ Add
                                        Skill</button>
                                    <button type="submit" class="btn next-btn float-end"
                                        id="submitSkills">Next</button>
                                </form>
                            </div>
                            <div>
                                @if ($skills->count() > 0)
                                @foreach ($skills as $skill)
                                <input type="text" class="form-control custom-input border-end-0"
                                    name="skillName[]" value="{{ $skill->skillName }}" placeholder="Skill" required>

                                <select class="form-select custom-input border-start-0 text-end me-3"
                                    name="skillProficiency[]" required>
                                    <option value="Beginner" {{ $skill->proficiency == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                    <option value="Intermediate" {{ $skill->proficiency == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                    <option value="Advanced" {{ $skill->proficiency == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                </select>
                                @endforeach
                                @endif
                            </div>
                            <div id="overviewSkill"></div>


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

                                    <button type="button" class="btn add-project float-start"
                                        id="addAchievement">+
                                        Add Achievement</button>
                                    <button type="submit" class="btn next-btn float-end"
                                        id="submitAchievement">Next</button>
                                </form>
                            </div>
                            @if ($achievements->count() > 0)
                            @foreach ($achievements as $achievement)
                            <div class="mb-3 achievement-entry">
                                <label class="form-label">Achievement Name</label>
                                <input type="text" class="form-control custom-input" name="achievementName" value="{{ $achievement->achievementName ?? '' }}" placeholder="Achievement Name" required>

                                <label class="form-label">Achievement Description</label>
                                <textarea class="form-control custom-input" name="achievementDescription" placeholder="Describe your achievement...">{{ $achievement->achievementDescription }}</textarea>
                            </div>
                            @endforeach
                            @endif

                            <div id="overviewAchievement"></div>
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

                                    <button type="button" class="btn add-project float-start"
                                        id="addExperienceBtn">+
                                        Add Experience</button>
                                    <button type="submit" class="btn next-btn float-end"
                                        id="submitExperience">Next</button>
                                </form>
                            </div>
                            @if ($experiences->count() > 0)
                            @foreach ($experiences as $exp)
                            <div class="card p-3 mt-3">
                                <h4 class="mb-3 your-project-text">Additional Experience</h4>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="experience-job-title-{{ $loop->index }}" class="form-label">Job Title</label>
                                        <input type="text" class="form-control custom-input"
                                            name="jobTitle[]" placeholder="Software Engineer" value="{{ $exp->jobTitle ?? '' }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Company Name</label>
                                        <input type="text" class="form-control custom-input"
                                            name="companyName[]" placeholder="Google Inc." value="{{ $exp->companyName ?? '' }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Location</label>
                                        <input type="text" class="form-control custom-input"
                                            name="location[]" placeholder="San Francisco, CA" value="{{ $exp->location ?? ''}}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" class="form-control custom-input"
                                            name="startDate[]" value="{{ $exp->startDate ?? '' }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">End Date</label>
                                        <input type="date" class="form-control custom-input"
                                            name="endDate[]" value="{{ $exp->endDate ?? '' }}" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control custom-input" name="experienceDescription[]" rows="3"
                                            required>{{ $exp->experienceDescription ?? '' }}</textarea>
                                    </div>

                                    <div>
                                        <p>Optional <span class="custom-orange">(It will not be shown on your resume):</span></p>

                                        <label class="mb-0">Salary Rating</label>
                                        <div class="rating mb-2">
                                            @for ($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="salary-{{ $i }}-{{ $loop->index }}" name="salaryRating[{{ $loop->index }}]" value="{{ $i }}" {{ $exp->salaryRating == $i ? 'checked' : '' }}>
                                            @endfor
                                        </div>
                                        <input type="text" class="form-control" name="salaryFeedback[]" placeholder="Salary feedback" value="{{ $exp->salaryFeedback }}">

                                        <label class="mt-3 mb-0">Working Environment</label>
                                        <div class="rating mb-2">
                                            @for ($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="work-{{ $i }}-{{ $loop->index }}" name="workingEnvironmentRating[{{ $loop->index }}]" value="{{ $i }}" {{ $exp->workingEnvironmentRating == $i ? 'checked' : '' }}>
                                            <label for="work-{{ $i }}-{{ $loop->index }}">&#9733;</label>
                                            @endfor
                                        </div>
                                        <input type="text" class="form-control" name="workingEnvironmentFeedback[]" placeholder="Work feedback" value="{{ $exp->workingEnvironmentFeedback }}">

                                        <label class="mt-3 mb-0">Benefits Rating</label>
                                        <div class="rating mb-2">
                                            @for ($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="benefits-{{ $i }}-{{ $loop->index }}" name="benefitsRating[{{ $loop->index }}]" value="{{ $i }}" {{ $exp->benefitsRating == $i ? 'checked' : '' }}>
                                            <label for="benefits-{{ $i }}-{{ $loop->index }}">&#9733;</label>
                                            @endfor
                                        </div>
                                        <input type="text" class="form-control" name="benefitsFeedback[]" placeholder="Benefits feedback" value="{{ $exp->benefitsFeedback ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif

                            <div id="overviewExperience"></div>
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
                                    <button type="button" id="addTraining" class="btn add-project float-start">+ Add Training</button>
                                    <button type="submit" class="btn next-btn float-end"
                                        id="submitTraining">Next</button>
                                </form>
                            </div>
                            <div id="trainingOverview"></div>
                            @if ($trainings->count() > 0)
                            @foreach ($trainings as $training)
                            <div class="training-section border rounded p-3 mb-4">
                                <div class="row mb-3">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Training/Certification Title</label>
                                        <div class="custom-input-wrapper">
                                            <input type="text" class="form-control custom-input" value="{{ $training->trainingTitle ?? '' }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Institution/Organization</label>
                                        <div class="custom-input-wrapper">
                                            <input type="text" class="form-control custom-input" value="{{ $training->institutionName ?? '' }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Completion Date</label>
                                        <div class="custom-input-wrapper">
                                            <input type="date" class="form-control custom-input" value="{{ $training->completionDate ?? '' }}" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="d-flex align-items-center gap-3">
                                        <p class="flex-grow-1 my-auto text-black-50 mb-0" style="font-size: 0.9rem;">Training Certificate</p>
                                        <a href="{{ asset('storage/' . $training->certificate ?? '') }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            View Certificate
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif

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
                                                    <option>Advanced</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn add-project float-start" id="addLanguage">+
                                        Add
                                        Language</button>
                                    <button type="submit" class="btn next-btn float-end fw-semibold">Submit</button>
                                </form>
                            </div>
                            <div id="overviewLanguage"></div>
                            @if ($languages->count() > 0)
                            @foreach ($languages as $language)
                            <div class="input-group mb-3">
                                <input type="text" class="form-control custom-input border-end-0"
                                    placeholder="Language" name="languageName" value="{{ $language->languageName }}" disabled>

                                <select class="form-select custom-input border-start-0 text-end me-3"
                                    name="languageProficiency" disabled>
                                    <option>Beginner</option>
                                    <option>Intermediate</option>
                                    <option>Advanced</option>
                                </select>
                            </div>
                            @endforeach
                            @endif

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
    const educationEntries = [];
    const projectEntries = [];
    const skillEntries = [];
    const achievementEntries = [];
    const experienceEntries = [];
    const trainingEntries = [];
    const languageEntries = [];
    // File upload functionality for Visa section
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

        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
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

        document.getElementById('addEducation').addEventListener('click', function() {

            // Get all values using name attributes
            const educationData = {
                schoolName: document.getElementsByName('schoolName')[0].value,
                degree: document.getElementsByName('degree')[0].value,
                city: document.getElementsByName('city')[0].value,
                startDate: document.getElementsByName('startDate')[0].value,
                graduationDate: document.getElementsByName('graduationDate')[0].value,
                educationDescription: document.getElementsByName('educationDescription')[0].value
            };

            // Add to array
            educationEntries.push(educationData);

            // Show preview
            const previewHTML = `
                <div class="border p-2 mb-2 education-preview" data-index="${educationEntries.length - 1}">
                    <p><strong>School:</strong> ${educationData.schoolName}</p>
                    <p><strong>Degree:</strong> ${educationData.degree}</p>
                    <p><strong>Dates:</strong> ${educationData.startDate} to ${educationData.graduationDate}</p>
                    <button class="btn btn-sm btn-danger remove-btn">Remove</button>
                </div> `;
            document.getElementById('overviewEducation').insertAdjacentHTML('beforeend', previewHTML);

            // Clear form
            const form = document.getElementById('educationForm');
            form.reset();
            document.getElementsByName('schoolName')[0].focus();
        });



        // Submit All Entries
        document.getElementById('educationForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Always check if the form still has unsaved data before submit
            const currentData = {
                schoolName: document.getElementsByName('schoolName')[0].value,
                degree: document.getElementsByName('degree')[0].value,
                city: document.getElementsByName('city')[0].value,
                startDate: document.getElementsByName('startDate')[0].value,
                graduationDate: document.getElementsByName('graduationDate')[0].value,
                educationDescription: document.getElementsByName('educationDescription')[0].value
            };

            // Check if this new data is not already in educationEntries
            const isFormFilled = currentData.schoolName || currentData.degree || currentData.city || currentData.startDate || currentData.graduationDate || currentData.educationDescription;

            if (isFormFilled) {
                educationEntries.push(currentData);
            } else {
                alert("Please fill form to submit");
            }

            fetch("{{ route('educations.store') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        education: educationEntries
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        document.getElementById('education').style.display = 'none';
                        document.getElementById('project').style.display = 'block';
                        document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                        document.getElementById('projectLink').classList.add('active');
                    } else {
                        alert("Error saving education data.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        document.getElementById('overviewEducation').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-btn')) {
                const previewDiv = e.target.closest('.education-preview');
                const index = parseInt(previewDiv.dataset.index);

                // Remove from array
                educationEntries.splice(index, 1);

                // Remove from DOM
                previewDiv.remove();

                // Reindex remaining entries
                document.querySelectorAll('.education-preview').forEach((preview, newIndex) => {
                    preview.dataset.index = newIndex;
                });
            }
        });



        document.getElementById('addProject').addEventListener('click', function() {
            // Get all values using name attributes
            const projectData = {
                projectTitle: document.getElementsByName('projectTitle')[0].value,
                projectLink: document.getElementsByName('projectLink')[0].value,
                projectDescription: document.getElementsByName('projectDescription')[0].value,
            };

            // Add to array
            projectEntries.push(projectData);

            // Show preview
            const previewHTML = `
        <div class="border p-2 mb-2 project-preview" data-index="${projectEntries.length - 1}">
            <p><strong>Project Title:</strong> ${projectData.projectTitle}</p>
            <p><strong>Project Link:</strong> ${projectData.projectLink}</p>
            <p><strong>Description:</strong> ${projectData.projectDescription}</p>
            <button class="btn btn-sm btn-danger remove-btn">Remove</button>
        </div>
    `;
            document.getElementById('overviewProject').insertAdjacentHTML('beforeend', previewHTML); // <-- ID fixed here

            // Clear form
            const form = document.getElementById('projectForm');
            form.reset();
            document.getElementsByName('projectTitle')[0].focus();
        });

        document.getElementById('projectForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            const currentData = {
                projectTitle: document.getElementsByName('projectTitle')[0].value,
                projectLink: document.getElementsByName('projectLink')[0].value,
                projectDescription: document.getElementsByName('projectDescription')[0].value,
            };

            const isFormFilled = currentData.projectTitle || currentData.projectLink || currentData.projectDescription;

            if (isFormFilled) {
                projectEntries.push(currentData);
            }

            fetch("{{ route('projects.store') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        project: projectEntries
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        document.getElementById('project').style.display = 'none';
                        document.getElementById('skill').style.display = 'block';
                        document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                        document.getElementById('skillLink').classList.add('active');
                    } else {
                        alert("Error saving project data.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        document.getElementById('overviewProject').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-btn')) {
                const previewDiv = e.target.closest('.project-preview');
                const index = parseInt(previewDiv.dataset.index);

                // Remove from array
                projectEntries.splice(index, 1);

                // Remove from DOM
                previewDiv.remove();

                // Reindex remaining entries
                document.querySelectorAll('.project-preview').forEach((preview, newIndex) => {
                    preview.dataset.index = newIndex;
                });
            }
        });

        document.getElementById('addSkill').addEventListener('click', function() {
            const skillData = {
                skillName: document.getElementsByName('skillName')[0].value,
                skillProficiency: document.getElementsByName('skillProficiency')[0].value,
            };

            skillEntries.push(skillData);

            const previewHTML = `
                <div class="border p-2 mb-2 skill-preview" data-index="${skillEntries.length - 1}">
                    <p><strong>Skill Name:</strong> ${skillData.skillName}</p>
                    <p><strong>Skill Proficiency:</strong> ${skillData.skillProficiency}</p>
                    <button class="btn btn-sm btn-danger remove-btn">Remove</button>
                </div>
                    `;
            document.getElementById('overviewSkill').insertAdjacentHTML('beforeend', previewHTML);

            const form = document.getElementById('skillForm');
            form.reset();
            document.getElementsByName('skillName')[0].focus();
        });

        document.getElementById('skillForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            const currentData = {
                skillName: document.getElementsByName('skillName')[0].value,
                skillProficiency: document.getElementsByName('skillProficiency')[0].value,
            };

            const isFormFilled = currentData.skillName || currentData.skillProficiency
            if (isFormFilled) {
                skillEntries.push(currentData);
            }

            fetch("{{ route('skills.store') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        skill: skillEntries
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        document.getElementById('skill').style.display = 'none';
                        document.getElementById('achievement').style.display = 'block';
                        document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                        document.getElementById('achievementLink').classList.add('active');
                    } else {
                        alert("Error saving skill data.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
        document.getElementById('overviewSkill').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-btn')) {
                const previewDiv = e.target.closest('.skill-preview');
                const index = parseInt(previewDiv.dataset.index);

                // Remove from array
                skillEntries.splice(index, 1);

                // Remove from DOM
                previewDiv.remove();

                // Reindex remaining entries
                document.querySelectorAll('.skill-preview').forEach((preview, newIndex) => {
                    preview.dataset.index = newIndex;
                });
            }
        });
        document.getElementById('addAchievement').addEventListener('click', function() {
            const achievementdata = {
                achievementTitle: document.getElementsByName('achievementTitle')[0].value,
                achievementDescription: document.getElementsByName('achievementDescription')[0].value,
            };

            achievementEntries.push(achievementdata);

            const previewHTML = `
                <div class="border p-2 mb-2 achievement-preview" data-index="${achievementEntries.length - 1}">
                    <p><strong>AchievementsName:</strong> ${achievementEntries.achievementTitle}</p>
                    <p><strong>Achievement Description:</strong> ${achievementEntries.achievementDescription}</p>
                    <button class="btn btn-sm btn-danger remove-btn">Remove</button>
                </div>
                    `;
            document.getElementById('overviewAchievement').insertAdjacentHTML('beforeend', previewHTML);

            const form = document.getElementById('achievementForm');
            form.reset();
            document.getElementsByName('achievementTitle')[0].focus();
        });

        document.getElementById('achievementForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            const currentData = {
                achievementTitle: document.getElementsByName('achievementTitle')[0].value,
                achievementDescription: document.getElementsByName('achievementDescription')[0].value,
            };

            const isFormFilled = currentData.achievementTitle || currentData.achievementDescription;
            if (isFormFilled) {
                achievementEntries.push(currentData);
            }

            fetch("{{ route('achievements.store') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        achievement: achievementEntries
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        document.getElementById('achievement').style.display = 'none';
                        document.getElementById('experience').style.display = 'block';
                        document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                        document.getElementById('experienceLink').classList.add('active');
                    } else {
                        alert("Error saving skill data.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        document.getElementById('overviewAchievement').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-btn')) {
                const previewDiv = e.target.closest('.achievement-preview');
                const index = parseInt(previewDiv.dataset.index);

                // Remove from array
                achievementEntries.splice(index, 1);

                // Remove from DOM
                previewDiv.remove();

                // Reindex remaining entries
                document.querySelectorAll('.achievement-preview').forEach((preview, newIndex) => {
                    preview.dataset.index = newIndex;
                });
            }
        });
        document.getElementById('addExperienceBtn').addEventListener('click', function() {
            const experienceData = {
                jobTitle: document.getElementsByName('jobTitle')[0].value,
                companyName: document.getElementsByName('companyName')[0].value,
                location: document.getElementsByName('location')[0].value,
                startDate: document.getElementsByName('startDate')[0].value,
                endDate: document.getElementsByName('endDate')[0].value,
                experienceDescription: document.getElementsByName('experienceDescription')[0].value,
                salaryRating: document.querySelector('input[name="salaryRating"]:checked')?.value || '',
                salaryFeedback: document.getElementsByName('salaryFeedback')[0].value,
                workingEnvironmentRating: document.querySelector('input[name="workingEnvironmentRating"]:checked')?.value || '',
                workingEnvironmentFeedback: document.getElementsByName('workingEnvironmentFeedback')[0].value,
                benefitsRating: document.querySelector('input[name="benefitsRating"]:checked')?.value || '',
                benefitsFeedback: document.getElementsByName('benefitsFeedback')[0].value,
            };

            experienceEntries.push(experienceData);

            const previewHTML = `
        <div class="border p-2 mb-2 experience-preview" data-index="${experienceEntries.length - 1}">
            <p><strong>Job Title:</strong> ${experienceData.jobTitle}</p>
            <p><strong>Company:</strong> ${experienceData.companyName}</p>
            <p><strong>Location:</strong> ${experienceData.location}</p>
            <p><strong>Period:</strong> ${experienceData.startDate} to ${experienceData.endDate}</p>
            <p><strong>Description:</strong> ${experienceData.experienceDescription}</p>
            <button class="btn btn-sm btn-danger remove-btn">Remove</button>
        </div>
    `;
            document.getElementById('overviewExperience').insertAdjacentHTML('beforeend', previewHTML);

            document.getElementById('experienceForm').reset();
            document.getElementsByName('jobTitle')[0].focus();
        });

        document.getElementById('experienceForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const currentData = {
                jobTitle: document.getElementsByName('jobTitle')[0].value,
                companyName: document.getElementsByName('companyName')[0].value,
                location: document.getElementsByName('location')[0].value,
                startDate: document.getElementsByName('startDate')[0].value,
                endDate: document.getElementsByName('endDate')[0].value,
                experienceDescription: document.getElementsByName('experienceDescription')[0].value,
                salaryRating: document.querySelector('input[name="salaryRating"]:checked')?.value || '',
                salaryFeedback: document.getElementsByName('salaryFeedback')[0].value,
                workingEnvironmentRating: document.querySelector('input[name="workingEnvironmentRating"]:checked')?.value || '',
                workingEnvironmentFeedback: document.getElementsByName('workingEnvironmentFeedback')[0].value,
                benefitsRating: document.querySelector('input[name="benefitsRating"]:checked')?.value || '',
                benefitsFeedback: document.getElementsByName('benefitsFeedback')[0].value,
            };

            const isFormFilled = currentData.jobTitle || currentData.companyName || currentData.experienceDescription;
            if (isFormFilled) {
                experienceEntries.push(currentData);
            }

            fetch("{{ route('experiences.store') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        experience: experienceEntries
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        document.getElementById('experience').style.display = 'none';
                        document.getElementById('training').style.display = 'block';
                        document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                        document.getElementById('trainingLink').classList.add('active');
                    } else {
                        alert("Error saving experience data.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
        document.getElementById('overviewExperience').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-btn')) {
                const previewDiv = e.target.closest('.experience-preview');
                const index = parseInt(previewDiv.dataset.index);

                // Remove from array
                experienceEntries.splice(index, 1);

                // Remove from DOM
                previewDiv.remove();

                // Reindex remaining entries
                document.querySelectorAll('.experience-preview').forEach((preview, newIndex) => {
                    preview.dataset.index = newIndex;
                });
            }
        });
        document.getElementById('addTraining').addEventListener('click', function() {
            const trainingTitle = document.getElementsByName('trainingTitle')[0].value;
            const institutionName = document.getElementsByName('institutionName')[0].value;
            const completionDate = document.getElementsByName('completionDate')[0].value;
            const certificateFile = document.getElementsByName('certificate')[0].files[0];

            // Validate input fields
            if (!trainingTitle || !institutionName || !completionDate || !certificateFile) {
                alert('Please fill in all the fields and upload a certificate.');
                return;
            }

            trainingEntries.push({
                trainingTitle,
                institutionName,
                completionDate,
                certificateFile
            });

            const previewDiv = document.createElement('div');
            previewDiv.classList.add('training-preview');
            previewDiv.setAttribute('data-index', trainingEntries.length - 1);

            previewDiv.innerHTML = `
                <p>Title: ${trainingTitle}</p>
                <p>Institution: ${institutionName}</p>
                <p>Completion Date: ${completionDate}</p>
                <p>Certificate: ${certificateFile.name}</p>
                <button class="remove-btn">Remove</button>
            `;

            document.getElementById('trainingOverview').appendChild(previewDiv);
            document.getElementById('trainingForm').reset();
            document.getElementsByName('trainingTitle')[0].focus();
        });

        document.getElementById('trainingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData();

            if (trainingEntries.length === 0) {
                // Manually build a single-entry array from form values
                formData.append(`training[0][trainingTitle]`, document.getElementById('trainingTitle').value);
                formData.append(`training[0][institutionName]`, document.getElementById('institutionName').value);
                formData.append(`training[0][completionDate]`, document.getElementById('completionDate').value);
                formData.append(`training[0][certificate]`, document.getElementById('certificate').files[0]);
            } else {
                // Existing logic for multiple entries
                trainingEntries.forEach((entry, index) => {
                    formData.append(`training[${index}][trainingTitle]`, entry.trainingTitle);
                    formData.append(`training[${index}][institutionName]`, entry.institutionName);
                    formData.append(`training[${index}][completionDate]`, entry.completionDate);
                    formData.append(`training[${index}][certificate]`, entry.certificateFile);
                });
            }

            for (let pair of formData.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }

            fetch("{{ route('trainings.store') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('training').style.display = 'none';
                        document.getElementById('language').style.display = 'block';
                        document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                        document.getElementById('languageLink').classList.add('active');
                    } else {
                        alert("Error saving training data.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        // Remove training entry from preview
        document.getElementById('trainingOverview').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-btn')) {
                const previewDiv = e.target.closest('.training-preview');
                const index = parseInt(previewDiv.dataset.index);

                // Remove from array
                trainingEntries.splice(index, 1);

                // Remove from DOM
                previewDiv.remove();

                // Reindex remaining entries
                document.querySelectorAll('.training-preview').forEach((preview, newIndex) => {
                    preview.dataset.index = newIndex;
                });
            }
        });



        document.getElementById('addLanguage').addEventListener('click', function() {
            const languageName = document.getElementsByName('languageName')[0].value;
            const languageProficiency = document.getElementsByName('languageProficiency')[0].value;

            if (!languageName.trim()) {
                alert("Please enter a language name.");
                return;
            }

            const languageData = {
                languageName: languageName,
                languageProficiency: languageProficiency
            };

            languageEntries.push(languageData);

            const previewHTML = `
                <div class="border p-2 mb-2 language-preview" data-index="${languageEntries.length - 1}">
                    <p><strong>Language Name:</strong> ${languageData.languageName}</p>
                    <p><strong>Proficiency:</strong> ${languageData.languageProficiency}</p>
                    <button class="btn btn-sm btn-danger remove-btn" onclick="this.parentElement.remove()">Remove</button>
                </div>
            `;

            document.getElementById('overviewLanguage').insertAdjacentHTML('beforeend', previewHTML);

            // Reset input fields
            document.getElementById('languageForm').reset();
            document.getElementsByName('languageName')[0].focus();
        });

        document.getElementById('languageForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Also add current form data if not already pushed
            const currentLanguage = {
                languageName: document.getElementsByName('languageName')[0].value,
                languageProficiency: document.getElementsByName('languageProficiency')[0].value
            };

            const isFilled = currentLanguage.languageName.trim();
            if (isFilled) {
                languageEntries.push(currentLanguage);
            }

            fetch("{{ route('languages.store') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        languages: languageEntries
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        alert("Resume Submitted Successfully.");
                        document.getElementById('language').style.display = 'none';
                        document.getElementById('profile').style.display = 'block';
                        document.querySelectorAll(".profile-link").forEach(l => l.classList.remove("active"));
                        document.getElementById('profileLink').classList.add('active');
                    } else {
                        alert("Error saving language data.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
        document.getElementById('langaugeOverview').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-btn')) {
                const previewDiv = e.target.closest('.language-preview');
                const index = parseInt(previewDiv.dataset.index);

                // Remove from array
                languageEntries.splice(index, 1);

                // Remove from DOM
                previewDiv.remove();

                // Reindex remaining entries
                document.querySelectorAll('.language-preview').forEach((preview, newIndex) => {
                    preview.dataset.index = newIndex;
                });
            }
        });
    });
</script>
@endpush