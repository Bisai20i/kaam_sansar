<?php
namespace App\Http\Controllers;

use App\Models\AdsManager;
use App\Models\Advertisement;
use App\Models\AdvertisementCategory;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isMobile = request()->has('request_type') && request()->input('request_type') === 'mobile';

        // Simple Pagination for Ads
        $ads = Advertisement::orderBy('created_at', 'desc')->paginate(8);

        // Transform only the collection part without breaking pagination
        if ($isMobile) {
            $ads->getCollection()->transform(function ($ad) {
                $ad->image_url = $ad->adsThumbnail ? asset($ad->adsThumbnail) : null;
                return $ad;
            });
        }

        $category   = AdvertisementCategory::all();
        $categories = AdvertisementCategory::all();
        $all        = AdvertisementCategory::all();

        $post    = Advertisement::all();
        $adTypes = $this->getEnumValues('advertisements', 'type');
        if ($isMobile) {
            return response()->json([
                'status'     => true,
                'message'    => 'Advertisements fetched successfully.',
                'data'       => [
                    'ads'        => $ads,
                    'categories' => AdvertisementCategory::all(),
                    'adsTypes'   => $this->getEnumValues('advertisements', 'type'),
                ],
                'pagination' => [
                    'current_page'  => $ads->currentPage(),
                    'next_page_url' => $ads->nextPageUrl(),
                    'prev_page_url' => $ads->previousPageUrl(),
                    'per_page'      => $ads->perPage(),
                ],
            ]);
        }

        // For web, load everything needed
        $category          = AdvertisementCategory::all();
        $categories        = AdvertisementCategory::all();
        $all               = AdvertisementCategory::all();
        $post              = Advertisement::all();
        $ad                = Advertisement::all();
        $adTypes           = $this->getEnumValues('advertisements', 'type');
        $ad_banners        = [];
        $ad_banners['top'] = AdsManager::where('which_page', 'advertisement')
            ->where('publish_or_not', 1)
            ->where('active', 1)
            ->where('position', 'top')
            ->first();

        if ($ad_banners) {
            $ad_banners['top'] ? $ad_banners['top']->image = asset('storage/' . $ad_banners['top']->image) : null;
            return view('frontend.advertisements.index', compact('ads', 'category', 'post', 'all', 'categories', 'ad'));

        }

        return view('frontend.advertisements.index', compact('ads', 'category', 'post', 'all', 'categories', 'ad', 'ad_banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // redirect to ads created
        $categories = AdvertisementCategory::all();

        return view('backend.advertisement.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Log all incoming request data
        Log::info('Incoming request data:', $request->all());

        // Check if the request is from mobile using request_type
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Get the authenticated user
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

        if (! $user) {
            return $isMobile
            ? $this->responseError('Unauthorized', 401)
            : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        Log::info('Authenticated Job Seeker ID: ' . $user->id);

        $jobSeekerId = $user->id;

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'adsTitle'       => 'required|string|max:255',
            'adsCategoryId'  => 'nullable',
            'type'           => 'nullable',
            'location'       => 'required|string|max:255',
            'country'        => 'nullable|string|max:255',
            'adsDescription' => 'required|string|max:100000',
            'adsOwner'       => 'nullable|string|max:255',
            'adsThumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'adsOwnerImg'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pricing'        => 'required|numeric',
            'status'         => 'nullable|string|max:255',
            'publishStatus'  => 'nullable|string|max:255',
            'contactNumber'  => 'nullable|string|max:255',
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            Log::error('Validation errors: ', $validator->errors()->toArray());
            return $isMobile
            ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
            : redirect()->back()->withErrors($validator->errors())->withInput();
        }

        // Handle the ads thumbnail using helper

        $adsImg      = handleUpload('adsThumbnail');
        $adsOwnerImg = handleUpload('adsOwnerImg');

        // Log the image upload result
        Log::info('Uploaded Image Path:', ['adsThumbnail' => $adsImg]);

        // Store the new record
        $ads                 = new Advertisement();
        $ads->jobSeekerId    = $jobSeekerId; // Get admin's ID
        $ads->adsTitle       = $request->input('adsTitle');
        $ads->type           = $request->input('type');
        $ads->adsCategoryId  = $request->input('adsCategoryId');
        $ads->location       = $request->input('location');
        $ads->country        = $request->input('country');
        $ads->adsDescription = $request->input('adsDescription');
        $ads->adsOwner       = $request->input('adsOwner');
        $ads->adsThumbnail   = $adsImg;
        $ads->adsOwnerImg    = $adsOwnerImg;
        $ads->pricing        = $request->input('pricing');
        $ads->contactNumber  = $request->input('contactNumber');
        // Automatically set postedDuration based on created_at
        $ads->created_at     = Carbon::now();
        $ads->postedDuration = Carbon::now()->diffInDays($ads->created_at) . ' Days';
        Log::info('Advertisement Updated:', $ads->toArray());

        $ads->save();

        // Log the saved advertisement
        Log::info('Advertisement Created:', $ads->toArray());

        return $isMobile
        ? $this->responseSuccess('Advertisement created successfully', $ads)
        : redirect()->back()->with('success', 'Advertisement created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request, $id)
    {
        // Check if the request is from mobile using request_type
        $isMobile = request()->has('request_type') && request()->input('request_type') === 'mobile';

        $ads      = Advertisement::findOrFail($id); // This will throw an exception if not found
        $comments = Comment::where('adsId', $id)->with('jobSeeker')->get();

        try {
                                                   // Get the ad details
            $ads = Advertisement::findOrFail($id); // This will throw an exception if not found

            $similarAds = Advertisement::where('adsCategoryId', $ads->adsCategoryId)
                ->where('id', '!=', $id) // Exclude the current item
                ->paginate(4);
            // Limit results

            // Return JSON if it's a mobile request
            if ($isMobile) {
                return response()->json([
                    'status'  => true,
                    'message' => 'Advertisement fetched successfully.',
                    'data'    => $ads,
                ], 200);
            }

        } catch (\Exception $e) {
            // Handle the case where the ad is not found
            if ($isMobile) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Advertisement not found.',
                    'data'    => null,
                ], 404); // Return a 404 not found status
            }

            // If not a mobile request, you can return the default behavior or view
            return response()->json([
                'status'  => false,
                'message' => 'Advertisement not found.',
                'data'    => null,
            ], 404); // Same 404 status for consistency
        }

        //Return the view for web application
        return view('frontend.advertisements.show', compact('similarAds', 'ads', 'comments'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //redirect to ads edit page
        $ads        = Advertisement::findOrFail($id);
        $categories = AdvertisementCategory::all();

        return view('backend.Advertisement.create', compact('ads', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // Check if the request is from mobile
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Log all incoming request data
        Log::info('Incoming request data:', $request->all());

        // Get the authenticated user
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

        if (! $user) {
            return $isMobile
            ? $this->responseError('Unauthorized', 401)
            : redirect()->route('login')->with('error', 'Unauthorized access.');
        }
        $jobSeekerId = $user->id;
        $ads         = Advertisement::where('id', $id)->where('jobSeekerId', $jobSeekerId)->first();

        if (! $ads) {
            return $isMobile
            ? $this->responseError('Ads not found', 404)
            : redirect()->back()->with('error', 'Ads not found');
        }

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'adsTitle'       => 'required|string|max:255',
            'adsCategoryId'  => 'required',
            'type'           => 'nullable',
            'location'       => 'required|string|max:255',
            'country'        => 'nullable|string|max:255',
            'adsDescription' => 'required|string|max:100000',
            'adsOwner'       => 'nullable|string|max:255',
            'adsThumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'adsOwnerImg'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pricing'        => 'required|numeric',
            'status'         => 'nullable|string|max:255',
            'publishStatus'  => 'nullable|string|max:255',
            'contactNumber'  => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            Log::error('Validation errors: ', $validator->errors()->toArray());
            return $isMobile
            ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
            : redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Handle the ads thumbnail using helper
        $adsImg      = handleUpload('adsThumbnail', $ads);
        $adsOwnerImg = handleUpload('adsOwnerImg', $ads);

        // Log the image upload result
        Log::info('Uploaded Image Path:', ['adsThumbnail' => $adsImg]);

        $ads->adsTitle       = $request->input('adsTitle');
        $ads->type           = $request->input('type');
        $ads->adsCategoryId  = $request->input('adsCategoryId');
        $ads->location       = $request->input('location');
        $ads->country        = $request->input('country');
        $ads->adsDescription = $request->input('adsDescription');
        $ads->adsOwner       = $request->input('adsOwner');
        $ads->adsThumbnail   = $adsImg;
        $ads->adsOwnerImg    = $adsOwnerImg;
        $ads->pricing        = $request->input('pricing');
        $ads->contactNumber  = $request->input('contactNumber');
        // Automatically set postedDuration based on created_at
        $ads->created_at     = Carbon::now();
        $ads->postedDuration = Carbon::now()->diffInDays($ads->created_at) . ' Days';
        Log::info('Advertisement Updated:', $ads->toArray());

        $ads->save();

        // Log the saved advertisement
        Log::info('Advertisement Updated:', $ads->toArray());

        //Return the response based on request type
        return $isMobile

        ? $this->responseSuccess('Ads updated successfully', $ads)
        : redirect()->back()->with('success', 'Ads updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */

    public function publish($id)
    {
        $ads                = Advertisement::find($id);
        $ads->publishStatus = 'publish';
        $ads->save();
        return redirect()->route('ads.index')->with('success', 'Ads published successfully.');
    }

    public function unpublish($id)
    {
        $ads                = Advertisement::find($id);
        $ads->publishStatus = 'unpublish';
        $ads->save();
        return redirect()->route('ads.index')->with('success', 'Ads unpublished successfully.');
    }
    public function destroy(Request $request, $id)
    {
        // Check if the request is from mobile
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Get the authenticated user
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

        if (! $user) {
            return $isMobile
            ? $this->responseError('Unauthorized', 401)
            : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        // Find the advertisement
        $ad = Advertisement::where('id', $id)->where('jobSeekerId', $user->id)->first();

        if (! $ad) {
            return $isMobile
            ? $this->responseError('Advertisement not found or unauthorized', 404)
            : redirect()->back()->with('error', 'Advertisement not found or unauthorized.');
        }

        // Delete the advertisement
        $ad->delete();

        Log::info("Advertisement deleted by user ID: {$user->id}", ['ad_id' => $id]);

        return $isMobile
        ? $this->responseSuccess('Advertisement deleted successfully.')
        : redirect()->route('ads.index')->with('success', 'Advertisement deleted successfully!');
    }

    public function showByType(Request $request, $type)
    {
        // Check if the request is from mobile
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Validate the type (Ensure it exists in the database)
        $validTypes = Advertisement::distinct()->pluck('type')->toArray();
        if (! in_array($type, $validTypes)) {
            return $isMobile
            ? $this->responseError('Invalid ad type', 400)
            : redirect()->back()->with('error', 'Invalid ad type.');
        }

        // Fetch advertisements by type with pagination
        $ads         = Advertisement::where('type', $type)->orderBy('created_at', 'desc')->paginate(10);
        $adsCategory = AdvertisementCategory::all();

        return $isMobile
        ? response()->json([
            'status'  => true,
            'message' => 'Advertisement retrieved successfully.',
            'data'    => [
                'ads'        => $ads,
                'categories' => $adsCategory,
            ],
        ], 200)
        : view('frontend.advertisements.index', compact('ads', 'adsCategory'))->with('success', 'Advertisement retrieved successfully!');

    }
    public function showByTypeAndCategory(Request $request, $type, $categoryId = null)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
// Fetch categories and ads
        $categoryIds       = Advertisement::where('type', $type)->pluck('adsCategoryId')->unique();
        $categories        = AdvertisementCategory::whereIn('id', $categoryIds)->get();
        $ads               = Advertisement::where('type', $type)->orderBy('created_at', 'desc')->paginate(8);
        $category          = AdvertisementCategory::all();
        $all               = AdvertisementCategory::all();
        $ad                = Advertisement::all();
        $ad_banners        = [];
        $ad_banners['top'] = AdsManager::where('which_page', 'advertisement')
            ->where('publish_or_not', 1)
            ->where('active', 1)
            ->where('position', 'top')
            ->first();

        if ($ad_banners) {
            $ad_banners['top'] ? $ad_banners['top']->image = asset('storage/' . $ad_banners['top']->image) : null;
        }

        // Validate the type
        $validTypes = Advertisement::distinct()->pluck('type')->toArray();
        if (! in_array($type, $validTypes)) {
            return $isMobile
            ? response()->json(['status' => false, 'message' => 'This type of ads not found'], 400)
            : view('frontend.advertisements.index', compact('type', 'ad', 'categories', 'all', 'category', 'ads', 'ad_banners'))->with('error', 'This type of ads not found.');
        }

        $allCategories = collect([(object) ['id' => 0, 'adsCategoryTitle' => 'All']])->merge($categories);

        $categoryId = (int) $categoryId;

        if ($categoryId === 0) {
            // Fetch all ads of the given type
            $ads = Advertisement::where('type', $type)->orderBy('created_at', 'desc')->paginate(10);

            if ($isMobile) {
                return response()->json([
                    'status'  => true,
                    'message' => 'Advertisements retrieved successfully.',
                    'data'    => [
                        'category_name' => 'All',
                        'ads'           => $ads,
                    ],
                ], 200);
            }

            return view('frontend.advertisements.index', compact('ads', 'allCategories', 'type', 'ad', 'all', 'categories', 'category', 'ad_banners'))
                ->with('success', 'Advertisements retrieved successfully!');
        }

        // For specific category
        $selectedCategory = AdvertisementCategory::find($categoryId);
        if (! $selectedCategory) {
            return $isMobile
            ? response()->json(['status' => false, 'message' => 'Invalid category'], 400)
            : redirect()->back()->with('error', 'Invalid category.');
        }

        $ads = Advertisement::where('type', $type)
            ->where('adsCategoryId', $categoryId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($isMobile) {
            return response()->json([
                'status'  => true,
                'message' => 'Advertisements retrieved successfully.',
                'data'    => [
                    'category_name' => $selectedCategory->adsCategoryTitle,
                    'ads'           => $ads,
                ],
            ], 200);
        }

        return view('frontend.advertisements.index', compact('ads', 'allCategories', 'type', 'selectedCategory', 'ad', 'all', 'category', 'categories', 'ad_banners'))
            ->with('success', 'Advertisements retrieved successfully!');
    }

    public function showByCategory(Request $request, $categoryId)
    {
        // Check if the request is from mobile
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        try {
            // Fetch ads based on the given category ID with pagination
            $ads = Advertisement::where('adsCategoryId', $categoryId)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            $ad = Advertisement::all();

            $adTypes           = $this->getEnumValues('advertisements', 'type');
            $categories        = AdvertisementCategory::where('id', $categoryId)->get();
            $ad_banners        = [];
            $ad_banners['top'] = AdsManager::where('which_page', 'advertisement')
                ->where('publish_or_not', 1)
                ->where('active', 1)
                ->where('position', 'top')
                ->first();

            if ($ad_banners) {
                $ad_banners['top'] ? $ad_banners['top']->image = asset('storage/' . $ad_banners['top']->image) : null;
            }

            $all = AdvertisementCategory::all();
            // If no ads found, return an appropriate response
            if ($ads->isEmpty()) {
                return $isMobile
                ? response()->json([
                    'status'  => false,
                    'message' => 'No advertisements found in this category.',
                    'data'    => null,
                ], 404)

                : view('frontend.advertisements.index', compact('ads', 'categories', 'all', 'ad', 'ad_banners'))
                    ->with('error', 'No advertisements found in this category.');
            }

            // Return JSON response for mobile users
            if ($isMobile) {
                return response()->json([
                    'status'  => true,
                    'message' => 'Advertisements fetched successfully.',
                    'data'    => [
                        'ads'     => $ads,
                        'adstype' => $adTypes,
                    ],
                ], 200);
            }

            // Return a view for web users
            return view('frontend.advertisements.index', compact('ads', 'ad', 'categories', 'all', 'ad_banners'));

        } catch (\Exception $e) {
            Log::error("Error fetching advertisements by category: " . $e->getMessage());

            return $isMobile
            ? response()->json([
                'status'  => false,
                'message' => 'Something went wrong while fetching advertisements.',
                'data'    => null,
            ], 500)
            : view('frontend.advertisements.index', compact('ads', 'ad', 'categories', 'all'))->with('error', 'Something went wrong while fetching advertisements.');
        }
    }

    public function search(Request $request)
    {
        // Check if the request is from mobile (using 'request_type' parameter)
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Define allowed types
        $validTypes = ['Buy', 'Sell', 'Rent'];
        $ad         = Advertisement::all();
        $categories = AdvertisementCategory::all();
        $all        = AdvertisementCategory::all();
        // Set default type to 'Sell' if not provided or invalid
        $type = $request->has('type') && in_array($request->input('type'), $validTypes)
        ? $request->input('type')
        : 'Sell';

        // Build the query for ads search
        try {
            $ads = Advertisement::when($request->filled('adsTitle'), function ($query) use ($request) {
                $query->where('adsTitle', 'like', '%' . $request->adsTitle . '%');
            })
                ->when($request->filled('location'), function ($query) use ($request) {
                    $query->where('location', 'like', '%' . $request->location . '%');
                })
                ->when($request->filled('country'), function ($query) use ($request) {
                    $query->where('country', 'like', '%' . $request->country . '%');
                })
                ->when($request->filled('adsCategoryId'), function ($query) use ($request) {
                    $query->where('adsCategoryId', $request->adsCategoryId);
                })
                ->when(! empty($type), function ($query) use ($type) {
                    $query->where('type', $type);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            // Return the results in a format based on the request type (mobile/web)
            if ($isMobile) {
                if ($ads->isEmpty()) {
                    return response()->json([
                        'status'  => false,
                        'message' => 'No advertisements found.',
                        'data'    => null,
                    ], 404);
                }

                return response()->json([
                    'status'  => true,
                    'message' => 'Advertisements fetched successfully.',
                    'data'    => $ads,
                ], 200);

            }

            // For web, return the search results in a view
            return view('frontend.advertisements.index', compact('ads', 'categories', 'all', 'ad'))->with('success', 'Advertisements fetched successfully!');
        } catch (\Exception $e) {
            Log::error("Error during advertisement search: " . $e->getMessage());

            return $isMobile
            ? response()->json([
                'status'  => false,
                'message' => 'Something went wrong while fetching advertisements.',
                'data'    => null,
            ], 500)
            : redirect()->back()->with('error', 'Something went wrong while fetching advertisements.');
        }
    }

    public function getEnumValues($table, $column)
    {
        $results = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '$column'"));
        $enum    = $results[0]->Type;

        preg_match('/^enum\((.*)\)$/', $enum, $matches);
        $enumValues = [];
        foreach (explode(',', $matches[1]) as $value) {
            $enumValues[] = trim($value, "'");
        }

        return $enumValues;
    }

    /**
     * Handle error response.
     */
    protected function responseError($message, $statusCode, $errors = [])
    {
        return response()->json([
            'status'  => 'error',
            'message' => $message,
            'errors'  => $errors,
        ], $statusCode);
    }
    /**
     * Handle success response.
     */
    protected function responseSuccess($message, $data = [], $statusCode = 200)
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => $data,
        ], $statusCode);
    }

}