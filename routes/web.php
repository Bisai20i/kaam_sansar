<?php

use App\Http\Controllers\UserCommentController;
use App\Models\IndustryCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AboardController;
use App\Http\Controllers\AdsManagerController;
use App\Http\Controllers\OrderPlacementController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\GiftCouponController;
use App\Http\Controllers\KundaliController;
use App\Http\Controllers\GiftCartController;
use App\Http\Controllers\JobApplyController;
use App\Http\Controllers\VisaTypeController;
use App\Http\Controllers\HoroscopeController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\AstrologerController;
use App\Http\Controllers\JobCompanyController;
use App\Http\Controllers\MyDocumentController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\VisaDetailsController;
use App\Http\Controllers\GiftCategoryController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\BlogsAndPodcastController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\VisaApplicationController;
use App\Http\Controllers\VisaCountryListController;
use App\Http\Controllers\IndustryCategoryController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\JobSeekerDashboardController;
use App\Http\COntrollers\Frontend\FrontendAPIController;
use App\Http\Controllers\AdvertisementCategoryController;
use App\Http\Controllers\DiscussionForumController;
use App\Http\Controllers\PassportRenewalController;
use App\Http\Controllers\ResumeHelpController;
use App\Http\Controllers\MessageController;


// Authentication Routes
Route::get('master/login', [AdminController::class, 'loginView'])->name('login');
Route::post('login/store', [AdminController::class, 'login'])->name('login_store');

Route::post('logout', [AdminController::class, 'logout'])->name('logout')->middleware('auth:admin');


// Resource Route

// Route::resource('industryCategory', IndustryCategoryController::class);
// Route::resource('jobApply', JobApplyController::class);
// Route::resource('jobCategory', JobCategoryController::class);
// Route::resource('jobCompany', JobCompanyController::class);
Route::resource('admin', AdminController::class)->except('store', 'edit', 'update')->middleware('role:superAdmin');

Route::middleware(['role:admin'])->prefix('adminuser')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('adminuser.dashboard');
});

