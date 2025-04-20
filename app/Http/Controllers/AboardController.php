<?php

namespace App\Http\Controllers;

use App\Models\Aboard;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;


class AboardController extends Controller
{
    public function index()
    {
        $isMobile = request()->has('request_type') && request()->input('request_type') === 'mobile';
        $aboards = Aboard::orderBy('created_at', 'desc')->simplePaginate(10);
        $categories = ProductCategory::all();

        if ($isMobile) {
            return response()->json([
                'status' => true,
                'message' => 'Products fetched successfully.',
                'data' => $aboards
            ], 200);
        }
        
        return view('backend.aboards.lists', compact('aboards', 'categories'));
    }

    public function aboard( Request $request){
        $categories = ProductCategory::all();
        $items = Aboard::where('publishStatus', 'publish')
        ->where('status', 'Available')
        ->get();
        // $items = Aboard::all();
        $type = $request->has('type') && in_array($request->input('type'), $validTypes)
        ? $request->input('type')
        : 'Item';
        return view('frontend.aboarddeals.aboard',compact('categories','items','type'));

    }
    public function create()
    {
        $categories = ProductCategory::all();
        return view('backend.aboards.create', compact('categories'));
    }


    public function store(Request $request)
    {
        // return $request->all();
        Log::info('Incoming request data:', $request->all());
        
        // Check if the request is from mobile
        $isMobile = request()->has('request_type') && request()->input('request_type') === 'mobile';
    
             // Get the authenticated user
             $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
             Log::info('Authenticated Job Seeker ID: ' . $user->id);

             $jobSeekerId = $user->id;
        // Validate the request data
        $validated = Validator::make($request->all(), [
            'productTitle' => 'required|string|max:255',
            'productCategoryId' => 'required',
            'productDescription' => 'required|string',
            'contactNumber' => 'nullable|string|max:255',
            'pricing' => 'required|numeric',
            'status' => 'nullable|string|max:255',
            'publishStatus' => 'nullable|string|max:255',
            'productThumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'nullable',
            'country' => 'nullable',
            'type' => 'in:Item, Buy',
        ]);
    
        // Handle validation failure
        if ($validated->fails()) {
            Log::error('Validation failed:', $validated->errors()->toArray());
            if ($isMobile) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validated->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validated)->withInput();
        }
    
          // Generate productSlug from productTitle
    $productSlug = Str::slug($request->input('productTitle'));

    // Ensure productSlug is unique by appending a number if necessary
    $existingSlug = Aboard::where('productSlug', $productSlug)->first();
    if ($existingSlug) {
        $productSlug = $productSlug . '-' . time(); // Append timestamp to make it unique
    }
        // Handle product thumbnail upload
        $productThumbnail = handleUpload('productThumbnail');
        
        // Create a new Aboard instance and assign the validated values
        $aboard = new Aboard();
        $aboard->jobSeekerId =  $jobSeekerId; 
        $aboard->productTitle = $request->input('productTitle');
        $aboard->productCategoryId = $request->input('productCategoryId');
        $aboard->productDescription = $request->input('productDescription');
        $aboard->location = $request->input('location');
        $aboard->country = $request->input('country');
        $aboard->type = $request->input('type');
        $aboard->contactNumber = $request->input('contactNumber');
        $aboard->pricing = $request->input('pricing');
        $aboard->publishStatus = $request->input('publishStatus', 'publish');
        $aboard->productThumbnail = $productThumbnail;

        $aboard->created_at = Carbon::now();
        $aboard->postedDuration = Carbon::now()->diffInDays($aboard->created_at) . ' Days';
        $aboard->save();
        
        Log::info('Product Created:', $aboard->toArray());
    
