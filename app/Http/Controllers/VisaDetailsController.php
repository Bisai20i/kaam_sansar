<?php

namespace App\Http\Controllers;

use App\Models\VisaType;
use App\Models\VisaDetails;
use Illuminate\Http\Request;
use App\Models\VisaCountryList;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class VisaDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visaDetails = VisaDetails::with('visaType', 'visaCountry')->orderBy('created_at', 'desc')->simplepaginate(10);

        return view('backend.VisaHQ.visadetailslist', compact('visaDetails'));
    }


    // In your controller
    public function fetchVisaTypes(Request $request)
    {
        $query = $request->input('search');
        $visaTypes = VisaType::where('visaTypeName', 'like', '%' . $query . '%')->get();
        return response()->json($visaTypes);
    }

    public function fetchVisaCountries(Request $request)
    {
        $query = $request->input('search');
        $visaCountries = VisaCountryList::where('countryName', 'like', '%' . $query . '%')->get();
        return response()->json($visaCountries);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.VisaHQ.visadetailsCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $request->validate([
            'visaTypeId' => 'required|exists:visa_types,id',
            'visaCountryId' => 'required|exists:visa_country_lists,id',
            'description' => 'required|string',
            'demoVideoLink' => 'nullable|url',
            'demoVideoThumbnail' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:5120',
            'embassyFee' => 'required|numeric',
            'serviceFee' => 'required|numeric',
            'croppedThumbnailBase64' => 'nullable|string',
        ]);

        $thumbnailPath = null;

        // Handle Base64 Cropped Image
        if ($request->filled('croppedThumbnailBase64')) {
            $base64Image = $request->croppedThumbnailBase64;
            list($type, $imageData) = explode(';', $base64Image);
            list(, $imageData) = explode(',', $imageData);
            $imageData = base64_decode($imageData);

            // Define file path
            $fileName = 'demoVideoThumbnail' . time() . '.jpg';
            $filePath = 'VisaHQ/demoVideoThumbnail/' . $fileName;

            // Save the image
            Storage::disk('public')->put($filePath, $imageData);
            $thumbnailPath = $filePath;
        } elseif ($request->hasFile('demoVideoThumbnail')) {
            $file = $request->file('demoVideoThumbnail');

            // Process the image using Intervention
            $image = Image::make($file)->resize(800, 450)->encode('jpg', 90);
            $fileName = 'demoVideoThumbnail' . time() . '.jpg';
            $filePath = 'VisaHQ/demoVideoThumbnail/' . $fileName;

            // Save the image
            Storage::disk('public')->put($filePath, $image->stream());
            $thumbnailPath = $filePath;
        }

        // Store Visa Details
        VisaDetails::create([
            'visaTypeId' => $request->visaTypeId,
            'visaCountryId' => $request->visaCountryId,
            'description' => $request->description,
            'demoVideoLink' => $request->demoVideoLink,
            'demoVideoThumbnail' => $thumbnailPath,
            'embassyFee' => $request->embassyFee,
            'serviceFee' => $request->serviceFee,
        ]);

        return redirect()->route('visadetails.index')->with('success', 'Visa details created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'visaTypeId' => 'required|exists:visa_types,id',
            'visaCountryId' => 'required|exists:visa_country_lists,id',
            'description' => 'required|string',
            'demoVideoLink' => 'nullable|url',
            'demoVideoThumbnail' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:5120',
            'embassyFee' => 'required|numeric',
            'serviceFee' => 'required|numeric',
            'croppedThumbnailBase64' => 'nullable|string',
        ]);

        $visadetail = VisaDetails::findOrFail($id);
        $thumbnailPath = $visadetail->demoVideoThumbnail;

        // Delete old image if new one is provided
        if (($request->filled('croppedThumbnailBase64') || $request->hasFile('demoVideoThumbnail')) && Storage::disk('public')->exists($thumbnailPath)) {
            Storage::disk('public')->delete($thumbnailPath);
        }

        // Handle Base64 Cropped Image
        if ($request->filled('croppedThumbnailBase64')) {
            $base64Image = $request->croppedThumbnailBase64;
            list($type, $imageData) = explode(';', $base64Image);
            list(, $imageData) = explode(',', $imageData);
            $imageData = base64_decode($imageData);

            $fileName = 'demoVideoThumbnail' . time() . '.jpg';
            $filePath = 'VisaHQ/demoVideoThumbnail/' . $fileName;

            Storage::disk('public')->put($filePath, $imageData);
            $thumbnailPath = $filePath;
        } elseif ($request->hasFile('demoVideoThumbnail')) {
            $file = $request->file('demoVideoThumbnail');

            // Process the image using Intervention
            $image = Image::make($file)->resize(800, 450)->encode('jpg', 90);
            $fileName = 'demoVideoThumbnail' . time() . '.jpg';
            $filePath = 'VisaHQ/demoVideoThumbnail/' . $fileName;

            Storage::disk('public')->put($filePath, $image->stream());
            $thumbnailPath = $filePath;
        }

        // Update Visa Details
        $visadetail->update([
            'visaTypeId' => $request->visaTypeId,
            'visaCountryId' => $request->visaCountryId,
            'description' => $request->description,
            'demoVideoThumbnail' => $thumbnailPath,
            'demoVideoLink' => $request->demoVideoLink,
            'embassyFee' => $request->embassyFee,
            'serviceFee' => $request->serviceFee,
        ]);

        return redirect()->route('visadetails.index')->with('success', 'Visa details updated successfully.');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VisaDetails  $visaDetail
     * @return \Illuminate\Http\Response
     */
    public function show(VisaDetails $visaDetails) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisaDetails  $visaDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visaCountries = VisaCountryList::all();
        $visaTypes = VisaType::all();
        $visaDetails = VisaDetails::with('visaType', 'visaCountry')->find($id);


        return view('backend.VisaHQ.visadetailsCreate', compact('visaDetails', 'visaCountries', 'visaTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisaDetails  $visaDetails
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisaDetails  $visaDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visaDetails = VisaDetails::findOrFail($id);
        $thumbnailPath = $visaDetails->demoVideoThumbnail;

        if (Storage::disk('public')->exists($thumbnailPath)) {
            Storage::disk('public')->delete($thumbnailPath);
        }

        $visaDetails->delete();

        return redirect()->route('visadetails.index')->with('success', 'Visa details deleted successfully.');
    }

    public function publish($id)
    {
        $jobCategory = VisaDetails::find($id);
        $jobCategory->publishStatus = '1';
        $jobCategory->save();
        return redirect()->route('visadetails.index')->with('success', 'Visa details published successfully.');
    }

    public function unpublish($id)
    {
        $jobCategory = VisaDetails::find($id);
        $jobCategory->publishStatus = '0';
        $jobCategory->save();
        return redirect()->route('visadetails.index')->with('success', 'Visa details unpublished successfully.');
    }
}
