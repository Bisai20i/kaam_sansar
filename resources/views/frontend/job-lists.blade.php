@extends('frontend.layouts.main')

@section('title', 'Job Search')
@section('content')

    <section class="popular ">
        <div class="container-fluid search-container text-white py-4">

            <div class="container search-box  ">
                <div class="row ">
                    <div class="col-lg-12 search-inputs">
                        <h2 class="mt-5">Discover Your Next Opportunity.</h2>

                        {{-- <div class="row mt-4 "> --}}
                        <!-- Input for Keywords -->
                        <form action="{{ route('frontend.job-search') }}" class="row mt-4 align-items-center">

                            <div
                                class="col-lg-5 col-md-6 col-sm-12 col-12 mb-2 d-flex justify-content-center align-items-center input-container">
                                <i class="fa fa-user"></i>

                                <input type="text" class="form-control" name="searchstr" placeholder="Key words">
                            </div>
                            <!-- Input for Location -->
                            <div
                                class="col-lg-5 col-md-6 col-sm-12 col-12 mb-2 d-flex align-items-center justify-content-center input-container">
                                <i class="fa fa-map-marker-alt"></i>
                                <input type="text" class="form-control" name="location"
                                    placeholder="Enter location, city, country, etc">
                            </div>
                            <!-- Search Button -->
                            <div class="col-lg-2 col-md-12 col-sm-12 col-12 mb-2 align-items-center">
                                <button class="btn btn-light search-button">
                                    <i class="fa fa-search"></i> Search</button>
                            </div>
                        </form>
                        {{-- </div> --}}


                    </div>
                </div>





                <div class="row popular-search ">
                    <div class="col-lg-12 ">
                        <h4 class="mt-5">Popular Search</h4>
                        <div class="row text-center">
                            @foreach ($categories as $jobCategory)
                                <div class="col g-2 ">
                                    <form action="{{ route('frontend.job-search') }}">

                                        <input type="hidden" name="jobsby" value="category">
                                        <input type="hidden" name="searchcategoryid" value="{{ $jobCategory->id }}">
                                        <button type="submit" class="btn text-truncate"
                                            style="width:100%; white-space:nowrap; overflow:hidden; text-overflow:ellipse;">{{ $jobCategory->jobCategoryName }}</button>
                                    </form>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>



    </section>


    <section>
        {{-- <style>
            p a {
                text-decoration: none;
                color: #000;
            }

            a {
                text-decoration: none !important;
            }
        </style> --}}

        {{-- <section class="popular">
            <div class="container-fluid search-container text-white py-4">
                <div class="container search-box">
                    <div class="row">
                        <div class="col-lg-12 search-inputs">
                            <h2 class="mt-5">Discover Your Next Opportunity.</h2>
                            <form method="GET" action="{{ route('frontend.job-search') }}">
                                <div class="row mt-4">
                                    <!-- Job Industry Dropdown -->
                                    <div
                                        class="col-lg-5 col-md-6 col-sm-12 col-12 mb-2 d-flex align-items-center position-relative">
                                        <!-- Left-side briefcase icon -->
                                        <i class="fa fa-briefcase position-absolute"
                                            style="left: 15px; top: 50%; transform: translateY(-50%); color: #555;"></i>

                                        <!-- Select Dropdown -->
                                        <select class="form-control pl-5 pr-4" name="jobIndustry"
                                            style="appearance: none; padding-left: 40px;">
                                            <option value="">Job Industry</option>
                                            @foreach ($industries as $industry)
                                                <option value="{{ $industry->industryName }}">{{ $industry->industryName }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <!-- Right-side dropdown arrow -->
                                        <i class="fa fa-chevron-down position-absolute"
                                            style="right: 25px; top: 50%; transform: translateY(-50%); color: #555;"></i>
                                    </div>
                                    <div
                                        class="col-lg-5 col-md-6 col-sm-12 col-12 mb-2 d-flex justify-content-center input-container">
                                        <i class="fa fa-map-marker-alt"></i>
                                        <input type="text" class="form-control" name="jobLocation"
                                            placeholder="Enter city, country" value="{{ request('jobLocation') }}">
                                    </div>

                                    <div class="col-lg-2 col-md-12 col-sm-12 col-12 mb-2">
                                        <button class="btn btn-light search-button">
                                            <i class="fa fa-search"></i> Search
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> --}}

        {{-- <div class="row popular-search">
                        <div class="col-lg-12">
                            <h4 class="mt-5">Popular Search</h4>
                            <div class="row text-center">
                                @foreach ($categories as $jobCategory)
                                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-2">
                                        <form action="{{ route('frontend.job-search') }}" method="GET">
                                            <input type="hidden" name="jobsby" value="category">
                                            <input type="hidden" name="searchcategoryid" value="{{ $jobCategory->id }}">
                                            <button type="submit"
                                                class="btn">{{ $jobCategory->jobCategoryName }}</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div> --}}
        </div>
        </div>

    </section>

    <section>
    <div class="container mt-5">
        <div class="row">

            <div class="col-md-8 job-job">
                <h2>Search Results</h2>
                <div class="container mt-4">
                    @if ($findJobs->count() > 0)
                        @foreach ($findJobs as $job)
                            <div class="position-relative">
                                @auth('job_seekers')
                                    <form action="{{ route('job.bookmark') }}" method="post"
                                        class="position-absolute end-0 me-1" style="top:0%; z-index:99;">
                                        @csrf
                                        @method('post')
                                        <input type="hidden" name="jobSeekerId"
                                            value="{{ Auth::guard('job_seekers')->user()->id }}">
                                        <input type="hidden" name="jobPostId" value="{{ $job->id }}" />

                                        <button type="submit" class="favourite-btn m-2" style="all:unset; cursor:pointer;">
                                            <img src="{{ asset('frontend/assets/Images/Vector.png') }}" alt="Favorite">
                                        </button>
                                    </form>
                                @endauth
                                <a href="{{ route('frontend.job-details', ['slug' => $job->jobSlug]) }}"
                                    class="text-dark d-block text-decoration-none mb-2">
                                    <div class="job-card-1">
                                        
                                        <img src="{{ $job->jobBanner ? asset('storage/' . $job->jobBanner) : asset('frontend/assets/Images/jobdefault.png') }}"
                                            alt="Company Image">
                                      
                                        
                                        <div class="job-card-body">

                                            <h5 class="card-title">{{ $job->jobTitle }}</h5>
                                            <p>Company Name: {{ $job->jobCompany->companyName }}</p>
                                            <p>Location: {{ $job->jobLocation }}</p>
                                            <p>Experience: {{ $job->experience }}</p>

                                            
                                            <p class="d-flex flex-wrap" >
                                                Source: 
                                                @if (empty($job->jobCompany->link1) && empty($job->jobCompany->link2) && empty($job->jobCompany->link3))
                                                    <span class="text-muted ms-2" >N/A</span>
                                                @else
                                                &nbsp;
                                                <a href="{{ $job->jobCompany->link1 }}"
                                                    target="_blank">{{ $job->jobCompany->link1}}</a> 
                                                &nbsp;
                                                <a href="{{ $job->jobCompany->link2 }}" target="_blank">{{ $job->jobCompany->link2 ? ', '. $job->jobCompany->link2 :'' }} </a>
                                                <a href="{{ $job->jobCompany->link3 }}"
                                                    target="_blank">{{$job->jobCompany->link3 ? ', '. $job->jobCompany->link3 :''}}</a>

                                                @endif
                                                
                                                </p>

                                        </div>
                                        <div class="full-width-border"></div>
                                        <div class="job-card-footer">
                                            <small>Apply before:
                                                {{ \Carbon\Carbon::parse($job->jobDeadline)->format('F d, Y') }}</small>
                                            <small>Views: {{ $job->jobViewerCount }}</small>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        @endforeach
                        <div class="row mt-3">
                            <nav>
                                <ul class="pagination justify-content-end converter">
                                    @if ($findJobs->onFirstPage())
                                        <li class="page-item disabled d-none">
                                            <a class="page-link primary_color_text">Previous</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link primary_color_text"
                                                href="{{ $findJobs->previousPageUrl() }}">Previous</a>
                                        </li>
                                    @endif

                                    @foreach ($findJobs->getUrlRange(1, $findJobs->lastPage()) as $page => $url)
                                        @if ($page == $findJobs->currentPage())
                                            <li class="page-item page-item active"><a class="page-link primary_color_text"
                                                    href="#">{{ $page }}</a></li>
                                        @else
                                            <li class="page-item"><a class="page-link primary_color_text"
                                                    href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach

                                    @if ($findJobs->currentPage() < $findJobs->lastPage() - 2)
                                        <li class="page-item"><a class="page-link primary_color_text">...</a></li>
                                        <li class="page-item"><a class="page-link primary_color_text"
                                                href="{{ $findJobs->url($findJobs->lastPage()) }}">{{ $findJobs->lastPage() }}</a>
                                        </li>
                                    @endif

                                    @if ($findJobs->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link primary_color_text"
                                                href="{{ $findJobs->nextPageUrl() }}">Next</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <a class="page-link primary_color_text">Next</a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @else
                        <div class="container my-5">
                            <div class="alert alert-warning" role="alert">
                                No jobs found.
                            </div>
                        </div>
                    @endif

                </div>
                {{-- <h3>Related Jobs</h3>
                    @foreach ($relatedJobs as $item)
                        <div class="container mt-4">
                            <a href="{{ route('frontend.job-details', ['slug' => $item->jobSlug]) }}" class="text-dark text-decoration-none">
                                <div class="job-card-1">
                                    <img src="{{ asset('storage/' . $item->jobBanner) }}" alt="Company Image">
                                    <div class="job-card-body">
                                        <h5 class="card-title">{{ $item->jobTitle }}</h5>
                                        <p>Company Name: {{ $item->jobCompany->companyName }}</p>
                                        <p>Location: {{ $item->jobLocation }}</p>
                                        <p>Experience: {{ $item->experience }}</p>
                                        <p>Source: <a href="{{ $item->jobCompany->link1 }}"
                                                target="_blank">{{ $item->jobCompany->link1 }}</a>, &nbsp; <a
                                                href="{{ $item->jobCompany->link2 }}"
                                                target="_blank">{{ $item->jobCompany->link2 }}</a>,
                                            &nbsp;<a href="{{ $item->jobCompany->link3 }}"
                                                target="_blank">{{ $item->jobCompany->link3 }}</a>
                                        </p>
                                    </div>
                                    <div class="full-width-border"></div>
                                    <div class="job-card-footer">
                                        <small>Apply before:
                                            {{ \Carbon\Carbon::parse($item->jobDeadline)->format('F d, Y') }}
                                        </small>
                                        <small>Views: {{ $item->jobViewerCount }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach --}}
            </div>

            <div class="col-md-4 px-4 mt-4">
                <div class="job-categories">
                    <h3 class="sidebar-title">Jobs by Category</h3>
                    <ul class="category-list">
                        @foreach ($categories as $item)
                            <li>
                                <form action="{{ route('frontend.job-search') }}" >
                                    
                                    <input type="hidden" name="jobsby" value="category">
                                    <input type="hidden" name="searchcategoryid" value="{{ $item->id }}">
                                    <button type="submit"
                                        style="all: unset; cursor: pointer;">{{ $item->jobCategoryName }}</button>
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
                                <form action="{{ route('frontend.job-search') }}" >
                                    
                                    <input type="hidden" name="jobsby" value="skill">
                                    <input type="hidden" name="searchstr" value="{{ $item }}">
                                    <button type="submit"
                                        style="all: unset; cursor: pointer;">{{ $item }}</button>
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
                                <form action="{{ route('frontend.job-search') }}">
                                    
                                    <input type="hidden" name="location" value="{{ $item }}">
                                    <button type="submit"
                                        style="all: unset; cursor: pointer;">{{ $item }}</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
    </section>
    @endsection
