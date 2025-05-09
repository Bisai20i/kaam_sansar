<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\PassportProvience;
use App\Models\PassportCountryList;

class PassportProvienceController extends Controller
{
    public function index($country_id)
    {
        $country = PassportCountryList::find($country_id);
        $passportProvienceLists = PassportProvience::orderBy('created_at', 'desc')->where('country_id', $country_id)->simplepaginate(10);
        return view('backend.passport_renewal.manage_provience', compact('passportProvienceLists', 'country'));
    }


    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'provience_lists' => 'required|string',
            'country_id' => 'required|numeric' // Validate as a JSON string
        ]);

        // Decode the JSON string into an associative array
        $provienceLists = json_decode($request->input('provience_lists'), true);

        // Check if decoding was successful
        if (!is_array($provienceLists)) {
            return response()->json(['message' => 'Invalid country lists format'], 422);
        }

        // Initialize arrays to track results
        $skippedProviences = [];
        $storedProviences = [];

        foreach ($provienceLists as $category) {
            if (!isset($category['name']) || !isset($category['status'])) {
                return response()->json(['message' => 'Each country must have a name and a status'], 422);
            }

            try {
                // Generate a unique slug for the current country
                $slug = $this->generateUniqueSlug($category['name']);
            } catch (\Exception $e) {
                // If slug already exists, add to skipped list and continue
                $skippedProviences[] = $category['name'];
                continue;
            }

            // Store the new country
            PassportProvience::create([
                'country_id' => $request->country_id,
                'provienceName' => $category['name'],
                'slug' => $slug,
                'publishStatus' => strtolower($category['status']),
            ]);

            $storedProviences[] = $category['name'];
        }

        // Prepare the success message
        $message = '';
        if (!empty($storedProviences)) {
            $message .= 'The following countries were added successfully';
        }
        if (!empty($skippedProviences)) {
            $message .= 'The following countries were skipped as they already exist: ' . implode(', ', $skippedProviences) . '.';
        }

        return redirect()->back()->with('success', $message);
    }

    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);

        // Check if slug already exists
        if (PassportProvience::where('slug', $slug)->exists()) {
            throw new \Exception("Slug already exists.");
        }

        return $slug;
    }




    public function update(Request $request, PassportProvience $passportProvienceList)
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
        if ($passportProvienceList->provienceName !== $newName) {
            $newSlug = Str::slug($newName);

            // Check if slug already exists (excluding the current record)
            $query = PassportProvience::where('slug', $newSlug)->where('id', '!=', $passportProvienceList->id);

            if ($query->exists()) {
                return redirect()->back()->with('error', "The country name {$newName} already exists.");
            }
        } else {
            // If name is unchanged, keep the existing slug
            $newSlug = $passportProvienceList->slug;
        }

        // Update the existing record
        $passportProvienceList->update([
            'provienceName' => $newName,
            'slug' => $newSlug,
            'publishStatus' => $newStatus,
        ]);

        return redirect()->back()->with('success', 'Provience updated successfully.');
    }

    public function destroy(PassportProvience $passportProvienceList)
    {

        $passportProvienceList->delete();

        return redirect()->back()->with('success', 'Provience deleted successfully.');

    }

    public function publish($id)
    {
        $passportProvienceList = PassportProvience::find($id);
        $passportProvienceList->publishStatus = '1';
        $passportProvienceList->save();
        return redirect()->back()->with('success', 'Provience published successfully.');
    }

    public function unpublish($id)
    {
        $passportProvienceList = PassportProvience::find($id);
        $passportProvienceList->publishStatus = '0';
        $passportProvienceList->save();
        return redirect()->back()->with('success', ' Provience unpublished successfully.');
    }
}
