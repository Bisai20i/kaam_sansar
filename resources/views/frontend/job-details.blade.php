@extends('frontend.layouts.main')
@section('title', 'Job Details')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Job Details Section -->
            <div class="col-md-8 ">
                <div class="job-details-section p-0 my-3">
                    <div class="job-description">
                        <img src="{{ $jobDetail->jobBanner ? asset('storage/' . $jobDetail->jobBanner) : asset('frontend/assets/Images/money-around-world.jpg') }}"
                            alt="Job Image" class="job-image"
                            style="border-top-left-radius: 7px; border-top-right-radius: 7px;">
                        {{-- <p style="padding-left: 19.5px!important; padding-right: 19.5px!important;">
                            {!! $jobDetail->jobDescription !!}
                        </p> --}}
                    </div>
                    <div class="px-2 px-md-4">
                        <div class="image-and-button px-0">
                            <div class="logo-container ">
                                <img src="{{ $jobDetail->jobCompany->companyProfileImg ? asset('storage/' . $jobDetail->jobCompany->companyProfileImg) :  asset('frontend/assets/Images/jobdefault.png') }}"
                                    alt="Company Logo" class="company-logo rounded-2">
                            </div>
                            @auth('job_seekers')
                                <a href="{{ route('frontend.apply', $jobDetail->jobSlug) }}"
                                    class="apply-button text-center">Apply</a>
                            @else
                                <form id="redirectForm" action="{{ route('set.redirect') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                                </form>

                                <a href="#" onclick="document.getElementById('redirectForm').submit(); "
                                    class="apply-button">
                                    Apply
                                </a>
                            @endauth
                        </div>
                        <h1 class="job-title mb-1 d-inline-block">Job Information</h1>
                        <div class="job-meta px-0">
                            <p class="meta-container"><span class="meta-label">Company:</span>
                                {{ $jobDetail->jobCompany->companyName }}</p>
                            <p class="meta-container"><span class="meta-label">Location:</span>
                                {{ $jobDetail->jobLocation }}
                            </p>
                            <p class="meta-container"><span class="meta-label">Experience:</span>
                                {{ $jobDetail->experience }}</p>
                            <p class="meta-container"><span class="meta-label">Salary:</span> NPR
                                {{ $jobDetail->offeredSalary }}
                                monthly
                                (Negotiable)</p>

                            <p class="meta-container text-capitalize "><span class="meta-label">Employment Type:</span>
                                {{ $jobDetail->jobType }}

                            </p>
                            <p class="meta-container">
                                <span class="meta-label">Apply Before:</span>
                                {{ \Carbon\Carbon::parse($jobDetail->jobDeadline)->format('F d, Y') }}
                            </p>
                            <p class="meta-container"><span class="meta-label">Views:</span>
                                {{ $jobDetail->jobViewerCount }}</p>

                        </div>
                        <div class="job-description">
                            <h3>About {{ $jobDetail->jobCompany->companyName }}:</h3>
                            <p>{!! $jobDetail->jobCompany->companyDescription !!}</p>

                            <h3>Job Description:</h3>
                            <p class="text-justify ">{!! $jobDetail->jobDescription !!}
                            </p>


                        </div>
                    </div>
                </div>
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
                @if ($ad_banners['right'])
                    <a href="{{ isset($ad_banners['right']) ? $ad_banners['right']->link : '#' }}" target="_blank" href="{{ $ad_banners['right']->link }}" class="d-block mt-3"
                        style="text-decoration: none; cursor: pointer; object-fit: contain;">
                        <img src="{{ isset($ad_banners['right']) ? $ad_banners['right']->image : '#' }}" class="w-100 rounded-2" style="aspect-ratio: 1/3;"
                            alt="img-fluid">
                    </a>


                    {{-- <h1 class="d-flex justify-content-center mt-5 mb-5">Advertisement Banner</h1> --}}
                @endif
            </div>
        </div>
    </div>
@endsection