        // Return response based on request type
        if ($isMobile) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product created successfully.',
                'data' => $aboard
            ], 201);
        }
    
        return redirect()->back()->with('success', 'Product created successfully.');
    }
    
  

    public function show(Request $request, $id)
    {
        // Check if the request is from mobile using request_type
        $isMobile = request()->has('request_type') && request()->input('request_type') === 'mobile';
    
             // Get the authenticated user
             $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
             Log::info('Authenticated Job Seeker ID: ' . $user->id);

             $jobSeekerId = $user->id;
        try {
            // Get the Aboard details
            $aboard = Aboard::findOrFail($id); // This will throw an exception if not found
            $similarProducts = Aboard::where('productCategoryId', $aboard->productCategoryId)
            ->where('id', '!=', $aboard->id) // Exclude the current item
            ->limit(6) // Limit results
            ->get();

            // Return JSON if it's a mobile request
            if ($isMobile) {
                return response()->json([
                    'status' => true,
                    'message' => 'Aboard fetched successfully.',
                    'data' => $aboard
                ], 200);
            }
    
        } catch (\Exception $e) {
            // Handle the case where the Aboard is not found
            if ($isMobile) {
                return response()->json([
                    'status' => false,
                    'message' => 'Aboard not found.',
                    'data' => null
                ], 404); // Return a 404 not found status
            }
    
            // If not a mobile request, return a standard response
            return response()->json([
                'status' => false,
                'message' => 'Aboard not found.',
                'data' => null
            ], 404); // Same 404 status for consistency
        }
    
        // Return the view for web application if not a mobile request
        return view('frontend.aboarddeals.show',compact('aboard','similarProducts'));
    }
    

    public function edit($id)
    {
        $aboard = Aboard::findOrFail($id);
        $categories = ProductCategory::all();
        return view('backend.aboards.create', compact('aboard', 'categories'));
    }

    public function update(Request $request, $id)
    {
        Log::info('Incoming request data:', $request->all());
    
        // Check if the request is from mobile
        $isMobile = request()->has('request_type') && request()->input('request_type') === 'mobile';
    
        // Validate the request data
        $validated = Validator::make($request->all(), [
            'productTitle' => 'required|string|max:255',
            'productCategoryId' => 'required|exists:product_categories,id',
            'productDescription' => 'required|string',
            'productOwnerName' => 'nullable|string|max:255',
            'contactNumber' => 'nullable|string|max:255',
            'pricing' => 'required|numeric',
            'status' => 'nullable|string|max:255',
            'publishStatus' => 'nullable|string|max:255',
            'productThumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'nullable',
            'country' => 'nullable',
            'type' => 'in:Item, Buy',
        ]);
    
        // Handle validation failure
        if ($validated->fails()) {
            Log::error('Validation failed:', $validated->errors()->toArray());
            if ($isMobile) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validated->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validated)->withInput();
        }
    
        // Find the Aboard by ID
        $aboard = Aboard::findOrFail($id);
    
        // Handle product thumbnail upload
        $productThumbnail = handleUpload('productThumbnail', $aboard);
    
        // Update the Aboard model with the validated data
        $aboard->update($request->all());
        $aboard->location = $request->input('location');
        $aboard->country = $request->input('country');
        $aboard->type = $request->input('type');
        $aboard->productThumbnail = $productThumbnail;
        $aboard->created_at = Carbon::now();
        $aboard->postedDuration = Carbon::now()->diffInDays($aboard->created_at) . ' Days';
        $aboard->save();
    
        Log::info('Product Updated:', $aboard->toArray());
    
        // Return response based on request type
        if ($isMobile) {
            return response()->json([
                'status' => true,
                'message' => 'Product updated successfully.',
                'data' => $aboard
            ], 200);
        }
    
        return redirect()->route('aboards.index')->with('success', 'Product updated successfully.');
    }
    

    public function destroy(Request $request, $id)
    {
        // Check if the request is from mobile
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
    
        // Get the authenticated user
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
    
        // Handle unauthorized access
        if (!$user) {
            return $isMobile
                ? $this->responseError('Unauthorized', 401)
                : redirect()->route('login')->with('error', 'Unauthorized access.');
        }
    
        // Find the Aboard record by ID for the authenticated user
        $aboard = Aboard::where('id', $id)->where('jobSeekerId', $user->id)->first();
    
        // If the Aboard is not found or the user does not own it
        if (!$aboard) {
            return $isMobile
                ? $this->responseError('Aboard not found or unauthorized', 404)
                : redirect()->back()->with('error', 'Aboard not found or unauthorized.');
        }
    
        // Delete the Aboard record
        $aboard->delete();
    
        // Log the deletion action
        Log::info("Aboard deleted by user ID: {$user->id}", ['aboard_id' => $id]);
    
        // Return success response based on the request type (mobile or web)
        return $isMobile
            ? $this->responseSuccess('Aboard deleted successfully.')
            : redirect()->route('aboards.index')->with('success', 'Aboard deleted successfully!');
    }
    
    public function publish($id)
{
    $aboard = Aboard::findOrFail($id);
    $aboard->publishStatus = 'publish';
    $aboard->save();

    return redirect()->route('aboards.index')->with('success', 'Product published successfully.');
}

public function unpublish($id)
{
    $aboard = Aboard::findOrFail($id);
    $aboard->publishStatus = 'unpublish';
    $aboard->save();

    return redirect()->route('aboards.index')->with('success', 'Product unpublished successfully.');
}


