<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BecomeSeller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BecomeSellerController extends Controller
{
    public function store(Request $request)
    {
        // Log::info("Request received", $request->all());
        // dd($request->all()); // This will stop and dump the request data to check



        // Validate the request
        $validator = Validator::make($request->all(), [
            // Personal Information
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'whatsapp_number' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',

            // Bank Details
            'bank_name' => 'required|string|max:255',
            'bank_holder_name' => 'required|string|max:255',
            'bank_account_number' => 'required|string|max:255',
            'iban_number' => 'nullable|string|max:255',
            'swift_code' => 'nullable|string|max:255',
            'bank_country' => 'required|string|max:255',
            'branch_location' => 'required|string|max:255',

            // Business Details
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'business_address' => 'required|string|max:255',
            'website_or_social' => 'nullable|url|max:255',
            'address' => 'required|string|max:255',

            // Product Details
            'product_category' => 'required|string|max:255',
            'delivery_time' => 'required|string|max:255',
            'target_country' => 'required|string|max:255',

            // Documents
            'citizen_document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'passport_document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'visa_document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'resident_id_document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'registration_doc1' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'registration_doc2' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'registration_doc3' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'show_pic1' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'show_pic2' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'show_pic3' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',





            'terms_accepted' => 'required|accepted',
        ]);


        // if ($validator->fails()) {
        //     dd($validator->errors()->all());
        // }


        $validated = $validator->validated();


        // Handle file uploads
        $fileFields = [
            'citizen_document',
            'passport_document',
            'visa_document',
            'resident_id_document',
            'registration_doc1',
            'registration_doc2',
            'registration_doc3',
            'show_pic1',
            'show_pic2',
            'show_pic3'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('seller_documents', 'public');
                $validated[$field] = $path;
            } else {
                $validated[$field] = null; // Ensures all fields are present
            }
        }

        // Create the seller application
        $seller = BecomeSeller::create($validated);

        return redirect()->back()->with('success', 'Your application has been submitted successfully!');
    }

    public function index()
    {
        // Fetch only the necessary fields for listing
        $sellers = BecomeSeller::select('id', 'first_name', 'last_name', 'email', 'phone', 'status')->latest()->paginate(10);
        return view('backend.becomeseller.index', compact('sellers'));
    }

    public function show($id)
    {
        // Fetch all details for the seller
        $seller = BecomeSeller::findOrFail($id);
        return view('backend.becomeseller.show', compact('seller'));
    }

    public function destroy($id)
    {
        try {
            $seller = BecomeSeller::findOrFail($id);
            $seller->forceDelete();  // Permanently delete
            return redirect()->route('superadmin.becomeseller.index')->with('success', 'Seller application deleted successfully!');
        } catch (\Exception $e) {


            Log::error('Failed to delete seller application', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);


            return redirect()->back()->with('error', 'Failed to delete application.');
        }
    }



    //     public function destroy($id)
    // {
    //     $seller = BecomeSeller::find($id);
    //     if ($seller) {
    //         $seller->delete();
    //         return redirect()->route('superadmin.becomeseller.index')->with('success', 'Seller deleted successfully');
    //     }
    //     return redirect()->route('superadmin.becomeseller.index')->with('error', 'Seller not found');
    // }

}
