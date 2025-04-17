<?php

namespace App\Http\Controllers;

use App\Models\GiftCategory;
use App\Models\GiftCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class GiftCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';


        $categories = GiftCategory::orderBy('created_at', 'desc')->simplePaginate(10);

        // $coupons = $categoryId
        //     ? GiftCoupon::where('giftCategoryId', $categoryId)->get()
        //     : GiftCoupon::all();
        // // return ($categories);

        return $isMobile
        ? $this->responseSuccess('Gift Categories', $categories)
        : view('backend.giftNcoupon.giftcategory', compact('categories'))->with('message','hello');;
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check if the request is from mobile using request_type
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Get the authenticated user
        // $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        // if (!$user) {
        //     return $isMobile
        //         ? $this->responseError('Unauthorized', 401)
        //         : redirect()->route('login')->with('error', 'Unauthorized access.');
        // }

        // Log::info('Authenticated Job Seeker ID: ' . $user->id);

        // $jobSeekerId = $user->id;

        $validator =Validator::make( $request->all(),[

            'gift_categories'=>'required|max:255',
        ]);

        if($validator->fails()){
            Log::error('Validation errors:', $validator->errors()->toArray());
            return $isMobile
            ? $this->responseError('Validation errors', 400, $validator->errors()->toArray())
            :redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Decode the JSON string into an associative array
        $giftCategories = json_decode($request->input('gift_categories'), true);

        // Check if decoding was successful
        if (!is_array($giftCategories)) {
            return response()->json(['message' => 'Invalid gift_categories format'], 422);
        }

        // Iterate over each job category and insert it into the database
        foreach ($giftCategories as $category) {
            if (!isset($category['name']) || !isset($category['status'])) {
                return response()->json(['message' => 'Each job category must have a name and a status'], 422);
            }

            GiftCategory::create([
                'giftCategoryTitle' => $category['name'],
                'status' => strtolower($category['status']),
            ]);
        }


        return $isMobile
        ? $this->responseSuccess('Gift category created successfully', $giftCategory)
        : redirect()->back()->with('success','Gift category created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GiftCategory  $giftCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //Check if the request is from mobile using request_type

        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Get the authenticated user

        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

        if (!$user) {

            return $isMobile
                ? $this->responseError('Unauthorized', 401)
                : redirect()->route('login')->with('error', 'Unauthorized access.');

        }

        Log::info('Authenticated Job Seeker ID: ' . $user->id);

        $jobSeekerId = $user->id;

        //get the gift category details

        $giftCategory  = GiftCategory::find($id);

        if (!$giftCategory) {

            return $isMobile
                ? $this->responseError('Gift category not found', 404)
                : redirect()->back()->with('error', 'Gift category not found');
        }

        return $isMobile
        ? $this->responseSuccess('Gift category details', $giftCategory)
        : redirect()->back()->with('success','Gift category details');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GiftCategory  $giftCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(GiftCategory $giftCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GiftCategory  $giftCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //Check the request is from mobile using request_type

        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        // return ($request->all());

        $validator =Validator::make( $request->all(),[

            'name'=>'required|max:255',
            'status'=>'nullable'
        ]);

        //Handle validation errors

        if($validator->fails()) {

            Log::error('Validation errors:', $validator->errors()->toArray());
            return $isMobile
            ? $this->responseError('Validation errors', 400, $validator->errors()->toArray())
            :redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $giftCategory = GiftCategory::findOrFail($id);

        if($giftCategory){
            $giftCategory->giftCategoryTitle = $request->input('name');
            $giftCategory->status = $request->input('status');

            $giftCategory->save();
        }

        

        Log::info('Gift category updated successfully with ID: ' . $giftCategory->id);

        return $isMobile
        ? $this->responseSuccess('Gift category updated successfully', $giftCategory)
        : redirect()->back()->with('success','Gift category updated successfully');
        
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GiftCategory  $giftCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        $category = GiftCategory::destroy($id);
        if($category){
            return $isMobile
            ? $this->responseSuccess('Gift category deleted successfully', $category)
            : redirect()->back()->with('success','Gift category deleted successfully');
        }
        return $isMobile
            ? $this->responseError('Some Error Occured', 201)
            : redirect()->back()->with('error','Some Error Occured');
    }


    public function publish(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        try{
            $category = GiftCategory::find($id);
            $category->publishStatus = true;
            $category->save();
            return $isMobile
            ? $this->responseSuccess('Gift category Published successfully', $category)
            : redirect()->back()->with('success','Gift category Published successfully');
        }
        catch(Exception $e){
            return $isMobile
            ? $this->responseError('Some Error Occured', 201)
            : redirect()->back()->with('error','Some Error Occured');
        }
        
        
    }

    public function unpublish(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        try{
            $category = GiftCategory::find($id);
            $category->publishStatus = false;
            $category->save();
            return $isMobile
            ? $this->responseSuccess('Gift category Un-Published successfully', $category)
            : redirect()->back()->with('success','Gift category Un-Published successfully');
        }
        catch(Exception $e){
            return $isMobile
            ? $this->responseError('Some Error Occured', 201)
            : redirect()->back()->with('error','Some Error Occured');
        }
    }
}
