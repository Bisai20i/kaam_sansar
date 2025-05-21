<?php

namespace App\Http\Controllers;

use App\Models\DocumentationAttestation;
use App\Models\FormSubmission;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DocumentationAttestationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentAttestations = DocumentationAttestation::get();
        return view('backend.documentAttestations.index', compact('documentAttestations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.documentAttestations.create');
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

        // 1) Authenticate user
        $user = $isMobile
            ? $request->user()
            : Auth::guard('job_seekers')->user();

        if (! $user) {
            return $isMobile
                ? $this->responseError('Unauthorized', 401)
                : response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
        }

        $userId = $user->id;
        Log::info("Authenticated Job-Seeker ID: {$userId}");

        // 2) Validate
        $validator = Validator::make($request->all(), [
            'documentType'       => 'required|string|max:255',
            'subType'            => 'required|string|max:255',
            'applicantCountry'   => 'required|string|max:255',
            'attestationCountry' => 'required|string|max:255',
            'applicantName'      => 'required|string|max:255',
            'countryAttestation' => 'required|string|max:255',
            'purpose'            => 'required|string|max:255',
            'deliveryCountry'    => 'required|string|max:255',
            'deliveryCity'       => 'required|string|max:255',
            'deliveryStreet'     => 'required|string|max:255',
            'deliveryApartment'  => 'nullable|string|max:255',
            'deliveryLandmark'   => 'nullable|string|max:255',
            'primaryContact'     => 'required|string|max:20',
            'secondaryContact'   => 'nullable|string|max:20',
            'email'              => 'required|email|max:255',
            'workCountry'        => 'nullable|string|max:255',
            'workCity'           => 'nullable|string|max:255',
            'workStreet'         => 'nullable|string|max:255',
            'workApartment'      => 'nullable|string|max:255',
            'workLandmark'       => 'nullable|string|max:255',
            'identification'     => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
            'visa'               => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'citizenshipFront'   => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'citizenshipBack'    => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'passport'           => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'photo'              => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'document1'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'document2'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'document3'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'document4'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            Log::error('Validation errors:', $validator->errors()->toArray());
            return $isMobile
                ? $this->responseError('Validation failed.', 422, $validator->errors())
                : redirect()->back()->withErrors($validator)->withInput();
        }

        // 3) Handle file uploads
        $fileUploads = handleMultipleUploads([
            'identification',
            'visa',
            'citizenshipFront',
            'citizenshipBack',
            'passport',
            'photo',
            'document1',
            'document2',
            'document3',
            'document4',
        ]);

        // 4) Merge data for creation
        $data = array_merge(
            $validator->validated(),
            $fileUploads,
            [
                'jobSeekerId'   => $userId,
            ]
        );

        // 5) Create the record
        $attestation = DocumentationAttestation::create($data);

        $formSubmission          = new FormSubmission();
        $formSubmission->title   = 'Document Attestation';
        $formSubmission->form_id = $attestation->id;
        $formSubmission->job_seeker_id = $userId;
        $formSubmission->save();

        Log::info("DocumentationAttestation created: ID {$attestation->id}");

        // 6) Return response
        return $isMobile
            ? $this->responseSuccess('Attestation request submitted.', 200, $attestation)
            : redirect()->back()->with('success', 'Documente Attestation saved successfully.');
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentationAttestation  $documentationAttestation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $attestation = DocumentationAttestation::findOrFail($id);
        return view('backend.documentAttestations.show', compact('attestation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentationAttestation  $documentationAttestation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=Auth::guard('job_seekers')->user();
        $attestation = DocumentationAttestation::findOrFail($id);
        if($user->id !== $attestation->jobSeekerId)
        {
            abort(403,'unauthorized action');
        }
        return view('frontend.documentAttestations.edit', compact('attestation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocumentationAttestation  $documentationAttestation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        $user = $isMobile
            ? $request->user()
            : Auth::guard('job_seekers')->user();

        if (! $user) {
            return $isMobile
                ? $this->responseError('Unauthorized', 401)
                : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        $attestation = DocumentationAttestation::findOrFail($id);

        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'documentType'       => 'sometimes|required|string|max:255',
            'subType'            => 'sometimes|required|string|max:255',
            'applicantCountry'   => 'sometimes|required|string|max:255',
            'attestationCountry' => 'sometimes|required|string|max:255',
            'applicantName'      => 'sometimes|required|string|max:255',
            'countryAttestation' => 'sometimes|required|string|max:255',
            'purpose'            => 'sometimes|required|string|max:255',
            'deliveryCountry'    => 'sometimes|required|string|max:255',
            'deliveryCity'       => 'sometimes|required|string|max:255',
            'deliveryStreet'     => 'sometimes|required|string|max:255',
            'deliveryApartment'  => 'nullable|string|max:255',
            'deliveryLandmark'   => 'nullable|string|max:255',
            'primaryContact'     => 'sometimes|required|string|max:20',
            'secondaryContact'   => 'nullable|string|max:20',
            'email'              => 'sometimes|required|email|max:255',
            'workCountry'        => 'nullable|string|max:255',
            'workCity'           => 'nullable|string|max:255',
            'workStreet'         => 'nullable|string|max:255',
            'workApartment'      => 'nullable|string|max:255',
            'workLandmark'       => 'nullable|string|max:255',
            'identification'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'visa'               => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'citizenshipFront'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'citizenshipBack'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'passport'           => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'photo'              => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'document1'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'document2'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'document3'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'document4'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            Log::error('Validation errors on DocumentationAttestation update: ', $validator->errors()->toArray());

            return $isMobile
                ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
                : redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file uploads (deletion of old files occurs within helper)
        $fileUploads = handleMultipleUploads([
            'identification',
            'visa',
            'citizenshipFront',
            'citizenshipBack',
            'passport',
            'photo',
            'document1',
            'document2',
            'document3',
            'document4',
        ], $attestation);

        // Merge validated data and file paths
        $data = array_merge($validator->validated(), $fileUploads);
        $data['jobSeekerId'] = $user->id;

        // Update the model
        $attestation->update($data);
        Log::info('DocumentationAttestation updated successfully with ID: ' . $attestation->id);

        return $isMobile
            ? $this->responseSuccess('Attestation request updated.', 200, $attestation)
            : redirect()->route('jobseeker.forms')->with('success', 'Documentation updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentationAttestation  $documentationAttestation
     * @return \Illuminate\Http\Response
     */

    public function destroy(DocumentationAttestation $documentationAttestation)
    {
        $documentationAttestation->delete();

        return redirect()->back()->with('success', 'Bank account deleted successfully.');
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,In-progress,approved,rejected'
        ]);

        $permit = DocumentationAttestation::findOrFail($id);
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
