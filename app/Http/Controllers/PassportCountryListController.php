<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PassportCountryList;
use Illuminate\Support\Str;

class PassportCountryListController extends Controller
{
    public function index()
    {
        $passportCountryLists = PassportCountryList::orderBy('created_at', 'desc')->simplepaginate(10);
        return view('backend.passport_renewal.manage_country', compact('passportCountryLists'));
    }


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
            PassportCountryList::create([
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

        return redirect()->back()->with('success', $message);
    }

    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);

        // Check if slug already exists
        if (PassportCountryList::where('slug', $slug)->exists()) {
            throw new \Exception("Slug already exists.");
        }

        return $slug;
    }




    public function update(Request $request, PassportCountryList $passportCountryList)
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
        if ($passportCountryList->countryName !== $newName) {
            $newSlug = Str::slug($newName);

            // Check if slug already exists (excluding the current record)
            $query = PassportCountryList::where('slug', $newSlug)->where('id', '!=', $passportCountryList->id);

            if ($query->exists()) {
                return redirect()->back()->with('error', "The country name {$newName} already exists.");
            }
        } else {
            // If name is unchanged, keep the existing slug
            $newSlug = $passportCountryList->slug;
        }

        // Update the existing record
        $passportCountryList->update([
            'countryName' => $newName,
            'slug' => $newSlug,
            'publishStatus' => $newStatus,
        ]);

        return redirect()->back()->with('success', 'Country updated successfully.');
    }

    public function destroy(PassportCountryList $passportCountryList)
    {
        

        $passportCountryList->delete();

        return redirect()->back()->with('success', 'Country deleted successfully.');
    }

    public function publish($id)
    {
        $passportCountryList = PassportCountryList::find($id);
        $passportCountryList->publishStatus = '1';
        $passportCountryList->save();
        return redirect()->back()->with('success', 'Country published successfully.');
    }

    public function unpublish($id)
    {
        $passportCountryList = PassportCountryList::find($id);
        $passportCountryList->publishStatus = '0';
        $passportCountryList->save();
        return redirect()->back()->with('success', ' Country unpublished successfully.');
    }
}
