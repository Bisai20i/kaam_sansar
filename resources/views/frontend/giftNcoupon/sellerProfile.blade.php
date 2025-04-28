@extends('frontend.giftNcoupon.giftMain')

@section('giftContent')
    <section class="giftpackage">
        <div class="container mb-5">
            <div class="row">
                <div class="seller-profile mt-5">
                    <!-- Back Button -->
                    <a href="{{ route('gift.home') }}" class=" text-decoration-none  mt-5">
                        <i class="bi bi-chevron-compact-left"></i>Seller Profile
                    </a>

                    <!-- Seller Card -->
                    <div class="mt-3">
                        <div class="seller-card shadow-sm px-3">
                            <img src="{{ $seller->profile_image ? asset('storage/' . $seller->profile_image) : asset('frontend/assets/Images/profile-icon.png') }}"
                                alt="Seller Image" class="seller-img">
                            <div class="seller-info">
                                <h6 class="mb-2 ">{{ $seller->fullName ? $seller->fullName : '' }}</h6>
                                <p class="m-0">Member since:
                                    {{ \Carbon\Carbon::parse($seller->created_at)->format('M d, Y') }}</p>


                                <p class="m-0 text-secondary ">
                                    <small>{{ $seller->location ? $seller->location : 'Location: N/A' }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <h4 class="mt-2">Gifts and Coupons</h4>
                    @auth('job_seekers')
                        <a href="{{ route('giftcart') }}" class="btn btn-cart cart-gift" id="cartButton"><i
                                class="bi bi-cart3"></i>Cart</a>
                    @endauth

                </div>

                <div class="d-flex gap-3 mt-2  ">
                    <a href="{{ route('gift.seller', ['id' => $seller->id])}}"
                        class="btn btn-toggle btn-all-categories {{ request('type') == null ? 'active' : '' }}"
                        onclick="toggleActive(this)">All</a>

                    <a href="{{ route('gift.seller', ['id' => $seller->id, 'type'=>'0' ]) }}"
                        class="btn btn-toggle {{ request('type') == '0' ? 'active' : '' }}"
                        onclick="toggleActive(this)">Gifts</a>

                    <a href="{{ route('gift.seller', ['id' => $seller->id ,  'type'=>'1' ]) }}"
                        class="btn btn-toggle {{ request('type') == '1' ? 'active' : '' }}">Coupons</a>
                </div>

                <div class="row g-3 justify-content-center row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
                    <!-- Birthday Packages Cards -->

                    @if ($sellerGifts->count() > 0)
                        @foreach ($sellerGifts as $gNc)
                            <div class="col cursor-pointer" id="giftCouponItem" data-gNcId="{{ $gNc->id }}">

                                <div class="card-bdy-packages-gifts">
                                    @if ($gNc->discount > 0)
                                        <div class="discount-badge">{{ $gNc->discount }}% OFF</div>
                                    @endif

                                    <img src="{{ $gNc->thumbnail ? asset('storage/' . $gNc->thumbnail) : asset('frontend/assets/Images/giftandcoupon.png') }}"
                                        class="bdy-packages-img product-image-gifts" id="product-image-gift"
                                        style="height: 200px;">
                                    <div class="card-body d-flex justify-content-between align-items-center ">
                                        <p class="text-truncate my-2">{{ $gNc->title }}</p>
                                        <form action="{{ route('addtocart') }}" class="d-inline" method="post">
                                            @csrf
                                            <input type="hidden" name="couponId" value="{{ $gNc->id }}">
                                            @if (Auth::guard('job_seekers')->check())
                                                <input type="hidden" name="jobSeekerId"
                                                    value="{{ Auth::guard('job_seekers')->user()->id }}">
                                                <button type="submit" style="all: unset; cursor: pointer;">
                                                    <i class="bi bi-plus-lg ms-auto gift-cart"></i>
                                                </button>
                                            @else
                                                <button data-bs-toggle="modal" data-bs-target="#loginModal" type="submit" style="all: unset; cursor: pointer;">
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


                                </div>

                            </div>
                        @endforeach
                    @endif



                </div>

                @if ($sellerGifts->hasMorePages() || $sellerGifts->currentPage() !=1)

                    <div class="row mt-3">
                        <nav>
                            <ul class="pagination justify-content-end converter">
                                {{-- Previous Button --}}
                                @if ($sellerGifts->onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link primary_color_text">&lt;</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link primary_color_text"
                                            href="{{ $sellerGifts->previousPageUrl() }}">&lt;</a>
                                    </li>
                                @endif

                                {{-- Pagination Numbers --}}
                                @php
                                    $currentPage = $sellerGifts->currentPage();
                                    $lastPage = $sellerGifts->lastPage();
                                    $pageRange = 2; // Number of pages to display before and after the current page
                                @endphp

                                {{-- Show First Page --}}
                                @if ($currentPage > $pageRange + 1)
                                    <li class="page-item">
                                        <a class="page-link primary_color_text" href="{{ $sellerGifts->url(1) }}">1</a>
                                    </li>
                                    @if ($currentPage > $pageRange + 2)
                                        <li class="page-item disabled"><span class="page-link">...</span></li>
                                    @endif
                                @endif

                                {{-- Show Pages Before Current Page --}}
                                @for ($i = max(1, $currentPage - $pageRange); $i < $currentPage; $i++)
                                    <li class="page-item">
                                        <a class="page-link primary_color_text"
                                            href="{{ $sellerGifts->url($i) }}">{{ $i }}</a>
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
                                            href="{{ $sellerGifts->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                {{-- Show Last Page --}}
                                @if ($currentPage < $lastPage - $pageRange)
                                    @if ($currentPage < $lastPage - $pageRange - 1)
                                        <li class="page-item disabled"><span class="page-link">...</span></li>
                                    @endif
                                    <li class="page-item">
                                        <a class="page-link primary_color_text"
                                            href="{{ $sellerGifts->url($lastPage) }}">{{ $lastPage }}</a>
                                    </li>
                                @endif

                                {{-- Next Button --}}
                                @if ($sellerGifts->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link primary_color_text"
                                            href="{{ $sellerGifts->nextPageUrl() }}">&gt;</a>
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
        </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
