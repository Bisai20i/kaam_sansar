<style>
    .active {
        background: #0064A7 !important;
    }
</style>
<style>
  .icon-circle {
    background-color: #ffe6e6;
    width: 64px;
    height: 64px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .modal-content {
    border-radius: 16px;
  }
</style>


<nav class="navbar navbar-expand-lg fixed-top ">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">
            <span>
                <img src="{{ asset('frontend/assets/Images/logo.png') }}" img="img-fluid" alt="">
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- style for nav hover and active status -->

        <style>

            .navbar-nav .nav-item .nav-link {
                position: relative;
                transition: 0.3s ease-in-out;
                padding: 5px 3px !important;
            }

            .navbar-nav .nav-item .nav-link::before {
                content: "";
                position: absolute;
                bottom: 2px;
                left: 0;
                width: 0;
                height: 2;
                background-color: #0064A7;
                transition: 0.3s ease-in-out;
            }

            .navbar-nav .nav-item .active-navLink::before {
                content: "";
                position: absolute;
                bottom: 2px;
                left: 0;
                width: 100%;
                height: 2px;
                background-color: #0064A7;
                transition: 0.3s ease-in-out;
            }

            .active-dropdown-item {
                background-color: #d1ecff !important;

            }

            .navbar-nav .nav-item .active-navLink:hover::before,
            .navbar-nav .nav-item .nav-link:hover::before {
                content: "";
                position: absolute;
                bottom: 2px;
                left: 0;
                width: 35%;
                height: 2px;
                background-color: #0064A7;
            }
        </style>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav gap-3 m-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('index') ? 'active-navLink' : '' }}" aria-current="page"
                        href="{{ route('index') }}">Home</a>
                </li>
                <!-- Jobs Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('frontend.finds-jobs') || request()->routeIs('resume') ? 'active-navLink' : '' }}"
                        href="#" id="jobsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Jobs
                    </a>
                    <ul class="dropdown-menu " aria-labelledby="jobsDropdown">
                        <li class="nav-item">
                            <a class="dropdown-item {{ request()->routeIs('frontend.finds-jobs') ? 'active-dropdown-item' : '' }} "
                                aria-current="page" href="{{ route('frontend.finds-jobs') }}">Find
                                jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item {{ request()->routeIs('resume') ? 'active-dropdown-item' : '' }}"
                                aria-current="page" href="{{ route('resume') }}">Resume help</a>
                        </li>
                    </ul>
                </li>


                @if(Auth::guard('job_seekers')->user())
                {{-- <!-- Games Dropdown {{ request()->routeIs('spinn') || request()->routeIs('exit-poll') || request()->routeIs('quiz') ? 'active-navLink' : '' }} --> --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('polls*') || request()->routeIs('quiz*') ? 'active-navLink' : '' }}" href="#" id="gamesDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Games
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="gamesDropdown">
                        <li><a class="dropdown-item {{ request()->routeIs('quiz*') ? 'active-dropdown-item' : '' }}" href="{{ route('quiz.frontend') }}">Quiz</a></li>
                        <li><a class="dropdown-item {{ request()->routeIs('polls*') ? 'active-dropdown-item' : '' }}" href="{{ route('polls.create') }}">Exist Poll</a></li>
                        <li><a class="dropdown-item" href="#">Spinning Wheel</a></li>

                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <button class="nav-link" aria-current="page" data-bs-toggle="modal"
                        data-bs-target="#loginModal">Forms</button>
                </li>
                @endif


                <!-- Services Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle 
                        {{ request()->routeIs('frontend.insurance') ||
                        request()->routeIs('visaHQ') ||
                        request()->routeIs('aboard*') ||
                        request()->routeIs('forex*') ||
                        request()->routeIs('frontend.advertisements') ||
                        request()->routeIs('gift*')
                            ? 'active-navLink'
                            : '' }}"
                        href="javascript:void(0);" id="servicesDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                        <li class="nav-item">
                            <a class="dropdown-item {{ request()->routeIs('frontend.insurance') ? 'active-dropdown-item' : '' }}"
                                aria-current="page" href="{{ route('frontend.insurance') }}">Insurance</a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item {{ request()->routeIs('visaHQ') ? 'active-dropdown-item' : '' }}"
                                aria-current="page" href="{{ route('visaHQ') }}">Visa HQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item {{ request()->routeIs('forex*') ? 'active-dropdown-item' : '' }}"
                                aria-current="page" href="{{ route('forex_calculator') }}">
                                Forex calculator</a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item {{ request()->routeIs('aboard*') ? 'active-dropdown-item' : '' }}"
                                aria-current="page" href="{{ route('aboarddeals') }}">Abroad
                                Deals</a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item {{ request()->routeIs('frontend.advertisements') ? 'active-dropdown-item' : '' }}"
                                href="{{ route('frontend.advertisements') }}" aria-current="page">Advertisement</a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item {{ request()->routeIs('gift*') ? 'active-dropdown-item' : '' }}"
                                aria-current="page" href="{{ route('gift.home', ['type' => 'all']) }}">Gift &
                                Coupon</a>
                        </li>
                    </ul>
                </li>

                @if (Auth::guard('job_seekers')->check())
                <!-- Forms Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle 
                        {{ request()->routeIs('passport*') || request()->routeIs('workPermits*') ? 'active-navLink' : '' }}"
                        href="#" id="formsDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Forms
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="formsDropdown">
                        <li><a class="dropdown-item {{ request()->routeIs('documentAttestations*') ? 'active-dropdown-item' : '' }}"
                                href="{{ route('documentAttestations.create') }}">Document Attestation</a></li>

                        <li><a class="dropdown-item {{ request()->routeIs('workPermits.create') ? 'active-dropdown-item' : '' }}"
                                href="{{ route('workPermits.create') }}">Work Permit</a></li>
                        <li><a class="dropdown-item {{ request()->routeIs('passport.partial') ? 'active-dropdown-item' : '' }}"
                                href="{{ route('passport.partial') }}">Passport Renewal</a></li>
                        <li><a class="dropdown-item {{ request()->routeIs('bankAccounts*') ? 'active-dropdown-item' : '' }}"
                                href="{{ route('bankAccounts.create') }}">Bank Account</a></li>
                        <li><a class="dropdown-item {{ request()->routeIs('brokerAccounts*') ? 'active-dropdown-item' : '' }}"
                                href="{{ route('brokerAccounts.create') }}">Broker Account</a></li>

                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <button class="nav-link" aria-current="page" data-bs-toggle="modal"
                        data-bs-target="#loginModal">Forms</button>
                </li>
                @endif


                <!-- Individual Items -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('horoscope') ? 'active-navLink' : '' }}"
                        aria-current="page" href="{{ route('horoscope') }}">Horoscope</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('frontend.discussion') ? 'active-navLink' : '' }}"
                        href="{{ route('frontend.discussion') }}" aria-current="page"
                        href="forumfeed.html">Discussion Forum</a>
                </li>
            </ul>

            @auth('job_seekers')
            @if (Auth::guard('job_seekers')->user()->isOtpVerified())
            <!-- Show Profile Button for Authenticated Users with Verified OTP -->
            <button id="main-profile" class="profile-button" data-bs-toggle="modal"
                data-bs-target="#profileModal">
                <img src="{{ Auth::guard('job_seekers')->user()->userThumbnail
                                ? asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail[0])
                                : asset('frontend/assets/Images/profile.jpg') }}">
            </button>

            <button class="btn-register" data-bs-toggle="modal" data-bs-target="#completeModal">Create
            </button>
            @else
            <!-- If user is logged in but OTP is not verified, show Login/Register buttons -->
            <a href="{{ route('jobseeker.otp_page') }}"> <button class="profile-button">
                    <img
                        src="{{ Auth::guard('job_seekers')->user()->userThumbnail
                                    ? asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail[0])
                                    : asset('frontend/assets/Images/profile.jpg') }}">
                </button>
            </a>
            @endif
            @else
            <!-- If user is completely unauthenticated, show Login/Register buttons -->
            <div class="d-flex align-items-center gap-2">
                <button class="btn-login mt-0" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                <button class="btn-register" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
            </div>
            <!-- If user is completely unauthenticated, show Login/Register buttons -->
            @endauth


        </div>
    </div>
