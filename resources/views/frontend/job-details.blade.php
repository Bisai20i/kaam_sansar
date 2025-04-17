@extends('frontend.layouts.main')
@section('title', 'Job Details')
@section('content')
   <div class="container mt-5">
        <div class="row">
            <!-- Job Details Section -->
            <div class="col-md-8 job-details-section"
                style="padding: 0px!important;margin-top: 15px; margin-bottom: 30px!important;">
                <div>
                    <div class="job-description">
                        <img src="{{ asset('storage/' . $jobDetail->jobBanner) }}" alt="Job Image" class="job-image"
                            style="border-top-left-radius: 7px; border-top-right-radius: 7px;">
                        {{-- <p style="padding-left: 19.5px!important; padding-right: 19.5px!important;">
                            {!! $jobDetail->jobDescription !!}
                        </p> --}}
                    </div>
                    <div style="padding-left: 14.5px!important;">
                        <div class="image-and-button">
                            <div class="logo-container">
                                <img src="{{ asset('storage/' . $jobDetail->jobCompany->companyProfileImg) }}"
                                    alt="Company Logo" class="company-logo">
                            </div>
                            @auth('job_seekers')
                                <a href="{{ route('frontend.apply', $jobDetail->jobSlug) }}" class="apply-button">Proceed to Apply</a>
                            @else
                                <form id="redirectForm" action="{{ route('set.redirect') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                                </form>

                                <a href="#"
                                    onclick="document.getElementById('redirectForm').submit(); "
                                    class="apply-button">
                                    Proceed to Apply
                                </a>
                            @endauth
                        </div>
                        <h1 class="job-title">Job Information</h1>
                        <div class="job-meta">
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
            <div class="col-md-4" style="margin-top: 15px;">
                <div class="job-categories">
                    <h3 class="sidebar-title">Jobs by Category</h3>
                    <ul class="category-list">
                        @foreach ($categories as $item)
                            <li>
                                <form action="{{route('frontend.job-search')}}" >
                                    
                                    <input type="hidden" name="jobsby" value="category">
                                    <input type="hidden" name="searchcategoryid" value="{{$item->id}}">
                                    <button type="submit" style="all: unset; cursor: pointer;">{{$item->jobCategoryName}}</button>
                                </form>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="job-categories mt-4">
                    <h3 class="sidebar-title">Jobs by Skill</h3>
                    <ul class="category-list">
                        @foreach ($skills as $item)
                            <li>
                                <form action="{{route('frontend.job-search')}}" >
                                    
                                    <input type="hidden" name="jobsby" value="skill">
                                    <input type="hidden" name="searchstr" value="{{$item}}">
                                    <button type="submit" style="all: unset; cursor: pointer;">{{$item}}</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="job-categories mt-4">
                    <h3 class="sidebar-title">Jobs by Location</h3>
                    <ul class="category-list">
                        @foreach ($jobLocation as $item)
                            <li>
                                <form action="{{route('frontend.job-search')}}" >
                                    
                                    
                                    <input type="hidden" name="location" value="{{$item}}">
                                    <button type="submit" style="all: unset; cursor: pointer;">{{$item}}</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection