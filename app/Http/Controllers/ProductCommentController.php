<?php
namespace App\Http\Controllers;

use App\Models\ProductComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductCommentController extends Controller
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
        if (! $user) {
            return $isMobile
            ? $this->responseError('Unauthorized', 401)
            : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        Log::info('Authenticated Job Seeker ID: ' . $user->id);
        $jobSeekerId = $user->id;

        // Validate request data
        $validator = Validator::make($request->all(), [
            'comment'   => 'required|string|max:1000',
            'productId' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Create a new comment
        $comment              = new ProductComment();
        $comment->productId   = $request->input('productId');
        $comment->jobSeekerId = $jobSeekerId;
        $comment->comment     = $request->input('comment');
        $comment->save();

        Log::info('Comment created successfully.');

        // Return JSON response for mobile API or AJAX
        if ($isMobile || $request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status'  => true,
                'message' => 'Comment created successfully',
                'data'    => $comment,
            ], 200);
        }

        return redirect()->back()->with('success', 'Comment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductComment  $productComment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        $comments = ProductComment::where('productId', $id)
            ->with('jobSeeker:id,firstName,lastName,userThumbnail')
            ->latest()
            ->get();
        $comments->transform(function ($comment) {
            if ($comment->jobSeeker && is_array($comment->jobSeeker->userThumbnail)) {
                $thumbnails = $comment->jobSeeker->userThumbnail;

                if (count($thumbnails) > 0) {
                    // Remove slashes if somehow they're still escaped (optional)
                    $path = str_replace('\\/', '/', $thumbnails[0]);

                    $comment->jobSeeker->userThumbnail = asset('storage/' . $path);
                } else {
                    $comment->jobSeeker->userThumbnail = asset('frontend/assets/Images/profile.jpg');
                }
            }

            return $comment;
        });
        if (! $comments) {
            return $isMobile || $request->ajax()
            ? $this->responseError('Comment details not found', 404)
            : redirect()->back()->with('error', 'Comment details not found');
        }

        if ($isMobile) {
            return $this->responseSuccess('Comment details', $comments);
        }

        // 🧩 Add this part to support AJAX call from web
        if ($request->ajax()) {
            return response()->json([
                'status'  => true,
                'message' => 'Comment details',
                'data'    => $comments,
            ]);
        }

        return view('frontend.aboarddeals.show', compact('comments'))
            ->with('commentsView', view('frontend.aboarddeals.abaord', compact('comments')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductComment  $productComment
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductComment $productComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductComment  $productComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //check if the request type is mobile
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        $comment = ProductComment::find($id);

        if (! $comment) {
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
     * @param  \App\Models\ProductComment  $productComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        $comment  = ProductComment::find($id);

        if (! $comment) {
            return $isMobile || $request->ajax()
            ? $this->responseError('Comment not found', 404)
            : redirect()->back()->with('error', 'Comment not found');
        }

        $comment->delete();

        return $isMobile || $request->ajax()
        ? response()->json([
            'status'  => true,
            'message' => 'Comment deleted successfully'])
        : redirect()->back()->with('success', 'Comment deleted successfully');
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
