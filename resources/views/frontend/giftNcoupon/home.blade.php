@extends('frontend.giftNcoupon.giftMain')

@section('giftContent')
    <section class="mt-5">

        <!-- Profile Header -->

        <div class="container gift-header">

            @if ($ad_banners['top'])
                <a href="{{ $ad_banners['top']->link }}" class="d-block"
                    style="text-decoration: none; cursor: pointer; object-fit: contain;">
                    <img src="{{ $ad_banners['top']->image }}" class="w-100" style="aspect-ratio: 4/1;" alt="img-fluid">
                </a>
                {{-- <h1 class="d-flex justify-content-center mt-5 mb-5">Advertisement Banner</h1> --}}
            @endif
            {{-- <div class="banner-gift d-flex align-items-center">

                <div class="overlay">

                    <p></p>
                </div>
            </div> --}}
        </div>
    </section>



    <section class="giftpackage">
        <div class="container mb-5">
            <div class="row">

                <div class="container mt-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mt-2">Most Popular Gifts</h4>
                        @auth('job_seekers')
                            <a href="{{ route('giftcart') }}" class="btn btn-cart cart-gift" id="cartButton"><i
                                    class="bi bi-cart3"></i>Cart</a>
                        @endauth

                    </div>

                    <div class="d-flex gap-3 mb-4 mt-4 ">
                        <a href="{{ route('gift.home', ['type' => 'all','searchstr' => request('searchstr'), 'country' => request('country'), 'city' => request('city')]) }}"
                            class="btn btn-toggle btn-all-categories {{ request('type') == 'all' ? 'active' : '' }}"
                            onclick="toggleActive(this)">All</a>

                        <a href="{{ route('gift.home', ['type' => '0', 'searchstr' => request('searchstr'), 'country' => request('country'), 'city' => request('city')]) }}"
                            class="btn btn-toggle {{ request('type') == '0' ? 'active' : '' }}"
                            onclick="toggleActive(this)">Gifts</a>
                        <a href="{{ route('gift.home', ['type' => '1', 'searchstr' => request('searchstr'), 'country' => request('country'), 'city' => request('city')]) }}"
                            class="btn btn-toggle {{ request('type') == '1' ? 'active' : '' }}">Coupons</a>
                    </div>
                    <h1>Find what you're looking for</h1>

                    <form action="" class="row g-2 mt-2 mb-1">

                        <div class="col-md-4">

                            <input type="text" class="form-control form-control-gift px-2" name="searchstr"
                                placeholder="What are you looking for?" value="{{ request('searchstr') }}">
                        </div>
                        <div class="col-md-3 px-2">
                            <select class="form-select form-select-gift" name="country">
                                <option selected value="">Select Country</option>
                                @foreach ($countries as $cty)
                                    <option value="{{ $cty }}"
                                        {{ $cty == request('country') ? 'selected' : '' }}>
                                        {{ $cty }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-3 ">
                            <input type="text" class="form-control form-control-gift px-2" name="city"
                                placeholder="Search City" value="{{ request('city') }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-search-gift py-2" style="height: 100%;">Search</button>
                        </div>
                    </form>




                    <div class="d-flex flex-wrap gap-2 pt-3 mb-3">
                        <a href="{{ route('gift.home', ['type' => $type]) }}"
                            class="btn btn-outline-secondary btn-sm rounded-pill category-btn flex-grow-1 flex-md-grow-0 {{ request('giftCategoryId') ? '' : 'active-btn' }}">
                            All</a>

                        @if ($giftcategories)
                            @foreach ($giftcategories as $category)
                                <a href="{{ route('gift.home', ['type' => $type, 'giftCategoryId' => $category->id, 'searchstr' => request('searchstr'), 'country' => request('country'), 'city' => request('city')]) }}"
                                    class="btn btn-outline-secondary btn-sm rounded-pill category-btn text-truncate flex-grow-1 flex-md-grow-0 {{ request('giftCategoryId') == $category->id ? 'active-btn' : '' }}">
                                    {{ $category->giftCategoryTitle }}</a>
                            @endforeach
                        @endif

                    </div>

                    <div class="row g-3 justify-content-center row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 mt-2">

                        @if ($giftNcoupons->count() > 0)
                            @foreach ($giftNcoupons as $gNc)
                                <div class="col" id="giftCouponItem" data-gNcId="{{ $gNc->id }}"
                                    style="cursor: pointer;">

                                    <div class="card-bdy-packages-gifts">
                                        @if ($gNc->discount > 0)
                                            <div class="discount-badge">{{ $gNc->discount }}% OFF</div>
                                        @endif

                                        <img src="{{ $gNc->thumbnail ? asset('storage/' . $gNc->thumbnail) : asset('frontend/assets/Images/giftandcoupon.png') }}"
                                            class="bdy-packages-img product-image-gifts" id="product-image-gift"
                                            style="height: 200px;">
                                        <div class="card-body d-flex justify-content-between align-items-center ">
                                            <p class="text-truncate my-2">{{ $gNc->title }}</p>
                                            
                                                <input type="hidden" name="couponId" value="{{ $gNc->id }}">
                                                @if (Auth::guard('job_seekers')->check())
                                                <form action="{{ route('addtocart') }}" class="d-inline" method="post">
                                                @csrf
                                                    <input type="hidden" name="jobSeekerId"
                                                        value="{{ Auth::guard('job_seekers')->user()->id }}">
                                                    <button type="submit" style="all: unset; cursor: pointer;">
                                                        <i class="bi bi-plus-lg ms-auto gift-cart"></i>
                                                    </button>
                                                </form>
                                                @else
                                                    
                                                    <button type="submit" style="all: unset; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#loginModal">
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
                                                {{ number_format((100 - $gNc->discount) * $gNc->price * 0.01, 2) }}</p>
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





                    </div>
                </div>
            </div>

            @if ($giftNcoupons->hasMorePages() || $giftNcoupons->currentPage() !=1)

                <div class="row mt-3">
                    <nav>
                        <ul class="pagination justify-content-end converter">
                            {{-- Previous Button --}}
                            @if ($giftNcoupons->onFirstPage())
                                <li class="page-item disabled">
                                    <a class="page-link primary_color_text">&lt;</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link primary_color_text"
                                        href="{{ $giftNcoupons->previousPageUrl() }}">&lt;</a>
                                </li>
                            @endif

                            {{-- Pagination Numbers --}}
                            @php
                                $currentPage = $giftNcoupons->currentPage();
                                $lastPage = $giftNcoupons->lastPage();
                                $pageRange = 2; // Number of pages to display before and after the current page
                            @endphp

                            {{-- Show First Page --}}
                            @if ($currentPage > $pageRange + 1)
                                <li class="page-item">
                                    <a class="page-link primary_color_text" href="{{ $giftNcoupons->url(1) }}">1</a>
                                </li>
                                @if ($currentPage > $pageRange + 2)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                            @endif

                            {{-- Show Pages Before Current Page --}}
                            @for ($i = max(1, $currentPage - $pageRange); $i < $currentPage; $i++)
                                <li class="page-item">
                                    <a class="page-link primary_color_text"
                                        href="{{ $giftNcoupons->url($i) }}">{{ $i }}</a>
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
                                        href="{{ $giftNcoupons->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            {{-- Show Last Page --}}
                            @if ($currentPage < $lastPage - $pageRange)
                                @if ($currentPage < $lastPage - $pageRange - 1)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                                <li class="page-item">
                                    <a class="page-link primary_color_text"
                                        href="{{ $giftNcoupons->url($lastPage) }}">{{ $lastPage }}</a>
                                </li>
                            @endif

                            {{-- Next Button --}}
                            @if ($giftNcoupons->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link primary_color_text"
                                        href="{{ $giftNcoupons->nextPageUrl() }}">&gt;</a>
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

    </section>
@endsection

@push('scripts')
@endpush
