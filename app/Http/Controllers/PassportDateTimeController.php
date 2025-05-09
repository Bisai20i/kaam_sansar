<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PassportLocation;
use App\Models\PassportDateTime;


class PassportDateTimeController extends Controller
{
    public function index($location_id)
    {
        $location = PassportLocation::find($location_id);

        $dateTimes = PassportDateTime::orderBy('created_at', 'desc')->where('location_id', $location_id)->simplepaginate(10);
        return view('backend.passport_renewal.manage_date_time', compact('dateTimes','location' ));

    }

    public function store(Request $request)
    {

        // return $request->all();
        // Validate the incoming request
        $request->validate([
            'date' => 'required|date',
            'times' => 'required|string',
            'location_id' => 'required|numeric' // Validate as a JSON string
        ]);

        // Decode the JSON string into an associative array
        $Lists = json_decode($request->input('times'), true);

        // Check if decoding was successful
        if (!is_array($Lists)) {
            return response()->json(['message' => 'Invalid Time format'], 422);
        }


            // Store the new country
        PassportDateTime::create([
            'location_id' => $request->location_id,
            'date' => $request->date,
            'time' => $Lists,
        ]);

        return redirect()->back()->with('success', "Date Time Added Successfully.");
    }

    public function destroy(PassportDateTime $passportDateTime)
    {

        $passportDateTime->delete();

        return redirect()->back()->with('success', 'Date time Deleted Successfully.');

    }


}
