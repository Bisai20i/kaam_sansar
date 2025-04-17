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
    public function storeproject(Request $request)
    {
        //Check if the request is from mobile
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        // Get the authenticated user
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        if (!$user) {
            return $isMobile
             ? $this->responseError('Unauthorized', 401)
             : redirect()->route('login')->with('error','Unauthorized access.');
        }

        Log::info('Authenticated Job Seeker ID :' . $user->id);
        $jobSeekerId = $user ->id;

        //Validate request data
        $validator = Validator::make($request->all(),
        [
            'projectTitle' => 'required|string|max:255',
             'projectLink' => 'nullable|url|max:255',
             'projectDescription'=>'string|max:1000',
        ]);
        if ($validator->fails()){
            Log::error('Validation errors:', $validator->errors()->toArray());
            return $isMobile
                ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
                : redirect()->back()->withErrors($validator)->withInput();
        }

        //create a new project record
        $project = new Project();
        $project->jobSeekerId = $jobSeekerId;
        $project->projectTitle = $request->input('projectTitle');
        $project->projectLink = $request ->input('projectLink');
        $project->projectDescription = $request ->input('projectDescription');
        Log::info('new Project record created :'. $project->id);
        $project->save();
        Log ::info('Project created successfully:' . $project);

        // return the response based on request type
         return $isMobile
         ? $this->responseSuccess('Project created successfully.', 201, $project)
         :redirect()->back()->with('success','Project created successfully.');




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
            ?$this->responseError('Unauthorized',401)
            :redirect()->route('login')->with('error','Unauthorized access.');

        }

        Log::info('Authenticated Job Seeker ID :' . $user->id);
        $jobSeekerId = $user->id;

        // get the project details for the job seeker user
        $project = Project::where('jobSeekerId', $jobSeekerId)->get();

        if(!$project){
            return $isMobile
            ? $this->responseError('Project details not found.',404)
            :redirect()->back()->with('error','Project  details not  found.');
        }

        //Return the success response for mobile and non-mobile
        return $isMobile
        ? $this->responseSuccess('Project details found.', 200, $project)
        :redirect()->back()->with('success', 'Project details retrived successfully.');



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
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

        if (!$project)
        {
            return $isMobile
            ? $this->responseError('Project not found or you are not authorized to update it.', 404)
            : redirect()->back()->with('error', 'Project not found or you are not authorized to update it.');
    }

    //Validate request data
     $validator = Validator::make($request->all(),[
        'projectTitle' => 'required|string|max:255',
        'projectLink' =>'required|url',
        'projectDescription' =>'nullable|string'

      


     ]);
         
     if ($validator->fails()) {
        Log::error('Validation errors:', $validator->errors()->toArray());
        return $isMobile
            ? $this->responseError('Validation failed. Please check your inputs.', $validator->errors())
            : redirect()->back()->withErrors($validator)->withInput();
    }
//update the filled
     $project->projectTitle = $request->input('projectTitle');
     $project->projectLink = $request->input('projectLink');
     $project->projectDescription = $request->input('projectDescription');

     $project->save();


     Log::info('project updated successfully: ' . $project);
    
     // Return the response based on request type
     return $isMobile
         ? $this->responseSuccess('project updated successfully.',  $project)
         : redirect()->back()->with('success', 'project updated successfully.');
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


    public function destroy(Project $project)
    {
        //
    }
}
