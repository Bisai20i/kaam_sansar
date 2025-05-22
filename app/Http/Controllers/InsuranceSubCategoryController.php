<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InsuranceSubCategory;
use App\Models\InsuranceCategory;
use Illuminate\Support\Facades\Log;

class InsuranceSubCategoryController extends Controller
{
    public function index($id)
    {
        $category = InsuranceCategory::with('subCategory')->where('id',$id)->first();

        $sub_categories = $category->subCategory;


       // $sub_categories = InsuranceSubCategory::orderBy('id', 'desc')->where('insurance_category_id', $id)->with('category')->simplePaginate(10);
        return view('backend.insurance.sub_category', compact('category', 'sub_categories'));
    }

    public function store(Request $request){

        $request->validate([
            'category_id' => 'required',
            'sub_category_name' => 'required|string', 
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        try{

            $sub_category = new InsuranceSubCategory();
            $sub_category->name = $request->sub_category_name;
            $sub_category->insurance_category_id = $request->category_id;
            $sub_category->price = $request->price;
            $sub_category->description = $request->description;
            $sub_category->save();

            return redirect()->back()->with('success', 'Sub Category Created Successfully');

        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

       
        
    }

    public function update(Request $request, $id){
        $request->validate([
            'sub_category_name' => 'required|string', 
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        try{
            $sub_category = InsuranceSubCategory::find($id);
            $sub_category->name = $request->sub_category_name;
            $sub_category->price = $request->price;
            $sub_category->description = $request->description;
            $sub_category->save();

            return redirect()->back()->with('success', 'Sub Category Updated Successfully');

        }
        catch(\Exception $e){
            Log::error('Update Error: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id){    
        try {
            $sub_category = InsuranceSubCategory::findOrFail($id);
            $sub_category->delete();
            return redirect()->back()->with('success', 'Sub Category deleted successfully');
        } catch (\Exception $e) {
            Log::error('Delete Error: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function publish($id)
    {
        $insuranceCompany = InsuranceSubCategory::find($id);
        $insuranceCompany->publishStatus = '1';
        $insuranceCompany->save();
        return redirect()->back()->with('success', 'Sub Category published successfully.');
    }

    public function unpublish($id)
    {
        $insuranceCompany = InsuranceSubCategory::find($id);
        $insuranceCompany->publishStatus = '0';
        $insuranceCompany->save();
        return redirect()->back()->with('success', 'Sub Category unpublished successfully.');
    }
}