Route::middleware(['auth:admin', 'role:superAdmin'])->prefix('superadmin')->group(function () {

    Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
    // Route::post('/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/{id}/edit', [AdminController::class, 'editadmin'])->name('admin.edit');
    Route::put('/update/{id}', [AdminController::class, 'updateadmin'])->name('admin.update');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('superadmin.dashboard');
    Route::get('/details', [AdminController::class, 'superadminindex'])->name('superadmin.details');
    Route::resource('industryCategory', IndustryCategoryController::class);
    Route::resource('jobCategory', JobCategoryController::class);
    Route::put('/jobCategory/publish/{id}', [JobCategoryController::class, 'publish'])->name('jobCategory.publish');
    Route::put('/jobCategory/unpublish/{id}', [JobCategoryController::class, 'unpublish'])->name('jobCategory.unpublish');
    Route::get('/industries', [IndustryCategoryController::class, 'getIndustries'])->name('fetchIndustries');
    Route::resource('jobCompany', JobCompanyController::class);
    Route::post('/links/delete', [JobCompanyController::class, 'delete_link'])->name('links.delete');
    Route::resource('jobPost', JobPostController::class)->except('store');

    Route::resource('/blogsAndPodcast', BlogsAndPodcastController::class);
    Route::put('blogsAndPodcast/publish/{id}', [BlogsAndPodcastController::class, 'publish'])->name('blogsAndPodcast.publish');
    Route::put('blogsAndPodcast/unpublish/{id}', [BlogsAndPodcastController::class, 'unpublish'])->name('blogsAndPodcast.unpublish');
    // Route::resource('jobSeeker', JobSeekerController::class);
    Route::get('postcreate/{id?}', [JobPostController::class, 'createOrEdit'])->name('jobPost.postcreate');
    Route::post('postcreate/store', [JobPostController::class, 'store'])->name('jobpost.store');
    Route::put('/job-post/publish/{id}', [JobPostController::class, 'publish'])->name('job-post.publish');
    Route::put('/job-post/unpublish/{id}', [JobPostController::class, 'unpublish'])->name('job-post.unpublish');

    //Route for advertisement
    Route::resource('ads', AdvertisementController::class);


    Route::resource('advertisementcategory', AdvertisementCategoryController::class);
    Route::put('/ads/publish/{id}', [AdvertisementController::class, 'publish'])->name('ads.publish');
    Route::put('/ads/unpublish/{id}', [AdvertisementController::class, 'unpublish'])->name('ads.unpublish');


    // Route for aboard deals
    // Route for aboard deals
    Route::resource('aboards', AboardController::class);
    Route::put('aboards/{id}/publish', [AboardController::class, 'publish'])->name('aboards.publish');
    Route::put('aboards/{id}/unpublish', [AboardController::class, 'unpublish'])->name('aboards.unpublish');



    Route::resource('productcategory', ProductCategoryController::class);








    // route for resume help
    Route::resource('resume-help', ResumeHelpController::class);


    // route for ads_manager


    Route::resource('ads-manager', AdsManagerController::class);

    // gift and coupon
    Route::resource('giftNcouponCategory', GiftCategoryController::class);
    Route::patch('/giftNcouponCategory/publish/{id}', [GiftCategoryController::class, 'publish'])->name('giftNcouponCategory.publish');
    Route::patch('/giftNcouponCategory/unpublish/{id}', [GiftCategoryController::class, 'unpublish'])->name('giftNcouponCategory.unpublish');

    Route::resource('giftNcoupon', GiftCouponController::class);
    Route::put('/giftNcoupon/publish/{id}', [GiftCouponController::class, 'publish'])->name('giftNcoupon.publish');
    Route::put('/giftNcoupon/unpublish/{id}', [GiftCouponController::class, 'unpublish'])->name('giftNcoupon.unpublish');
    // Route::get('/giftandcoupon/create', [GiftCouponController::class, 'create'])->name('giftNcoupon.create');
    // Route::get('/giftandcoupon/edit', [GiftCouponController::class, 'edit'])->name('giftNcoupon.edit');
    // Route::get('/giftandcoupon/list', [GiftCouponController::class, 'list'])->name('giftNcoupon.list');
    // Route::get('giftandcoupon/categories', [GiftCategoryController::class, 'index'])->name('giftNcoupon.categories');

    //Route for horoscope
    Route::resource('horoscope', HoroscopeController::class);

    //Route for kundali
    Route::resource('kundalidetail', KundaliController::class);
    //Route fro astrolger
    Route::resource('astrologer', AstrologerController::class);


    Route::resource('visaCountryList', VisaCountryListController::class);
    Route::put('/visaCountryList/publish/{id}', [VisaCountryListController::class, 'publish'])->name('visaCountryList.publish');
    Route::put('/visaCountryList/unpublish/{id}', [VisaCountryListController::class, 'unpublish'])->name('visaCountryList.unpublish');
    Route::resource('VisaTypeList', VisaTypeController::class);
    Route::put('/VisaTypeList/publish/{id}', [VisaTypeController::class, 'publish'])->name('VisaTypeList.publish');
    Route::put('/VisaTypeList/unpublish/{id}', [VisaTypeController::class, 'unpublish'])->name('VisaTypeList.unpublish');
    Route::resource('visadetails', VisaDetailsController::class);
    Route::put('/visadetails/publish/{id}', [VisaDetailsController::class, 'publish'])->name('visadetails.publish');
    Route::put('/visadetails/unpublish/{id}', [VisaDetailsController::class, 'unpublish'])->name('visadetails.unpublish');
    Route::get('/fetch-visa-types', [VisaDetailsController::class, 'fetchVisaTypes'])->name('fetch.visa.types');
    Route::get('/fetch-visa-countries', [VisaDetailsController::class, 'fetchVisaCountries'])->name('fetch.visa.countries');
});

Route::middleware(['role:postAdmin,superAdmin'])->prefix('postadmin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('postadmin.dashboard');
    // Route::get('/details', [AdminController::class, 'superadminindex'])->name('superadmin.details');
});
// Route::fallback(function () {
//     return redirect('/admin');
// });
Route::prefix('jobseeker')->group(function () {
    Route::get('/verify-phone', [JobSeekerController::class, 'verifyPhonePage'])->name('jobseeker.verify-phone-page');
    Route::post('verify-phone', [JobSeekerController::class, 'verifyPhone'])->name('jobseeker.verify-phone');
    Route::get('/verify-otp', [JobSeekerController::class, 'otp_page'])->name('jobseeker.verify-otp-page');
    Route::post('verify-otp', [JobSeekerController::class, 'verifyOtp'])->name('jobseeker.verify-otp');
    Route::get('/reset-password', [JobSeekerController::class, 'resetPasswordPage'])->name('jobseeker.password_reset_page');
    Route::patch('reset-password', [JobSeekerController::class, 'resetPassword'])->name('jobseeker.password-reset');
    Route::post('/register', [JobSeekerController::class, 'register'])->name('jobseeker.register');
    Route::post('/login', [JobSeekerController::class, 'login'])->name('jobseeker.login');
    Route::post('/login', [JobSeekerController::class, 'login'])->name('jobseeker.login');
});

