<?php
namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\PassportRenewal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PassportRenewalController extends Controller
{

    public function index(){
        $passportRenewals =  PassportRenewal::all();
        return view('backend.passport_renewal.index', compact('passportRenewals'));
    }

    public function partial()
    {
        return view('frontend.passport-renewal.partial_upload');
    }
    public function create()
    {
        return view('frontend.passport-renewal.index');
    }

    public function store_partial(Request $request)
    {

        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

        if (! $user) {
            return $isMobile ? response()->json(['error' => 'User not authenticated'], 401) : abort(401);
        }

        $jobSeekerId   = $user->id;
        $validatedData = $request->validate([
            'first_name'              => 'required|string|max:255',
            'middle_name'             => 'nullable|string|max:255',
            'last_name'               => 'required|string|max:255',
            'email'                   => 'required|email|max:255',
            'phone'                   => 'required|string|max:255',
            'emergency_contact_email' => 'required|email|max:255',
            'emergency_contact_phone' => 'required|string|max:255',
            'citizenship_front'       => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'citizenship_back'        => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'other_document'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'previous_passport'       => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $input     = $validatedData;
        $filePaths = [];

        foreach (['citizenship_front', 'citizenship_back', 'other_document', 'previous_passport'] as $field) {
            if ($request->hasFile($field)) {
                $filePaths[$field] = $request->file($field)->store('documents', 'public');
            }
        }

        $reneuwal = PassportRenewal::create(array_merge($input, $filePaths, ['job_seeker_id' => $jobSeekerId]));

        // return $reneuwal;

        return redirect()->back()->with('success', 'Passport renewal application submitted successfully!');

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // Personal Information
            'first_name'                     => 'required|string|max:255',
            'middle_name'                    => 'nullable|string|max:255',
            'last_name'                      => 'required|string|max:255',
            'date_of_birth_ad'               => 'required|date',
            'date_of_bs'                     => 'required|date',
            'birthplace'                     => 'required|string|max:255',
            'gender'                         => 'required|string|max:255',
            'age'                            => 'required|integer',
            'nationality'                    => 'required|string|max:255',
            'religion'                       => 'nullable|string|max:255',
            'birth_country'                  => 'required|string|max:255',
            'father_name'                    => 'required|string|max:255',
            'mother_name'                    => 'required|string|max:255',
            'marital_status'                 => 'required|string|max:255',
            'spouse_name'                    => 'nullable|string|max:255',
            'no_of_children'                 => 'nullable|integer',
            'spouse_age'                     => 'nullable|string|max:255',

            // Citizenship Information
            'national_identify_no'           => 'required|string|max:255',
            'citizenship_no'                 => 'required|string|max:255',
            'citizenship_issue_date'         => 'required|date',
            'citizenship_issue_place'        => 'required|string|max:255',
            'citizenship_issue_place_abroad' => 'nullable|string|max:255',

            // Current Passport Details
            'passport_no'                    => 'required|string|max:255',
            'passport_type'                  => 'required|string|max:255',
            'passport_issue_date'            => 'required|date',
            'passport_expiry_date'           => 'required|date',
            'passport_issue_place'           => 'required|string|max:255',
            'issuing_authority'              => 'required|string|max:255',

            // Contact Information
            'email'                          => 'required|email|max:255',
            'country'                        => 'required|string|max:255',
            'state'                          => 'required|string|max:255',
            'district'                       => 'required|string|max:255',
            'city'                           => 'required|string|max:255',
            'phone'                          => 'required|string|max:255',

            // Emergency Contact
            'emergency_contact_name'         => 'required|string|max:255',
            'emergency_contact_relation'     => 'required|string|max:255',
            'emergency_contact_country'      => 'required|string|max:255',
            'emergency_contact_state'        => 'required|string|max:255',
            'emergency_contact_district'     => 'required|string|max:255',
            'emergency_contact_city'         => 'required|string|max:255',
            'emergency_contact_email'        => 'required|email|max:255',
            'emergency_contact_phone'        => 'required|string|max:255',

            // Required Documents
            'citizenship_front'              => 'required|file|mimes:jpg,png,pdf|max:2048',
            'citizenship_back'               => 'required|file|mimes:jpg,png,pdf|max:2048',
            'academic_certificate'           => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'marriage_registration'          => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'divorce_certificate'            => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'national_eid'                   => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'other_document'                 => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'previous_passport'              => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        // Handle file uploads
        $fileFields = [
            'citizenship_front', 'citizenship_back', 'academic_certificate', 'marriage_registration',
            'divorce_certificate', 'national_eid', 'other_document', 'previous_passport',
        ];

        $filePaths = [];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $validatedData[$field] = $request->file($field)->store('documents', 'public');
            }
        }

        PassportRenewal::create(array_merge($validatedData, ['job_seeker_id' => $jobSeekerId]));

        return redirect()->route('frontend.passport-renewal.index')->with('success', 'Passport renewal application submitted successfully!');
    }

    public function edit($id)
    {
        $passportRenewal = PassportRenewal::findOrFail($id);
        return view('frontend.passport-renewal.index', compact('passportRenewal'));
    }

    public function update(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

        if (! $user) {
            return $isMobile ? response()->json(['error' => 'User not authenticated'], 401) : abort(401);
        }

        $validatedData = $request->validate([
            // Personal Information
            'first_name'                     => 'required|string|max:255',
            'middle_name'                    => 'nullable|string|max:255',
            'last_name'                      => 'required|string|max:255',
            'date_of_birth_ad'               => 'required|date',
            'date_of_bs'                     => 'required|date',
            'birthplace'                     => 'required|string|max:255',
            'gender'                         => 'required|string|max:255',
            'age'                            => 'required|integer',
            'nationality'                    => 'required|string|max:255',
            'religion'                       => 'nullable|string|max:255',
            'birth_country'                  => 'required|string|max:255',
            'father_name'                    => 'required|string|max:255',
            'mother_name'                    => 'required|string|max:255',
            'marital_status'                 => 'required|string|max:255',
            'spouse_name'                    => 'nullable|string|max:255',
            'no_of_children'                 => 'nullable|integer',
            'spouse_age'                     => 'nullable|string|max:255',

            // Citizenship Information
            'national_identify_no'           => 'required|string|max:255',
            'citizenship_no'                 => 'required|string|max:255',
            'citizenship_issue_date'         => 'required|date',
            'citizenship_issue_place'        => 'required|string|max:255',
            'citizenship_issue_place_abroad' => 'nullable|string|max:255',

            // Current Passport Details
            'passport_no'                    => 'required|string|max:255',
            'passport_type'                  => 'required|string|max:255',
            'passport_issue_date'            => 'required|date',
            'passport_expiry_date'           => 'required|date',
            'passport_issue_place'           => 'required|string|max:255',
            'issuing_authority'              => 'required|string|max:255',

            // Contact Information
            'email'                          => 'required|email|max:255',
            'country'                        => 'required|string|max:255',
            'state'                          => 'required|string|max:255',
            'district'                       => 'required|string|max:255',
            'city'                           => 'required|string|max:255',
            'phone'                          => 'required|string|max:255',

            // Emergency Contact
            'emergency_contact_name'         => 'required|string|max:255',
            'emergency_contact_relation'     => 'required|string|max:255',
            'emergency_contact_country'      => 'required|string|max:255',
            'emergency_contact_state'        => 'required|string|max:255',
            'emergency_contact_district'     => 'required|string|max:255',
            'emergency_contact_city'         => 'required|string|max:255',
            'emergency_contact_email'        => 'required|email|max:255',
            'emergency_contact_phone'        => 'required|string|max:255',

            // Required Documents
            'citizenship_front'              => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'citizenship_back'               => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'academic_certificate'           => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'marriage_registration'          => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'divorce_certificate'            => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'national_eid'                   => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'other_document'                 => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'previous_passport'              => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $passportRenewal = PassportRenewal::findOrFail($id);

        if (! $passportRenewal) {
            return $isMobile ? response()->json(['error' => 'Passport Renewal not found.'], 404) :
            redirect()->back()->with('error', 'Passport Renewal data not found.');
        }

        if ($passportRenewal->job_seeker_id != Auth::guard('job_seekers')->id()) {
            return $isMobile ? response()->json(['error' => 'Trying to Access others data.'], 401) :
            redirect()->back()->with('error', 'Trying to Access others data.');
        }

        // Handle file uploads and delete old files if replaced
        $fileFields = [
            'citizenship_front', 'citizenship_back', 'academic_certificate', 'marriage_registration',
            'divorce_certificate', 'national_eid', 'other_document', 'previous_passport',
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if ($passportRenewal->$field && Storage::disk('public')->exists($passportRenewal->$field)) {
                    Storage::disk('public')->delete($passportRenewal->$field);
                }

                // Store new file
                $validatedData[$field] = $request->file($field)->store('documents', 'public');
            }
        }

        $validatedData['job_seeker_id'] = Auth::guard('job_seekers')->id();

        $passportRenewal->update($validatedData);

        return redirect()->back()->with('success', 'Passport renewal application updated successfully.');

    }

    public function destroy($id)
    {
        $passportRenewal = PassportRenewal::findOrFail($id);

        // List all file fields to be deleted
        $fileFields = [
            'citizenship_front', 'citizenship_back', 'academic_certificate', 'marriage_registration',
            'divorce_certificate', 'national_eid', 'other_document', 'previous_passport',
        ];

        foreach ($fileFields as $field) {
            if ($passportRenewal->$field && Storage::disk('public')->exists($passportRenewal->$field)) {
                Storage::disk('public')->delete($passportRenewal->$field);
            }
        }

        $passportRenewal->delete();

        return redirect()->back()->with('success', 'Passport renewal record and associated files deleted.');
    }

}
