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



        @yield('giftContent')












        <form action="{{route('gift.details')}}" id="giftNcouponDescription">
            <input type="hidden" name="id" id="giftNcouponDescriptionId"/>
        </form>

    </main>
@endsection

@push('scripts')
    <script>
        //popup
        // document.addEventListener("DOMContentLoaded", function() {
        //     const popup = document.getElementById("popup");

        // });

        //manupulate gift selection
        // let giftImages = document.querySelectorAll(".gift-coupon-card img");

        // // Select the sections
        // let giftCouponSection = document.querySelector(".giftandcoupon");
        // let giftPackageSection = document.querySelector(".giftpackage");

        // // Add click event listener to each image
        // giftImages.forEach(image => {
        //     image.addEventListener("click", function() {

        //         // Hide the gift coupon section
        //         if (giftCouponSection) {
        //             giftCouponSection.style.display = "none";
        //         }

        //         // Show the gift package section
        //         if (giftPackageSection) {
        //             giftPackageSection.style.display = "block";
        //             giftPackageSection.scrollIntoView({
        //                 behavior: "smooth"
        //             });
        //         }
        //     });
        // });


        // const selectAllCheckbox = document.getElementById("selectAll");
        // const itemCheckboxes = document.querySelectorAll(".item-checkbox");
        // const cartItems = document.querySelectorAll(".cart-item");

        // // Select All Functionality
        // selectAllCheckbox.addEventListener("change", function() {
        //     itemCheckboxes.forEach((checkbox, index) => {
        //         checkbox.checked = selectAllCheckbox.checked;
        //         if (selectAllCheckbox.checked) {
        //             cartItems[index].classList.add("selected");
        //         } else {
        //             cartItems[index].classList.remove("selected");
        //         }
        //     });
        // });

        // // Individual Item Selection
        // itemCheckboxes.forEach((checkbox, index) => {
        //     checkbox.addEventListener("change", function() {
        //         if (checkbox.checked) {
        //             cartItems[index].classList.add("selected");
        //         } else {
        //             cartItems[index].classList.remove("selected");
        //         }
        //     });
        // });


        // const cartButtons = document.querySelectorAll(".gift-cart"); // Select all cart buttons
        // const giftPackageSection = document.getElementById("giftpackage");
        // const giftCartSection = document.getElementById("giftcart");

        // // Initially, show only the gift package section
        // giftCartSection.style.display = "none";

        // cartButtons.forEach(button => {
        //     button.addEventListener("click", function() {
        //         console.log("Clicked")
        //         giftPackageSection.style.display = "none"; // Hide gift packages
        //         giftCartSection.style.display = "block"; // Show cart section
        //     });
        // });
    </script>
    <script>
        // let giftDetailPage = @json(route('gift.details', ['id' => '__ID__']));
        const gNcItems = document.querySelectorAll('#giftCouponItem');
        const nextPageForm = document.getElementById('giftNcouponDescription')
        gNcItems.forEach(item => {
            item.addEventListener('click', () => {
                let gNcId = item.getAttribute('data-gNcId');
                console.log(gNcId);
                document.getElementById('giftNcouponDescriptionId').value = gNcId
                nextPageForm.submit()
            });
        });
    </script>
@endpush
