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
                            <img src="{{ $seller->profile_image ?  asset('storage/'.$seller->profile_image) : asset('frontend/assets/Images/profile-icon.png') }}" alt="Seller Image" class="seller-img">
                            <div class="seller-info">
                                <h6 class="mb-2 ">{{$seller->fullName? $seller->fullName : ""}}</h6>
                                <p class="m-0">Member since: {{ \Carbon\Carbon::parse($seller->created_at)->format('M d, Y') }}</p>


                                <p class="m-0 text-secondary "><small>{{ $seller->location ? $seller->location : "Location: N/A" }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 justify-content-center row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
                    <!-- Birthday Packages Cards -->

                    @if($sellerGifts->count()>0)


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
                                        <button disabled type="submit" style="all: unset; cursor: pointer;">
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
            </div>
        </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