</nav>

{{-- <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">
<span>
    <img src="{{ asset('frontend/assets/Images/logo.png') }}" img="img-fluid" alt="">
</span>
</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('frontend.finds-jobs') }}">Find jobs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " aria-current="page" href="{{ route('resume') }}">Resume help</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('aboarddeals') }}">abroad deals</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('visaHQ') }}">visa hq</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">insurance</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('forex_calculator') }}">forex
                calculator</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('horoscope') }}">horoscope</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('gift.home', ['type' => 'all']) }}">gifts &
                coupon</a>
        </li>

    </ul>

    @auth('job_seekers')
    @if (Auth::guard('job_seekers')->user()->isOtpVerified())
    <!-- Show Profile Button for Authenticated Users with Verified OTP -->
    <button id="main-profile" class="profile-button" data-bs-toggle="modal" data-bs-target="#profileModal">
        <img
            src="{{ Auth::guard('job_seekers')->user()->userThumbnail
                                ? asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail[0])
                                : asset('frontend/assets/Images/profile.jpg') }}">
    </button>
    @else
    <!-- If user is logged in but OTP is not verified, show Login/Register buttons -->
    <a href="{{ route('jobseeker.otp_page') }}"> <button class="profile-button">
            <img
                src="{{ Auth::guard('job_seekers')->user()->userThumbnail
                                    ? asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail[0])
                                    : asset('frontend/assets/Images/profile.jpg') }}">
        </button>
    </a>
    @endif
    @else
    <!-- If user is completely unauthenticated, show Login/Register buttons -->
    <div class="d-flex align-items-center gap-2">
        <button class="btn-login" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        <button class="btn-register" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
    </div>
    @endauth


</div>
</div>

</nav> --}}




<!-- Modal for completing profile 1-->
<div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="completeModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <h3 class="modal-title text-center" id="completeModalLabel">Complete your profile</h3>
            <p class="text-center text-muted">Tell us a bit about yourself to get started</p>
            <!-- Close Button -->
            <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                aria-label="Close"></button>
            <div class="modal-body">
                <div class="mb-4 text-center">
                    <div class="d-flex align-items-start justify-content-center">

                        <div class="d-flex flex-column align-items-center">
                            <div class="d-flex align-items-center justify-content-center"
                                style="width: 100%; position: relative;">
                                <div>
                                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center mb-2"
                                        style="width: 32px; height: 32px; background-color: #0064A7; border: 2px solid #0064A7;">
                                        1
                                    </div>
                                </div>
                            </div>
                            <p class="small">Looking for</p>
                        </div>

                        <div class="d-flex align-items-center mt-3"
                            style="height: 2px; background-color: #ddd; width: 60px;">
                        </div>

                        <div class="d-flex flex-column align-items-center">
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-2 text-white"
                                style="width: 32px; height: 32px; border: 2px solid #ddd;">2
                            </div>
                            <p class="small">Profile Details</p>
                        </div>
                        <div class="d-flex align-items-center mt-3"
                            style="height: 2px; background-color: #ddd; width: 60px;">
                        </div>

                        <div class="d-flex flex-column align-items-center">
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white"
                                style="width: 32px; height: 32px; border: 2px solid #ddd;">3
                            </div>
                            <p class="small">Choose a CV</p>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">What you are looking for?</label>
                    <br>
                    <label class="form-text">Selected an option:</label>
                    <select class="form-select" id="selectUserType">
                        <option value="trainee"
                            {{ Auth::guard('job_seekers')->check() && Auth::guard('job_seekers')->user()->type ? (Auth::guard('job_seekers')->user()->type == 'trainee' ? 'selected' : '') : '' }}>
                            Internship</option>
                        <option value="fulltime"
                            {{ Auth::guard('job_seekers')->check() && Auth::guard('job_seekers')->user()->type ? (Auth::guard('job_seekers')->user()->type == 'fulltime' ? 'selected' : '') : '' }}>
                            Full time Job</option>
                        <option value="parttime"
                            {{ Auth::guard('job_seekers')->check() && Auth::guard('job_seekers')->user()->type ? (Auth::guard('job_seekers')->user()->type == 'parttime' ? 'selected' : '') : '' }}>
                            Part time Job</option>
                        <option value="user"
                            {{ Auth::guard('job_seekers')->check() && Auth::guard('job_seekers')->user()->type ? (Auth::guard('job_seekers')->user()->type == 'user' ? 'selected' : '') : '' }}>
                            Normal User</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-light" style="background-color: #E9E9E9;"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" onclick="updateProfileType(this)" class="btn btn-light"
                        style="background-color: #0064A7; color:#fff">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    @if(session('showLoginModal'))
    var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
    loginModal.show();
    @endif
</script>


<!-- Modal for completing profile 2-->
<div class="modal fade" id="completeModal1" tabindex="-1" aria-labelledby="completeModalLabel1" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <h3 class="modal-title text-center" id="completeModalLabel1">Complete your profile</h3>
            <p class="text-center text-muted">Tell us a bit about yourself to get started</p>
            <!-- Close Button -->
            <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                aria-label="Close"></button>

            <div class="modal-body">
                <div class="mb-4 text-center">
                    <div class="d-flex align-items-start justify-content-center">
                        <div class="d-flex flex-column align-items-center">
                            <div class="d-flex align-items-center justify-content-center"
                                style="width: 100%; position: relative;">
                                <div>
                                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center mb-2"
                                        style="width: 32px; height: 32px; background-color: #0064A7; border: 2px solid #0064A7;">
                                        1
                                    </div>
                                </div>
                            </div>
                            <p class="small">Looking for</p>
                        </div>

                        <div class="d-flex align-items-center mt-3"
                            style="height: 2px; background-color: #ddd; width: 60px;">
                        </div>

                        <div class="d-flex flex-column align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mb-2 text-white"
                                style="width: 32px; height: 32px; border: 2px solid #ddd; background-color: #0064A7">
                                2
                            </div>
                            <p class="small">Profile Details</p>
                        </div>

                        <div class="d-flex align-items-center mt-3"
                            style="height: 2px; background-color: #ddd; width: 60px;">
                        </div>

                        <div class="d-flex flex-column align-items-center">
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white"
                                style="width: 32px; height: 32px; border: 2px solid #ddd;">3
                            </div>
                            <p class="small">Choose a CV</p>
                        </div>
                    </div>
                </div>

                <h2 class="text-center mb-4">Create Profile</h2>

                <div class="text-center mb-4 d-flex justify-content-center">
                    <div class="border border-secondary rounded rounded-circle d-flex flex-column align-items-center justify-content-center p-2 position-relative ratio ratio-1x1"
                        style="width: 150px; height: 150px">
                        <input type="file" class="position-absolute w-100 h-100 opacity-0" accept="image/*"
                            name="image1" onchange="previewImage(this)" style="z-index: 1; cursor: pointer;" />
                        <span></span> <i class="fas fa-plus text-muted position-absolute" style="top: 45%; "></i>
                        <img src="{{ Auth::guard('job_seekers')->check() && isset(Auth::guard('job_seekers')->user()->userThumbnail[0]) ? asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail[0]) : '' }}"
                            class="rounded-circle w-100 h-100 {{ Auth::guard('job_seekers')->check() && isset(Auth::guard('job_seekers')->user()->userThumbnail[0]) ? '' : 'd-none' }}"
                            alt="Preview Image" id="preview" accept="image/*" />
                    </div>

                </div>

                <p class="text-center text-muted mb-4">Upload up to 5 photos. Click to select primary photo</p>



                <div class="row mb-4 d-flex justify-content-center" id="userProfileImages">

                    <div class="col-3">
                        <div
                            class="border border-secondary rounded d-flex flex-column align-items-center justify-content-center p-2 position-relative ratio ratio-1x1">
                            <input type="file" class="position-absolute w-100 h-100 opacity-0" accept="image/*"
                                name="image1" onchange="previewImage(this)" style="z-index: 1; cursor: pointer;" />
                            <i class="fas fa-plus text-muted position-absolute" style="top: 40%; left: 40%;"></i>
                            <img src="{{ Auth::guard('job_seekers')->check() && isset(Auth::guard('job_seekers')->user()->userThumbnail[1]) ? asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail[1]) : '' }}"
                                class="w-100 h-100 {{ Auth::guard('job_seekers')->check() && isset(Auth::guard('job_seekers')->user()->userThumbnail[1]) ? '' : 'd-none' }}"
                                alt="Preview Image" id="preview-0" />
                        </div>
                    </div>

                    <div class="col-3">
                        <div
                            class="border border-secondary rounded d-flex flex-column align-items-center justify-content-center p-2 position-relative ratio ratio-1x1">
                            <input type="file" class="position-absolute w-100 h-100 opacity-0" accept="image/*"
                                name="image2" onchange="previewImage(this)" style="z-index: 1; cursor: pointer;" />
                            <i class="fas fa-plus text-muted position-absolute" style="top: 40%; left: 40%;"></i>
                            <img src="{{ Auth::guard('job_seekers')->check() && isset(Auth::guard('job_seekers')->user()->userThumbnail[2]) ? asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail[2]) : '' }}"
                                class="w-100 h-100 {{ Auth::guard('job_seekers')->check() && isset(Auth::guard('job_seekers')->user()->userThumbnail[2]) ? '' : 'd-none' }}"
                                alt="Preview Image" id="preview-1" />
                        </div>
                    </div>

                    <div class="col-3">
                        <div
                            class="border border-secondary rounded d-flex flex-column align-items-center justify-content-center p-2 position-relative ratio ratio-1x1">
                            <input type="file" class="position-absolute w-100 h-100 opacity-0" accept="image/*"
                                name="image3" onchange="previewImage(this)" style="z-index: 1; cursor: pointer;" />
                            <i class="fas fa-plus text-muted position-absolute" style="top: 40%; left: 40%;"></i>
                            <img src="{{ Auth::guard('job_seekers')->check() && isset(Auth::guard('job_seekers')->user()->userThumbnail[3]) ? asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail[3]) : '' }}"
                                class="w-100 h-100 {{ Auth::guard('job_seekers')->check() && isset(Auth::guard('job_seekers')->user()->userThumbnail[3]) ? '' : 'd-none' }}"
                                alt="Preview Image" id="preview-2" />
                        </div>
                    </div>

                    <div class="col-3">
                        <div
                            class="border border-secondary rounded d-flex flex-column align-items-center justify-content-center p-2 position-relative ratio ratio-1x1">
                            <input type="file" class="position-absolute w-100 h-100 opacity-0" accept="image/*"
                                name="image4" onchange="previewImage(this)" style="z-index: 1; cursor: pointer;" />
                            <i class="fas fa-plus text-muted position-absolute" style="top: 40%; left: 40%;"></i>
                            <img src="{{ Auth::guard('job_seekers')->check() && isset(Auth::guard('job_seekers')->user()->userThumbnail[4]) ? asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail[4]) : '' }}"
                                class="w-100 h-100 {{ Auth::guard('job_seekers')->check() && isset(Auth::guard('job_seekers')->user()->userThumbnail[4]) ? '' : 'd-none' }}"
                                alt="Preview Image" id="preview-3" />
                        </div>
                    </div>
                </div>

                <form id="profileForm">
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" name="fullName"
                            placeholder="Full Name: {{ Auth::guard('job_seekers')->check() ? Auth::guard('job_seekers')->user()->firstName . ' ' . Auth::guard('job_seekers')->user()->lastName : '' }}"
                            style="border-color: #8C8C8C; background-color: #EDEDED; color: #818181;" />
                    </div>

                    {{-- <div class="form-group">
                        <input type="text" class="form-control mb-2" 
                            placeholder="I am looking for : {{ Auth::guard('job_seekers')->check() ? Auth::guard('job_seekers')->user()->type : '' }}"
                    style="border-color: #8C8C8C; background-color: #EDEDED; color: #818181;" />
            </div> --}}
            <div class="form-group">
                <input type="text" class="form-control mb-2" name="profession"
                    placeholder="Designation: {{ Auth::guard('job_seekers')->check() ? Auth::guard('job_seekers')->user()->profession : '' }}"
                    style="border-color: #8C8C8C; color: #818181;" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control mb-2" name="expectedSalary"
                    placeholder="Expected Salary: {{ Auth::guard('job_seekers')->check() ? Auth::guard('job_seekers')->user()->expectedSalary : '' }}"
                    style="border-color: #8C8C8C; color: #818181;" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control mb-2" name="temporaryLocation"
                    placeholder="Current Address: {{ Auth::guard('job_seekers')->check() ? Auth::guard('job_seekers')->user()->temporaryLocation : '' }}"
                    style="border-color: #8C8C8C; color: #818181;" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control mb-2" name="permanentLocation"
                    placeholder="Permanent Address: {{ Auth::guard('job_seekers')->check() ? Auth::guard('job_seekers')->user()->permanentLocation : '' }}"
                    style="border-color: #8C8C8C; color: #818181;" />
            </div>
            <div class="form-group">
                <input type="email" class="form-control mb-2" readonly
                    placeholder="Email Address: {{ Auth::guard('job_seekers')->check() ? Auth::guard('job_seekers')->user()->emailAddress : '' }}"
                    style="border-color: #8C8C8C; background-color: #EDEDED; color: #818181;" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control mb-2" name="phoneNumber"
                    placeholder="Mobile No.: {{ Auth::guard('job_seekers')->check() ? Auth::guard('job_seekers')->user()->phoneNumber : '' }}"
                    style="border-color: #8C8C8C; color: #818181;" />
            </div>
            <div class="form-group">
                <label for="gender" class="form-label mb-1"><small
                        class="text-muted">Gender</small></label>
                <select type="text" class="form-control mb-2" placeholder="Gender: Female" name="gender"
                    style="border-color: #8C8C8C; color: #818181;">
                    <option value="male"
                        {{ Auth::guard('job_seekers')->check() && Auth::guard('job_seekers')->user()->gender == 'male' ? 'selected' : '' }}>
                        Male</option>
                    <option value="female"
                        {{ Auth::guard('job_seekers')->check() && Auth::guard('job_seekers')->user()->gender == 'female' ? 'selected' : '' }}>
                        Female</option>
                    <option value="other"
                        {{ Auth::guard('job_seekers')->check() && Auth::guard('job_seekers')->user()->gender == 'other' ? 'selected' : '' }}>
                        Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="gender" class="form-label mb-1"><small class="text-muted">I am
                        A</small></label>
                <select type="text" class="form-control mb-2" name="whoAmI"
                    style="border-color: #8C8C8C; color: #818181;">
                    <option value="student"
                        {{ Auth::guard('job_seekers')->check() && Auth::guard('job_seekers')->user()->whoAmI == 'student' ? 'selected' : '' }}>
                        Student</option>
                    <option value="worker"
                        {{ Auth::guard('job_seekers')->check() && Auth::guard('job_seekers')->user()->whoAmI == 'worker' ? 'selected' : '' }}>
                        Worker</option>
                    <option value="consultant"
                        {{ Auth::guard('job_seekers')->check() && Auth::guard('job_seekers')->user()->whoAmI == 'consultant' ? 'selected' : '' }}>
                        Consultant</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date" class="form-label mb-1"><small class="text-muted">Date of
                        Birth</small></label>
                <input type="date" class="form-control" name="dob"
                    value="{{ Auth::guard('job_seekers')->check() ? Auth::guard('job_seekers')->user()->dateOfBirth : '' }}"
                    placeholder="Date of Birth: 2002-09-27" style="border-color: #8C8C8C; color: #818181;" />
            </div>
            <div class="form-group">
                <label for="country" class="form-label mb-1"><small
                        class="text-muted">Country</small></label>
                <select type="text" class="form-control mb-2" name="country" id="selectCountry"
                    style="border-color: #8C8C8C; color: #818181;">
                    <option value="" selected>Select Country</option>

                </select>
            </div>
            </form>

            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-light" style="background-color: #E9E9E9;"
                    data-bs-toggle="modal" data-bs-target="#completeModal">Back</button>
                <button type="button" class="btn btn-light" style="background-color: #0064A7; color:#fff"
                    onclick="updateProfileDetails(this)">Next</button>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal for completing profile 3 -->
