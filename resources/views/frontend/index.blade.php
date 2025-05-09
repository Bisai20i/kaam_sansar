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
                                    <div class="col g-2 ">
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
                    <!-- View More Button -->
                    <div class="text-center my-4">
                        <a href="{{ route('frontend.finds-jobs') }}" class="view-more" >
                           View More</a>
                    </div>
                </div>

    </section>
    @endif

        <section class="bn">
            <div class="container">
              <div class="banner">
                <div class="banner-content pt-3 pb-5 " style="background-image:url('{{ asset('frontend/assets/Images/planehimal.png') }}');">
                  <div class="book-flight">
                    <h2 class="">Book Flight Tickets</h2>
                  <ul>
                    <li><i class="fa-solid fa-check border border-2 p-1 "></i> Buy both Domestic and International flight tickets</li>
                    <li><i class="fa-solid fa-check border border-2 p-1 "></i> Get many offers on every purchase</li>
                    <li><i class="fa-solid fa-check border border-2 p-1 "></i> Safe and well-maintained planes</li>
                  </ul>
                  </div>
                  <div class="button-container mb-3">
                    <button class="btn btn-book-now">Book Now</button>
                  </div>
                </div>
              </div>
            </div>
          </section>


        <section class="my-5">
            <div class="container my-4">
                <div class="row g-4 card-container">
                    <!-- First Card -->
                    <div class="col-md-6 d-flex">
                        <div class="card1 w-100" id="first-card">
                            <img src="{{asset('frontend/assets/Images/passport.png')}}" alt="Passport Renewal">
                            <div class="card-content">
                                <h4>Get Your Passport Renewed Today</h4>
                                <p>Renew Your Passport Easily and Hassle-Free</p>
                                @if(Auth::guard('job_seekers')->check())
                                    <a href="{{route('passport.partial')}}" class="btn ">Start Renewal Now</a>
                                @else
                                <button  class="btn" data-bs-toggle="modal" data-bs-target="#loginModal">Start Renewal Now</a>
                                @endif
                                
                            </div>
                        </div>
                    </div>

                <!-- Second Card (This is the card that will change every few seconds) -->
                <div class="col-md-6 d-flex">
                    <div class="card1 w-100" id="second-card">
                        <img src="{{asset('frontend/assets/Images/sharam.png')}}" alt="Work Permit Renewal">
                        <div class="card-content">
                            <h4>Get Your Work Permit Renewed Today</h4>
                            <p>Trusted and Reliable Assistance for Securing Your Work Permit.</p>
                            <a href="#" class="btn ">Start Renewal Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



        <section class="cta">
            <div class="container">
                <!-- CTA Section -->
                <div class="cta-section py-5 mb-5">
                    <h3>Fuel Your Ambition, <br>Find Your Next Big Opportunity</h3>
                    <p>Your Dream Career Awaits - Download Our Job <br>Portal App and Start Your Journey to Success!</p>
                    <div class="qr">
                        <img src="{{ asset('frontend/assets/Images/qr1.png') }}" alt="Centered Image" class="qr me-5">
                    </div>
                    <div>
                        <div>
                            <a href="https://play.google.com/store/apps/details?id=com.example.yourapp" href="#"
                                class="btn ml-3"target="_blank" class=""><img
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
                <!-- News and Articles Section -->
                <div class="container my-5">
                    <h3 class="mb-4">News and Articles</h3>
                    <div class="row g-3">
                        @foreach ($blogs as $item)
                            <div class="col-md-6 col-lg-3 col-12 col-sm-12 job-card">
                                <a href="{{ route('frontend.news-detail', ['slug' => $item->slug]) }}"
                                    style="text-decoration:none;">
                                    <div class="card">
                                        <!-- Display Image -->
                                        <img src="{{ $item->imageUrl ? asset('storage/' . $item->imageUrl) : asset('frontend/assets/Images/default.png') }}"
                                            class="card-img-top rounded-1" alt="{{ $item->title }}">
                                        <div class="card-body">
                                            <!-- Display Title -->
                                            <h5 class="card-title text-truncate" style="">{{ $item->title }}</h5>
                                            <!-- Display Date (or any other date you have in the database) -->
                                            <p class="card-text text-muted">
                                                <small>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}</small>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('frontend.news-and-blogs') }}" class="view-more">View More</a>
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

        <div class="row g-3 align-items-center row-cols-1 row-cols-md-3 row-cols-lg-5">
            @foreach ($giftCoupons as $item)
            <div class="col gift-card h-100">


                            <a href="{{ route('gift.details', ['id' => $item->id]) }}"
                                class="text-decoration-none shadow-sm">
                                <div class="card">
                                    <img style="height: 175px; object-fit:cover;" src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('frontend/assets/Images/giftandcoupon.png') }}"
                                        class="card-img-top img-fluid" alt="giftNcoupon">
                                    <div class="card-body text-start">

                                        <h5 class="card-title mb-1 text-truncate">{{ $item->title }}</h5>

                            <p class="card-text text-muted mb-1">NPR. {{ $item->price }}</p>
                            <p class="card-text text-muted ">
                                <small>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                </small>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

            <div class="col gift-card">


                <a href="{{ route('aboarddeals') }}"
                    class="text-decoration-none">
                    <div class="card">
                        <img src="{{ asset('frontend/assets/Images/giftiphone.png') }}"
                            class="card-img-top shadow" alt="abroadDeals">
                        {{-- <div class="card-body">

                                    <h5 class="card-title mb-2">{{ $item->title }}</h5>

                        <p class="card-text text-muted mb-1">NPR. {{ $item->price }}</p>
                        <p class="card-text text-muted ">
                            <small>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                            </small>
                        </p>
                    </div> --}}
            </div>
            </a>
        </div>
        {{-- <div class="col" style="height:100%;">
                        <div class="gift-card flex-grow-1 p-0">
                            <a href="">

                                <img src="{{ asset('frontend/assets/Images/giftiphone.png') }}" class="" alt="img-fluid">
        </a>
        </div>
        </div> --}}
        </div>

        {{-- <div class="row g-3 justify-content-center align-items-center row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 mt-2">

                    @if ($giftCoupons->count() > 0)
                        @foreach ($giftCoupons as $gNc)
                            <div class="col" name="giftCouponItem" data-gNcId="{{ $gNc->id }}" style="cursor: pointer;">

        <div class="card-bdy-packages-gifts">
            @if ($gNc->discount > 0)
            <div class="discount-badge">{{ $gNc->discount }}% OFF</div>
            @endif

            <img src="{{ $gNc->thumbnail ? asset('storage/' . $gNc->thumbnail) : asset('frontend/assets/Images/giftandcoupon.png') }}"
                class="bdy-packages-img product-image-gifts" id="product-image-gift"
                style="height: 200px;">
            <div class="card-body d-flex justify-content-between align-items-center ">
                <p class="text-truncate my-2">{{ $gNc->title }}</p>
                <form action="{{ Auth::guard('job_seekers')->check() ? route('addtocart') : route('set.redirect') }}" class="d-inline" method="post">
                    @csrf
                    <input type="hidden" name="couponId" value="{{ $gNc->id }}">
                    @if (Auth::guard('job_seekers')->check())
                    <input type="hidden" name="jobSeekerId"
                        value="{{ Auth::guard('job_seekers')->user()->id }}">
                    <button type="submit" style="all: unset; cursor: pointer;">
                        <i class="bi bi-plus-lg ms-auto gift-cart"></i>
                    </button>
                    @else
                    <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                    <button type="submit" style="all: unset; cursor: pointer;">
                        <i class="bi bi-plus-lg ms-auto gift-cart"></i>
                    </button>
                    @endif

                </form>

            </div>
            <div class="price-gift mb-3">
                @if ($gNc->discount > 0)
                <del>Nrs. {{ $gNc->price }}</del>
                @endif

                <p class="price">NRs.
                    {{ number_format((100 - $gNc->discount) * $gNc->price * 0.01, 2) }}
                </p>
            </div>

            <div class="gift-info">
                {!! $gNc->quantity > 0
                ? '<div class="instock-gift">Instock: ' . $gNc->quantity . '</div>'
                : '<div class="outstock-gift">Out of Stock</div>' !!}
                <div class="item-code-gift ">Item Code: {{ $gNc->itemCode }}</div>
            </div>
            <div class="sold-by-gift mt-3 mb-1 px-2"> Published By:
                <a href="{{ route('gift.seller', ['id' => $gNc->adminId]) }}"
                    class="text-underline ps-2 sold-by-link" style="cursor: pointer;">
                    {{ $gNc->admin->fullName }}
                    <i class="bi bi-arrow-right ps-2"></i>
                </a>
            </div>

        </div>

        </div>
        @endforeach
        @else
        <p class="text-danger text-center"> No Items Found !</p>
        @endif

        <div class="col" style="height:max-content">
            <div class="gift-card flex-grow-1 p-0 w-100">
                <a href="{{ route('aboarddeals') }}">

                    <img src="{{ asset('frontend/assets/Images/giftiphone.png') }}" class="w-100" alt="img-fluid">
                </a>
            </div>
        </div>



        </div> --}}

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
                        <a href="{{ route('frontend.advertisements') }}"
                            class="text-decoration-none">
                                <img src="{{ asset($ad->adsThumbnail) }}" class="card-img-top rounded-1" alt="adsThumbnail">
                                <div class="card-body p-2">
                                    <h5 class="card-title">{{ $ad->adsTitle }} </h5>
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

        @if($ad_banners['middle'])

            <div class="container">
                <a href="{{ $ad_banners['middle']->link }}" class="d-block" style="text-decoration: none; cursor: pointer; object-fit: contain;">
                    <img src="{{ $ad_banners['middle']->image }}" class="w-100" style="aspect-ratio: 4/1;" alt="img-fluid">
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
                                <a href="{{ route('frontend.podcast-detail', ['slug' => $item->slug]) }}"
                                    style="text-decoration:none;">
                                    <div class="card">
                                        <!-- Display Podcast Image -->
                                        <div class="pi" style="height:150px;">
                                            <img src="{{ $item->imageUrl ? asset('storage/' . $item->imageUrl) : asset('frontend/assets/Images/default.png') }}"
                                                class=" h-100 w-100 card-img-top rounded-1" alt="..."
                                                style="object-fit:cover;">
                                            <div class="pio">
                                                <h1><i class="fa-solid fa-circle-play fs-1 text-white"></i></h1>
                                            </div>
                                        </div>
                                        <div class="card-body p-2">
                                            <!-- Display Podcast Title -->
                                            <h5 class="card-title text-truncate">{{ $item->title }}</h5>
                                            <!-- Display Podcast Duration -->
                                            <p class="card-text text-muted mb-1">
                                                @php
                                                    $podcastDuration = \Carbon\Carbon::parse($item->podcastTime);
                                                @endphp
                                                {{ $podcastDuration->hour }} hour {{ $podcastDuration->minute }} minutes
                                                {{ $podcastDuration->second }} sec
                                            </p>

                                            <!-- Display Date -->
                                            <p class="card-text text-muted">
                                                <small>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}</small>
                                            </p>
                                        </div>
                                    </div>
                                </a>
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

        <section class="FAQ">
        <div class="container mb-4">
            <h3 class="mb-4 text-primary">FAQ Dynamic Ads</h3>

            <!-- Accordion Wrapper -->
            <div id="accordionFAQ">

                @foreach($faqs as $index => $faq)
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