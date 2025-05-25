@extends('frontend.layouts.main')
@section('title', 'My Profile')
@section('content')
<div class="container mt-4 py-5">
    <div class="card-basic border">
        <h5 class="text-start m-2">Your Profile</h5>
    </div>
    <style>
        /* Profile */

        .active-profile {
            background-color: #f8f9fa;
            color: #0064A7 !important;
            font-weight: 500;
        }
    </style>
    <div class="row g-0">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('jobseeker.getProfile', ['user_id' => auth()->id()]) }}" data-section="basicInfo"
                    class="list-group-item list-group-item-action profile-link {{ request()->routeIs('jobseeker.getProfile') ? 'active-profile' : '' }}">Basic
                    Information</a>
                <a href="{{ route('jobseeker.getCV', ['user_id' => auth()->id()]) }}" data-section="yourCV"
                    class="list-group-item list-group-item-action profile-link {{ request()->routeIs('jobseeker.getCV') ? 'active-profile' : '' }}">Your
                    CV</a>
                <a href="{{ route('jobseeker.getPurchaseHistory', ['user_id' => auth()->id()]) }}"
                    data-section="purchaseHistory"
                    class="list-group-item list-group-item-action profile-link {{ request()->routeIs('jobseeker.getPurchaseHistory') ? 'active-profile' : '' }}">Purchase
                    History</a>
                <a href="{{ route('jobseeker.editProfile', ['user_id' => auth()->id()]) }}" data-section="editProfile"
                    class="list-group-item list-group-item-action profile-link {{ request()->routeIs('jobseeker.editProfile') ? 'active-profile' : '' }}">Edit
                    Profile</a>
                <a href="{{ route('jobseeker.myjobs', ['user_id' => auth()->id()]) }}" data-section="myJobs"
                    class="list-group-item list-group-item-action profile-link {{ request()->routeIs('jobseeker.myjobs') ? 'active-profile' : '' }}">My
                    Jobs</a>
                <a href="{{ route('jobseeker.getAdvertisements', ['user_id' => auth()->id()]) }}" data-section="myJobs"
                    class="list-group-item list-group-item-action profile-link {{ request()->routeIs('jobseeker.getAdvertisements') ? 'active-profile' : '' }}">My
                    Advertisement</a>
                <a href="{{ route('jobseeker.getAbroadDeals') }}" data-section="myJobs"
                    class="list-group-item list-group-item-action profile-link {{ request()->routeIs('jobseeker.getAbroadDeals') ? 'active-profile' : '' }}">My
                    Abroad Deals</a>
                <a href="{{ route('jobseeker.mypodcasts', ['user_id' => auth()->id()]) }}"
                    data-section="myPodcasts"
                    class="list-group-item list-group-item-action profile-link {{ request()->routeIs('jobseeker.mypodcasts') ? 'active-profile' : '' }}">
                    My Podcasts
                </a>
                <a href="{{ route('jobseeker.myblogs', ['user_id' => auth()->id()]) }}"
                    data-section="myBlogs"
                    class="list-group-item list-group-item-action profile-link {{ request()->routeIs('jobseeker.myblogs') ? 'active-profile' : '' }}">
                    My Articles
                </a>


            </div>
        </div>


        <!-- Content Area -->
        <div class="col-md-9">
            <div id="profileContent" class="content-section">
                @yield('profileSection')
                <!-- Content will be loaded here via AJAX -->
            </div>
        </div>
    </div>
</div>

<!-- Add this before closing body tag -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to get the base URL of your application
            function getBaseUrl() {
                return window.location.protocol + "//" + window.location.host;
            }

            // Function to get section route
            function getSectionRoute(section) {
                const baseUrl = getBaseUrl();
                const routeMap = {
                    'basicInfo': '/jobseeker/profile/basic-info',
                    'yourCV': '/jobseeker/profile/your-cv',
                    'purchaseHistory': '/jobseeker/profile/purchase-history',
                    'editProfile': '/jobseeker/profile/edit-profile',
                    'myJobs': '/jobseeker/profile/my-jobs'
                };
                return baseUrl + routeMap[section];
            }

            // Function to load content
            function loadContent(section) {
                console.log('Loading section:', section);
                $.ajax({
                    url: getSectionRoute(section),
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('#profileContent').html(
                            '<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</div>'
                        );
                    },

                    success: function(response) {
                        $('#profileContent').html(response)
                            .show(); // Inject the HTML response into the div
                        console.log('Response:', response);
                        initializePhoneInputs(); // Call function to reinitialize events
                        $('.profile-link').removeClass(
                            'active-profile'); // Remove active class from all links
                        $(`[data-section="${section}"]`).addClass(
                            'active-profile'); // Add active class to the clicked link
                        localStorage.setItem('activeProfileSection',
                            section); // Save the active section


                        console.log('Content loaded successfully');
                    },
                    error: function(xhr, status, error) {
                        console.error('Ajax error:', error);
                        if (xhr.status === 401) {
                            // Redirect to login page if unauthorized
                            window.location.href = getBaseUrl() + '/login';
                        } else {
                            $('#profileContent').html(
                                '<div class="alert alert-danger">' +
                                'Error loading content. Please try again later.' +
                                '</div>'
                            );
                        }
                    }
                });
            }

            // Handle link clicks
            $('.profile-link').click(function(e) {
                e.preventDefault();
                const section = $(this).data('section');
                loadContent(section);
            });

            // Load saved section or default to basicInfo
            const savedSection = localStorage.getItem('activeProfileSection') || 'basicInfo';
            loadContent(savedSection);
        });
    </script> --}}
@endsection