<div class="modal fade" id="completeModal2" tabindex="-1" aria-labelledby="completeModalLabel2" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <h3 class="modal-title text-center" id="completeModalLabel2">Complete your profile</h3>
            <p class="text-center text-muted">Tell us a bit about yourself to get started</p>
            <!-- Close Button -->
            <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                aria-label="Close"></button>
            <div class="modal-body">
                <div class="mb-4 text-center">
                    <div class="d-flex align-items-start justify-content-center">

                        <div class="d-flex flex-column align-items-center">
                            <div class="d-flex align-items-center justify-content-center"
                                style="width: 100%; position: relative;">
                                <div>
                                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center mb-2"
                                        style="width: 32px; height: 32px; background-color: #0064A7; border: 2px solid #0064A7;">
                                        1
                                    </div>
                                </div>
                            </div>
                            <p class="small">Looking for</p>
                        </div>

                        <div class="d-flex align-items-center mt-3"
                            style="height: 2px; background-color: #ddd; width: 60px;">
                        </div>

                        <div class="d-flex flex-column align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mb-2 text-white"
                                style="width: 32px; height: 32px; border: 2px solid #ddd; background-color: #0064A7">
                                2
                            </div>
                            <p class="small">Profile Details</p>
                        </div>
                        <div class="d-flex align-items-center mt-3"
                            style="height: 2px; background-color: #ddd; width: 60px;">
                        </div>

                        <div class="d-flex flex-column align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white"
                                style="width: 32px; height: 32px; border: 2px solid #ddd; background-color: #0064A7">
                                3
                            </div>
                            <p class="small">Choose a CV</p>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fs-4 font-weight-semibold mb-0">Choose CV</h2>
                    <a href="{{ route('resume') }}" style="color: #0064A7;">See More Templates <i
                            class="fas fa-arrow-right"></i></a>
                </div>
                <div
                    class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4 mb-4 d-flex align-content-center justify-content-center">

                    @php

                    $resumes = \App\Models\ResumeHelp::where('type', 0)
                    ->orderBy('created_at', 'desc')
                    ->take(3)
                    ->get();

                    @endphp

                    @foreach ($resumes as $resume)
                    <div class="col">
                        <div class="border p-2 rounded">
                            <img src="{{ asset('storage/' . $resume->image_preview) }}" alt="CV template"
                                class="img-fluid w-100" />
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-light" style="background-color: #E9E9E9;"
                    data-bs-toggle="modal" data-bs-target="#completeModal1">Back</button>
                <a href="{{ route('jobseeker.resume-maker') }}" type="button" class="btn btn-light"
                    style="background-color: #0064A7; color:#fff">Edit CV</a>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <h5 class="modal-title text-center" id="profileModalLabel">Your Profile</h5>
            <!-- Close Button Fixed to Top Right -->
            <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center">

                    <img src="{{ @Auth::guard('job_seekers')->user()->userThumbnail
                        ? asset('storage/' . @Auth::guard('job_seekers')->user()->userThumbnail[0])
                        : asset('frontend/assets/Images/profile.jpg') }}"
                        class="rounded-circle mb-3 profile-img" style="width: 100px; height: 100px;"
                        alt="Profile Picture">
                    <h5 class="card-title">{{ @Auth::guard('job_seekers')->user()->firstName }}
                        {{ @Auth::guard('job_seekers')->user()->lastName }}
                        <a href="{{ route('jobseeker.editProfile', ['user_id' => auth()->id()]) }}" class="d-block">
                            <i class="fa fa-pen p-1 text-decoration-none"></i>
                        </a>
                    </h5>
                    <p class="text-muted"><i class="fas fa-award"></i> Reward Points <br>272.38</p>
                </div>
                <ul class="list-unstyled text-start">
                    <li><a href="{{ route('jobseeker.getProfile', @Auth::guard('job_seekers')->user()->id) }}"
                            class="d-block"><i class="fas fa-user p-1"></i> Profile</a>
                    </li>
                    <hr>
                    <li>
                        <a href="{{ route('profile.documents', ['document_type' => 'passport']) }}"><i
                                class="fa-solid fa-folder ms-2" style="cursor:pointer;"></i> My Documents</a>
                    </li>
                    <hr>
                    <li><a href="{{ route('jobseeker.inbox', @Auth::guard('job_seekers')->user()->id) }}"
                            class="d-block text-decoration-none"><i
                                class="fa-solid fa-message p-1 text-decoration-none"></i></i> Messages</a>
                    </li>
                    <hr>
                    <li><a href="{{ route('jobseeker.change-password') }}" class="d-block text-decoration-none"><i
                                class="fas fa-lock p-1"></i> Change
                            password</a></li>
                    <hr>

                    <li><a href="{{ route('jobseeker.resume-maker') }}" class="d-block text-decoration-none"><i class="fas fa-edit p-1 text-decoration-none"></i>
                            Edit CV</a></li>
                    <hr>
                    <li><a href="#" class="d-block text-decoration-none"><i class="fas fa-share-alt p-1 text-decoration-none"></i>
                            Share</a></li>

                    <hr>
                    <li>
                        <form action="{{ route('jobseeker.logout') }}" method="POST" id="logoutForm"
                            class="d-inline">
                            @csrf
                            <!-- The logout button, now triggering form submission via JavaScript -->
                            <a href="javascript:void(0);" id="logoutButton">
                                <i class="fas fa-power-off p-1"></i> Logout
                            </a>
                        </form>
                    </li>

                    <script>
                        document.getElementById('logoutButton').addEventListener('click', function() {
                            // Submit the form when the logout button is clicked
                            document.getElementById('logoutForm').submit();
                        });
                    </script>

                </ul>
            </div>
        </div>
    </div>
