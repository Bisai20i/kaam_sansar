@extends('frontend.giftNcoupon.giftMain')

@section('giftContent')

<section class="giftpackage" id="giftpackage">
    <div class="container mb-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 col-md-3 d-flex flex-column align-items-start">
                <div class="sidebar">
                    <img src="{{ asset('Images/gift.png') }}" class="gift-top" alt="Sidebar Image">
                </div>
            </div>

            <!-- Main Content -->
            <div class=" col-lg-9 col-md-9">
                <div class="card card-gift p-3">
                    <h3 class="pb-3">Birthday Hampers</h3>
                    <p> Celebrate Birthdays with Our Special Hamper! <br>
                        Make birthdays extra special with our thoughtfully curated birthday hamper! Packed with love
                        and
                        filled with delightful surprises, it’s the perfect gift to bring smiles and joy. From cakes,
                        sweet treats and personalized keepsakes to unique goodies, our hamper has everything to make
                        the
                        day unforgettable. Show your loved ones how much you care—choose the gift that speaks from
                        the
                        heart. Order now and make their birthday a celebration to remember!</p>
                </div>
            </div>

            <h4 class="mt-5">Birthday Packages</h4>
            <div class="row g-3 justify-content-center">
                <!-- Birthday Packages Cards -->
                <div class=" col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="card-bdy-packages">
                        <img src="{{ asset('Images/gift chocolate.jpg') }}" class="bdy-packages-img">
                        <div class="card-body ">
                            <p>Chocolate's Basket<i class="bi bi-heart float-end me-2 fav-button-color"></i></p>
                            <p class="price">NRs. 1500 <a href="{{route('gcart')}}"><i class="bi bi-cart3 float-end gift-cart"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="card-bdy-packages">
                        <img src="{{ asset('Images/gift chocolate.jpg') }}" class="bdy-packages-img">
                        <div class="card-body ">
                            <p>Flower Bouquet<i class="bi bi-heart float-end me-2 fav-button-color"></i></p>
                            <p class="price">NRs. 1500 <a href="{{route('gcart')}}"><i class="bi bi-cart3 float-end gift-cart"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="card-bdy-packages">
                        <img src="{{ asset('Images/gift chocolate.jpg') }}" class="bdy-packages-img">
                        <div class="card-body ">
                            <p>Teddy Bear<i class="bi bi-heart float-end me-2 fav-button-color"></i></p>
                            <p class="price">NRs. 1500 <a href="{{route('gcart')}}"><i class="bi bi-cart3 float-end gift-cart"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="card-bdy-packages">
                        <img src="{{ asset('Images/gift chocolate.jpg') }}" class="bdy-packages-img">
                        <div class="card-body ">
                            <p>Cake<i class="bi bi-heart float-end me-2 fav-button-color"></i></p>
                            <p class="price ">NRs. 1500 <a href="{{route('gcart')}}"><i class="bi bi-cart3 float-end gift-cart"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="card-bdy-packages">
                        <img src="{{ asset('Images/gift chocolate.jpg') }}" class="bdy-packages-img">
                        <div class="card-body ">
                            <p>Cake<i class="bi bi-heart float-end me-2 fav-button-color"></i></p>
                            <p class="price ">NRs. 1500 <a href="{{route('gcart')}}"><i class="bi bi-cart3 float-end gift-cart"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="card-bdy-packages">
                        <img src="{{ asset('Images/gift chocolate.jpg') }}" class="bdy-packages-img">
                        <div class="card-body ">
                            <p>Cake<i class="bi bi-heart float-end me-2 fav-button-color"></i></p>
                            <p class="price ">NRs. 1500 <a href="{{route('gcart')}}"><i class="bi bi-cart3 float-end gift-cart"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="card-bdy-packages">
                        <img src="{{ asset('Images/gift chocolate.jpg') }}" class="bdy-packages-img">
                        <div class="card-body">
                            <p>Cake<i class="bi bi-heart float-end me-2 fav-button-color"></i></p>
                            <p class="price ">NRs. 1500 <a href="{{route('gcart')}}"><i class="bi bi-cart3 float-end gift-cart"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="card-bdy-packages">
                        <img src="{{ asset('Images/gift chocolate.jpg') }}" class="bdy-packages-img">
                        <div class="card-body ">
                            <p>Cake<i class="bi bi-heart float-end me-2 fav-button-color"></i></p>
                            <p class="price ">NRs. 1500 <a href="{{route('gcart')}}"><i class="bi bi-cart3 float-end gift-cart"></i></a></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection