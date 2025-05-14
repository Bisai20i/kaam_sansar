<?php

namespace App\Http\Controllers;

use App\Models\WorkPermitLocation;
use App\Models\WorkPermitDistrict;
use Illuminate\Http\Request;

class WorkPermitLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = WorkPermitLocation::all();
        $districts = WorkPermitDistrict::all();
        return view('backend.workPermitLocation.index', compact('locations', 'districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'district_id' => 'required|exists:work_permit_districts,id',
            'locationName' => 'required|string|max:255',
        ]);

        WorkPermitLocation::create($request->only('district_id', 'locationName'));

        return redirect()->back()->with('success', 'Location added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = WorkPermitLocation::findOrFail($id); // Fetch the specific location
        $districts = WorkPermitDistrict::all(); // Fetch all districts
        return response()->json([
            'location' => $location,
            'districts' => $districts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'district_id' => 'required|exists:work_permit_districts,id',
            'locationName' => 'required|string|max:255',
        ]);

        $location = WorkPermitLocation::findOrFail($id);
        $location->update($request->only('district_id', 'locationName'));

        return redirect()->back()->with('success', 'Location updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        WorkPermitLocation::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Location deleted successfully.');
    }
}
