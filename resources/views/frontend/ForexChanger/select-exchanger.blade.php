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
            <div class="row">
                <h2 class="primary_color_text my-3 p-0">Select the Money Exchanger</h2>
            </div>
            <div class="row mb-4">
                <ul class="nav nav-pills gap-3" id="myNavTabs">
                    <li class="nav-item">
                        <button class="nav-link active fw-bold fs-6 primary_border" id="tab1" data-bs-toggle="tab"
                            data-bs-target="#tab1Content" onclick="toggleRatePreview('buying')">Buying Rate</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link fw-bold fs-6 primary_border" id="tab2" data-bs-toggle="tab"
                            data-bs-target="#tab2Content" onclick="toggleRatePreview('selling')">Selling Rate</button>
                    </li>
                </ul>
            </div>

            <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 mb-4">
                @if ($exchange_rates->count() == 0)

                    <div class="p-0 text-secondary">No Exchange Rate Found</div>
                @else
                    <input type="hidden" value="{{ $amount ?? 1 }}" id="user_amount">
                    <input type="hidden" value="{{ $base_currency }}" id="user_base_currency">
                    @foreach ($exchange_rates as $exchange_rate)
                        <div class="col p-2">
                            <a href="bank-details.html" class="text-decoration-none">
                                <div class="card p-0">
                                    <img src="{{ $exchange_rate->post_admin->profile_image ? asset('storage/' . $exchange_rate->post_admin->profile_image) : asset('frontend/assets/Images/money-around-world.jpg') }}"
                                        class="card-img-top" alt="...">
                                    <div class="card-body px-3 py-2">
                                        <h5 class="card-title fw-semibold fs-5 m-0">
                                            {{ $exchange_rate->post_admin->fullName }}</h5>

                                        <p class="exchange_rate_display card-text fs-6"
                                            data-buying = "{{ $exchange_rate->buying_rate }}"
                                            data-selling="{{ $exchange_rate->selling_rate }}"
                                            data-base="{{ $exchange_rate->base_currency }}">
                                            {{ ($amount ?? 1) . ' ' . $base_currency }} =
                                            <span>
                                                {{ $exchange_rate->base_currency == $base_currency
                                                    ? round(($amount ?? 1) * $exchange_rate->buying_rate, 3)
                                                    : round(($amount ?? 1) / $exchange_rate->buying_rate, 3) }}

                                            </span> {{ $target_currency }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif


            </div>
        </div>

    </section>

    <!-- currency section end  -->


@endsection

@push('scripts')
    <script>
        function toggleRatePreview(type) {
            let rates = document.querySelectorAll('.exchange_rate_display');

            console.log(user_amount)
            if (type == 'buying') {
                rates.forEach(rate => {


                    rate.querySelector('span').innerHTML = calculateConvertedAmount(rate.dataset.buying, rate
                        .dataset.base)


                })
                console.log(type)
            } else {
                rates.forEach(rate => {


                    // console.log(rate.dataset.selling, rate.dataset.base)
                    // console.log(calculateConvertedAmount(rate.dataset.selling, rate.dataset.base))
                    rate.querySelector('span').innerHTML = calculateConvertedAmount(rate.dataset.selling, rate
                        .dataset.base)
                    // rate.innerHTML = `${user_amount} ${base} = <span>${convertedAmount}</span> ${base} <br> <span class="fw-semibold fs-6">${base} = ${sellingRate} ${base}</span>`
                })
                console.log(type)
            }
        }

        function calculateConvertedAmount(rate, base) {
            let user_base_currency = document.getElementById('user_base_currency').value;
            let user_amount = parseFloat(document.getElementById('user_amount').value); // Ensure it's a number
            rate = parseFloat(rate); // Make sure rate is a float

            let convertedAmount = 0;

            if (user_base_currency == base) {
                console.log(true)
                convertedAmount = (user_amount * rate).toFixed(3);
            } else {
                convertedAmount = (user_amount / rate).toFixed(3);
            }

            return convertedAmount;
        }


        // function calculateConvertedAmount(rate, base) {
        //     let user_base_currency = document.getElementById('user_base_currency').value;
        //     let user_amount = document.getElementById('user_amount').value;

        //     console.log(parseFloat(rate))

        //     let convertedAmount = 0
        //     if (user_base_currency == base) {
        //         let convertedAmount = (user_amount * parseFloat(rate)).toFixed(3);
        //     } else {
        //         let convertedAmount = (user_amount / parseFloat(rate)).toFixed(3);
        //     }

        //     return convertedAmount

        // }
    </script>
@endpush
