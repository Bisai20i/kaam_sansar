<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\IndustryCategory;
use libphonenumber\Leniency\Valid;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class IndustryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $industrycategories = IndustryCategory::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('backend.industrycategory.lists', compact('industrycategories'));
    }

    public function getIndustries(Request $request)
    {

        Log::info($request->all());
        // Get the search query from the request
        $query = $request->input('q');

        // Fetch industries that match the query
        $industries = IndustryCategory::where('industryName', 'like', "%$query%")
            ->select('id', 'industryName') // Select only the required fields
            ->get();

        // Return the industries as a JSON response
        return response()->json($industries);
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

        $validated = Validator::make($request->all(), [
            'industry_name' => 'required',
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }
        // try {
        $slug = $this->generateSlug($request->industry_name);
        if ($slug === null) {
            return redirect()->back()
                ->withErrors(['industry_name' => 'This industry name already exists. Please use a different name.'])
                ->withInput();
        }
        $industryCategory = new IndustryCategory();
        $industryCategory->industryName = $request->industry_name;
        $industryCategory->slug = $slug;
        $industryCategory->save();
        return redirect()->route('industryCategory.index')->with('success', 'Industry Category added successfully');
        // } catch (\Exception $e) {
        //     return redirect()->back()->with('error', $e->getMessage());
        // }
    }

    private function generateSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = Str::slug($title);

        // Get all slugs that could possibly be related
        $allSlugs = IndustryCategory::select('slug')
            ->where('id', '!=', $id)
            ->whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")
            ->pluck('slug')
            ->toArray();

        // Check if the slug already exists
        if (!in_array($slug, $allSlugs)) {
            return $slug;
        }

        // If the slug exists, inform the user
        return null;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IndustryCategory  $industryCategory
     * @return \Illuminate\Http\Response
     */
    public function show(IndustryCategory $industryCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndustryCategory  $industryCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(IndustryCategory $industryCategory)
    {
        if (!$industryCategory) {
            return redirect()->route('industryCategory.index')->with('error', 'Industry Category not found');
        }
        $industrycategories = IndustryCategory::orderBy('created_at', 'desc')->simplePaginate(20);
        return view('backend.IndustryCategory.lists', compact('industryCategory', 'industrycategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IndustryCategory  $industryCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IndustryCategory $industryCategory)
    {
        $validated = Validator::make($request->all(), [
            'industry_name' => 'required',
        ]);
        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }
        try {
            $slug = $this->generateSlug($request->industry_name, $industryCategory->id);
            if ($slug === null) {
                return redirect()->back()
                    ->withErrors(['industry_name' => 'This industry name already exists. Please use a different name.'])
                    ->withInput();
            }
            $industryCategory->industryName = $request->industry_name;
            $industryCategory->slug = $slug;
            $industryCategory->save();
            return redirect()->route('industryCategory.index')->with('success', 'Industry Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IndustryCategory  $industryCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndustryCategory $industryCategory)
    {
        try {
            $industryCategory->delete();
            return redirect()->route('industryCategory.index')->with('success', 'Industry Category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('industryCategory.index')->with('error', 'Industry Category not deleted successfully');
        }
    }
}
