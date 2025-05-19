@extends('frontend.layouts.main')

@section('title', 'Exchange Money - Bank Detail')

@section('content')

    <style>
        .border-danger {
            border-color: red !important;
        }

        .is-invalid {
            border-color: red !important;
        }
    </style>


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


    <section class="converter container mt-5">

        <form id="exchangeForm" method="POST" action="{{ route('exchange.currency.store') }}" class="col-lg-6 mx-auto"
            novalidate>
            @csrf
            <input type="hidden" name="jobseeker_id" value="{{ Auth::guard('job_seekers')->user()->id }}">
            <input type="hidden" name="forex_calculator_id" value="{{ $exchange_rate->id }}">
            <input type="hidden" name="base_currency" value="{{ $base_currency }}">
            <input type="hidden" name="buy_or_sell" value="{{ $type }}" class="forex_type">

            <!-- Tabs and Tab Buttons -->
            <nav>
                <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
                    <button class="nav-link px-4 fw-semibold rounded-0 rounded-start-2 border active" id="nav-home-tab"
                        data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab"
                        aria-controls="nav-home" aria-selected="true" style="font-size: 18px;">Sender</button>

                    <button
                        class="nav-link px-4 fw-semibold rounded-0 rounded-end-2 border border-start-0 border-end-bottom-0"
                        id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button"
                        role="tab" aria-controls="nav-profile" aria-selected="false"
                        style="font-size: 18px;">Receiver</button>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <!-- Sender Tab -->
                <div class="tab-pane p-4 fade bg-white rounded-2 border show active" id="nav-home" role="tabpanel"
                    style="background: #fff !important;">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Bank Name" name="sender_bank_name" required>
                        <label>Sender Bank Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" placeholder="Account No" name="sender_account_number"
                            required>
                        <label>Sender Account No.</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" placeholder="Enter Amount" id="sender-amt"
                            name="transfer_amount" value="{{ $amount }}" data-base={{ $base_currency }}
                            data-rate="{{ $exchange_rate->base_currency == $base_currency ? ($type == 'buy' ? $exchange_rate->buying_rate : $exchange_rate->selling_rate) : ($type == 'buy' ? 1 / $exchange_rate->selling_rate : 1 / $exchange_rate->buying_rate) }}"
                            required>
                        {{-- <input type="number" class="form-control" placeholder="Transfer Amount" name="transfer_amount"
                            required> --}}
                        <label>Transfer Amount</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Remarks" name="remarks" required></textarea>
                        <label>Remarks</label>
                    </div>
                </div>

                <!-- Receiver Tab -->
                <div class="tab-pane fade bg-white rounded-2 border p-4" id="nav-profile" role="tabpanel"
                    style="background: #fff !important;">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Receiver Bank Name"
                            name="receiver_bank_name" required>
                        <label>Receiver Bank Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" placeholder="Receiver Account No"
                            name="receiver_account_number" required>
                        <label>Receiver Account No.</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" placeholder="Receiver Amount" name="receiver_amount"
                            id="receiver-amt" readonly required>
                        <label>Receiver Amount</label>
                    </div>
                </div>

                <div class="text-center my-3">
                    <button type="submit" class="btn primary_color_bg w-auto py-2 mb-3 px-4">Submit Exchange
                        Request</button>
                </div>
            </div>
        </form>


        <!-- WhatsApp Contact -->
        <div class="col-12 mx-auto d-flex justify-content-end mt-3">
            <a href="#"
                class="bg-white border border-muted rounded fw-semibold  p-2 text-muted text-decoration-none d-flex align-items-center">
                <i class="fa fa-whatsapp text-success fs-5 fw-semibold me-2"></i>Contact on WhatsApp
            </a>
        </div>




    </section>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('exchangeForm');
            const senderTabBtn = document.getElementById('nav-home-tab');
            const receiverTabBtn = document.getElementById('nav-profile-tab');

            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                let senderInvalid = false;
                let receiverInvalid = false;

                const senderFields = form.querySelectorAll(
                    '#nav-home input[required], #nav-home textarea[required]');
                const receiverFields = form.querySelectorAll(
                    '#nav-profile input[required], #nav-profile textarea[required]');

                // Clear previous states
                form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                senderTabBtn.classList.remove('border-danger');
                receiverTabBtn.classList.remove('border-danger');

                // Validate sender
                senderFields.forEach(field => {
                    if (!field.value.trim()) {
                        senderInvalid = true;
                        field.classList.add('is-invalid');
                    }
                });

                // Validate receiver
                receiverFields.forEach(field => {
                    if (!field.value.trim()) {
                        receiverInvalid = true;
                        field.classList.add('is-invalid');
                    }
                });

                if (senderInvalid || receiverInvalid) {
                    if (senderInvalid) {
                        senderTabBtn.classList.add('border-danger');
                        senderTabBtn.click();
                    } else {
                        receiverTabBtn.classList.add('border-danger');
                        receiverTabBtn.click();
                    }
                } else {
                    form.submit(); // Submit manually after JS validation passes
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const senderInput = document.getElementById('sender-amt');
            const receiverInput = document.getElementById('receiver-amt');

            if (!senderInput || !receiverInput) {
                console.error('Missing input elements!');
                return;
            }

            function updateReceiverAmount() {
                const amount = parseFloat(senderInput.value);
                const rate = parseFloat(senderInput.dataset.rate);

                console.log('Sender amount:', amount);
                console.log('Exchange rate:', rate);

                if (!isNaN(amount) && !isNaN(rate)) {
                    const converted = amount * rate;
                    console.log('Converted amount:', converted);
                    receiverInput.value = converted.toFixed(3);
                    // receiverInput.value = new Intl.NumberFormat('en-US', {
                    //     minimumFractionDigits: 2,
                    //     maximumFractionDigits: 4
                    // }).format(converted);
                } else {
                    receiverInput.value = '';
                }
            }

            // Trigger on input change
            senderInput.addEventListener('input', updateReceiverAmount);

            // Trigger on page load
            updateReceiverAmount();
        });
    </script>
@endpush