</div>
<style>
    .iti__country-list {
        max-width: 420px;
        overflow-x: hidden;
        z-index: 9999;

    }

    /*
    i{
        color: #999999 !important
    } */
</style>
<!-- Login Modal -->
<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <h5 class="modal-title text-center" id="loginModalLabel" style="font-weight: 600px; font-size: 40px;">
                Login to your Account</h5>
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                aria-label="Close"></button>

            <div class="modal-body p-0 icon-gray" style="font-family: unset;">
                <!-- Social Login Buttons -->
                <div class="text-center">
                    <p class="text-muted">Welcome back! Select a method to login:</p>
                </div>

                <div class="d-flex justify-content-center mb-3">
                    <button type="button" class="btn-outline-secondary rounded-end-0 border-email active"
                        id="email-btn">
                        <i class="fa fa-envelope text-white"></i> Email
                    </button>
                    <button type="button" class="btn-outline-secondary rounded-start-0 border-phone" id="phone-btn">
                        <i class="fas fa-phone" style="color: #0064A7"></i> <span style="color: #555555;">Phone
                            Number</span>
                    </button>
                </div>

                <!-- Login Form -->
                <form method="POST" action="{{ route('jobseeker.login') }}" id="loginForm">
                    @csrf
                    <input type="hidden" name="email_or_phone" id="email_or_phone_login">



                    <input type="hidden" id="hasErrors"
                        value="{{ $errors->any() || session('error') ? '1' : '0' }}">


                    <!-- Hidden input for form type -->

                    <div id="email-form">
                        <div class="mb-3 col-12" class="d-none">
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #fff!important"><i
                                        class="fas fa-envelope"></i></span>
                                <input type="email" name="login_email" id="loginEmail"
                                    class="form-control @error('login_email') is-invalid @enderror"
                                    placeholder="Enter Your Email" autocomplete="off">
                                @error('login_email')
                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- <input type="text" name="login_phone_number" id="loginPhone"
                                  class="form-control @error('login_phone_number') is-invalid @enderror"
                                  placeholder="Enter Your Phone" minlength="10" maxlength="10" inputmode="numeric"
                                  pattern="[0-9]*" title="Phone number should be 10 digits" autocomplete="off">
                              <input type="hidden" name="country_code" id="country_code">
                              @error('login_phone_number')
                                  <div class="invalid-feedback" style="display: block;" style="display: block">
                                      {{ $message }}
                    </div>
                    @enderror --}}
            </div>

            <div class="d-none" id="phone-form">
                <div class="mb-3 col-12" class="d-none">
                    <input type="text" name="login_phone_number" id="loginPhone"
                        class="form-control @error('login_phone_number') is-invalid @enderror"
                        placeholder="Enter Your Phone" minlength="10" maxlength="10" inputmode="numeric"
                        pattern="[0-9]*" title="Phone number should be 10 digits" autocomplete="off">
                    <input type="hidden" name="country_code" id="country_code">
                    @error('login_phone_number')
                    <div class="invalid-feedback" style="display: block;" style="display: block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <!-- Password Input -->
            <div class="mb-3 input-group">
                <span class="input-group-text" style="background-color: #fff!important"><i
                        class="fa fa-lock"></i></span>
                <input type="password" name="login_password"
                    class="form-control @error('login_password') is-invalid @enderror" id="loginPassword"
                    placeholder="Enter Your Password" minlength="6" autocomplete="current-password">
                <span class="position-absolute"
                    style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"
                    onclick="togglePasswordVisibility('loginPassword')">
                    <i id="eyeIcon" class="fa fa-eye"></i>
                </span>
                @error('login_password')
                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe" name="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <a href="{{ route('jobseeker.verify-phone-page') }}" class="text-decoration-none">Forgot
                    Password?</a>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="  btn-create w-100" id="loginBtn">Login</button>
            </form>

            <!-- Register Link -->
            <div class="text-center mt-3">
                <p>Don't have an account? <a href="#registerModal" class="text-primary text-decoration-none"
                        data-bs-toggle="modal" data-bs-target="#registerModal">Create an account</a></p>
            </div>
            <p class="text-center mt-3">or register with</p>
            <form class="d-flex gap-2 justify-content-center" id="social-login" action="{{ route('auth.google') }}">

                <button type="submit" class="btn-outline-secondary w-100 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('frontend/assets/Images/icons8-google-48.png') }}" alt="Google Logo"
                        style="width: 20px;"> Google
                </button>
            </form>
        </div>
    </div>
