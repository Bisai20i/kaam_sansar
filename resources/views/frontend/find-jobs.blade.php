@extends('frontend.layouts.main')
@section('title', 'Find Jobs')
@section('content')

    <style>
        .category-title {
            font-size: 24px;
            color: #0064A7;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>

    <section class="popular">
        <div class="container-fluid search-container text-white py-4">
            <div class="container search-box">
                <div class="row">
                    <div class="col-lg-12 search-inputs">
                        <h2 class="mt-5">Discover Your Next Opportunity.</h2>
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
        </div>
    </section>


    <section class="jobs">

        <style>
            .active7 {
                background-color: #0064A7 !important;
                color: #fff;
                border: #0064A7 !important;
            }
        </style>

        <div class="container my-4">
            <div class="d-flex gap-3 align-items-center flex-wrap">
                <h5 class="fw-semibold text-black mb-0">Filter by:</h5>
                <!-- Dropdown Button with Icon Trigger -->
                <div class="dropdown">
                    <button class="filter-btn px-4 py-2 rounded-pill bg-white border border-1" type="button"
                        id="remoteDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 18px;">
                        Job Site
                        <!-- The icon you provided triggering the dropdown -->
                        <i class="fa-solid fa-chevron-down ms-2"></i>
                    </button>
                    <!-- Dropdown menu -->
                    <ul class="dropdown-menu" aria-labelledby="remoteDropdown">
                        <li><a class="dropdown-item" href="{{ route('frontend.job-search',['filtersite' => 'remote']) }}">Remote</a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.job-search',['filtersite' => 'onsite']) }}">Onsite</a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.job-search',['filtersite' => 'hybrid']) }}">Hybrid</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="filter-btn px-4 py-2 rounded-pill bg-white border border-1 " type="button"
                        id="remoteDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 18px;">
                        Job Type
                        <!-- The icon you provided triggering the dropdown -->
                        <i class="fa-solid fa-chevron-down ms-2"></i>
                    </button>
                    <!-- Dropdown menu -->
                    <ul class="dropdown-menu" aria-labelledby="remoteDropdown">
                        <li><a class="dropdown-item" href="{{ route('frontend.job-search',['filtertype' => 'trainee']) }}">Internship</a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.job-search',['filtertype' => 'parttime']) }}">Part Time</a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.job-search',['filtertype' => 'fulltime']) }}">Full Time</a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.job-search',['filtertype' => 'casual']) }}">Casual</a></li>
                        
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="filter-btn px-4 py-2 rounded-pill bg-white border border-1 " type="button"
                        id="remoteDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 18px;">
                        All Jobs
                        <!-- The icon you provided triggering the dropdown -->
                        <i class="fa-solid fa-chevron-down ms-2"></i>
                    </button>
                    <!-- Dropdown menu -->
                    <ul class="dropdown-menu" aria-labelledby="remoteDropdown">
                        <li><a class="dropdown-item" href="{{ route('frontend.job-search',['filterfeature' => 'normal']) }}">Normal Jobs</a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.job-search',['filterfeature' => 'premium']) }}">Premium Jobs</a></li>
                        
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="filter-btn px-4 py-2 rounded-pill bg-white border border-1 " type="button"
                        id="remoteDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 18px;">
                        All Time
                        <!-- The icon you provided triggering the dropdown -->
                        <i class="fa-solid fa-chevron-down ms-2"></i>
                    </button>
                    <!-- Dropdown menu -->
                    <ul class="dropdown-menu" aria-labelledby="remoteDropdown">
                        <li><a class="dropdown-item" href="{{ route('frontend.job-search',['filterdate' => '1']) }}">1 Day Ago</a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.job-search',['filterdate' => '5']) }}">5 Days Ago</a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.job-search',['filterdate' => '15']) }}">15 Days Ago</a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.job-search',['filterdate' => '30']) }}">1 Month Ago</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="filter-btn px-4 py-2 rounded-pill bg-white border border-1 " type="button"
                        id="remoteDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 18px;">
                        Job Level
                        <!-- The icon you provided triggering the dropdown -->
                        <i class="fa-solid fa-chevron-down ms-2"></i>
                    </button>
                    <!-- Dropdown menu -->
                    <ul class="dropdown-menu" aria-labelledby="remoteDropdown">
                        <li><a class="dropdown-item" href="{{ route('frontend.job-search',['filterlevel' => 'entry']) }}">Entry Level</a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.job-search',['filterlevel' => 'mid']) }}">Mid Level</a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.job-search',['filterlevel' => 'senior']) }}">Senior Level</a></li>
                        
                    </ul>
                </div>
            </div>
            
        </div>
    
        <script>
            // Add click event to all buttons with class "filter-btn"
            const buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    buttons.forEach(btn => btn.classList.remove('active7'));
                    button.classList.add('active7');
                });
            });

            
        </script>

        
        @if (@$findJobs->count() > 0)
            <div class="container my-4 ">
                <h3 class="mb-4">Recommended Jobs for You</h3>
                <div class="row g-3 justify-content-center">
                    <!-- Job 1 -->

                    @foreach ($findJobs as $item)
                        <div class="col-md-6 col-lg-3 col-12 col-sm-12 job-card position-relative">
                            @auth('job_seekers')
                                <form action="{{ route('job.bookmark') }}" method="post"
                                    class="position-absolute end-0 me-4 mt-5" style="top:38%; z-index:15;">
                                    @csrf
                                    <input type="hidden" name="jobSeekerId"
                                        value="{{ Auth::guard('job_seekers')->user()->id }}">
                                    <input type="hidden" name="jobPostId" value="{{ $item->id }}" />

                                    <button type="submit" class="favourite-btn mt-2" style="all:unset; cursor:pointer;">
                                        <img src="{{ asset('frontend/assets/Images/Vector.png') }}" alt="Favorite">
                                    </button>
                                </form>
                            @else
                                <div class="position-absolute end-0 me-4 mt-5" style="top:38%; z-index:15;">
                                    <button type="submit" class="favourite-btn mt-2" style="all:unset; cursor:pointer;"
                                        data-bs-toggle="modal" data-bs-target="#loginModal">
                                        <img src="{{ asset('frontend/assets/Images/Vector.png') }}" alt="Favorite">
                                    </button>
                                </div>
                            @endauth


                            <a href="{{ route('frontend.job-details', ['slug' => $item->jobSlug]) }}"
                                class="text-decoration-none">
                                <div class="card" style="{{ $item->jobFeature == 'premium' ? 'border: 1px solid #FAAC24!important;' : '' }}">
                                    <div class="position-relative">
                                        @if($item->jobFeature == 'premium')
                                            <span class="position-absolute top-0 left-0 badge rounded-1 bg-warning">Premium</span>
                                        @endif
                                        <img src="{{ $item->jobBanner ? asset('storage/' . $item->jobBanner) : asset('frontend/assets/Images/jobdefault.png') }}"
                                        class="card-img-top rounded-1" alt="BMW">
                                    </div>
                                    <div class="card-body p-2">

                                        <h5 class="card-title text-truncate me-3 fw-bold my-1" >{{ $item->jobTitle }}</h5>

                                        <p class="card-text text-muted mb-0 fw-semibold">{{ $item->jobLevel }}</p>
                                        <p class="card-text text-muted mb-1 fw-semibold">{{ $item->jobLocation }}</p>
                                        <p class="card-text text-muted ">
                                            <small>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    
                </div>


                @if ($findJobs->hasMorePages() || $findJobs->currentPage() != 1)

                    <div class="row mt-3">
                        <nav>
                            <ul class="pagination justify-content-end converter">
                                {{-- Previous Button --}}
                                @if ($findJobs->onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link primary_color_text">&lt;</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link primary_color_text"
                                            href="{{ $findJobs->previousPageUrl() }}">&lt;</a>
                                    </li>
                                @endif

                                {{-- Pagination Numbers --}}
                                @php
                                    $currentPage = $findJobs->currentPage();
                                    $lastPage = $findJobs->lastPage();
                                    $pageRange = 2; // Number of pages to display before and after the current page
                                @endphp

                                {{-- Show First Page --}}
                                @if ($currentPage > $pageRange + 1)
                                    <li class="page-item">
                                        <a class="page-link primary_color_text" href="{{ $findJobs->url(1) }}">1</a>
                                    </li>
                                    @if ($currentPage > $pageRange + 2)
                                        <li class="page-item disabled"><span class="page-link">...</span></li>
                                    @endif
                                @endif

                                {{-- Show Pages Before Current Page --}}
                                @for ($i = max(1, $currentPage - $pageRange); $i < $currentPage; $i++)
                                    <li class="page-item">
                                        <a class="page-link primary_color_text"
                                            href="{{ $findJobs->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                {{-- Current Page --}}
                                <li class="page-item active">
                                    <span class="page-link" style="background: #196BA6;">{{ $currentPage }}</span>
                                </li>

                                {{-- Show Pages After Current Page --}}
                                @for ($i = $currentPage + 1; $i <= min($lastPage, $currentPage + $pageRange); $i++)
                                    <li class="page-item">
                                        <a class="page-link primary_color_text"
                                            href="{{ $findJobs->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                {{-- Show Last Page --}}
                                @if ($currentPage < $lastPage - $pageRange)
                                    @if ($currentPage < $lastPage - $pageRange - 1)
                                        <li class="page-item disabled"><span class="page-link">...</span></li>
                                    @endif
                                    <li class="page-item">
                                        <a class="page-link primary_color_text"
                                            href="{{ $findJobs->url($lastPage) }}">{{ $lastPage }}</a>
                                    </li>
                                @endif

                                {{-- Next Button --}}
                                @if ($findJobs->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link primary_color_text"
                                            href="{{ $findJobs->nextPageUrl() }}">&gt;</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <a class="page-link primary_color_text">&gt;</a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>


                @endif

            </div>
        @else
            <div class="container my-5">
                <div class="alert alert-warning" role="alert">
                    No jobs found.
                </div>
            </div>
        @endif



        <div class="container my-5">

            <div class="row flex-wrap gap-3 justify-content-center align-items-start">
                <div class="col col-md-6 col-lg-3 job-categories flex-grow-1 px-0" style="background: #F3F3F3;">
                    <h3 class="sidebar-title px-3">Jobs by Category</h3>
                    <ul class="category-list mb-0 overflow-auto px-3" style="max-height: 500px;">
                        @foreach ($categories as $item)
                            <li>
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
                <div class="col col-md-6 col-lg-3 job-categories flex-grow-1 px-0" style="background: #F3F3F3;">
                    <h3 class="sidebar-title px-3">Jobs by Skill</h3>
                    <ul class="category-list mb-0 px-3 overflow-auto" style="max-height: 500px;">
                        @foreach ($skills as $item)
                            <li>
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
                <div class="col col-md-6 col-lg-3 job-categories px-0 flex-grow-1" style="background: #F3F3F3;">
                    <h3 class="sidebar-title px-3">Jobs by Location</h3>
                    <ul class="category-list mb-0 overflow-auto px-3" style="max-height: 500px;">
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

        @if ($ad_banners['bottom'])
            <div class="container mb-2">
                <a href="{{ $ad_banners['bottom']->link }}" class="d-block"
                    style="text-decoration: none; cursor: pointer; object-fit: contain;">
                    <img src="{{ $ad_banners['bottom']->image }}" class="w-100" style="aspect-ratio: 4/1;"
                        alt="img-fluid">
                </a>
            </div>
            {{-- <h1 class="d-flex justify-content-center mt-5 mb-5">Advertisement Banner</h1> --}}
        @endif



    </section>
@endsection
