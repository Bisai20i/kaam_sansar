<?php

use App\Http\Controllers\AboardController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdsManagerController;
use App\Http\Controllers\AdvertisementCategoryController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\AstrologerController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\BecomeSellerController;
use App\Http\Controllers\BlogsAndPodcastController;
use App\Http\Controllers\BrokerAccountController;
use App\Http\Controllers\DiscussionForumController;
use App\Http\Controllers\DocumentationAttestationController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ForexCalculatorController;
use App\Http\Controllers\ForumInteractionController;
use App\Http\Controllers\FrequentlyAskedQuestionController;
use App\Http\COntrollers\Frontend\FrontendAPIController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\GiftCartController;
use App\Http\Controllers\GiftCategoryController;
use App\Http\Controllers\GiftCouponController;
use App\Http\Controllers\HoroscopeController;
use App\Http\Controllers\IndustryCategoryController;
use App\Http\Controllers\InsuranceCategoryController;
use App\Http\Controllers\InsuranceCompanyController;
use App\Http\Controllers\InsuranceSubCategoryController;
use App\Http\Controllers\JobApplyController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\JobCompanyController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\JobSeekerDashboardController;
use App\Http\Controllers\KundaliController;
use App\Http\Controllers\KundaliMatchingController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MoneyExchangeController;
use App\Http\Controllers\MyDocumentController;
use App\Http\Controllers\OrderPlacementController;
use App\Http\Controllers\PassportCountryListController;
use App\Http\Controllers\PassportDateTimeController;
use App\Http\Controllers\PassportDistrictController;
use App\Http\Controllers\PassportLocationController;
use App\Http\Controllers\PassportProvienceController;
use App\Http\Controllers\PassportRenewalController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\PollingAnswerController;
use App\Http\Controllers\PollingQuestionController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductCommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResumeHelpController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\VisaApplicationController;
use App\Http\Controllers\VisaController;
use App\Http\Controllers\VisaCountryListController;
use App\Http\Controllers\VisaDetailsController;
use App\Http\Controllers\VisaTypeController;
use App\Http\Controllers\WorkPermitController;
use App\Http\Controllers\WorkPermitDistrictController;
use App\Http\Controllers\WorkPermitLocationController;
use App\Http\Controllers\FormSubmissionController;
use App\Models\PollingQuestion;
use App\Models\WorkPermit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ForeignExchangeDetailController;

// Authentication Routes
Route::get('master/login', [AdminController::class, 'loginView'])->name('login');
Route::post('login/store', [AdminController::class, 'login'])->name('login_store');

Route::post('logout', [AdminController::class, 'logout'])->name('logout')->middleware('auth:admin');

// Resource Route

// Route::resource('industryCategory', IndustryCategoryController::class);

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

    Route::resource('advertisementcategory', AdvertisementCategoryController::class);
    Route::put('/ads/publish/{id}', [AdvertisementController::class, 'publish'])->name('ads.publish');
    Route::put('/ads/unpublish/{id}', [AdvertisementController::class, 'unpublish'])->name('ads.unpublish');

    // Route for aboard deals
    Route::put('aboards/{id}/publish', [AboardController::class, 'publish'])->name('aboards.publish');
    Route::put('aboards/{id}/unpublish', [AboardController::class, 'unpublish'])->name('aboards.unpublish');

    Route::resource('productcategory', ProductCategoryController::class);

    //route for discussion forum
    Route::get('forum-posts/{category?}', [DiscussionForumController::class, 'index'])->name('forum.index');

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

    Route::resource('astrologer', AstrologerController::class);

    Route::resource('kundalimatching', KundaliMatchingController::class)->except('store');
    Route::get('/astrologer/show/{type}/{id}', [AstrologerController::class, 'view'])->name('astrologer.view');

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

