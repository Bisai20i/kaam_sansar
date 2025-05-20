<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InsuranceCompany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class InsuranceCompanyController extends Controller
{
    public function index(){
        $companies = InsuranceCompany::orderBy('id', 'desc')->simplePaginate(10);
        return view('backend.insurance.company', compact('companies'));
    }

    public function store(Request $request){

        

        try{
            $request->validate([
                'name' => 'required|string', 
                'status' => 'required|boolean',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            ]);
            
            if($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('insurance', $imageName, 'public');
            };

            InsuranceCompany::create([
                'name' => $request->name,
                'publishStatus' => $request->status,
                'thumbnail' => $imagePath ?? null,
            ]);
           

           
            // Prepare the success message
            
            return redirect()->back()->with('success', "Successfully Added");
        }
        catch(\Exception $e){
            Log::info('Error: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function update(Request $request, $id){

        // dd ( $request->file('thumbnail') );
        try {
            $request->validate([
                'name' => 'required|string',
                'status' => 'required|boolean',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $company = InsuranceCompany::findOrFail($id);
    
            // If a new thumbnail is uploaded
            if ($request->hasFile('thumbnail')) {
                // Delete old image if it exists
                if ($company->thumbnail && Storage::disk('public')->exists($company->thumbnail)) {
                    Storage::disk('public')->delete($company->thumbnail);
                }
    
                // Store the new image
                $image = $request->file('thumbnail');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('insurance', $imageName, 'public');
                $company->thumbnail = $imagePath;
            }
    
            $company->name = $request->name;
            $company->publishStatus = $request->status;
            $company->save();
    
            return redirect()->back()->with('success', 'Company updated successfully');
        } catch (\Exception $e) {
            Log::error('Update Error: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id){    
        try {
            $company = InsuranceCompany::findOrFail($id);
    
            // Delete thumbnail if exists
            if ($company->thumbnail && Storage::disk('public')->exists($company->thumbnail)) {
                Storage::disk('public')->delete($company->thumbnail);
            }
    
            $company->delete();
    
            return redirect()->back()->with('success', 'Company deleted successfully');
        } catch (\Exception $e) {
            Log::error('Delete Error: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function publish($id)
    {
        $insuranceCompany = InsuranceCompany::find($id);
        $insuranceCompany->publishStatus = '1';
        $insuranceCompany->save();
        return redirect()->back()->with('success', 'Country published successfully.');
    }

    public function unpublish($id)
    {
        $insuranceCompany = InsuranceCompany::find($id);
        $insuranceCompany->publishStatus = '0';
        $insuranceCompany->save();
        return redirect()->back()->with('success', ' Country unpublished successfully.');
    }
}
