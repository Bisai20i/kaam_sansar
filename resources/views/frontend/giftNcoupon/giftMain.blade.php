@extends('frontend.layouts.main')
@section('title')
    Gift and Coupon
@endsection
@section('content')
    <main>
        {{-- <section>
            <div class="giftnavbar">
                <h1 class="text-center">Same Day Delivery in Kathmandu. Order by 4 PM.</h1>
            </div>

            <!-- Profile Header -->

            <div class="gift-header">


                <div class="container">

                    <img src="{{ asset('frontend/assets/Images/giftandcoupon.png') }}" class="gift-img">
                    <h5>Gift and Coupon</h5>
                    <h4 class="text-wrap">"Unlock exciting deals with our exclusive gift and coupon offers! Treat
                        yourself or
                        your loved ones with special discounts and rewards tailored just for you. Don’t miss out—grab
                        yours
                        today!"</h4>

                </div>

            </div>
        </section> --}}

        <style>
            .gift-cart{
                transition: 0.3s ease;
            }
            .gift-cart:hover{
                background-color: white !important;
                color: #0064A7 !important;
                outline:1px solid #0064A7 !important;
            }
        </style>

        @yield('giftContent')












        <form action="{{ route('gift.details') }}" id="giftNcouponDescription">
            <input type="hidden" name="id" id="giftNcouponDescriptionId" />
        </form>

    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Prevent parent click on cart button click
            document.querySelectorAll('.gift-cart').forEach(function(icon) {
                icon.addEventListener('click', function(e) {
                    e.stopPropagation(); // Prevent triggering parent click
                });
            });
        });
    </script>
    <script>
        // let giftDetailPage = @json(route('gift.details', ['id' => '__ID__']));
        const gNcItems = document.querySelectorAll('#giftCouponItem');
        const nextPageForm = document.getElementById('giftNcouponDescription')
        gNcItems.forEach(item => {
            item.addEventListener('click', () => {
                let gNcId = item.getAttribute('data-gNcId');
                // console.log(gNcId);
                document.getElementById('giftNcouponDescriptionId').value = gNcId
                nextPageForm.submit()
            });
        });
    </script>
@endpush
