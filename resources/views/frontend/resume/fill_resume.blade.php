@extends('frontend.layouts.main')
@section('title')
Resume Maker
@endsection
@section('content')
<main>
    <div>
        <style>
            .custom-input {
                background-color: #E6E7E7;
                height: 50px;
                cursor: pointer;
            }

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

            .active {
                color: white !important;
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
        <section>
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="container">
                    <h5>Hi, {{ Auth::guard('job_seekers')->user()->firstName }} {{ Auth::guard('job_seekers')->user()->lastName }}</h5>
                    <p class="d-flex">
                        <i class="fas fa-envelope  pt-1"></i> {{ Auth::guard('job_seekers')->user()->emailAddress }}
                        <i class="fas fa-phone ps-4  pt-1"></i> {{ Auth::guard('job_seekers')->user()->phoneNumber }}
                    </p>
                    <h4>Create Your Resume Today and Find The Perfect Job for You</h4>

                    <!-- Add d-flex to align buttons in a row -->
                    <div class="d-flex gap-2">
                        <a href="{{ route('jobseeker.editProfile', Auth::guard('job_seekers')->user()->id) }}" class="btn btn-edit">
                            Edit <i class="fas fa-edit text-light ps-2"></i>
                        </a>
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
                            @include('frontend.resume.profile')
                            <!-- Visa Section (Initially hidden) -->
                            @include('frontend.resume.visa')
                            <!--Education Section-->
                            @include('frontend.resume.education')
                            <!--Project Section-->
                            @include('frontend.resume.project')
                            <!-- Skills Section (Initially hidden) -->
                            @include('frontend.resume.skill')
                            <!-- Achievements Section (Initially hidden) -->
                            @include('frontend.resume.achievement')
                            <!-- Experience Section (Initially hidden) -->
                            @include('frontend.resume.experience')
                            <!-- Trainings Section (Initially hidden) -->
                            @include('frontend.resume.training')
                            <!--Language section -->
                            @include('frontend.resume.language')
                        </div>
                    </div>

                    <!-- Overview-->
                    <div class="col-md-12 col-lg-3 col-sm-12 col-12" style="display: none;">
                        <div class="card card-last">
                            <div class="card card-in" id="overviewCard">
                                <div class="overview-profile" id="overviewProfile" style="overflow-y: auto;">
                                    <div class="d-flex justify-content-between align-items-center" id="profileDisplay">
                                        <div class="left-section">
                                            <h6>{{ $profile->firstName ?? '' }} {{ $profile->lastName ?? ''}}</h6>
                                            <p>{{ $profile->designation ?? '' }}</p>
                                        </div>
                                        <div class="right-section">
                                            @if(isset($profile) && $profile->profileImg)
                                            <img src="{{ asset($profile->profileImg) }}" class="profile-picture rounded-circle">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">

                                        <div class="left-section">
                                            <h6 id="overviewName"></h6>
                                            <p id="overviewRole"></p>
                                        </div>
                                        <div class="right-section">
                                            <img id="overviewImage" class="profile-picture rounded-circle img-fluid" style="width: 100px; height: 100px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        @foreach ( $visas as $visa )
                                        <p><strong>Visa Details:</strong>{{ $visa->visaDetails ?? '' }}</p>
                                        <p><strong>Visa Expire:</strong>{{ $visa->visaExpire ?? '' }}</p>
                                        <p><strong>Visa Country:</strong>{{ $visa->country }}</p>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        @foreach ( $educations as $education )
                                        <p><strong>School:</strong>{{ $education->schoolName ?? '' }}</p>
                                        <p><strong>Degree:</strong>{{ $education->degree ?? '' }}</p>
                                        <p><strong>City:</strong>{{ $education->city ?? '' }}</p>
                                        <p><strong>Dates:</strong> {{ $education->startDate ?? '' }}- {{ $education->graduationDate ?? '' }}</p>
                                        <p><strong>Summary:</strong> {{ $education->educationDescription ?? '' }}</p>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        @foreach ( $projects as $project )
                                        <p><strong>projectTitle:</strong>{{ $project->projectTitle ?? '' }}</p>
                                        <p><strong>projectLink:</strong>{{ $project->projectLink ?? '' }}</p>
                                        <p><strong>projectDescription:</strong>{{ $project->projectDescription ?? '' }}</p>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        @foreach ( $skills as $skill )
                                        <p><strong>Skill Name:</strong>{{ $skill->skillName ?? '' }}</p>
                                        <p><strong>Skill Proficiency:</strong>{{ $skill->skillProficiency ?? '' }}</p>
                                        @endforeach
                                    </div>>
                                </div>
                                <div>
                                    <div>
                                        @foreach ( $achievements as $achievement)
                                        <p><strong>achievement Title:</strong>{{ $achievement->achievementTitle ?? '' }}</p>
                                        <p><strong>Skill Proficiency:</strong>{{ $achievement->achievementDescription ?? '' }}</p>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        @foreach ($experiences as $experience)
                                        <p><strong>Job Title:</strong> {{ $experience->jobTitle ?? '' }}</p>
                                        <p><strong>Company Name:</strong> {{ $experience->companyName ?? '' }}</p>
                                        <p><strong>Location:</strong> {{ $experience->location ?? '' }}</p>
                                        <p><strong>Start Date:</strong> {{ $experience->startDate ?? '' }}</p>
                                        <p><strong>End Date:</strong> {{ $experience->endDate ?? '' }}</p>
                                        <p><strong>Description:</strong> {{ $experience->experienceDescription ?? '' }}</p>
                                        <p><strong>Salary Rating:</strong> {{ $experience->salaryRating ?? '' }}</p>
                                        <p><strong>Salary Feedback:</strong> {{ $experience->salaryFeedback ?? '' }}</p>
                                        <p><strong>Working Environment Rating:</strong> {{ $experience->workingEnvironmentRating ?? '' }}</p>
                                        <p><strong>Working Environment Feedback:</strong> {{ $experience->workingEnvironmentFeedback ?? '' }}</p>
                                        <p><strong>Benefits Rating:</strong> {{ $experience->benefitsRating ?? '' }}</p>
                                        <p><strong>Benefits Feedback:</strong> {{ $experience->benefitsFeedback ?? '' }}</p>
                                        <hr>
                                        @endforeach

                                    </div>
                                </div>
                                <div>
                                    <div>
                                        @foreach ($trainings as $training)
                                        <p><strong>Training Title:</strong> {{ $training->trainingTitle ?? '' }}</p>
                                        <p><strong>Institution Name:</strong> {{ $training->institutionName ?? '' }}</p>
                                        <p><strong>Completion Date:</strong> {{ $training->completionDate ?? '' }}</p>
                                        @endforeach

                                    </div>
                                </div>
                                <div>
                                    @foreach ($languages as $language)
                                    <p><strong>Language Name:</strong> {{ $language->languageName ?? '' }}</p>
                                    <p><strong>Language Proficiency:</strong> {{ $language->languageProficiency ?? '' }}</p>
                                    <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
</main>
@push('scripts')
<script>
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
    })
</script>
@endpush
@endsection