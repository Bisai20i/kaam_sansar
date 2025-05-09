<?php
namespace App\Http\Controllers;

use App\Models\ForumInteraction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ForumInteractionController extends Controller
{
    public function interact(Request $request)
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
        try {

            $validRequest = Validator::make($request->all(), [
                'type'    => 'required|in:like,dislike',
                'post_id' => 'required|exists:discussion_forums,id',
            ]);

            if ($validRequest->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => "Validation Error!",
                    'errors'  => $validRequest->errors(),
                ], 422);
            }

            $interaction = ForumInteraction::where('forum_id', $request->post_id)->where('jobSeekerId', $user->id)->first();

            if ($interaction) {

                if ($interaction->type === $request->type) {

                    $interaction->delete();

                    return response()->json([
                        'status'        => true,
                        'message'       => "Interaction removed successfully!",
                        'action'        => 'remove',
                        'like_count'    => ForumInteraction::where('forum_id', $request->post_id)->where('type', 'like')->count(),
                        'dislike_count' => ForumInteraction::where('forum_id', $request->post_id)->where('type', 'dislike')->count(),
                    ], 200);

                }

                $interaction->type === 'like' ? $interaction->type = 'dislike' : $interaction->type = 'like';

                $interaction->save();

                return response()->json([
                    'status'        => true,
                    'message'       => "Interaction with post successed!",
                    'action'        => 'toggle',
                    'like_count'    => ForumInteraction::where('forum_id', $request->post_id)->where('type', 'like')->count(),
                    'dislike_count' => ForumInteraction::where('forum_id', $request->post_id)->where('type', 'dislike')->count(),
                ], 200);
            } else {

                $interaction              = new ForumInteraction();
                $interaction->jobSeekerId = $user->id;
                $interaction->type        = $request->type;
                $interaction->forum_id    = $request->post_id;
                $interaction->save();

                return response()->json([
                    'status'  => true,
                    'message' => "Interaction added successfully!",
                    'action'  => 'add',
                    'like_count' => ForumInteraction::where('forum_id', $request->post_id)->where('type', 'like')->count(), 
                    'dislike_count' => ForumInteraction::where('forum_id', $request->post_id)->where('type', 'dislike')->count()

                ], 200);

            }

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => "Some thing went wrong!",
                'errors'  => $e->getMessage(),
            ]);
        }
    }
}
