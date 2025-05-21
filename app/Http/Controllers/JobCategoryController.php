<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use libphonenumber\Leniency\Valid;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobCategories = JobCategory::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('backend.jobcategory.lists', compact('jobCategories'));
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
        // Validate the incoming request
        $request->validate([
            'job_categories' => 'required|string', // Validate as a JSON string
        ]);

        // Decode the JSON string into an associative array
        $jobCategories = json_decode($request->input('job_categories'), true);

        // Check if decoding was successful
        if (!is_array($jobCategories)) {
            return response()->json(['message' => 'Invalid job_categories format'], 422);
        }

        // Iterate over each job category and insert it into the database
        foreach ($jobCategories as $category) {
            if (!isset($category['name']) || !isset($category['status'])) {
                return response()->json(['message' => 'Each job category must have a name and a status'], 422);
            }

            try {
                $slug = $this->generateUniqueSlug($category['name']);
            } catch (\Exception $e) {
                return redirect()->route('jobCategory.index')->with('error', $e->getMessage());
            }

            JobCategory::create([
                'jobCategoryName' => $category['name'],
                'slug' => $slug,
                'status' => strtolower($category['status']),
            ]);
        }


        return redirect()->route('jobCategory.index')->with('success', 'Job categories added successfully.');
    }

    private function generateUniqueSlug($name, $excludeId = null)
    {
        // Create an initial slug from the name
        $slug = Str::slug($name);

        // Query to find if the slug already exists, excluding the current record (if provided)
        $query = JobCategory::where('slug', $slug);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        $existingSlug = $query->exists();

        // If the slug already exists and is not part of the excluded ID, return a validation error or handle appropriately
        if ($existingSlug) {
            throw new \Exception("The slug for the name '{$name}' already exists.");
        }

        return $slug;
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobCategory  $jobCategory
     * @return \Illuminate\Http\Response
     */
    public function show(JobCategory $jobCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobCategory  $jobCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(JobCategory $jobCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobCategory  $jobCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobCategory $jobCategory)
    {


        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string',
            'status' => 'required|string|in:active,inactive,pending',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData->errors());
        }

        try {
            $jobCategory->jobCategoryName = $request->name;
            $jobCategory->status = $request->status;

            // Generate a unique slug for the updated name
            $jobCategory->slug = $this->generateUniqueSlug($request->name, $jobCategory->id);

            $jobCategory->save();

            return redirect()->route('jobCategory.index')->with('success', 'Job category updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('jobCategory.index')->with('error', $e->getMessage());
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobCategory  $jobCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobCategory $jobCategory)
    {
        try {
            $jobCategory->delete();
            return redirect()->route('jobCategory.index')->with('success', 'Job category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('jobCategory.index')->with('error', $e->getMessage());
        }
    }

    public function publish($id)
    {
        $jobCategory = JobCategory::find($id);
        $jobCategory->publishStatus = 'published';
        $jobCategory->save();
        return redirect()->route('jobCategory.index')->with('success', 'Job category published successfully.');
    }

    public function unpublish($id)
    {
        $jobCategory = JobCategory::find($id);
        $jobCategory->publishStatus = 'unpublished';
        $jobCategory->save();
        return redirect()->route('jobCategory.index')->with('success', 'Job category unpublished successfully.');
    }
}
