<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class EducationController extends Controller
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
    public function storeedu(Request $request)
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
    Log::info('Authenticated Job Seeker ID: ' . $user->id);
    $jobSeekerId = $user->id;

    // Validate request data
    $validator = Validator::make($request->all(), [
        'schoolName' => 'required|string|max:255',
        'degree' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'startDate' => 'required|date',
        'graduationDate' => 'required|date',
        'educationDescription' => 'required|string|max:1000',
    ]);

    if ($validator->fails()) {
        Log::error('Validation errors: ', $validator->errors()->toArray());
        return $isMobile
            ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
            : redirect()->back()->withErrors($validator)->withInput();
    }

    // Create a new education record
    $education = new Education();
    $education->jobSeekerId = $jobSeekerId;
    $education->schoolName = $request->input('schoolName');
    $education->degree = $request->input('degree');
    $education->city = $request->input('city');
    $education->startDate = $request->input('startDate');
    $education->graduationDate = $request->input('graduationDate');
    $education->educationDescription = $request->input('educationDescription');
    Log::info('New education record created: ' . $education->id);
    $education->save();
    Log::info('Education created successfully: ' . $education->id);

    // Return the response correctly
    return $isMobile
        ? $this->responseSuccess('Education created successfully.', 201, $education) // Ensure the model is passed as data, and 201 is the status
        : redirect()->back()->with('success', 'Education created successfully.');
}




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // Check if the request is from mobile
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Get the authenticated user
        $user = $isMobile ? request()->user() : Auth::guard('job_seekers')->user();
        if (!$user) {
            return $isMobile
                ? $this->responseError('Unauthorized', 401)
                : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        Log::info('Authenticated Job Seeker ID: ' . $user->id);
        $jobSeekerId = $user->id;

        // Get the education details for the job seeker
        $education = Education::where('jobSeekerId', $jobSeekerId)->get();

        if (!$education) {
            return $isMobile
                ? $this->responseError('Education details not found.', 404)
                : redirect()->back()->with('error', 'Education details not found.');
        }

        // Return the success response for mobile and non-mobile
        return $isMobile
            ? $this->responseSuccess('Education details found.', 200, $education)
            : redirect()->back()->with('success', 'Education details retrieved successfully.');
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(Education $education)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Education  $education
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

  // find the education by its ID
   $education = Education::where('id', $id)->where('jobSeekerId', $jobSeekerId)->first();

  if (!$education) {
      return $isMobile
          ? $this->responseError('Education not found', 404)
          : redirect()->back()->with('error', 'Education not found');
  }

  //validate request data
   $validator = Validator::make($request->all(), [
       'schoolName' => 'required|string|max:255',
       'degree' => 'required|string|max:255',
       'city' => 'required|string|max:255',
       'startDate' => 'required|date',
       'graduationDate' => 'required|date',
       'educationDescription' => 'required|string|max:1000',
   ]);

   if ($validator->fails()) {
       Log::error('Validation errors: ', $validator->errors()->toArray());
       return $isMobile
           ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
           : redirect()->back()->withErrors($validator)->withInput();
   }

   //update the education record
    $education->schoolName  = $request->input('schoolName');
    $education->degree = $request->input('degree');
    $education->city = $request->input('city');
    $education->startDate = $request->input('startDate');
    $education->graduationDate = $request->input('graduationDate');
    $education->educationDescription = $request->input('educationDescription');
    Log::info('Education updated successfully: ' . $education->id);
    $education->save();

    //return the response correctly
    return $isMobile
        ? $this->responseSuccess('Education updated successfully.', 200, $education)
        : redirect()->back()->with('success', 'Education updated successfully.');




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
   public function responseSuccess($message, $statusCode = 200, $data = null)
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
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $education)
    {
        //
    }
}
