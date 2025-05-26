<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
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
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        $jobSeekerId = $user->id;
        if (! $user) {
            return $isMobile
                ? $this->responseError('Unauthorized', 401)
                : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        $validator = Validator::make($request->all(), [
            'projectTitle'       => 'required|string|max:255',
            'pl'        => 'nullable',
            'projectDescription' => 'required|string',
        ]);

        if ($validator->fails()) {
            Log::error('Project validation failed', $validator->errors()->toArray());
            return $isMobile
                ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
                : response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors'  => $validator->errors()->all(),
                ]);
        }

        $validated = $validator->validated();

        $project = new Project();
        $project->projectTitle = $validated['projectTitle'];
        $project->projectLink = $validated['pl'];
        $project->projectDescription = $validated['projectDescription'];
        $project->jobSeekerId = $jobSeekerId;

        $project->save();

        Log::info('Project created', ['id' => $project->id]);

        return $isMobile
            ? $this->responseSuccess('Project saved successfully.', 200, $project)
            : response()->json([
                'success' => true,
                'message' => 'Project saved successfully.',
                'project' => $project,
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //Check if the request is from mobile
        $isMobile = $request->has('request_type') && $request->input('request_type') == 'mobile';
        //Get the authenticated user
        $user = $isMobile ? request()->user() : Auth::guard('job_seekers')->user();
        if (!$user) {
            return $isMobile
                ? $this->responseError('Unauthorized', 401)
                : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        Log::info('Authenticated Job Seeker ID :' . $user->id);
        $jobSeekerId = $user->id;

        // get the project details for the job seeker user
        $project = Project::where('jobSeekerId', $jobSeekerId)->get();

        if (!$project) {
            return $isMobile
                ? $this->responseError('Project details not found.', 404)
                : redirect()->back()->with('error', 'Project  details not  found.');
        }

        //Return the success response for mobile and non-mobile
        return $isMobile
            ? $this->responseSuccess('Project details found.', 200, $project)
            : redirect()->back()->with('success', 'Project details retrived successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Check if the request is from mobile
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

        //Find the project by ID

        $project = Project::where('id', $id)->where('jobSeekerId', $jobSeekerId)->first();

        if (!$project) {
            return $isMobile
                ? $this->responseError('Project not found or you are not authorized to update it.', 404)
                : redirect()->back()->with('error', 'Project not found or you are not authorized to update it.');
        }

        //Validate request data
        $validator = Validator::make($request->all(), [
            'projectTitle' => 'required|string|max:255',
            'pl' => 'nullable',
            'projectDescription' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            Log::error('Validation errors:', $validator->errors()->toArray());
            return $isMobile
                ? $this->responseError('Validation failed. Please check your inputs.', $validator->errors())
                : response()->json([
                    'success' => false,
                    'message' => 'Input validation wrong',
                ]);
        }
        //update the filled

        $project->projectTitle = $request->input('projectTitle');
        $project->projectLink = $request->input('pl');
        $project->projectDescription = $request->input('projectDescription');

        $project->save();

        Log::info('project updated successfully: ' . $project->id);

        // Return the response based on request type
        return $isMobile
            ? $this->responseSuccess('project updated successfully.',  $project)
            : response()->json([
                'success' => true,
                'project' => $project,
                'message' => 'project update Successfully.',
            ]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */


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


    public function destroy(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        $project = Project::find($id);

        if (!$project) {
            return $isMobile
                ? $this->responseError('project not found', 404)
                : response()->json([
                    'success' => false,
                    'message' => 'project not found.',
                ]);
        }
        $project->delete();

        return $isMobile
            ? $this->responseSuccess('project deleted successfully')
            : response()->json([
                'success' => true,
                'message' => 'project delete Successfully.',
            ]);
    }
}
