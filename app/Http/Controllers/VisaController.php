<?php

namespace App\Http\Controllers;

use App\Models\Visa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VisaController extends Controller
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
    public function storevisa(Request $request)
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



        // Validate request data
        $validator = Validator::make($request->all(), [
            'country' => 'required|string|max:255',
            'visaDetails' => 'required|string|max:1000',
            'visaExpire'=>'nullable|string',
            'visaImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            Log::error('Validation errors: ', $validator->errors()->toArray());
            return $isMobile
                ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
                : redirect()->back()->withErrors($validator->errors())->withInput();
        }

        //handle visa image upload
        $visaImagePath = handleUpload('visaImage');
        // Create a new visa record
        $visa = new Visa();
        $visa->jobSeekerId = $jobSeekerId;
        $visa->country = $request->input('country');
        $visa->visaDetails = $request->input('visaDetails');
        $visa->visaExpire = $request->input('visaExpire');
        $visa->visaImage = $visaImagePath;
        // Upload the visa image if provided
        if ($visaImagePath) {

            Log::info('File uploaded successfully: ' . $visa->visaImage);
        } else {
            Log::warning('No file uploaded.');
        }

        // Save the visa record
        $visa->save();
        Log::info('Visa created successfully with ID: ' . $visa->id);

        return $isMobile
            ? $this->responseSuccess('Visa created successfully', $visa)
            : redirect()->back()->with('success', 'Visa created successfully');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visa  $visa
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id  )
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
        //Get the visa details for the job seeker
        $visa = Visa::where('jobSeekerId', $jobSeekerId)->first();
        if (!$visa) {
            return $isMobile
                ? $this->responseError('Visa details not found', 404)
                : redirect()->back()->with('error', 'Visa details not found');
        }


        return $isMobile
            ? $this->responseSuccess('Visa details found', $visa)
            : redirect()->back()->with('success', 'Visa details found');

    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visa  $visa
     * @return \Illuminate\Http\Response
     */
    public function edit(Visa $visa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visa  $visa
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
        $jobSeekerId = $user->id;

        // Find the visa
        $visa = Visa::where('id', $id)->where('jobSeekerId', $jobSeekerId)->first();

        if (!$visa) {
            return $isMobile
                ? $this->responseError('Visa not found', 404)
                : redirect()->back()->with('error', 'Visa not found');
        }

        // Validate request data
        $validator = Validator::make($request->all(), [
            'country' => 'sometimes|string|max:255',
            'visaDetails' => 'sometimes|string|max:1000',
            'visaExpire' => 'sometimes|date',
            'visaImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle validation errors

        if ($validator->fails()) {
            Log::error('Validation errors: ', $validator->errors()->toArray());
            return $isMobile
                ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
                : redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $visaImagePath = handleUpload('visaImage', $visa);
        //update the filled

        $visa->country = $request->input('country');
        $visa->visaDetails = $request->input('visaDetails');
        $visa->visaExpire = $request->input('visaExpire');
        $visa->visaImage = $visaImagePath;

        // $visa->touch(); // This will update the `updated_at` column

        $visa->save();

        Log::info('visa updated successfully:' . $visa);

        //Return the response based on request type
        return $isMobile

            ? $this->responseSuccess('Visa updated successfully', $visa)
            : redirect()->back()->with('success', 'Visa updated successfully');
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
     * @param  \App\Models\Visa  $visa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visa $visa)
    {
        //
    }
}
