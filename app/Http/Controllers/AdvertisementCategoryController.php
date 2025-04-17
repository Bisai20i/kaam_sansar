<?php

namespace App\Http\Controllers;

use App\Models\AdvertisementCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdvertisementCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Retrive all Advertisement category
        $advertisementCategory= AdvertisementCategory::all();
    //    $advertisementCategory= AdvertisementCategory::orderBy('created_at', 'desc')->simplePaginate(5);
     //Retrive all Advertisement category from database using over


        $isMobile = request()->has('request_type') && request()->input('request_type') === 'mobile';

        if ($isMobile) {
            return response()->json($advertisementCategory);
        } else {
            return view('backend.adscategory.lists', compact('advertisementCategory'));
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'advertisementCategoryTitle' => 'required|string|max:255',
        ]);

        //slug created
        $slug = $this->generateSlug($request->advertisementCategoryTitle);
        if ($slug === null) {
            return redirect()->back()
                ->withErrors(['advertisementCategoryTitle' => 'This name already exists. Please use a different name.'])
                ->withInput();
        }

        // Create new AdvertisementCategory instance
        $adsCategory = new AdvertisementCategory();
        $adsCategory->adsCategoryTitle = $request->input('advertisementCategoryTitle');
        // $adsCategory->adsCategorySlug = Str::slug($request->input('advertisementCategoryTitle'));
        $adsCategory->adsCategorySlug=$slug;

        // Save to database
        $adsCategory->save();

        // Redirect back with success message
        return redirect()->route('advertisementcategory.index')->with('success', 'Ads Category Created Successfully');
    }

    private function generateSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = Str::slug($title);

        // Get all slugs that could possibly be related
        $allSlugs = AdvertisementCategory::select('adsCategorySlug')
            ->where('id', '!=', $id)
            ->whereRaw("adsCategorySlug RLIKE '^{$slug}(-[0-9]+)?$'")
            ->pluck('adsCategorySlug')
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
     *
     *
     * @param  \App\Models\AdvertisementCategory  $advertisementCategory
     * @return \Illuminate\Http\Response
     */
    public function show(AdvertisementCategory $advertisementCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdvertisementCategory  $advertisementCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id  )

    {
        //
        $editCategory = AdvertisementCategory::findOrFail($id);
        $advertisementCategory = AdvertisementCategory::all();

        return view('backend.adscategory.lists',compact('editCategory','advertisementCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdvertisementCategory  $advertisementCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          // Validate the request
        $validated = $request->validate([
            'advertisementCategoryTitle' => 'required|string|max:255',
        ]);
        //slug updated
        $slug = $this->generateSlug($request->advertisementCategoryTitle,$id);
        if ($slug === null) {
            return redirect()->back()
                ->withErrors(['advertisementCategoryTitle' => 'This name already exists. Please use a different name.'])
                ->withInput();
        }

        // Create new AdvertisementCategory instance
        $adsCategory =  AdvertisementCategory::findOrFail($id);
        $adsCategory->adsCategoryTitle = $request->input('advertisementCategoryTitle');
        // $adsCategory->adsCategorySlug = Str::slug($request->input('advertisementCategoryTitle'));
        $adsCategory->adsCategorySlug= $slug;

        // Save to database
        $adsCategory->save();

        // Redirect back with success message
        return redirect()->route('advertisementcategory.index')->with('success', 'Ads Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdvertisementCategory  $advertisementCategory
     * @return \Illuminate\Http\Response
     */
   public function destroy(Request $request, $id)

    {
        //get the adscategory id which need to delete
        try{
        $adsCategory= AdvertisementCategory::findOrFail($id);

            $adsCategory->delete();
      return redirect()->route('advertisementcategory.index')->with('success', 'adscategory deleted successfully');
        }catch (\Exception $e) {
           return redirect()->route('advertisementcategory.index')->with('error','Ads category not deleted successfully');
        }
    }
}
