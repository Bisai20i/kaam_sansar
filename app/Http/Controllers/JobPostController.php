<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\JobPost;
use App\Models\JobCompany;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\DataTables\JobPostDataTable;
use App\Http\Requests\JobPosts;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


/*************  ✨ Codeium Command ⭐  *************/

    //  * Display a listing of the resource.
    //  *

/******  32fb2f38-306f-471f-9819-160eeb709f7d  *******/
    public function index()
    {
        $jobpost = JobPost::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('backend.postadmin.jobPost.lists', compact('jobpost'));
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

    // public function store(Request $request)
    // {
    //     dd($request->all());

    //     $validatedData = $request->validated();
    //     try {
    //         // Log data before handling upload
    //         Log::info('Before handling file upload', ['jobBanner' => $request->jobBanner]);

    //         $thumbnailpath = handleUpload('jobBanner');

    //         Log::info('Thumbnail uploaded successfully', ['thumbnailpath' => $thumbnailpath]);
    //         $employeeTime = $request->employeeStartTime . ' - ' . $request->employeeEndTime;

    //         $jobPost = new JobPost();
    //         $jobPost->jobTitle = $request->jobTitle;
    //         $jobPost->jobLevel = $request->jobLevel;
    //         $jobPost->jobType = $request->jobType;
    //         $jobPost->jobCategoryId = $request->jobCategoryId;
    //         $jobPost->jobCompanyId = $request->jobCompanyId;
    //         $jobPost->postedId = $request->jobpostuserid;
    //         $jobPost->jobDescription = $request->jobDescription;
    //         $jobPost->employeeTime = $employeeTime;
    //         $jobPost->offeredSalary = $request->offeredSalary;
    //         $jobPost->jobLocation = $request->jobLocation;
    //         $jobPost->educationLevel    = $request->Education;
    //         $jobPost->experience = $request->Experience;
    //         $jobPost->status = $request->status;
    //         $jobPost->jobDeadline = $request->jobdeadline;
    //         // $jobPost->jobApproval = $request->jobApproval;
    //         $jobPost->jobBanner = $thumbnailpath;
    //         $jobPost->professionOfSkill = $request->skill;
    //         $jobPost->jobViewerCount = $request->jobviewer;
    //         $jobPost->noOfVacancy = $request->vacancynumber;

    //         // Log the data before saving
    //         Log::info('Job Post data to be saved', $jobPost->toArray());

    //         // Save the job post to the database
    //         $jobPost->save();

    //         // Log success message
    //         Log::info('Job Post added successfully', ['jobPostId' => $jobPost->id]);

    //         return redirect()->route('jobPost.index')->with('success', 'Job Post added successfully');
    //     } catch (\Exception $e) {
    //         // Log the exception error
    //         Log::error('Error adding job post', ['error' => $e->getMessage()]);
    //         return redirect()->back()->with('error', $e->getMessage());
    //     }
    // }



    public function store(JobPosts $request)
    {


        $validatedData = $request->validated();

        try {
            // Handle the job banner (uploaded file or cropped image)
            $thumbnailPath = null;

            // If a cropped image is provided, use it
            if ($request->filled('croppedImageBase64')) {
                $base64Image = $request->croppedImageBase64;

                // Remove the data URL part (e.g., "data:image/png;base64,")
                $imageData = explode(',', $base64Image)[1];

                // Decode the image
                $imageData = base64_decode($imageData);

                // Define filename & path
                $fileName = 'job_cropped_' . time() . '.jpg';
                $filePath = 'job_images/' . $fileName;

                // Store the image in public storage
                Storage::disk('public')->put($filePath, $imageData);

                // Store the path for database saving
                $thumbnailPath = $filePath;
            }
            // If a file is uploaded, use it
            elseif ($request->hasFile('jobBanner')) {
                $file = $request->file('jobBanner');
                $fileName = 'job_banner_' . time() . '.' . $file->getClientOriginalExtension();
                $filePath = 'job_images/' . $fileName;

                // Store the file in public storage
                Storage::disk('public')->put($filePath, file_get_contents($file));

                // Store the path for database saving
                $thumbnailPath = $filePath;
            }

            // Combine employee start and end time
            $employeeTime = $request->employeeStartTime . ' - ' . $request->employeeEndTime;

            // Create a new job post
            $jobPost = new JobPost();
            $jobPost->jobTitle = $request->jobTitle;
            $jobPost->jobLevel = $request->jobLevel;
            $jobPost->jobType = $request->jobType;
            $jobPost->jobCategoryId = $request->jobCategoryId;
            $jobPost->jobCompanyId = $request->jobCompanyId;
            $jobPost->postedId = $request->jobpostuserid;
            $jobPost->jobDescription = $request->jobDescription;
            $jobPost->employeeTime = $employeeTime;
            $jobPost->offeredSalary = $request->offeredSalary;
            $jobPost->jobLocation = $request->jobLocation;
            // $jobPost->qualification = $request->qualification;
            $jobPost->jobSite = $request->jobSite;
            $jobPost->experience = $request->experience;
            $jobPost->jobFeature = $request->jobFeature;
            $jobPost->jobDeadline = $request->jobdeadline;
            $jobPost->jobBanner = $thumbnailPath;
            $jobPost->skills = $request->skills;
            $jobPost->noOfVacancy = $request->vacancynumber;

            // Log the job post data before saving
            Log::info('Job Post data to be saved', $jobPost->toArray());

            // Save the job post
            $jobPost->save();

            // Log successful job post creation
            Log::info('Job Post added successfully', ['jobPostId' => $jobPost->id]);

            // Redirect with success message
            return redirect()->route('jobPost.index')->with('success', 'Job Post added successfully');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error adding job post', ['error' => $e->getMessage()]);

            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while adding the job post: ' . $e->getMessage());
        }
    }















    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobPost  $jobPost
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobPost  $jobPost
     * @return \Illuminate\Http\Response
     */
    public function edit(JobPost $jobPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobPost  $jobPost
     * @return \Illuminate\Http\Response
     */
    public function update(JobPosts $request, $id)
    {
        //
        $validated = Validator::make($request->all(), [
            'jobTitle' => 'required|string|max:5000',
            'jobDescription' => ['required', 'string', 'max:100000'],
            'jobLocation' => ['required', 'string', 'max:255'],
            'jobLevel' => 'required|string|in:Entry Level,Mid Level,Senior Level',
            'jobType'=>['required', 'string', 'in:trainee,parttime,fulltime,user'],
            'employeeStartTime' => 'required',
            'employeeEndTime' => 'required',
                 'offeredSalary' => ['numeric', 'nullable'],
            'Experience' => [ 'string', 'max:500'],
            'jobdeadline' => [ 'date', 'after:today'],
            'jobApproval' => [ 'string', 'in:Pending,Approved,Rejected'],
            'jobviewer' => [ 'integer', 'min:0'],
            'vacancynumber' => ['required', 'integer', 'min:1', 'max:500'],
            'skill' => ['nullable'],
            'status'=>['string', 'max:255'],
            'jobFeature' => ['in:normal,premium'],
            'jobSite' => ['in:remote,onsite,hybrid'],
            'jobThumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $employeeTime = $request->employeeStartTime . ' - ' . $request->employeeEndTime;

        if ($validated->fails()) {
            Log::error('Validation failed', $validated->errors()->all());
            return redirect()->back()->withErrors($validated->errors());
        }
        // Validate the request data
        $validatedData = $request->validated();

        try {
            // Find the job post by ID
            $jobPost = JobPost::findOrFail($id);

            // Handle the job banner (uploaded file or cropped image)
            $thumbnailPath = $jobPost->jobBanner; // Keep the existing banner by default

            // If a cropped image is provided, use it
            if ($request->filled('croppedImageBase64')) {
                $base64Image = $request->croppedImageBase64;

                // Remove the data URL part (e.g., "data:image/png;base64,")
                $imageData = explode(',', $base64Image)[1];

                // Decode the image
                $imageData = base64_decode($imageData);

                // Define filename & path
                $fileName = 'job_cropped_' . time() . '.jpg';
                $filePath = 'job_images/' . $fileName;

                // Store the image in public storage
                Storage::disk('public')->put($filePath, $imageData);

                // Delete the old banner if it exists
                if ($jobPost->jobBanner && Storage::disk('public')->exists($jobPost->jobBanner)) {
                    Storage::disk('public')->delete($jobPost->jobBanner);
                }

                // Store the new path for database saving
                $thumbnailPath = $filePath;
            }
            // If a file is uploaded, use it
            elseif ($request->hasFile('jobBanner')) {
                $file = $request->file('jobBanner');
                $fileName = 'job_banner_' . time() . '.' . $file->getClientOriginalExtension();
                $filePath = 'job_images/' . $fileName;

                // Store the file in public storage
                Storage::disk('public')->put($filePath, file_get_contents($file));

                // Delete the old banner if it exists
                if ($jobPost->jobBanner && Storage::disk('public')->exists($jobPost->jobBanner)) {
                    Storage::disk('public')->delete($jobPost->jobBanner);
                }

                // Store the new path for database saving
                $thumbnailPath = $filePath;
            }

            // Combine employee start and end time
            $employeeTime = $request->employeeStartTime . ' - ' . $request->employeeEndTime;

            // Update the job post
            $jobPost->jobTitle = $request->jobTitle;
            $jobPost->jobLevel = $request->jobLevel;
            $jobPost->jobType = $request->jobType;
            $jobPost->jobCategoryId = $request->jobCategoryId;
            $jobPost->jobCompanyId = $request->jobCompanyId;
            $jobPost->postedId = $request->jobpostuserid;
            $jobPost->jobDescription = $request->jobDescription;
            $jobPost->employeeTime = $employeeTime;
            $jobPost->offeredSalary = $request->offeredSalary;
            $jobPost->jobLocation = $request->jobLocation;
            // $jobPost->qualification = $request->qualification;
            $jobPost->experience = $request->experience;
            $jobPost->jobSite = $request->jobSite;
            $jobPost->jobDeadline = $request->jobdeadline;
            $jobPost->jobBanner = $thumbnailPath;
            $jobPost->skills = $request->skills;
            $jobPost->noOfVacancy = $request->vacancynumber;
            $jobPost->jobFeature = $request->jobFeature;


            // Save the updated job post
            $jobPost->save();


            // Redirect with success message
            return redirect()->route('jobPost.index')->with('success', 'Job Post updated successfully');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating job post', ['error' => $e->getMessage()]);

            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while updating the job post: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobPost  $jobPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $jobPost = JobPost::find($id);
        $jobPost->delete();
        return redirect()->route('jobPost.index')->with('success', 'Job Post deleted successfully');
    }
    public function createOrEdit($id = null)
    {
        $jobPost = isset($id) ? JobPost::find($id) : null;
        $categories = JobCategory::all();
        $companies = JobCompany::all();
        $admins = Admin::all();

        return view('backend.postadmin.JobPost.create', compact('jobPost', 'admins', 'categories', 'companies'));
    }

    public function publish($id)
    {
        $jobCategory = JobPost::find($id);
        $jobCategory->jobStatus = 'published';
        $jobCategory->save();
        return redirect()->route('jobPost.index')->with('success', 'Job Posts published successfully.');
    }

    public function unpublish($id)
    {
        $jobCategory = JobPost::find($id);
        $jobCategory->jobStatus = 'unpublished';
        $jobCategory->save();
        return redirect()->route('jobPost.index')->with('success', 'Job Posts unpublished successfully.');
    }
}