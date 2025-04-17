<?php

namespace App\Http\Controllers;

use App\Models\VisaType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class VisaTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visaTypesLists = VisaType::orderBy('created_at', 'desc')->simplepaginate(10);
        return view('backend.VisaHQ.visatype', compact('visaTypesLists'));
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
            'visa_types_lists' => 'required|string', // Validate as a JSON string
        ]);

        // Decode the JSON string into an associative array
        $visa_types_lists = json_decode($request->input('visa_types_lists'), true);

        // Check if decoding was successful
        if (!is_array($visa_types_lists)) {
            return response()->json(['message' => 'Invalid visa type lists format'], 422);
        }

        // Initialize arrays to track results
        $skippedVisatypes = [];
        $storedVisatypes = [];

        foreach ($visa_types_lists as $category) {
            if (!isset($category['name']) || !isset($category['status'])) {
                return response()->json(['message' => 'Each visa type  must have a name and a status'], 422);
            }

            try {
                // Generate a unique slug for the current country
                $slug = $this->generateUniqueSlug($category['name']);
            } catch (\Exception $e) {
                // If slug already exists, add to skipped list and continue
                $skippedVisatypes[] = $category['name'];
                continue;
            }

            // Store the new country
            VisaType::create([
                'visaTypeName' => $category['name'],
                'slug' => $slug,
                'publishStatus' => strtolower($category['status']),
            ]);

            $storedVisatypes[] = $category['name'];
        }

        // Prepare the success message
        $message = '';
        if (!empty($storedVisatypes)) {
            $message .= 'The following visa types were added successfully';
        }
        if (!empty($skippedVisatypes)) {
            $message .= 'The following visa types were skipped as they already exist: ' . implode(', ', $skippedVisatypes) . '.';
        }

        return redirect()->route('VisaTypeList.index')->with('success', $message);
    }

    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);

        // Check if slug already exists
        if (VisaType::where('slug', $slug)->exists()) {
            throw new \Exception("Slug already exists.");
        }

        return $slug;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VisaType  $visaType
     * @return \Illuminate\Http\Response
     */
    public function show(VisaType $visaType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisaType  $visaType
     * @return \Illuminate\Http\Response
     */
    public function edit(VisaType $visaType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisaType  $VisaTypeList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisaType $VisaTypeList)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        // Extract data from request
        $newName = $request->input('name');
        $newStatus = strtolower($request->input('status'));

        // Generate a unique slug only if the name has changed
        if ($VisaTypeList->visaTypeName !== $newName) {
            $newSlug = Str::slug($newName);

            // Check if slug already exists (excluding the current record)
            $query = VisaType::where('slug', $newSlug)->where('id', '!=', $VisaTypeList->id);

            if ($query->exists()) {
                return redirect()->route('VisaTypeList.index')->with('error', "The visa type name {$newName} already exists.");
            }
        } else {
            // If name is unchanged, keep the existing slug
            $newSlug = $VisaTypeList->slug;
        }

        // Update the existing record
        $VisaTypeList->update([
            'visaTypeName' => $newName,
            'slug' => $newSlug,
            'publishStatus' => $newStatus,
        ]);

        return redirect()->route('VisaTypeList.index')->with('success', 'Visa type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisaType  $visaType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $visaType = VisaType::find($id);
        $visaType->delete();
        return redirect()->route('VisaTypeList.index')->with('success', 'Visa type deleted successfully.');
    }

    public function publish($id)
    {
        $jobCategory = VisaType::find($id);
        $jobCategory->publishStatus = '1';
        $jobCategory->save();
        return redirect()->route('VisaTypeList.index')->with('success', 'Visa type published successfully.');
    }

    public function unpublish($id)
    {
        $jobCategory = VisaType::find($id);
        $jobCategory->publishStatus = '0';
        $jobCategory->save();
        return redirect()->route('VisaTypeList.index')->with('success', ' Visa type unpublished successfully.');
    }
}
