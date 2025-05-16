<?php

namespace App\Http\Controllers;

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

        if (! $user) {
            if ($isMobile) {
                return $this->responseError('Unauthorized', 401);
            }
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $userId = $user->id;
        Log::info("Authenticated Job-Seeker ID: {$userId}");
        // 1) Validation rules for every column
        $rules = [
            // Application details
            'serviceType'       => 'required|string',
            'appCountry'        => 'required|string',
            'appProvince'       => 'required|string',
            'appDistrict'       => 'required|string',
            'appLocation'       => 'required|string',

            // Personal details
            'firstName'                 => 'required|string',
            'middleName'                => 'nullable|string',
            'lastName'                  => 'required|string',
            'phoneNo'                   => 'required|string|max:20',
            'email'                     => 'required|email|max:100',
            'emergencyContactPhone'     => 'required|string|max:20',
            'emergencyContactEmail'     => 'required|email|max:100',

            // Document references
            'citizenshipFront'   => 'required|file|mimes:jpg,jpeg,png,pdf',
            'citizenshipBack'    => 'required|file|mimes:jpg,jpeg,png,pdf',
            'previousPassport'   => 'required|file|mimes:jpg,jpeg,png,pdf',
            'otherDocument'      => 'nullable|file|mimes:jpg,jpeg,png,pdf',

            // Personal information
            'dateOfBirthAd'      => 'nullable|date',
            'dateOfBirthBs'      => 'nullable|string',
            'birthplace'         => 'nullable|string',
            'gender'             => 'nullable|string',
            'age'                => 'nullable|integer',
            'nationality'        => 'nullable|string',
            'religion'           => 'nullable|string',
            'birthCountry'       => 'nullable|string',
            'fatherName'         => 'nullable|string',
            'motherName'         => 'nullable|string',
            'marriedStatus'      => 'nullable|string',
            'spouseName'         => 'nullable|string',
            'numberOfChildren'   => 'nullable|integer',
            'spouseAge'          => 'nullable|integer',

            // Bank Details
            'bankAccount'                => 'nullable|string',
            'bankName'                   => 'nullable|string',
            'accountType'                => 'nullable|string',
            'bankBranch'                 => 'nullable|string',
            'bankNo'                     => 'nullable|string',
            'nationalIdentityNo'         => 'nullable|string',
            'citizenshipNumber'          => 'nullable|string',
            'dateOfIssue'                => 'nullable|date',
            'placeOfIssueDistrict'       => 'nullable|string',
            'placeOfIssueAbroad'         => 'nullable|string',
            'country'                    => 'nullable|string',
            'companyName'                => 'nullable|string',
            'currency'                   => 'nullable|string',
            'skill'                      => 'nullable|string',
            'salary'                     => 'nullable|string',
            'workType'                   => 'nullable|string',
            'food'                       => 'nullable|string',
            'accommodation'              => 'nullable|string',
            'dailyWorkHour'              => 'nullable|string',
            'weeklyWorkDay'              => 'nullable|string',
            'overTime'                   => 'nullable|string',
            'otherAllowance'             => 'nullable|string',
            'transportation'             => 'nullable|string',
            'healthInsurance'            => 'nullable|string',
            'visaNo'                     => 'nullable|string',
            'citizenshipDateOfIssue'     => 'nullable|date',
            'citizenshipPlaceOfIssueDistrict' => 'nullable|string',
            'citizenshipPlaceOfIssueAbroad'   => 'nullable|string',

            // Nominee details
            'nominee'            => 'nullable|string',
            'nomineeName'        => 'nullable|string',
            'nomineeRelation'    => 'nullable|string',
            'nomineeCountry'     => 'nullable|string',
            'nomineeProvince'    => 'nullable|string',
            'nomineeDistrict'    => 'nullable|string',
            'nomineeCity'        => 'nullable|string',
            'nomineeEmail'       => 'nullable|email',
            'nomineePhone'       => 'nullable|string',

            // Passport details
            'passportNumber'     => 'nullable|string',
            'passportType'       => 'nullable|string',
            'issueDate'          => 'nullable|date',
            'expiryDate'         => 'nullable|date',
            'placeOfIssue'       => 'nullable|string',
            'issuingAuthority'   => 'nullable|string',

            // Address details
            'contactCountry'     => 'nullable|string',
            'stateProvince'      => 'nullable|string',
            'district'           => 'nullable|string',
            'city'               => 'nullable|string',
            'province'           => 'nullable|string',
            'municipality'       => 'nullable|string',
            'wardNo'             => 'nullable|integer',
            'tole'               => 'nullable|string',
            'street'             => 'nullable|string',
            'houseNo'            => 'nullable|string',
            'sameAsPermanent'    => 'nullable|boolean',

            // Temporary address
            'tempCountry'        => 'nullable|string',
            'tempProvince'       => 'nullable|string',
            'tempDistrict'       => 'nullable|string',
            'tempMunicipality'   => 'nullable|string',
            'tempWardNo'         => 'nullable|integer',
            'tempCity'           => 'nullable|string',
            'tempTole'           => 'nullable|string',
            'tempStreet'         => 'nullable|string',
            'tempHouseNo'        => 'nullable|string',

            // Emergency contact details
            'emergencyContactFullName'     => 'nullable|string',
            'emergencyContactRelation'     => 'nullable|string',
            'emergencyContactCountry'      => 'nullable|string',
            'emergencyContactStateProvince' => 'nullable|string',
            'emergencyContactDistrict'     => 'nullable|string',
            'emergencyContactCity'         => 'nullable|string',

            // Photos (files)
            'passportPhoto'           => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'bankAccountPhoto'        => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'visaPhoto'               => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'chequePhoto'             => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'agreementPhoto'          => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'arrivalStampPhoto'       => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'embassyLetterPhoto'      => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'departureStampPhoto'     => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'oldLaborApprovalPhoto'   => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'otherDocumentsPhoto'     => 'nullable|file|mimes:jpg,jpeg,png,pdf',

            // Status
            'status'                  => 'nullable|in:pending,processing,approved,rejected',
            'checkCorrect'            => 'nullable|boolean',
            'checkTerms'
        ];
        // 2) Validate
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            Log::error('Validation errors:', $validator->errors()->toArray());
            if ($isMobile) {
                return $this->responseError('Validation failed.', 422, $validator->errors());
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }


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

        // 4) Merge data
        $data = array_merge(
            $validator->validated(),
            $fileUploads,
            ['jobSeekerId' => $userId]
        );

        // 5) Create record
        $permit = WorkPermit::create($data);
        Log::info("WorkPermit created: ID {$permit->id}");

        // 6) Response
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
    public function edit(WorkPermit $workPermit) {}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkPermit  $workPermit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkPermit $workPermit)
    {
        //
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
