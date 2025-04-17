<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\GiftCart;
use App\Models\GiftCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GiftCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addtocart(Request $req)
    {
        // dd($req->all());
        $isMobile = $req->has('request_type') && $req->input('request_type') === 'mobile';
        $user = $isMobile ? $req->user() : Auth::guard('job_seekers')->user();
        if (!$user) {
             return $isMobile
                 ? $this->responseError('Unauthorized', 401)
                 : redirect()->route('login')->with('error', 'Unauthorized access.');
        }
        $validatedData = Validator::make($req->all(), [

            'couponId' => 'required|numeric',

        ]);
        
        if ($validatedData->fails()) {
            Log::error('Validation errors: ', $validatedData->errors()->toArray());
            // return $validatedData->errors()->all();
            return $isMobile
                ? $this->responseError('Validation failed.', 422, $validatedData->errors())
                : redirect()->back()->withErrors($validatedData->errors())->withInput();
        }

        try{
            $giftCoupon = GiftCoupon::where('publishStatus', true)->where('id', $req->couponId)->first();

            if (!$giftCoupon) {
                return $isMobile ? $this->responseError('Illegal Operation Detected',501)
                : redirect()->back()->with('error', 'Illegal Operation Detected');
            }
            $giftCart = GiftCart::where('coupon_id', $req->couponId)->first();
            
            if ($giftCart && $giftCart->jobSeekerId === $user->id) {

                $giftCart->quantity = $giftCart->quantity + 1;
                $giftCart->save();

                
            }   
            else{
                GiftCart::create([
                    'coupon_id' => $req->couponId,
                    'jobSeekerId' => $user->id,
            
                    ]);
                }
        

            return $isMobile
                ? $this->responseSuccess('Item Added to Cart Successfully.')
                : redirect()->back()->with('success', 'Item Added to Cart Successfully.');

        }
        catch(Exception $e){
            return $isMobile
                ? $this->responseError('Some Error Occured', 400, $e->getMessage())
                : redirect()->back()->with('error',$e->getMessage());
        }

    }

    public function addquantity(Request $req, $id){

        $isMobile = $req->has('request_type') && $req->input('request_type') === 'mobile';
        $user = $isMobile ? $req->user() : Auth::guard('job_seekers')->user();
        if (!$user ) {
             return $isMobile
                 ? $this->responseError('Unauthorized', 401)
                 : redirect()->route('login')->with('error', 'Unauthorized access.');
        }
        try{

            $giftcart = GiftCart::find($id);
            if ($giftcart && $giftcart->jobSeekerId === $user->id) {
                $giftcart->quantity = $giftcart->quantity + 1;
                $giftcart->save();
                return $isMobile
                ? $this->responseSuccess('Quantity of the item Added successfully.', $giftcart)
                : redirect()->back()->with('success', 'Quantity of the item Added successfully.');
            }
            else{
                return $isMobile
                ? $this->responseError('Illegal Action Performed', 400)
                : redirect()->back()->with('error','Illegal Action Performed');
            }

        }
        catch(Exception $e){
            return $isMobile
                ? $this->responseError('Some Error Occured', 400, $e->getMessage())
                : redirect()->back()->with('error',$e->getMessage());
        }

        
    }

    public function subquantity(Request $req, $id){

        $isMobile = $req->has('request_type') && $req->input('request_type') === 'mobile';
        $user = $isMobile ? $req->user() : Auth::guard('job_seekers')->user();
        if (!$user ) {
             return $isMobile
                 ? $this->responseError('Unauthorized', 401)
                 : redirect()->route('login')->with('error', 'Unauthorized access.');
        }
        try{

            $giftcart = GiftCart::find($id);
            if ($giftcart && $giftcart->jobSeekerId === $user->id) {
                $giftcart->quantity = $giftcart->quantity - 1;
                $giftcart->save();
                return $isMobile
                ? $this->responseSuccess('Quantity of the item Subtracted successfully.', $giftcart)
                : redirect()->back()->with('success', 'Quantity of the item Subtracted successfully.');
            }
            else{
                return $isMobile
                ? $this->responseError('Illegal Action Performed', 400)
                : redirect()->back()->with('error','Illegal Action Performed');
            }

        }
        catch(Exception $e){
            return $isMobile
                ? $this->responseError('Some Error Occured', 400, $e->getMessage())
                : redirect()->back()->with('error',$e->getMessage());
        }

        
    }

    public function deletecarts(Request $req){

        $isMobile = $req->has('request_type') && $req->input('request_type') === 'mobile';
        $user = $isMobile ? $req->user() : Auth::guard('job_seekers')->user();
        if (!$user) {
             return $isMobile
                 ? $this->responseError('Unauthorized', 401)
                 : redirect()->route('login')->with('error', 'Unauthorized access.');
        }
        $validatedData = Validator::make($req->all(), [

            'ids' => 'required|array',
            'ids.*' => 'integer|exists:gift_carts,id', 

        ]);
        
        if ($validatedData->fails()) {
            Log::error('Validation errors: ', $validatedData->errors()->toArray());
            // return $validatedData->errors()->all();
            return $isMobile
                ? $this->responseError('Validation failed.', 422, $validatedData->errors())
                : redirect()->back()->withErrors($validatedData->errors())->withInput();
        }
        try{
            $ids = $req->ids;
            foreach($ids as $id){
                $cartItem = GiftCart::find($id);
                if($cartItem->jobSeekerId !== $user->id){
                    return $isMobile
                        ? $this->responseError('The coupon Id you entered belongs to someone else.', 401)
                        : redirect()->back()->with('error', 'The coupon Id you entered belongs to someone else.');
                }
            }
            GiftCart::whereIn('id', $req->ids)->delete();
            return $isMobile
                ? $this->responseSuccess('Cart items* Deleted successfully.')
                : redirect()->back()->with('success', 'Cart Items* Deleted successfully.');
        }
        // Delete the selected items
        catch (Exception $e) {
            return $isMobile
            ? $this->responseError('Unauthorized', $e->getMessage())
            : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

 
        
    }


    //display all cart items of a user
    public function couponcart(Request $req){
        $isMobile = $req->has('request_type') && $req->input('request_type') === 'mobile';
        $user = $isMobile ? $req->user() : Auth::guard('job_seekers')->user();
        if (!$user) {
             return $isMobile
                 ? $this->responseError('Unauthorized', 401)
                 : redirect()->route('login')->with('error', 'Unauthorized access.');
        }
        $jobSeekerId = $user->id;
        try{
            $coupons = GiftCart::with('giftCoupon')->where('jobSeekerId',$jobSeekerId)->get();
            return $isMobile
                ? $this->responseSuccess('All Cart items', $coupons)
                : view('frontend.giftNcoupon.giftcart', compact('coupons'));

        }
        catch(Exception $e){
            return $isMobile
            ? $this->responseError('Unauthorized', $e->getMessage())
            : redirect()->route('login')->with('error', 'Unauthorized access.');
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
