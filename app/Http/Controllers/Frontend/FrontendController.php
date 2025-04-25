<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Advertisement;
use App\Models\AdvertisementCategory;
use App\Models\BlogsAndPodcast;
use App\Models\GiftCategory;
use App\Models\GiftCoupon;
use App\Models\IndustryCategory;
use App\Models\JobBookmark;
use App\Models\JobCategory;
use App\Models\JobPost;
use App\Models\VisaCountryList;
use App\Models\VisaDetails;
use App\Models\VisaType;
use App\Models\UserComment;
use App\Models\DiscussionForum;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $industries = IndustryCategory::all();

        // Load Home Page Data
        $blogs = BlogsAndPodcast::orderBy('created_at', 'desc')
            ->where('blogOrPodcast', 'blog')
            ->where('publishStatus', 1)
            ->take(4)->get();

        $podcasts = BlogsAndPodcast::orderBy('created_at', 'desc')
            ->where('blogOrPodcast', 'podcast')
            ->where('publishStatus', 1)
            ->take(4)->get();

        $findJobs = JobPost::orderBy('created_at', 'desc')
            ->where('jobStatus', 'published')
            ->take(4)->get();

        $ads = Advertisement::orderBy('created_at', 'desc')
            ->take(4)->get();

        $post        = Advertisement::all();

        $giftCoupons = GiftCoupon::orderBy('created_at', 'desc')
            ->where('publishStatus', 1)
            ->take(4)->get();

        $categories = JobCategory::orderBy('created_at', 'desc')
            ->where('publishStatus', 1)
            ->take(12)
            ->get();

        // dd($giftCoupons);
        return view('frontend.index', compact('blogs', 'podcasts', 'findJobs', 'ads', 'post', 'categories', 'giftCoupons'));
    }

    public function findJobs()
    {
        $findJobs = JobPost::orderBy('created_at', 'desc')
            ->where('jobStatus', 'published')
            ->paginate(8);

        $categories = JobCategory::orderBy('created_at', 'desc')
            ->where('publishStatus', 1)
            ->get();

        $skills = JobPost::where('skills', '!=', '')
            ->where('jobStatus', 'published')
            ->pluck('skills') // Get all skill strings
            ->flatMap(function ($skills) {
                return array_map('trim', explode(',', $skills)); // Split into individual skills
            })
            ->unique()  // Remove duplicate skills
            ->values(); // Reindex collection

        $jobLocation = JobPost::where('jobLocation', '!=', '')
            ->where('jobStatus', 'published')
            ->pluck('jobLocation')
            ->unique();

        return view('frontend.find-jobs', compact('findJobs', 'skills', 'jobLocation', 'categories'));
    }

    public function jobLists(Request $request, $slug = null)
    {

        $industries = IndustryCategory::all();

        $categories = JobCategory::orderBy('created_at', 'desc')
            ->where('publishStatus', 1)
            ->get();

        $skills = JobPost::where('skills', '!=', '')
            ->where('jobStatus', 'published')
            ->pluck('skills') // Get all skill strings
            ->flatMap(function ($skills) {
                return array_map('trim', explode(',', $skills)); // Split into individual skills
            })
            ->unique()  // Remove duplicate skills
            ->values(); // Reindex collection

        $jobs = JobPost::with('jobCompany')->orderBy('created_at', 'desc')
            ->where('jobStatus', 'published')
            ->where('jobSlug', $slug)
            ->first();

        $jobcategorylist = JobPost::with('jobCategory')->orderBy('created_at', 'desc')
            ->where('jobStatus', 'published')
            ->get();

                                             // Get the category_id of the job
        $category_id = $jobs->jobCategoryId; // Assuming `category_id` is the field

        // Fetch jobs in the same category
        $relatedJobs = JobPost::with('jobCompany')->orderBy('created_at', 'desc')
            ->where('jobStatus', 'published')
            ->where('jobCategoryId', $category_id) // Matching the category_id
            ->where('jobSlug', '!=', $slug)        // Exclude the current job
            ->get();

        return view('frontend.job-lists', compact('slug', 'categories', 'skills', 'jobs', 'relatedJobs', 'industries'));
    }
    public function jobDetail($slug)
    {
        $jobDetail = JobPost::with('jobCompany')->orderBy('created_at', 'desc')
            ->where('jobStatus', 'published')
            ->where('jobSlug', $slug)
            ->first();

        $jobDetail->increment('jobViewerCount');

        $categories = JobCategory::orderBy('created_at', 'desc')
            ->where('publishStatus', 1)
            ->get();

        $skills = JobPost::where('skills', '!=', '')
            ->where('jobStatus', 'published')
            ->pluck('skills') // Get all skill strings
            ->flatMap(function ($skills) {
                return array_map('trim', explode(',', $skills)); // Split into individual skills
            })
            ->unique()  // Remove duplicate skills
            ->values(); // Reindex collection

        $jobLocation = JobPost::where('jobLocation', '!=', '')
            ->where('jobStatus', 'published')
            ->pluck('jobLocation')
            ->unique();

        return view('frontend.job-details', compact('jobDetail', 'slug', 'categories', 'skills', 'jobLocation'));
    }

    public function jobSearch(Request $request)
    {
        // return $request;
        // $request->validate([
        //     'searchstr' => 'nullable|string',
        //     'location' => 'nullable|string',
        //     'searchcategoryid' => 'nullable',
        //     'jobsby'=>'nullable'
        // ]);

        // dd($request->all());

        $jobBy = $request->input('jobsby');
        if (! empty($jobBy)) {
            if ($jobBy == 'category') {
                $findJobs = JobPost::with('jobCompany')
                    ->orderBy('created_at', 'desc')
                    ->where('jobCategoryId', $request->input('searchcategoryid'))
                    ->where('jobStatus', 'published')
                    ->paginate(8);
            } elseif ($jobBy == 'skill') {
                $findJobs = JobPost::with('jobCompany')
                    ->orderBy('created_at', 'desc')
                    ->where('jobStatus', 'published')
                    ->where('skills', 'LIKE', "%{$request->input('searchstr')}%")
                    ->paginate(8);
            } else {
                $findJobs = JobPost::with('jobCompany')
                    ->orderBy('created_at', 'desc')
                    ->where('jobStatus', 'published')
                    ->paginate(8);
            }
            // return $request->input('searchcategoryid');
        } else {
            $findJobs = JobPost::with('jobCompany')
                ->orderBy('created_at', 'desc')
                ->where('jobStatus', 'published')
                ->where(function ($q) use ($request) {
                    $q->where('jobDescription', 'LIKE', "{$request->input('searchstr')}%")
                        ->orWhere('jobTitle', 'LIKE', "%{$request->input('searchstr')}%");
                })
                ->when(! empty($request->input('location')), function ($q) use ($request) {
                    return $q->where('jobLocation', 'LIKE', "%{$request->input('location')}%");
                })
                ->paginate(8);

        }

        $jobLocation = JobPost::where('jobLocation', '!=', '')
            ->where('jobStatus', 'published')
            ->pluck('jobLocation')
            ->unique();

        $categories = JobCategory::orderBy('created_at', 'desc')
            ->where('publishStatus', 1)
            ->get();

        $skills = JobPost::where('skills', '!=', '')
            ->where('jobStatus', 'published')
            ->pluck('skills') // Get all skill strings
            ->flatMap(function ($skills) {
                return array_map('trim', explode(',', $skills)); // Split into individual skills
            })
            ->unique()  // Remove duplicate skills
            ->values(); // Reindex collection
        $skillsChunks = $skills->chunk(ceil($skills->count() / 3));
        // $relatedJobs = JobPost::with('jobCompany')->orderBy('created_at', 'desc')
        //     ->where('jobStatus', 'published')
        //     ->where('jobCategoryId', $category_id) // Matching the category_id
        //     ->where('jobSlug', '!=', $slug) // Exclude the current job
        //     ->get();

        $prevquery = $request->input('searchstr') ?? '';

        $location = $request->input('location') ?? '';
        // return ($prevquery.$location);
        return view('frontend.job-lists', compact('categories', 'jobLocation', 'skills', 'findJobs', 'prevquery', 'location'));
        // return view('frontend.find-jobs', compact('findJobs', 'skills', 'categories','jobLocation'));

    }
    public function applyJob($slug)
    {
        $job_detail = JobPost::with('jobCompany')->where('jobSlug', $slug)->first();

        // $similar_jobs = JobPost::where('jobTitle', '=', $job_detail->jobTitle)
        //     ->where('id', '!=', $job_detail->id)  // Exclude the current job
        //     ->get();
        $category_id  = $job_detail->jobCategoryId;
        $similar_jobs = JobPost::with('jobCompany')->orderBy('created_at', 'desc')
            ->where('jobStatus', 'published')
            ->where('jobCategoryId', $category_id) // Matching the category_id
            ->where('jobSlug', '!=', $slug)        // Exclude the current job
            ->take(4)
            ->get();

        $categories = JobCategory::orderBy('created_at', 'desc')
            ->where('publishStatus', 1)
            ->get();

        $jobLocation = JobPost::where('jobLocation', '!=', '')
            ->where('jobStatus', 'published')
            ->pluck('jobLocation')
            ->unique();

        $skills = JobPost::where('skills', '!=', '')
            ->where('jobStatus', 'published')
            ->pluck('skills') // Get all skill strings
            ->flatMap(function ($skills) {
                return array_map('trim', explode(',', $skills)); // Split into individual skills
            })
            ->unique()  // Remove duplicate skills
            ->values(); // Reindex collection
                    // dd($similar_jobs);
        return view('frontend.apply', compact('job_detail', 'similar_jobs', 'categories','skills', 'jobLocation'));
    }

    public function bookmarkjob(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'jobSeekerId' => 'required|numeric',
                'jobPostId'   => 'required|numeric',
            ]);

            $existingBookmark = JobBookmark::where('jobSeekerId', $request->jobSeekerId)
                ->where('jobPostId', $request->jobPostId)
                ->first();

            if (! $existingBookmark) {
                $bookmark = JobBookmark::create([
                    'jobSeekerId' => $request->jobSeekerId,
                    'jobPostId'   => $request->jobPostId,
                ]);
            }

            if (! empty($bookmark)) {
                return redirect()->back()->with('success', 'Job Bookmark added successfully.');
            }
            return redirect()->back()->with('info', 'The post is already added to your jobs.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Some error occured!');
        }
    }

    public function newsAndBlogs()
    {
        $blogs = BlogsAndPodcast::where('blogOrPodcast', 'blog')
            ->where('publishStatus', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(8); // Show 6 blogs per page

        return view('frontend.blogs', compact('blogs'));
    }

    public function newsDetail($slug)
    {
        $news_detail = BlogsAndPodcast::where('slug', $slug)->first();

        $similar_news = BlogsAndPodcast::where('blogOrPodcast', $news_detail->blogOrPodcast)->where('slug', '!=', $slug)->orderBy('created_at', 'desc')->take(3)->get();

        return view('frontend.blog-details', compact('news_detail', 'similar_news'));
    }

    public function podcasts()
    {
        $podcasts = BlogsAndPodcast::where('blogOrPodcast', 'podcast')
            ->where('publishStatus', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(8); // Show 6 podcasts per page

        $podcasts->transform(function ($podcast) {

            $podcast->imageUrl = $podcast->imageUrl ? asset('storage/' . $podcast->imageUrl) : null;

            return $podcast;
        });
        // return ($podcasts);
        return view('frontend.podcastlist', compact('podcasts'));
    }

    public function podcastDetail($slug)
    {
        $podcast_detail = BlogsAndPodcast::where('slug', $slug)->first();

        $similar_podcasts = BlogsAndPodcast::where('blogOrPodcast', $podcast_detail->blogOrPodcast)->where('slug', '!=', $slug)->orderBy('created_at', 'desc')->take(3)->get();
        return view('frontend.podcastdetails', compact('podcast_detail', 'similar_podcasts'));
    }

    public function forex_calculator()
    {

        return view('frontend.ForexChanger.forex-calculator');
    }

    public function select_exchanger()
    {

        return view('frontend.ForexChanger.select-exchanger');
    }

    public function exchange_bank_details()
    {

        return view('frontend.ForexChanger.exchange-bank-detail');
    }

    public function visaHQ()
    {
        // Cache the country list for 24 hours
        // $countryLists = Cache::remember('visa_country_lists', 1440, function () {
        //     return VisaCountryList::where('publishStatus', 1)
        //         ->orderBy('countryName', 'asc')
        //         ->get();
        // });

        $countryLists = VisaCountryList::where('publishStatus', 1)
            ->orderBy('countryName', 'asc')
            ->get();

        $visaTypes = VisaType::where('publishStatus', 1)
            ->orderBy('visaTypeName', 'asc')
            ->get();

        return view('frontend.VisaHQ.visaHQ', compact('countryLists', 'visaTypes'));
    }

    public function visaDetails(Request $request)
    {

        // Validate the request
        $request->validate([
            'destination-country' => 'required',
            'visa-type'           => 'required',
        ]);

        $destinationCountry = $request->input('destination-country');
        $visaType           = $request->input('visa-type');

        $visaCountryId = VisaCountryList::where('slug', $destinationCountry)->value('id');
        $visaTypeId    = VisaType::where('slug', $visaType)->value('id');

        $citizenship = $request->citizenship;
        $passport    = $request->passport;
        $living      = $request->living;

        // Fetch visa details
        $fetchedData = VisaDetails::with('visaCountry', 'visaType')
            ->where('visaCountryId', $visaCountryId)
            ->where('visaTypeId', $visaTypeId)
            ->first();

        // Retrieve country lists and visa types again for re-rendering the form
        // $countryLists = Cache::remember('visa_country_lists', 1440, function () {
        //     return VisaCountryList::where('publishStatus', 1)
        //         ->orderBy('countryName', 'asc')
        //         ->get();
        // });
        $countryLists = VisaCountryList::where('publishStatus', 1)
            ->orderBy('countryName', 'asc')
            ->get();

        $visaTypes = VisaType::where('publishStatus', 1)
            ->orderBy('visaTypeName', 'asc')
            ->get();

        return view('frontend.VisaHQ.visaDetails', compact('fetchedData', 'countryLists', 'visaTypes', 'citizenship', 'passport', 'living'));
    }

    public function visaDetails_apply(Request $request)
    {
        $selectedData = $request->input('fetchData');
        return view('frontend.VisaHQ.apply', compact('selectedData'));
    }

    //for horoscope

    public function horoscope()
    {
        return view('frontend.horoscope.horoscope');
    }

    public function giftNcoupon(Request $request, $type = null, $giftCategoryId = null)
    {
        // return $giftCategoryId;
        $searchstr    = $request->query('searchstr', null);
        $country      = $request->query('country', null);
        $city         = $request->query('city', null);
        $giftNcoupons = GiftCoupon::when(
            in_array($type, ['1', '0']),
            fn($query) => $query->where('type', $type)
            )
            ->latest()
            ->when($giftCategoryId,
                fn($query) => $query->where('giftCategoryId', $giftCategoryId)
            )
            ->when(! empty($country), fn($query) => $query->where('country', 'LIKE', $country . '%'))
            ->when($city, fn($q) => $q->where('city', 'LIKE', $city . '%'))
            ->when($searchstr, fn($q) => $q->where('title', 'LIKE', $searchstr . '%'))
            ->where('publishStatus', 1)
            ->with('admin:id,fullName')
            ->paginate(8)
            ->withQueryString();

        $giftcategories = GiftCategory::where('publishStatus', 1)->get();

        $countries = GiftCoupon::distinct()->pluck('country');
        $cities    = GiftCoupon::distinct()->pluck('city');
        // dd($giftNcoupons);
        return view('frontend.giftNcoupon.home', compact(['giftcategories', 'type', 'giftNcoupons', 'giftCategoryId', 'searchstr', 'country', 'city', 'cities', 'countries']));
    }

    public function giftNcouponDescription(Request $request)
    {
        $id = $request->input('id');
        $giftNcoupon = GiftCoupon::with('admin:id,fullName')->find($id);

        $similarGifts = GiftCoupon::where('id', '!=', $id)
            ->with('admin:id,fullName')
            ->where('giftCategoryId', $giftNcoupon->giftCategoryId)
            ->latest()
            ->take(4)
            ->get();
        $giftComments = UserComment::with('jobSeeker:id,firstName,lastName,userThumbnail')
            ->where('giftCouponId', $id)
            ->latest()
            ->take(4)
            ->get();

            // $giftComments->transform(function ($giftComment) {

            //     if ($giftComment->jobSeeker && $giftComment->jobSeeker->userThumbnail) {

            //         $thumbnails = $giftComment->jobSeeker->userThumbnail[0];

            //         // $userThumbnail = asset('storage/'.$thumbnails);
            //         // return $userThumbnail;
            //         $giftComment->jobSeeker->userThumbnail = asset('storage/'.$thumbnails);

            //     }
            //     return $giftComment;
            // });

            $giftComments->transform(function ($giftComment) {
                if ($giftComment->jobSeeker && is_array($giftComment->jobSeeker->userThumbnail)) {
                    $thumbnails = $giftComment->jobSeeker->userThumbnail;

                    if (count($thumbnails) > 0) {
                        // Remove slashes if somehow they're still escaped (optional)
                        $path = str_replace('\\/', '/', $thumbnails[0]);

                        $giftComment->jobSeeker->userThumbnail = asset('storage/' . $path);
                    } else {
                        $giftComment->jobSeeker->userThumbnail = null;
                    }
                }

                return $giftComment;
            });

        return view('frontend.giftNcoupon.giftDescription', compact('giftNcoupon', 'similarGifts', 'giftComments'));

    }

    public function sellerProfile($id)
    {
        $seller      = Admin::where('id', $id)->first(['fullName', 'email', 'status']);
        $sellerGifts = GiftCoupon::where('adminId', $id)->take(8)->latest()->get();

        return view('frontend.giftNcoupon.sellerProfile', compact(['seller', 'sellerGifts']));

    }

    public function resumeHelp()
    {
        return view('frontend.resume.index');
    }

    public function discussionForum(Request $request){

        $searchstr    = $request->query('searchstr', null);
        $category      = $request->query('category', null);

        // return $request;
        // return $request;
        

        $forumPosts = DiscussionForum::with('jobSeeker:id,firstName,lastName,temporaryLocation,userThumbnail')
            ->when(
                in_array($category, ['other', 'education', 'investment', 'scammer', 'office']),
                fn($query) => $query->where('category', $category)
            )
            ->when(
                $searchstr,
                fn($query) => $query->where('topic', 'LIKE', $searchstr . '%')
                                    ->orWhere('description', 'LIKE', $searchstr . '%')
            )
            ->latest()
            ->get();
        
        $forumPosts->transform(function ($forumPost) {
            if ($forumPost->jobSeeker && is_array($forumPost->jobSeeker->userThumbnail)) {
                $thumbnails = $forumPost->jobSeeker->userThumbnail;

                if (count($thumbnails) > 0) {
                    // Remove slashes if somehow they're still escaped (optional)
                    $path = str_replace('\\/', '/', $thumbnails[0]);

                    $forumPost->jobSeeker->userThumbnail = asset('storage/' . $path);
                } else {
                    $forumPost->jobSeeker->userThumbnail = null;
                }
            }

            $imagePaths = $forumPost->images ? $forumPost->images : [];
            $imageLinks = array_map(function ($path) {
                return asset('storage/' . $path);
            }, $imagePaths);
            

            $forumPost->images = $imageLinks;

            return $forumPost;
        });

        
        return view('frontend.discussion.index',compact('forumPosts'));
    }

    public function advertisements(){
          // Fetch unique categories under the given type
  $ads =Advertisement::all();
    $all = AdvertisementCategory::all();
    $category = AdvertisementCategory::all();
    $categories = AdvertisementCategory::all();
    return view('frontend.advertisements.index', compact('all','category','ads','categories'))
    ->with('success', 'Advertisements retrieved successfully!');    }

}
