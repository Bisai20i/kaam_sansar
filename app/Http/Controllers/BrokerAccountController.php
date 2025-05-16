<?php

namespace App\Http\Controllers;

use App\Models\BrokerAccount;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BrokerAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brokerAccounts = BrokerAccount::get();
        return view('backend.brokerAccount.index', compact('brokerAccounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.brokerAccount.create');
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
        $validator = Validator::make($request->all(), [
            'boid' => 'required|unique:broker_accounts',
            'referralCode' => 'nullable|string|max:255',
            'clientType' => 'required|in:individual,institutional,minor,foreign',
            'mobileNumber' => 'required|string|max:255',
            'branchName' => 'required|string|max:255',
            'panNumber' => 'nullable|string|max:255',
            'emailAddress' => 'required|email|max:255',
            'whatsappNumber' => 'nullable|string|max:255',
            'viberNumber' => 'nullable|string|max:255',
            'facebookLink' => 'nullable|string|max:255',
            'bankName' => 'required|string|max:255',
            'bankBranch' => 'required|string|max:255',
            'accountType' => 'required|in:saving,current,fixed',
            'accountNumber' => 'required|string|max:255',
            'investmentSource' => 'nullable|string|max:255',
            'companyName' => 'nullable|string|max:255',
            'jobBusinessYears' => 'nullable|integer',
            'investmentAmount' => 'nullable|numeric',
            'tradingKnowledge' => 'nullable|boolean',
            'permanentCountry' => 'required|string|max:255',
            'permanentProvince' => 'required|string|max:255',
            'permanentDistrict' => 'required|string|max:255',
            'permanentMunicipality' => 'required|string|max:255',
            'permanentWard' => 'required',
            'permanentCity' => 'required|string|max:255',
            'permanentTole' => 'required|string|max:255',
            'permanentStreet' => 'nullable|string|max:255',
            'permanentHouseNo' => 'nullable|string|max:255',
            
            'sameAsPermanent' => 'sometimes|boolean',
            'temporaryCountry' => 'required_if:sameAsPermanent,false|string|max:255',
            'temporaryProvince' => 'required_if:sameAsPermanent,false|string|max:255',
            'temporaryDistrict' => 'required_if:sameAsPermanent,false|string|max:255',
            'temporaryMunicipality' => 'required_if:sameAsPermanent,false|string|max:255',
            'temporaryCity' => 'required_if:sameAsPermanent,false|string|max:255',
            'temporaryWard' => 'required_if:sameAsPermanent,false|string|max:255',
            'temporaryStreet' => 'nullable|string|max:255',
            'temporaryState' => 'nullable|string|max:255',
            'temporaryTole' => 'required_if:sameAsPermanent,false|string|max:255',
            'temporaryHouseNo' => 'nullable|string|max:255',

            'kycForm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'citizenCertificate' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'birthCertificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'visaPassport' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'selfieWithId' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'guardianCitizenship' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ppSizePhoto' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'tradingAgreement' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'idCard' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            Log::error('Validation errors: ', $validator->errors()->toArray());
            return $isMobile
                ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
                : redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file uploads
        $fileUploads = handleMultipleUploads([
            'kycForm',
            'citizenCertificate',
            'birthCertificate',
            'visaPassport',
            'selfieWithId',
            'guardianCitizenship',
            'ppSizePhoto',
            'tradingAgreement',
            'idCard'
        ]);

        // Get validated data
        $validated = array_merge($validator->validated(), $fileUploads);
        $validated['jobSeekerId'] = $userId;

        if ($request->has('sameAsPermanent') && $request->boolean('sameAsPermanent')) {
            $validated['temporaryCountry'] = $validated['permanentCountry'];
            $validated['temporaryProvince'] = $validated['permanentProvince'];
            $validated['temporaryDistrict'] = $validated['permanentDistrict'];
            $validated['temporaryMunicipality'] = $validated['permanentMunicipality'];
            $validated['temporaryWard'] = $validated['permanentWard'];
            $validated['temporaryCity'] = $validated['permanentCity'];
            $validated['temporaryTole'] = $validated['permanentTole'];
            $validated['temporaryStreet'] = $validated['permanentStreet'];
            $validated['temporaryHouseNo'] = $validated['permanentHouseNo'];
        }

        // Save to database
        $brokerAccount = new BrokerAccount();
        $brokerAccount->fill($validated);
        $brokerAccount->save();

        Log::info('Broker account created successfully with ID: ' . $brokerAccount->id);

        return $isMobile
            ? $this->responseSuccess('Broker account saved successfully.', 200, $brokerAccount)
            : redirect()->back()->with('success', 'Broker account saved successfully.');
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
     * @param  \App\Models\BrokerAccount  $brokerAccount
     * @return \Illuminate\Http\Response
     */
    public function show(BrokerAccount $brokerAccount)
    {
        $pdf = Pdf::loadView('backend.brokerAccount.show', compact('brokerAccount'));
        return $pdf->download('Broker_Application_' . $brokerAccount->id . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BrokerAccount  $brokerAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(BrokerAccount $brokerAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BrokerAccount  $brokerAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BrokerAccount $brokerAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BrokerAccount  $brokerAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrokerAccount $brokerAccount)
    {
        $brokerAccount->delete();

        return redirect()->back()->with('success', 'Bank account deleted successfully.');
    }
     public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,In-progress,approved,rejected'
        ]);

        $permit = BrokerAccount::findOrFail($id);
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
