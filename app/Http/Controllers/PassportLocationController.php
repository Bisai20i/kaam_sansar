<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PassportDistrict;
use Illuminate\Support\Str;
use App\Models\PassportLocation;
use App\Models\PassportProvience;

class PassportLocationController extends Controller
{
    public function index($district_id)
    {
        $district = PassportDistrict::find($district_id);
        $provience = PassportProvience::find($district->provience_id);

        $passportLocationLists = PassportLocation::orderBy('created_at', 'desc')->where('district_id', $district_id)->simplepaginate(10);
        return view('backend.passport_renewal.manage_location', compact('passportLocationLists','district' ,'provience'));
    }


    public function store(Request $request)
    {

        // return $request->all();
        // Validate the incoming request
        $request->validate([
            'location_lists' => 'required|string',
            'district_id' => 'required|numeric' // Validate as a JSON string
        ]);

        // Decode the JSON string into an associative array
        $Lists = json_decode($request->input('location_lists'), true);

        // Check if decoding was successful
        if (!is_array($Lists)) {
            return response()->json(['message' => 'Invalid district lists format'], 422);
        }

        // Initialize arrays to track results
        $skipped = [];
        $stored = [];

        foreach ($Lists as $category) {
            if (!isset($category['name']) || !isset($category['status'])) {
                return response()->json(['message' => 'Each district must have a name and a status'], 422);
            }

            try {
                // Generate a unique slug for the current country
                $slug = $this->generateUniqueSlug($category['name']);
            } catch (\Exception $e) {
                // If slug already exists, add to skipped list and continue
                $skipped[] = $category['name'];
                continue;
            }

            // Store the new country
            PassportLocation::create([
                'district_id' => $request->district_id,
                'locationName' => $category['name'],
                'slug' => $slug,
                'publishStatus' => strtolower($category['status']),
            ]);

            $stored[] = $category['name'];
        }

        // Prepare the success message
        $message = '';
        if (!empty($stored)) {
            $message .= 'The following Locations were added successfully:'.implode(', ', $stored) . ' .';
        }
        if (!empty($skipped)) {
            $message .= 'The following Locations were skipped as they already exist: ' . implode(', ', $skipped) . '.';
        }

        return redirect()->back()->with('success', $message);
    }

    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);

        // Check if slug already exists
        if (PassportLocation::where('slug', $slug)->exists()) {
            throw new \Exception("Slug already exists.");
        }

        return $slug;
    }




    public function update(Request $request, PassportLocation $passportLocationList)
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
        if ($passportLocationList->locationName !== $newName) {
            $newSlug = Str::slug($newName);

            // Check if slug already exists (excluding the current record)
            $query = PassportLocation::where('slug', $newSlug)->where('id', '!=', $passportLocationList->id);

            if ($query->exists()) {
                return redirect()->back()->with('error', "The country name {$newName} already exists.");
            }
        } else {
            // If name is unchanged, keep the existing slug
            $newSlug = $passportLocationList->slug;
        }

        // Update the existing record
        $passportLocationList->update([
            'locationName' => $newName,
            'slug' => $newSlug,
            'publishStatus' => $newStatus,
        ]);

        return redirect()->back()->with('success', 'Location updated successfully.');
    }

    public function destroy(PassportLocation $passportLocationList)
    {

        $passportLocationList->delete();

        return redirect()->back()->with('success', 'Location deleted successfully.');

    }

    public function publish($id)
    {
        $passportLocationList = PassportLocation::find($id);
        $passportLocationList->publishStatus = '1';
        $passportLocationList->save();
        return redirect()->back()->with('success', 'Location published successfully.');
    }

    public function unpublish($id)
    {
        $passportLocationList = PassportLocation::find($id);
        $passportLocationList->publishStatus = '0';
        $passportLocationList->save();
        return redirect()->back()->with('success', ' Location unpublished successfully.');
    }
}
