@extends('frontend.layouts.main')

@section('title', 'Insurance')


@section('content')

<section>
    <div class="insurance-header">
      <div class="container">
        <h5>Insurance Services</h5>
        <h4 class="text-wrap">"Secure Your Future Today! Explore our Comprehensive Insurance Services – Protect
          What Matters Most to You."</h4>
      </div>
    </div>
  </section>

  @yield('insurance_content')


{{-- <section id="payment-section" class="insurance-payment" style="display: none;">
  <div class="container mt-5 ">
    <h5 class="mb-4"><i id="back-btn" class="bi bi-chevron-left" style="cursor: pointer;"></i> Payment</h5>
    <h6 class="mb-4">Payment Summary:</h6>
    <table class="table table-bordered table-sm">
      <tbody>
        <tr>
          <td> Course Name</td>
          <td>Course Name</td>
        </tr>
        <tr>
          <td> Product ID</td>
          <td>26</td>
        </tr>
        <tr>
          <td> Price</td>
          <td>10,000</td>
        </tr>
        <tr>
          <td> Discount/ Coupon</td>
          <td>0</td>
        </tr>
        <tr>
          <td> Total</td>
          <td>10,000</td>
        </tr>
      </tbody>
    </table>
    <h6 class="mt-4"> Select Payment Wallet:</h6>

    <!-- new  -->
    <div class="row row-cols-auto gap-2 payment mt-5">
      <div class="col">
        <input type="radio" class="btn-check" name="options-pay" id="btn-pay-1" autocomplete="off">
        <label class="btn btn-outline-secondary fs-5 p-2 pay_btn" for="btn-pay-1"><img
            src="Images/esewa-logo-DA36F8FD2F-seeklogo.com 3.jpg" class="img-fluid w-100 h-100 rounded-2"></label>
      </div>
      <div class="col">
        <input type="radio" class="btn-check" name="options-pay" id="btn-pay-2" autocomplete="off">
        <label class="btn btn-outline-secondary fs-5 p-2 pay_btn" for="btn-pay-2"><img src="Images/appstore.png"
            class="img-fluid w-100 h-100 rounded-2"></label>
      </div>
      <div class="col">
        <input type="radio" class="btn-check" name="options-pay" id="btn-pay-3" autocomplete="off">
        <label class="btn btn-outline-secondary fs-5 p-2 pay_btn" for="btn-pay-3"><img src="Images/logolast.png"
            class="img-fluid w-100 h-100 rounded-2"></label>
      </div>
      <div class="col">
        <input type="radio" class="btn-check" name="options-pay" id="btn-pay-4" autocomplete="off">
        <label class="btn btn-outline-secondary fs-5 p-2 pay_btn" for="btn-pay-4"><img
            src="Images/esewa-logo-DA36F8FD2F-seeklogo.com 3.jpg" class="img-fluid w-100 h-100 rounded-2"></label>
      </div>
    </div>

    <!-- new end  -->

    <button class="btn insurance-payment-btn my-5 "><i class="fas fa-credit-card"></i> Pay with eSewa:
      10,000</button>
  </div>
</section> --}}



@endsection



@push('scripts')
{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
      const insuranceLinks = document.querySelectorAll(".insurance-link");
      const insuranceSection = document.querySelector(".insurance");
      const insuranceBody = document.querySelector("#new-insurance");
      const insuranceHeader = document.querySelector(".insurance-header");
      const paymentSection = document.querySelector("#payment-section");
      const buyNowButtons = document.querySelectorAll(".btn-buy-now");
      const backButton = document.querySelector("#back-btn");

      // Function to toggle display of elements
      const toggleDisplay = (element, show) => {
        if (element) {
          element.style.display = show ? "block" : "none";
          console.log(`${element.className || element.id} -> ${show ? "Visible" : "Hidden"}`);
        } else {
          console.error("Element not found!");
        }
      };

      // Click on insurance links to show insurance details
      insuranceLinks.forEach(link => {
        link.addEventListener("click", function (event) {
          event.preventDefault();
          toggleDisplay(insuranceSection, false); // Hide main insurance section
          toggleDisplay(insuranceBody, true); // Show insurance details
        });
      });

      // Click on "Buy Now" to show payment section and hide insurance
      buyNowButtons.forEach(button => {
        button.addEventListener("click", function (event) {
          event.preventDefault();
          console.log("Buy Now clicked");

          toggleDisplay(insuranceBody, false); // Hide insurance details
          toggleDisplay(insuranceHeader, false); // Hide insurance header
          toggleDisplay(paymentSection, true); // Show payment section
        });
      });

      // Click on "Back" to return to insurance section
      backButton?.addEventListener("click", function () {
        console.log("Back clicked");

        toggleDisplay(paymentSection, false); // Hide payment section
        toggleDisplay(insuranceBody, true); // Show insurance details
        toggleDisplay(insuranceHeader, true); // Show insurance header
      });
    });

  </script> --}}


@endpush