Route::middleware(['auth:admin', 'role:superAdmin'])->prefix('superadmin')->group(function () {

    //Reward Routes
    Route::resource('rewards', RewardController::class);

    //view forex exchange requests

    Route::get('/forex/requests', [ForeignExchangeDetailController::class, 'exchange_requests'])->name('forex.requests');
    Route::delete('/forex/requests/{foreignExchangeDetail}', [ForeignExchangeDetailController::class, 'destroy'])->name('forex.request.destroy');

    //forex exchange
    Route::prefix('forex')->group(function () {
        Route::get('/', [ForexCalculatorController::class, 'index'])->name('forex.index');
        Route::post('/store', [ForexCalculatorController::class, 'store'])->name('forex.store');
        Route::put('/update/{forex}', [ForexCalculatorController::class, 'update'])->name('forex.update');
        Route::delete('/destroy/{forex}', [ForexCalculatorController::class, 'destroy'])->name('forex.destroy');
    });

    //faq
    Route::resource('faqs', FrequentlyAskedQuestionController::class);

    //work permit
    Route::resource('workPermitDistricts', WorkPermitDistrictController::class);
    Route::resource('workPermitLocations', WorkPermitLocationController::class);

    //Polling System
    Route::resource('pollingQuestions', PollingQuestionController::class);
    Route::post('/pollingQuestion/{id}/update-publish', [PollingQuestionController::class, 'publishStatus'])->name('update.publishStatus');
    Route::resource('pollingAnswers', PollingAnswerController::class);

    //bank Account
    Route::post('/bankAccounts/{id}/update-status', [BankAccountController::class, 'updateStatus'])
        ->name('bankaccount.updateStatus');
    Route::get('/bankAccounts', [BankAccountController::class, 'index'])->name('bankAccounts.index');
    Route::get('/bankAccounts/{id}', [BankAccountController::class, 'show'])->name('bankAccounts.show');
    Route::delete('/bankAccounts/{bankAccount}', [BankAccountController::class, 'destroy'])->name('bankAccounts.destroy');

    //broker account
    Route::get('/brokerAccounts/{brokerAccount}', [BrokerAccountController::class, 'show'])->name('brokerAccounts.show'); // Show specific broker account
    Route::delete('/brokerAccounts/{brokerAccount}', [BrokerAccountController::class, 'destroy'])->name('brokerAccounts.destroy'); // Delete broker account
    Route::get('/brokerAccounts', [BrokerAccountController::class, 'index'])->name('brokerAccounts.index'); // List all broker accounts
    Route::post('/brokerAccounts/{id}/update-status', [BrokerAccountController::class, 'updateStatus'])
        ->name('brokerAccount.updateStatus');

    //document Attestation
    Route::get('/documentAttestations', [DocumentationAttestationController::class, 'index'])->name('documentAttestations.index');
    Route::get('/documentAttestations/{documentAttestation}', [DocumentationAttestationController::class, 'show'])->name('documentAttestations.show');
    Route::delete('/documentAttestations/{documentAttestation}', [DocumentationAttestationController::class, 'destroy'])->name('documentAttestations.destroy');
    Route::post('/documentAttestations/{id}/update-status', [DocumentationAttestationController::class, 'updateStatus'])
        ->name('documentAttestation.updateStatus');

    //work permit
    Route::get('/workPermits', [WorkPermitController::class, 'index'])->name('workPermits.index');
    Route::get('/workPermits/{workPermit}', [WorkPermitController::class, 'show'])->name('workPermits.show');
    Route::delete('/workPermits/{workPermit}', [WorkPermitController::class, 'destroy'])->name('workPermits.destroy');

    Route::post('/workPermits/{id}/update-status', [WorkPermitController::class, 'updateStatus'])
        ->name('workPermit.updateStatus');
    //poll
    Route::get('/polls', [PollController::class, 'index'])->name('polls.index');
    Route::get('/polls/{poll}', [PollController::class, 'show'])->name('polls.show');
    Route::delete('/polls/{poll}', [PollController::class, 'destroy'])->name('polls.destroy');


    //passport renewal
    Route::resource('passportCountryList', PassportCountryListController::class)->except('edit', 'create');
    Route::resource('passportProvienceList', PassportProvienceController::class)->except('index', 'edit', 'create');
    Route::get('passportProvience/{country_id}', [PassportProvienceController::class, 'index'])->name('passportProvienceList.index');
    Route::put('/passportProvienceList/publish/{id}', [PassportProvienceController::class, 'publish'])->name('passportProvienceList.publish');
    Route::put('/passportProvienceList/unpublish/{id}', [PassportProvienceController::class, 'unpublish'])->name('passportProvienceList.unpublish');

    Route::put('/passportCountryList/publish/{id}', [PassportCountryListController::class, 'publish'])->name('passportCountryList.publish');
    Route::put('/passportCountryList/unpublish/{id}', [PassportCountryListController::class, 'unpublish'])->name('passportCountryList.unpublish');

    Route::get('/passport/renewal', [PassportRenewalController::class, 'index'])->name('passport.renewal');
    Route::get('/passport/renewal/{id}', [PassportRenewalController::class, 'show'])->name('passport.renewal.show');
    Route::delete('/passport/renewal/{id}', [PassportRenewalController::class, 'destroy'])->name('passport.renewal.destroy');

    Route::resource('passportDistrictList', PassportDistrictController::class)->except('index', 'edit', 'create');
    Route::get('passportDistrict/{provience_id}', [PassportDistrictController::class, 'index'])->name('passportDistrictList.index');
    Route::put('/passportDistrictList/publish/{id}', [PassportDistrictController::class, 'publish'])->name('passportDistrictList.publish');
    Route::put('/passportDistrictList/unpublish/{id}', [PassportDistrictController::class, 'unpublish'])->name('passportDistrictList.unpublish');

    Route::resource('passportLocationList', PassportLocationController::class)->except('index', 'edit', 'create');
    Route::get('passportLocation/{district_id}', [PassportLocationController::class, 'index'])->name('passportLocationList.index');
    Route::put('/passportLocationList/publish/{id}', [PassportLocationController::class, 'publish'])->name('passportLocationList.publish');
    Route::put('/passportLocationList/unpublish/{id}', [PassportLocationController::class, 'unpublish'])->name('passportLocationList.unpublish');
    Route::get('passportDateTime/{location_id}', [PassportDateTimeController::class, 'index'])->name('passportDateTime.index');
    Route::post('passportDateTime', [PassportDateTimeController::class, 'store'])->name('passportDateTime.store');
    Route::delete('passportDateTime/{passportDateTime}', [PassportDateTimeController::class, 'destroy'])->name('passportDateTime.destroy');
});