</div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <h5 class="modal-title text-center" id="registerModalLabel" style="font-weight: 600; font-size: 40px;">
                Create an account</h5>
            <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                aria-label="Close"></button>


            <style>
                .icon-gray i {
                    color: #999999;
                }
            </style>
            <div class="modal-body p-0 icon-gray">
                <!-- Login Link -->

                <div class="text-center">
                    <p style="font-weight: 600px;font-size:16px; color: #9c9c9c;">Welcome back! Select method to login:
                        <a href="#loginModal" class="text-primary text-decoration-none" data-bs-toggle="modal"
                            data-bs-target="#loginModal"></a>
                    </p>
                </div>


                </style>
                <div class="d-flex justify-content-center mb-3">
                    <button type="button" class="btn-outline-secondary border-email rounded-end-0 active"
                        id="email-btn-register">
                        <i class="fa fa-envelope text-white"></i> Email
                    </button>

                    <button type="button" class="btn-outline-secondary rounded-start-0 border-phone"
                        id="phone-btn-register">
                        <i class="fas fa-phone text-black"></i> <span style="color: #555555;">Phone Number</span>
                    </button>
                </div>

                <!-- Register Form -->
                <form method="POST" action="{{ route('jobseeker.register') }}" id="registerForm"
                    onsubmit="handleFormSubmit(event, 'register')">
                    @csrf
                    <!-- Hidden input for form type -->
                    <input type="hidden" name="email_or_phone" id="email_or_phone_register">
                    <!-- First Name and Last Name -->
                    <div class="row mb-3">
                        <div class="col-md-6 ">
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" style="background-color: #fff!important"><i
                                        class="fas fa-user"></i></span>
                                <input type="text" name="first_name"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    placeholder=" First Name" value="{{ old('first_name') }}">
                                @error('first_name')
                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text " style="background-color: #fff!important"><i
                                        class="fas fa-user"></i></span>
                                <input type="text" name="last_name"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    placeholder="Last Name" value="{{ old('last_name') }}">
                                @error('last_name')
                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Country Code Dropdown (Always Visible) -->
                    <div class="mb-3 col-12">
                        <div class="input-group">
                            <span class="input-group-text " style="background-color: #fff!important"><i
                                    class="fas fa-flag"></i></span>
                            <select name="country" id="registerCountry"
                                class="form-control @error('country') is-invalid @enderror">
                                <option value="" selected>Select Country</option>
                                <!-- Country options will be dynamically populated by JavaScript -->
                            </select>
                        </div>
                    </div>
                    <div id="email-container">
                        <div class="mb-3 col-12">
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #fff!important"><i
                                        class="fas fa-envelope"></i></span>
                                <input type="email" name="email" id="signupEmail"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter Your Email" autocomplete="off" value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <!-- Phone Number -->
                    <div id="phone-container" style="display: none;">

                        <div class="mb-3 col-12">


                            <input type="tel" name="phone_number" id="registerPhone"
                                class="form-control @error('phone_number') is-invalid @enderror"
                                placeholder="Enter Your Phone" minlength="10" maxlength="10" inputmode="numeric"
                                pattern="[0-9]*" title="Phone number should be 10 digits" autocomplete="off">
                            <input type="hidden" name="country_code" id="registerCountryCode">
                            @error('phone_number')
                            <div class="invalid-feedback" style="display: block;" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>

                    <div class="mb-3 position-relative">
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #fff!important"><i
                                    class="fa fa-person"></i></span>
                            <span class="input-group-text border-end-0"
                                style="background-color: #fff!important;color:#999999">I
                                am a</span>
                            <select
                                class="form-select{{ $errors->has('whoAmI') ? ' is-invalid' : '' }} border-start-0"
                                name="whoAmI" required>
                                <option selected style="color: #999999;">Select</option>
                                <option value="student">Student</option>
                                <option value="worker">Worker</option>
                                <option value="consultant">Consultant</option>

                            </select>
                            @error('whoAmI')
                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="mb-3 input-group">
                        <span class="input-group-text" style="background-color: #fff!important"><i
                                class="fa fa-lock"></i></span>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" id="registerPassword"
                            placeholder="Enter Your Password" minlength="6" autocomplete="new-password">
                        <span class="position-absolute"
                            style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"
                            onclick="togglePasswordVisibility('registerPassword')">
                            <i id="registerEyeIcon" class="fa fa-eye"></i>
                        </span>
                        @error('password')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text" style="background-color: #fff!important"><i
                                class="fa fa-lock"></i></span>
                        <input type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="confirmRegisterPassword" placeholder="Enter Your confirm Password" minlength="6"
                            autocomplete="new-password">
                        <span class="position-absolute"
                            style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"
                            onclick="togglePasswordVisibility('confirmRegisterPassword')">
                            <i id="confirmRegisterEyeIcon" class="fa fa-eye"></i>
                        </span>
                        @error('password_confirmation')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="acceptedTerms" name="acceptedTerms">

                            <label class="form-check-label" for="acceptedTerms">
                                I agree to the <a href="#" class="text-primary">Terms & Conditions</a>
                            </label>

                        </div>
                        @error('acceptedTerms')
                        <div class="invalid-feedback" style="display: block;" style="display: block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-create w-100">Sign Up</button>
                </form>

                <!-- Social Media Login Options -->
                <p class="text-center mt-3">Already Have a account? <a href="#loginModal">Login</a></p>
                <div style="display: flex; align-items: center; width: 100%;">
                    <hr style="flex: 1; color: #A6A6A6;">
                    <div style="color: #A6A6A6; padding: 0 10px;">or continue with</div>
                    <hr style="flex: 1; color: #A6A6A6;">
                </div>
                <form action="{{ route('auth.google') }}" class="d-flex gap-2 justify-content-center">
                    <button type="submit" class=" btn-outline-secondary w-100 d-flex align-items-center justify-content-center">
                        <img class="img-fluid shadow-sm" src="{{ asset('frontend/assets/Images/icons8-google-48.png') }}" alt="Google Logo">
                        Google
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const updateProfileType = async (e) => {

        console.log(e)

        console.log('hello')

        e.innerHTML =
            `<span class="spinner-border spinner-border-sm mx-2" role="status" aria-hidden="true"></span>`

        try {
            const response = await fetch(getBaseUrl() + '/jobseeker/profile/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-HTTP-Method-Override': 'PUT'
                },
                body: JSON.stringify({
                    type: document.getElementById('selectUserType').value
                })
            });

            // Check for HTTP error response (like 401, 422, 500)
            if (!response.ok) {
                // Try to parse JSON error response
                const errorData = await response.json();
                console.error('Server error:', errorData);

                // Laravel validation errors (422 Unprocessable Entity)
                if (response.status === 422) {
                    alert('Validation failed: ' + Object.values(errorData.errors).join('\n'));
                }
                // Laravel unauthenticated (401)
                else if (response.status === 401) {
                    window.location.href = getBaseUrl() + '/login';
                } else {
                    alert('Something went wrong. Please try again.');
                }

                // Stop further execution
                return;
            }

            const data = await response.json();


            if (data.status) {
                // $(`#${next}`).modal('hide');
                e.innerHTML = "Next"
                $(`#completeModal`).modal('hide');
                $(`#completeModal1`).modal('show');

                return
            }
            e.innerHTML = "Next"
            console.log(data)
            // if (data.status) {
            //     $('#chatBox [name="message"]').val('');
            //     console.log('Message sent:', data);
            // } else {
            //     console.warn('Server responded with unexpected status:', data);
            // }

        } catch (error) {

            console.error('Fetch failed:', error);
        }

        //data-bs-toggle="modal" data-bs-target="#completeModal1"
    }

    function getBaseUrl() {
        return window.location.protocol + "//" + window.location.host;
    }

    async function updateProfileDetails(e) {

        e.innerHTML = `<span class="spinner-border spinner-border-sm mx-2" role="status" aria-hidden="true"></span>`

        let userProfileImages = document.getElementById('userProfileImages').querySelectorAll(
            'div div input[type="file"]');

        let images = []
        for (let i = 0; i < userProfileImages.length; i++) {
            if (userProfileImages[i].files.length == 0) continue
            images.push(userProfileImages[i].files[0])
        }

        try {
            let profileForm = document.getElementById('profileForm')
            let formData = new FormData();

            if (images.length > 0) {
                for (let i = 0; i < images.length; i++) {
                    formData.append('images[]', images[i]);
                }
            }
            // console.log(profileForm.querySelector('div input[name="fullName"]').value)
            formData.append('whoAmI', profileForm.querySelector('div select[name="whoAmI"]').value)
            formData.append('dob', profileForm.querySelector('div input[name="dob"]').value)
            formData.append('gender', profileForm.querySelector('div select[name="gender"]').value)
            formData.append('profession', profileForm.querySelector('div input[name="profession"]').value)
            formData.append('permanentLocation', profileForm.querySelector('div input[name="permanentLocation"]')
                .value)
            formData.append('temporaryLocation', profileForm.querySelector('div input[name="temporaryLocation"]')
                .value)
            formData.append('phoneNumber', profileForm.querySelector('div input[name="phoneNumber"]').value)
            formData.append('fullName', profileForm.querySelector('div input[name="fullName"]').value)
            formData.append('country', profileForm.querySelector('div select[name="country"]').value)

            formData.forEach((value, key) => {
                console.log(`${key}: ${value}`);
            });

            const response = await fetch(getBaseUrl() + '/jobseeker/profile/update', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-HTTP-Method-Override': 'PUT'
                },
                body: formData
            });

            // Check for HTTP error response (like 401, 422, 500)
            if (!response.ok) {
                // Try to parse JSON error response
                const errorData = await response.json();


                // Laravel validation errors (422 Unprocessable Entity)
                if (response.status === 422) {
                    alert('Validation failed: ' + Object.values(errorData.errors).join('\n'));
                }
                // Laravel unauthenticated (401)
                else if (response.status === 401) {
                    window.location.href = getBaseUrl() + '/login';
                } else {
                    console.error('Server error:', errorData);
                }

                // Stop further execution
                return;
            }

            const data = await response.json();


            if (data.status) {
                // $(`#${next}`).modal('hide');
                e.innerHTML = "Next"
                $(`#completeModal1`).modal('hide');
                $(`#completeModal2`).modal('show');

                return
            }
            e.innerHTML = "Next"
            console.log(data)
            if (data.status) {
                $('#chatBox [name="message"]').val('');
                console.log('Message sent:', data);
            } else {
                console.warn('Server responded with unexpected status:', data);
            }

        } catch (error) {
            e.innerHTML = "Next"
            console.error('Fetch failed:', error);
        }


        // console.log(images)

        //data-bs-toggle="modal" data-bs-target="#completeModal2"

        // for (let i = 0; i < userProfileImages.files.length; i++) {
        //     images.push(userProfileImages.files[i])
        // }
    }



    function previewImage(e) {
        // console.log(e)
        let parent = e.parentElement;
        const file = e.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {

            parent.querySelector('img').setAttribute('src', e.target.result);
            parent.querySelector('img').classList.remove('d-none');
        }
        reader.readAsDataURL(file);

    }