Route::post('/clear-session-flag', [JobSeekerController::class, 'clearSessionFlag'])->name('clear.session.flag');


Route::middleware(['auth:job_seekers'])->prefix('jobseeker')->group(function () {

    // abroad deals posting route
    Route::post('abroad_deal_post', [AboardController::class, 'store'])->name('abroad_deal.store');



    Route::post('logout', [JobSeekerController::class, 'logout'])->name('jobseeker.logout');
    Route::get('/otp_page', [JobSeekerController::class, 'otp_page'])->name('jobseeker.otp_page');
    Route::post('otp_verify', [JobSeekerController::class, 'otpVerify'])->name('jobseeker.otp_verify');
    Route::post('resend-otp', [JobSeekerController::class, 'resendOtp'])->name('jobseeker.resend-otp');
    Route::patch('update-password', [JobSeekerController::class, 'updatePassword'])->name('jobseeker.update-password');
    Route::get('change-password', [JobSeekerController::class, 'changePassword'])->name('jobseeker.change-password');
    Route::patch('deactivate', [JobSeekerController::class, 'deactivate']);
    Route::patch('delete', [JobSeekerController::class, 'delete']);
    Route::get('getProfile/{user_id?}', [JobSeekerController::class, 'getProfile'])->name('jobseeker.getProfile');
    Route::get('getAbroadDeals/{user_id?}', [JobSeekerController::class, 'getAbroadDeals'])->name('jobseeker.getAbroadDeals');
    Route::get('getAdvertisements/{user_id?}', [JobSeekerController::class, 'getAdvertisements'])->name('jobseeker.getAdvertisements');
    Route::get('getCV/{user_id?}', [JobSeekerController::class, 'getCV'])->name('jobseeker.getCV');
    Route::get('editProfile/{user_id?}', [JobSeekerController::class, 'editProfile'])->name('jobseeker.editProfile');
    Route::get('/setProfile/{index}', [JobSeekerController::class, 'setProfile'])->name('jobseeker.setProfile');
    Route::get('/deleteImage/{index}', [JobSeekerController::class, 'deleteImage'])->name('jobseeker.deleteImage');
    Route::get('getPurchaseHistory/{user_id?}', [JobSeekerController::class, 'getPurchaseHistory'])->name('jobseeker.getPurchaseHistory');
    Route::get('/myjobs/{user_id?}', [JobSeekerController::class, 'myjobs'])->name('jobseeker.myjobs');
    Route::get('/bookmark/remove/{jobId}', [JobSeekerController::class, 'removeBookmark'])->name('jobBookmark.remove');
    // Route::put('updateProfile/{user_id}', [JobSeekerController::class, 'updateProfile']);

    // Route::get('/profile/basic-info', [JobSeekerDashboardController::class, 'basicInfo'])->name('profile.basicInfo');
    // Route::get('/profile/your-cv', [JobSeekerDashboardController::class, 'yourCV'])->name('profile.yourCV');
    // Route::get('/profile/purchase-history', [JobSeekerDashboardController::class, 'purchaseHistory'])->name('profile.purchaseHistory');
    // Route::get('/profile/edit-profile', [JobSeekerDashboardController::class, 'editProfile'])->name('profile.editProfile');
    // Route::get('/profile/my-jobs', [JobSeekerDashboardController::class, 'myJobs'])->name('profile.myJobs');
    Route::prefix('order')->group(function () {
        Route::post('/place', [OrderPlacementController::class, 'placeOrder'])->name('order.place');
    });

    //Messages Related routes

    Route::post('/send-message', [MessageController::class, 'sendMessage']);
    Route::get('/user-inbox', [MessageController::class, 'user_inbox'])->name('jobseeker.inbox');
    Route::post('/sender-messages', [MessageController::class, 'sender_messages']);
    Route::get('/search-user', [MessageController::class, 'search_user'])->name('jobseeker.search');

    Route::prefix('profile')->middleware(['auth'])->group(function () {
        Route::get('/basic-info', [JobSeekerDashboardController::class, 'basicInfo'])->name('profile.basicInfo');
        Route::get('/your-cv', [JobSeekerDashboardController::class, 'yourCV'])->name('profile.yourCV');
        Route::get('/purchase-history', [JobSeekerDashboardController::class, 'purchaseHistory'])->name('profile.purchaseHistory');
        Route::get('/edit-profile', [JobSeekerDashboardController::class, 'editProfile'])->name('profile.editProfile');
        Route::get('/my-jobs', [JobSeekerDashboardController::class, 'myJobs'])->name('profile.myJobs');
        Route::get('/edit', [JobSeekerDashboardController::class, 'edit'])->name('jobseeker.profile.edit');

        Route::put('/update', [JobSeekerController::class, 'updateProfile'])->name('jobseeker.profile.update');
    });

    Route::prefix('giftNCoupon')->group(function () {
        // Route::get('/home/{type?}/{giftCategoryId?}', [FrontendController::class, 'giftNcoupon'])->name('gift.home');
        // Route::get('/description', [FrontendController::class, 'giftNcouponDescription'])->name('gift.details');
        Route::post('/comment/add', [UserCommentController::class, 'addComment'])->name('giftcomment.add');
        Route::delete('/comment/delete/{id}', [UserCommentController::class, 'deleteComment'])->name('giftcomment.delete');
        Route::get('/cart', [GiftCartController::class, 'couponcart'])->name('giftcart');
        Route::post('/addtocart', [GiftCartController::class, 'addtocart'])->name('addtocart');
        Route::get('/addquantity/{id}', [GiftCartController::class, 'addquantity'])->name('addquantity');
        Route::get('/subquantity/{id}', [GiftCartController::class, 'subquantity'])->name('subquantity');
        Route::delete('/deletecarts', [GiftCartController::class, 'deletecarts'])->name('deletecarts');
        // Route::get('/categories', [GiftCategoryController::class, 'index'])->name('giftcategories');
    });

    //profile documents route

    Route::prefix('profile/documents')->middleware(['auth'])->group(function () {
        Route::get('/{document_type}', [MyDocumentController::class, 'documents'])->name('profile.documents');
        // Route::get('/citizenship', [MyDocumentController::class, 'citizenship'])->name('profile.citizenship');
        // Route::get('/boardingpass', [MyDocumentController::class, 'boardingpass'])->name('profile.boardingpass');
        // Route::get('/certificates', [MyDocumentController::class, 'certificates'])->name('profile.certificates');
        // Route::get('/', [MyDocumentController::class,'index'])->name('profile.documents');
        Route::post('/upload', [MyDocumentController::class, 'upload'])->name('profile.documents.upload');
        Route::get('/document/delete/{id}', [MyDocumentController::class, 'destroy'])->name('document.destroy');
    });
    Route::get('apply/{slug?}', [FrontendController::class, 'applyJob'])->name('frontend.apply');

    Route::post('/job/bookmark', [FrontendController::class, 'bookmarkjob'])->name('job.bookmark');
    /* Visa HQ */
    Route::post('visa-HQ/apply', [FrontendController::class, 'visaDetails_apply'])->name('visaDetails.apply');
    Route::post('/visa-details/apply/save', [VisaApplicationController::class, 'saveApplication'])->name('visaDetails.apply.save');
    Route::post('visa-HQ/apply/pay', [FrontendController::class, 'payNow'])->name('visaDetails.apply.pay');

    Route::post('visa/payment/process', [VisaApplicationController::class, 'processPayment'])->name('visaDetails.payment.process');
    Route::post('/visa-details/apply/cleanup', [VisaApplicationController::class, 'cleanupApplication'])->name('visaDetails.apply.cleanup');
    // passport renewal route collection
    Route::get('/passport/renew', [PassportRenewalController::class, 'create'])->name('passport.renew');
    Route::post('/passport/renew', [PassportRenewalController::class, 'store'])->name('passport.renew.store');
    Route::get('/passport/renew/{id}/edit', [PassportRenewalController::class, 'edit'])->name('passport.renew.edit');
    Route::put('/passport/renew/{id}', [PassportRenewalController::class, 'update'])->name('passport.renew.update');

    //

});




