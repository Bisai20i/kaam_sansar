@extends('frontend.layouts.main')

@section('title', 'Exchange Money - Select Exchange')

@section('content')

    <!-- hero section start  -->
    <section class="hero container-fluid primary_color_bg py-4"
        style="background-image: url({{ asset('frontend/assets/Images/money-around-world.jpg') }}); background-position: center center; background-size:cover; background-repeat: no-repeat; ">
        <div class="text-center text-white">
            <h1 class="mt-5">Real-Time Currency Conversion at Your Fingertips</h1>
            <p class="fs-5 mt-2">Stay updated with the latest exchange rates and calculate conversions
                effortlessly.
            </p>
            <p class="fs-2 fw-bolder"> Start Converting Now!</p>
        </div>
    </section>
    <!-- hero section end  -->

    <section class="converter container-fluid">
        <div class="container">
            <div class="row text-center">
                <h2 class="primary_color_text my-4">Select the Money Exchanger</h2>
            </div>
            <div class="row mb-4">
                <div class="col-md-4 col-6 border border-4 border-white rounded"
                    style="background-image: url({{ asset('frontend/assets/Images/money-around-world.jpg') }}); background-position: center center; background-size:cover; background-repeat: no-repeat; height: 10rem;">
                    <div class="w-100 h-100">
                        <a href="{{ route('exchange_bank_details') }}"
                            class="fs-4 text-decoration-none text-white d-flex align-items-end pb-2 h-100 w-100 ">IME
                            Money
                            Exchanger</a>
                    </div>
                </div>

                <div class="col-md-4 col-6 border border-4 border-white rounded"
                    style="background-image: url({{ asset('frontend/assets/Images/money-around-world.jpg') }}); background-position: center center; background-size:cover; background-repeat: no-repeat; height: 10rem;">
                    <div class="w-100 h-100">
                        <a href="{{ route('exchange_bank_details') }}"
                            class="fs-4 text-decoration-none text-white d-flex align-items-end pb-2 h-100 w-100 ">IME
                            Money
                            Exchanger</a>
                    </div>
                </div>

                <div class="col-md-4 col-6 border border-4 border-white rounded"
                    style="background-image: url({{ asset('frontend/assets/Images/money-around-world.jpg') }}); background-position: center center; background-size:cover; background-repeat: no-repeat; height: 10rem;">
                    <div class="w-100 h-100">
                        <a href="{{ route('exchange_bank_details') }}"
                            class="fs-4 text-decoration-none text-white d-flex align-items-end pb-2 h-100 w-100 ">IME
                            Money
                            Exchanger</a>
                    </div>
                </div>

                <div class="col-md-4 col-6 border border-4 border-white rounded"
                    style="background-image: url({{ asset('frontend/assets/Images/money-around-world.jpg') }}); background-position: center center; background-size:cover; background-repeat: no-repeat; height: 10rem;">
                    <div class="w-100 h-100">
                        <a href="{{ route('exchange_bank_details') }}"
                            class="fs-4 text-decoration-none text-white d-flex align-items-end pb-2 h-100 w-100 ">IME
                            Money
                            Exchanger</a>
                    </div>
                </div>
                <div class="col-md-4 col-6 border border-4 border-white rounded"
                    style="background-image: url({{ asset('frontend/assets/Images/money-around-world.jpg') }}); background-position: center center; background-size:cover; background-repeat: no-repeat; height: 10rem;">
                    <div class="w-100 h-100">
                        <a href="{{ route('exchange_bank_details') }}"
                            class="fs-4 text-decoration-none text-white d-flex align-items-end pb-2 h-100 w-100 ">IME
                            Money
                            Exchanger</a>
                    </div>
                </div>
                <div class="col-md-4 col-6 border border-4 border-white rounded"
                    style="background-image: url({{ asset('frontend/assets/Images/money-around-world.jpg') }}); background-position: center center; background-size:cover; background-repeat: no-repeat; height: 10rem;">
                    <div class="w-100 h-100">
                        <a href="{{ route('exchange_bank_details') }}"
                            class="fs-4 text-decoration-none text-white d-flex align-items-end pb-2 h-100 w-100 ">IME
                            Money
                            Exchanger</a>
                    </div>
                </div>




            </div>
    </section>
    <!-- currency section end  -->


@endsection
