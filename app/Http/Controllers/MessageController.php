<?php
namespace App\Http\Controllers;

use App\Events\NewMessageEvent;
use App\Models\AdminMessage;
use App\Models\JobSeeker;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{

    public function sendMessage(Request $request)
    {

        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

        // Ensure user is authenticated and matches the requested profile
        if (! $user) {
            return response()->json([
                'status'  => false,
                'message' => 'User not authenticated or access denied.',
            ], 401);

        }

        try {

            $validMessage = Validator::make($request->all(), [
                'receiver_id' => 'required|exists:job_seekers,id',
                'message'     => 'required|string',
            ]);

            if ($validMessage->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validation Error',
                    'errors'  => $validMessage->errors()->all(),
                ], 422);
            }

            $message = Message::create([
                'sender_id'   => $user->id,
                'receiver_id' => $request->receiver_id,
                'message'     => $request->message,
                // 'reference_id' => $request->reference_id,
            ]);

            broadcast(new NewMessageEvent($message))->toOthers();

            if ($message) {

                return response()->json([
                    'status'  => true,
                    'message' => 'Message Sent Successfully',
                    'data'    => $message,
                ], 200);

            }
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function user_inbox(Request $request)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

        if (! $user) {
            return $isMobile
            ? response()->json([
                'status'  => false,
                'message' => 'User not authenticated or access denied.',
            ])
            : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        try {
            // Get latest messages
            $latestMessageIds = Message::where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->orWhere('receiver_id', $user->id);
            })
                ->select(DB::raw('MAX(id) as id'))
                ->groupBy(DB::raw('LEAST(sender_id, receiver_id), GREATEST(sender_id, receiver_id)'))
                ->pluck('id');

            $latestMessages = Message::whereIn('id', $latestMessageIds)
                ->orderBy('created_at', 'desc')
                ->get();

            $uniqueConversations = [];

            foreach ($latestMessages as $message) {
                $otherUserId = $message->sender_id === $user->id ? $message->receiver_id : $message->sender_id;

                $otherUser = JobSeeker::select('id', 'firstName', 'lastName', 'status', 'userThumbnail')
                    ->find($otherUserId);

                $message->otherUser    = $otherUser;
                $uniqueConversations[] = $message;
            }

            $uniqueConversations = collect($uniqueConversations)->transform(function ($message) {
                if ($message->otherUser && is_array($message->otherUser->userThumbnail)) {
                    $thumbnails = $message->otherUser->userThumbnail;
                    if (count($thumbnails) > 0) {
                        $path                              = str_replace('\\/', '/', $thumbnails[0]);
                        $message->otherUser->userThumbnail = asset('storage/' . $path);
                    } else {
                        $message->otherUser->userThumbnail = null;
                    }
                }
                return $message;
            });

                                                           // 🆕 Fetch admin messages with Jyotish info
            $adminMessages = AdminMessage::with('jyotish') // eager load jyotish relation
                ->where('jobseeker_id', $user->id)
                ->latest()
                ->get()
                ->map(function ($message) {
                    // Optional: handle jyotish photo
                    if ($message->jyotish && is_array($message->jyotish->photo)) {
                        $photos                  = $message->jyotish->photo;
                        $message->jyotish->photo = count($photos) > 0
                        ? asset('storage/' . str_replace('\\/', '/', $photos[0]))
                        : null;
                    }
                    return $message;
                });

            return $isMobile
            ? response()->json([
                'status'        => true,
                'message'       => 'Messages retrieved successfully',
                'uniqueSenders' => $uniqueConversations,
                'adminMessages' => $adminMessages,
            ])
            : view('frontend.profile.inbox', compact('uniqueConversations', 'adminMessages'));

        } catch (\Exception $e) {
            return $isMobile
            ? response()->json([
                'status'  => false,
                'message' => 'Unexpected error occurred',
                'errors'  => $e->getMessage(),
            ])
            : redirect()->route('login')->with('error', 'Unauthorized access.');
        }
    }

    public function sender_messages(Request $request)
    {

        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

        // Ensure user is authenticated and matches the requested profile
        if (! $user) {
            return $isMobile
            ? response()->json([
                'status'  => false,
                'message' => 'User not authenticated or access denied.',
            ])
            : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        try {

            $sender_id = $request->sender_id;

            $messages = Message::where(function ($query) use ($sender_id) {
                $query->where('sender_id', auth()->id())
                    ->where('receiver_id', $sender_id);
                // ->where('reference_id',$reference_id);
            })
                ->orWhere(function ($query) use ($sender_id) {
                    $query->where('sender_id', $sender_id)
                        ->where('receiver_id', auth()->id());
                })
                ->orderBy('created_at', 'asc')
                ->get();

            foreach ($messages as $message) {

                if (! $message->is_read && $message->receiver_id == $user->id) {
                    $message->is_read = true;
                    $message->save();
                }

            }

            return response()->json([
                'status'   => true,
                'message'  => 'Messages Retrieved Successfully',
                'messages' => $messages,
            ]);

        } catch (\Exception $e) {
            return $isMobile
            ? response()->json([
                'status'  => false,
                'message' => 'Unexpected Error Occrued',
                'errors'  => $e->getMessage(),
            ])
            : redirect()->route('login')->with('error', 'Unauthorized access.');
        }
    }

    public function search_user(Request $request)
    {

        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

        // Ensure user is authenticated and matches the requested profile
        if (! $user) {
            return $isMobile
            ? response()->json([
                'status'  => false,
                'message' => 'User not authenticated or access denied.',
            ])
            : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        try {

            $searchstr = $request->searchstr;

            $results = JobSeeker::where(function ($query) use ($searchstr) {
                $query->where('firstName', 'LIKE', '%' . $searchstr . '%')
                    ->orWhere('lastName', 'LIKE', $searchstr . '%')
                    ->orWhereRaw("CONCAT(firstName, ' ', lastName) LIKE ?", ["%" . $searchstr . "%"]);
                })
                ->select('id', 'firstName', 'lastName', 'userThumbnail')
                ->get();

            if (! $results->isEmpty()) {

                $results->transform(function ($result) {

                    if ($result->userThumbnail && is_array($result->userThumbnail)) {
                        $thumbnails = $result->userThumbnail;

                        if (count($thumbnails) > 0) {
                            // Remove slashes if somehow they're still escaped (optional)
                            $path = str_replace('\\/', '/', $thumbnails[0]);

                            $result->userThumbnail = asset('storage/' . $path);
                        }

                    } else {
                        $result->userThumbnail = asset('frontend/assets/Images/profile.jpg');
                    }

                    return $result;
                });

                return response()->json([
                    'status'  => true,
                    'message' => 'Users Found Successfully',
                    'users'   => $results,
                ], 200);
            }

            return response()->json([
                'status'  => false,
                'message' => 'No Users Found',
            ], 404);

        } catch (\Exception $e) {
            return $isMobile
            ? response()->json([
                'status'  => false,
                'message' => 'Unexpected Error Occrued',
                'errors'  => $e->getMessage(),
            ])
            : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

    }

    // public function fireEvent(){
    //     $message = new Message();
    //     $message->sender_id = 1;
    //     $message->receiver_id = 2;
    //     $message->message = "Hello";

    //     event(new NewMessageEvent($message));

    //     return $message;
    // }
}
