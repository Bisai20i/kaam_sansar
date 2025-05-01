<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
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
            try {
                // Check if request is from mobile using the request_type parameter
                $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        
                // Get the authenticated job seeker
                $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
                if (!$user) {
                    return $isMobile
                        ? $this->responseError('Unauthorized', 401)
                        : redirect()->route('login')->with('error', 'Unauthorized access.');
                }
        
                Log::info('Authenticated Job Seeker ID: '. $user->id);
                $jobSeekerId = $user->id;
        
                // Validate the profile data
                $validator = Validator::make($request->all(), [
                    'firstName' => 'required|string|max:255',
                    'lastName' => 'required|string|max:255',
                    'phoneNumber' => 'required|string|unique:profiles,phoneNumber,' . $jobSeekerId . ',jobSeekerId',
                    'designation' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'country' => 'required|string|max:255',
                    'bio' => 'required|string|max:1000',
                    'profileImg' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
                ]);
        
                // Log validation errors if any
                if ($validator->fails()) {
                    Log::error('Validation errors: ', $validator->errors()->toArray());
                    return $isMobile
                        ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
                        : response()->json([
                            'success' => false,
                            'message' => "Validation failed. Please check your inputs.",
                            'error' => $validator->errors()
                        ]);
                }
        
                $profileImagePath = handleUpload('profileImg');
        
                $profileData = [
                    'firstName' => $request->firstName,
                    'lastName' => $request->lastName,
                    'address' => $request->address,
                    'email'=>$request->email,
                    'phoneNumber' => $request->phoneNumber,
                    'designation' => $request->designation,
                    'country' => $request->country,
                    'bio' => $request->bio,
                ];
                        // Only add image if uploaded
                if ($profileImagePath) {
                    $profileData['profileImg'] = $profileImagePath;
                }
        
                $profile = Profile::updateOrCreate(
                    ['jobSeekerId' => $jobSeekerId], // Search condition
                    $profileData                      // Data to create/update
                );
        
                // Log saved profile data
                Log::info('Profile saved successfully:', $profile->toArray());
                session()->flash('step', 2);
        
                // Return response based on request type
                return $isMobile
                    ? $this->responseSuccess('Personal Profile saved successfully.', $profile)
                    : response()->json([
                        'success' => true,
                        'message' => 'Personal Profile saved successfully.',
                        'profile'=>$profile
                    ]);
        
            } catch (\Exception $e) {
                Log::error('Store Profile Exception: ' . $e->getMessage());
        
                return $request->has('request_type') && $request->input('request_type') === 'mobile'
                    ? $this->responseError('Something went wrong.', 500, $e->getMessage())
                    : response()->json([
                        'success' => false,
                        'message' => 'Something went wrong.',
                        'error' => $e->getMessage(),
                    ], 500);
            }
        }
        
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // Check if request is from mobile using the request_type parameter
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Get the authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        if (!$user) {
            return $isMobile
                ? $this->responseError('Unauthorized', 401)
                : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        Log::info('Authenticated Job Seeker ID: ' . $user->id);


        // Check if the user is authenticated and if they have permission to access the profile
        // if (!$user || $user->id != $id) {
        //     if ($isMobile) {
        //         return response()->json([
        //             'success' => false,
        //             'message' => 'User not authenticated or user not found.',
        //         ], 401);
        //     }


        //     return redirect()->route('login')->with('error', 'Unauthorized access.');
        // }

        // Retrieve the profile by the provided ID
        $profile = Profile::where('jobSeekerId', $user->id)
            ->where('id', $id)
            ->first();

        if (!$profile) {
            if ($isMobile) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Profile not found',
                ], 404);
            }

            return redirect()->back()->with('error', 'Profile not found.');
        }
        if ($isMobile) {
            return $this->responseSuccess('Profile retrieved successfully.', $profile);
        }
        return redirect()->back()->with('success', 'Profile retrieved successfully.');
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Check if the request if from mobile
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Get the authenticated user
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

        if (!$user) {
            return $isMobile
                ? $this->responseError('Unauthorized', 401)
                : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        Log::info('Authenticated Job Seeker ID :' . $user->id);
        $jobSeekerId = $user->id;
        // find the profile
        $profile = Profile::where('id', $id)->where('jobSeekerId', $jobSeekerId)->first();

        if (!$profile) {
            return $isMobile
                ? $this->responseError('Profile not found', 404)
                : redirect()->back()->with('error', 'Profile not found');
        }

        // Validate request data
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phoneNumber' => 'required|string|unique:profiles,phoneNumber,' . $jobSeekerId . ',jobSeekerId',
            'designation' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'bio' => 'required|string|max:1000',
            'profileImg' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);
        //Handle validation errors

        if ($validator->fails()) {
            Log::error('Validation errors:', $validator->errors()->toArray());
            return $isMobile
                ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
                : redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $profileImagePath = handleUpload('profileImg', $profile);

        //update the field

        $profile->firstName = $request->firstName;
        $profile->lastName = $request->lastName;
        $profile->phoneNumber = $request->phoneNumber;
        $profile->designation = $request->designation;
        $profile->country = $request->country;
        $profile->bio = $request->bio;
        $profile->profileImg = $profileImagePath;

        // Log profile details before saving
        Log::info('Profile data before saving:', $profile->toArray());


        //Return the response based on request type
        return $isMobile
            ? $this->responseSuccess('Profile updated successfully.', $profile)
            : redirect()->back()->with('success', 'Profile updated successfully.');
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
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
