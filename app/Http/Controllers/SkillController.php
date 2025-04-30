<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;



class SkillController extends Controller
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
            // Check if the request is from mobile
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

            // Validate request data
            $validator = Validator::make($request->all(), [
                'skillName' => 'required|string|max:255',
                'skillProficiency' => 'required|in:Beginner,Intermediate,Advanced',
            ]);

            if ($validator->fails()) {
                Log::error('Validation errors:', $validator->errors()->toArray());
                return $isMobile
                    ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
                    : response()->json([
                        'success' => false,
                        'message' => 'Skill saving error.',
                        'errors' => $validator->errors()->all(),
                    ]);
            }

            // Create new skill records
            $skill = new Skill();
            $skill->jobSeekerId = $jobSeekerId;
            $skill->skillName = $request->skillName; // Direct access
            $skill->skillProficiency = $request->skillProficiency;
            $skill->save();
            
            Log::info('Skill created successfully: ' . $skill->id);

            return $isMobile
                ? $this->responseSuccess('Skill saved successfully.', $skill)
                : response()->json([
                    'success' => true,
                    'message' => 'Skill saved successfully.',
                    'skill'=>$skill
                ]);
        } catch (\Exception $e) {
            Log::error('Error while saving skills: ' . $e->getMessage());

            return $request->has('request_type') && $request->input('request_type') === 'mobile'
                ? $this->responseError('An unexpected error occurred.', 500)
                : response()->json([
                    'success' => false,
                    'message' => 'An unexpected error occurred.',
                    'error' => $e->getMessage()
                ], 500);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //Check if the request is from mobile
        $isMobile = $request->has('request_type') && $request->input('request_type') == 'mobile';
        // Get the authenticated user
        $user = $isMobile ? request()->user() : Auth::guard('job_seekers')->user();
        if (!$user) {
            return $isMobile
                ? $this->responseError('Unauthorized', 401)
                : redirect()->route('login')->with('error', 'Unauthorized access.');
        }
        Log::info('Authenticated Job Seeker ID: ' . $user->id);

        $jobSeekerId = $user->id;
        //Get the visa details for the job seeker

        $skill = Skill::where('jobSeekerId', $jobSeekerId)->get();
        if (!$skill) {
            return $isMobile
                ? $this->responseError('Skill details not found', 404)
                : redirect()->back()->with('error', 'Skill details not found');
        }
        return $isMobile
            ? $this->responseSuccess('Skill details found', $skill)
            : redirect()->back()->with('success', 'Skill details found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Check if the request is from mobile
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

        // Find the skill by ID
        $skill = Skill::where('id', $id)->where('jobSeekerId', $jobSeekerId)->first();

        if (!$skill) {
            return $isMobile
                ? $this->responseError('Skill not found or you are not authorized to update it.', 404)
                : redirect()->back()->with('error', 'Skill not found or you are not authorized to update it.');
        }

        // Validate request data
        $validator = Validator::make($request->all(), [
            'skillName' => 'required|string|max:255',
            'skillProficiency' => 'required|in:Beginner,Intermediate,Advanced',
        ]);

        if ($validator->fails()) {
            Log::error('Validation errors:', $validator->errors()->toArray());
            return $isMobile
                ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
                : redirect()->back()->withErrors($validator)->withInput();
        }
        //update the filled
        $skill->skillName = $request->input('skillName');
        $skill->skillProficiency = $request->input('skillProficiency');

        $skill->save();
        Log::info('Skill updated successfully: ' . $skill);

        // Return the response based on request type
        return $isMobile
            ? $this->responseSuccess('Skill updated successfully.',  $skill)
            : redirect()->back()->with('success', 'Skill updated successfully.');
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
            'data' => $data,
        ], $statusCode);  // Pass the status code correctly
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        //
    }
}
