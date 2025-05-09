<?php

namespace App\Http\Controllers;

use App\Models\InsuranceCategory;
use App\Models\InsuranceCategoryDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Validator;

class InsuranceCategoryController extends Controller
{
    public function index($id){
        $categories = InsuranceCategory::where('insurance_company_id',$id)->orderBy('id', 'desc')->get();
        
        return response()->json([
           'status' => true,
           'message' => 'Successfully Fetched',
           'data' => $categories,
        ]);
    }

    public function insertDetails(Request $request){

        
        $request->validate([
            'category_id' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'description' => 'required|string',
        ]);

        if($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('insurance', $imageName, 'public');
        };

        $detail = InsuranceCategoryDetail::create([
            'insurance_category_id' => $request->category_id,
            'description' => $request->description,
            'thumbnail' => $imagePath ?? null,
        ]);

        return redirect()->back()->with("success", "Successfully Added");

    }

    public function store(Request $request){


        // return response()->json([
        //     'status' => true,
        //     'message' => 'Successfully Added',
        //     'data' => $request->categories,
        // ]);

        try{

            $validData = Validator::make($request->all(), [
                'categories'=> 'required|array',
            ]);

            if ($validData->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' => $validData->errors(),
                ]);
            }
    
            // Decode the JSON string into an associative array
            $categories = $request->input('categories');
    
            // Check if decoding was successful
            if (!is_array($categories)) {
                return response()->json(['message' => 'Invalid Cagtegories lists format'], 422);
            }
    
            $storedCategories = [];
            foreach ($categories as $category) {
                if (!isset($category['name']) || !isset($category['status'])) {
                    return response()->json(['message' => 'Each country must have a name and a status'], 422);
                }

               // Store the new country
                $addedCategory = InsuranceCategory::create([
                    'insurance_company_id' => $category['company_id'],
                    'name' => $category['name'],
                    'publishStatus' => $category['status'],
                ]);
    
                $storedCategories[] = $addedCategory;
            }
    
            // Prepare the success message
            $message = '';

            if (!empty($storedCategories)) {
                $message .= 'The categories were added successfully';
            }


            return response()->json([
                'status' => true,
                'message' => $message,
                'data' => $storedCategories,
            ]);
            
        }
        catch(\Exception $e){
            Log::info('Error: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
            ]);
        }

    }

    public function update(Request $request, $id){

        // dd ( $request->file('thumbnail') );
        try {
            $request->validate([
                'detail_id' => 'required|numeric',
                'category_name' => 'required|string',
                'description' => 'required|string',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $detail = InsuranceCategoryDetail::findOrFail($id);

            if(!$detail){
                return redirect()->back()->with('error', 'Category Details not found');
            }

            if($request->category_name){
                $category = InsuranceCategory::findOrFail($detail->insurance_category_id);
                $category->name = $request->category_name;
                $category->save();
            }

            // If a new thumbnail is uploaded

            if($request->file('thumbnail')) {
                // Delete old image if it exists
                if ($detail->thumbnail && Storage::disk('public')->exists($detail->thumbnail)) {
                    Storage::disk('public')->delete($detail->thumbnail);
                }

                $image = $request->file('thumbnail');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('insurance', $imageName, 'public');
                $detail->thumbnail = $imagePath;
            }
            
            $detail->description = $request->description;
            $detail->save();
    
            return redirect()->back()->with('success', 'Category Details updated successfully');
        } catch (\Exception $e) {
            Log::error('Update Error: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id){    
        try {
            $category = InsuranceCategory::findOrFail($id);

    
            $category->delete();
    
            return response()->json([
                'status' => true,
                'message' => 'Category deleted successfully',
            ]);
        } catch (\Exception $e) {
            Log::error('Delete Error: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'errors' => $e->getMessage(),
            ]);
        }
    }

    public function manage($id)
    {
        $category = InsuranceCategory::with('insuranceDetail')->findOrFail($id);
        
        return view('backend.Insurance.details', [
            'category' => $category,
            'detail' => $category->insuranceDetail
        ]);
    }


    public function publish($id)
    {
        $insuranceCompany = InsuranceCategory::find($id);
        $insuranceCompany->publishStatus = '1';
        $insuranceCompany->save();
        return redirect()->back()->with('success', 'Category published successfully.');
    }

    public function unpublish($id)
    {
        $insuranceCompany = InsuranceCategory::find($id);
        $insuranceCompany->publishStatus = '0';
        $insuranceCompany->save();
        return redirect()->back()->with('success', ' Category unpublished successfully.');
    }
}
