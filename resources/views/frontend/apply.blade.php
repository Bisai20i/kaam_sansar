@extends('frontend.layouts.main')

@section('title', 'Apply Now')

@section('content')
    <style>
        a {
            text-decoration: none !important;
        }

        .container-apply-profile {
            max-width: 72rem;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* border-radius: 0.5rem; */
            margin-top: 100px;
            /* padding: 1.5rem; */
            border: 1px solid #000000;
            border: none;
        }

        .container-similar-job {
            max-width: 72rem;
            margin: 0 auto;
            margin-top: 100px;
            border: 1px solid #000000;
            border: none;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0;
            border: 1px solid #000000;
            border-radius: 0.5rem;
            background-color: #ffffff;
            box-shadow: none;
        }

        @media (min-width: 768px) {
            .grid {
                grid-template-columns: 1fr 1fr;
            }

            .section {
                border-right: none;
                /* Hide the right border on laptop view */
                border-bottom: 1px solid #000000;
                /* Keep the bottom border */
            }
        }

        .section {
            padding: 1rem;
            border-bottom: 1px solid #000000;

        }

        @media (min-width: 768px) {
            .section {
                border-right: 1px solid #000000;
                border-bottom: 0;
            }
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            border-bottom: 1px solid #000000;
            padding-bottom: 0.5rem;
        }


        .profile-img-apply,
        .company-logo {
            width: 6rem;
            height: 6rem;
            border-radius: 9999px;
            margin-right: 1rem;
        }

        .profile-img-apply {
            margin: 0;
            margin-right: 1rem;

        }

        .profile-info {
            font-size: 20px;
            /* Updated font size */
            font-weight: bold;
            margin-top: 10px;

        }

        .details {
            margin-top: 20px;
        }

        .details p {
            margin: 5px 0;
        }

        .section-content {
            padding-top: 1rem;
        }

        .section-subtitle {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            padding-top: 0px;
        }

        .section-subtitle-job {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            padding-top: 25px;
        }

        .section-text {
            margin-bottom: 1rem;
            padding-bottom: 36px;
        }

        .section-text-job {
            margin-bottom: 1rem;
            padding-bottom: 15px;
        }

        .section-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
            border-top: 1px solid #000000;
            padding-top: 0.5rem;
        }

        .button {
            background-color: #0064a7;
            color: #ffffff;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            border-radius: 0.375rem;
            border: 1px solid #ffffff;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .button:hover {
            background-color: #004d7a;
            /* Darker shade of blue */
            transform: scale(1.05);
            /* Slightly enlarges the button */
        }

        h1 {
            padding-left: 10px;
        }

        .container-similar-job .container {
            border: none;
            box-shadow: none;
            background-color: #ffffff;
        }

        .section-apply {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
    <div class="container mt-5 pt-2">
        <div class="grid">
            <!-- Profile Section -->
            <div class="section p-4">
                <h2 class="section-title">YOUR PROFILE</h2>
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ Auth::guard('job_seekers')->user()->userThumbnail
                        ? asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail[0])
                        : asset('frontend/assets/Images/profile.jpg') }}"
                        class="profile-img-apply">
                    <div>
                        <!-- <div class=""> -->
                        <h3 class="profile-info">
                            {{ Auth::guard('job_seekers')->user()->firstName . ' ' . Auth::guard('job_seekers')->user()->lastName }}
                        </h3>
                        <!-- </div> -->
                        <div class="details">
                            @auth('job_seekers')
                                <p>Address:
                                    {{ Auth::guard('job_seekers')->user()->temporaryAddress ?? (Auth::guard('job_seekers')->user()->permanentAddress ?? 'N/A') }}
                                </p>
                                <p>Phone: {{ Auth::guard('job_seekers')->user()->phoneNumber ?? 'N/A' }}</p>
                                <p>Email: {{ Auth::guard('job_seekers')->user()->emailAddress ?? 'N/A' }}</p>

                                <!-- Assuming dob is stored as a date in the user's profile -->
                                <p>Age:
                                    {{ Auth::guard('job_seekers')->user()->dateOfBirth ? \Carbon\Carbon::parse(Auth::guard('job_seekers')->user()->dateOfBirth)->age . ' years' : 'N/A' }}
                                </p>
                            @else
                                <p>Please log in to see your details.</p>
                            @endauth
                        </div>


                    </div>
                </div>
                <div class="section-content">
                    <h4 class="section-subtitle">Bio</h4>
                    <p class="section-text ">
                        As a passionate and detail-oriented UI/UX Designer with over [X years] of experience, I
                        specialize in creating user-centered designs that seamlessly blend functionality with
                        aesthetics. My expertise in tools like Figma, Adobe XD, and Sketch, along with a strong
                        understanding of design principles, has allowed me to craft intuitive interfaces for web and
                        mobile applications. I thrive on understanding user needs and translating them into visually
                        appealing and responsive designs that elevate the user experience. At [Previous Company Name], I
                        successfully led the redesign of a [specific project], improving user engagement by [specific
                        percentage or result].
                    </p>
                </div>
                <div class="section-footer">
                    <p>Improve your profile to get hired!!</p>
                    <div class="btn-group gap-2">
                        <a href="{{ route('jobseeker.getProfile', @Auth::guard('job_seekers')->user()->id) }}"><button
                                class="button">View Profile</button></a>
                        <a href="{{ route('jobseeker.editProfile', @Auth::guard('job_seekers')->user()->id) }}"><button
                                class="button">Edit Profile</button></a>
                    </div>
                </div>
            </div>

            <!-- Job Details Section -->
            <div class="section p-4" style="border-right: none!important; border-bottom: none!important;">
                <h2 class="section-title">JOB DETAILS</h2>
                <div class="d-flex align-items-center mb-4">
                    <img alt="Company logo of Apple" class="company-logo"
                        src="{{ asset('storage/' . $job_detail->jobCompany->companyProfileImg) }}" />
                    <div>
                        <!-- <div class="profile-header"> -->
                        <h3 class="profile-info">{{ $job_detail->jobCompany->companyName }}</h3>
                        <!-- </div> -->
                        <div class="details">
                            <p>Address: {{ $job_detail->jobLocation }}</p>
                            <p>Phone: {{ $job_detail->jobCompany->phone ?? 'N/A' }}</p>
                            <p>Email: {{ $job_detail->jobCompany->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="section-content">
                    <h4 class="section-subtitle-job">Job Details</h4>
                    <p class="section-text-job">
                        {!! substr(strip_tags($job_detail->jobDescription), 0, 750) . '...' !!}
                    </p>



                </div>
                <div class="section-footer">
                    <p>Get Your Dream Job Today!!</p>
                    <a href="{{ route('frontend.job-details', ['slug' => $job_detail->jobSlug]) }}"><button
                            class="button">View
                            More</button></a>
                </div>
            </div>
        </div>
    </div>
     
    <div class="container pt-2 mb-2">
        <div class="section-apply">
            <a href="{{ route('jobApply.store', ['id' => $job_detail->id]) }}" class="button">Apply Now</a>
        </div> 

        <div class="container-similar-job mt-4">
            <h2 class=" px-3 pt-4 font-semibold mb-0 " style="color:#0064A7;">Similar Jobs</h2>
            <div class="row">
                <div class="col-md-8 job-job px-0">

                    @if ($similar_jobs->isEmpty())
                        <p class="fw-bold text-dark fs-3 px-4">No similar jobs found.</p>
                    @else
                        @foreach ($similar_jobs as $job)
                            <div class="container mt-3">
                                <a href="{{ route('frontend.job-details', ['slug' => $job->jobSlug]) }}"
                                    class="text-dark d-block text-decoration-none mb-2">
                                    <div class="job-card-1">
                                        <img src="{{ $job->jobBanner ? asset('storage/' . $job->jobBanner) : asset('frontend/assets/Images/jobdefault.png') }}"
                                            alt="Company Image">
                                        <div class="job-card-body">
                                            <h5 class="card-title fw-semibold">{{ $job->jobTitle }}</h5>
                                            <p>Company Name: {{ $job->jobCompany->companyName }}</p>
                                            <p>Location: {{ $job->jobLocation }}</p>
                                            <p>Experience: {{ $job->experience }}</p>
                                            <p>Source:
                                                @if ($job->jobCompany->link1)
                                                    <a href="{{ $job->jobCompany->link1 }}" target="_blank">Company Website
                                                    </a>
                                                @endif

                                                @if ($job->jobCompany->link2)
                                                    @if ($job->jobCompany->link1)
                                                        |
                                                    @endif
                                                    <a href="{{ $job->jobCompany->link2 }}" target="_blank">Company Website
                                                    </a>
                                                @endif

                                                @if ($job->jobCompany->link3)
                                                    @if ($job->jobCompany->link1 || $job->jobCompany->link2)
                                                        |
                                                    @endif
                                                    <a href="{{ $job->jobCompany->link3 }}" target="_blank">Company Website
                                                    </a>
                                                @endif
                                            </p>



                                        </div>
                                        <div class="full-width-border"></div>
                                        <div class="job-card-footer">
                                            <small>Apply before:
                                                {{ \Carbon\Carbon::parse($job->jobDeadline)->format('F d, Y') }}
                                            </small>
                                            <small>Views: {{ $job->jobViewerCount ?? 0 }}</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                        {{-- <a href="{{ route('frontend.job-details', ['slug' => $job->jobSlug]) }}" class="text-dark d-block text-decoration-none mb-2">
                        <div class="job-card-1">
                            <img src="{{ $job->jobBanner ? asset('storage/' . $job->jobBanner) : asset('frontend/assets/Images/jobdefault.png')  }}" alt="Company Image">
                            <div class="job-card-body">
                                <h5 class="card-title">{{ $job->jobTitle }}</h5>
                                <p>Company Name: {{ $job->jobCompany->companyName }}</p>
                                <p>Location: {{ $job->jobLocation }}</p>
                                <p>Experience: {{ $job->experience }}</p>
                                <p class="d-flex">Source: <a href="{{ $job->jobCompany->link1 }}"
                                        target="_blank">{{ $job->jobCompany->link1 }}</a>, &nbsp; <a
                                        href="{{ $job->jobCompany->link2 }}"
                                        target="_blank">{{ $job->jobCompany->link2 }}</a>,
                                    &nbsp;<a href="{{ $job->jobCompany->link3 }}"
                                        target="_blank">{{ $job->jobCompany->link3 }}</a>
                                </p>
                            </div>
                            <div class="full-width-border"></div>
                            <div class="job-card-footer">
                                <small>Apply before:
                                    {{ \Carbon\Carbon::parse($job->jobDeadline)->format('F d, Y') }}</small>
                                <small>Views: {{ $job->jobViewerCount }}</small>
                            </div>
                        </div>
                    </a> --}}
                    @endif


                </div>
                <!-- Job Categories Sidebar -->

                <div class="col-md-4 my-3">
                    <div class="job-categories p-0">
                        <h3 class="sidebar-title p-3">Jobs by Category</h3>
                        <ul class="category-list px-3 overflow-auto" style="max-height: 400px;">
                            @foreach ($categories as $item)
                                <li style="color: #0064A7">
                                    <form action="{{ route('frontend.job-search') }}">

                                        <input type="hidden" name="jobsby" value="category">
                                        <input type="hidden" name="searchcategoryid" value="{{ $item->id }}">
                                        <button type="submit"
                                            style="all: unset; cursor: pointer;">{{ $item->jobCategoryName }}</button>
                                    </form>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="job-categories mt-3 p-0">
                        <h3 class="sidebar-title p-3">Jobs by Skill</h3>
                        <ul class="category-list px-3 overflow-auto" style="max-height: 400px;">
                            @foreach ($skills as $item)
                                <li style="color: #0064A7">
                                    <form action="{{ route('frontend.job-search') }}">

                                        <input type="hidden" name="jobsby" value="skill">
                                        <input type="hidden" name="searchstr" value="{{ $item }}">
                                        <button type="submit"
                                            style="all: unset; cursor: pointer;">{{ $item }}</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="job-categories mt-4 p-0">
                        <h3 class="sidebar-title p-3  ">Jobs by Location</h3>
                        <ul class="category-list  px-3 overflow-auto" style="max-height: 400px;">
                            @foreach ($jobLocation as $item)
                                <li style="color: #0064A7">
                                    <form action="{{ route('frontend.job-search') }}">


                                        <input type="hidden" name="location" value="{{ $item }}">
                                        <button type="submit"
                                            style="all: unset; cursor: pointer;">{{ $item }}</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    {{-- @if ($ad_banners['right'])
                        <a href="{{ isset($ad_banners['right']) ? $ad_banners['right']->link : '#' }}" target="_blank" href="{{ $ad_banners['right']->link }}" class="d-block mt-3"
                            style="text-decoration: none; cursor: pointer; object-fit: contain;">
                            <img src="{{ isset($ad_banners['right']) ? $ad_banners['right']->image : '#' }}" class="w-100 rounded-2" style="aspect-ratio: 1/3;"
                                alt="img-fluid">
                        </a>
    
    
                        
                    @endif --}}
                </div>

            </div>

            @if (isset($ad_banners['bottom']))
            <div class="mb-2">
                <a href="{{ isset($ad_banners['bottom']) ? $ad_banners['bottom']->link : '#' }}" class="d-block"
                    style="text-decoration: none; cursor: pointer; object-fit: contain;">
                    <img src="{{ isset($ad_banners['bottom']) ? $ad_banners['bottom']->image : '#' }}" class="w-100 rounded-2" style="aspect-ratio: 4/1;" alt="{{ $ad_banners['bottom']->image }}" class="w-100" style="aspect-ratio: 4/1;"
                        alt="img-fluid">
                </a>
            </div>
            {{-- <h1 class="d-flex justify-content-center mt-5 mb-5">Advertisement Banner</h1> --}}
        @endif
        </div>
    </div>
    </div>

@endsection
