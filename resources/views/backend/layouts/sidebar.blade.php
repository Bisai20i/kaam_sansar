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

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('superadmin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Industry Categories -->
        <li class="menu-item {{ request()->routeIs('industryCategory*') ? 'active' : '' }}">
            <a href="{{ route('industryCategory.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Manage Industry Categories">Manage Industry Categories</div>
            </a>
        </li>

        <!-- Job Categories -->
        <li class="menu-item {{ request()->routeIs('jobCategory*') ? 'active' : '' }}">
            <a href="{{ route('jobCategory.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layer"></i>
                <div data-i18n="Manage Job Categories">Manage Job Categories</div>
            </a>
        </li>

        <!-- Job Companies -->
        <li class="menu-item {{ request()->routeIs('jobCompany*') ? 'active' : '' }}">
            <a href="{{ route('jobCompany.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-buildings"></i>
                <div data-i18n="Manage Job Companies">Manage Job Companies</div>
            </a>
        </li>

        <!-- Users -->
        <li class="menu-item">
            <a href="{{ route('superadmin.details') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Manage Users">Manage Users</div>
            </a>
        </li>

        <!-- Job Posts -->
        <li class="menu-item {{ request()->routeIs('jobPost*') ? 'active' : '' }}">
            <a href="{{ route('jobPost.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Manage Job Posts">Manage Job Posts</div>
            </a>
        </li>

        <!-- Advertisement Category -->
        <li class="menu-item {{ request()->routeIs('advertisementcategory*') ? 'active' : '' }}">
            <a href="{{ route('advertisementcategory.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-square"></i>
                <div data-i18n="Manage Ads">Manage Ads Category</div>
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
                <i class="menu-icon tf-icons bx bx-rectangle"></i>
                <div data-i18n="Manage Resume">Manage Resume</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('ads-manager*') ? 'active' : '' }}">
            <a href="{{ route('ads-manager.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-rectangle"></i>
                <div data-i18n="Ads Manager">Ads Manager</div>
            </a>
        </li>
        
        <!-- Aboard Deals -->
        <li class="menu-item {{ request()->routeIs('aboards*')|| request()->routeIs('productcategory*') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cart "></i>
                <div data-i18n="Manage Product">Manage Aboards Deals</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('aboards*') ? 'active' : '' }}">
                    <a href="#" class="menu-link">
                        <div data-i18n="Landing">Manage Aboard Product</div>
                    </a>
                    {{-- <a href="{{ route('aboards.index') }}" class="menu-link">
                        <div data-i18n="Landing">Manage Aboard Product</div>
                    </a> --}}
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
            <i class="menu-icon tf-icons bx bx-star"></i>
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
        {{-- <li class="menu-item ">
            <a href="{{ route('giftNcoupon.list') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div data-i18n="Manage Blogs and Podcasts">Manage Gift and Coupons</div>
            </a>
        </li> --}}

        <!-- Blogs and Podcasts -->
        <li class="menu-item {{ request()->routeIs('blogsAndPodcast*') ? 'active' : '' }}">
            <a href="{{ route('blogsAndPodcast.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div data-i18n="Manage Blogs and Podcasts">Manage Blogs and Podcasts</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('horoscope*') ? 'active' :'' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
    <i class="menu-icon tf-icons bx bx-star"></i>
    <div data-i18n="Manage Horoscope">Manage Horoscope  & Kundali</div>
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
   
</li>

        <!-- Manage VISA HQ -->
        <li class="menu-item {{ request()->routeIs('visaCountryList*') || request()->routeIs('VisaTypeList*') ? 'open' : '' }}">
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
    </ul>
    

</aside>
