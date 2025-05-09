<?php

use App\Http\Controllers\AboardController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AdvertisementCategoryController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductCommentController;
use App\Http\Controllers\DiscussionForumController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\Frontend\FrontendAPIController;
use App\Http\Controllers\GiftCartController;
use App\Http\Controllers\GiftCategoryController;
use App\Http\Controllers\GiftCouponController;
use App\Http\Controllers\HoroscopeController;
use App\Http\Controllers\IndustryCategoryController;
use App\Http\Controllers\JobApplyController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\JobCompanyController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\KundaliController;
use App\Http\Controllers\KundaliMatchingController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MyDocumentController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\ForumInteractionController;
use App\Http\Controllers\VisaController;use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('check.request.type')->prefix('jobseeker/mobile')->group(function () {
    Route::post('verify-phone', [JobSeekerController::class, 'verifyPhone']);
    Route::post('verify-otp', [JobSeekerController::class, 'verifyOtp']);
    Route::post('reset-password', [JobSeekerController::class, 'resetPassword']);
    Route::post('/register', [JobSeekerController::class, 'register']);
    Route::post('/login', [JobSeekerController::class, 'login']);
    Route::post('/forgot-password/resend-otp', [JobSeekerController::class, 'forgotResendOtp']);
});

// Protected routes using Sanctum middleware
Route::middleware(['auth:sanctum', 'auth:api', 'check.request.type'])->group(function () {
    // Authenticated user route
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('api-industryCategory', IndustryCategoryController::class);
    Route::apiResource('api-jobApply', JobApplyController::class);
    Route::apiResource('api-jobCategory', JobCategoryController::class);
    Route::apiResource('api-jobCompany', JobCompanyController::class);
    Route::apiResource('api-jobPost', JobPostController::class);
    Route::apiResource('api-jobSeeker', JobSeekerController::class);

    // Jobseeker-specific routes

    Route::prefix('jobseeker/mobile')->group(function () {
        Route::post('logout', [JobSeekerController::class, 'logout']);
        Route::post('otp_verify', [JobSeekerController::class, 'otpVerify']);
        Route::post('resend-otp', [JobSeekerController::class, 'resendOtp']);
        Route::patch('update-password', [JobSeekerController::class, 'updatePassword']);
        Route::patch('deactivate', [JobSeekerController::class, 'deactivate']);
        Route::patch('delete', [JobSeekerController::class, 'delete']);
        Route::get('getProfile/{user_id}', [JobSeekerController::class, 'getProfile']);

        Route::get('/myjobs/{user_id?}', [JobSeekerController::class, 'myjobs']);
        Route::get('/setProfile/{index}', [JobSeekerController::class, 'setProfile']);
        Route::get('/deleteImage/{index}', [JobSeekerController::class, 'deleteImage']);
        Route::put('/updateProfile', [JobSeekerController::class, 'updateProfile']);
        Route::get('editProfile/{user_id?}', [JobSeekerController::class, 'editProfile']);

        // message api

        Route::post('/send-message', [MessageController::class, 'sendMessage']);
        Route::get('/user-inbox', [MessageController::class, 'user_inbox']);
        Route::get('/sender-messages', [MessageController::class, 'sender_messages']);

        //discussion forum

        Route::apiResource('discussion-forum', DiscussionForumController::class)->except('index', 'create', 'edit'); // good
        Route::get('/discussion-forums', [FrontendAPIController::class, 'discussionForum']); //good
        Route::get('/discussion-forum/profile/{id}', [FrontendAPIController::class, 'forumProfile']); //good
        Route::post('/follow-user', [DiscussionForumController::class, 'followToUser']); //good
        Route::post('/forum/interact', [ForumInteractionController::class, 'interact']); //good
        Route::get('/forum/pin-post/{id}', [DiscussionForumController::class, 'togglePinnedPost']); //good
        Route::get('/forum-comments/{id}', [DiscussionForumController::class, 'loadComment']); //good
        Route::post('/forum/add-comment', [DiscussionForumController::class, 'addComment']); //good
        Route::delete('/forum/delete-comment/{id}', [DiscussionForumController::class, 'deleteComment']); //good
        Route::delete('/forum/delete-image', [DiscussionForumController::class, 'deleteImage']); //good

        // resume help api
        Route::get('resume-help', [FrontendAPIController::class, 'resumeHelp']);

        //job related api

        Route::get('job', [FrontendAPIController::class, 'index']);
        Route::get('job/find', [FrontendAPIController::class, 'findJobs']);
        Route::get('job/joblists/{slug?}', [FrontendAPIController::class, 'jobLists']);
        Route::get('job/jobDetail/{slug?}', [FrontendAPIController::class, 'jobDetail']);
        Route::get('job/applyjob/{slug?}', [FrontendAPIController::class, 'applyJob']);
        Route::match(['get', 'post'], '/jobsearch', [FrontendAPIController::class, 'jobSearch']);
        Route::get('job/search', [FrontendAPIController::class, 'Search']);

        //resource api for resume
        Route::apiResource('profile', ProfileController::class);
        Route::apiResource('visadetail', VisaController::class);
        Route::apiResource('education', EducationController::class);
        Route::apiResource('project', ProjectController::class);
        Route::apiResource('skill', SkillController::class);
        Route::apiResource('achievement', AchievementController::class);
        Route::apiResource('experience', ExperienceController::class);
        Route::apiResource('training', TrainingController::class);
        Route::apiResource('language', LanguageController::class);
        Route::apiResource('giftCoupon', GiftCouponController::class);
        Route::apiResource('giftCategory', GiftCategoryController::class);
        //resume related routes
        Route::post('profile/storedata', [ProfileController::class, 'storedata']);
        Route::post('visadetail/storevisa', [VisaController::class, 'storevisa']);
        Route::post('education/storeedu', [EducationController::class, 'storeedu']);
        Route::post('project/storeproject', [ProjectController::class, 'storeproject']);
        Route::post('skill/storeskill', [SkillController::class, 'storeskill']);
        Route::post('achievement/storeachievement', [AchievementController::class, 'storeachievement']);
        Route::post('experience/storeexperience', [ExperienceController::class, 'storeexperience']);
        Route::post('training/storetraining', [TrainingController::class, 'storetraining']);
        Route::post('language/storelanguage', [LanguageController::class, 'storelan']);
        
        //Gift coupons related route
        Route::post('giftCategory/storegiftcoupon', [GiftCategoryController::class, 'storegift']);

        //advertisement category related routes
        Route::apiResource('adsCategory', AdvertisementCategoryController::class);

        //advertisement related route
        Route::apiResource('Ads', AdvertisementController::class);
        Route::get('ads/bytype/{type}', [AdvertisementController::class, 'showByType']);

        Route::get('ads/category/{categoryId}', [AdvertisementController::class, 'showByCategory']);

        Route::get('ads/{type}', [AdvertisementController::class, 'showByTypeAndCategory']);
        Route::get('/ads/{type}/{categoryId}', [AdvertisementController::class, 'showByTypeAndCategory'])->name('ads.showByTypeCategory');

        Route::get('ads/adssearch', [AdvertisementController::class, 'search']);
        Route::post('ads/adssearch', [AdvertisementController::class, 'search']);

        //advertisement comment
        Route::apiResource('comment', CommentController::class);

        //aboard  product
        Route::apiResource('Aboard', AboardController::class);

        Route::get('user-abroads', [AboardController::class, 'userAboards']);

        Route::get('aboard/bytype/{type}', [AboardController::class, 'showByType']);

        Route::get('aboard/{type}', [AboardController::class, 'showByTypeAndCategory']);

        Route::get('/aboard/{type}/{categoryId}', [AboardController::class, 'showByTypeAndCategory'])->name('aboard.showByTypeCategory');

        Route::get('aboard/aboardsearch', [AboardController::class, 'search']);
        Route::post('aboard/aboardsearch', [AboardController::class, 'search']);

       Route::apiResource('productcomment',ProductCommentController::class);
        //aboard product category
        Route::apiResource('productCategory', ProductCategoryController::class);

        //Horoscope realted route
        Route::apiResource('Horoscope', HoroscopeController::class);
        //kundali realted api
        Route::apiResource('kundali', KundaliController::class);

        Route::prefix('/documents')->group(function () {
            Route::get('/{document_type}', [MyDocumentController::class, 'documents']);
            Route::post('/upload', [MyDocumentController::class, 'upload']);
            Route::delete('/document/delete/{id}', [MyDocumentController::class, 'destroy']);
        });

        Route::get('getVisaHQ', [FrontendAPIController::class, 'getVisaHQ']);
        Route::get('jobcategory', [FrontendAPIController::class, 'categories']);
        Route::get('podcastDetail/{id}', [FrontendAPIController::class, 'podcastDetail']);
        Route::get('allpodcasts', [FrontendAPIController::class, 'allpodcasts']);
        Route::get('blogDetail/{id}', [FrontendAPIController::class, 'blogDetail']);
        Route::get('allblogs', [FrontendAPIController::class, 'allblogs']);
        Route::get('homepage', [FrontendAPIController::class, 'index']);

        // Route::prefix('mydocuments')->group(function () {
        //     Route::post('store', [MyDocumentController::class, 'store']);
        //     Route::delete('delete/{id}', [MyDocumentController::class, 'destroy']);
        // });
        // gift and coupon routes
        Route::prefix('giftNCoupon')->group(function () {
            Route::get('/home/{type?}/{giftCategoryId?}', [FrontendAPIController::class, 'giftNcoupon']);
            Route::get('/description/{id}', [FrontendAPIController::class, 'giftNcouponDescription']);
            Route::get('/comments/{id}', [FrontendAPIController::class, 'giftComments']);
            Route::get('/seller/{id}/{type?}', [FrontendAPIController::class, 'sellerProfile']);
            Route::get('/cart', [GiftCartController::class, 'couponcart']);
            Route::post('/addtocart', [GiftCartController::class, 'addtocart']);
            Route::get('/addquantity/{id}', [GiftCartController::class, 'addquantity']);
            Route::get('/subquantity/{id}', [GiftCartController::class, 'subquantity']);
            Route::delete('/deletecarts', [GiftCartController::class, 'deletecarts']);
            Route::post('/comment/add', [UserCommentController::class, 'addComment']);
            Route::delete('/comment/delete/{id}', [UserCommentController::class, 'deleteComment']);
            Route::get('/description/{id}', [FrontendAPIController::class, 'giftNcouponDescription']);
            // Route::get('/categories', [GiftCateryController::class, 'index'])->name('giftcategories');
        });

        Route::apiResource('kundaliMatching', KundaliMatchingController::class);


        // Route::prefix('profile')->group(function (){
        //     route::get('/{id}',[JobSeekerController::class, 'getProfile']);
        // });
    });
});
