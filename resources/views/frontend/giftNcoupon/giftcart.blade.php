@extends('frontend.giftNcoupon.giftMain')

@section('giftContent')

    <section class="giftcart my-5" id="giftcart">
        <div class="container mt-5">
            <div class="row">
                <!-- Left: Cart Items -->
                <div class="col-md-8">
                    <!-- Card: Select All & Delete -->
                    <form action="{{ route('deletecarts') }}" id="cartDisplayForm" method="post" id="deleteCartForm"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <div class="card p-2 mb-3 cart-select-delete">
                            <div class="d-flex justify-content-between ">
                                <div>
                                    <input type="checkbox" id="selectAll" onchange="selectAllItems()"
                                        style="cursor: pointer;">
                                    <label for="selectAll">Select All</label>
                                </div>
                                <div>
                                    <button type="submit" style="all:unset; cursor: pointer; "
                                        class="btn-delete d-inline m-0 "><i class="bi bi-trash"></i> Delete</button>
                                </div>
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Cart Item 1 -->
                        @foreach ($coupons as $coupon)
                            @if (!$coupon->ordered)
                                <div class="card mb-2 p-2 cart-item" style="height:max-content;">
                                    <div class="d-flex align-items-center h-auto">
                                        <input type="checkbox" class="me-2 item-checkbox" name="ids[]"
                                            style="cursor: pointer;" value="{{ $coupon->id }}">

                                        <img src="{{ $coupon->giftCoupon->thumbnail ? asset('storage/' . $coupon->giftCoupon->thumbnail) : asset('frontend/assets/Images/giftandcoupon.png') }}"
                                            class="img-fluid rounded me-3" alt="Product">

                                        <!-- Product details, price, and buttons in one container -->
                                        <div class="flex-grow-1 d-flex flex-column">
                                            <!-- Product Name and Price on One Line -->
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6>{{ $coupon->giftCoupon->title }}</h6>
                                                <h5>NRs. {{ $coupon->giftCoupon->price }}</h5>
                                            </div>

                                            <!-- Size and Buttons on the Same Line -->
                                            <div class="d-flex justify-content-between align-items-center mt-1">
                                                <article>
                                                    {!! $coupon->giftCoupon->description !!}
                                                </article>
                                                
                                                <div class="gift-cart-btns d-flex align-items-center">
                                                    <a href="{{ route('subquantity', ['id' => $coupon->id]) }}"
                                                        class="btn btn-plus-minus">-</a>
                                                    <span class="mx-2"
                                                        id="_quantity{{ $coupon->id }}">{{ $coupon->quantity }}</span>

                                                    <a href="{{ route('addquantity', ['id' => $coupon->id]) }}"
                                                        class="btn btn-plus-minus">+</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </form>


                    <div class="delivery-details pt-3 p-2 mb-3 d-none" id="deliveryDetailsForm">
                        <h2 class="mb-4"><span>Delivery Details</span> 
                            <button class="btn text-decoration-underline"
                                id="displayCartItems"><i class="bi bi-chevron-left"></i>Back</button>
                        </h2>
                        <form action="{{ route('order.place') }}" id="orderPlacementDetails" method="post">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="full_name" class="form-label">Full name</label><span class="text-danger ms-1">*</span>
                                    <input type="text" name="full_name" class="form-control" id="fullName"
                                        placeholder="Enter your first and last name" required autofocus
                                        value="{{ Auth::guard('job_seekers')->user()->firstName . ' ' . Auth::guard('job_seekers')->user()->lastName }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="form-label">Email Address</label><span class="text-danger ms-1">*</span>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Enter Email Address" required
                                        value="{{ Auth::guard('job_seekers')->user()->emailAddress }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="phone" class="form-label">Phone Number</label><span class="text-danger ms-1">*</span>
                                    <input type="text" name="phone" class="form-control" id="phone"
                                        placeholder="Enter Phone Number" required
                                        value="{{ Auth::guard('job_seekers')->user()->phoneNumber }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="altPhone" class="form-label">Alternative Phone no.</label>
                                    <input type="text" name="alternative_phone" class="form-control" id="altPhone"
                                        placeholder="Enter Alternative Phone No">
                                </div>
                                <div class="col-md-4">
                                    <label for="country" class="form-label">Country</label><span class="text-danger ms-1">*</span>
                                    <input type="text" name="country" class="form-control" required
                                        value="{{ Auth::guard('job_seekers')->user()->country }}">
                                    {{-- <select class="form-select" name="country" id="country">
                                        <option>Select a country</option>
                                    </select> --}}
                                </div>
                                <div class="col-md-4">
                                    <label for="city" class="form-label">City</label><span class="text-danger ms-1">*</span>
                                    <input type="text" name="city" class="form-control" required
                                        value="{{ Auth::guard('job_seekers')->user()->city }}">
                                    {{-- <select class="form-select" name="city" id="city">
                                        <option>Select a city</option>
                                    </select> --}}
                                </div>
                                <div class="col-md-4">
                                    <label for="apartment" class="form-label">Apartment no.</label><span class="text-danger ms-1">*</span>
                                    <input type="text" class="form-control" name="appartment_no" id="apartment" required
                                        placeholder="Enter Apartment No">
                                </div>
                                <div class="col-md-4">
                                    <label for="house" class="form-label">House no.</label><span class="text-danger ms-1">*</span>
                                    <input type="text" class="form-control" name="house_no" id="house" required
                                        placeholder="Enter House No.">
                                </div>
                                <div class="col-md-4">
                                    <label for="landmark" class="form-label">Nearby Landmark</label> <span class="text-danger ms-1">*</span>
                                    <input type="text" class="form-control" name="landmark" id="landmark" required
                                        placeholder="Enter a nearby landmark">
                                </div>
                                <div class="col-md-4">
                                    <label for="deliveryTime" class="form-label">Expected Delivery Time</label>
                                    <input type="date" class="form-control" name="expected_date" id="delivery_date"
                                        id="deliveryTime">
                                </div>
                                <div class="col-md-4 ">
                                    <label for="deliveryPreferences" class="form-label">Delivery Preferences</label>
                                    <select class="form-select" name="preferred_time" id="deliveryPreferences">
                                        <option value="">Select preferred Delivery Time</option>
                                        <option value="morning">Morning</option>
                                        <option value="evening">Evening</option>
                                        <option value="day">Day</option>
                                        <option value="night">Night</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4 mb-4">
                                <label for="specialInstructions" class="form-label">Special Instruction for
                                    Delivery</label>
                                <textarea class="form-control" name="instructions" id="specialInstructions" rows="3"
                                    placeholder="Any special instructions for delivery"></textarea>
                            </div>
                        </form>
                    </div>



                </div>


                <!-- Right: Order Summary -->
                <div class="col-md-4 my-2">
                    <div class="card cart-location p-2" >
                        <h4 class="mb-1"> Location</h4>
                        <p class="pt-1 mb-0"><i class="bi bi-geo-alt "></i>{{ Auth::guard('job_seekers')->user()->permanentLocation }}</p>
                        <hr class="my-2">
                        <h3>Order Summary</h3>

                        @php
                            $totalAmount = 0;
                            $totalDiscount = 0;
                        @endphp
                        @foreach ($coupons as $coupon)
                            @php
                                $itemTotal = $coupon->quantity * $coupon->giftCoupon->price;
                                $totalDiscount += (100 - $coupon->giftCoupon->discount) * 0.01 * $itemTotal;
                                $totalAmount += $itemTotal;

                            @endphp
                            <div class="d-flex justify-content-between py-1">
                                <span>{{ $coupon->giftCoupon->title }}</span>
                                <h2>NRs. {{ number_format($itemTotal, 2) }}</h2>
                            </div>
                        @endforeach


                        <div class="mb-2">
                            <input type="text"
                                class="location-apply-text-box px-1 rounded rounded-1 form-control d-inline"
                                placeholder="Enter Voucher Code">
                            <button class=" location-apply-btn mt-2">Apply</button>
                        </div>

                        <div class="d-flex justify-content-between mt-1">
                            <span>Discount</span>
                            <h2>NRs. {{ number_format($totalDiscount, 2) }}</h2>
                        </div>

                        <div class="d-flex justify-content-between mt-2 mb-2">
                            <h3>Total</h3>
                            <h5>NRs. {{ number_format($totalAmount - $totalDiscount, 2) }}</h5>
                        </div>
                        <button class="location-place-order-btn mb-2 py-2" id="proceedButton">Proceed</button>
                        <button class="location-place-order-btn mb-2 d-none py-2" id="proceedPaymentButton"
                            onclick="placeOrder()">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const deliveryDetailsForm = document.getElementById('deliveryDetailsForm')
            const cartDisplayForm = document.getElementById('cartDisplayForm')
            const deleteCartForm = document.getElementById('deleteCartForm')
            const proceedButton = document.getElementById('proceedButton');
            const proceedPaymentButton = document.getElementById('proceedPaymentButton')
            
            document.getElementById('displayCartItems').addEventListener('click', () => {
                
                cartDisplayForm.classList.remove('d-none')
                deliveryDetailsForm.classList.add('d-none')
                proceedButton.classList.remove('d-none')
                proceedPaymentButton.classList.add('d-none')
            })

            proceedButton.addEventListener('click', () => {
                cartDisplayForm.classList.add('d-none')
                deliveryDetailsForm.classList.remove('d-none')
                proceedButton.classList.add('d-none')
                proceedPaymentButton.classList.remove('d-none')
            })

            const requiredFields = document.querySelectorAll('#orderPlacementDetails [required]');

            requiredFields.forEach(field => {
                field.addEventListener('input', () => {
                    if (field.checkValidity()) {
                        // Remove the red outline
                        field.style.outline = ''; // Reset to default border
                        // Remove the error message
                        const errorMessage = field.nextElementSibling;
                        if (errorMessage) {
                            errorMessage.remove();
                        }
                    }
                });
            });

            proceedPaymentButton.addEventListener('click', () => {
                const form = document.getElementById('orderPlacementDetails');

                // Check if the form is valid
                if (form.checkValidity()) {
                    // If valid, submit the form
                    form.submit();
                } else {

                    const requiredFields = form.querySelectorAll('[required]');
                    requiredFields.forEach(field => {
                        if (!field.checkValidity()) {
                            const errorMessage = document.createElement('small');
                            errorMessage.textContent = 'This field is required.';
                            errorMessage.style.color = '#ff7f7f'; 
                            field.style.outline = '1px solid #ff7f7f';
                            field.parentNode.insertBefore(errorMessage, field.nextSibling);

                            setTimeout(() => {
                                errorMessage.remove()
                            }, 1500);
                        }
                    });
                }
            })

            deleteCartForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const checkboxes = document.querySelectorAll('.item-checkbox:checked');

                // If no items are selected, prevent form submission
                if (checkboxes.length === 0) {
                    alert('Please select at least one item to delete.');
                    return false;
                }

                // Confirm before deleting
                if (confirm('Are you sure you want to delete the selected items?')) {
                    this.submit();
                }
            })

            
        });
        
    </script>
    <script>
        // function increase(id) {
        //     let quantity = parseInt(document.getElementById(id).textContent)
        //     document.getElementById(id).textContent = quantity + 1

        // }

        // function decrease(id) {
        //     let quantity = parseInt(document.getElementById(id).textContent)
        //     if (quantity > 1) {
        //         document.getElementById(id).textContent = quantity - 1
        //     }

        // }

        function selectAllItems() {

            if (document.getElementById('selectAll').checked) {
                document.querySelectorAll('.item-checkbox').forEach(item => {
                    item.checked = true;
                })
            } else {
                document.querySelectorAll('.item-checkbox').forEach(item => {
                    item.checked = false;
                })
            }

        }
    </script>
@endpush