//manage Insurance

Route::get('/insurance/company', [InsuranceCompanyController::class, 'index'])->name('insurance.company');
Route::delete('/insurance/company/destroy/{insuranceCompany}', [InsuranceCompanyController::class, 'destroy'])->name('insuranceCompany.destroy');
Route::post('/insurance/company/store', [InsuranceCompanyController::class, 'store'])->name('insuranceCompany.store');
Route::put('/insurance/company/update/{insuranceCompany}', [InsuranceCompanyController::class, 'update'])->name('insuranceCompany.update');
Route::put('/insurance/company/publish/{id}', [InsuranceCompanyController::class, 'publish'])->name('insuranceCompany.publish');
Route::put('/insurance/company/unpublish/{id}', [InsuranceCompanyController::class, 'unpublish'])->name('insuranceCompany.unpublish');

Route::get('/insurance/{id}/category', [InsuranceCategoryController::class, 'index'])->name('insurance.category');
Route::post('/insurace/category/store', [InsuranceCategoryController::class, 'insertDetails'])->name('insuranceDetails.store');
Route::delete('/insurance/category/destroy/{insuranceCategory}', [InsuranceCategoryController::class, 'destroy'])->name('insuranceCategory.destroy');
Route::post('/insurance/category/store', [InsuranceCategoryController::class, 'store'])->name('insuranceCategory.store');
Route::put('/insurance/category/update/{insuranceCategory}', [InsuranceCategoryController::class, 'update'])->name('insuranceCategory.update');
Route::put('/insurance/category/publish/{id}', [InsuranceCategoryController::class, 'publish'])->name('insuranceCategory.publish');
Route::put('/insurance/category/unpublish/{id}', [InsuranceCategoryController::class, 'unpublish'])->name('insuranceCategory.unpublish');

