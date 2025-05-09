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
                        <form action="{{ route('frontend.job-search', request()->all()) }}"
                            class="row mt-4 align-items-center">

                            @foreach (request()->except(['searchstr', 'location']) as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach


                            <div
                                class="col-lg-5 col-md-6 col-sm-12 col-12 mb-2 d-flex justify-content-center align-items-center input-container">
                                <i class="fa fa-user"></i>

                                <input type="text" class="form-control" name="searchstr" placeholder="Key words"
                                    value="{{ request('searchstr') }}">
                            </div>
                            <!-- Input for Location -->
                            <div
                                class="col-lg-5 col-md-6 col-sm-12 col-12 mb-2 d-flex align-items-center justify-content-center input-container">
                                <i class="fa fa-map-marker-alt"></i>
                                <input type="text" class="form-control" name="location" value="{{ request('location') }}"
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

    @if ($ad_banners['top'])
        <div class="container">
            <a href="{{ $ad_banners['top']->link }}" class="d-block"
                style="text-decoration: none; cursor: pointer; object-fit: contain;">
                <img src="{{ $ad_banners['top']->image }}" class="w-100" style="aspect-ratio: 4/1;" alt="img-fluid">
            </a>
        </div>
        {{-- <h1 class="d-flex justify-content-center mt-5 mb-5">Advertisement Banner</h1> --}}
    @endif


    <section>
        <div class="container mt-2">

            <style>
                .active7 {
                    background-color: #0064A7 !important;
                    color: #fff;
                    border: #0064A7 !important;
                }
            </style>
            <div class="d-flex gap-3 align-items-center flex-wrap my-4">
                <h5 class="fw-semibold text-black mb-0">Filter by:</h5>

                <!-- Job Site Filter -->
                <div class="dropdown">
                    <button
                        class="filter-btn px-4 py-2 rounded-pill bg-white border border-1 {{ request()->has('filtersite') ? 'active7' : '' }}"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 18px;">
                        {{ request()->has('filtersite') ? ucfirst(request('filtersite')) : 'Job Site' }}
                        <i class="fa-solid fa-chevron-down ms-2"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item"
                                href="{{ url()->current() . '?' . http_build_query(request()->except('filtersite','page')) }}">
                                Job Site
                            </a>
                        </li>
                        @foreach (['remote', 'onsite', 'hybrid'] as $site)
                            <li>
                                <a class="dropdown-item"
                                    href="{{ url()->current() . '?' . http_build_query(array_merge(request()->except('filtersite','page'), ['filtersite' => $site])) }}">
                                    {{ ucfirst($site) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Job Type Filter -->
                <div class="dropdown">
                    <button
                        class="filter-btn px-4 py-2 rounded-pill bg-white border border-1 {{ request()->has('filtertype') ? 'active7' : '' }}"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 18px;">
                        {{ request()->has('filtertype') ? (request('filtertype') == 'trainee' ? 'Internship' : ucfirst(request('filtertype'))) : 'Job Type' }}
                        <i class="fa-solid fa-chevron-down ms-2"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item"
                                href="{{ url()->current() . '?' . http_build_query(request()->except('filtertype','page')) }}">
                                All Types
                            </a>
                        </li>
                        @php $types = ['trainee' => 'Internship', 'parttime' => 'Part Time', 'fulltime' => 'Full Time', 'casual' => 'Casual']; @endphp
                        @foreach ($types as $key => $label)
                            <li>
                                <a class="dropdown-item"
                                    href="{{ url()->current() . '?' . http_build_query(array_merge(request()->except('filtertype','page'), ['filtertype' => $key])) }}">
                                    {{ $label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Job Feature Filter -->
                <div class="dropdown">
                    <button
                        class="filter-btn px-4 py-2 rounded-pill bg-white border border-1 {{ request()->has('filterfeature') ? 'active7' : '' }}"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 18px;">
                        {{ request()->has('filterfeature') ? ucfirst(request('filterfeature')) : 'All Jobs' }}
                        <i class="fa-solid fa-chevron-down ms-2"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item"
                                href="{{ url()->current() . '?' . http_build_query(request()->except('filterfeature','page')) }}">
                                All Jobs
                            </a>
                        </li>
                        @foreach (['normal' => 'Normal Jobs', 'premium' => 'Premium Jobs'] as $key => $label)
                            <li>
                                <a class="dropdown-item"
                                    href="{{ url()->current() . '?' . http_build_query(array_merge(request()->except('filterfeature','page'), ['filterfeature' => $key])) }}">
                                    {{ $label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Job Post Time Filter -->
                <div class="dropdown">
                    <button
                        class="filter-btn px-4 py-2 rounded-pill bg-white border border-1 {{ request()->has('filterdate') ? 'active7' : '' }}"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 18px;">
                        {{ request()->has('filterdate') ? request('filterdate') . ' Days Ago' : 'Job Post Time' }}
                        <i class="fa-solid fa-chevron-down ms-2"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item"
                                href="{{ url()->current() . '?' . http_build_query(request()->except('filterdate','page')) }}">
                                All Time
                            </a>
                        </li>
                        @foreach ([1, 5, 15, 30] as $days)
                            <li>
                                <a class="dropdown-item"
                                    href="{{ url()->current() . '?' . http_build_query(array_merge(request()->except('filterdate','page'), ['filterdate' => $days])) }}">
                                    {{ $days == 30 ? '1 Month Ago' : $days . ' Day' . ($days > 1 ? 's' : '') . ' Ago' }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Job Level Filter -->
                <div class="dropdown">
                    <button
                        class="filter-btn px-4 py-2 rounded-pill bg-white border border-1 {{ request()->has('filterlevel') ? 'active7' : '' }}"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 18px;">
                        {{ request()->has('filterlevel') ? ucfirst(request('filterlevel')) : 'Job Level' }}
                        <i class="fa-solid fa-chevron-down ms-2"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item"
                                href="{{ url()->current() . '?' . http_build_query(request()->except('filterlevel','page')) }}">
                                All Job Levels
                            </a>
                        </li>
                        @foreach (['entry' => 'Entry Level', 'mid' => 'Mid Level', 'senior' => 'Senior Level'] as $key => $label)
                            <li>
                                <a class="dropdown-item"
                                    href="{{ url()->current() . '?' . http_build_query(array_merge(request()->except('filterlevel','page'), ['filterlevel' => $key])) }}">
                                    {{ $label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>






            {{-- <script>
                // Add click event to all buttons with class "filter-btn"
                const buttons = document.querySelectorAll('.filter-btn');
                buttons.forEach(button => {
                    button.addEventListener('click', () => {
                        buttons.forEach(btn => btn.classList.remove('active7'));
                        button.classList.add('active7');
                    });
                });
            </script> --}}


            <div class="row">

                <div class="col-md-8 job-job mb-1">
                    @if (request('jobsby') && request('searchstr'))
                        <h2>Search Results for <span style="color: #0064A7">" {{ request('searchstr') }} "</span>
                            in {{ ucfirst(request('jobsby')) }} <span style="color: #0064A7">"
                                {{ request('jobsby') == 'category' ? App\Models\JobCategory::find(request('searchcategoryid'))->jobCategoryName : (request('jobsby') == 'skill' ? ucfirst(request('skill')) : ucfirst(request('location'))) }}
                                "</span></h2>
                    @elseif(request('jobsby') && !request('searchstr'))
                        <h2>Jobs by {{ ucfirst(request('jobsby')) }} <span style="color: #0064A7">"
                                {{ request('jobsby') == 'category' ? App\Models\JobCategory::find(request('searchcategoryid'))->jobCategoryName : (request('jobsby') == 'skill' ? ucfirst(request('skill')) : ucfirst(request('location'))) }}
                                "</span> </h2>
                    @elseif(request('searchstr') && !request('jobsby'))
                        <h2>Search Results for <span style="color: #0064A7">" {{ request('searchstr') }} "</span></h2>
                    @else
                        <h2>All Jobs Lists</h2>
                    @endif
                    <div class="px-0 container mt-4">
                        @if ($findJobs->count() > 0)
                            @foreach ($findJobs as $job)
                                <div class="position-relative mx-0 px-0 mb-3">

                                    @auth('job_seekers')
                                        <form action="{{ route('job.bookmark') }}" method="post"
                                            class="position-absolute end-0 m-1" style="top:0%; z-index:99;">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="jobSeekerId"
                                                value="{{ Auth::guard('job_seekers')->user()->id }}">
                                            <input type="hidden" name="jobPostId" value="{{ $job->id }}" />

                                            <button type="submit" class="favourite-btn" style="all:unset; cursor:pointer;">
                                                <img src="{{ asset('frontend/assets/Images/Vector.png') }}" class="p-2"
                                                    alt="Favorite">
                                            </button>
                                        </form>
                                    @endauth

                                    <a href="{{ route('frontend.job-details', ['slug' => $job->jobSlug]) }}"
                                        class="text-dark d-block text-decoration-none ">

                                        <div class="job-card-1 p-0 border border-secondary border-1 mb-3 position-relative"
                                            style="{{ $job->jobFeature == 'premium' ? 'border: 1px solid #FAAC24!important;' : '' }}">

                                            @if ($job->jobFeature == 'premium')
                                                <span
                                                    class="position-absolute top-0 left-0 badge rounded-1 bg-warning m-3">Premium</span>
                                            @endif

                                            <div class="d-flex p-2 p-md-3">
                                                <img src="{{ $job->jobBanner ? asset('storage/' . $job->jobBanner) : asset('frontend/assets/Images/jobdefault.png') }}"
                                                    alt="Company Image" class="rounded">


                                                <div class="job-card-body">

                                                    <h5 class="card-title" style="max-width: 95%;">{{ $job->jobTitle }}
                                                    </h5>
                                                    <p>Company Name: {{ $job->jobCompany->companyName }}</p>
                                                    <p>Location: {{ $job->jobLocation }}</p>
                                                    <p>Experience: {{ $job->experience }}</p>


                                                    <p class="d-flex flex-wrap">
                                                        Source:
                                                        @if (empty($job->jobCompany->link1) && empty($job->jobCompany->link2) && empty($job->jobCompany->link3))
                                                            <span class="text-muted ms-2">N/A</span>
                                                        @else
                                                            &nbsp;
                                                            <a href="{{ $job->jobCompany->link1 }}"
                                                                target="_blank">{{ $job->jobCompany->link1 }}</a>
                                                            &nbsp;
                                                            <a href="{{ $job->jobCompany->link2 }}"
                                                                target="_blank">{{ $job->jobCompany->link2 ? ', ' . $job->jobCompany->link2 : '' }}
                                                            </a>
                                                            <a href="{{ $job->jobCompany->link3 }}"
                                                                target="_blank">{{ $job->jobCompany->link3 ? ', ' . $job->jobCompany->link3 : '' }}</a>
                                                        @endif

                                                    </p>

                                                </div>


                                            </div>

                                            <div class="full-width-border"
                                                style="{{ $job->jobFeature == 'premium' ? 'border-top: 0.5px solid #FAAC24!important;' : '' }}">
                                            </div>
                                            <div class="job-card-footer p-2 p-md-3 mt-0">
                                                <small>Apply before:
                                                    {{ \Carbon\Carbon::parse($job->jobDeadline)->format('F d, Y') }}</small>
                                                <small>Views: {{ $job->jobViewerCount }}</small>
                                            </div>

                                        </div>

                                    </a>

                                </div>
                            @endforeach

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
                                                    <a class="page-link primary_color_text"
                                                        href="{{ $findJobs->url(1) }}">1</a>
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
                                                <span class="page-link"
                                                    style="background: #196BA6;">{{ $currentPage }}</span>
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

                {{-- <div class="col-md-4 px-2 mt-4">
                    <div class="job-categories">
                        <h3 class="sidebar-title">Jobs by Category</h3>
                        <ul class="category-list">
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
                    <div class="job-categories mt-4">
                        <h3 class="sidebar-title">Jobs by Skill</h3>
                        <ul class="category-list">
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

                </div> --}}

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
                                        <input type="hidden" name="skill" value="{{ $item }}">
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

                                        <input type="hidden" name="jobsby" value="location">
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
        </div>
    </section>
@endsection
