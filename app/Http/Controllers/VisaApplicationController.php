<?php

namespace App\Http\Controllers;

use App\Models\VisaApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VisaApplicationController extends Controller
{
    // public function saveApplication(Request $request)
    // {
    //     try {
    //         // Validate the request
    //         $validator = Validator::make($request->all(), [
    //             'job_seeker_id' => 'required|exists:job_seekers,id',
    //             'fullName' => 'required|string|max:255',
    //             'passportNumber' => 'required|string|max:255',
    //             'email' => 'required|email|max:255',
    //             'phone' => 'required|string|max:20',
    //             'country_code' => 'required|string|max:10',
    //             'visa_type_id' => 'required|exists:visa_types,id',
    //             'citizenship' => 'required|string|max:255',
    //             'date_of_entry' => 'required|date',
    //             'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    //         ]);

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'errors' => $validator->errors()
    //             ], 422);
    //         }

    //         // Process and store images
    //         $uploadedFiles = [];
    //         if ($request->hasFile('images')) {
    //             foreach ($request->file('images') as $image) {
    //                 $path = $image->store('visa_applications', 'public');
    //                 $uploadedFiles[] = $path;
    //             }
    //         }

    //         // Create visa application
    //         $application = VisaApplication::create([
    //             'jobSeekerId' => $request->job_seeker_id,
    //             'fullName' => $request->fullName,
    //             'passportNumber' => $request->passportNumber,
    //             'emailAddress' => $request->email,
    //             'phoneNumber' => $request->phone,
    //             'visaTypeId' => $request->visa_type_id,
    //             'citizenshipAsPassport' => $request->citizenship,
    //             'dateOfEntry' => $request->date_of_entry,
    //             'uploadedFiles' => json_encode($uploadedFiles),
    //         ]);

    //         // Store application ID in session for payment
    //         session(['visa_application_id' => $application->id]);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Your Application has been saved. Payment processing started',
    //             'application_id' => $application->id
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('Visa Application Error: ' . $e->getMessage());
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'An error occurred while processing your application'
    //         ], 500);
    //     }
    // }
    // public function cleanupApplication(Request $request)
    // {
    //     try {
    //         $applicationId = $request->application_id;
    //         $application = VisaApplication::find($applicationId);

    //         if ($application && $application->payment_status !== 'completed') {
    //             // Delete uploaded files
    //             $uploadedFiles = json_decode($application->uploadedFiles, true);
    //             foreach ($uploadedFiles as $file) {
    //                 Storage::disk('public')->delete($file);
    //             }

    //             // Delete the application
    //             $application->delete();
    //         }

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Cleanup completed'
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('Cleanup Error: ' . $e->getMessage());
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'An error occurred during cleanup'
    //         ], 500);
    //     }
    // }

    // public function processPayment(Request $request)
    // {
    //     try {
    //         $applicationId = session('visa_application_id');
    //         $application = VisaApplication::findOrFail($applicationId);

    //         // Add your payment gateway integration here
    //         // Example with eSewa:
    //         $paymentData = [
    //             'amt' => $request->amount,
    //             'psc' => 0,
    //             'pdc' => 0,
    //             'txAmt' => 0,
    //             'tAmt' => $request->amount,
    //             'pid' => 'VISA-' . $applicationId,
    //             'scd' => config('esewa.merchant_code'),
    //             'su' => route('payment.success'),
    //             'fu' => route('payment.failure')
    //         ];

    //         return response()->json([
    //             'success' => true,
    //             'payment_data' => $paymentData,

    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('Payment Processing Error: ' . $e->getMessage());
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Payment processing failed'
    //         ], 500);
    //     }
    // }

    


}
