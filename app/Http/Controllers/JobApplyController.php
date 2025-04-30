<?php

namespace App\Http\Controllers;

use App\Models\JobApply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\JobPost;
class JobApplyController extends Controller
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
    public function store(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        // Ensure user is authenticated and matches the requested profile
        if (! $user ) {
            if ($isMobile) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated or access denied.',
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Please log in to access your profile.');
        }

        try {
            $deadline = JobPost::find($id)->jobDeadline;

            if(!Carbon::today()->lessThanOrEqualTo($deadline)) {
                return $isMobile ? 
                 response()->json([
                    'status' => false,
                    'message' => 'Job deadline already exceeded.',
                ]) : redirect()->back()->with('error', 'Job deadline already exceeded.');
            }
            $jobApply = JobApply::create([
                'jobPostId' => $id,
                'jobSeekerId' => $user->id,
            ]);

            if($jobApply) {

                return $isMobile ? 
                 response()->json([
                    'status' => true,
                    'message' => 'Job Applied Successfully.',
                ]) : redirect()->back()->with('success', 'Job Applied Successfully.');
            }

            return $isMobile ? 
                 response()->json([
                    'status' => false,
                    'message' => 'Some thing went wrong.',
                ]) : redirect()->back()->with('error', 'Some thing went wrong.');
            // $jobApply = new JobApply();
            // $jobApply->job_id = $request->job_id;
            // $jobApply->jobseeker_id = $user->id;
            // $jobApply->save();
        }
        catch(\Exception $e) {
            return $isMobile ? 
                 response()->json([
                    'status' => false,
                    'message' => 'Some thing went wrong.',
                    'errors' => $e->getMessage(),
                ]) : redirect()->back()->with('error', $e->getMessage());
        }
        
    }

   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobApply  $jobApply
     * @return \Illuminate\Http\Response
     */
    public function show(JobApply $jobApply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobApply  $jobApply
     * @return \Illuminate\Http\Response
     */
    public function edit(JobApply $jobApply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobApply  $jobApply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobApply $jobApply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobApply  $jobApply
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobApply $jobApply)
    {
        //
    }
}
