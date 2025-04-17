<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\MyDocument;
use Illuminate\Http\Request;
use App\Models\MyDocumentImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class MyDocumentController extends Controller
{


    public function documents($document_type){
        try{
            $isMobile = request()->has('request_type') && request()->input('request_type') === 'mobile';
            if(!in_array($document_type,['passport', 'citizenship', 'certificate', 'boarding_pass'])){
                return $isMobile? response()->json(['message'=>'Invalid Document type called!'])
                : redirect()->back()->with('error', 'Invalid Document type called!.');
            }
            
            
            $images = MyDocumentImage::withWhereHas('mydocument', function ($query) use ($document_type) {
                $query->where('document_type', $document_type)
                      ->where('jobSeekerId', Auth::user()->id);
            })->get(); 

            if($images){
                if ($isMobile) {
            
                    $formattedImages = $images->map(function ($image) {
                        // Extract original filename from stored name
                        $imageParts = explode('_', basename($image->image_path), 3);
                        $originalName = isset($imageParts[2]) ? $imageParts[2] : basename($image->image_path);
                
                        // Get file size dynamically from storage
                        $filePath = storage_path('app/public/' . str_replace('storage/', '', $image->image_path));
                        $fileSize = file_exists($filePath) ? filesize($filePath) : 0; // Handle missing files
                        return [
                            'id' => $image->id,
                            'url' => asset($image->image_path),
                            'original_name' => $originalName,
                            'size' => round( $fileSize / (1024 * 1024), 2),
                        ];
                    });
                    return response()->json(['message' => 'Successfully retrived images.', 'images' => $formattedImages], 201);
                } else {
                    return view('frontend.profile.documentPartials.jobseeker_document_dashboard',compact(['images', 'document_type']));
                }
            }
            
        }
        catch(Exception $e){
            dd($e);
            if ($isMobile) {
                return response()->json(['message' => 'Some Internal Error Occured.'], 501);
            } else {
                return redirect()->back()->with('error', 'Some Internal Error Occured.');
            }
        }
        
        // dd($images);

        // $passports = MyDocumentImage::withWhereHas('mydocument', function($query){
        //     $query->where('document_type', 'passport');
        // })->get();
        // dd($passports);
        // return view('frontend.profile.documentPartials.passport_upload',compact('images'));
    }



    public function upload(Request $request)
    {
        // dd ($request->all());
        $validator = Validator::make($request->all(), [
            'document_type' => 'required|in:passport,citizenship,certificate,boarding_pass',
            'images' => 'required|array',  
            // 'images.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $isMobile = request()->has('request_type') && request()->input('request_type') === 'mobile';
        $user = auth()->user(); // Checks if the user is authenticated
        Log::info('Authenticated Job Seeker : ' . $user->id);
        // $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        if ($validator->fails()) {
            
            if ($isMobile) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                return redirect()->back()->with('error', $validator->errors()->first());
            }
        }
        $jobSeekerId = $user->id;
        try{
            if(in_array($request->document_type, ['passport', 'citizenship', 'certificate', 'boarding_pass']) )
            {

                $document = MyDocument::firstOrCreate([
                    'jobSeekerId' => $jobSeekerId,
                    'document_type' => $request->document_type,
                ]);
                $uploadedImages = $request->file('images'); // Get all uploaded images
                if (!is_array($uploadedImages)) {
                    $uploadedImages = $uploadedImages ? [$uploadedImages] : []; // Convert single file to array or default to empty array
                }
                $imageDetails=[];
                foreach ($uploadedImages as $image) {
                    
                    $fileName = time() . '_' . rand() . '_' . $image->getClientOriginalName();

                    $filePath = $image->storeAs('public/uploads', $fileName);

                    // Convert the file path to public URL
                    $imagePath = str_replace('public/', 'storage/', $filePath);
                    $img = MyDocumentImage::create([
                        'mydocument_id' => $document->id,
                        'image_path' => $imagePath, // Store image path in database
                    ]);

                    $imageDetail['url'] =  asset($imagePath);
                    $imageDetail['size'] = round(filesize($image->getPathname()) /( 1024* 1024), 2);
                    $imageDetail['original_name'] = $image->getClientOriginalName();
                    $imageDetail['id'] = $img->id;
                    $imageDetails[] = $imageDetail;
                    
                }

                if ($isMobile) {
                    $document->images = $imageDetails;
                    return response()->json(['message' => 'Document uploaded successfully', 'documents' =>$document], 201);
                } else {
                    return redirect()->back()->with('success', 'Document uploaded successfully');
                }

            }else
            {
                if ($isMobile) {
                    return response()->json(['message' => 'Select a valid docuemnt type to proceed'], 400);
                } else {
                    return redirect()->back()->with('error', 'Select a valid docuemnt type to proceed');
                }
            }
            
    
            
        }
        catch(Exception $e){
            if ($isMobile) {
                return response()->json(['message' => $e->getMessage()], 400);
            } else {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        
        
    }

    // Delete a document
    public function destroy($id)
    {
        $isMobile = request()->has('request_type') && request()->input('request_type') === 'mobile';
        // dd($id);
        try{
            $jobSeekerId = Auth::user()->id;
            $image = MyDocumentImage::withWhereHas('mydocument',function($query) use ($jobSeekerId){
                $query->where('jobSeekerId',$jobSeekerId);
            })->where('id', $id)->first();

            if($image){
                
                $relative_path = str_replace('storage/', '', $image->image_path);
                if (Storage::disk('public')->exists($relative_path)) {
                    // Delete the file using Storage facade
                    Storage::disk('public')->delete($relative_path);
                    // dd("file deleted" . $relative_path); 
                } 
                // Storage::disk('public')->delete($image->image_path);
                $image->delete();
                            
                if ($isMobile) {
                    return response()->json(['message' => 'Successfully Deleted the requested image.'], 200);
                } else {
                    return redirect()->back()->with('success', 'Successfully Deleted the requested image.');
                }
            }else{
                
                if ($isMobile) {
                    return response()->json(['message' => 'Requested image not found'], 404);
                } else {
                    return redirect()->back()->with('error', 'Requested image not found');
                }
                
            }

        }
        catch(Exception $e){
            if ($isMobile) {
                return response()->json(['message' => 'An error occured while uploading document'], 500);
            } else {
                return redirect()->back()->with('error', 'An error occured while uploading document');
            }
        }
        
    }

}
