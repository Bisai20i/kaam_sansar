<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserComment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserCommentController extends Controller
{
    public function addComment(Request $request){
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        //  Get the authenticated user
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        if (!$user) {
             return $isMobile
                 ? response()->json(['status'=>false,'message'=> 'Unauthorized access.'])
                 : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        try{

            $validRequest = Validator::make($request->all(), [
                'giftId'  => 'required|numeric',
                'comment' => 'required|string'
            ]);
            
            if ($validRequest->fails()) {
                return $isMobile
                    ? response()->json([
                        'status'  => false,
                        'message' => 'Validation Error',
                        'error'   => $validRequest->errors()->all()
                    ])
                    : redirect()->back()->withErrors($validRequest->errors());
            }
            $jobSeekerId = $user->id;
            $giftId = $request->input('giftId');

            $userComment = UserComment::create([
                'jobSeekerId' => $jobSeekerId,
                'giftCouponId' => $giftId,
                'comment' => $request->input('comment')
            ]);

            
            return $isMobile
                 ? response()->json(['status'=>true,'message'=> 'Comment Added Successfully', 'data' => $userComment])
                 : redirect()->back()->with('success', "Comment Posted Successfully.")->with('cmtEnable', true);

        }
        catch(\Exception $e){
            return $isMobile
                 ? response()->json(['status'=>false,'message'=> 'Some Internal Error Occured', 'error' => $e->getMessage()])
                 : redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteComment(Request $request, $id){
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        //  Get the authenticated user
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        if (!$user) {
             return $isMobile
                 ? response()->json(['status'=>false,'message'=> 'Unauthorized access.'])
                 : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        try{

            $userComment = UserComment::findOrFail($id);

            if( $userComment &&$userComment->jobSeekerId === $user->id){
                $userComment->delete();

                return $isMobile
                 ? response()->json(['status'=>true,'message'=> 'Comment Deleted Successfully', 'data' => $userComment])
                 : redirect()->back()->with('success', "Comment Deleted Successfully.")->with('cmtEnable', true);
            }




            
            return $isMobile
                 ? response()->json(['status'=>false,'message'=> 'Illegal Action Performed'])
                 : redirect()->back()->with('error', "Illegal Action Performed")->with('cmtEnable', true);

        }
        catch(\Exception $e){
            return $isMobile
                 ? response()->json(['status'=>false,'message'=> 'Some Internal Error Occured', 'error' => $e->getMessage()])
                 : redirect()->back()->with('error', $e->getMessage());
        }
    }

    // public function getAllComments(Request $request, $id){
    //     $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

    //     try{

    //         $giftComments = UserComments::with('jobSeeker')
    //             ->where('giftCouponId', $id)
    //             ->latest()
    //             ->take(4)
    //             ->get();

    //         return $isMobile
    //              ? response()->json(['status'=>true,'message'=> 'Recent Comments', 'data' => $giftComments])
    //              : redirect()->back()->with('success', "Comment Posted Successfully.");

    //     }
    //     catch(\Exception $e){
    //         return $isMobile
    //              ? response()->json(['status'=>false,'message'=> 'Some Internal Error Occured', 'error' => $e->getMessage()])
    //              : redirect()->back()->with('error', $e->getMessage());
    //     }
        
    // }
}
