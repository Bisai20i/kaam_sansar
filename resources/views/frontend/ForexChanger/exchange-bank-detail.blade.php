@extends('frontend.layouts.main')

@section('title', 'Exchange Money - Bank Detail')

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
    <section class="converter container d-flex justify-content-center">
        <div class="col-lg-6 text-center border border-2 border-light-subtle">
            <h4 class="primary_color_text mt-4 fw-bold">Give Your Bank Details</h4>
            <div class="row px-md-5 px-2 pb-2">
                <div class="form-floating">
                    <input class="form-control bg-dark-subtle rounded-0" placeholder="Enter Bank Name"
                        id="bankname"></input>
                    <label class="ms-4" for="bankname">Enter Bank Name</label>
                </div>
                <div class="form-floating">
                    <input class="form-control bg-dark-subtle rounded-0" placeholder="A/C No." id="acno"></input>
                    <label class="ms-4" for="acno">A/C No.</label>
                </div>
                <div class="form-floating">
                    <input class="form-control bg-dark-subtle rounded-0" placeholder="Enter Amount" id="amt"></input>
                    <label class="ms-4" for="amt">Enter Amount</label>
                </div>
                <div class="form-floating">
                    <textarea class="form-control bg-dark-subtle rounded-0" placeholder="Remarks" rows="3" id="remarks"></textarea>
                    <label class="ms-4" for="remarks">Remarks</label>
                </div>
                <div>
                    <a type="button" href="payment.html" class="btn primary_color_bg"> Send</a>
                </div>
            </div>






        </div>
    </section>
    <!-- bank details section end  -->


@endsection
