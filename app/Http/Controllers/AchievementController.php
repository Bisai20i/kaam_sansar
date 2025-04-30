<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AchievementController extends Controller
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
            // Check if the request is from mobile using request type
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

            // Validate request data
            $validator = Validator::make($request->all(), [
                'achievementTitle' => 'required|string|max:255',
                'achievementDescription' => 'max:1000',
            ]);

            // Handle validation errors
            if ($validator->fails()) {
                Log::error('Validation errors:', $validator->errors()->toArray());
                return $isMobile
                    ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
                    : redirect()->back()->withErrors($validator->errors())->withInput();
            }

            $achievement = new Achievement();
            $achievement->jobSeekerId = $jobSeekerId;
            $achievement->achievementTitle = $request->input('achievementTitle');
            $achievement->achievementDescription = $request->input('achievementDescription');
            $achievement->save();

            Log::info('Achievement created successfully with ID: ' . $achievement->id);


            return $isMobile
                ? $this->responseSuccess('Achievement(s) saved successfully.', $achievement)
                : response()->json([
                    'success' => true,
                    'message' => 'Achievement(s) saved successfully.',
                    'achievement'=>$achievement
                ]);
        } catch (\Exception $e) {
            Log::error('Exception occurred while saving achievement(s): ' . $e->getMessage());

            return $isMobile
                ? $this->responseError('Something went wrong. Please try again.', 500)
                : response()->json([
                    'success' => false,
                    'message' => 'Something went wrong. Please try again.',
                    'error' => $e->getMessage()
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Achievement  $achievement
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //Check if request is from mobile using request_type
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        //Get the authenticated user
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        if (!$user) {
            return $isMobile
                ? $this->responseError('Unauthorized', 401)
                : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        Log::info('Authenticated Job Seeker ID: ' . $user->id);
        $jobSeekerId = $user->id;
        //Get the achievement details for the job Seeker
        $achievement = Achievement::where('jobSeekerId', $jobSeekerId)->get();

        if (!$achievement) {
            return $isMobile
                ? $this->responseError('Achievement details not found', 404)
                : redirect()->back()->with('error', 'Achievement details not found');
        }

        return $isMobile
            ? $this->responseSuccess('Achievement details found', $achievement)
            : redirect()->back()->with('success', 'Achievement details not found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Achievement  $achievement
     * @return \Illuminate\Http\Response
     */
    public function edit(Achievement $achievement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Achievement  $achievement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Check if request is from mobile using request_type

        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        //Get the authenticated user

        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

        if (!$user) {

            return $isMobile

                ? $this->responseError('Unauthorized', 401)

                : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        Log::info('Authenticated Job Seeker ID: ' . $user->id);

        $jobSeekerId = $user->id;

        //find the achievement ID

        $achievement = Achievement::where('id', $id)->where('jobSeekerId', $jobSeekerId)->first();

        //Validator request data

        $validator = Validator::make($request->all(), [
            'achievementTitle' => 'required|string|max:255',
            'achievementDescription' => 'required|max:1000',


        ]);

        //Handle validator errors

        if ($validator->fails()) {

            Log::error('Validation errors:' . $validator->errors()->toArray());

            return $isMobile

                ? $this->responseError('Validation failed. Please check your inputs .', 422, $validator->errors())

                : redirect()->back()->withErrors($validator->errors())->withInput();
        }

        //Update the achievement record

        $achievement->achievementTitle = $request->input('achievementTitle');
        $achievement->achievementDescription = $request->input('achievementDescription');
        $achievement->save();

        Log::info('achievement updated successfully with ID: ' . $achievement->id);


        return $isMobile

            ? $this->responseSuccess('Achievement updated successfully', $achievement)

            : redirect()->back()->with('success', 'Achievement updated successfully');
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
     * @param  \App\Models\Achievement  $achievement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Achievement $achievement)
    {
        //
    }
}
