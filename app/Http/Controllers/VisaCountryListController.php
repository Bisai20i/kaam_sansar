<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\VisaCountryList;

class VisaCountryListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visaCountryLists = VisaCountryList::orderBy('created_at', 'desc')->simplepaginate(10);
        return view('backend.VisaHQ.countrylists', compact('visaCountryLists'));
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
    //     // Validate the incoming request
    //     $request->validate([
    //         'country_lists' => 'required|string', // Validate as a JSON string
    //     ]);

    //     // Decode the JSON string into an associative array
    //     $countryLists = json_decode($request->input('country_lists'), true);

    //     // Check if decoding was successful
    //     if (!is_array($countryLists)) {
    //         return response()->json(['message' => 'Invalid country lists format'], 422);
    //     }

    //     // Initialize an array to keep track of skipped countries
    //     $skippedCountries = [];

    //     // Iterate over each country and insert it into the database if it doesn't already exist
    //     foreach ($countryLists as $category) {
    //         if (!isset($category['name']) || !isset($category['status'])) {
    //             return response()->json(['message' => 'Each country must have a name and a status'], 422);
    //         }

    //         // Generate the slug for the current country
    //         try {
    //             $slug = $this->generateUniqueSlug($category['name']);
    //         } catch (\Exception $e) {
    //             return redirect()->route('visaCountryList.index')->with('error', $e->getMessage());
    //         }

    //         // Check if the slug already exists in the database
    //         $existingCountry = VisaCountryList::where('slug', $slug)->first();

    //         if ($existingCountry) {
    //             // If the slug already exists, add the country to the skipped list and continue
    //             $skippedCountries[] = $category['name'];
    //             continue;
    //         }

    //         // If the slug does not exist, create a new entry
    //         VisaCountryList::create([
    //             'countryName' => $category['name'],
    //             'slug' => $slug,
    //             'publishStatus' => strtolower($category['status']),
    //         ]);
    //     }

    //     // Prepare the success message
    //     $message = 'Countries added successfully.';
    //     if (!empty($skippedCountries)) {
    //         $message .= ' The following countries were skipped as they already exist: ' . implode(', ', $skippedCountries);
    //     }

    //     return redirect()->route('visaCountryList.index')->with('success', $message);
    // }

    // private function generateUniqueSlug($name, $excludeId = null)
    // {
    //     // Create an initial slug from the name
    //     $slug = Str::slug($name);

    //     // Query to find if the slug already exists, excluding the current record (if provided)
    //     $query = VisaCountryList::where('slug', $slug);

    //     if ($excludeId) {
    //         $query->where('id', '!=', $excludeId);
    //     }

    //     $existingSlug = $query->exists();

    //     // If the slug already exists and is not part of the excluded ID, throw an exception
    //     if ($existingSlug) {
    //         throw new \Exception("The slug for the name {$name} already exists.");
    //     }

    //     return $slug;
    // }



    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'country_lists' => 'required|string', // Validate as a JSON string
        ]);

        // Decode the JSON string into an associative array
        $countryLists = json_decode($request->input('country_lists'), true);

        // Check if decoding was successful
        if (!is_array($countryLists)) {
            return response()->json(['message' => 'Invalid country lists format'], 422);
        }

        // Initialize arrays to track results
        $skippedCountries = [];
        $storedCountries = [];

        foreach ($countryLists as $category) {
            if (!isset($category['name']) || !isset($category['status'])) {
                return response()->json(['message' => 'Each country must have a name and a status'], 422);
            }

            try {
                // Generate a unique slug for the current country
                $slug = $this->generateUniqueSlug($category['name']);
            } catch (\Exception $e) {
                // If slug already exists, add to skipped list and continue
                $skippedCountries[] = $category['name'];
                continue;
            }

            // Store the new country
            VisaCountryList::create([
                'countryName' => $category['name'],
                'slug' => $slug,
                'publishStatus' => strtolower($category['status']),
            ]);

            $storedCountries[] = $category['name'];
        }

        // Prepare the success message
        $message = '';
        if (!empty($storedCountries)) {
            $message .= 'The following countries were added successfully';
        }
        if (!empty($skippedCountries)) {
            $message .= 'The following countries were skipped as they already exist: ' . implode(', ', $skippedCountries) . '.';
        }

        return redirect()->route('visaCountryList.index')->with('success', $message);
    }

    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);

        // Check if slug already exists
        if (VisaCountryList::where('slug', $slug)->exists()) {
            throw new \Exception("Slug already exists.");
        }

        return $slug;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VisaCountryList  $visaCountryList
     * @return \Illuminate\Http\Response
     */
    public function show(VisaCountryList $visaCountryList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisaCountryList  $visaCountryList
     * @return \Illuminate\Http\Response
     */
    public function edit(VisaCountryList $visaCountryList) {}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisaCountryList  $visaCountryList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisaCountryList $visaCountryList)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        // Extract data from request
        $newName = $request->input('name');
        $newStatus = strtolower($request->input('status'));

        // Generate a unique slug only if the name has changed
        if ($visaCountryList->countryName !== $newName) {
            $newSlug = Str::slug($newName);

            // Check if slug already exists (excluding the current record)
            $query = VisaCountryList::where('slug', $newSlug)->where('id', '!=', $visaCountryList->id);

            if ($query->exists()) {
                return redirect()->route('visaCountryList.index')->with('error', "The country name {$newName} already exists.");
            }
        } else {
            // If name is unchanged, keep the existing slug
            $newSlug = $visaCountryList->slug;
        }

        // Update the existing record
        $visaCountryList->update([
            'countryName' => $newName,
            'slug' => $newSlug,
            'publishStatus' => $newStatus,
        ]);

        return redirect()->route('visaCountryList.index')->with('success', 'Country updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisaCountryList  $visaCountryList
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisaCountryList $visaCountryList)
    {
        

        $visaCountryList->delete();

        return redirect()->route('visaCountryList.index')->with('success', 'Country deleted successfully.');
    }

    public function publish($id)
    {
        $jobCategory = VisaCountryList::find($id);
        $jobCategory->publishStatus = '1';
        $jobCategory->save();
        return redirect()->route('visaCountryList.index')->with('success', 'Country published successfully.');
    }

    public function unpublish($id)
    {
        $jobCategory = VisaCountryList::find($id);
        $jobCategory->publishStatus = '0';
        $jobCategory->save();
        return redirect()->route('visaCountryList.index')->with('success', ' Country unpublished successfully.');
    }
}
