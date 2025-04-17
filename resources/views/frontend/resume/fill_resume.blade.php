@extends('frontend.layouts.main')
@section('title')
    Resume Help
@endsection
@section('content')
    <main>


        <!-- Profile Header -->
        <div class="profile-header">
            <div class="container">
                <h5>Hi, Utsav Dhungana</h5>
                <img src="Images/resume.png" class="resume-img">
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
                                <li><a href="#" class="profile-link active" id="profileLink"
                                        onclick="activateSection('profileLink')"><i class="bi bi-person"></i> Profile
                                        Information<i class="fas fa-angle-right arrow"></i></a></li>
                                <li><a href="#" class="profile-link" id="visaLink"
                                        onclick="activateSection('visaLink')"><i class="bi bi-credit-card"></i> Visa<i
                                            class="fas fa-angle-right arrow"></i></a></li>
                                <li><a href="#" class="profile-link" id="educationLink"
                                        onclick="activateSection('educationLink')"><i class="bi bi-mortarboard"></i>
                                        Education<i class="fas fa-angle-right arrow"></i></a></li>
                                <li><a href="#" class="profile-link" id="projectLink"
                                        onclick="activateSection('projectLink')"><i class="bi bi-clipboard-check"></i>
                                        Project<i class="fas fa-angle-right arrow"></i></a></li>
                                <li><a href="#" class="profile-link" id="skillsLink"
                                        onclick="activateSection('skillsLink')"><i class="bi bi-tools"></i> Skills<i
                                            class="fas fa-angle-right arrow"></i></a></li>
                                <li><a href="#" class="profile-link" id="achievementsLink"
                                        onclick="activateSection('achievementsLink')"><i class="bi bi-trophy"></i>
                                        Achievements<i class="fas fa-angle-right arrow"></i></a></li>
                                <li><a href="#" class="profile-link" id="experienceLink"
                                        onclick="activateSection('experienceLink')"><i class="bi bi-briefcase"></i>
                                        Experience<i class="fas fa-angle-right arrow"></i></a></li>
                                <li><a href="#" class="profile-link" id="trainingsLink"
                                        onclick="activateSection('trainingsLink')"><i class="bi bi-journal"></i>
                                        Trainings<i class="fas fa-angle-right arrow"></i></a></li>
                                <li><a href="#" class="profile-link" id="languageLink"
                                        onclick="activateSection('languageLink')"><i class="bi bi-globe"></i> Language<i
                                            class="fas fa-angle-right arrow"></i></a></li>
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
                                <form id="profileForm">
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
                                            <label for="first-name" class="form-label">First Name</label>
                                            <input type="text" class="form-control custom-input" id="first-name"
                                                placeholder="Enter your First Name">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="last-name" class="form-label">Last Name</label>
                                            <input type="text" class="form-control custom-input" id="last-name"
                                                placeholder="Enter your Last Name">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="designation" class="form-label">Designation <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control custom-input" id="designation"
                                                placeholder="Enter your Position" />
                                        </div>
                                    </div>

                                    <!-- Row 3: Country and Address -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="address" class="form-label">Address <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control custom-input" id="address"
                                                placeholder="Enter your Address" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="country" class="form-label">Country <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control custom-input" id="country"
                                                placeholder="Enter your Nationality" />
                                        </div>
                                    </div>

                                    <!-- Row 4: Email & Phone -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control custom-input" id="email"
                                                placeholder="Enter your Email" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label">Phone <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control custom-input" id="phone"
                                                placeholder="Enter your Phone" />
                                        </div>
                                    </div>

                                    <!-- Row 5: Summary (Full Width) -->
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="summary" class="form-label">Summary <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control custom-input" id="summary" rows="3"
                                                placeholder="Give summary of your personal Information..."></textarea>
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
                                <form>
                                    <h3>Visa Details</h3>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="first-name" class="form-label">Visa Details</label>
                                            <input type="text" class="form-control custom-input" id="first-name"
                                                placeholder="California University">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6 mb-3">
                                            <label for="date" class="form-label">Visa Expiry <span
                                                    class="">*</span></label>
                                            <input type="date" class="form-control custom-input" id="date"
                                                placeholder="Bachelor" />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="Country" class="form-label">Country <span
                                                    class="">*</span></label>
                                            <input type="text" class="form-control custom-input" id="Country"
                                                placeholder="Pokhara" />
                                        </div>
                                        <div class="col-md-12 Upload-visa-image upload-container pt-5 pb-5">
                                            <p>Upload Visa Image</p>
                                            <div class="upload-box" id="drop-zone">
                                                <i class="fas fa-file-upload" id="upload-icon"></i>
                                                <p id="choose-file-text" class="choose-file-text">
                                                    Drag and Drop a file here or
                                                    <a href="#" class="text-underline-offset">Choose file</a>
                                                </p>
                                                <img id="preview-image" class="hidden" placeholder="Choose File">
                                                <input type="file" id="file-input" accept="image/*" class="hidden">
                                                <!-- Hidden file input -->
                                            </div>
                                            <p id="error-message" class="hidden" style="color: red;"></p>
                                            <!-- Error message -->
                                        </div>
                                    </div>
                                    <button type="submit" class="btn next-btn float-end" id="submitVisa">Next</button>
                                </form>
                            </div>
                        </div>

                        <style>
                            /* Upload photo  */
                            /* Hide error message and file input by default */
                            .hidden {
                                display: none !important;
                            }

                            /* Hide the file input completely */
                            #file-input {
                                display: none;
                            }

                            .upload-box {
                                border: 2px dashed #0064A7;
                                max-width: 100%;
                                height: 144px;
                                display: flex;
                                flex-direction: column;
                                /* Stack elements vertically */
                                align-items: center;
                                /* Center elements horizontally */
                                justify-content: center;
                                /* Center vertically */
                                cursor: pointer;
                                position: relative;
                                overflow: hidden;
                                border-radius: 3.5px;
                                background-color: #f9f9f9;
                                text-align: center;
                            }

                            #upload-icon {
                                font-size: 40px;
                                color: #888;
                            }

                            #choose-file-text {
                                font-size: 16px;
                                color: #0064A7;
                                cursor: pointer;
                                margin-top: 10px;
                                display: block;
                            }

                            #preview-image {
                                width: 100%;
                                height: 100%;
                                object-fit: contain;
                                position: absolute;
                                top: 0;
                                left: 0;
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
                                ;
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
                                    <h3>School/Institution</h3>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="schoolName" class="form-label">School Name</label>
                                            <input type="text" class="form-control custom-input" id="schoolName"
                                                placeholder="California University">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="degree" class="form-label">Degree <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control custom-input" id="degree"
                                                placeholder="Bachelor" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="city" class="form-label">City <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control custom-input" id="city"
                                                placeholder="Pokhara" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="startDate" class="form-label">Start Date <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control custom-input" id="startDate"
                                                placeholder="yy-mm-dd" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="gradDate" class="form-label">Graduation Date <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control custom-input" id="gradDate"
                                                placeholder="yy-mm-dd" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="summary" class="form-label">Summary <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control custom-input" id="summary" rows="3"
                                                placeholder="Give a summary of your education..."></textarea>
                                        </div>
                                    </div>
                                    <button type="button" class="btn add-project float-start" id="addEducation">+
                                        Add
                                        Education</button>
                                    <button type="submit" class="btn next-btn float-end"
                                        id="submitEducation">Next</button>
                                </form>
                            </div>
                        </div>

                        <!-- Project Section (Initially Hidden) -->
                        <div id="project" class="section-content">
                            <h4 class="mb-3 your-project-text">Your Projects</h4>
                            <div class="card card-center">
                                <form>
                                    <div class="mb-3">
                                        <h1>Projects</h1>
                                        <label class="form-label">Project Title</label>
                                        <input type="text" class="form-control custom-input" id="projectTitle"
                                            placeholder="">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Project Link</label>
                                        <input type="url" class="form-control custom-input" id="projectLink"
                                            placeholder="">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control custom-input" rows="4" id="projectDescription" placeholder=""></textarea>
                                    </div>
                                    <button type="button" id="addProjectButton" class="btn add-project">+ Add
                                        Project</button>
                                    <button type="submit" id="submitProject"
                                        class="btn next-btn btn-primary float-end">Next</button>
                                </form>
                            </div>
                        </div>

                        <!-- Skills Section (Initially hidden) -->
                        <div id="skills" class="section-content">
                            <h4 class="mb-3 your-project-text ">Your Skills</h4>
                            <div class="card p-3">
                                <form id="skillsForm">
                                    <h3>Skills</h3>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input type="text" class="form-control custom-input border-end-0"
                                                    id="SKill" placeholder="Skill">
                                                <select class="form-select custom-input border-start-0 text-end me-3"
                                                    id="skill">
                                                    <option value="Beginner" selected>Beginner</option>
                                                    <option value="Intermediate">Intermediate</option>
                                                    <option value="Advanced">Advanced</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn add-project float-start" id="addSkillBtn">+ Add
                                        Skill</button>
                                    <button type="submit" class="btn next-btn float-end" id="submitSkills">Next</button>
                                </form>
                            </div>
                        </div>
                        <!-- Achievements Section (Initially hidden) -->
                        <div id="achievements" class="section-content">
                            <h4 class="mb-3 your-project-text">Your Achievements</h4>
                            <div class="card p-3">
                                <form id="achievementsForm">
                                    <h3>Achievements</h3>
                                    <div class="row mb-3 mb-5">
                                        <div class="col-md-12 mb-3">
                                            <label for="achievement-title" class="form-label">Achievement
                                                Title</label>
                                            <input type="text" class="form-control custom-input"
                                                id="achievement-title" placeholder="Enter Achievement Title">
                                        </div>

                                        <div class="col-md-12">
                                            <label for="achievement-description" class="form-label">Description <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control custom-input" id="achievement-description" rows="3"
                                                placeholder="Describe your achievement..."></textarea>
                                        </div>
                                    </div>

                                    <button type="button" class="btn add-project float-start" id="addAchievementBtn">+
                                        Add Achievement</button>
                                    <button type="submit" class="btn next-btn float-end"
                                        id="submitAchievement">Next</button>
                                </form>
                            </div>
                        </div>

                        <!-- Experience Section (Initially hidden) -->
                        <div id="experience" class="section-content">
                            <h4 class="mb-3 your-project-text">Your Experiences</h4>
                            <div class="card p-3">
                                <form id="experienceForm">
                                    <h3>Job Title</h3>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="experience-job-title" class="form-label">Job Title</label>
                                            <input type="text" class="form-control custom-input"
                                                id="experience-job-title" placeholder="Software Engineer">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="experience-company-name" class="form-label">Company
                                                Name</label>
                                            <input type="text" class="form-control custom-input"
                                                id="experience-company-name" placeholder="Google Inc.">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="experience-location" class="form-label">Location</label>
                                            <input type="text" class="form-control custom-input"
                                                id="experience-location" placeholder="San Francisco, CA">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="experience-start-date" class="form-label">Start Date</label>
                                            <input type="date" class="form-control custom-input"
                                                id="experience-start-date">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="experience-end-date" class="form-label">End Date</label>
                                            <input type="date" class="form-control custom-input"
                                                id="experience-end-date">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="experience-description" class="form-label">Description</label>
                                            <textarea class="form-control custom-input" id="experience-description" rows="3"
                                                placeholder="Describe your job role and achievements..."></textarea>
                                        </div>

                                        <div>
                                            <p>Optional <span class="custom-orange">(It will not be shown on your
                                                    resume):</span></p>

                                            <!-- Salary Rating -->
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="mb-0">How do you rate the salary pay?</label>
                                                    <div class="rating">
                                                        <input type="radio" id="salary-5" name="salary"
                                                            value="5"><label for="salary-5">&#9733;</label>
                                                        <input type="radio" id="salary-4" name="salary"
                                                            value="4"><label for="salary-4">&#9733;</label>
                                                        <input type="radio" id="salary-3" name="salary"
                                                            value="3"><label for="salary-3">&#9733;</label>
                                                        <input type="radio" id="salary-2" name="salary"
                                                            value="2"><label for="salary-2">&#9733;</label>
                                                        <input type="radio" id="salary-1" name="salary"
                                                            value="1" checked><label for="salary-1">&#9733;</label>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <!-- Work Environment Rating -->
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="mb-0">How do you rate the working
                                                        environment?</label>
                                                    <div class="rating">
                                                        <input type="radio" id="work-5" name="work"
                                                            value="5"><label for="work-5">&#9733;</label>
                                                        <input type="radio" id="work-4" name="work"
                                                            value="4"><label for="work-4">&#9733;</label>
                                                        <input type="radio" id="work-3" name="work"
                                                            value="3"><label for="work-3">&#9733;</label>
                                                        <input type="radio" id="work-2" name="work"
                                                            value="2"><label for="work-2">&#9733;</label>
                                                        <input type="radio" id="work-1" name="work"
                                                            value="1" checked><label for="work-1">&#9733;</label>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>

                                            <!-- Extra Benefits Rating -->
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="mb-0">Extra benefits/allowances rating?</label>
                                                    <div class="rating">
                                                        <input type="radio" id="benefits-5" name="benefits"
                                                            value="5"><label for="benefits-5">&#9733;</label>
                                                        <input type="radio" id="benefits-4" name="benefits"
                                                            value="4"><label for="benefits-4">&#9733;</label>
                                                        <input type="radio" id="benefits-3" name="benefits"
                                                            value="3"><label for="benefits-3">&#9733;</label>
                                                        <input type="radio" id="benefits-2" name="benefits"
                                                            value="2"><label for="benefits-2">&#9733;</label>
                                                        <input type="radio" id="benefits-1" name="benefits"
                                                            value="1" checked><label for="benefits-1">&#9733;</label>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>
                                        </div>

                                    </div>

                                    <button type="button" class="btn add-project float-start" id="addExperienceBtn">+
                                        Add Experience</button>
                                    <button type="submit" class="btn next-btn float-end"
                                        id="submitExperience">Next</button>
                                </form>
                            </div>
                        </div>

                        <!-- Trainings Section (Initially hidden) -->
                        <div id="trainings" class="section-content">
                            <h4 class="mb-3 your-project-text">Trainings/Certification</h4>
                            <div class="card p-3">
                                <form id="trainingForm">
                                    <h3>Certification</h3>
                                    <div class="row mb-3">
                                        <div class="col-md-12 mb-3">
                                            <label for="training-title" class="form-label">Training/Certification
                                                Title</label>
                                            <input type="text" class="form-control custom-input" id="training-title"
                                                placeholder="">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="training-organization"
                                                class="form-label">Institution/Organization</label>
                                            <input type="text" class="form-control custom-input"
                                                id="training-organization" placeholder="">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="training-date" class="form-label">Completion Date</label>
                                            <input type="text" class="form-control custom-input" id="training-date"
                                                placeholder="">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12 Upload-visa-image upload-container pt-5 pb-5">
                                            <p>Upload Visa Image</p>
                                            <div class="upload-box" id="drop-zone">
                                                <i class="fas fa-file-upload" id="upload-icon"></i>
                                                <p id="choose-file-text" class="choose-file-text">
                                                    Drag and Drop a file here or
                                                    <a href="#" class="text-underline-offset">Choose file</a>
                                                </p>
                                                <img id="preview-image" class="hidden" placeholder="Choose File">
                                                <input type="file" id="file-input" accept="image/*" class="hidden">
                                            </div>
                                            <p id="error-message" class="hidden" style="color: red;"></p>
                                        </div>
                                    </div>

                                    <button type="button" class="btn add-project float-start" id="addTrainingBtn">+
                                        Add
                                        Certification</button>
                                    <button type="submit" class="btn next-btn float-end"
                                        id="submitTraining">Next</button>
                                </form>
                            </div>
                        </div>

                        <!--Language-->
                        <div id="language" class="section-content">
                            <h4 class="mb-3 your-project-text">Language Proficiency</h4>
                            <div class="card p-3">
                                <form id="languagesForm">
                                    <h3>Language</h3>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input type="text" class="form-control custom-input border-end-0"
                                                    id="Language" placeholder="Language">
                                                <select class="form-select custom-input border-start-0 text-end me-3"
                                                    id="languageLevel">
                                                    <option value="Beginner" selected>Beginner</option>
                                                    <option value="Intermediate">Intermediate</option>
                                                    <option value="Advanced">Advanced</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn add-project float-start" id="addLanguageBtn">+
                                        Add
                                        Skill</button>
                                    <button type="submit" class="btn next-btn float-end fw-semibold">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Overview Section -->
                <div class="col-md-3 col-lg-3 col-sm-12 col-12">
                    <div class="card card-last">
                        <div class="card card-in" id="overviewCard">
                            <div class="overview-profile" id="overviewProfile" style="overflow-y: auto;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Left: Name and Designation -->
                                    <div class="left-section">
                                        <h6 id="overviewName"></h6>
                                        <p id="overviewRole"></p>
                                    </div>

                                    <!-- Right: Profile Picture -->
                                    <div class="right-section">
                                        <img id="overviewImage" class="profile-picture rounded-circle">
                                    </div>
                                </div>
                                <div id="overviewContent">
                                    <!-- Profile Details will be dynamically filled here -->
                                </div>
                                <div id="overviewEducation"></div>

                                <div id="overviewProjects"></div>

                                <div id="overviewSkills"></div>

                                <div id="overviewAchievements"></div>

                                <div id="overviewExperiences"></div>

                                <div id="overviewTrainings"></div>

                                <div id="overviewLanguages"></div>
                            </div>
                        </div>
                    </div>
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
        // Profile Form Submit handler
        document.getElementById('profileForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            // Collect Profile Data
            const profileData = {
                firstName: document.getElementById('first-name').value,
                lastName: document.getElementById('last-name').value,
                designation: document.getElementById('designation').value,
                address: document.getElementById('address').value,
                country: document.getElementById('country').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                summary: document.getElementById('summary').value,
                profileImage: document.getElementById('profilePreview').src
            };

            // Update Overview Section
            document.getElementById('overviewName').textContent =
                `${profileData.firstName} ${profileData.lastName}`;
            document.getElementById('overviewRole').textContent = profileData.designation;
            document.getElementById('overviewImage').src = profileData.profileImage;

            // Optional: Show profile summary in the overview
            document.getElementById('overviewContent').innerHTML = `
            <p><strong>Address:</strong> ${profileData.address}</p>
            <p><strong>Country:</strong> ${profileData.country}</p>
            <p><strong>Email:</strong> ${profileData.email}</p>
            <p><strong>Phone:</strong> ${profileData.phone}</p>
            <p><strong>Summary:</strong> ${profileData.summary}</p>
        `;

            // Show next section (Visa form)
            document.getElementById('profile').style.display = 'none';
            document.getElementById('visa').style.display = 'block';
        });

        // Profile Image Preview function
        function previewProfile(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('profilePreview').src = reader.result;
            };
            reader.readAsDataURL(file);
        }

        function activateSection(clickedId) {
            // Remove the 'active' class from all links
            const links = document.querySelectorAll('.profile-link');
            links.forEach(link => {
                link.classList.remove('active');
            });

            // Add the 'active' class to the clicked link
            const clickedLink = document.getElementById(clickedId);
            clickedLink.classList.add('active');

            // Hide all sections
            const sections = document.querySelectorAll('.section-content');
            sections.forEach(section => {
                section.style.display = 'none';
            });

            // Show the corresponding section
            const sectionId = clickedId.replace('Link', ''); // Remove 'Link' suffix to get the section ID
            const section = document.getElementById(sectionId);
            if (section) {
                section.style.display = 'block';
            }
        }

        // Initialize with Profile Information section active
        document.getElementById('profileLink').click();

        // Visa Next Button Click Event
        document.getElementById('submitVisa').addEventListener('click', function() {
            document.getElementById('visa').style.display = 'none';
            document.getElementById('education').style.display = 'block';
        });

        // Education Add Button Click Event
        document.getElementById('addEducation').addEventListener('click', function() {
            // Collect the data from the Education form
            const educationData = {
                schoolName: document.getElementById('schoolName').value,
                degree: document.getElementById('degree').value,
                city: document.getElementById('city').value,
                startDate: document.getElementById('startDate').value,
                gradDate: document.getElementById('gradDate').value,
                summary: document.getElementById('summary').value
            };

            // Create the education entry HTML
            const educationEntry = `
            <h4>Your Education</h4>
            <p><strong>School Name:</strong> ${educationData.schoolName}</p>
            <p><strong>Degree:</strong> ${educationData.degree}</p>
            <p><strong>City:</strong> ${educationData.city}</p>
            <p><strong>Start Date:</strong> ${educationData.startDate}</p>
            <p><strong>Graduation Date:</strong> ${educationData.gradDate}</p>
            <p><strong>Summary:</strong> ${educationData.summary}</p>
        `;

            // Update the overview with the new education entry
            document.getElementById('overviewEducation').innerHTML += educationEntry;

            // Clear the form fields for new input
            document.getElementById('schoolName').value = '';
            document.getElementById('degree').value = '';
            document.getElementById('city').value = '';
            document.getElementById('startDate').value = '';
            document.getElementById('gradDate').value = '';
            document.getElementById('summary').value = '';

            // Optionally, focus on the first field to improve user experience
            document.getElementById('schoolName').focus();
        });

        // Visa Next Button Click Event
        document.getElementById('submitEducation').addEventListener('click', function() {
            // Hide the Education form and show the Project form
            document.getElementById('education').style.display = 'none';
            document.getElementById('project').style.display = 'block';
        });

        // Function to add a project to the overview section
        document.getElementById('addProjectButton').addEventListener('click', function() {
            // Get the values from the form fields
            const title = document.getElementById('projectTitle').value;
            const link = document.getElementById('projectLink').value;
            const description = document.getElementById('projectDescription').value;

            // Create a new div for the project
            const projectDiv = document.createElement('div');
            projectDiv.classList.add('project-item');

            // Add project content to the new div
            projectDiv.innerHTML = `
    <h5>${title}</h5>
    <a href="${link}" target="_blank">${link}</a>
    <p>${description}</p>
`;

            // Append the new project div to the overviewProjects section
            const overviewProjects = document.getElementById('overviewProjects');
            overviewProjects.appendChild(projectDiv);

            // Clear the form inputs
            document.getElementById('projectForm').reset();
        });

        document.getElementById('submitProject').addEventListener('click', function() {
            // Hide the Education form and show the Project form
            document.getElementById('project').style.display = 'none';
            document.getElementById('skills').style.display = 'block';
        });

        // Add Skill Button Event
        document.getElementById('addSkillBtn').addEventListener('click', function() {
            const skillName = document.getElementById('SKill').value.trim();
            const skillLevel = document.getElementById('skill').value;

            if (!skillName) {
                alert("Please enter a skill before adding.");
                return;
            }

            // Create the skill entry HTML
            const skillEntry = `
        <div class="skill-entry">
            <p><strong>${skillName}</strong> - <em>${skillLevel}</em></p>
        </div>
    `;

            // Add the new skill to the overview section
            const skillsList = document.getElementById('overviewSkills');
            if (skillsList) {
                skillsList.innerHTML += skillEntry;
            } else {
                console.error('Skills list container not found!');
            }

            // Clear the form input field
            document.getElementById('SKill').value = '';

        });

        // Skills Form Submit handler (optional if needed for submission)
        document.getElementById('skillsForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission
            // Handle form submission logic if needed
        });

        document.getElementById('submitSkills').addEventListener('click', function() {
            // Hide the Education form and show the Project form
            document.getElementById('skills').style.display = 'none';
            document.getElementById('achievements').style.display = 'block';
        });

        //Add achievements in Overview
        document.getElementById('addAchievementBtn').addEventListener('click', function() {
            const achievementTitle = document.getElementById('achievement-title').value.trim();
            const achievementDescription = document.getElementById('achievement-description').value.trim();

            // Check if both fields have content
            if (!achievementTitle || !achievementDescription) {
                alert("Please enter both title and description before adding.");
                return;
            }

            // Create the achievement entry HTML
            const achievementEntry = `
                        <div class="achievement-entry">
                            <p><strong>${achievementTitle}</strong></p>
                            <p>${achievementDescription}</p>
                        </div>
                    `;

            // Update the achievements overview section
            const achievementsList = document.getElementById('overviewAchievements');
            if (achievementsList) {
                achievementsList.innerHTML += achievementEntry; // Append new achievement entry to the list
            } else {
                console.error('Achievements list container not found!');
            }

            // Clear the form input fields after adding the achievement
            document.getElementById('achievement-title').value = '';
            document.getElementById('achievement-description').value = '';
        });

        // Achievements Form Submit handler (optional if needed for form submission)
        document.getElementById('achievementsForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission
            // Handle form submission logic if needed
        });

        document.getElementById('submitAchievement').addEventListener('click', function() {
            // Hide the Education form and show the Project form
            document.getElementById('achievements').style.display = 'none';
            document.getElementById('experience').style.display = 'block';
        });

        // Add Experience Button Event
        document.getElementById('addExperienceBtn').addEventListener('click', function() {
            const jobTitle = document.getElementById('experience-job-title').value.trim();
            const companyName = document.getElementById('experience-company-name').value.trim();
            const location = document.getElementById('experience-location').value.trim();
            const startDate = document.getElementById('experience-start-date').value.trim();
            const endDate = document.getElementById('experience-end-date').value.trim();
            const description = document.getElementById('experience-description').value.trim();

            // Create the experience entry HTML
            const experienceEntry = `
                <p><strong>${jobTitle}</strong> at <em>${companyName}</em> - ${location}</p>
                <p><strong>Duration:</strong> ${startDate} to ${endDate}</p>
                <p><strong>Description:</strong> ${description}</p>
        `;

            // Append the experience entry to the overview section
            const experienceList = document.getElementById('overviewExperiences');
            experienceList.innerHTML += experienceEntry;

            // Clear the form input fields after adding the experience
            document.getElementById('experience-job-title').value = '';
            document.getElementById('experience-company-name').value = '';
            document.getElementById('experience-location').value = '';
            document.getElementById('experience-start-date').value = '';
            document.getElementById('experience-end-date').value = '';
            document.getElementById('experience-description').value = '';

            document.getElementById('submitExperience').addEventListener('click', function() {
                // Hide the Education form and show the Project form
                document.getElementById('experience').classList.add('d-none');
                document.getElementById('trainings').classList.add('d-block');
            });

            document.getElementById('addTrainingBtn').addEventListener('click', function() {
                const title = document.getElementById('training-title').value.trim();
                const organization = document.getElementById('training-organization').value.trim();
                const date = document.getElementById('training-date').value.trim();

                const trainingList = document.getElementById('overviewTrainings');

                // Create a new training entry
                const trainingEntry = document.createElement('div');
                trainingEntry.innerHTML = `
            <p><strong>${title}</strong> - <em>${organization}</em></p>
            <p><strong>Completion Date:</strong> ${date}</p>
        `;

                trainingList.appendChild(trainingEntry);

                // Clear input fields
                document.getElementById('training-title').value = '';
                document.getElementById('training-organization').value = '';
                document.getElementById('training-date').value = '';
            });

            document.getElementById('submitTraining').addEventListener('click', function() {
                // Hide the Education form and show the Project form
                document.getElementById('trainings').style.display = 'none';
                document.getElementById('language').style.display = 'block';
            });

            //Add language
            document.getElementById('addLanguageBtn').addEventListener('click', function() {
                const languageName = document.getElementById('Language').value.trim();
                const languageLevel = document.getElementById('languageLevel').value;


                // Create a new language entry
                const languageEntry = document.createElement("div");
                languageEntry.innerHTML = `
                                    <p><strong>${languageName}</strong> - <em>${languageLevel}</em></p>
                                `;

                // Append to the overview section
                const languagesList = document.getElementById('overviewLanguages');
                if (languagesList) {
                    languagesList.appendChild(languageEntry);
                } else {
                    console.error('Languages list container not found!');
                }

                // Clear input fields
                document.getElementById('Language').value = '';

                // Attach event listener to remove button
                languageEntry.querySelector('.removeLanguageBtn').addEventListener('click', function() {
                    this.parentElement.remove();
                });
            });
        });
    </script>
@endpush