</script>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Fetch country data from REST Countries API
        fetch("https://restcountries.com/v3.1/all")
            .then((response) => response.json())
            .then((data) => {
                // Extract country names and their calling codes
                const countries = data.map((country) => ({
                    name: country.name.common,
                    shortCode: country.cca2, // Short code (e.g., NP for Nepal)

                    code: country.idd.root + (country.idd.suffixes ? country.idd.suffixes[0] :
                        '')
                }));

                // Sort countries alphabetically by name
                countries.sort((a, b) => a.name.localeCompare(b.name));

                // Function to populate the country code dropdown
                function populateCountry() {
                    const dropdown = document.getElementById('registerCountry');
                    const dropdown2 = document.getElementById('selectCountry');
                    dropdown.innerHTML =
                        `<option value="country" selected>Select Country</option>`;
                    dropdown2.innerHTML =
                        `<option value="country" selected>Select Country</option>`; // Default option

                    countries.forEach((country) => {
                        const option = document.createElement("option");
                        option.value = country.name;
                        option.textContent = `${country.name}`;
                        dropdown.appendChild(option);
                        // dropdown2.appendChild(option);
                        dropdown2.appendChild(option.cloneNode(true));
                    });


                    // Restore old value (if exists)
                    const oldCountry = "{{ old('country') }}";
                    if (oldCountry) {
                        dropdown.value = oldCountry;
                    }

                    const userCountry =
                        "{{ Auth::guard('job_seekers')->check() ? Auth::guard('job_seekers')->user()->country : '' }}";
                    if (userCountry) {
                        dropdown2.value = userCountry;
                    }
                }

                // Populate the dropdown
                populateCountry();
            })
            .catch((error) => {
                console.error("Error fetching country data:", error);
                // Display an error message if fetching fails
                const dropdown = document.getElementById('registerCountry');
                dropdown.innerHTML =
                    `<option selected>Failed to load countries. Please try again later.</option>`;
            });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Login Modal
        const emailBtnLogin = document.getElementById("email-btn");
        const phoneBtnLogin = document.getElementById("phone-btn");
        const emailFormLogin = document.getElementById("email-form");
        const phoneFormLogin = document.getElementById("phone-form");
        const emailOrPhoneInputLogin = document.getElementById("email_or_phone_login");

        // Register Modal
        const emailBtnRegister = document.getElementById("email-btn-register");
        const phoneBtnRegister = document.getElementById("phone-btn-register");
        const emailContainerRegister = document.getElementById("email-container");
        const phoneContainerRegister = document.getElementById("phone-container");
        const emailOrPhoneInputRegister = document.getElementById("email_or_phone_register");

        // Set default value to "email"
        emailOrPhoneInputLogin.value = "email";
        emailOrPhoneInputRegister.value = "email";

        // Function to toggle between email and phone for Login Modal
        function toggleLoginForm(isEmail) {
            if (isEmail) {
                emailFormLogin.classList.remove("d-none");
                phoneFormLogin.classList.add("d-none");
                emailBtnLogin.classList.add("active");
                phoneBtnLogin.classList.remove("active");
                emailOrPhoneInputLogin.value = "email";
            } else {
                phoneFormLogin.classList.remove("d-none");
                emailFormLogin.classList.add("d-none");
                phoneBtnLogin.classList.add("active");
                emailBtnLogin.classList.remove("active");
                emailOrPhoneInputLogin.value = "phone";
            }
        }

        // Function to toggle between email and phone for Register Modal
        function toggleRegisterForm(isEmail) {
            if (isEmail) {
                emailContainerRegister.style.display = "block";
                phoneContainerRegister.style.display = "none";
                emailBtnRegister.classList.add("active");
                phoneBtnRegister.classList.remove("active");
                emailOrPhoneInputRegister.value = "email";
            } else {
                phoneContainerRegister.style.display = "block";
                emailContainerRegister.style.display = "none";
                phoneBtnRegister.classList.add("active");
                emailBtnRegister.classList.remove("active");
                emailOrPhoneInputRegister.value = "phone";
            }
        }

        // Event Listeners for Login Modal
        emailBtnLogin.addEventListener("click", function() {
            toggleLoginForm(true);
            console.log("Login - email_or_phone:", emailOrPhoneInputLogin.value);
        });

        phoneBtnLogin.addEventListener("click", function() {
            toggleLoginForm(false);
            console.log("Login - email_or_phone:", emailOrPhoneInputLogin.value);
        });

        // Event Listeners for Register Modal
        emailBtnRegister.addEventListener("click", function() {
            toggleRegisterForm(true);
            console.log("Register - email_or_phone:", emailOrPhoneInputRegister.value);
        });

        phoneBtnRegister.addEventListener("click", function() {
            toggleRegisterForm(false);
            console.log("Register - email_or_phone:", emailOrPhoneInputRegister.value);
        });

        // Prevent form submission if email_or_phone is not set
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            if (!emailOrPhoneInputLogin.value) {
                alert("Please select Email or Phone.");
                event.preventDefault();
            }
        });

        document.getElementById("registerForm").addEventListener("submit", function(event) {
            if (!emailOrPhoneInputRegister.value) {
                alert("Please select Email or Phone.");
                event.preventDefault();
            }
        });

        // Password visibility toggle (for both modals)
        function togglePasswordVisibility(inputId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(`${inputId}-eye-icon`);
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }

        // Attach password toggle functionality to both modals
        document.querySelectorAll(".toggle-password").forEach((element) => {
            element.addEventListener("click", function() {
                const inputId = this.getAttribute("data-target");
                togglePasswordVisibility(inputId);
            });
        });
    });
</script>