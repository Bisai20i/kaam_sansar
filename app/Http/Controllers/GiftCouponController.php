<?php
namespace App\Http\Controllers;

use App\Models\GiftCategory;
use App\Models\GiftCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;

class GiftCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function categories(){
    //     $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

    //      // Get the authenticated user
    //      $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
    //      if (!$user) {
    //          return $isMobile
    //              ? $this->responseError('Unauthorized', 401)
    //              : redirect()->route('login')->with('error', 'Unauthorized access.');
    //      }

    //      Log::info('Authenticated Job Seeker ID: ' . $user->id);

    //      $adminId = $user->id;
    // }
    public function index(Request $request)
    {
        $isMobile     = $request->has('request_type') && $request->input('request_type') === 'mobile';
        $giftNcoupons = GiftCoupon::when(
            in_array($request->type, ['1', '0']),
            fn($query) => $query->where('type', $request->type)
        )
            ->latest()
            ->simplePaginate(5);

        $type = $request->type ?? 'Gift and Coupons';

        return view('backend.giftNcoupon.list', compact('giftNcoupons', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $giftcategories = GiftCategory::where('publishStatus', 1)->get();
        return view('backend.giftNcoupon.create', compact('giftcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Check if the request is from mobile using request_type
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        //  Get the authenticated user
        $user = $isMobile ? $request->user() : Auth::guard('admin')->user();
        if (! $user) {
            return $isMobile
            ? $this->responseError('Unauthorized', 401)
            : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        Log::info('Authenticated Admin ID: ' . $user->id);
        $adminId = $user->id;

        //validate request data

        $validatedData = Validator::make($request->all(), [

            'title'              => 'required|string',
            'description'        => 'required|string',
            'imageUrl'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price'              => 'required|integer|min:0',
            'giftCategoryId'     => 'required|exists:gift_categories,id',
            'croppedImageBase64' => 'nullable|string',
            'quantity'           => 'required|integer|min:1',
            'type'               => 'required|boolean',
            'country'            => 'required|string|max:255',
            'city'               => 'required|string|max:255',
            'discount'           => 'nullable|numeric|min:0|max:100',
            'itemCode'           => 'nullable|string|unique:gift_coupons,itemCode',
            'customApplied'      => 'required|boolean',

        ]);

        // Handle validation errors
        if ($validatedData->fails()) {
            Log::error('Validation errors: ', $validatedData->errors()->toArray());
            // return $validatedData->errors()->all();
            return $isMobile
            ? $this->responseError('Validation failed. Please check your inputs.', 422, $validatedData->errors())
            : redirect()->back()->withErrors($validatedData->errors())->withInput();
        }

        // dd($request->all());
        $folderPath = 'gift_N_coupon_images';
        $imagePath  = null;

        // Handle the image upload (Base64 or file)
        if ($request->filled('croppedImageBase64')) {
            $croppedImage      = $request->input('croppedImageBase64');
            list(, $imageData) = explode(',', $croppedImage); // Extract base64 content
            $decodedImage      = base64_decode($imageData);

            $imageName = time() . '_cropped.jpg';
            $imagePath = "$folderPath/$imageName";

            Storage::disk('public')->put($imagePath, $decodedImage);
        } elseif ($request->hasFile('imageUrl')) {
            $image     = $request->file('imageUrl');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = "$folderPath/$imageName";

            $resizedImage = Image::make($image);
            $resizedImage->resize(500, 400, function ($constraint) {
                $constraint->aspectRatio();
            });

            Storage::disk('public')->put($imagePath, $resizedImage->encode('jpg', 90));
        }

        $giftcoupon = GiftCoupon::create([
            'title'          => $request->input('title'),
            'description'    => $request->input('description'),
            'thumbnail'      => $imagePath,
            'price'          => $request->input('price'),
            'giftCategoryId' => $request->input('giftCategoryId'),
            'quantity'       => $request->input('quantity'),
            'type'           => $request->input('type'),
            'country'        => $request->input('country'),
            'city'           => $request->input('city'),
            'publishStatus'  => false,
            'discount'       => $request->input('discount') ?? 0,
            'itemCode'       => $request->input('itemCode'),
            'customApplied'  => $request->input('customApplied'),
            'adminId'        => $adminId,
        ]);

        // dd($giftcoupon);

        Log::info('giftcoupon created successfully with ID: ' . $giftcoupon->id);

        return $isMobile
        ? $this->responseSuccess('Gift and Coupon Item created successfully', $giftcoupon)
        : redirect()->route('giftNcoupon.index')->with('success', 'Gift and Coupon Item created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GiftCoupon  $giftCoupon
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //Check if request is from mobile using request_type
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        //Get the authenticated user
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        if (! $user) {
            return $isMobile
            ? $this->responseError('Unauthorized', 401)
            : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        Log::info('Authenticated Job Seeker ID: ' . $user->id);

        $jobSeekerId = $user->id;

        //Get the giftcoupon details for the job seeker

        $giftcoupon = GiftCoupon::find($id);
        if (! $giftcoupon) {
            return $isMobile
            ? $this->responseError('Requested Gift and Coupon Item not found.', 404)
            : redirect()->back()->with('error', 'Requested Gift and Coupon Item not found.');
        }
        return $isMobile
        ? $this->responseSuccess('giftcoupon details found', $giftcoupon)
        : redirect()->back()->with('success', 'giftcoupon details found');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GiftCoupon  $giftCoupon
     * @return \Illuminate\Http\Response
     *
     */

    //  public function edit(GiftCoupon $giftCoupon)
    public function edit(Request $request, $id)
    {
        $giftCoupon = GiftCoupon::find($id);
        if ($giftCoupon) {
            $type           = $giftCoupon->type;
            $giftcategories = GiftCategory::get();
            return view('backend.giftNcoupon.create', compact(['giftCoupon', 'type', 'giftcategories']));
        }

        return redirect()->back()->with('error', 'Gift or Coupon Not Found!');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GiftCoupon  $giftCoupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        $validatedData = Validator::make($request->all(), [

            'title'              => 'required|string',
            'description'        => 'required|string',
            'imageUrl'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price'              => 'required|integer|min:0',
            'giftCategoryId'     => 'required|exists:gift_categories,id',
            'croppedImageBase64' => 'nullable|string',
            'quantity'           => 'required|integer|min:1',
            'type'               => 'required|boolean',
            'country'            => 'required|string|max:255',
            'city'               => 'required|string|max:255',
            'discount'           => 'nullable|numeric|min:0|max:100',
            'itemCode'           => [
                'nullable',
                'string',
                Rule::unique('gift_coupons', 'itemCode')->ignore($id),
            ],
            'customApplied'      => 'required|boolean',

        ]);

        if ($validatedData->fails()) {
            Log::error('Validation errors: ', $validatedData->errors()->toArray());
            // return $validatedData->errors()->all();
            return $isMobile
            ? $this->responseError('Validation failed. Please check your inputs.', 422, $validatedData->errors())
            : redirect()->back()->withErrors($validatedData->errors())->withInput();
        }

        //find the giftcoupon
        $giftcoupon = GiftCoupon::find($id);
        if (! $giftcoupon) {

            return $isMobile
            ? $this->responseError('Requested Gift and Coupon Item not found.', 404)
            : redirect()->back()->with('error', 'Requested Gift and Coupon Item not found.');
        }

        $folderPath = 'gift_N_coupon_images';
        $imagePath  = null;

        if ($request->filled('croppedImageBase64')) {
            $croppedImage      = $request->input('croppedImageBase64');
            list(, $imageData) = explode(',', $croppedImage); // Extract base64 content
            $decodedImage      = base64_decode($imageData);

            $imageName = time() . '_cropped.jpg';
            $imagePath = "$folderPath/$imageName";

            Storage::disk('public')->put($imagePath, $decodedImage);
            if ($giftcoupon->thumbnail && Storage::disk('public')->exists($giftcoupon->thumbnail)) {
                Storage::disk('public')->delete($giftcoupon->thumbnail);
            }

        } elseif ($request->hasFile('imageUrl')) {

            $image     = $request->file('imageUrl');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = "$folderPath/$imageName";

            $resizedImage = Image::make($image);
            $resizedImage->resize(500, 400, function ($constraint) {
                $constraint->aspectRatio();
            });

            Storage::disk('public')->put($imagePath, $resizedImage->encode('jpg', 90));
            if ($giftcoupon->thumbnail && Storage::disk('public')->exists($giftcoupon->thumbnail)) {
                Storage::disk('public')->delete($giftcoupon->thumbnail);
            }
        } else {
            $imagePath = $giftcoupon->thumbnail;
        }

        $giftcoupon->title          = $request->input('title');
        $giftcoupon->description    = $request->input('description');
        $giftcoupon->price          = $request->input('price');
        $giftcoupon->thumbnail      = $imagePath;
        $giftcoupon->giftCategoryId = $request->input('giftCategoryId');
        $giftcoupon->quantity       = $request->input('quantity');
        $giftcoupon->type           = $request->input('type');
        $giftcoupon->country        = $request->input('country');
        $giftcoupon->city           = $request->input('city');
        $giftcoupon->itemCode       = $request->input('itemCode');
        $giftcoupon->discount       = $request->input('discount');
        $giftcoupon->customApplied  = $request->input('customApplied');
        $giftcoupon->save();

        Log::info('gift and coupon item updated successfully:');

        //Return the response based on request type
        return $isMobile

        ? $this->responseSuccess('Gift and Coupon Item updated successfully', $giftcoupon)
        : redirect()->route('giftNcoupon.index')->with('success', 'Gift and Coupon Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GiftCoupon  $giftCoupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        //check if request is from mobile us request_type
        $user = $isMobile ? $request->user() : Auth::guard('admin')->user();
        if (! $user) {
            return $isMobile
            ? $this->responseError('Unauthorized', 401)
            : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        Log::info('Authenticated Admin ID: ' . $user->id);
        $adminId = $user->id;

        //find the giftcoupon
        $giftcoupon = GiftCoupon::where('adminId', $adminId)
            ->where('id', $id)
            ->firstOrFail();
        if (! $giftcoupon) {
            return $isMobile
            ? $this->responseError('Gift and Coupon Item not found', 404)
            : redirect()->back()->with('error', 'Gift and Coupon Item not found'); //validate request data
        }

        // Delete the GiftCoupon record
        if (! empty($giftcoupon->thumbnail) && Storage::disk('public')->exists($giftcoupon->thumbnail)) {
            Storage::disk('public')->delete($giftcoupon->thumbnail);
        }

        $giftcoupon->delete();

        //Return the response based on request type
        return $isMobile

        ? $this->responseSuccess('Gift and Coupon Item deleted successfully', $giftcoupon)
        : redirect()->back()->with('success', 'Gift and Coupon Item delete successfully');
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

    public function publish(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        try {
            $coupon                = GiftCoupon::find($id);
            $coupon->publishStatus = true;
            $coupon->save();
            return $isMobile
            ? $this->responseSuccess('Gift and Coupon Published successfully', $coupon)
            : redirect()->back()->with('success', 'Gift and Coupon Published successfully');
        } catch (\Exception $e) {
            return $isMobile
            ? $this->responseError('Some Error Occured', 201)
            : redirect()->back()->with('error', 'Some Error Occured');
        }

    }

    public function unpublish(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        try {
            $coupon                = GiftCoupon::find($id);
            $coupon->publishStatus = false;
            $coupon->save();
            return $isMobile
            ? $this->responseSuccess('Gift category Un-Published successfully', $coupon)
            : redirect()->back()->with('success', 'Gift category Un-Published successfully');
        } catch (\Exception $e) {
            return $isMobile
            ? $this->responseError('Some Error Occured', 201)
            : redirect()->back()->with('error', 'Some Error Occured');
        }
    }

}
