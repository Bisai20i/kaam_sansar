<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\FormSubmission;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\view;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bankAccount = BankAccount::get();
        return view('backend.bankAccount.index', compact('bankAccount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.bankAccount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Get the authenticated user
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        if (!$user) {
            return $isMobile
                ? $this->responseError('Unauthorized', 401)
                : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        Log::info('Authenticated User ID: ' . $user->id);
        $userId = $user->id;

        // Validate the request data
        $bankData = Validator::make($request->all(), [
            'applicantType' => 'required|string|max:255',
            'salutation' => 'required|string|max:255',
            'nepaleseCitizen' => 'required|boolean',
            'applicantPurpose' => 'required|string|max:255',
            'preferredBank' => 'required|string|max:255',
            'branch' => 'required|string|max:255',

            // Personal Details
            'firstName' => 'required|string|max:255',
            'middleName' => 'nullable|string|max:255',
            'lastName' => 'required|string|max:255',
            'mobileNumber' => 'required|string',
            'phoneNumber' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'nepaliDob' => 'required|string',
            'englishDob' => 'nullable|date',
            'applyFromCountry' => 'nullable|string|max:255',
            'contactMedium' => 'nullable|string|max:255',
            'otherContactDetail' => 'nullable|string|max:255',

            // Family Details (all required in schema)
            'fatherName' => 'required|string|max:255',
            'motherName' => 'required|string|max:255',
            'grandfatherName' => 'required|string|max:255',
            'spouse' => 'nullable|string|max:255',

            // Permanent Address (all non-nullable in schema)
            'permanentCountry' => 'required|string|max:255',
            'permanentProvince' => 'required|string|max:255',
            'permanentDistrict' => 'required|string|max:255',
            'permanentMunicipality' => 'required|string|max:255',
            'permanentCity' => 'required|string|max:255',
            'permanentWardNo' => 'required',
            'permanentStreet' => 'nullable|string|max:255',
            'permanentState' => 'nullable|string|max:255',
            'permanentTole' => 'required|string|max:255',
            'permanentHouseNo' => 'nullable|string|max:255',

            // Temporary Address (conditionally required)
            'sameAsPermanent' => 'sometimes|boolean',
            'temporaryCountry' => 'required_if:sameAsPermanent,false|string|max:255',
            'temporaryProvince' => 'required_if:sameAsPermanent,false|string|max:255',
            'temporaryDistrict' => 'required_if:sameAsPermanent,false|string|max:255',
            'temporaryMunicipality' => 'required_if:sameAsPermanent,false|string|max:255',
            'temporaryCity' => 'required_if:sameAsPermanent,false|string|max:255',
            'temporaryWardNo' => 'required_if:sameAsPermanent,false|max:255',
            'temporaryStreet' => 'nullable|string|max:255',
            'temporaryState' => 'nullable|string|max:255',
            'temporaryTole' => 'required_if:sameAsPermanent,false|string|max:255',
            'temporaryHouseNo' => 'nullable|string|max:255',

            // Job Details
            'jobTitle' => 'nullable|string|max:255',
            'jobCity' => 'nullable|string|max:255',
            'companyName' => 'nullable|string|max:255',
            'yearlySalary' => 'nullable|numeric|min:0',
            'monthlySalary' => 'nullable|numeric|min:0',

            // Documents (file uploads)
            'signature' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'fingerPrint' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        if ($bankData->fails()) {
            Log::error('Validation errors: ', $bankData->errors()->toArray());
            return $isMobile
                ? $this->responseError('Validation failed. Please check your inputs.', 422, $bankData->errors())
                : redirect()->back()->withErrors($bankData)->withInput();
        }
        $fileUploads = handleMultipleUploads(['signature', 'fingerPrint']);

        // Merge validated data with file paths
        $validated = array_merge($bankData->validated(), $fileUploads);
        $validated['jobSeekerId'] = $userId;

        // Save to database
        $bankAccount = new BankAccount();
        $bankAccount->fill($validated);
        $bankAccount->save();

        $formSubmission          = new FormSubmission();
        $formSubmission->title   = 'Bank Account';
        $formSubmission->form_id = $bankAccount->id;
        $formSubmission->job_seeker_id = $userId;
        $formSubmission->save();

        Log::info('Bank account created successfully with ID: ' . $bankAccount->id);

        return $isMobile
            ? $this->responseSuccess('Bank account saved successfully.', 200, $bankAccount)
            : redirect()->back()->with('success', 'Bank account saved successfully.');
    }

    // Helper methods for API responses
    protected function responseSuccess($message, $status = 200, $data = null)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    protected function responseError($message, $status = 400, $errors = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors
        ], $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function show(BankAccount $bankAccount)
    {
        $pdf = Pdf::loadView('backend.bankAccount.show', compact('bankAccount'));
        return $pdf->download('Bank_Application_' . $bankAccount->id . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =  Auth::guard('job_seekers')->user();
        $bankAccount = BankAccount::findOrFail($id);
        if ($user->id !==$bankAccount->jobSeekerId) {
            abort(403, 'Unauthorized action.');
        }
        return view('frontend.bankAccount.create', compact('bankAccount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        if (!$user) {
            return $isMobile
                ? $this->responseError('Unauthorized', 401)
                : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        $bankAccount = BankAccount::findOrFail($id);

        // Validate the request
        $bankData = Validator::make($request->all(), [
            'applicantType' => 'required|string|max:255',
            'salutation' => 'required|string|max:255',
            'nepaleseCitizen' => 'required|boolean',
            'applicantPurpose' => 'required|string|max:255',
            'preferredBank' => 'required|string|max:255',
            'branch' => 'required|string|max:255',

            // Personal Details
            'firstName' => 'required|string|max:255',
            'middleName' => 'nullable|string|max:255',
            'lastName' => 'required|string|max:255',
            'mobileNumber' => 'required|string',
            'phoneNumber' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'nepaliDob' => 'string|required',
            'englishDob' => 'nullable|date',
            'applyFromCountry' => 'nullable|string|max:255',
            'contactMedium' => 'nullable|string|max:255',
            'otherContactDetail' => 'nullable|string|max:255',

            // Family Details
            'fatherName' => 'required|string|max:255',
            'motherName' => 'required|string|max:255',
            'grandfatherName' => 'required|string|max:255',
            'spouse' => 'nullable|string|max:255',

            // Permanent Address
            'permanentCountry' => 'required|string|max:255',
            'permanentProvince' => 'required|string|max:255',
            'permanentDistrict' => 'required|string|max:255',
            'permanentMunicipality' => 'required|string|max:255',
            'permanentCity' => 'required|string|max:255',
            'permanentWardNo' => 'required',
            'permanentStreet' => 'nullable|string|max:255',
            'permanentState' => 'nullable|string|max:255',
            'permanentTole' => 'required|string|max:255',
            'permanentHouseNo' => 'nullable|string|max:255',

            // Temporary Address
            'sameAsPermanent' => 'sometimes|boolean',
            'temporaryCountry' => 'required_if:sameAsPermanent,false|string|max:255',
            'temporaryProvince' => 'required_if:sameAsPermanent,false|string|max:255',
            'temporaryDistrict' => 'required_if:sameAsPermanent,false|string|max:255',
            'temporaryMunicipality' => 'required_if:sameAsPermanent,false|string|max:255',
            'temporaryCity' => 'required_if:sameAsPermanent,false|max:255',
            'temporaryWardNo' => 'required_if:sameAsPermanent,false|max:255',
            'temporaryStreet' => 'nullable|string|max:255',
            'temporaryState' => 'nullable|string|max:255',
            'temporaryTole' => 'required_if:sameAsPermanent,false|string|max:255',
            'temporaryHouseNo' => 'nullable|string|max:255',

            // Job Details
            'jobTitle' => 'nullable|string|max:255',
            'jobCity' => 'nullable|string|max:255',
            'companyName' => 'nullable|string|max:255',
            'yearlySalary' => 'nullable|numeric|min:0',
            'monthlySalary' => 'nullable|numeric|min:0',

            // File Uploads (optional on update)
            'signature' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'fingerPrint' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($bankData->fails()) {
            Log::error('Validation errors on update: ', $bankData->errors()->toArray());
            return $isMobile
                ? $this->responseError('Validation failed. Please check your inputs.', 422, $bankData->errors())
                : redirect()->back()->withErrors($bankData)->withInput();
        }

        // Handle new uploads (only if provided)
        $fileUploads = handleMultipleUploads(['signature', 'fingerPrint'], $bankAccount);

        // Merge validated data and new uploads
        $validated = array_merge($bankData->validated(), $fileUploads);

        $validated['jobSeekerId'] = $user->id;

        // Update and save
        $bankAccount->update($validated);

        Log::info('Bank account updated successfully with ID: ' . $bankAccount->id);

        return $isMobile
            ? $this->responseSuccess('Bank account updated successfully.', 200, $bankAccount)
            : redirect()->route('jobseeker.forms')->with('success', 'Bank account updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankAccount $bankAccount)
    {

        $bankAccount->delete();

        return redirect()->back()->with('success', 'Bank account deleted successfully.');
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,In-progress,approved,rejected'
        ]);

        $permit = BankAccount::findOrFail($id);
        $permit->status = $request->status;
        $permit->save();

        $statusMessages = [
            'approved' => 'Bank Account approved successfully!',
            'rejected' => 'Bank Account rejected!',
            'In-progress' => 'Bank Account marked as In-progress!',
            'pending' => 'Bank Account status reset to pending!'
        ];

        return back()->with('success', $statusMessages[$request->status]);
    }
}
