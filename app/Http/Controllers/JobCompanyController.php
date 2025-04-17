<?php

namespace App\Http\Controllers;

use App\Models\JobCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class JobCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobCompanies = JobCompany::with('industryCategory')->orderBy('created_at', 'desc')->simplePaginate(10);

        return view('backend.JobCompany.lists', compact('jobCompanies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'backend.JobCompany.create',
            [
                'selectedIndustry' => old('industry'),
                'selectedIndustryId' => old('industry_id'),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // Validate the request
        $request->validate([
            'companyName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:job_companies,email',
            'industry_id' => 'required|integer|exists:industry_categories,id',
            'rating' => 'nullable|integer|min:1|max:5',
            'croppedImageBase64' => 'nullable|string', // Ensure Base64 image is provided
            'file' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'links' => 'nullable|string', // Validate the links field as a JSON string
            'companyDescription' => 'nullable|string',
            'phoneNumber' => 'required|string|max:255',
        ]);
        try {
            // Handle the links field
            $links = json_decode($request->input('links'), true); // Decode the JSON string into an array
            $link1 = $links[0] ?? null; // Assign the first link to link1
            $link2 = $links[1] ?? null; // Assign the second link to link2
            $link3 = $links[2] ?? null; // Assign the third link to link3

            $folderPath = 'company_images'; // Directory to store images in 'storage/app/public'
            $image_name = null;
            // Handle the image upload (Base64 or file)
            if ($request->filled('croppedImageBase64')) {
                $croppedImage = $request->input('croppedImageBase64'); // Get the base64 image
                $imageData = explode(',', $croppedImage)[1]; // Remove "data:image/png;base64," prefix
                $decodedImage = base64_decode($imageData);

                $image_name = time() . '_cropped.jpg'; // Define the image name
                Storage::disk('public')->put("$folderPath/$image_name", $decodedImage); // Store in the specified folder
            } elseif ($request->hasFile('file')) {
                $image = $request->file('file');
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $imagesized = Image::make($image);
                $imagesized->resize(1024, 1024, function ($constraint) {
                    $constraint->aspectRatio();
                });
                Storage::disk('public')->put("$folderPath/$image_name", $imagesized->encode('jpg', 90));
            }

            // Create a new JobCompany record
            $jobCompany = new JobCompany();
            $jobCompany->industryCategoryId = $request->input('industry_id'); // Map industry_id to industryCategoryId
            $jobCompany->companyName = $request->input('companyName');
            $jobCompany->email = $request->input('email');
            $jobCompany->link1 = $link1;
            $jobCompany->link2 = $link2;
            $jobCompany->link3 = $link3;
            $jobCompany->phoneNumber = $request->input('phoneNumber');
            $jobCompany->companyProfileImg = $image_name ? "$folderPath/$image_name" : null; // Save the file path in the database
            $jobCompany->reviewStatus = $request->input('rating', 0); // Default to 0 if rating is not provided
            $jobCompany->companyDescription = $request->input('companyDescription');
            $jobCompany->save();

            // Redirect or return a response
            return redirect()->route('jobCompany.index')->with('success', 'Job Company created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('jobCompany.index')->with('error', 'Job Company not created successfully!');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobCompany  $jobCompany
     * @return \Illuminate\Http\Response
     */
    public function show(JobCompany $jobCompany)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobCompany  $jobCompany
     * @return \Illuminate\Http\Response
     */
    public function edit(JobCompany $jobCompany)
    {


        $selectedIndustry = $jobCompany->industryCategory->industryName ?? '';
        $selectedIndustryId = $jobCompany->industry_id ?? '';
        $link1 = $jobCompany->link1 ?? '';
        $link2 = $jobCompany->link2 ?? '';
        $link3 = $jobCompany->link3 ?? '';

        $arrayLinks = [$link1, $link2, $link3];
        $links = json_encode($arrayLinks);

        // Pass the data to the view
        return view('backend.jobCompany.edit', compact('jobCompany', 'selectedIndustry', 'selectedIndustryId', 'links'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobCompany  $jobCompany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validate the request
        $request->validate([
            'companyName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:job_companies,email,' . $id,
            'phoneNumber' => 'required|string|max:255',
            'industry_id' => 'required|integer|exists:industry_categories,id',
            'rating' => 'nullable|integer|min:1|max:5',
            'croppedImageBase64' => 'nullable|string',
            'file' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'links' => 'nullable|json', // Ensure valid JSON
            'companyDescription' => 'nullable|string'
        ]);

        try {
            // Fetch existing JobCompany record
            $jobCompany = JobCompany::findOrFail($id);

            // Decode JSON Links
            $links = json_decode($request->input('links', '[]'), true);
            $jobCompany->link1 = $links[0] ?? null;
            $jobCompany->link2 = $links[1] ?? null;
            $jobCompany->link3 = $links[2] ?? null;

            // Handle image upload
            $folderPath = 'company_images';
            $oldImage = $jobCompany->companyProfileImg; // Keep existing image by default

            if ($request->has('croppedImageBase64') && str_contains($request->input('croppedImageBase64'), 'base64')) {
                //delete existing image
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }


                $croppedImage = explode(',', $request->input('croppedImageBase64'))[1] ?? null;
                if ($croppedImage) {
                    $image_name = time() . '_cropped.jpg';
                    Storage::disk('public')->put("$folderPath/$image_name", base64_decode($croppedImage));
                }
                $jobCompany->companyProfileImg = "$folderPath/$image_name" ?? null;
            } elseif ($request->hasFile('file')) {
                //delete existing image
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
                $image = $request->file('file');
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $imagesized = Image::make($image)->resize(1024, 1024, function ($constraint) {
                    $constraint->aspectRatio();
                });
                Storage::disk('public')->put("$folderPath/$image_name", $imagesized->encode('jpg', 90));
                $jobCompany->companyProfileImg = "$folderPath/$image_name" ?? null;
            } else {
                $image_name = $jobCompany->companyProfileImg;
            }

            // Update JobCompany record
            $jobCompany->industryCategoryId = $request->input('industry_id');
            $jobCompany->companyName = $request->input('companyName');
            $jobCompany->phoneNumber = $request->input('phoneNumber');
            $jobCompany->email = $request->input('email');
            $jobCompany->reviewStatus = $request->input('rating', $jobCompany->reviewStatus);
            $jobCompany->companyDescription = $request->input('companyDescription');
            $jobCompany->save();

            return redirect()->route('jobCompany.index')->with('success', 'Job Company updated successfully!');
        } catch (\Exception $e) {
            Log::error("Job Company Update Failed: " . $e->getMessage());
            return redirect()->route('jobCompany.index')->with('error', 'Job Company not updated!');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobCompany  $jobCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Find the JobCompany record by ID
            $jobCompany = JobCompany::findOrFail($id);
            // Delete the image if it exists
            if ($jobCompany->companyProfileImg && Storage::disk('public')->exists($jobCompany->companyProfileImg)) {
                Storage::disk('public')->delete($jobCompany->companyProfileImg);
            }

            // Delete the record
            $jobCompany->delete();

            return redirect()->route('jobCompany.index')->with('success', 'Job Company deleted successfully!');
        } catch (\Exception $e) {

            return redirect()->route('jobCompany.index')->with('error', $e->getMessage());
        }
    }


    public function delete_link(Request $request)
    {
        // Validate the request
        $request->validate([
            'link' => 'required',
            'jobId' => 'required|exists:job_companies,id',
        ]);

        // Extract link and job ID from the request
        $link = $request->input('link');
        $jobId = $request->input('jobId');

        try {
            // Find the JobCompany record by ID
            $jobCompany = JobCompany::findOrFail($jobId);

            // Determine which column contains the link
            if ($jobCompany->link1 === $link) {
                $jobCompany->link1 = null;
            } elseif ($jobCompany->link2 === $link) {
                $jobCompany->link2 = null;
            } elseif ($jobCompany->link3 === $link) {
                $jobCompany->link3 = null;
            } else {
                return response()->json(['success' => false, 'message' => 'Link not found in the record.'], 404);
            }

            // Save the updated record
            $jobCompany->save();

            return response()->json(['success' => true, 'message' => 'Link deleted successfully.']);
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error deleting link: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Failed to delete the link.'], 500);
        }
    }
}
