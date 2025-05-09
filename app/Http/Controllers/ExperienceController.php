<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExperienceController extends Controller
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

        //Validate request data
        $validator = Validator::make($request->all(), [
            'jobTitle' => 'required|string|max:255',  // Job title is required and must be a string with max length of 255
            'companyName' => 'required|string|max:255',  // Company name is required and must be a string with max length of 255
            'location' => 'required|string|max:255',  // Location is required and must be a string with max length of 255
            'startDate' => 'nullable|date',  // Start date must be a valid date and cannot be after the end date
            'endDate' => 'nullable|date',  // End date is optional, but if provided, it must be a valid date and after or equal to start date
            'experienceDescription' => 'required|string|max:1000',  // Required experience description with max length of 1000 characters
            'salaryRating' => 'nullable|integer|min:1|max:5',  // Salary rating between 1 and 5
            'salaryFeedback' => 'nullable|string|max:500',  // Optional salary feedback, max 500 characters
            'workingEnvironmentRating' => 'nullable|integer|min:1|max:5',  // Working environment rating between 1 and 5
            'workingEnvironmentFeedback' => 'nullable|string|max:500',  // Optional feedback for working environment, max 500 characters
            'benefitsRating' => 'nullable|integer|min:1|max:5',  // Benefits rating between 1 and 5
            'benefitsFeedback' => 'nullable|string|max:500',

        ]);
        // Handle validation errors
        if ($validator->fails()) {
            Log::error('Validation errors: ', $validator->errors()->toArray());
            return $isMobile
                ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
                :
                response()->json([
                    'success' => false,
                    'message' => 'something wents to wrong.',
                ]);
        }
        try {
            $experience = new Experience();
            $experience->jobSeekerId = $jobSeekerId;
            $experience->jobTitle = $request->jobTitle;
            $experience->companyName = $request->companyName;
            $experience->location = $request->location;
            $experience->startDate = $request->startDate;
            $experience->endDate = $request->endDate;
            $experience->experienceDescription = $request->experienceDescription;
            $experience->salaryRating = $request->salaryRating;
            $experience->salaryFeedback = $request->salaryFeedback;
            $experience->workingEnvironmentRating = $request->workingEnvironmentRating;
            $experience->workingEnvironmentFeedback = $request->workingEnvironmentFeedback;
            $experience->benefitsRating = $request->benefitsRating;
            $experience->benefitsFeedback = $request->benefitsFeedback;
            $experience->save();
            Log::info('Experience created successfully with ID: ' . $experience->id);
            if ($experience) {
                return $isMobile
                    ? $this->responseSuccess('experience saved successfully.', $experience)
                    :
                    response()->json([
                        'success' => true,
                        'message' => 'experience saved successfully.',
                        'experience' => $experience
                    ]);
            }

            return response()->json([
                'success' => false,
                'message' => "Some thing went wrong"

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "SOme thing went wrong",
                'errors' => $e->getMessage()

            ]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Experience  $experience
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
        //Get the experience details for the job seeker
        $experience = Experience::where('jobSeekerId', $jobSeekerId)->get();
        if (!$experience) {
            return $isMobile
                ? $this->responseError('Experience details not found', 404)
                : redirect()->back()->with('error', 'Experience details not found');
        }

        return $isMobile
            ? $this->responseSuccess('Experience details found', $experience)
            : redirect()->back()->with('success', 'Achievement details not found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function edit(Experience $experience)
    {
        return response()->json($experience);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Experience  $experience
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

        //Get the experience details for the job seeker

        $experience = Experience::where('id', $id)->where('jobSeekerId', $jobSeekerId)->first();

        if (!$experience) {

            return $isMobile
                ? $this->responseError('Experience not found', 404)
                : redirect()->back()->with('error', 'Experience not found');
        }


        //Validate request data
        $validator = Validator::make($request->all(), [
            'jobTitle' => 'required|string|max:255',  // Job title is required and must be a string with max length of 255
            'companyName' => 'required|string|max:255',  // Company name is required and must be a string with max length of 255
            'location' => 'required|string|max:255',  // Location is required and must be a string with max length of 255
            // 'startDate' => 'required|date|before_or_equal:endDate',  // Start date must be a valid date and cannot be after the end date
            // 'endDate' => 'nullable|date|after_or_equal:startDate',  // End date is optional, but if provided, it must be a valid date and after or equal to start date
            'startDate' => 'nullable|date',  // Start date must be a valid date and cannot be after the end date
            'endDate' => 'nullable|date',  // End date is optional, but if provided, it must be a valid date and after or equal to start date
            'experienceDescription' => 'required|string|max:1000',  // Required experience description with max length of 1000 characters
            'salaryRating' => 'nullable|integer|min:1|max:5',
            // Salary rating between 1 and 5
            'salaryFeedback' => 'nullable|string|max:500',  // Optional salary feedback, max 500 characters
            'workingEnvironmentRating' => 'nullable|integer|min:1|max:5',  // Working environment rating between 1 and 5
            'workingEnvironmentFeedback' => 'nullable|string|max:500',  // Optional feedback for working environment, max 500 characters
            'benefitsRating' => 'nullable|integer|min:1|max:5',  // Benefits rating between 1 and 5
            'benefitsFeedback' => 'nullable|string|max:500',

        ]);

        //Handle validation errors
        if ($validator->fails()) {
            Log::error('Validation errors: ', $validator->errors()->toArray());
            return $isMobile
                ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
                :  response()->json([
                    'message' => 'validate error',
                    'success' => 'false'
                ]);
        }

        //Update the experience record
        $experience->jobTitle = $request->input('jobTitle');
        $experience->companyName = $request->input('companyName');
        $experience->location = $request->input('location');
        $experience->startDate = $request->input('startDate');
        $experience->endDate = $request->input('endDate');
        $experience->experienceDescription = $request->input('experienceDescription');
        $experience->salaryRating = $request->input('salaryRating');
        $experience->salaryFeedback = $request->input('salaryFeedback');
        $experience->workingEnvironmentRating = $request->input('workingEnvironmentRating');
        $experience->workingEnvironmentFeedback = $request->input('workingEnvironmentFeedback');
        $experience->benefitsRating = $request->input('benefitsRating');
        $experience->benefitsFeedback = $request->input('benefitsFeedback');
        $experience->save();
        Log::info('Experience updated successfully with ID: ' . $experience->id);


        return $isMobile
            ? $this->responseSuccess('Experience updated successfully', $experience)
            : response()->json([
                'message' => 'Experience updated successfully',
                'success' => 'true',
                'experience' => $experience
            ]);
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
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        $experience = Experience::find($id);

        if (!$experience) {
            return $isMobile
                ? $this->responseError('experience not found', 404)
                : response()->json([
                    'success' => false,
                    'message' => 'experience not found.',
                ]);
        }
        $experience->delete();

        return $isMobile
            ? $this->responseSuccess('experience deleted successfully')
            : response()->json([
                'success' => true,
                'message' => 'experience delete Successfully.',
            ]);
    }
}