Route::get('/insurance/{id}/subcategory', [InsuranceSubCategoryController::class, 'index'])->name('insurance.sub_categories');
Route::post('/insurance/{id}/subcategory', [InsuranceSubCategoryController::class, 'store'])->name('insuranceSubCategory.store');
Route::put('/insurance/subcategory/{id}', [InsuranceSubCategoryController::class, 'update'])->name('insuranceSubCategory.update');
Route::delete('/insurance/subcategory/{id}', [InsuranceSubCategoryController::class, 'destroy'])->name('insuranceSubCategory.destroy');
Route::put('/insurance/subcategory/publish/{id}', [InsuranceSubCategoryController::class, 'publish'])->name('insuranceSubCategory.publish');
Route::put('/insurance/subcategory/unpublish/{id}', [InsuranceSubCategoryController::class, 'unpublish'])->name('insuranceSubCategory.unpublish');

Route::get('/insurance/{id}/details', [InsuranceCategoryController::class, 'manage'])->name('insurance.manage');

//get job applicants of the particular post

Route::get('/job-post/applications/{id}', [JobApplyController::class, 'index']);

//delete forum post by admin

Route::delete('discussion_forum/{id}', [DiscussionForumController::class, 'destroy'])->name('forum.delete');
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
});

Route::post('/clear-session-flag', [JobSeekerController::class, 'clearSessionFlag'])->name('clear.session.flag');

