<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
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

        //Check if the request is from mobile
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

        //validate request data

        $validator = Validator::make($request->all(), [
            'languageName' => 'required|string|max:255',
            'languageProficiency' => 'required|in:Beginner,Intermediate,Proficient',

        ]);

        if ($validator->fails()) {

            Log::error('Validation errors:', $validator->errors()->toArray());
            return $isMobile
                ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
                : response()->json([
                    'success' => false,
                    'message' => 'something went to wronge.',
                    'errors' => $validator->errors()->all(),
                    'request' => $request->input(),
                ]);
        }
        //create a new language record

        $language = new Language();
        $language->languageName = $request->input('languageName');
        $language->languageProficiency = $request->input('languageProficiency');
        $language->jobSeekerId = $jobSeekerId;
        $language->save();

        Log::info('Language created successfully');

        // return the response based on request type
        return $isMobile
            ? $this->responseSuccess('Lanagugae saved successfully.', $language)
            :
            response()->json([
                'success' => true,
                'message' => 'Language saved successfully.',
                'language'=>$language
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //Check if the request is from mobile
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

        //Get the language details for job seeker

        $language = Language::where('jobSeekerId', $jobSeekerId)->get();

        if (!$language) {
            return $isMobile
                ? $this->responseError('Language details not found', 404)
                : redirect()->back()->with('error', 'Language details not found');
        }
        return $isMobile
            ? $this->responseSuccess('Language details found', $language)
            : redirect()->back()->with('success', 'Language details found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Check if the request is from mobile
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

        //Get the language details for job seeker

        $language = Language::where('id', $id)->where('jobSeekerId', $jobSeekerId)->first();

        if (!$language) {

            return $isMobile
                ? $this->responseError('Language details not found', 404)
                : redirect()->back()->with('error', 'Language details not found');
        }

        //Update the language details

        $language->languageName = $request->input('languageName');
        $language->languageProficiency = $request->input('languageProficiency');
        $language->save();

        return $isMobile
            ? $this->responseSuccess('Language details updated successfully', $language->toArray())
            : redirect()->back()->with('success', 'Language details updated successfully');
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
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request, $id)
    {
        // Check if the request type is mobile
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Find the language by ID
        $language = Language::find($id);

        if (!$language) {
            if ($isMobile) {
                return response()->json([
                    'status' => false,
                    'message' => 'Language not found.',
                ], 404);
            }
            return redirect()->back()->with('error', 'Language not found.');
        }

        try {
            $language->delete();

            if ($isMobile) {
                return response()->json([
                    'status' => true,
                    'message' => 'Language deleted successfully.',
                ], 200);
            }

            return redirect()->route('language.index')->with('success', 'Language deleted successfully.');
        } catch (\Exception $e) {
            if ($isMobile) {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to delete language.',
                    'error' => $e->getMessage(),
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to delete language.');
        }
    }
}
