<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Advertisement;
use App\Models\AdvertisementCategory;
use App\Models\BlogsAndPodcast;
use App\Models\DiscussionForum;
use App\Models\Follower;
use App\Models\ForumInteraction;
use App\Models\GiftCategory;
use App\Models\GiftCoupon;
use App\Models\IndustryCategory;
use App\Models\JobCategory;
use App\Models\JobPost;
use App\Models\JobSeeker;
use App\Models\ResumeHelp;
use App\Models\UserComment;
use App\Models\GiftCart;
use App\Models\VisaCountryList;
use App\Models\VisaType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FrontendAPIController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // public function index(Request $request)
    // {

    //     $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
    //     Log::info('Frontend API accessed');
    //     try {
    //         $findJobs = JobPost::with('jobCompany')
    //             ->where('jobStatus', 'published')
    //             ->orderBy('created_at', 'desc')
    //             ->take(8)
    //             ->get();

    //         $categories = JobCategory::where('publishStatus', 1)
    //             ->orderBy('created_at', 'desc')
    //             ->get();

    //         $blogs = BlogsAndPodcast::where('blogOrPodcast', 'blog')
    //             ->where('publishStatus', 1)
    //             ->orderBy('created_at', 'desc')
    //             ->take(8)
    //             ->get();

    //         $podcasts = BlogsAndPodcast::where('blogOrPodcast', 'podcast')
    //             ->where('publishStatus', 1)
    //             ->orderBy('created_at', 'desc')
    //             ->take(8)
    //             ->get();

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Data fetched successfully',
    //             'data' => [
    //                 'findJobs' => $findJobs,
    //                 'categories' => $categories,
    //                 'blogs' => $blogs,
    //                 'podcasts' => $podcasts
    //             ]
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Failed to fetch data',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function index(Request $request)
    {
        // Check if the request is from mobile
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        if (! $isMobile) {
            return response()->json([
                'status'  => false,
                'message' => 'This endpoint is for mobile requests only.',
            ], 400);
        }

                                            // Check if the user is logged in (authenticated)
        $isAuthenticated = auth()->check(); // This checks if the user is authenticated

        if ($isAuthenticated) {
            // Get 'whoAmI' from request (default to 'student' if not provided)
            $user   = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
            $whoAmI = $user->whoAmI;
            Log::info('Authenticated Job Seeker whoAmI: ' . $user->whoAmI);

            // Define allowed job types based on whoami
            $allowedJobTypes = match ($whoAmI) {
                'student' => ['trainee', 'parttime'],
                'worker' => ['fulltime', 'parttime'],
                'consultant' => ['fulltime', 'parttime'],
                default => []// If 'whoami' is not recognized, return an empty list
            };

            // Fetch jobs based on allowed job types for authenticated users
            $findJobs = JobPost::select('job_posts.*', 'job_companies.companyProfileImg', 'companyName')
                ->join('job_companies', 'job_companies.id', '=', 'job_posts.jobCompanyId') // Inner join
                ->whereIn('jobType', $allowedJobTypes)
                ->where('jobStatus', 'published')
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();
        } else {
            // For non-authenticated users, allow all job types to be visible
            $findJobs = JobPost::select('job_posts.*', 'job_companies.companyProfileImg', 'companyName')
                ->join('job_companies', 'job_companies.id', '=', 'job_posts.jobCompanyId') // Inner join
                                                                                       // ->whereIn('jobType', $allowedJobTypes)
                ->where('jobStatus', 'published')
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();
        }

        // Fetch industries
        $industries = IndustryCategory::all();

        // Load Home Page Data
        $blogs = BlogsAndPodcast::where('blogOrPodcast', 'blog')
            ->where('publishStatus', 1)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $podcasts = BlogsAndPodcast::where('blogOrPodcast', 'podcast')
            ->where('publishStatus', 1)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $giftNcoupon = GiftCoupon::orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Fetch ads and categories
        $ads = Advertisement::orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $adsCategory = AdvertisementCategory::all();

        $categories = JobCategory::where('publishStatus', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        // Mobile API Response
        return response()->json([
            'status'  => true,
            'message' => 'Home data retrieved successfully.',
            'data'    => [
                'blogs'       => $blogs,
                'podcasts'    => $podcasts,
                'findJobs'    => $findJobs,
                'ads'         => $ads,
                'adsCategory' => $adsCategory,
                'categories'  => $categories,
                'industries'  => $industries,
                'giftNcoupon' => $giftNcoupon,
            ],
        ], 200);
    }

    public function findJobs(Request $request)
    {

        $whoAmI = $request->whoAmI;

        // Define allowed job types based on whoAmI
        $allowedJobTypes = match ($whoAmI) {
            'student' => ['trainee', 'parttime'],
            'worker' => ['fulltime', 'parttime'],
            'consultant' => ['fulltime', 'parttime'],
            default => ['user']// If 'whoAmI' is not recognized, return an empty list
        };

        if (empty($allowedJobTypes)) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid role specified.',
                'data'    => null,
            ], 400);
        }

        // $query = JobPost::orderBy('created_at', 'desc')
        //     ->where('jobStatus', 'published');

        $query = JobPost::select('job_posts.*', 'job_companies.companyProfileImg', 'companyName')
            ->join('job_companies', 'job_companies.id', '=', 'job_posts.jobCompanyId') // Inner join
            ->orderBy('job_posts.created_at', 'desc')
            ->where('job_posts.jobStatus', 'published');

        // Apply filters only if parameters are present
        if ($request->has('jobCategoryId') && ! empty($request->jobCategoryId)) {
            $query->where('jobCategoryId', $request->jobCategoryId);
        }

        if ($request->has('jobLocation') && ! empty($request->jobLocation)) {
            $query->where('jobLocation', $request->jobLocation);
        }

        if ($request->has('skills') && ! empty($request->skills)) {
            $query->where('skills', 'like', "%{$request->skills}%");
        }

        if ($request->has('jobSlug') && ! empty($request->jobSlug)) {
            $query->where('jobSlug', $request->jobSlug);
        }

        // Fetch only 10 records
        $findJobs = $query->take(10)->get()->transform(function ($job) {
            return collect($job)->except(['jobBanner'])->merge([
                'image_url'    => $job->jobBanner ? asset($job->jobBanner) : null,
                'company_name' => $job->jobCompany ? $job->jobCompany->companyName : null,
            ]);
        });

        $categories = JobCategory::where('publishStatus', 1)->orderBy('created_at', 'desc')->get();

        // Fetch job locations and skills
        $jobLocation = JobPost::where('jobLocation', '!=', '')
            ->where('jobStatus', 'published')
            ->pluck('jobLocation')
            ->unique();

        $skills = JobPost::whereNotNull('skills')
            ->where('skills', '!=', '')
            ->where('jobStatus', 'published')
            ->distinct()
            ->pluck('skills');

        // Fetch industries
        $industries = IndustryCategory::all();

        // Return the filtered data as a JSON response
        return response()->json([
            'status'  => true,
            'message' => 'Jobs retrieved successfully.',
            'data'    => [
                'categories'  => $categories,
                'skills'      => $skills,
                'jobs'        => $findJobs,
                'jobLocation' => $jobLocation,
                'industries'  => $industries,
            ],
        ], 200);
    }

    public function jobLists(Request $request, $slug = null)
    {
        // Check if the request is from mobile
        if (! $request->has('request_type') || $request->input('request_type') !== 'mobile') {
            return response()->json([
                'status'  => false,
                'message' => 'This endpoint is for mobile requests only.',
            ], 400);
        }

                                                    // Get the authenticated user for mobile request
        $user   = $request->user();                 // Assuming the user is authenticated for mobile requests
        $whoAmI = $user ? $user->whoAmI : 'worker'; // Default to 'student' if no user found

        Log::info('Authenticated User whoAmI: ' . $whoAmI);

        // Define allowed job types based on whoAmI
        $allowedJobTypes = match ($whoAmI) {
            'student' => ['trainee', 'parttime'],
            'worker' => ['fulltime', 'parttime'],
            'consultant' => ['fulltime', 'parttime'],
            default => ['user']// If 'whoAmI' is not recognized, return an empty list
        };

        // If there are no allowed job types, return an error
        if (empty($allowedJobTypes)) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid role specified.',
                'data'    => null,
            ], 400);
        }

        // Fetch the job listing based on the slug (this is the main job page)
        $jobs = JobPost::with('jobCompany')->orderBy('created_at', 'desc')
            ->where('jobStatus', 'published')
            ->where('jobSlug', $slug)
            ->whereIn('jobType', $allowedJobTypes) // Apply job type filtering based on whoAmI

            ->first();

        // If the job does not exist, return an error
        if (! $jobs) {
            return response()->json([
                'status'  => false,
                'message' => 'Job not found.',
                'data'    => null,
            ], 404);
        }

        // Fetch job categories
        $categories = JobCategory::orderBy('created_at', 'desc')
            ->where('publishStatus', 1)
            ->get();

        // Fetch unique skills from job posts
        $skills = JobPost::where('skills', '!=', '')
            ->where('jobStatus', 'published')
            ->pluck('skills')
            ->unique();

                                             // Fetch jobs in the same category as the current job (excluding the current job itself)
        $category_id = $jobs->jobCategoryId; // Assuming `category_id` is the field
        $relatedJobs = JobPost::with('jobCompany')->orderBy('created_at', 'desc')
            ->where('jobStatus', 'published')
            ->where('jobCategoryId', $category_id) // Matching the category_id
            ->where('jobSlug', '!=', $slug)        // Exclude the current job
            ->whereIn('jobType', $allowedJobTypes) // Apply job type filtering based on whoAmI
            ->get();

        // Return the view for mobile users with all necessary data
        return response()->json([
            'status'  => true,
            'message' => 'Job data retrieved successfully.',
            'data'    => [
                'slug'        => $slug,
                'categories'  => $categories,
                'skills'      => $skills,
                'jobs'        => $jobs,
                'relatedJobs' => $relatedJobs,
            ],
        ], 200);
    }

    public function jobDetail(Request $request, $slug)
    {
        // Check if the request is from mobile
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        if (! $isMobile) {
            return response()->json([
                'status'  => false,
                'message' => 'This endpoint is for mobile requests only.',
            ], 400);
        }

        // Fetch the job details based on the slug
        $jobDetail = JobPost::with('jobCompany')
            ->where('jobStatus', 'published')
            ->where('jobSlug', $slug)
            ->first();

        // If the job does not exist, return a 404 error response
        if (! $jobDetail) {
            return response()->json([
                'status'  => false,
                'message' => 'Job not found.',
            ], 404);
        }

        // Increment the job viewer count
        $jobDetail->increment('jobViewerCount');

        // Fetch job categories that are published
        $categories = JobCategory::orderBy('created_at', 'desc')
            ->where('publishStatus', 1)
            ->get();

        // Fetch unique skills from job posts
        $skills = JobPost::where('skills', '!=', '')
            ->where('jobStatus', 'published')
            ->pluck('skills')
            ->unique();

        // Fetch unique job locations
        $jobLocation = JobPost::where('jobLocation', '!=', '')
            ->where('jobStatus', 'published')
            ->pluck('jobLocation')
            ->unique();

        // Return mobile-friendly JSON response
        return response()->json([
            'status'  => true,
            'message' => 'Job details retrieved successfully.',
            'data'    => [
                'jobDetail'   => $jobDetail,
                'categories'  => $categories,
                'skills'      => $skills,
                'jobLocation' => $jobLocation,
            ],
        ], 200);
    }

    public function applyJob(Request $request, $slug = null)
    {
        // Check if the request is from mobile
        // $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // if (!$isMobile) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'This endpoint is for mobile requests only.'
        //     ], 400);
        // }

        // Get the authenticated user
        $user   = $request->user();
        $whoAmI = $user ? $user->whoAmI : 'worker'; // Default to 'worker' if user is not authenticated

        // Define allowed job types based on whoAmI
        $allowedJobTypes = match ($whoAmI) {
            'student' => ['trainee', 'parttime'],
            'worker' => ['fulltime', 'parttime'],
            'consultant' => ['fulltime', 'parttime'],
            default => ['user']// If 'whoAmI' is not recognized, return an empty list
        };
        // Check if the job exists
        $job_detail = JobPost::with('jobCompany')->where('jobSlug', $slug)->first();

        if (! $job_detail) {
            return response()->json([
                'status'  => false,
                'message' => 'Job not found',
            ], 404);
        }

        // Get job locations and similar jobs based on the job title
        $jobLocation = JobPost::where('jobLocation', '!=', '')
            ->where('jobStatus', 'published')
            ->pluck('jobLocation')
            ->unique();

        // Fetch similar jobs based on the job title, excluding the current job
        $similar_jobs = JobPost::where('jobTitle', $job_detail->jobTitle)
            ->where('id', '!=', $job_detail->id)
            ->whereIn('jobType', $allowedJobTypes) // Filter based on allowed job types

            ->get();
        // If no similar jobs are found, provide a message, but still show other items
        if ($similar_jobs->isEmpty()) {
            $similar_jobs_message = 'No similar jobs found.';
        } else {
            $similar_jobs_message = 'Similar jobs found.';
        }

        // Fetch job categories and skills
        $categories = JobCategory::orderBy('created_at', 'desc')
            ->where('publishStatus', 1)
            ->get();

        $jobcategories = JobCategory::orderBy('created_at', 'desc')->get();

        $skills = JobPost::where('skills', '!=', '')
            ->where('jobStatus', 'published')
            ->pluck('skills')
            ->unique();

        // Return data as a mobile-friendly JSON response
        return response()->json([
            'status'  => true,
            'message' => 'Job details and similar jobs fetched successfully.',
            'data'    => [
                'jobDetail'     => $job_detail,
                'similarJobs'   => $similar_jobs,
                'categories'    => $categories,
                'jobCategories' => $jobcategories,
                'skills'        => $skills,
                'jobLocation'   => $jobLocation,
            ],
        ], 200);
    }

    public function jobSearch(Request $request)
    {
        // Check if the request is from mobile
        // $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // if (!$isMobile) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'This endpoint is for mobile requests only.'
        //     ], 400);
        // }

        // Get the authenticated user
        $user   = $request->user();
        $whoAmI = $user ? $user->whoAmI : 'worker'; // Default to 'worker' if user is not authenticated

        // Define allowed job types based on whoAmI
        $allowedJobTypes = match ($whoAmI) {
            'student' => ['trainee', 'parttime'],
            'worker' => ['fulltime', 'parttime'],
            'consultant' => ['fulltime', 'parttime'],
            default => ['user']// If 'whoAmI' is not recognized, return an empty list
        };

        // Fetch jobs
        $jobs = JobPost::with('jobCompany');

        // Apply job types filter based on whoAmI
        if ($allowedJobTypes) {
            $jobs = $jobs->whereIn('jobType', $allowedJobTypes);
        }

                                            // Apply other filters as needed
        $jobBy = $request->input('jobsby'); // If you still want to use 'jobsby' filter

        if ($request->filled('jobIndustry') && $request->filled('jobLocation')) {
            // Strict Industry + Location filtering
            $jobs = $jobs->whereHas('jobCompany.industryCategory', function ($q) use ($request) {
                $q->where('industryName', 'LIKE', "%{$request->input('jobIndustry')}%");
            })
                ->where('jobLocation', 'LIKE', "%{$request->input('jobLocation')}%");
        } elseif ($jobBy == 'category' && $request->filled('searchcategoryid')) {
            // Strict category-based filtering
            $jobs = $jobs->where('jobCategoryId', $request->input('searchcategoryid'));
        } elseif ($jobBy == 'skill' && $request->filled('searchstr')) {
            // Strict skill-based filtering
            $jobs = $jobs->where('skills', 'LIKE', "%{$request->input('searchstr')}");
        } elseif ($jobBy == 'location' && $request->filled('location')) {
            // Strict location-based filtering
            $jobs = $jobs->where('jobLocation', 'LIKE', "%{$request->input('location')}%");
        }

        // Order the jobs
        $jobs = $jobs->orderBy('created_at', 'desc')->get();

        // Additional data for the response
        $jobLocation = JobPost::where('jobLocation', '!=', '')
            ->where('jobStatus', 'published')
            ->pluck('jobLocation')
            ->unique();

        $skills = JobPost::where('skills', '!=', '')
            ->where('jobStatus', 'published')
            ->pluck('skills')
            ->unique();

        $categories = JobCategory::where('publishStatus', 1)->orderBy('created_at', 'desc')->get();
        $industries = IndustryCategory::all();

        // Return the response as JSON for mobile
        return response()->json([
            'status'  => true,
            'message' => 'Job search results fetched successfully.',
            'data'    => [
                'categories'  => $categories,
                'skills'      => $skills,
                'jobs'        => $jobs,
                'jobLocation' => $jobLocation,
                'industries'  => $industries,
            ],
        ], 200);
    }

    //for search bar
    public function Search(Request $request)
    {

        // return $request->all();
        // Check if the request is from mobile
        // $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // if (!$isMobile) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'This endpoint is for mobile requests only.'
        //     ], 400);
        // }

        // Get the authenticated user
        // $user =  $request->user();
        // $whoAmI = $user ? $user->whoAmI : 'worker'; // Default to 'worker' if user is not authenticated

        $whoAmI = $request->whoAmI;

        // Define allowed job types based on whoAmI
        $allowedJobTypes = match ($whoAmI) {
            'student' => ['trainee', 'parttime'],
            'worker' => ['fulltime', 'parttime'],
            'consultant' => ['fulltime', 'parttime'],
            default => ['user']// If 'whoAmI' is not recognized, return an empty list
        };

        // Fetch job categories
        $categories = JobCategory::where('publishStatus', 1)->orderBy('created_at', 'desc')->get();

        // Fetch job locations and skills
        $jobLocation = JobPost::where('jobLocation', '!=', '')
            ->where('jobStatus', 'published')
            ->pluck('jobLocation')
            ->unique();

        $skills = JobPost::whereNotNull('skills')
            ->where('skills', '!=', '')
            ->where('jobStatus', 'published')
            ->distinct()
            ->pluck('skills');

        // Fetch industries
        $industries = IndustryCategory::all();

        // $query = JobPost::orderBy('created_at', 'desc')
        //     ->where('jobStatus', 'published')

        $query = JobPost::select('job_posts.*', 'job_companies.companyProfileImg', 'companyName')
            ->join('job_companies', 'job_companies.id', '=', 'job_posts.jobCompanyId') // Inner join
            ->orderBy('job_posts.created_at', 'desc')
            ->where('job_posts.jobStatus', 'published')
            ->when(! empty($allowedJobTypes), function ($query) use ($allowedJobTypes) {
                return $query->whereIn('jobType', $allowedJobTypes);
            })
            ->when($request->search_keyword, function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('jobTitle', 'LIKE', "%{$request->search_keyword}%")
                        ->orWhere('jobDescription', 'LIKE', "%{$request->search_keyword}%")
                        ->orWhere('skills', 'LIKE', "%{$request->search_keyword}%");
                });
            });

        // Apply filters only if parameters are present
        if ($request->has('jobCategoryId') && ! empty($request->jobCategoryId)) {
            $query->where('jobCategoryId', $request->jobCategoryId);
        }

        if ($request->has('jobLocation') && ! empty($request->jobLocation)) {
            $query->where('jobLocation', $request->jobLocation);
        }

        if ($request->has('skills') && ! empty($request->skills)) {
            $query->where('skills', 'like', "%{$request->skills}%");
        }

        if ($request->has('jobSlug') && ! empty($request->jobSlug)) {
            $query->where('jobSlug', $request->jobSlug);
        }

        // Fetch only 10 records
        $findJobs = $query->take(10)->get()->transform(function ($job) {
            return collect($job)->except(['jobBanner'])->merge([
                'image_url'    => $job->jobBanner ? asset($job->jobBanner) : null,
                'company_name' => $job->jobCompany ? $job->jobCompany->companyName : null,
            ]);
        });
        // Return the response
        return response()->json([
            'status'  => true,
            'message' => 'Job search results fetched successfully.',
            'data'    => [
                'categories'  => $categories,
                'skills'      => $skills,
                'jobs'        => $findJobs,
                'jobLocation' => $jobLocation,
                'industries'  => $industries,
            ],
        ], 200);
    }

    public function allblogs(Request $request)
    {
        try {
            $blogs = BlogsAndPodcast::where('blogOrPodcast', 'blog')
                ->where('publishStatus', 1)
                ->orderBy('created_at', 'desc')
                ->get();
            $blogs->transform(function ($blog) {

                $blog->imageUrl = $blog->imageUrl ? asset('storage/' . $blog->imageUrl) : null;

                return $blog;
            });
            return response()->json([
                'status'  => true,
                'message' => 'Data fetched successfully',
                'data'    => $blogs,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to fetch data',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function blogDetail(Request $request, $id)
    {
        try {
            $blog = BlogsAndPodcast::where('id', $id)
                ->where('blogOrPodcast', 'blog')
                ->first();
            if ($blog == null) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Blog not found',
                ]);
            }
            $blog->imageUrl = $blog->imageUrl ? asset('storage/' . $blog->imageUrl) : null;
            return response()->json([
                'status'  => true,
                'message' => 'Data fetched successfully',
                'data'    => $blog,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to fetch data',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function allpodcasts(Request $request)
    {
        try {
            $podcasts = BlogsAndPodcast::where('blogOrPodcast', 'podcast')
                ->where('publishStatus', 1)
                ->orderBy('created_at', 'desc')
                ->get();
            $podcasts->transform(function ($podcast) {

                $podcast->imageUrl = $podcast->imageUrl ? asset('storage/' . $podcast->imageUrl) : null;

                return $podcast;
            });
            return response()->json([
                'status'  => true,
                'message' => 'Data fetched successfully',
                'data'    => $podcasts,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to fetch data',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function podcastDetail(Request $request, $id)
    {
        try {
            $podcast = BlogsAndPodcast::where('id', $id)
                ->where('blogOrPodcast', 'podcast')
                ->first();

            if ($podcast == null) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Podcast not found',
                ]);
            }
            $podcast->imageUrl = $podcast->imageUrl ? asset('storage/' . $podcast->imageUrl) : null;
            return response()->json([
                'status'  => true,
                'message' => 'Data fetched successfully',
                'data'    => $podcast,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to fetch data',
                'error'   => $e->getMessage() ?? $e->getMessage(),
            ], 500);
        }
    }

    public function categories(Request $request)
    {
        try {
            $categories = JobCategory::where('publishStatus', 1)
                ->orderBy('created_at', 'desc')
                ->get();
            return response()->json([
                'status'  => true,
                'message' => 'Data fetched successfully',
                'data'    => $categories,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to fetch data',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
    public function getVisaHQ(Request $request)
    {
        try {
            $visaCountries = VisaCountryList::where('publishStatus', 1)
                ->orderBy('countryName', 'asc')
                ->get();

            $visaTypes = VisaType::where('publishStatus', 1)
                ->orderBy('visaTypeName', 'asc')
                ->get();

            return response()->json([
                'status'  => true,

                'message' => 'Data fetched successfully',
                'data'    => [
                    'visaCountries' => $visaCountries,
                    'visaTypes'     => $visaTypes,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to fetch data',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function giftNcoupon(Request $request, $type = null, $giftCategoryId = null)
    {
        // return $giftCategoryId;

        try {

            $searchstr    = $request->query('searchstr', null);
            $country      = $request->query('country', null);
            $city         = $request->query('city', null);
            $giftNcoupons = GiftCoupon::when(
                in_array($type, ['1', '0']),
                fn($query) => $query->where('type', $type)
            )
                ->latest()
                ->when(
                    $giftCategoryId,
                    fn($query) => $query->where('giftCategoryId', $giftCategoryId)
                )
                ->when(! empty($country), fn($query) => $query->where('country', 'LIKE', $country . '%'))
                ->when($city, fn($q) => $q->where('city', 'LIKE', $city . '%'))
                ->when($searchstr, fn($q) => $q->where('title', 'LIKE', $searchstr . '%'))
                ->where('publishStatus', 1)
                ->with('admin:id,fullName')
                ->paginate(8)
                ->withQueryString();

            $categories     = [];
            $giftcategories = GiftCategory::where('publishStatus', 1)->get();
            $categories[]   = ['id' => 0, 'giftCategoryTitle' => 'All'];
            foreach ($giftcategories as $category) {
                $categories[] = $category;
            }

            $giftNcoupons->transform(function ($giftNcoupon) use($request) {
                $giftNcoupon->thumbnail = $giftNcoupon->thumbnail ? asset('storage/' . $giftNcoupon->imageUrl) : null;
                $giftNcoupon->in_cart = GiftCart::where('coupon_id', $giftNcoupon->id)->where('jobSeekerId', $request->user()->id)->exists() ;
                return $giftNcoupon;
            });

            // $giftcategories = ['id'=> 0,'giftCategoryTitle' => 'all'];
            // $giftcategories['all_categories'] = 'all';

            // foreach ($categories as $category) {
            //     $giftcategories[$category->id] = $category->giftCategoryTitle;
            // }

            $countries = GiftCoupon::distinct()->pluck('country');
            $cities    = GiftCoupon::distinct()->pluck('city');
            return response()->json([
                'status'  => true,
                'message' => 'Data fetched successfully',
                'data'    => [
                    'giftNcoupons' => $giftNcoupons,
                    'categories'   => $categories,
                    'countries'    => $countries,
                    'cities'       => $cities,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to fetch data',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function giftComments($id)
    {
        try {
            $giftComments = UserComment::with('jobSeeker:id,firstName,lastName,userThumbnail')
                ->where('giftCouponId', $id)
                ->orderBy('created_at', 'asc')
                ->get();

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
            return response()->json([
                'status'  => true,
                'message' => 'Data fetched successfully',
                'data'    => $giftComments,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to fetch data',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function giftNcouponDescription($id)
    {

        try {
            $giftNcoupon = GiftCoupon::find($id);

            $similarGifts = GiftCoupon::where('id', '!=', $id)
                ->with('admin:id,fullName')
                ->where('giftCategoryId', $giftNcoupon->giftCategoryId)
                ->latest()
                ->take(4)
                ->get();

            $giftComments = UserComment::with('jobSeeker:id,firstName,lastName,userThumbnail')
                ->where('giftCouponId', $id)
                ->latest()
                ->get();

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

            return response()->json([
                'status'  => true,
                'message' => 'Data fetched successfully',
                'data'    => [
                    'giftNcoupons' => $giftNcoupon,
                    'similarGifts' => $similarGifts,
                    'giftComments' => $giftComments,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to fetch data',
                'error'   => $e->getMessage(),
            ], 500);
        }

        // return $giftNcoupon;

    }

    public function sellerProfile($id, $type = null)
    {
        try {

            $seller = Admin::where('id', $id)->first(['id', 'fullName', 'email', 'status', 'profile_image', 'location', 'created_at']);

            $sellerGifts = GiftCoupon::where('adminId', $id)
                ->when(
                    in_array($type, ['1', '0']),
                    fn($query) => $query->where('type', $type)
                )
                ->orderBy('created_at', 'desc')
                ->take(8)->get();
            
            $seller->profile_image = $seller->profile_image ? asset('storage/' . $seller->profile_image) : asset('frontend/assets/Images/profile-icon.png');

            $sellerGifts->transform(function ($gift) {
                $gift->thumbnail = $gift->thumbnail ? asset('storage/' . $gift->thumbnail) : null;
                return $gift;
            });

            return response()->json([
                'status'  => true,
                'message' => 'Data fetched successfully',
                'data'    => [
                    'seller'       => $seller,
                    'seller_gifts' => $sellerGifts,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to fetch data',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function resumeHelp()
    {
        // return view('frontend.resume.index');
        return response()->json(ResumeHelp::all());
    }

    public function discussionForum(Request $request)
    {
        try {

            $searchstr = $request->query('searchstr', null);
            $category  = $request->query('category', null);

            $forumPosts = DiscussionForum::with('jobSeeker:id,firstName,lastName,temporaryLocation,userThumbnail')
                ->withCount(['forumInteraction as likes' => function ($query) {
                    $query->where('type', 'like');
                }])
                ->withCount(['forumInteraction as dislikes' => function ($query) {
                    $query->where('type', 'dislike');
                }])
                ->withCount('forumComment as comments')
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
            // return $forumPosts;

            $forumPosts->transform(function ($forumPost) use ($request) {
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

                $forumPost->followed = Follower::where('followed_to', $forumPost->jobSeeker->id)->where('followed_by', $request->user()->id)->exists();

                $forumPost->interaction = ForumInteraction::where('forum_id', $forumPost->id)->where('jobSeekerId', $request->user()->id)->first();

                return $forumPost;
            });

            return response()->json([
                'status'  => true,
                'message' => 'Data fetched successfully',
                'data'    => $forumPosts,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to fetch data',
                'error'   => $e->getMessage(),
            ], 500);
        }

    }

    public function forumProfile(Request $request, $id)
    {

        try {
            $profile = JobSeeker::select('id', 'firstName', 'lastName', 'temporaryLocation', 'userThumbnail')
                ->where('id', $id)
                ->with(['discussionForum' => function ($query) {
                    $query->orderBy('pinned', 'desc');
                    $query->orderBy('created_at', 'desc');
                }])

                ->first();

            $profile->userThumbnail ? $profile->userThumbnail = asset('storage/' . $profile->userThumbnail[0]) : null;
            $profile->postCount                               = $profile->discussionForum->count();
            $profile->followers                               = Follower::where('followed_to', $profile->id)->count();
            $profile->followings                              = Follower::where('followed_by', $profile->id)->count();
            $profile->followed                                = Follower::where('followed_to', $profile->id)->where('followed_by', $request->user()->id)->exists();

            if ($profile->postCount > 0) {

                $profile->discussionForum->transform(function ($forumPost) use ($request) {
                    $imagePaths = $forumPost->images ? $forumPost->images : [];
                    $imageLinks = array_map(function ($path) {
                        return asset('storage/' . $path);
                    }, $imagePaths);

                    $forumPost->images = $imageLinks;

                    $forumPost->interaction = ForumInteraction::where('forum_id', $forumPost->id)->where('jobSeekerId', $request->user()->id)->first();

                    $forumPost->likes    = $forumPost->forumInteraction->where('type', 'like')->count();
                    $forumPost->dislikes = $forumPost->forumInteraction->where('type', 'dislike')->count();
                    $forumPost->comments = $forumPost->forumComment->count();

                    return $forumPost;
                });

            }

            return response()->json([
                'status'  => true,
                'message' => 'Data fetched successfully!',
                'data'    => $profile,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to fetch data',
                'error'   => $e->getMessage(),
            ], 500);
        }

    }

    public function getResumeHelp(){
        try {
            $freeResume = ResumeHelp::where('type', 0)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

            $freeResume->transform(function ($resume) {
                $resume->image_preview = asset('storage/' . $resume->image_preview);
                return $resume;
            });

            return response()->json([
                'status'  => true,
                'message' => 'Data fetched successfully!',
                'data'    => $freeResume,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to fetch data',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

}
