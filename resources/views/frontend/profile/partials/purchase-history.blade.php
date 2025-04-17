@extends('frontend.profile.jobseeker-dashboard')

@section('profileSection')
    <div id="purchaseHistory" class="content-section">
        <!-- Purchase History Content -->
        <div class="card-container border py-3">
            <div class="row">
                <!-- Job Listings Column -->
                <div class="col-md-8">
                    <!-- First Purchase Card -->





                    <div class="purchase-card mb-4">
                        <img src="{{ asset('frontend/assets/Images/teddy-bear.jpg') }}" alt="Company Image" />
                        <button class="delete-btn">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <button class="delete-btn">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <div class="purchase-card-body">
                            <h5 class="card-title">Teddy Bear</h5>
                            <p>Quantity: 5pcs</p>
                            <p>Source: Company Website</p>
                        </div>
                        <div class="full-width-border"></div>
                        <div class="purchase-card-footer">
                            <small>Purchase Date: 2020-01-01</small>
                        </div>
                    </div>

                    <div class="purchase-card mb-4">
                        <img src="{{ asset('frontend/assets/Images/teddy-bear.jpg') }}" alt="Company Image" />
                        <button class="delete-btn">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <button class="delete-btn">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <div class="purchase-card-body">
                            <h5 class="card-title">Teddy Bear</h5>
                            <p>Quantity: 5pcs</p>
                            <p>Source: Company Website</p>
                        </div>
                        <div class="full-width-border"></div>
                        <div class="purchase-card-footer">
                            <small>Purchase Date: 2020-01-01</small>
                        </div>
                    </div>


                    <div class="purchase-card mb-4">
                        <img src="{{ asset('frontend/assets/Images/teddy-bear.jpg') }}" alt="Company Image" />
                        <button class="delete-btn">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <button class="delete-btn">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <div class="purchase-card-body">
                            <h5 class="card-title">Teddy Bear</h5>
                            <p>Quantity: 5pcs</p>
                            <p>Source: Company Website</p>
                        </div>
                        <div class="full-width-border"></div>
                        <div class="purchase-card-footer">
                            <small>Purchase Date: 2020-01-01</small>
                        </div>
                    </div>



                </div>

                <!-- Responsive Box Column -->
                <div class="col-md-4">
                    <div class="additional-info border p-2">
                        <p>
                            This is a fully responsive box that can be used for additional
                            content.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
