<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PassportProvience;
use App\Models\PassportDistrict;
use Illuminate\Support\Str;


class PassportDistrictController extends Controller
{
    public function index($provience_id)
    {
        $provience = PassportProvience::find($provience_id);
        $passportDistrictLists = PassportDistrict::orderBy('created_at', 'desc')->where('provience_id', $provience_id)->simplepaginate(10);
        return view('backend.passport_renewal.manage_district', compact('passportDistrictLists', 'provience'));
    }


    public function store(Request $request)
    {

        // return $request->all();
        // Validate the incoming request
        $request->validate([
            'district_lists' => 'required|string',
            'provience_id' => 'required|numeric' // Validate as a JSON string
        ]);

        // Decode the JSON string into an associative array
        $Lists = json_decode($request->input('district_lists'), true);

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
            PassportDistrict::create([
                'provience_id' => $request->provience_id,
                'districtName' => $category['name'],
                'slug' => $slug,
                'publishStatus' => strtolower($category['status']),
            ]);

            $stored[] = $category['name'];
        }

        // Prepare the success message
        $message = '';
        if (!empty($stored)) {
            $message .= 'The following districts were added successfully: ' . implode(', ', $stored) . '.';
        }
        if (!empty($skipped)) {
            $message .= 'Entered Districts were skipped as they already exist: ' . implode(', ', $skipped) . '.';
        }

        return redirect()->back()->with('success', $message);
    }

    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);

        // Check if slug already exists
        if (PassportDistrict::where('slug', $slug)->exists()) {
            throw new \Exception("Slug already exists.");
        }

        return $slug;
    }




    public function update(Request $request, PassportDistrict $passportDistrictList)
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
        if ($passportDistrictList->districtName !== $newName) {
            $newSlug = Str::slug($newName);

            // Check if slug already exists (excluding the current record)
            $query = PassportDistrict::where('slug', $newSlug)->where('id', '!=', $passportDistrictList->id);

            if ($query->exists()) {
                return redirect()->back()->with('error', "The country name {$newName} already exists.");
            }
        } else {
            // If name is unchanged, keep the existing slug
            $newSlug = $passportDistrictList->slug;
        }

        // Update the existing record
        $passportDistrictList->update([
            'districtName' => $newName,
            'slug' => $newSlug,
            'publishStatus' => $newStatus,
        ]);

        return redirect()->back()->with('success', 'District updated successfully.');
    }

    public function destroy(PassportDistrict $passportDistrictList)
    {

        $passportDistrictList->delete();

        return redirect()->back()->with('success', 'District deleted successfully.');

    }

    public function publish($id)
    {
        $passportDistrictList = PassportDistrict::find($id);
        $passportDistrictList->publishStatus = '1';
        $passportDistrictList->save();
        return redirect()->back()->with('success', 'District published successfully.');
    }

    public function unpublish($id)
    {
        $passportDistrictList = PassportDistrict::find($id);
        $passportDistrictList->publishStatus = '0';
        $passportDistrictList->save();
        return redirect()->back()->with('success', ' District unpublished successfully.');
    }
}
