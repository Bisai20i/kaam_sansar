@extends('frontend.layouts.main')
@section('title')
    Advertisements
@endsection
@section('content')

    <section class="ads_title container-fluid  mt-5 ">
        @if (isset($ad_banners['top']))
            <!-- <h3>Ad banner</h3> -->
            <a href="{{ $ad_banners['top']->link }}" target="_blank" class="d-block"
                style="text-decoration: none; cursor: pointer; object-fit: contain;">
                <img src="{{ $ad_banners['top']->image }}" class="w-100" style="aspect-ratio: 5/1;" alt="img-fluid">
            </a>
        @endif
    </section>

    <div class="container">
        <div class="row">
            <h3 class="primary_color_text py-2">Advertisement</h3>
        </div>
        @php
            $type = isset($type) ? $type : '';
        @endphp

        <style>
            .active {
                color: white !important;
            }
        </style>

        <div class="d-flex justify-content-center justify-content-md-between flex-wrap-reverse row-gap-3 ">
            <div class="btn-group  mb-3 gap-lg-1 ads_type" role="group" aria-label="Basic radio toggle button group">
                <a href="{{ route('frontend.advertisements') }}"
                    class="btn btn-outline-custom {{ empty($type) ? 'active' : '' }} rounded-2 mx-1 px-4 border border-2 ">
                    All
                </a>

                <a href="{{ route('Ads.showByTypeCategory', ['type' => 'Buy']) }}"
                    class="btn btn-outline-custom {{ $type == 'Buy' ? 'active' : '' }} rounded-2 mx-1 px-4 border border-2">
                    Buy
                </a>

                <a href="{{ route('Ads.showByTypeCategory', ['type' => 'Sell']) }}"
                    class="btn btn-outline-custom {{ $type == 'Sell' ? 'active' : '' }} rounded-2 mx-1 px-4 border border-2">
                    Sell
                </a>

                <a href="{{ route('Ads.showByTypeCategory', ['type' => 'Rent']) }}"
                    class="btn btn-outline-custom {{ $type == 'Rent' ? 'active' : '' }} rounded-2 mx-1 px-4 border border-2">
                    Rent
                </a>
            </div>
            <div>
                @if (Auth::guard('job_seekers')->check())
                    <!-- If user is logged in, show the Post Ad button -->
                    <button type="button" class="btn post-ad-btn text-white py-2 px-4 fs-5" data-bs-toggle="modal"
                        data-bs-target="#postAdModal" style="background-color: #0064a7;">
                        <i class="fas fa-plus me-2"></i>Add Post
                    </button>
                @else
                    <!-- If user is not logged in, show the Login button -->
                    <button type="button" class="btn post-ad-btn text-white py-2 px-4 fs-5" data-bs-toggle="modal"
                        data-bs-target="#loginModal" style="background-color: #0064a7;" onclick="setRedirectUrl()">
                        <i class="fas fa-plus me-2"></i>Add Post
                    </button>
                    <script>
                        // Function to store the current URL before showing the login modal
                        function setRedirectUrl() {
                            fetch('/set-redirect', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    redirect_url: window.location.href
                                })
                            });
                        }
                    </script>
                @endif


            </div>
        </div>


        <div>
            <h5>Find what you are looking for ?</h5>
            <div class=" g-3 mb-3">
                <form action="{{ route('ads.search') }}" method="GET" class="row mt-4 align-items-center">
                    <!-- Search Input -->
                    <div class="col-lg">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0" style="height: 42px;">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 ps-0 py-2" style="height: 42px;"
                                name="adsTitle" placeholder="What are you looking for..." aria-label="Search">
                        </div>
                    </div>

                    <!-- Country Select -->
                    <div class="col-md-6 col-lg-3">
                        <select class="form-select py-2 bg-white text-secondary" id="countrySelect" name="country"
                            aria-label="">
                            <option value="" selected>Select Country</option>
                            @foreach ($ad as $a)
                                <option value="{{ $a->country }}">{{ $a->country }}</option>
                            @endforeach

                        </select>
                    </div>

                    <!-- City Select -->
                    <div class="col-md-6 col-lg-3">
                        <select class="form-select py-2 bg-white text-secondary" id="citySelect" name="location"
                            aria-label="">
                            <option value="" selected>Select City</option>
                            @foreach ($ad as $a)
                                <option value="{{ $a->location }}">{{ $a->location }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Search Button -->
                    <div class="col-4 col-lg-2 mx-auto">
                        <button class="btn text-white w-100 py-2" type="submit" style="background-color: #0064a7;">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        

        <div class="nav nav-pills gap-1 justify-content-center justify-content-md-start">
            {{-- Show All --}}
            <a class="btn btn-outline-custom {{ !request('categoryId') ? 'active' : '' }} border border-2  rounded-pill px-3 py-1 d-flex align-items-center"
                href="{{ request('type') ? route('Ads.showByTypeCategory', ['type' => request('type')]) : route('frontend.advertisements') }}">All</a>
            @if (request('type'))
                @foreach ($categories as $categoryItem)
                    <a href="{{ route('Ads.showByTypeCategory', ['type' => request('type'), 'categoryId' => $categoryItem->id]) }}"
                        class="btn btn-outline-custom {{ request('categoryId') && request('categoryId') == $categoryItem->id ? 'active' : '' }} rounded-pill mx-1 px-3 py-1 border border-2">
                        {{ $categoryItem->adsCategoryTitle }}
                    </a>
                @endforeach
            @else
                @foreach ($categories as $categoryItem)
                    
                    <a href="{{ route('Ads.showByCategory', ['categoryId' => $categoryItem->id]) }}"
                        class="btn btn-outline-custom rounded-pill mx-1 px-3 py-1 border border-2 {{ request('categoryId') && request('categoryId') == $categoryItem->id ? 'active' : '' }}">
                        {{ $categoryItem->adsCategoryTitle }}
                    </a>
                @endforeach
            @endif


        </div>


        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-1 g-4 mt-1 ">
            @if ($ads->count())
                @foreach ($ads as $ad)
                    <div class="col">
                        <div class="card p-1" style="border-color:#0694BF;"><a href="{{ route('ads.show', $ad->id) }}"
                                class="text-decoration-none text-black">
                                <img src="{{ $ad->adsThumbnail ? asset($ad->adsThumbnail) : asset('frontend/assets/Images/teddy-bear.jpg') }}" class="card-img-top rounded" alt="Ad Image"
                                    style="height: 131px; width: 100%; object-fit:cover;">
                                <div class="card-body p-1 ">
                                    <h6 class="card-title text-black mb-0">{{ $ad->adsTitle }}</h6>
                                    <p class="card-text text-muted mb-0">{{ $ad->location }}</p>
                                    <p class="card-text text-muted"><small
                                            class="text-body-secondary">{{ $ad->postedDuration }}</small></p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach


        </div>

        @if ($ads->hasMorePages() || $ads->currentPage() != 1)

            <div class="row mt-3">
                <nav>
                    <ul class="pagination justify-content-end converter">
                        {{-- Previous Button --}}
                        @if ($ads->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link primary_color_text">&lt;</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link primary_color_text" href="{{ $ads->previousPageUrl() }}">&lt;</a>
                            </li>
                        @endif

                        {{-- Pagination Numbers --}}
                        @php
                            $currentPage = $ads->currentPage();
                            $lastPage = $ads->lastPage();
                            $pageRange = 2; // Number of pages to display before and after the current page
                        @endphp

                        {{-- Show First Page --}}
                        @if ($currentPage > $pageRange + 1)
                            <li class="page-item">
                                <a class="page-link primary_color_text" href="{{ $ads->url(1) }}">1</a>
                            </li>
                            @if ($currentPage > $pageRange + 2)
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            @endif
                        @endif

                        {{-- Show Pages Before Current Page --}}
                        @for ($i = max(1, $currentPage - $pageRange); $i < $currentPage; $i++)
                            <li class="page-item">
                                <a class="page-link primary_color_text"
                                    href="{{ $ads->url($i) }}">{{ $i }}</a>
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
                                    href="{{ $ads->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Show Last Page --}}
                        @if ($currentPage < $lastPage - $pageRange)
                            @if ($currentPage < $lastPage - $pageRange - 1)
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            @endif
                            <li class="page-item">
                                <a class="page-link primary_color_text"
                                    href="{{ $ads->url($lastPage) }}">{{ $lastPage }}</a>
                            </li>
                        @endif

                        {{-- Next Button --}}
                        @if ($ads->hasMorePages())
                            <li class="page-item">
                                <a class="page-link primary_color_text" href="{{ $ads->nextPageUrl() }}">&gt;</a>
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
        <!-- error shown -->
        <main class="d-flex flex-column flex-grow-1 justify-content-center align-items-center bg-white text-center py-5">
            <div class="text-primary display-3 mb-4 mt-5">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h1 class="fs-2 fw-semibold mb-3">Result Not Found</h1>
            <p class="text-secondary">We couldn’t find the result you are searching.</p>
            <p class="text-secondary mb-4">Please try navigating using the options below.</p>
            <div class="d-flex gap-3">
                <a href="{{ route('ads.index') }}"
                    class="btn-create d-flex align-items-center justify-content-center gap-3"
                    style="text-decoration: none;">
                    <i class="fas fa-arrow-left ms-2"></i>
                    <span class="me-1 fw-semibold">Go Back</span>
                </a>

                <a href="{{ route('index') }}" class="btn-create d-flex align-items-center justify-content-center gap-2"
                    style="text-decoration: none;">
                    <i class="fas fa-home ms-2"></i>
                    <span class="me-1 fw-semibold">Homepage</span>
                </a>
            </div>
        </main>
        @endif
    </div>

    </div>

    <!-- Post Ad Modal -->
    <div class="modal fade" id="postAdModal" tabindex="-1" aria-labelledby="postAdModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postAdModalLabel">Create Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addItemForm" action="{{ route('ads.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Type Dropdown -->
                        <div class="">
                            <select class="form-select abroad-deal-1 py-2" id="type" name="type" aria-label="">
                                <option selected>Type</option>

                                <option value="Buy">Buy</option>
                                <option value="Sell">Sell</option>
                                <option value="Rent">Rent</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <select class="form-select abroad-deal-1 py-2" id="cat" name="adsCategoryId"
                                aria-label="">

                                <option selected> Select Category</option>
                                @foreach ($all as $al)
                                    <option value="{{ $al->id }}">{{ $al->adsCategoryTitle }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-floating text-black-50 mt-3">
                            <input type="text" class="form-control abroad-deal-1" name="country" id="countryInput"
                                placeholder="Country">
                            <label for="countryInput">Country</label>
                        </div>
                        <div class="form-floating text-black-50 mt-3">
                            <input type="text" class="form-control abroad-deal-1" name="location" id="cityInput"
                                placeholder="City">
                            <label for="cityInput">City</label>
                        </div>


                        <div class="form-floating text-black-50 mt-3">
                            <input type="text" class="form-control abroad-deal-1" name="adsTitle" id="titleInput"
                                placeholder="Title">
                            <label for="titleInput">Title</label>
                        </div>
                        <div class="form-floating text-black-50 mb-3">

                            <input type="text" class="form-control abroad-deal-1" id="price" name="pricing"
                                placeholder="Enter price" required>
                            <label for="price">Price</label>
                        </div>
                        <div class="form-floating text-black-50 mb-3">

                            <input type="tel" class="form-control abroad-deal-1" id="contact" name="contactNumber"
                                placeholder="Enter Contact Number" required>
                            <label for="contact">Contact No</label>

                        </div>
                        <div class="form-floating text-black-50">
                            <textarea class="form-control abroad-deal-1" name="adsDescription" placeholder="Post Details" id="floatingTextarea"
                                style="height: 100px"></textarea>
                            <label for="floatingTextarea">Describe...</label>
                        </div>
                        <div class="d-flex flex-column abroad-deal-1 p-2 gap-2 rounded" style="max-width: 100%;">
                            <!-- Top row -->
                            <div class="d-flex align-items-center gap-3">
                                <p class="flex-grow-1 my-auto text-black-5 mb-0" style="font-size: 0.9rem;">Add to your
                                    post</p>

                                <div class="d-flex align-items-center gap-2">
                                    <label for="fileInput" class="primary_color_text m-0" style="cursor: pointer;">
                                        <i class="fa-solid fa-image fa-lg"></i>
                                    </label>
                                    <input type="file" id="fileInput" name="adsThumbnail" accept="image/*"
                                        class="d-none">
                                </div>
                            </div>

                            <!-- Image Preview (small) -->
                        </div>
                        <div id="imagePreview" class="d-flex mt-1" style="height: 60px;"></div>


                        <script>
                            const fileInput = document.getElementById('fileInput');
                            const imagePreview = document.getElementById('imagePreview');

                            fileInput.addEventListener('change', (event) => {
                                const file = event.target.files[0];
                                if (file && file.type.startsWith('image/')) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        imagePreview.innerHTML = `
          <img src="${e.target.result}" alt="Preview" style="height: 100%; width:30%; border-radius: 6px; object-fit: cover;">
        `;
                                    };
                                    reader.readAsDataURL(file);
                                } else {
                                    imagePreview.innerHTML = '';
                                }
                            });
                        </script>

                </div>
                <div class="d-flex justify-content-center mb-3">
                    <button type="submit" class="btn btn-primary " style="background-color: #0064a7;">Submit</button>
                </div>
                </form>
                <script>
                    const postAdModal = document.getElementById('postAdModal');
                    postAdModal.addEventListener('hidden.bs.modal', () => {
                        if (document.activeElement) {
                            document.activeElement.blur();
                        }
                    });
                </script>

            </div>
        </div>
    </div>
    </div>
@endsection
