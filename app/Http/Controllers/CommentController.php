<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //check if the request type
        // Check if the request is from mobile using request_type
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
        $commentPersonImg = $user->userThumbnail;
         // Get the job seeker's first and last name
        $fullName = $user->firstName . ' ' . $user->lastName;

        // Validate request data
        $validator = Validator::make($request->all(), [
            'commentPersonName' => 'nullable|string|max:255',
            'commentPersonImg' => 'nullable|Image|mimes:jpeg,png,jpg,gif|max:2048',
            'comment' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Create a new comment
        $comment = new Comment();
        $comment->adsId = $request->input('adsId');
        $comment->jobSeekerId = $jobSeekerId;
        $comment->commentPersonName = $fullName;
        $comment->commentPersonImg = $commentPersonImg;
        $comment->comment = $request->input('comment');
        $comment->save();

        Log::info('Comment created successfully.');

        return $isMobile
            ? $this->responseSuccess('Comment created successfully', $comment)
            : redirect()->back()->with('success', 'Comment created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //check if the request type is mobile
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        $comments = Comment::where('adsId', $id)->with('jobSeeker')->get();

        if (!$comments) {
            return $isMobile
                ? $this->responseError('Comment details not found', 404)
                : redirect()->back()->with('error', 'Comment details not found');
        }
        return $isMobile
            ? $this->responseSuccess('Comment details', $comments)
            : redirect()->back()->with('success', 'Comment details');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //check if the request type is mobile
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        $comment = Comment::find($id);

        if (!$comment) {
            return $isMobile
                  ? $this->responseError('Comment not found', 404)
                : redirect()->back()->with('error', 'Comment not found');
        }

        

        $validator = Validator::make($request->all(), [
            'comment' => 'required|string|max:1000',
        ]);



        // Handle validation errors
        if ($validator->fails()) {
            Log::error('Validation errors: ', $validator->errors()->toArray());
            return $isMobile
                ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
                : redirect()->back()->withErrors($validator->errors())->withInput();
        }
        //handle the image
        //update the filled

        $comment->comment = $request->input('comment');
        $comment->save();

        return $isMobile

            ? $this->responseSuccess('Commnent updated sccessfully', $comment)
            : redirect()->back()->with('success', 'Comment updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */

   public function destroy(Request $request, $id)
{
    $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
    $comment = Comment::find($id);

    if (!$comment) {
        return $isMobile
            ? $this->responseError('Comment not found', 404)
            : redirect()->back()->with('error', 'Comment not found');
    }

    $comment->delete();

    return $isMobile
        ? $this->responseSuccess('Comment deleted successfully')
        : redirect()->back()->with('success', 'Comment deleted successfully');
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