/* Frontend routes */
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/finds-jobs', [FrontendController::class, 'findJobs'])->name('frontend.finds-jobs');
Route::get('/job-detail/{slug}', [FrontendController::class, 'jobDetail'])->name('frontend.job-details');
Route::get('/jobs/search', [FrontendController::class, 'jobSearch'])->name('frontend.job-search');
Route::get('/job-lists/{slug}', [FrontendController::class, 'jobLists'])->name('frontend.job-lists');
Route::get('/news-and-blogs', [FrontendController::class, 'newsAndBlogs'])->name('frontend.news-and-blogs');
Route::get('/news-detail/{slug}', [FrontendController::class, 'newsDetail'])->name('frontend.news-detail');
Route::get('/podcasts', [FrontendController::class, 'podcasts'])->name('frontend.podcasts');
Route::get('/podcast-detail/{slug}', [FrontendController::class, 'podcastDetail'])->name('frontend.podcast-detail');

Route::get('/forex-calulator', [FrontendController::class, 'forex_calculator'])->name('forex_calculator');
Route::get('/horoscope', [FrontendController::class, 'horoscope'])->name('horoscope');
Route::get('/exchanger-lists', [FrontendController::class, 'select_exchanger'])->name('select_exchanger');
Route::get('/bank-details', [FrontendController::class, 'exchange_bank_details'])->name('exchange_bank_details');

