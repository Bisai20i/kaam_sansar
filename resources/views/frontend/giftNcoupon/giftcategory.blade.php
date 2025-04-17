@extends('frontend.giftNcoupon.giftNcoupon')

@section('giftContent')
    {{-- <section>

            <!-- Profile Header -->

            <div class="gift-header">
                <div class="container">
                    <img src="Images/giftandcoupon.png" class="gift-img">
                    <h5>Gift and Coupon</h5>
                    <h4 class="text-wrap">"Unlock exciting deals with our exclusive gift and coupon offers! Treat yourself
                        or your loved ones with special discounts and rewards tailored just for you. Don’t miss out—grab
                        yours today!"</h4>

                </div>
            </div>
        </section> --}}

    <style>
        .category-btn {
            width: 111px;
            height: 31px;
            font-size: 14px;
            color: #676767;
            font-weight: 600;
            text-align: center;
            border: 1px solid #000000;
            border-radius: 50px;
        }

        .active-btn {
            background-color: #0064A7 !important;
            color: white !important;
            border: 1px solid #0064A7 !important;
        }

        .category-btn:hover {
            background-color: #0064A7 !important;
            color: white !important;
            border-color: #004AAD !important;
        }
    </style>

    <section class="giftpackage">
        <div class="container mb-5">
            <div class="row">

                <h4 class="mt-2">Most Popular Gifts</h4>
                <div class="d-flex gap-2 pt-3">
                    <a href="{{ route('giftcategories') }}"
                        class="btn btn-outline-secondary btn-sm rounded-pill category-btn {{ !$categoryId ? 'active-btn' : '' }}"
                        onclick="filterCategory('all', this)">All</a>
                    @foreach ($categories as $category)
                        <a href="{{ route('giftcategories', ['categoryId' => $category->id]) }}"
                            class="btn btn-outline-secondary btn-sm rounded-pill category-btn {{ $categoryId == $category->id ? 'active-btn' : '' }}">{{ $category->giftCategoryTitle }}</a>
                    @endforeach
                    {{-- <button class="btn btn-outline-secondary btn-sm rounded-pill category-btn"
                            onclick="filterCategory('Birthdays', this)">Birthdays</button>
                        <button class="btn btn-outline-secondary btn-sm rounded-pill category-btn"
                            onclick="filterCategory('Anniversaries', this)">Anniversaries</button>
                        <button class="btn btn-outline-secondary btn-sm rounded-pill category-btn"
                            onclick="filterCategory('Hampers', this)">Hampers</button> --}}
                </div>


                <div class="row g-3 justify-content-center">
                    <!-- Birthday Packages Cards -->
                    <!-- Display empty message is no coupons avaiable -->
                    @if ($coupons->isEmpty())
                        <span class="text-danger text-center block">No coupons to display.</span>
                    @endif

                    {{-- @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif --}}
                    @foreach ($coupons as $coupon)
                        <div class=" col-lg-3 col-md-3 col-sm-6 col-12">
                            <div class="card-bdy-packages">
                                <img src="{{ asset('frontend/assets/Images/gift chocolate.jpg') }}" class="bdy-packages-img">
                                <div class="card-body ">
                                    <p style="text-truncate my-2">{{ $coupon->giftCouponTitle }}<i
                                            class="bi bi-heart float-end me-2 fav-button-color"></i></p>
                                    <div class="d-flex items-center justify-content-between">
                                        <span class="price"> NRs. {{ $coupon->pricing }} </span>
                                        <form action="{{ route('addtocart') }}" class="d-inline" method="post">
                                            @csrf
                                            <input type="hidden" name="couponId" value="{{ $coupon->id }}">
                                            <input type="hidden" name="jobSeekerId" value="1">
                                            <button type="submit" style="all: unset; cursor: pointer;">
                                                <i class="bi bi-plus-lg float-end gift-cart"></i>
                                            </button>
                                        </form>
                                    </div>



                                    {{-- <i class="bi bi-plus-lg float-end gift-cart"
                                                onclick="location.href('{{route('addtocart',[])}}')"></i> --}}
                                    {{-- @auth('job_seekers')
                                        <form id="addToCartForm" class="d-inline" action="{{ route('addtocart') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="couponId" value="{{ $coupon->id }}">
                                            <input type="hidden" name="jobSeekerId"
                                                value="{{ auth('job_seekers')->user()->id }}">
                                            <i class="bi bi-plus-lg float-end gift-cart"
                                                onclick="document.getElementById('addToCartForm').submit();"></i>
                                        </form>
                                    @else
                                        @php
                                            $queryParams = request()->query();
                                            $redirectUrl = url()->current() . '?' . http_build_query($queryParams);
                                        @endphp
                                        <form id="cartRedirectForm" class="d-inline" action="{{ route('set.redirect') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="redirect_url" value="{{ $redirectUrl }}">
                                            <i class="bi bi-plus-lg float-end gift-cart"
                                                onclick="document.getElementById('cartRedirectForm').submit();"></i>
                                        </form>
                                    @endauth --}}

                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class=" col-lg-3 col-md-3 col-sm-6 col-12">
                            <div class="card-bdy-packages">
                                <img src="Images/gift chocolate.jpg" class="bdy-packages-img">
                                <div class="card-body ">
                                    <p>Chocolate's Basket<i class="bi bi-heart float-end me-2 fav-button-color"></i></p>
                                    <p class="price">NRs. 1500<i class="bi bi-plus-lg float-end gift-cart"></i></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                            <div class="card-bdy-packages">
                                <img src="Images/gift chocolate.jpg" class="bdy-packages-img">
                                <div class="card-body ">
                                    <p>Flower Bouquet<i class="bi bi-heart float-end me-2 fav-button-color"></i></p>
                                    <p class="price">NRs. 1500<i class="bi bi-plus-lg float-end gift-cart"></i></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                            <div class="card-bdy-packages">
                                <img src="Images/gift chocolate.jpg" class="bdy-packages-img">
                                <div class="card-body ">
                                    <p>Teddy Bear<i class="bi bi-heart float-end me-2 fav-button-color"></i></p>
                                    <p class="price">NRs. 1500<i class="bi bi-plus-lg float-end gift-cart"></i></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                            <div class="card-bdy-packages">
                                <img src="Images/gift chocolate.jpg" class="bdy-packages-img">
                                <div class="card-body ">
                                    <p>Cake<i class="bi bi-heart float-end me-2 fav-button-color"></i></p>
                                    <p class="price ">NRs. 1500<i class="bi bi-plus-lg float-end gift-cart"></i></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                            <div class="card-bdy-packages">
                                <img src="Images/gift chocolate.jpg" class="bdy-packages-img">
                                <div class="card-body ">
                                    <p>Cake<i class="bi bi-heart float-end me-2 fav-button-color"></i></p>
                                    <p class="price ">NRs. 1500<i class="bi bi-plus-lg float-end gift-cart"></i></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                            <div class="card-bdy-packages">
                                <img src="Images/gift chocolate.jpg" class="bdy-packages-img">
                                <div class="card-body ">
                                    <p>Cake<i class="bi bi-heart float-end me-2 fav-button-color"></i></p>
                                    <p class="price ">NRs. 1500<i class="bi bi-plus-lg float-end gift-cart"></i></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                            <div class="card-bdy-packages">
                                <img src="Images/gift chocolate.jpg" class="bdy-packages-img">
                                <div class="card-body">
                                    <p>Cake<i class="bi bi-heart float-end me-2 fav-button-color"></i></p>
                                    <p class="price ">NRs. 1500<i class="bi bi-plus-lg float-end gift-cart"></i></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                            <div class="card-bdy-packages">
                                <img src="Images/gift chocolate.jpg" class="bdy-packages-img">
                                <div class="card-body ">
                                    <p>Cake<i class="bi bi-heart float-end me-2 fav-button-color"></i></p>
                                    <p class="price ">NRs. 1500<i class="bi bi-plus-lg float-end gift-cart"></i></p>
                                </div>
                            </div>
                        </div> --}}

                </div>
            </div>
        </div>
        <div class="text-center">
            <a href="{{route('giftcart')}}" class="btn btn-outline-primary px-4 rounded-pill">My cart</a>
        </div>

    </section>





    </html>
@endsection

@push('script')
    <script>
        function filterCategory(category, element) {
            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.classList.remove('active-btn');
            });
            element.classList.add('active-btn');

            document.querySelectorAll('.product').forEach(product => {
                if (category === 'all' || product.getAttribute('data-category') === category) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }
    </script>
@endpush
