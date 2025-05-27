<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use App\Models\PassportCountryList;
use App\Models\PassportProvience;
use App\Models\WorkPermit;
use App\Models\WorkPermitDistrict;
use App\Models\WorkPermitLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class WorkPermitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workPermits = WorkPermit::all();
        return view('backend.workPermit.index', compact('workPermits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nepal = PassportCountryList::where('countryName', 'Nepal')->firstOrFail();

        $provinces = PassportProvience::where('country_id', $nepal->id)
            ->where('publishStatus', true)
            ->get();

        // Load districts with their province relationship
        $districts = WorkPermitDistrict::with('province')
            ->whereIn('provience_id', $provinces->pluck('id'))
            ->get()
            ->map(function ($district) {
                return [
                    'id' => $district->id,
                    'districtName' => $district->districtName,
                    'provience_id' => $district->provience_id,
                    'provienceName' => $district->province->provienceName // Add province name
                ];
            });

        // Load locations with their district relationship
        $locations = WorkPermitLocation::with('district')
            ->whereIn('district_id', $districts->pluck('id'))
            ->get()
            ->map(function ($location) {
                return [
                    'id' => $location->id,
                    'locationName' => $location->locationName,
                    'district_id' => $location->district_id,
                    'districtName' => $location->district->districtName // Add district name
                ];
            });

        return view('frontend.workPermit.create', compact(
            'nepal',
            'provinces',
            'districts',
            'locations'
        ));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $isMobile = $request->input('request_type') === 'mobile';
        $user = $isMobile
            ? $request->user()
            : Auth::guard('job_seekers')->user();

        if (!$user) {
            if ($isMobile) {
                return $this->responseError('Unauthorized', 401);
            }
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $userId = $user->id;
        Log::info("Authenticated Job-Seeker ID: {$userId}");

        // Validation rules
        $rules = [
            // Application details (matches migration)
            'serviceType' => 'required|string|max:255',
            'appCountry' => 'required|string|max:255',
            'appProvince' => 'required|string|max:255',
            'appDistrict' => 'required|string|max:255',
            'appLocation' => 'required|string|max:255',

            // Personal details (aligned with migration)
            'firstName' => 'required|string|max:255',
            'middleName' => 'nullable|string|max:255',
            'lastName' => 'required|string|max:255',
            'dateOfBirthAd' => 'nullable|date',
            'dateOfBirthBs' => 'nullable|date|max:255',
            'birthplace' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'age' => 'nullable|integer',
            'nationality' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255',
            'birthCountry' => 'nullable|string|max:255',
            'fatherName' => 'nullable|string|max:255',
            'motherName' => 'nullable|string|max:255',
            'marriedStatus' => 'nullable|string|max:255',
            'spouseName' => 'nullable|string|max:255',
            'numberOfChildren' => 'nullable|integer',
            'spouseAge' => 'nullable|integer',

            // Bank Details (nullable as per migration)
            'bankAccount' => 'nullable|string|max:255',
            'bankName' => 'nullable|string|max:255',
            'accountType' => 'nullable|string|max:255',
            'bankBranch' => 'nullable|string|max:255',
            'bankNo' => 'nullable|string|max:255',

            // Citizenship Information
            'nationalIdentityNo' => 'nullable|string|max:255',
            'citizenshipNumber' => 'nullable|string|max:255',
            'dateOfIssue' => 'nullable|date',
            'placeOfIssueDistrict' => 'nullable|string|max:255',
            'placeOfIssueAbroad' => 'nullable|string|max:255',

            // Company Info
            'country' => 'nullable|string|max:255',
            'companyName' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:255',

            // Facility Details
            'skill' => 'nullable|string|max:255',
            'salary' => 'nullable|string|max:255',
            'workType' => 'nullable|string|max:255',
            'food' => 'nullable|string|max:255',
            'accommodation' => 'nullable|string|max:255',
            'dailyWorkHour' => 'nullable|string|max:255',
            'weeklyWorkDay' => 'nullable|string|max:255',
            'overTime' => 'nullable|string|max:255',
            'otherAllowance' => 'nullable|string|max:255',
            'transportation' => 'nullable|string|max:255', // Note: Typo in migration ('transportation' vs 'transportation')
            'healthInsurance' => 'nullable|string|max:255',

            // VisaInfo
            'visaNo' => 'nullable|string|max:255',
            'citizenshipDateOfIssue' => 'nullable|date',
            'citizenshipPlaceOfIssueDistrict' => 'nullable|string|max:255',
            'citizenshipPlaceOfIssueAbroad' => 'nullable|string|max:255',

            // Nominee details
            'nominee' => 'nullable|string|max:255',
            'nomineeName' => 'nullable|string|max:255',
            'nomineeRelation' => 'nullable|string|max:255',
            'nomineeCountry' => 'nullable|string|max:255',
            'nomineeProvince' => 'nullable|string|max:255',
            'nomineeDistrict' => 'nullable|string|max:255',
            'nomineeCity' => 'nullable|string|max:255',
            'nomineeEmail' => 'nullable|email|max:255',
            'nomineePhone' => 'nullable|string|max:20',

            // Passport details
            'passportNumber' => 'nullable|string|max:255',
            'passportType' => 'nullable|string|max:255',
            'issueDate' => 'nullable|date',
            'expiryDate' => 'nullable|date',
            'placeOfIssue' => 'nullable|string|max:255',
            'issuingAuthority' => 'nullable|string|max:255',

            // Contact information (from migration)
            'contCountry' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'contdistrict' => 'required|string|max:255',
            'contCity' => 'required|string|max:255',
            'phoneNo' => 'required|string|max:20',
            'email' => 'required|email|max:100',



            // Address details (fixed field names to match migration)
            'contactCountry' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'municipality' => 'nullable|string|max:255',
            'wardNo' => 'nullable|integer',
            'tole' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'houseNo' => 'nullable|string|max:255',
            'sameAsPermanent' => 'nullable|boolean',

            // Temporary address
            'tempCountry' => 'nullable|string|max:255',
            'tempProvince' => 'nullable|string|max:255',
            'tempDistrict' => 'nullable|string|max:255',
            'tempMunicipality' => 'nullable|string|max:255',
            'tempWardNo' => 'nullable|integer',
            'tempCity' => 'nullable|string|max:255',
            'tempTole' => 'nullable|string|max:255',
            'tempStreet' => 'nullable|string|max:255',
            'tempHouseNo' => 'nullable|string|max:255',

            // Emergency contact details
            'emergencyContactFullName' => 'nullable|string|max:255',
            'emergencyContactRelation' => 'nullable|string|max:255',
            'emergencyContactCountry' => 'nullable|string|max:255',
            'emergencyContactStateProvince' => 'nullable|string|max:255',
            'emergencyContactDistrict' => 'nullable|string|max:255',
            'emergencyContactCity' => 'nullable|string|max:255',
            'emergencyContactPhone' => 'required|string|max:20',
            'emergencyContactEmail' => 'required|email|max:100',

            // Document uploads (added max file size)
            'passportPhoto' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'bankAccountPhoto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'visaPhoto' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'chequePhoto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'agreementPhoto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'arrivalStampPhoto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'embassyLetterPhoto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'departureStampPhoto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'oldLaborApprovalPhoto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'otherDocumentsPhoto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // Status (matches migration enum)
            'status' => 'nullable|in:pending,In-progress,approved,rejected',
            'payment' => 'nullable|in:unpaid,paid',
            'checkCorrect' => 'nullable',
            'checkTerms' => 'nullable|' // Changed to required and accepted
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::error('Validation errors:', $validator->errors()->toArray());
            if ($isMobile) {
                return $this->responseError('Validation failed.', 422, $validator->errors());
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // File upload handling (keep your existing implementation)
        $fileUploads = handleMultipleUploads([
            'passportPhoto',
            'bankAccountPhoto',
            'visaPhoto',
            'chequePhoto',
            'agreementPhoto',
            'arrivalStampPhoto',
            'embassyLetterPhoto',
            'departureStampPhoto',
            'oldLaborApprovalPhoto',
            'otherDocumentsPhoto',
            'citizenshipFront',
            'citizenshipBack',
            'previousPassport',
            'otherDocument'
        ]);

        $data = array_merge(
            $validator->validated(),
            $fileUploads,
            ['jobSeekerId' => $userId]
        );

        $permit = WorkPermit::create($data);

        $formSubmission = new FormSubmission();
        $formSubmission->title = 'Work Permit';
        $formSubmission->form_id = $permit->id;
        $formSubmission->job_seeker_id = $userId;
        $formSubmission->save();

        Log::info("WorkPermit created: ID {$permit->id}");

        if ($isMobile) {
            return $this->responseSuccess('Work permit submitted.', 200, $permit);
        }
        return redirect()->back()->with('success', 'Application submitted successfully.');
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkPermit  $workPermit
     * @return \Illuminate\Http\Response
     */
    public function show(WorkPermit $workPermit)
    {
        return view('backend.workPermit.show', compact('workPermit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkPermit  $workPermit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::guard('job_seekers')->user();
        $workPermit = WorkPermit::findOrFail($id);

        if ($workPermit->jobSeekerId !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $nepal = PassportCountryList::where('countryName', 'Nepal')->firstOrFail();

        $provinces = PassportProvience::where('country_id', $nepal->id)
            ->where('publishStatus', true)
            ->get();

        // Load districts with their province relationship
        $districts = WorkPermitDistrict::with('province')
            ->whereIn('provience_id', $provinces->pluck('id'))
            ->get()
            ->map(function ($district) {
                return [
                    'id' => $district->id,
                    'districtName' => $district->districtName,
                    'provience_id' => $district->provience_id,
                    'provienceName' => $district->province->provienceName // Add province name
                ];
            });
        $locations = WorkPermitLocation::with('district')
            ->whereIn('district_id', $districts->pluck('id'))
            ->get()
            ->map(function ($location) {
                return [
                    'id' => $location->id,
                    'locationName' => $location->locationName,
                    'district_id' => $location->district_id,
                    'districtName' => $location->district->districtName // Add district name
                ];
            });
        return view('frontend.workPermit.edit', compact(
            'workPermit',
            'nepal',
            'provinces',
            'districts',
            'locations'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkPermit  $workPermit
     * @return \Illuminate\Http\Response
     */
    /**
     * Update an existing WorkPermit.
     */
    public function update(Request $request, $id)
    {
        $isMobile = $request->input('request_type') === 'mobile';
        $user = $isMobile
            ? $request->user()
            : Auth::guard('job_seekers')->user();

        if (! $user) {
            if ($isMobile) {
                return $this->responseError('Unauthorized', 401);
            }
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        // Locate the permit, ensure it belongs to this job‐seeker
        $permit = WorkPermit::where('id', $id)
            ->where('jobSeekerId', $user->id)
            ->first();

        if ($permit->status != "pending") {
            return redirect()->back()->with('warning', 'You are not  accessible to edit Document Attestation Form');
        }

        if (! $permit) {
            if ($isMobile) {
                return $this->responseError('Not found', 404);
            }
            return redirect()->back()->withErrors(['message' => 'Record not found.']);
        }

        // **Full validation rules per your migration columns**
        $rules = [
            // Application details
            'serviceType'    => 'required|string|max:255',
            'appCountry'     => 'required|string|max:255',
            'appProvince'    => 'required|string|max:255',
            'appDistrict'    => 'required|string|max:255',
            'appLocation'    => 'required|string|max:255',

            // Personal details
            'firstName'            => 'required|string|max:255',
            'middleName'           => 'nullable|string|max:255',
            'lastName'             => 'required|string|max:255',
            'dateOfBirthAd'        => 'nullable|date',
            'dateOfBirthBs'        => 'nullable|string|max:255',
            'birthplace'           => 'nullable|string|max:255',
            'gender'               => 'nullable|string|max:255',
            'age'                  => 'nullable|integer',
            'nationality'          => 'nullable|string|max:255',
            'religion'             => 'nullable|string|max:255',
            'birthCountry'         => 'nullable|string|max:255',
            'fatherName'           => 'nullable|string|max:255',
            'motherName'           => 'nullable|string|max:255',
            'marriedStatus'        => 'nullable|string|max:255',
            'spouseName'           => 'nullable|string|max:255',
            'numberOfChildren'     => 'nullable|integer',
            'spouseAge'            => 'nullable|integer',

            // Bank details
            'bankAccount'   => 'nullable|string|max:255',
            'bankName'      => 'nullable|string|max:255',
            'accountType'   => 'nullable|string|max:255',
            'bankBranch'    => 'nullable|string|max:255',
            'bankNo'        => 'nullable|string|max:255',

            // Citizenship Info
            'nationalIdentityNo'         => 'nullable|string|max:255',
            'citizenshipNumber'          => 'nullable|string|max:255',
            'dateOfIssue'                => 'nullable|date',
            'placeOfIssueDistrict'       => 'nullable|string|max:255',
            'placeOfIssueAbroad'         => 'nullable|string|max:255',

            // Company Info
            'country'         => 'nullable|string|max:255',
            'companyName'     => 'nullable|string|max:255',
            'currency'        => 'nullable|string|max:255',

            // Facility Details
            'skill'              => 'nullable|string|max:255',
            'salary'             => 'nullable|string|max:255',
            'workType'           => 'nullable|string|max:255',
            'food'               => 'nullable|string|max:255',
            'accommodation'      => 'nullable|string|max:255',
            'dailyWorkHour'      => 'nullable|string|max:255',
            'weeklyWorkDay'      => 'nullable|string|max:255',
            'overTime'           => 'nullable|string|max:255',
            'otherAllowance'     => 'nullable|string|max:255',
            'transportation'     => 'nullable|string|max:255',
            'healthInsurance'    => 'nullable|string|max:255',

            // Visa Info
            'visaNo'                             => 'nullable|string|max:255',
            'citizenshipDateOfIssue'             => 'nullable|date',
            'citizenshipPlaceOfIssueDistrict'    => 'nullable|string|max:255',
            'citizenshipPlaceOfIssueAbroad'      => 'nullable|string|max:255',

            // Nominee details
            'nominee'            => 'nullable|string|max:255',
            'nomineeName'        => 'nullable|string|max:255',
            'nomineeRelation'    => 'nullable|string|max:255',
            'nomineeCountry'     => 'nullable|string|max:255',
            'nomineeProvince'    => 'nullable|string|max:255',
            'nomineeDistrict'    => 'nullable|string|max:255',
            'nomineeCity'        => 'nullable|string|max:255',
            'nomineeEmail'       => 'nullable|email|max:255',
            'nomineePhone'       => 'nullable|string|max:20',

            // Passport details
            'passportNumber'     => 'nullable|string|max:255',
            'passportType'       => 'nullable|string|max:255',
            'issueDate'          => 'nullable|date',
            'expiryDate'         => 'nullable|date',
            'placeOfIssue'       => 'nullable|string|max:255',
            'issuingAuthority'   => 'nullable|string|max:255',

            // **Contact information (required per migration)**
            'contCountry'        => 'required|string|max:255',
            'state'              => 'required|string|max:255',
            'contdistrict'       => 'required|string|max:255',
            'contCity'           => 'required|string|max:255',
            'phoneNo'            => 'required|string|max:20',
            'email'              => 'required|email|max:100',

            // Address details
            'contactCountry'  => 'nullable|string|max:255',
            'district'        => 'nullable|string|max:255',
            'city'            => 'nullable|string|max:255',
            'province'        => 'nullable|string|max:255',
            'municipality'    => 'nullable|string|max:255',
            'wardNo'          => 'nullable|integer',
            'tole'            => 'nullable|string|max:255',
            'street'          => 'nullable|string|max:255',
            'houseNo'         => 'nullable|string|max:255',
            'sameAsPermanent' => 'nullable|boolean',

            // Temporary address
            'tempCountry'      => 'nullable|string|max:255',
            'tempProvince'     => 'nullable|string|max:255',
            'tempDistrict'     => 'nullable|string|max:255',
            'tempMunicipality' => 'nullable|string|max:255',
            'tempWardNo'       => 'nullable|integer',
            'tempCity'         => 'nullable|string|max:255',
            'tempTole'         => 'nullable|string|max:255',
            'tempStreet'       => 'nullable|string|max:255',
            'tempHouseNo'      => 'nullable|string|max:255',

            // Emergency contact
            'emergencyContactFullName'      => 'nullable|string|max:255',
            'emergencyContactRelation'      => 'nullable|string|max:255',
            'emergencyContactCountry'       => 'nullable|string|max:255',
            'emergencyContactStateProvince' => 'nullable|string|max:255',
            'emergencyContactDistrict'      => 'nullable|string|max:255',
            'emergencyContactCity'          => 'nullable|string|max:255',
            'emergencyContactPhone'         => 'required|string|max:20',
            'emergencyContactEmail'         => 'required|email|max:100',

            // Document uploads (nullable to only overwrite when new file is provided)
            'passportPhoto'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'bankAccountPhoto'       => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'visaPhoto'              => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'chequePhoto'            => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'agreementPhoto'         => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'arrivalStampPhoto'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'embassyLetterPhoto'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'departureStampPhoto'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'oldLaborApprovalPhoto'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'otherDocumentsPhoto'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // Status & flags
            'status'      => 'nullable|in:pending,In-progress,approved,rejected',
            'payment'     => 'nullable|in:unpaid,paid',
            'checkCorrect' => 'nullable',
            'checkTerms'  => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::error('Validation errors (update):', $validator->errors()->toArray());
            if ($isMobile) {
                return $this->responseError('Validation failed.', 422, $validator->errors());
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle uploads (your existing helper)
        $fileUploads = handleMultipleUploads([
            'passportPhoto',
            'bankAccountPhoto',
            'visaPhoto',
            'chequePhoto',
            'agreementPhoto',
            'arrivalStampPhoto',
            'embassyLetterPhoto',
            'departureStampPhoto',
            'oldLaborApprovalPhoto',
            'otherDocumentsPhoto',
        ]);

        // Merge validated data + any new file paths
        $data = array_merge(
            $validator->validated(),
            $fileUploads
        );

        $permit->update($data);
        Log::info("WorkPermit updated: ID {$permit->id} by user {$user->id}");

        if ($isMobile) {
            return $this->responseSuccess('Work permit updated.', 200, $permit);
        }
        return redirect()->back()->with('success', 'Application updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkPermit  $workPermit
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkPermit $workPermit)
    {
        try {
            $workPermit->delete();
            return redirect()->back()->with('success', 'Work Permit deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Work Permit.');
        }
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,In-progress,approved,rejected'
        ]);

        $permit = WorkPermit::findOrFail($id);
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
