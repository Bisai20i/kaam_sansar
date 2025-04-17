<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $productCategories = ProductCategory::all();
        $isMobile = request()->has('request_type') && request()->input('request_type') === 'mobile';

        if ($isMobile) {
            return response()->json($productCategories);
        } else {
            return view('backend.aboards.productcategory.lists', compact('productCategories'));
        }
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'productCategoryTitle' => 'required|string|max:255',
        ]);

        $slug = $this->generateSlug($request->productCategoryTitle);
        if ($slug === null) {
            return redirect()->back()
                ->withErrors(['productCategoryTitle' => 'This name already exists. Please use a different name.'])
                ->withInput();
        }

        $category = new ProductCategory();
        $category->productCategoryTitle = $request->input('productCategoryTitle');
        $category->productCategorySlug = $slug;
        $category->save();

        return redirect()->route('productcategory.index')->with('success', 'Product Category Created Successfully');
    }

    private function generateSlug($title, $id = 0)
    {
        $slug = Str::slug($title);
        $allSlugs = ProductCategory::select('productCategorySlug')
            ->where('id', '!=', $id)
            ->whereRaw("productCategorySlug RLIKE '^{$slug}(-[0-9]+)?$'")
            ->pluck('productCategorySlug')
            ->toArray();

        if (!in_array($slug, $allSlugs)) {
            return $slug;
        }

        return null;
    }

    public function edit($id)
    {
        $editCategory = ProductCategory::findOrFail($id);
        $productCategories = ProductCategory::all();

        return view('backend.aboards.productcategory.lists', compact('editCategory', 'productCategories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'productCategoryTitle' => 'required|string|max:255',
        ]);

        $slug = $this->generateSlug($request->productCategoryTitle, $id);
        if ($slug === null) {
            return redirect()->back()
                ->withErrors(['productCategoryTitle' => 'This name already exists. Please use a different name.'])
                ->withInput();
        }

        $category = ProductCategory::findOrFail($id);
        $category->productCategoryTitle = $request->input('productCategoryTitle');
        $category->productCategorySlug = $slug;
        $category->save();

        return redirect()->route('productcategory.index')->with('success', 'Product Category Updated Successfully');
    }

    public function destroy($id)
    {
        try {
            $category = ProductCategory::findOrFail($id);
            $category->delete();
            return redirect()->route('productcategory.index')->with('success', 'Product Category Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->route('productcategory.index')->with('error', 'Product Category Not Deleted Successfully');
        }
    }
}
