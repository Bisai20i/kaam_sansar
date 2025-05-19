<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <div class="app-brand-logo demo">
                <img src="{{ asset('/logo.png') }}" alt="Logo" width="200" height="auto">
            </div>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-2">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('superadmin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Industry Categories -->
        <li class="menu-item 
            {{ request()->routeIs('industryCategory*') || 
            request()->routeIs('jobCategory*') || 
            request()->routeIs('jobCompany*') || 
            request()->routeIs('jobPost*') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-briefcase-alt"></i>
                <div data-i18n="Manage Job">Manage Job</div>
            </a>
            <ul class="menu-sub">
                <!-- Industry Categories -->
                <li class="menu-item {{ request()->routeIs('industryCategory*') ? 'active' : '' }}">
                    <a href="{{ route('industryCategory.index') }}" class="menu-link">
                        <div data-i18n="Industry Categories">Manage Industry Categories</div>
                    </a>
                </li>

                <!-- Job Categories -->
                <li class="menu-item {{ request()->routeIs('jobCategory*') ? 'active' : '' }}">
                    <a href="{{ route('jobCategory.index') }}" class="menu-link">
                        <div data-i18n="Job Categories">Manage Job Categories</div>
                    </a>
                </li>

                <!-- Job Companies -->
                <li class="menu-item {{ request()->routeIs('jobCompany*') ? 'active' : '' }}">
                    <a href="{{ route('jobCompany.index') }}" class="menu-link">
                        <div data-i18n="Job Companies">Manage Job Companies</div>
                    </a>
                </li>

                <!-- Job Posts -->
                <li class="menu-item {{ request()->routeIs('jobPost*') ? 'active' : '' }}">
                    <a href="{{ route('jobPost.index') }}" class="menu-link">
                        <div data-i18n="Job Posts">Manage Job Posts</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Advertisement Management -->
        <li class="menu-item 
            {{ request()->routeIs('advertisementcategory*') || request()->routeIs('ads-manager*') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-bullseye"></i>
                <div data-i18n="Manage Ads">Manage Ads</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('advertisementcategory*') ? 'active' : '' }}">
                    <a href="{{ route('advertisementcategory.index') }}" class="menu-link">
                        <div data-i18n="Ads Category">Manage Ads Category</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('ads-manager*') ? 'active' : '' }}">
                    <a href="{{ route('ads-manager.index') }}" class="menu-link">
                        <div data-i18n="Ads Manager">Ads Manager</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Users -->

        <li class="menu-item 
            {{ request()->routeIs('bankAccounts*') || 
            request()->routeIs('brokerAccounts*') || 
            request()->routeIs('documentAttestations*') || 
            request()->routeIs('superadmin.becomeseller.index') || 
            request()->routeIs('forex*') || 
            request()->routeIs('forum-posts*') ? 'open' : '' }}">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-menu-alt-right"></i>
                <div data-i18n="Additional Management">Activity List</div>
            </a>

            <ul class="menu-sub">
                <!-- Bank Accounts -->
                <li class="menu-item {{ request()->routeIs('bankAccounts*') ? 'active' : '' }}">
                    <a href="{{ route('bankAccounts.index') }}" class="menu-link">
                        <div data-i18n="Bank Accounts">Manage Bank Account</div>
                    </a>
                </li>

                <!-- Broker Accounts -->
                <li class="menu-item {{ request()->routeIs('brokerAccounts*') ? 'active' : '' }}">
                    <a href="{{ route('brokerAccounts.index') }}" class="menu-link">
                        <div data-i18n="Broker Accounts">Manage Broker Account</div>
                    </a>
                </li>

                <!-- Document Attestations -->
                <li class="menu-item {{ request()->routeIs('documentAttestations*') ? 'active' : '' }}">
                    <a href="{{ route('documentAttestations.index') }}" class="menu-link">
                        <div data-i18n="Document Attestations">Manage Document Attestations</div>
                    </a>
                </li>

                <!-- Become Seller -->
                <li class="menu-item {{ request()->routeIs('superadmin.becomeseller.index') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.becomeseller.index') }}" class="menu-link">
                        <div data-i18n="Become Seller">Become Seller</div>
                    </a>
                </li>

                <!-- Forex -->
                <li class="menu-item {{ request()->routeIs('forex*') ? 'active' : '' }}">
                    <a href="{{ route('forex.index') }}" class="menu-link">
                        <div data-i18n="Forex">Manage Forex Exchanges</div>
                    </a>
                </li>

                <!-- Discussion Forum -->
                <li class="menu-item {{ request()->routeIs('forum-posts*') ? 'active' : '' }}">
                    <a href="{{ route('forum.index') }}" class="menu-link">
                        <div data-i18n="Discussion Forum">Discussion Forum</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Aboard Deals -->
        <li
            class="menu-item {{ request()->routeIs('aboards*') || request()->routeIs('productcategory*') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cart "></i>
                <div data-i18n="Manage Product">Manage Aboards Deals</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('aboards*') ? 'active' : '' }}">
                    <a href="#" class="menu-link">
                        <div data-i18n="Landing">Manage Aboard Product</div>
                    </a>
                </li>
            </ul>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('productcategory*') ? 'active' : '' }}">
                    <a href="{{ route('productcategory.index') }}" class="menu-link">
                        <div data-i18n="Product">Manage Product Category</div>
                    </a>
                </li>
            </ul>
        </li>

        <!--Manage Gift and Coupon-->
        <li class="menu-item {{ request()->routeIs('giftNcoupon*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-gift"></i>
                <div data-i18n="Manage Horoscope">Manage Gift and Coupons</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('giftNcouponCategory*') ? 'active' : '' }}">
                    <a href="{{ route('giftNcouponCategory.index') }}" class="menu-link">
                        <div data-i18n="Horoscope">Manage Categories</div>
                    </a>
                </li>
            </ul>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('giftNcoupon.index') ? 'active' : '' }}">
                    <a href="{{ route('giftNcoupon.index') }}" class="menu-link">
                        <div data-i18n="Kundali">Manage Gift and Coupon</div>
                    </a>
                </li>
            </ul>

        </li>
        <li class="menu-item {{ request()->routeIs('horoscope*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-star"></i>
                <div data-i18n="Manage Horoscope">Manage Horoscope & Kundali</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('horoscope*') ? 'active' : '' }}">
                    <a href="{{ route('horoscope.index') }}" class="menu-link">
                        <div data-i18n="Horoscope">Manage Horoscopes</div>
                    </a>
                </li>
            </ul>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('kundalidetail*') ? 'active' : '' }}">
                    <a href="{{ route('kundalidetail.index') }}" class="menu-link">
                        <div data-i18n="Kundali">Manage Kundali</div>
                    </a>
                </li>
            </ul>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('kundalimatching*') ? 'active' : '' }}">
                    <a href="{{ route('kundalimatching.index') }}" class="menu-link">
                        <div data-i18n="KundaliMatching">Kundali Matching</div>
                    </a>
                </li>
            </ul>

        </li>


        <!-- Manage VISA HQ -->
        <li
            class="menu-item {{ request()->routeIs('visaCountryList*') || request()->routeIs('VisaTypeList*') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-store"></i>
                <div data-i18n="Front Pages">Manage VISA HQ</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('visaCountryList*') ? 'active' : '' }}">
                    <a href="{{ route('visaCountryList.index') }}" class="menu-link">
                        <div data-i18n="Landing">Manage Visa Countries</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('VisaTypeList*') ? 'active' : '' }}">
                    <a href="{{ route('VisaTypeList.index') }}" class="menu-link">
                        <div data-i18n="Pricing">Manage Visa Type</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('visadetails*') ? 'active' : '' }}">
                    <a href="{{ route('visadetails.index') }}" class="menu-link">
                        <div data-i18n="Pricing">Manage Visa <br>Requirements</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('visadetails*') ? 'active' : '' }}">
                    <a href="{{ route('visadetails.index') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Pricing">Manage Visa <br> Application </div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ request()->routeIs('forum-posts*') ? 'active' : '' }}">
            <a href="{{ route('forum.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-conversation'></i>
                <div data-i18n="Ads Manager">Discussion Forum</div>
            </a>
        </li>



        <!-- Reward -->
        <li class="menu-item">
            <a href="{{ route('rewards.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-gift"></i> {{-- You can change the icon --}}
                <div data-i18n="Rewards">Rewards</div>
            </a>
        </li>


        <!--becomeSeller -->
        <li class="menu-item">
            <a href="{{ route('superadmin.becomeseller.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-plus"></i> {{-- Arrow-like icon --}}
                <div data-i18n="Become Seller">Become Seller</div>
            </a>
        </li>


        <!----quiz---->
        <li class="menu-item">
            <a href="{{ route('questions.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-question-mark"></i> {{-- Arrow-like icon --}}
                <div data-i18n="Quiz">Quiz</div>
            </a>
        </li>






        <!-- Manage Insurance-->

        <li class="menu-item {{ request()->routeIs('insurance*') ? 'active' : '' }}">
            <a href="{{ route('insurance.company') }}" class="menu-link">

                <i class="menu-icon tf-icons bx bx-heart"></i>
                <div data-i18n="Insurance">Insurance Company</div>
            </a>
        </li>

        <li class="menu-item {{ request()->routeIs('passport*') ? 'active' : '' }}">
            <a href="{{ route('passport.renewal') }}" class="menu-link">

                <i class="menu-icon tf-icons bx bx-credit-card-front"></i>
                <div data-i18n="Passport Renewal">Passport Renewal</div>
            </a>
        </li>

        <!-- Manage Forex Exchanges -->
        <li class="menu-item {{ request()->routeIs('forex*') ? 'active' : '' }}">
            <a href="{{ route('forex.index') }}" class="menu-link">

                <i class="menu-icon tf-icons bx bx-money"></i>
                <div data-i18n="Manage Forex Exchanges">Manage Forex Exchanges</div>
            </a>
        </li>

        <!-- Manage Workk Pemrit -->
        <li
            class="menu-item {{ request()->routeIs('workPermits*') || request()->routeIs('workPermitDistricts*') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-store"></i>
                <div data-i18n="Front Pages">Manage Work Permit</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('workPermitDistricts*') ? 'active' : '' }}">
                    <a href="{{ route('workPermitDistricts.index') }}" class="menu-link">
                        <div data-i18n="Landing">Manage Work Permit Districts</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('workPermitLocations*') ? 'active' : '' }}">
                    <a href="{{ route('workPermitLocations.index') }}" class="menu-link">
                        <div data-i18n="Pricing">Manage Work Pemrit Location</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('workPermits*') ? 'active' : '' }}">
                    <a href="{{ route('workPermits.index') }}" class="menu-link">
                        <div data-i18n="Pricing">Manage Work Pemrit </div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Manage Poll System-->
        <li
            class="menu-item {{ request()->routeIs('polls*') || request()->routeIs('workPermitDistricts*') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-store"></i>
                <div data-i18n="Front Pages">Manage Polling System</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('pollingQestions*') ? 'active' : '' }}">
                    <a href="{{ route('pollingQuestions.index') }}" class="menu-link">
                        <div data-i18n="Landing">Manage Questions</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('answers*') ? 'active' : '' }}">
                    <a href="{{ route('pollingAnswers.index') }}" class="menu-link">
                        <div data-i18n="Pricing">Manage Answer</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('polls*') ? 'active' : '' }}">
                    <a href="{{ route('polls.index') }}" class="menu-link">
                        <div data-i18n="Pricing">Manage Poll</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item 
            {{ request()->routeIs('rewards*') || 
            request()->routeIs('faqs*') || 
            request()->routeIs('blogsAndPodcast*') ? 'open' : '' }}">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-bulb"></i>
                <div data-i18n="User Engagement">User Engagement</div>
            </a>

            <ul class="menu-sub">
                <!-- Rewards -->
                <li class="menu-item {{ request()->routeIs('rewards*') ? 'active' : '' }}">
                    <a href="{{ route('rewards.index') }}" class="menu-link">
                        <div data-i18n="Rewards">Manage Rewards</div>
                    </a>
                </li>

                <!-- FAQs -->
                <li class="menu-item {{ request()->routeIs('faqs*') ? 'active' : '' }}">
                    <a href="{{ route('faqs.index') }}" class="menu-link">
                        <div data-i18n="FAQs">Manage FAQs</div>
                    </a>
                </li>

                <!-- Blogs and Podcasts -->
                <li class="menu-item {{ request()->routeIs('blogsAndPodcast*') ? 'active' : '' }}">
                    <a href="{{ route('blogsAndPodcast.index') }}" class="menu-link">
                        <div data-i18n="Blogs and Podcasts">Manage Blogs and Podcasts</div>
                    </a>
                </li>
            </ul>
        </li>


        <!-- Manage Insurance-->

        <li class="menu-item {{ request()->routeIs('insurance*') ? 'active' : '' }}">
            <a href="{{ route('insurance.company') }}" class="menu-link">

                <i class="menu-icon tf-icons bx bx-heart"></i>
                <div data-i18n="Insurance">Insurance Company</div>
            </a>
        </li>

        <li class="menu-item {{ request()->routeIs('passport*') ? 'active' : '' }}">
            <a href="{{ route('passport.renewal') }}" class="menu-link">

                <i class="menu-icon tf-icons bx bx-credit-card-front"></i>
                <div data-i18n="Passport Renewal">Passport Renewal</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{ route('superadmin.details') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Manage Users">Manage Users</div>
            </a>
        </li>

        <!-- Advertisements -->
        {{-- <li class="menu-item {{ request()->routeIs('ads*') ? 'active' : '' }}">
        <a href="{{ route('ads.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-rectangle"></i>
            <div data-i18n="Manage Ads">Manage Ads</div>
        </a>
        </li> --}}

        <li class="menu-item {{ request()->routeIs('resume-help*') ? 'active' : '' }}">
            <a href="{{ route('resume-help.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Manage Resume">Manage Resume</div>
            </a>
        </li>

    </ul>
</aside>