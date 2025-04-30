<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TrainingController extends Controller
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
            $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
            $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
    
            if (!$user) {
                return $isMobile
                    ? $this->responseError('Unauthorized', 401)
                    : redirect()->route('login')->with('error', 'Unauthorized access.');
            }
    
            $jobSeekerId = $user->id;
            Log::info('Authenticated Job Seeker ID: ' . $jobSeekerId);
    
            // Validation rules
            $validator = Validator::make($request->all(), [
                'trainingTitle' => 'required|string|max:255',
                'institutionName' => 'required|string|max:255',
                'completionDate' => 'required|date',
                'certificate' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            ]);
           
    
            if ($validator->fails()) {
                Log::error('Validation errors: ', $validator->errors()->toArray());
                return $isMobile
                    ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
                    : response()->json([
                        'success' => false,
                        'message' => 'Validation failed. Please check your inputs.',
                        'errors' => $validator->errors()->all(),
                        'request' => $request->input(),
                    ]);
            }
    
            $certificatePath = handleUpload('certificate');

            $training = new Training();
            $training->jobSeekerId = $jobSeekerId;
            $training->trainingTitle = $request->input('trainingTitle');
            $training->institutionName = $request->input('institutionName');
            $training->completionDate = $request->input('completionDate');
            $training->certificate=$certificatePath;
    
            if ($certificatePath) {
                Log::info('File uploaded successfully: ' . $training->certificatePath);
            } else {
                Log::warning('No file uploaded.');
            }
    
            $training->save();
            Log::info('training created successfully with ID: ' . $training->id);
    
            return $isMobile
                ? $this->responseSuccess('Trainings saved successfully.', $training)
                : response()->json([
                    'success' => true,
                    'message' => 'Trainings saved successfully.',
                    'training'=>$training
                ]);
    
        } catch (\Exception $e) {
            Log::error('Training store exception: ' . $e->getMessage());
    
            return $isMobile
                ? $this->responseError('Something went wrong. Please try again later.', 500)
                : response()->json([
                    'success' => false,
                    'message' => 'Something went wrong. Please try again later.',
                    'error' => $e->getMessage(), // hide in production
                ], 500);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Training  $training
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

        //Get the training details for the job seeker

        $training = Training::where('jobSeekerId', $jobSeekerId)->get();

        if (!$training) {
            return $isMobile
                ? $this->responseError('Training details not found', 404)
                : redirect()->back()->with('error', 'Training details not found');
        }

        return $isMobile
            ? $this->responseSuccess('Training details found', $training)
            : redirect()->route('profile')->with('success', 'Training details found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Training  $training
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

        //find the training detail

        $training = Training::where('id', $id)->where('jobSeekerId', $jobSeekerId)->first();

        if (!$training) {
            return $isMobile
                ? $this->responseError('Training not found', 404)
                : redirect()->back()->with('error', 'Training not found');
        }

        //Validate request data

        $validator = Validator::make($request->all(), [
            'trainingTitle' => 'required|string|max:255',
            'institutionName' => 'required|string|max:255',
            'completionDate' => 'required|date',
            'certificate' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle validation errors
        if ($validator->fails()) {

            return $isMobile
                ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
                : redirect()->back()->withErrors($validator->errors())->withInput();
        }

        //handle the image
        $certificatePath = handleUpload('certificate', $training->certificate);

        //update the field

        $training->trainingTitle = $request->input('trainingTitle');
        $training->institutionName = $request->input('institutionName');
        $training->completionDate = $request->input('completionDate');
        $training->certificate = $certificatePath;

        //Upload training if available
        if ($certificatePath) {
            Log::info('Training certificate uploaded successfully:' . $training->certificate);
        } else {
            Log::error('Training certificate upload failed');
        }

        //Save training
        $training->save();
        Log::info('training detail update successfully:'.$training);
        return $isMobile
            ? $this->responseSuccess('Training updated successfully:', $training)
            : redirect()->route('profile')->with('success', 'Training updated successfully');
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
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
        //
    }
}
