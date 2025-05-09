<?php
namespace App\Http\Controllers;

use App\Events\ForumPost;
use App\Models\DiscussionForum;
use App\Models\Follower;
use App\Models\ForumInteraction;
use App\Models\ForumComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DiscussionForumController extends Controller
{

    public function index(Request $request, $category = null){


        $searchstr = $request->query('searchstr') ?? null;
        // $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        $forums = DiscussionForum::when(
            in_array($category, ['other', 'education', 'investment', 'scammer', 'office']),
            fn($query) => $query->where('category', $category)
        )
        ->when($searchstr, function($query) use($searchstr) {
            $query->where(function($q) use ($searchstr) {
                $q->where('topic', 'like', $searchstr . '%')
                  ->orWhere('description', 'like', $searchstr . '%')
                  ->orWhereHas('jobSeeker', function ($q2) use ($searchstr) {
                      $q2->whereRaw("CONCAT(firstName, ' ', lastName) LIKE ?", ["{$searchstr}%"]);
                  });
            });
        })
        ->latest()
        ->simplePaginate(5);
        
        // return $forums;  ->orWhereHas('user', function ($q2) use ($searchstr) {
         //     $q2->where('name', 'like', $searchstr . '%')
        
        return view('backend.discussion_forum.index', compact('forums', 'category'));
    }

    public function loadComment(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        try {
            $forumComments = ForumComment::where('forum_id', $id)->with('jobSeeker:id,firstName,lastName,userThumbnail')->get();

            $forumComments->transform(function ($comment) {
                if ($comment->jobSeeker && is_array($comment->jobSeeker->userThumbnail)) {
                    $thumbnails = $comment->jobSeeker->userThumbnail;

                    if (count($thumbnails) > 0) {
                        // Remove slashes if somehow they're still escaped (optional)
                        $path = str_replace('\\/', '/', $thumbnails[0]);

                        $comment->jobSeeker->userThumbnail = asset('storage/' . $path);
                    } else {
                        $comment->jobSeeker->userThumbnail = null;
                    }
                }

                return $comment;
            });

            return response()->json([
                'status'  => true,
                'message' => 'Success',
                'data'    => $forumComments,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->getMessage(),
            ]);
        }

    }

    public function addComment(Request $request)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        // return $request->all();
        // Determine authenticated user based on request type
        $user = $request->user();

        // Ensure user is authenticated and matches the requested profile
        if (! $user) {

            return response()->json([
                'success' => false,
                'message' => 'User not authenticated or access denied.',
            ], 401);
        }
        try {
            $validData = Validator::make($request->all(), [
                'comment'  => 'required|string',
                'forum_id' => 'required|exists:discussion_forums,id',
            ]);

            if ($validData->fails()) {

                return response()->json([
                    'status'  => false,
                    'message' => "Validation Error!",
                    'errors'  => $validData->errors(),

                ], 422);

            }

            $comment = ForumComment::create([
                'jobSeekerId' => $user->id,
                'forum_id'    => $request->input('forum_id'),
                'comment'     => $request->input('comment'),
            ]);

            return response()->json([
                'status'  => true,
                'message' => "Comment Added Successfully!",
                'data'    => $comment,
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => "Some Error Occured!",
                'errors'  => $e->getMessage(),

            ]);
        }
    }

    public function deleteComment(Request $request, $id)
    {

        $user = $request->user();

        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated or access denied.',
            ], 401);
        }

        try {
            $comment = ForumComment::find($id);

            if ($comment && $comment->jobSeekerId === $user->id) {
                $comment->delete();
                return response()->json([
                    'status'  => true,
                    'message' => "Comment Deleted Successfully!",
                    'data'    => $comment,
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => "Comment Not Found! or The comment belongs to someone else.",
                ]);
            }
        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => "Some Error Occured!",
                'errors'  => $e->getMessage(),
            ]);
        }
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        // Ensure user is authenticated and matches the requested profile
        if (! $user) {
            if ($isMobile) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated or access denied.',
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Please log in to add posts.');
        }

        $validData = Validator::make($request->all(), [
            'category'    => 'required|in:education,investment,scammer,office,other',
            'topic'       => 'required|string',
            'description' => 'required|string',
            'person_name' => 'nullable|string',
            'country'     => 'nullable|string',
            'images'      => 'nullable|array|max:5',
            'images.*'    => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validData->fails()) {
            if ($isMobile) {
                return response()->json([
                    'status'  => false,
                    'message' => "Validation Error!",
                    'errors'  => $validData->errors(),
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
                    $path         = $file->store('forumImages', 'public');
                    $imagePaths[] = $path;
                }
            }

            $forum = DiscussionForum::create([
                'topic'       => $request->input('topic'),
                'description' => $request->input('description'),
                'category'    => $request->input('category'),
                'images'      => $imagePaths,
                'jobSeekerId' => $user->id,
                'person_name' => $request->input('person_name'),
                'country'     => $request->input('country'),
            ]);

            // Web response (view rendering)
            if ($forum) {

                $forum = DiscussionForum::with('jobSeeker:id,firstName,lastName,temporaryLocation,userThumbnail')
                    ->withCount(['forumInteraction as likes' => function ($query) {
                        $query->where('type', 'like');
                    }])
                    ->withCount(['forumInteraction as dislikes' => function ($query) {
                        $query->where('type', 'dislike');
                    }])
                    ->withCount('forumComment as comments')
                    ->where('id', $forum->id)
                    ->first();

                if ($forum->jobSeeker && is_array($forum->jobSeeker->userThumbnail)) {
                    $thumbnails = $forum->jobSeeker->userThumbnail;

                    if (count($thumbnails) > 0) {
                        // Remove slashes if somehow they're still escaped (optional)
                        $path = str_replace('\\/', '/', $thumbnails[0]);

                        $forum->jobSeeker->userThumbnail = asset('storage/' . $path);
                    } else {
                        $forum->jobSeeker->userThumbnail = asset('frontend/assets/Images/profile.png');
                    }
                }

                $imagePaths = $forum->images ? $forum->images : [];
                $imageLinks = array_map(function ($path) {
                    return asset('storage/' . $path);
                }, $imagePaths);

                $forum->images = $imageLinks;

                if (Auth::guard('job_seekers')->check()) {
                    $forum->followed = Follower::where('followed_to', $forum->jobSeeker->id)->where('followed_by', Auth::guard('job_seekers')->id())->exists()
                        ? 'Follow' : "Unfollow";
                    

                }

                broadcast(new ForumPost($forum))->toOthers();

                if ($isMobile) {
                    return response()->json([
                        'status'  => true,
                        'message' => "Successfully Created Post!",
                        'data'    => $forum,
                    ]);
                }
                return redirect()->back()->with('success', "Post Created Successfully.");
            }

            if ($isMobile) {
                return response()->json([
                    'status'  => false,
                    'message' => "Unable to add post. Try again later!",

                ]);
            }

            return redirect()->back()->with('error', "Unable to add post. Try again later!");
        } catch (\Exception $e) {
            if ($isMobile) {
                return response()->json([
                    'status'  => false,
                    'message' => "Some Error Occured!",
                    'errors'  => $e->getMessage(),

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
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        // Ensure user is authenticated and matches the requested profile
        if (! $user) {
            if ($isMobile) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated or access denied.',
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Please log in to add posts.');
        }

        $validData = Validator::make($request->all(), [
            'category'    => 'nullable|in:education,investment,scammer,office,other',
            'topic'       => 'nullable|string',
            'description' => 'nullable|string',
            'country'     => 'nullable|string',
            'person_name' => 'nullable|string',
            'images'      => 'nullable|array',
            'images.*'    => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validData->fails()) {
            if ($isMobile) {
                return response()->json([
                    'status'  => false,
                    'message' => "Validation Error!",
                    'errors'  => $validData->errors(),

                ], 422);
            }

            // dd($validData->errors());

            return redirect()->back()->with('error', "Validation Error");
        }
        // dd($validData->errors());
        try {
            $forum = DiscussionForum::find($id);

            if ($forum && $forum->jobSeekerId == $user->id) {
                if ($request->hasFile('images')) {
                    $files = $request->file('images');

                    if ($forum->images) {
                        if (count($forum->images) === 5) {
                            $files = [];
                        } else {
                            $files = array_slice($files, 0, 5 - count($forum->images));
                        }
                    } else {
                        $files = array_slice($files, 0, 5);
                    }

                    $imagePaths = [];
                    foreach ($files as $file) {
                        $path         = $file->store('forumImages', 'public');
                        $imagePaths[] = $path;
                    }
                    // $user->userThumbnail[] = array_merge($user->userThumbnail, $imagePaths);
                    if ($forum->images) {
                        $newArr        = array_merge($forum->images, $imagePaths);
                        $forum->images = $newArr;
                    } else {
                        $forum->images = $imagePaths;
                    }

                }

                if ($request->topic) {
                    $forum->topic = $request->topic;
                }

                if ($request->description) {
                    $forum->description = $request->description;
                }

                if ($request->category) {
                    $forum->category = $request->category;
                }
                if($request->country){
                    $forum->country = $request->country;
                }
                if($request->person_name){
                    $forum->person_name = $request->person_name;
                }

                $forum->save();

                if ($isMobile) {
                    return response()->json([
                        'status'  => true,
                        'message' => "Successfully Updated Post!",
                        'data'    => $forum,
                    ]);
                }
                return redirect()->back()->with('success', "Post Updated Successfully.");

            }

            if ($isMobile) {
                return response()->json([
                    'status'  => false,
                    'message' => "The requested post doesnot exists or the post belongs to someone else.",

                ]);
            }

            return redirect()->back()->with('error', "The requested post doesnot exists or the post belongs to someone else.");
        } catch (\Exception $e) {
            if ($isMobile) {
                return response()->json([
                    'status'  => false,
                    'message' => "Some Error Occured!",
                    'errors'  => $e->getMessage(),

                ]);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
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
        if (! $user) {
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

            
            if ($forum->jobSeekerId = $user->id || Auth::guard('admin')->check()) {

                if ($forum->images) {
                    foreach ($forum->images as $imagePath) {
                        Storage::disk('public')->delete($imagePath);
                    }

                }

                $forum->delete();

                if ($isMobile) {
                    return response()->json([
                        'status'   => true,
                        'message'  => "Forum Post Deleted Successfully!",
                        'forum_id' => $id,
                    ]);
                }
                return redirect()->back()->with('success', "Forum Post Deleted Successfully.");
            }

            return $isMobile? response()->json([
                'status'  => false,
                'message' => "You dont have permission to perform this action!",


            ]) : redirect()->back()->with('error', "You dont have permission to perform this action!");
           
        } catch (\Exception $e) {
            if ($isMobile) {
                return response()->json([
                    'status'  => false,
                    'message' => "Validation Error!",
                    'errors'  => $e->getMessage(),

                ]);
            }

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function togglePinnedPost(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        $user     = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        // Ensure user is authenticated and matches the requested profile
        if (! $user) {

            return $isMobile ?
            response()->json([
                'status'  => false,
                'message' => "User not authenticated or access denied.",
            ]) : redirect()->back()->with('error', "User not authenticated or access denied.");

        }

        try {

            $forum = DiscussionForum::find($id);

            if (! $forum) {
                return $isMobile ?
                response()->json([
                    'status' => false,
                    'errors' => "Forum Post Not Found",
                ]) : redirect()->back()->with('error', "Forum Post Not Found");
            }

            // if ($forum->jobSeekerId != $user->id) {
            //     return $isMobile ?
            //     response()->json([
            //         'status'  => false,
            //         'message' => "The requested post belongs to another user.",
            //     ], 501) : redirect()->back()->with('error', "The requested post belongs to another user.");
            // }

            $forum->pinned = ! $forum->pinned;
            $forum->save();

            return $isMobile ?
            response()->json([
                'status'  => true,
                'message' => "Forum Post Pinned toggled Successfully",
                'action'  => $forum->pinned ? 'pinned' : 'unpinned',
            ]) : redirect()->back()->with('success', "Forum Post Pinned Successfully");

        } catch (\Exception $e) {
            return $isMobile ?
            response()->json([
                'status'  => false,
                'message' => "Some Error Occured!",
                'errors'  => $e->getMessage(),
            ]) : redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function followToUser(Request $request)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        // Ensure user is authenticated and matches the requested profile
        if (! $user) {

            return response()->json([
                'success' => false,
                'message' => 'User not authenticated or access denied.',
            ], 401);

        }

        // return $request->follow_to;

        try {
            $validData = Validator::make($request->all(), [
                'follow_to' => 'required|exists:job_seekers,id',
            ]);

            if ($validData->fails()) {
                if ($isMobile) {
                    return response()->json([
                        'status'  => false,
                        'message' => "Validation Error!",
                        'errors'  => $validData->errors(),

                    ]);
                }
                return redirect()->back()->with('error', "Validation Error!");
            }

            $follow = Follower::where('followed_by', $user->id)->where('followed_to', $request->follow_to)->first();

            if ($follow) {
                $follow->delete();
                return response()->json([
                    'status'  => true,
                    'message' => "Successfully Unfollowed!",
                ]);
            } else {

                if ($request->follow_to == $user->id) {
                    return response()->json([
                        'status'  => false,
                        'message' => "You can't follow yourself!",
                    ]);
                }
                $follow              = new Follower();
                $follow->followed_by = $user->id;
                $follow->followed_to = $request->follow_to;
                $follow->save();
                return response()->json([
                    'status'  => true,
                    'message' => "Successfully Followed!",
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => "Some thing went wrong!",
                'errors'  => $e->getMessage(),
            ]);
        }
    }

    public function deleteImage(Request $request)
    {
        // return $request->all();
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        // Ensure user is authenticated and matches the requested profile
        if (! $user) {
            if ($isMobile) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated or access denied.',
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Please log in to access your profile.');
        }

        try {

            $validData = Validator::make($request->all(), [
                'image_index' => 'required|integer',
                'forum_id'    => 'required|exists:discussion_forums,id',

            ]);

            if ($validData->fails()) {
                if ($isMobile) {
                    return response()->json([
                        'status'  => false,
                        'message' => "Validation Error!",
                        'errors'  => $validData->errors(),

                    ]);
                }
                return redirect()->back()->with('error', "Validation Error!");
            }
            $index    = $request->image_index;
            $forum_id = $request->forum_id;
            $forum    = DiscussionForum::find($forum_id);

            // return $forum;

            if ($forum->jobSeekerId != $user->id) {
                return $isMobile ?
                response()->json([
                    'status'  => false,
                    'message' => "You are not authorized to delete this image!",
                ]) : redirect()->back()->with('error', "You are not authorized to delete this image!");
            }

            if ($forum->images) {
                $images = $forum->images;
                if (isset($images[$index])) {
                    // Remove the image at the given index
                    $imagePath = $images[$index];

                    unset($images[$index]);

                    // Re-index the array (optional but ensures the keys are correct)
                    $images = array_values($images);
                    Storage::disk('public')->delete($imagePath);
                    // Save the updated model
                    $forum->images = $images;
                    $forum->save();
                }

                // API response for mobile clients
                if ($isMobile) {
                    return response()->json([
                        'status'  => true,
                        'message' => "Successfully Deleted Image.",

                    ]);
                }

                // Web response (view rendering)
                return redirect()->back()->with('success', 'Successfully Deleted Image.');
            }

            return $isMobile ?
            response()->json([
                'status'  => false,
                'message' => "No Image Found!",
            ]) : redirect()->back()->with('error', "No Image Found!");

        } catch (\Exception $e) {
            return $isMobile ?
            response()->json([
                'status'  => false,
                'message' => "Some Error Occured!",
                'errors'  => $e->getMessage(),
            ]) : redirect()->back()->with('error', $e->getMessage());
        }

    }

}
