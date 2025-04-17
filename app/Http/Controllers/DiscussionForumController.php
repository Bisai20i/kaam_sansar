<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DiscussionForum;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Events\ForumPost;

class DiscussionForumController extends Controller
{

    
    public function placeComment(Request $request)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        // Ensure user is authenticated and matches the requested profile
        if (!$user) {
            if ($isMobile) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated or access denied.',
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Please log in to access your profile.');
        }
        try {
            $validData = Validator::make($request->allI(), [
                'comment' => 'required|string'
            ]);

            if ($validData->fails()) {
                if ($isMobile) {
                    return response()->json([
                        'status' => false,
                        'message' => "Validation Error!",
                        'errors' => $validData->errors(),

                    ], 422);
                }

                return redirect()->back()->with('error', "Validation Error")->withErrors($validData->errors());
            }
        } catch (\Exception $e) {
            if ($isMobile) {
                return response()->json([
                    'status' => false,
                    'message' => "Some Error Occured!",
                    'errors' => $e->getMessage(),

                ]);
            }

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        // Ensure user is authenticated and matches the requested profile
        if (!$user) {
            if ($isMobile) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated or access denied.',
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Please log in to add posts.');
        }


        $validData = Validator::make($request->all(), [
            'category' => 'required|in:education,investment,scammer,office,other',
            'topic' => 'required|string',
            'description' => 'required|string',
            'images' => 'nullable|array|max:5',
            'images.*' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validData->fails()) {
            if ($isMobile) {
                return response()->json([
                    'status' => false,
                    'message' => "Validation Error!",
                    'errors' => $validData->errors(),

                ], 422);
            }

            // dd($validData->errors());

            return redirect()->back()->with('error', "Validation Error");
        }
        // dd($validData->errors());
        try {
            $imagePaths = [];
            if ($request->hasFile('images')) {
                $files = $request->file('images');

                // Limit to 5 images
                $files = array_slice($files, 0, 5);

                foreach ($files as $file) {
                    $path = $file->store('forumImages', 'public');
                    $imagePaths[] = $path;
                }
            }

            $forum = DiscussionForum::create([
                'topic' => $request->input('topic'),
                'description' => $request->input('description'),
                'category' => $request->input('category'),
                'images' => $imagePaths,
                'jobSeekerId' => $user->id
            ]);

            // Web response (view rendering)
            if ($forum) {

                broadcast(new ForumPost("New Post Available"))->toOthers();
                
                if ($isMobile) {
                    return response()->json([
                        'status' => true,
                        'message' => "Successfully Created Post!",
                        'data' => $forum,
                    ]);
                }
                return redirect()->back()->with('success', "Post Created Successfully.");
            }

            if($isMobile){
                return response()->json([
                    'status' => false,
                    'message' => "Unable to add post. Try again later!",

                ]);
            }

            return redirect()->back()->with('error', "Unable to add post. Try again later!");
        } catch (\Exception $e) {
            if ($isMobile) {
                return response()->json([
                    'status' => false,
                    'message' => "Some Error Occured!",
                    'errors' => $e->getMessage(),

                ]);
            }
            return $e->getMessage();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        // Ensure user is authenticated and matches the requested profile
        if (!$user) {
            if ($isMobile) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated or access denied.',
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Please log in to access your profile.');
        }

        try {


            $forum = DiscussionForum::find($id);
            if ($forum->jobSeekerId = $user->id) {

                if($forum->images){
                    foreach($forum->images as $imagePath){
                        Storage::disk('public')->delete($imagePath);
                    }

                }

                $forum->delete();

                if ($isMobile) {
                    return response()->json([
                        'status' => true,
                        'message' => "Forum Post Deleted Successfully!",
                        'forum_id' => $id,
                    ]);
                }
                return redirect()->back()->with('success', "Forum Post Deleted Successfully.");
            }
        } catch (\Exception $e) {
            if ($isMobile) {
                return response()->json([
                    'status' => false,
                    'message' => "Validation Error!",
                    'errors' => $e->getMessage(),

                ]);
            }

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
