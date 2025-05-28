@extends('frontend.layouts.main')
@section('title', 'Home')

@section('content')

    <main>

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
                        <h4 class="mt-3">Popular Search</h4>
                        <div class="row text-center justify-content-center">
                            @foreach ($categories as $jobCategory)
                            <div class="col-auto g-2 ">
                                <form action="{{ route('frontend.job-search') }}">

                                            <input type="hidden" name="jobsby" value="category">
                                            <input type="hidden" name="searchcategoryid" value="{{ $jobCategory->id }}">
                                            <button type="submit" class="btn text-truncate"
                                                style="width:153px; white-space:nowrap; overflow:hidden; text-overflow:ellipse;">{{ $jobCategory->jobCategoryName }}</button>
                                        </form>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>



        </section>


    @if ($findJobs->count() > 0)
    <section class="jobs">
        <div class="container my-5">
            <h3 class="mb-3">Top Jobs</h3>
            <div class="row g-3 mb-4">
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
                        <button type="submit" class="favourite-btn mt-2" style="all:unset; cursor:pointer;" data-bs-toggle="modal" data-bs-target="#loginModal">
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

                                <h5 class="card-title text-truncate me-3 fw-bold my-1">{{ $item->jobTitle }}</h5>

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
            <!-- View More Button -->
            <div class="text-center my-4">
                <a href="{{ route('frontend.finds-jobs') }}" class="view-more">
                    View More</a>
            </div>
        </div>

            </section>
        @endif

        <section class="bn">
            <div class="container mb-0">
                <div class="banner">
                    <div class="banner-content pt-3 pb-5 "
                        style="background-image:url('{{ asset('frontend/assets/Images/planehimal.png') }}');">
                        <div class="book-flight">
                            <h2 class="">Book Flight Tickets</h2>
                            <ul>
                                <li><i class="fa-solid fa-check border border-2 p-1 "></i> Buy both Domestic and
                                    International flight tickets</li>
                                <li><i class="fa-solid fa-check border border-2 p-1 "></i> Get many offers on every purchase
                                </li>
                                <li><i class="fa-solid fa-check border border-2 p-1 "></i> Safe and well-maintained planes
                                </li>
                            </ul>
                        </div>
                        <div class="button-container mb-3">
                            <button class="btn btn-book-now">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- 
        <section class="my-5">
            <div class="container my-4">
                <div class="row g-4 card-container">
                    <!-- First Card -->
                    <div class="col-md-6 d-flex">
                        <div class="card1 w-100" id="first-card">
                            <img src="{{ asset('frontend/assets/Images/passport.png') }}" alt="Passport Renewal">
                            <div class="card-content">
                                <h4>Get Your Passport Renewed Today</h4>
                                <p>Renew Your Passport Easily and Hassle-Free</p>
                                @if (Auth::guard('job_seekers')->check())
                                    <a href="{{ route('passport.partial') }}" class="btn ">Start Renewal Now</a>
                                @else
                                    <button class="btn" data-bs-toggle="modal" data-bs-target="#loginModal">Start
                                        Renewal Now</a>
                                @endif

                        </div>
                    </div>
                </div>

                        </div>
                    </div>
                </div>

                <!-- Second Card (This is the card that will change every few seconds) -->
                <div class="col-md-6 d-flex">
                    <div class="card1 w-100" id="second-card">
                        <img src="{{ asset('frontend/assets/Images/sharam.png') }}" alt="Work Permit Renewal">
                        <div class="card-content">
                            <h4>Get Your Work Permit Renewed Today</h4>
                            <p>Trusted and Reliable Assistance for Securing Your Work Permit.</p>
                            @if (Auth::guard('job_seekers')->check())
                            <a href="{{ route('workPermits.create') }}" class="btn ">Start Work Permit Now</a>
                            @else
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#loginModal">Start Work
                                Permit Now</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        <!--Carousel for services-->

        <section class="py-5" style="background-color: #DDDEDE;">
            <div class="container my-4 position-relative ">
                <div id="carousel-wrapper">
                    <div id="card-slider">
                        <!-- Cards with class renamed to formcard -->

                        <div class="formcard card1" id="first-card">
                            <img src="{{ asset('frontend/assets/Images/passport.png') }}" alt="Passport Renewal">
                            <div class="card-content">
                                <h4>Get Your Passport Renewed Today</h4>
                                <p>Renew Your Passport Easily and Hassle-Free</p>
                                @if (Auth::guard('job_seekers')->check())
                                    <a href="{{ route('passport.partial') }}"
                                        class="btn bg-primary text-white fw-semibold px-4 py-2">Start Renewal Now</a>
                                @else
                                    <button class="btn bg-primary text-white fw-semibold px-4 py-2" data-bs-toggle="modal"
                                        data-bs-target="#loginModal">Start
                                        Renewal Now</a>
                                @endif

                            </div>
                        </div>

                        <div class="card1 formcard" id="second-card">
                            <img src="{{ asset('frontend/assets/Images/sharam.png') }}" alt="Work Permit Renewal">
                            <div class="card-content">
                                <h4>Get Your Work Permit Renewed Today</h4>
                                <p>Trusted and Reliable Assistance for Securing Your Work Permit.</p>
                                @if (Auth::guard('job_seekers')->check())
                                    <a href="{{ route('workPermits.create') }}"
                                        class="btn bg-primary text-white fw-semibold px-4 py-2">Start Work Permit Now</a>
                                @else
                                    <button class="btn bg-primary text-white fw-semibold px-4 py-2" data-bs-toggle="modal"
                                        data-bs-target="#loginModal">Start Work
                                        Permit Now</a>
                                @endif
                            </div>
                        </div>

                        <div class="formcard card1" id="first-card">
                            <img src="{{ asset('frontend/assets/Images/passport.png') }}" alt="Passport Renewal">
                            <div class="card-content">
                                <h4>Get Your Passport Renewed Today</h4>
                                <p>Renew Your Passport Easily and Hassle-Free</p>
                                @if (Auth::guard('job_seekers')->check())
                                    <a href="{{ route('passport.partial') }}"
                                        class="btn bg-primary text-white fw-semibold px-4 py-2">Start Renewal Now</a>
                                @else
                                    <button class="btn bg-primary text-white fw-semibold px-4 py-2" data-bs-toggle="modal"
                                        data-bs-target="#loginModal">Start
                                        Renewal Now</a>
                                @endif

                            </div>
                        </div>

                        <div class="card1 formcard" id="second-card">
                            <img src="{{ asset('frontend/assets/Images/sharam.png') }}" alt="Work Permit Renewal">
                            <div class="card-content">
                                <h4>Get Your Work Permit Renewed Today</h4>
                                <p>Trusted and Reliable Assistance for Securing Your Work Permit.</p>
                                @if (Auth::guard('job_seekers')->check())
                                    <a href="{{ route('workPermits.create') }}"
                                        class="btn bg-primary text-white fw-semibold px-4 py-2">Start Work Permit Now</a>
                                @else
                                    <button class="btn bg-primary text-white fw-semibold px-4 py-2" data-bs-toggle="modal"
                                        data-bs-target="#loginModal">Start Work
                                        Permit Now</a>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="formcard card1">
                            <img src="Images/sharam.png" alt="Passport Renewal" />
                            <div class="card-content">
                                <h4 class="" style="font-size: 32px; font-weight: 600;">Renew Passport</h4>
                                <p style="font-size: 18px; font-weight: 500;"> Renew Your Passport <br> Easily and
                                    Hassle-Free </p>
                                <a href="passport_renewal_form.html"
                                    class="btn bg-primary text-white fw-semibold px-4 py-2">Start
                                    Renewal Now</a>
                            </div>
                        </div> --}}
                        {{-- <div class="formcard card1">
                            <img src="Images/ads4.jpg" alt="Passport Renewal" />
                            <div class="card-content">
                                <h4 class="" style="font-size: 32px; font-weight: 600;">Renew Passport</h4>
                                <p style="font-size: 18px; font-weight: 500;"> Renew Your Passport <br> Easily and
                                    Hassle-Free </p>
                                <a href="passport_renewal_form.html"
                                    class="btn bg-primary text-white fw-semibold px-4 py-2">Start
                                    Renewal Now</a>
                            </div>
                        </div> --}}

                    </div>
                </div>
                <button id="prevBtn" class="carousel-btn d-grid">&#8249;</button>
                <button id="nextBtn" class="carousel-btn d-grid">&#8250;</button>
            </div>
        </section>

        <script>
            const slider = document.getElementById('card-slider');
            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');

            // Dynamically calculate scrollStep as width of 1 card + gap (10px)
            const scrollStep = slider.querySelector('.formcard').offsetWidth + 10;

            function scrollRight() {
                const maxScrollLeft = slider.scrollWidth - slider.clientWidth;
                if (slider.scrollLeft >= maxScrollLeft) {
                    slider.scrollTo({
                        left: 0,
                        behavior: 'smooth'
                    });
                } else {
                    slider.scrollBy({
                        left: scrollStep,
                        behavior: 'smooth'
                    });
                }
            }

            function scrollLeft() {
                if (slider.scrollLeft <= 0) {
                    const maxScrollLeft = slider.scrollWidth - slider.clientWidth;
                    slider.scrollTo({
                        left: maxScrollLeft,
                        behavior: 'smooth'
                    });
                } else {
                    slider.scrollBy({
                        left: -scrollStep,
                        behavior: 'smooth'
                    });
                }
            }

            function startAutoScroll() {
                autoScrollInterval = setInterval(() => {
                    const maxScrollLeft = slider.scrollWidth - slider.clientWidth;
                    if (slider.scrollLeft >= maxScrollLeft) {
                        slider.scrollTo({
                            left: 0,
                            behavior: 'auto'
                        });
                    } else {
                        slider.scrollBy({
                            left: scrollStep,
                            behavior: 'smooth'
                        });
                    }
                }, 2000);
            }

            function stopAutoScroll() {
                clearInterval(autoScrollInterval);
            }

            let autoScrollInterval;
            nextBtn.addEventListener('click', scrollRight);
            prevBtn.addEventListener('click', scrollLeft);
            slider.addEventListener('mouseenter', stopAutoScroll);
            slider.addEventListener('mouseleave', startAutoScroll);

            startAutoScroll();
        </script>



        <section class="cta">
            <div class="container mt-0">
                <!-- CTA Section -->
                <div class="cta-section py-5 mb-5">
                    <h3>Fuel Your Ambition, <br>Find Your Next Big Opportunity</h3>
                    <p>Your Dream Career Awaits - Download Our Job <br>Portal App and Start Your Journey to Success!</p>
                    <div class="qr">
                        <img src="{{ asset('frontend/assets/Images/qr1.png') }}" alt="Centered Image"
                            class="qr me-5 rounded-2 border border-4">
                    </div>
                    <div>
                        <div>
                            <a href="https://play.google.com/store/apps/details?id=com.example.yourapp" href="#"
                                class="btn ml-3" target="_blank" class=""><img
                                    src="{{ asset('frontend/assets/Images/google.png') }}" alt="Google Play"></a>

                        <a href="https://apps.apple.com/us/app/yourapp/id123456789" href="#" class="btn "
                            target="_blank" class="ml-3"><img
                                src="{{ asset('frontend/assets/Images/appstore.png') }}" alt="App Store"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @if ($blogs->count() > 0)
    <section class="news">
        <div class="container my-5">
            <h3 class="mb-4">News and Articles</h3>
            <div class="row g-3">
                @foreach ($blogs as $item)
                <div class="col-md-6 col-lg-3 col-12 col-sm-12 job-card">
                    <div class="card">
                        <a href="{{ route('frontend.news-detail', ['slug' => $item->slug]) }}" style="text-decoration:none;">
                            <!-- Display Image -->
                            <img src="{{ $item->imageUrl ? asset('storage/' . $item->imageUrl) : asset('frontend/assets/Images/default.png') }}"
                                class="card-img-top rounded-1" alt="{{ $item->title }}">
                        </a>

                        <div class="card-body">
                            <!-- Title only, no bookmark -->
                            <h5 class="card-title text-truncate mb-0">{{ $item->title }}</h5>

                            <!-- Date -->
                            <p class="card-text text-muted mt-1">
                                <small>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}</small>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('frontend.news-and-blogs') }}" class="view-more">View More</a>
            </div>
        </div>
    </section>
    @endif




        <section class="gift">
            <div class="container gift-section">
                <h3 class="mb-4">Gift and Coupons</h3>

                {{-- <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 row-cols-xl-6 g-3  ">

                    @if ($giftCoupons)
                        @foreach ($giftCoupons as $giftCoupon)
                            <div class="col flex-grow-1">
                                <div class="gift-card">
                                    <img src="{{ $giftCoupon->thumbnail ? asset('storage/') . '/' . $giftCoupon->thumbnail : asset('frontend/assets/Images/gift.png') }}"
            alt="img-fluid">
        </div>
        </div>
        @endforeach


        @endif




        </div> --}}

                <div class="row g-3">
                    @foreach ($giftCoupons as $item)
                        <div class="col-md-6 col-lg-3 col-12 col-sm-12 job-card">
                            <div class="card">
                                <a href="{{ route('gift.details', ['id' => $item->id]) }}" class="text-decoration-none">
                                    <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('frontend/assets/Images/giftandcoupon.png') }}"
                                        class="card-img-top rounded-1" alt="gift and coupon">
                                    <div class="card-body p-2">
                                        <h5 class="card-title text-truncate me-3 fw-bold my-1 text-dark">{{ $item->title }}</h5>
                                        <p class="card-text text-muted mb-1">NPR. {{ $item->price }}</p>
                                        <p class="card-text text-muted">
                                            <small>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach


                </div>



        <div class="text-center mt-4">
            <a href="{{ route('gift.home', ['type' => 'all']) }}" class="view-more">View More</a>
        </div>
        </div>
    </section>

        <section class="ads">
            <div class="container my-5">
                <h3 class="mb-4">Recent Ads</h3>
                <div class="row g-3">
                    <!-- Job 1 -->
                    @foreach ($ads as $ad)
                        <div class="col-md-6 col-lg-3 col-12 col-sm-12 job-card">
                            <div class="card">
                                <a href="{{ route('frontend.advertisements') }}" class="text-decoration-none">
                                    <img src="{{ $ad->adsThumbnail ? asset($ad->adsThumbnail) : asset('frontend/assets/Images/teddy-bear.jpg') }}"
                                        class="card-img-top rounded-1" alt="adsThumbnail">
                                    <div class="card-body p-2">
                                        <h5 class="card-title text-truncate me-3 fw-bold my-1 text-dark">{{ $ad->adsTitle }} </h5>
                                        <p class="card-text text-muted mb-1">{{ $ad->location }}</p>
                                        <p class="card-text text-muted"><small>{{ $ad->postedDuration }}</small></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach


            </div>
            <!-- View More Button -->
            <div class="text-center mt-4">
                <a href="{{ route('frontend.advertisements') }}" class="view-more">View More</a>
            </div>
        </div>
    </section>

        @if ($ad_banners['middle'])
            <div class="container">
                <a href="{{ $ad_banners['middle']->link }}" class="d-block"
                    style="text-decoration: none; cursor: pointer; object-fit: contain;">
                    <img src="{{ $ad_banners['middle']->image }}" class="w-100" style="aspect-ratio: 4/1;"
                        alt="img-fluid">
                </a>
            </div>

            {{-- <h1 class="d-flex justify-content-center mt-5 mb-5">Advertisement Banner</h1> --}}
        @endif

     @if ($podcasts->count() > 0)
    <section class="podcast">
        <div class="container my-5">
            <h3 class="mb-4">Podcast</h3>
            <div class="row g-3">
                @foreach ($podcasts as $item)
                <div class="col-md-6 col-lg-3 col-12 col-sm-12 job-card">
                    <div class="card">
                        <a href="{{ route('frontend.podcast-detail', ['slug' => $item->slug]) }}" style="text-decoration:none;">
                            <!-- Display Podcast Image -->
                            <div class="pi" style="height:150px;">
                                <img src="{{ $item->imageUrl ?? asset('frontend/assets/Images/default.png') }}"
                                    class="h-100 w-100 card-img-top rounded-1" alt="..." style="object-fit:cover;">

                                <div class="pio">
                                    <h1><i class="fa-solid fa-circle-play fs-1 text-white"></i></h1>
                                </div>
                            </div>
                        </a>

                        <div class="card-body p-2">
                            <!-- Display Podcast Title -->
                            <div style="width: 100%; overflow: hidden;">
                                <a href="{{ route('frontend.podcast-detail', ['slug' => $item->slug]) }}"
                                    class="card-title text-truncate d-block mb-0"
                                    style="text-decoration: none; color: inherit;">
                                    {{ $item->title }}
                                </a>
                            </div>


                            <!-- Display Podcast Duration -->
                            <p class="card-text text-muted mb-1">
                                @php
                                $podcastDuration = \Carbon\Carbon::parse($item->podcastTime);
                                @endphp
                                {{ $podcastDuration->hour }} hour {{ $podcastDuration->minute }} minutes {{ $podcastDuration->second }} sec
                            </p>

                            <!-- Display Date -->
                            <p class="card-text text-muted">
                                <small>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}</small>
                            </p>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>

            <!-- View More Button -->
            <div class="text-center mt-4">
                <a href="{{ route('frontend.podcasts') }}" class="view-more">View More</a>
            </div>
        </div>
    </section>
    @endif


    <!--     
