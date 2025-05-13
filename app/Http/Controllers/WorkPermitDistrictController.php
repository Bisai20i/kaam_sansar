<?php

namespace App\Http\Controllers;

use App\Models\PassportCountryList;
use App\Models\PassportProvience;
use App\Models\WorkPermitDistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WorkPermitDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = WorkPermitDistrict::all();
        $countryId = PassportCountryList::where('countryName', 'Nepal')->value('id');
        $provinces = PassportProvience::where('country_id', $countryId)->get();
        return view('backend.workPermitDistrict.index', compact('districts', 'provinces'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'provience_id' => 'required',
            'districtName' => 'required|string|max:255',
        ]);

        WorkPermitDistrict::create($request->only('provience_id', 'districtName'));

        return redirect()->back()->with('success', value: 'District added successfully.');
    }

    public function edit($id)
    {
        $district = WorkPermitDistrict::findOrFail($id);
        $provinces = PassportProvience::all();
        return response()->json([
            'locattion'=>$district,
            '$provinces'=>$provinces
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'provience_id' => 'required',
            'districtName' => 'required|string|max:255',
        ]);

        $district = WorkPermitDistrict::findOrFail($id);
        $district->update($request->only('provience_id', 'districtName'));

        return redirect()->back()->with('success', value: 'District update successfully.');
    }

    public function destroy($id)
    {
        WorkPermitDistrict::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'District deleted successfully.');
    }
}
