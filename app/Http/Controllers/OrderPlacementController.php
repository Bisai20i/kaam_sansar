<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\OrderPlacement;

class OrderPlacementController extends Controller
{
    // public function submitorder(){
    //     $cart_order = 
    // }


    public function placeOrder(Request $request){
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        //  Get the authenticated user
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        if (!$user) {
             return $isMobile
                 ? $this->responseError('Unauthorized', 401)
                 : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        Log::info('Authenticated Job Seeker ID: ' . $user->id);

        $jobSeekerId = $user->id;

        $validatedData = Validator::make($request->all(), [

            'full_name' => 'required|string',                 
            'email' => 'required|email',           
            'phone' => 'required|string|regex:/^[0-9+()-]+$/',  // Allows numbers, +, -, and ()
            'alternative_phone' => 'nullable|string|regex:/^[0-9+()-]+$/',
            'country' => 'required|string',
            'city' => 'required|string',
            'appartment_no' => 'required|integer',
            'house_no' => 'required|integer',
            'landmark' => 'required|string',  // Changed from `integer` to `string`
            'expected_date' => 'nullable|date',
            'preferred_time' => 'nullable|in:morning,day,evening,night', // Fixed `in_array`
            'instructions' => 'nullable|string' // Changed `longText` to `string`

        ]);
        
        if ($validatedData->fails()) {
            Log::error('Validation errors: ', $validatedData->errors()->toArray());
            // return $validatedData->errors()->all();
            return $isMobile
                ? $this->responseError('Validation failed.', 422, $validatedData->errors())
                : redirect()->back()->withErrors($validatedData->errors())->withInput();
        }

        try{
            $order = OrderPlacement::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'alternative_phone' => $request->alternative_phone,
                'country' => $request->country,
                'city' => $request->city,
                'appartment_no' => $request->appartment_no,
                'house_no' => $request->house_no,
                'nearest_landmark' => $request->landmark,
                'expected_delivery_time' => $request->expected_delivery_time,
                'preferred_time' => $request->preferred_time,
                'payment_method' => $request->payment_method ?? 'cod',
                'instructions' => $request->instructions,
                'discount_amount' => $request->discount_amount,
                'sub_total' => $request->sub_total,
                'voucher_id' => $request->voucher_id,
                'voucher_discount' => $request->voucher_discount ?? 0,
                'jobSeekerId' => $jobSeekerId,
            ]);

            if($order){
                // $cartItems = GiftCart::with('giftCoupon')->where('jobSeekerId',$jobSeekerId)->get();

                return $isMobile
                ? $this->responseSuccess('Order Details added successfully!', $order)
                : redirect()->back()->with('success', 'Order Details added successfully!');

            }
        }
        catch(Execption $e){
            return $isMobile
            ? $this->responseError('Some Error Occured', 400, $e->getMessage())
            : redirect()->back()->with('error',$e->getMessage());
        }



    }






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
