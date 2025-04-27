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
        @if (@$findJobs->count() > 0)
            <div class="container my-5">
                <h3 class="mb-4">Top Jobs</h3>
                <div class="row g-3 justify-content-center">
                    <!-- Job 1 -->
                    @foreach ($findJobs as $item)
                        <div class="col-md-6 col-lg-3 col-12 col-sm-12 job-card position-relative">
                            @auth('job_seekers')
                                <form action="{{ route('job.bookmark') }}" method="post"
                                    class="position-absolute end-0 me-4 mt-5" style="top:40%; z-index:15;">
                                    @csrf
                                    <input type="hidden" name="jobSeekerId"
                                        value="{{ Auth::guard('job_seekers')->user()->id }}">
                                    <input type="hidden" name="jobPostId" value="{{ $item->id }}" />

                                    <button type="submit" class="favourite-btn" style="all:unset; cursor:pointer;">
                                        <img src="{{ asset('frontend/assets/Images/Vector.png') }}" alt="Favorite">
                                    </button>
                                </form>
                            @endauth
                            <a href="{{ route('frontend.job-details', ['slug' => $item->jobSlug]) }}"
                                class="text-decoration-none">
                                <div class="card">
                                    <img src="{{ $item->jobBanner ? asset('storage/' . $item->jobBanner) : asset('frontend/assets/Images/jobdefault.png') }}"
                                        class="card-img-top" alt="JobBanner">
                                    <div class="card-body">
                                        {{-- <button class="favourite-btn">
                                            <img src="{{ asset('frontend/assets/Images/Vector.png') }}" alt="Favorite">
                                        </button> --}}
                                        <h5 class="card-title">{{ $item->jobTitle }}</h5>

                                        <p class="card-text text-muted mb-1">{{ $item->jobLevel }}</p>
                                        <p class="card-text text-muted">{{ $item->jobLocation }}</p>
                                        <p class="card-text text-muted">
                                            <small>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
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
                                    <a class="page-link primary_color_text" href="{{ $findJobs->nextPageUrl() }}">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <a class="page-link primary_color_text">Next</a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        @else
            <div class="container my-5">
                <div class="alert alert-warning" role="alert">
                    No jobs found.
                </div>
            </div>
        @endif



        <div class="container my-5">

            <div class="d-flex flex-wrap gap-4">
                <div class="col col-md-6 col-lg-3 job-categories flex-grow-1">
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
                <div class="col col-md-6 col-lg-3 job-categories flex-grow-1">
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
                <div class="col col-md-6 col-lg-3 job-categories flex-grow-1">
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



    </section>
@endsection