public function showByTypeAndCategory(Request $request, $type, $categoryId = null)
{
    // Check if the request is from mobile
    $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

    // Validate the type (Here, we assume valid types for ProductCategory are 'Item' and 'Buy')
    $validTypes = ['Item', 'Buy']; // Adjust this if there are more valid types
    if (!in_array($type, $validTypes)) {
        return $isMobile
            ? response()->json(['status' => false, 'message' => 'Invalid product type'], 400)
            : redirect()->back()->with('error', 'Invalid product type.');
    }

    // Fetch unique categories under the given type
    $categoryIds = Aboard::where('type', $type)->pluck('productCategoryId')->unique();
    $categories = ProductCategory::whereIn('id', $categoryIds)->get();
    $products = Aboard::where('type', $type)->orderBy('created_at', 'desc')->paginate(10);

    // If no category is selected, return only categories
    if (!$categoryId) {
        // Check if there are no categories or products
        if ($categories->isEmpty()) {
            return $isMobile
                ? response()->json([
                    'status' => false,
                    'message' => 'No aboard  found.',
                    'data' => null
                ], 404)
                : redirect()->back()->with('error', 'No aboard found.');
        }
    
        return $isMobile
            ? response()->json([
                'status' => true,
                'message' => 'Categories retrieved successfully.',
                'data' => [
                    'categories' => $categories,
                    'products' => $products
                ]
            ], 200)
            : view('products.categories', compact('categories', 'type'))
                ->with('success', 'Categories retrieved successfully!');
    }
    

    // Validate the category
    $category = ProductCategory::find($categoryId);
    if (!$category) {
        return $isMobile
            ? response()->json(['status' => false, 'message' => 'Invalid category'], 400)
            : redirect()->back()->with('error', 'Invalid category.');
    }

    // Fetch products for the given type and category
    $products = Aboard::where('type', $type)
        ->where('productCategoryId', $categoryId)
        ->orderBy('created_at', 'desc')
        ->get();

    // API Response (For Mobile)
    if ($isMobile) {
        if ($products->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No aboard deals found.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Products retrieved successfully.',
            'data' => [
                'category_name' => $category->productCategoryTitle ?? 'Unknown', // Ensure column exists
                'products' => $products
            ]
        ], 200);
    }

    // Web Response (For Blade View)
    return view('frontend.aboarddeals.aboard', compact('products', 'category', 'type'))
        ->with('success', 'Products retrieved successfully!');
}

public function search(Request $request)
{
    // Check if the request is from mobile (using 'request_type' parameter)
    $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

    // Define allowed types
    $validTypes = ['Item','Buy'];

    // Set default type to 'Sell' if not provided or invalid
$type = $request->has('type') && in_array($request->input('type'), $validTypes)
    ? $request->input('type')
    : 'Item';

    // Build the query for ads search
    try {
        $ads = Aboard::when($request->filled('productTitle'), function ($query) use ($request) {
                $query->where('productTitle', 'like', '%' . $request->productTitle . '%');
            })
            ->when($request->filled('location'), function ($query) use ($request) {
                $query->where('location', 'like', '%' . $request->location . '%');
            })
            ->when($request->filled('country'), function ($query) use ($request) {
                $query->where('country', 'like', '%' . $request->country . '%');
            })
            ->when($request->filled('productCategoryId'), function ($query) use ($request) {
                $query->where('productCategoryId', $request->productCategoryId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Return the results in a format based on the request type (mobile/web)
        if ($isMobile) {
            if ($ads->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'No aboards deals found.',
                    'data' => null
                ], 404);
            }
            
            return response()->json([
                'status' => true,
                'message' => 'Aboard Deals fetched successfully.',
                'data' => $ads
            ], 200);
            
        }

        // For web, return the search results in a view
        return view('frontend.aboarddeals.aboard',compact('ads','categories','items','type'));
    } catch (\Exception $e) {
        Log::error("Error during advertisement search: " . $e->getMessage());

        return $isMobile
            ? response()->json([
                'status' => false,
                'message' => 'Something went wrong while fetching advertisements.',
                'data' => null
            ], 500)
            : redirect()->back()->with('error', 'Something went wrong while fetching advertisements.');
    }
}


     /**
     * Handle error response.
     */
    protected function responseError($message, $statusCode, $errors = [])
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $statusCode);
    }
    /**
     * Handle success response.
     */
    protected function responseSuccess($message, $data = [], $statusCode = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }



}