Route::middleware(['auth:job_seekers'])->prefix('jobseeker')->group(function () {


    // Route::resource('jobApply', JobApplyController::class);
    //job applies routes
    Route::get('jobApply/{id}', [JobApplyController::class, 'store'])->name('jobApply.store');

    // abroad deals posting route
    Route::post('abroad_deal_post', [AboardController::class, 'store'])->name('abroad_deal.store');

    Route::get('/resume-maker', [FrontendController::class, 'resumeMaker'])->name('jobseeker.resume-maker');

    Route::post('logout', [JobSeekerController::class, 'logout'])->name('jobseeker.logout');
    Route::get('/otp_page', [JobSeekerController::class, 'otp_page'])->name('jobseeker.otp_page');
    Route::post('otp_verify', [JobSeekerController::class, 'otpVerify'])->name('jobseeker.otp_verify');
    Route::post('resend-otp', [JobSeekerController::class, 'resendOtp'])->name('jobseeker.resend-otp');
    Route::patch('update-password', [JobSeekerController::class, 'updatePassword'])->name('jobseeker.update-password');
    Route::get('change-password', [JobSeekerController::class, 'changePassword'])->name('jobseeker.change-password');
    Route::patch('deactivate', [JobSeekerController::class, 'deactivate']);
    Route::patch('delete', [JobSeekerController::class, 'delete']);
    Route::get('getProfile/{user_id?}', [JobSeekerController::class, 'getProfile'])->name('jobseeker.getProfile');

    Route::get('getAbroadDeals', [JobSeekerController::class, 'getAbroadDeals'])->name('jobseeker.getAbroadDeals');

    Route::get('getAdvertisements/{user_id?}', [JobSeekerController::class, 'getAdvertisements'])->name('jobseeker.getAdvertisements');
    Route::get('getCV/{user_id?}', [JobSeekerController::class, 'getCV'])->name('jobseeker.getCV');
    Route::get('editProfile/{user_id?}', [JobSeekerController::class, 'editProfile'])->name('jobseeker.editProfile');
    Route::get('/setProfile/{index}', [JobSeekerController::class, 'setProfile'])->name('jobseeker.setProfile');
    Route::get('/deleteImage/{index}', [JobSeekerController::class, 'deleteImage'])->name('jobseeker.deleteImage');
    Route::get('getPurchaseHistory/{user_id?}', [JobSeekerController::class, 'getPurchaseHistory'])->name('jobseeker.getPurchaseHistory');
    Route::get('/myjobs/{user_id?}', [JobSeekerController::class, 'myjobs'])->name('jobseeker.myjobs');
    Route::get('/bookmark/remove/{jobId}', [JobSeekerController::class, 'removeBookmark'])->name('jobBookmark.remove');
    Route::get('/myblogs', [JobSeekerController::class, 'myblogs'])->name('jobseeker.myblogs');
    Route::get('/forms', [FormSubmissionController::class, 'index'])->name('jobseeker.forms');
    Route::get('/mynews', [JobSeekerController::class, 'mynews'])->name('jobseeker.mynews');
    Route::get('/form/complete/{id}', [FormSubmissionController::class, 'findForm'])->name('form.complete');
    // Route::put('updateProfile/{user_id}', [JobSeekerController::class, 'updateProfile']);

    Route::resource('profiles', ProfileController::class);
    Route::resource('visas', VisaController::class);
    Route::resource('educations', EducationController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('skills', SkillController::class);
    Route::resource('achievements', AchievementController::class);
    Route::resource('experiences', ExperienceController::class);
    Route::resource('trainings', TrainingController::class);
    Route::resource('languages', LanguageController::class);

    //bank account
    Route::get('bankAccounts/create', [BankAccountController::class, 'create'])->name('bankAccounts.create');
    Route::post('bankAccounts', [BankAccountController::class, 'store'])->name('bankAccounts.store');
    Route::get('bankAccounts/{bankAccount}/edit', [BankAccountController::class, 'edit'])->name('bankAccounts.edit');
    Route::put('bankAccounts/{bankAccount}', [BankAccountController::class, 'update'])->name('bankAccounts.update');

    // Broker Account
    Route::get('brokerAccounts/create', [BrokerAccountController::class, 'create'])->name('brokerAccounts.create');
    Route::post('brokerAccounts', [BrokerAccountController::class, 'store'])->name('brokerAccounts.store');
    Route::get('brokerAccounts/{brokerAccount}/edit', [BrokerAccountController::class, 'edit'])->name('brokerAccounts.edit');
    Route::put('brokerAccounts/{brokerAccount}', [BrokerAccountController::class, 'update'])->name('brokerAccounts.update');


    //document Attestation
    Route::get('documentAttestations/create', [DocumentationAttestationController::class, 'create'])->name('documentAttestations.create');
    Route::post('documentAttestations', [DocumentationAttestationController::class, 'store'])->name('documentAttestations.store');
    Route::get('documentAttestations/{documentAttestation}/edit', [DocumentationAttestationController::class, 'edit'])->name('documentAttestations.edit');
    Route::put('documentAttestations/{documentAttestation}', [DocumentationAttestationController::class, 'update'])->name('documentAttestations.update');

    // work Pemrit

    Route::get('workPermits/create', [WorkPermitController::class, 'create'])->name('workPermits.create');
    Route::post('workPermits', [WorkPermitController::class, 'store'])->name('workPermits.store');
    Route::get('workPermits/{workPermit}/edit', [WorkPermitController::class, 'edit'])->name('workPermits.edit');
    Route::put('workPermits/{workPermit}', [WorkPermitController::class, 'update'])->name('workPermits.update');

    //polls
    Route::resource('polls', PollController::class)
        ->only(['create', 'store', 'edit', 'update']);



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
    Route::get('/passport/renew/partial', [PassportRenewalController::class, 'partial'])->name('passport.partial');
    Route::post('/passport/renew', [PassportRenewalController::class, 'store'])->name('passport.renew.store');
    Route::get('/passport/renew/{id}/edit', [PassportRenewalController::class, 'edit'])->name('passport.renew.edit');
    Route::put('/passport/renew/{id}', [PassportRenewalController::class, 'update'])->name('passport.renew.update');
    Route::post('/passport/renew/partial', [PassportRenewalController::class, 'store_partial'])->name('passport.renew.partial');
    Route::get('/passport/edit/{id}', [PassportRenewalController::class, 'edit'])->name('passport.edit');

    //forex details
    Route::get('/exchange/currency', [ForeignExchangeDetailController::class, 'index'])->name('exchange.currency');
    Route::post('/exchange/currency', [ForeignExchangeDetailController::class, 'store'])->name('exchange.currency.store');
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

Route::resource('aboards', AboardController::class);
Route::get('/searchaboard', [AboardController::class, 'search'])->name('aboard.search');

// commnet for aboard deals

Route::resource('aboardcomment', ProductCommentController::class);

//route related  to frontend horoscope and kundali

//Route for kundali
Route::resource('kundalidetail', KundaliController::class);
Route::post('kundalimatching', [KundaliMatchingController::class, 'store'])->name('kundalimatching.store');
//Route fro astrolger

// Route::post('/set-redirect', function (Request $request) {
//     // ✅ Store redirect URL in session
//     session(['redirect_url' => $request->input('redirect_url')]);

//     // ✅ Redirect to login instead of index
//     return redirect()->route('index')->with('info', 'You need to login first ');
// })->name('set.redirect');

Route::post('/set-redirect', function (Request $request) {
    // ✅ Store redirect URL in session
    session(['redirect_url' => $request->input('redirect_url')]);

    // ✅ Redirect to index
    return redirect()->back()->with('showLoginModal', true);
})->name('set.redirect');

Route::prefix('giftNCoupon')->group(function () {
    Route::get('/home/{type?}/{giftCategoryId?}', [FrontendController::class, 'giftNcoupon'])->name('gift.home');
    Route::get('/description', [FrontendController::class, 'giftNcouponDescription'])->name('gift.details');
    Route::get('/seller/{id}/{type?}', [FrontendController::class, 'sellerProfile'])->name('gift.seller');
    // Route::get('/cart/{couponId}',[GiftCouponController::class, 'couponcart'])->name('giftcart');
    // Route::get('/cart',[GiftCartController::class, 'couponcart'])->name('giftcart');
    // Route::post('/addtocart', [GiftCartController::class, 'addtocart'])->name('addtocart');
    // Route::get('/addquantity/{id}', [GiftCartController::class, 'addquantity'])->name('addquantity');
    // Route::get('/subquantity/{id}', [GiftCartController::class, 'subquantity'])->name('subquantity');
    // Route::delete('/deletecarts', [GiftCartController::class, 'deletecarts'])->name('deletecarts');
    // Route::get('/categories', [GiftCategoryController::class, 'index'])->name('giftcategories');
});

Route::prefix('insurance')->group(function () {
    Route::get('/', [FrontendController::class, 'insurance'])->name('frontend.insurance');
    Route::get('/categories/{id}', [FrontendController::class, 'insurance_category'])->name('insurance.categories');
    Route::get('/details/{id}', [FrontendController::class, 'insurance_details'])->name('insurance.details');
});

Route::prefix('discussion')->group(function () {
    Route::resource('discussion_forum', DiscussionForumController::class)->except('index', 'create', 'edit')->middleware('auth:job_seekers');

    Route::get('/index', [FrontendController::class, 'discussionForum'])->name('frontend.discussion');
    Route::get('/profile/{id}', [FrontendController::class, 'forumProfile'])->name('discussion.profile');
    Route::post('/follow-user', [DiscussionForumController::class, 'followToUser'])->name('discussion.followuser')->middleware('auth:job_seekers');
    Route::post('/interact', [ForumInteractionController::class, 'interact'])->name('discussion.interact')->middleware('auth:job_seekers');
    Route::get('/pin-post/{id}', [DiscussionForumController::class, 'togglePinnedPost'])->name('discussion.pinpost')->middleware(['auth:admin', 'role:superAdmin']);
    Route::get('/comments/{id}', [DiscussionForumController::class, 'loadComment']);
    Route::post('/add-comment', [DiscussionForumController::class, 'addComment'])->name('discussion.addcomment')->middleware('auth:job_seekers');
    Route::delete('delete-comment/{id}', [DiscussionForumController::class, 'deleteComment'])->name('discussion.deletecomment')->middleware('auth:job_seekers');
    Route::delete('delete-image', [DiscussionForumController::class, 'deleteImage'])->name('discussion.deleteimage')->middleware('auth:job_seekers');
});

Route::prefix('advertisements')->group(function () {
    Route::get('/', [FrontendController::class, 'advertisements'])->name('frontend.advertisements');
    Route::get('/Ads/type/{type?}/category/{categoryId?}', [AdvertisementController::class, 'showByTypeAndCategory'])->name('Ads.showByTypeCategory');
    Route::get('Ads/type/{type}', [AdvertisementController::class, 'showByTypeAndCategory'])->name('Ads.showByType');
    Route::get('Ads/category/{categoryId}', [AdvertisementController::class, 'showByCategory'])->name('Ads.showByCategory');
    Route::get('Ads/adssearch', [AdvertisementController::class, 'search'])->name('ads.search');
    // comment

    Route::resource('adscomment', CommentController::class);
});

Route::resource('ads', AdvertisementController::class);
//abroad deals
Route::resource('aboards', AboardController::class);
Route::get('/searchaboard', [AboardController::class, 'search'])->name('aboard.search');

//mydocuments
Route::prefix('mydocuments')->group(function () {
    Route::post('store', [MyDocumentController::class, 'store'])->name('mydocuments.store');
    Route::delete('delete/{id}', [MyDocumentController::class, 'destroy'])->name('mydocuments.delete');
});

Route::get('allpodcasts', [FrontendAPIController::class, 'allpodcasts']);
Route::get('/resume-help', [FrontendController::class, 'resumeHelp'])->name('resume');

// Frontend roure for become a seller
Route::get('/become_seller', function () {
    return view('frontend.giftNcoupon.become_seller');
})->name('become.seller');

// Handle the form submission from the frontend
Route::post('/become_seller', [BecomeSellerController::class, 'store'])->name('become.seller.store');

// Superadmin routes grouped under /superadmin
Route::prefix('superadmin')->middleware(['auth:admin', 'role:superAdmin'])->group(function () {
    Route::get('/becomeseller', [BecomeSellerController::class, 'index'])->name('superadmin.becomeseller.index');
    Route::post('/becomeseller', [BecomeSellerController::class, 'store'])->name('superadmin.becomeseller.store');
    Route::get('/becomeseller/{id}', [BecomeSellerController::class, 'show'])->name('superadmin.becomeseller.show');
    Route::delete('/becomeseller/{id}', [BecomeSellerController::class, 'destroy'])->name('superadmin.becomeseller.destroy');
});

Route::get('/passport/countries', [PassportRenewalController::class, 'passport_countries'])->name('passport.countries');
Route::get('/passport/proviences/{id}', [PassportRenewalController::class, 'passport_proviences'])->name('passport.proviences');
Route::get('/passport/districts/{id}', [PassportRenewalController::class, 'passport_districts'])->name('passport.districts');
Route::get('/passport/locations/{id}', [PassportRenewalController::class, 'passport_locations'])->name('passport.locations');
Route::get('/passport/times/{id}/{date}', [PassportRenewalController::class, 'passport_times'])->name('passport.times');

