<?php
namespace App\Http\Controllers;

use App\Models\Aboard;
use App\Models\AdsManager;
use App\Models\ProductCategory;
use App\Models\ProductComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AboardController extends Controller
{
    public function index()
    {
        $isMobile = request()->has('request_type') && request()->input('request_type') === 'mobile';

        $aboards    = Aboard::with('jobSeeker')->orderBy('created_at', 'desc')->paginate(10);
        $categories = ProductCategory::all();

        $aboards->transform(function ($aboard) {
            $aboard->productThumbnail = $aboard->productThumbnail ? asset($aboard->productThumbnail) : null;
            return $aboard;
        });

        if ($isMobile) {
            return response()->json([
                'status'  => true,
                'message' => 'Products fetched successfully.',
                'data'    => $aboards,
            ], 200);
        }

        return view('backend.aboards.lists', compact('aboards', 'categories'));
    }

    public function aboard(Request $request)
    {
        $validTypes    = ['Item', 'Buy'];
        $categories    = ProductCategory::all();
        $ads           = Aboard::where('publishStatus', 'publish')->where('status', 'Available')->orderBy('created_at', 'desc')->get();
        $cmt           = Aboard::where('publishStatus', 'publish')->where('status', 'Available')->get();
        $items         = Aboard::orderBy('created_at', 'desc')->get();
        $uniqueAboards = Aboard::select('country')->distinct()->get();
        $uniqueCity    = Aboard::select('location')->distinct()->get();
        $comments      = ProductComment::all();

        $type = $request->has('type') && in_array($request->input('type'), $validTypes)
        ? $request->input('type')
        : 'Item';

        $ad_banners          = [];
        $ad_banners['right'] = AdsManager::where('which_page', 'abroad')
            ->where('publish_or_not', 1)
            ->where('active', 1)
            ->where('position', 'right')
            ->orderBy('created_at', 'desc')
            ->first();

        // return $ad_banners;
        if ($ad_banners && $ad_banners['right']) {

            $ad_banners['right']->image = asset('storage/' . $ad_banners['right']->image) ?? null;

        }

        // return $ad_banners;

        return view('frontend.aboarddeals.aboard', compact('categories', 'ads', 'type', 'uniqueAboards', 'uniqueCity', 'items', 'comments', 'cmt', 'ad_banners'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('backend.aboards.create', compact('categories'));
    }

    public function store(Request $request)
    {
        Log::info('Incoming request data:', $request->all());

        // return $request->all();

        $isMobile = request()->has('request_type') && request()->input('request_type') === 'mobile';
        $user     = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

        if (! $user) {
            return $isMobile
            ? response()->json(['status' => false, 'message' => 'Unauthorized.'], 401)
            : redirect()->route('login')->with('error', 'Please log in.');
        }

        Log::info('Authenticated Job Seeker ID: ' . $user->id);

        $validated = Validator::make($request->all(), [
            'productTitle'       => 'required|string|max:255',
            'productCategoryId'  => 'required|exists:product_categories,id',
            'productDescription' => 'required|string',
            'contactNumber'      => 'nullable|string|max:255',
            'pricing'            => 'nullable|numeric',
            'status'             => 'nullable|string|max:255',
            'publishStatus'      => 'nullable|string|max:255',
            'productThumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'location'           => 'nullable',
            'country'            => 'nullable',
            'type'               => 'required|in:Item,Buy',
            'urlLink'            => 'nullable|url',
        ]);

        if ($validated->fails()) {
            Log::error('Validation failed:', $validated->errors()->toArray());

            return $isMobile
            ? response()->json(['status' => false, 'message' => 'Validation failed.', 'errors' => $validated->errors()], 422)
            : redirect()->back()->with('error', implode(', ', $validated->errors()->all()));
        }

        $productSlug = Str::slug($request->input('productTitle'));
        if (Aboard::where('productSlug', $productSlug)->exists()) {
            $productSlug .= '-' . time();
        }

        $productThumbnail = handleUpload('productThumbnail');

        $aboard = new Aboard([
            'jobSeekerId'        => $user->id,
            'productTitle'       => $request->input('productTitle'),
            'productCategoryId'  => $request->input('productCategoryId'),
            'productDescription' => $request->input('productDescription'),
            'country'            => $request->input('country'),
            'type'               => $request->input('type'),
            'pricing'            => $request->input('pricing') ?? 0,
            // 'publishStatus' => $request->input('publishStatus', 'publish'),
            'productSlug'        => $productSlug,
            'productThumbnail'   => $productThumbnail,
            'postedDuration'     => '0 Days',
            'urlLink'            => $request->input('urlLink') ?? null,
        ]);

        $aboard->save();

        Log::info('Product Created:', $aboard->toArray());
        if($request->input('type')=='Buy'){
            $request->session()->flash('type', 'want_to_buy'); 
        }
        return $isMobile
        ? response()->json(['status' => 'success', 'message' => 'Product created successfully.', 'data' => $aboard], 201)
        : redirect()->back()->with('success', 'Product created successfully.');
    }

    public function show(Request $request, $id)
    {
        $isMobile = request()->has('request_type') && request()->input('request_type') === 'mobile';

        try {
            $aboard          = Aboard::findOrFail($id);
            $comments        = ProductComment::where('productId', $id)->with('jobSeeker')->get();
            $similarProducts = Aboard::where('productCategoryId', $aboard->productCategoryId)
                ->where('id', '!=', $aboard->id)
                ->paginate(4);

            return $isMobile
            ? response()->json(['status' => true, 'message' => 'Aboard fetched successfully.', 'data' => $aboard], 200)
            : view('frontend.aboarddeals.show', compact('aboard', 'similarProducts', 'comments'));
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Aboard not found.', 'data' => null], 404);
        }
    }

    public function edit($id)
    {
        try {
            $aboard     = Aboard::findOrFail($id);
            $categories = ProductCategory::all();

            // Log the data to ensure everything is correct
            Log::info("Aboard data: ", $aboard->toArray());
            Log::info("Categories: ", $categories->toArray());

            if (request()->has('request_type') && request()->input('request_type') === 'mobile') {
                return response()->json([
                    'status'  => true,
                    'message' => 'Aboard fetched successfully.',
                    'data'    => [
                        'aboard'     => $aboard,
                        'categories' => $categories,
                    ],
                ], 200);
            }

            return view('backend.aboards.create', compact('aboard', 'categories'));
        } catch (\Exception $e) {
            // Log any error that occurs during the fetching process
            Log::error("Error in fetching Aboard with ID $id: " . $e->getMessage());

            return response()->json([
                'status'  => false,
                'message' => 'An error occurred while fetching the Aboard data.',
                'data'    => null,
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        Log::info('Incoming request data:', $request->all());

        $isMobile = request()->has('request_type') && request()->input('request_type') === 'mobile';

        // Validate incoming request
        $validated = Validator::make($request->all(), [
            'productTitle'       => 'required|string|max:255',
            'productCategoryId'  => 'required|exists:product_categories,id',
            'productDescription' => 'required|string',
            'pricing'            => 'nullable|numeric',
            'productThumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'country'            => 'nullable',
        ]);

        // If validation fails, return errors
        if ($validated->fails()) {
            Log::error('Validation failed:', $validated->errors()->toArray());
            return $isMobile
            ? response()->json(['status' => false, 'message' => 'Validation failed.', 'errors' => $validated->errors()], 422)
            : redirect()->back()->withErrors($validated)->withInput();
        }

        // Find the product (aboard) by ID
        $aboard = Aboard::findOrFail($id);

        // Update the product details
        $aboard->update([
            'productTitle'       => $request->input('productTitle'),
            'productCategoryId'  => $request->input('productCategoryId'),
            'productDescription' => $request->input('productDescription'),
            'contactNumber'      => $request->input('contactNumber'),
            'pricing'            => $request->input('pricing'),
            'location'           => $request->input('location'),
            'country'            => $request->input('country'),
        ]);

        // Handle product thumbnail upload if a file is provided
        if ($request->hasFile('productThumbnail')) {
            // Handle upload logic (assuming handleUpload is a custom helper function)
            $aboard->productThumbnail = handleUpload('productThumbnail');
        }

        // Save the updated product to the database
        $aboard->save();

        // Return the success response (mobile AJAX response)
        return $isMobile
        ? response()->json(['status' => true, 'message' => 'Product updated successfully.', 'data' => $aboard])
        : redirect()->back()->with('success', 'Product updated successfully.');
    }

    public function handleUpload($inputName)
    {
        // Check if a file is provided
        if (request()->hasFile($inputName)) {
            // Get the file from the request
            $file = request()->file($inputName);

            // Generate a unique filename with timestamp and the original name
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Store the file (in public storage or wherever you need)
            $file->storeAs('public/product-thumbnails', $fileName);

            // Return the file path (adjust this to match your storage config)
            return 'storage/product-thumbnails/' . $fileName;
        }

        return null; // Return null if no file is uploaded
    }

    public function destroy($id)
    {
        try {
            // Find the record by ID and delete it
            $aboard = Aboard::findOrFail($id);
            $aboard->delete();

            // Check if the request is an AJAX request
            if (request()->ajax()) {
                return response()->json(['message' => 'Product deleted successfully.']);
            }

            // For normal redirect (non-AJAX)
            return redirect()->route('aboards.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            // For AJAX requests, return an error message
            if (request()->ajax()) {
                return response()->json(['message' => 'Failed to delete product.'], 500);
            }

            // For normal redirect
            return redirect()->route('aboards.index')->with('error', 'Failed to delete product.');
        }
    }
}