Route::get('visa-HQ', [FrontendController::class, 'visaHQ'])->name('visaHQ');
Route::get('visa-HQ/details', [FrontendController::class, 'visaDetails'])->name('visaDetails');

// Route::match(['get', 'post'],'/job-search', [FrontendController::class, 'jobSearch'])->name('frontend.search');
// Route::match(['get', 'post'],'/job-search', [FrontendController::class, 'jobSearch'])->name('frontend.job-search');
// Route::get('/search', [FrontendController::class, 'Search'])->name('frontend.search');

Route::get('aboardsdeals', [AboardController::class, 'aboard'])->name('aboarddeals');



Route::post('/set-redirect', function (Request $request) {
    // ✅ Store redirect URL in session
    session(['redirect_url' => $request->input('redirect_url')]);

    // ✅ Redirect to login instead of index
    return redirect()->route('index')->with('info', 'You need to login first ');
})->name('set.redirect');



Route::prefix('giftNCoupon')->group(function () {
    Route::get('/home/{type?}/{giftCategoryId?}', [FrontendController::class, 'giftNcoupon'])->name('gift.home');
    Route::get('/description', [FrontendController::class, 'giftNcouponDescription'])->name('gift.details');
    Route::get('/seller/{id}', [FrontendController::class, 'sellerProfile'])->name('gift.seller');
    // Route::get('/cart/{couponId}',[GiftCouponController::class, 'couponcart'])->name('giftcart');
    // Route::get('/cart',[GiftCartController::class, 'couponcart'])->name('giftcart');
    // Route::post('/addtocart', [GiftCartController::class, 'addtocart'])->name('addtocart');
    // Route::get('/addquantity/{id}', [GiftCartController::class, 'addquantity'])->name('addquantity');
    // Route::get('/subquantity/{id}', [GiftCartController::class, 'subquantity'])->name('subquantity');
    // Route::delete('/deletecarts', [GiftCartController::class, 'deletecarts'])->name('deletecarts');
    // Route::get('/categories', [GiftCategoryController::class, 'index'])->name('giftcategories');
});

Route::prefix('discussion')->group(function () {
    Route::resource('discussion_forum',DiscussionForumController::class)->except('index', 'create', 'edit')->middleware('auth:job_seekers');
    Route::get('/index', [FrontendController::class, 'discussionForum'])->name('frontend.discussion');
});
Route::prefix('advertisements')->group(function () {
    Route::get('/', [FrontendController::class, 'advertisements'])->name('frontend.advertisements');
});



//mydocuments
Route::prefix('mydocuments')->group(function () {
    Route::post('store', [MyDocumentController::class, 'store'])->name('mydocuments.store');
    Route::delete('delete/{id}', [MyDocumentController::class, 'destroy'])->name('mydocuments.delete');
});

Route::get('allpodcasts', [FrontendAPIController::class, 'allpodcasts']);
Route::get('/resume-help', [FrontendController::class, 'resumeHelp'])->name('resume');

Route::get('/fireEvent', [MessageController::class, 'fireEvent']);