<script>
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const buttons = document.querySelectorAll('.bookmark-toggle-btn');

    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const podcastId = this.getAttribute('data-podcast-id');
            const isBookmarked = this.getAttribute('data-bookmarked') === '1';

            let url = '';
            let method = 'POST';  // default POST method
            let body = null;

            if (isBookmarked) {
                url = `/bookmark/podcast/remove/${podcastId}`;
                // Usually removal uses DELETE method, but if your route expects POST, keep it
                // If you want DELETE, change below accordingly
                method = 'POST';
            } else {
                url = `/bookmark/podcast`;
                method = 'POST';
                body = JSON.stringify({
                    blogs_and_podcasts_id: podcastId,
                    type: 'podcast'
                });
            }

            console.log(`Sending ${method} request to ${url} with body:`, body);

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                credentials: 'same-origin',  // Send cookies/session info!
                body: body
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (response.status === 419) {
                    alert('Session expired. Please refresh the page and try again.');
                    throw new Error('CSRF token mismatch or session expired');
                }
                return response.json();
            })
            .then(json => {
                console.log('Response JSON:', json);
                if (json.success) {
                    this.setAttribute('data-bookmarked', isBookmarked ? '0' : '1');

                    const icon = this.querySelector('i');
                    if (isBookmarked) {
                        icon.classList.remove('fas', 'text-primary');
                        icon.classList.add('far', 'text-muted');
                        this.setAttribute('title', 'Add Bookmark');
                    } else {
                        icon.classList.remove('far', 'text-muted');
                        icon.classList.add('fas', 'text-primary');
                        this.setAttribute('title', 'Remove Bookmark');
                    }
                } else {
                    alert(json.message || 'Something went wrong!');
                }
            })
            .catch(err => {
                console.error('Fetch error:', err);
                alert('An error occurred while processing your request.');
            });
        });
    });
});
</script> -->













        <section class="FAQ">
            <div class="container mb-4">
                <h3 class="mb-4 text-primary">FAQ </h3>

                <!-- Accordion Wrapper -->
                <div id="accordionFAQ">

                    @foreach ($faqs as $index => $faq)
                        <!-- FAQ Item Dynamic -->
                        <div class="border w-100 p-3 rounded bg-light-subtle mb-2">
                            <a class="d-flex justify-content-between align-items-center text-dark text-decoration-none"
                                data-bs-toggle="collapse" href="#faqItem{{ $index }}" role="button"
                                aria-expanded="false" aria-controls="faqItem{{ $index }}">
                                <h5 class="fs-6 mb-0">
                                    {{ $faq->question }}
                                </h5>
                                <i class="fa fa-chevron-down rotate-icon"></i>
                            </a>

                            <div class="collapse" id="faqItem{{ $index }}" data-bs-parent="#accordionFAQ">
                                <div class="mb-0 mt-2">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <style>
            .rotate-icon {
                transition: transform 0.3s ease;
            }

            a[aria-expanded="true"] .rotate-icon {
                transform: rotate(180deg);
            }

            a[aria-expanded="false"] .rotate-icon {
                transform: rotate(0deg);
            }
        </style>
    </main>
@endsection

@push('scripts')
    {{-- <script>
        let currentCardIndex = 0; // Index to keep track of the current second card content
        const secondCard = document.getElementById("second-card"); // Target the second card

        const images = [{
                image: "{{asset('frontend/assets/Images/sharam.png')}}",
title: "Get Your Work Permit Renewed Today",
description: "Trusted and Reliable Assistance for Securing Your Work Pe rmit."
},
{
image: "{{asset('frontend/assets/Images/nagarikta.png')}}",
title: "Renew Your Visa Quickly",
description: "Fast & Secure Visa Renewal Services"
}
]; // Cards content to cycle

function changeSecondCardContent() {
// Cycle through the array of cards for the second card's content
currentCardIndex = (currentCardIndex + 1) % images.length; // Update the index to the next card

const newCard = images[currentCardIndex]; // Get the new card content

// Update the second card with new content
secondCard.querySelector("img").src = newCard.image;
secondCard.querySelector("h4").textContent = newCard.title;
secondCard.querySelector("p").textContent = newCard.description;
}

// Change the content of the second card every 5 seconds
setInterval(changeSecondCardContent, 3000);
</script> --}}
@endpush
