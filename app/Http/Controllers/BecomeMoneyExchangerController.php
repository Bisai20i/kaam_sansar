<?php
namespace App\Http\Controllers;

use App\Models\BecomeMoneyExchanger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BecomeMoneyExchangerController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Personal Info
            'first_name'           => 'required|string|max:255',
            'last_name'            => 'required|string|max:255',
            'email'                => 'nullable|email|max:255',
            'phone'                => 'required|string|max:255',
            'whatsapp_number'      => 'nullable|string|max:255',
            'country'              => 'required|string|max:255',

            // Bank Info
            'bank_name'            => 'required|string|max:255',
            'bank_holder_name'     => 'required|string|max:255',
            'bank_account_number'  => 'required|string|max:255',
            'iban_number'          => 'nullable|string|max:255',
            'swift_code'           => 'nullable|string|max:255',
            'bank_country'         => 'nullable|string|max:255',
            'branch_location'      => 'nullable|string|max:255',

            // Business Info
            'business_name'        => 'required|string|max:255',
            'business_telephone'   => 'required|string|max:255',
            'business_address'     => 'required|string|max:255',

            // Documents
            'citizen_document'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'passport_document'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'visa_document'        => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'resident_id_document' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'registration_doc1'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'registration_doc2'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'registration_doc3'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // Terms accepted
            'terms_accepted'       => 'required|accepted',
        ]);

        $validated = $validator->validated();

        $fileFields = [
            'citizen_document',
            'passport_document',
            'visa_document',
            'resident_id_document',
            'registration_doc1',
            'registration_doc2',
            'registration_doc3',
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $path              = $request->file($field)->store('moneyexchanger_documents', 'public');
                $validated[$field] = $path;
            } else {
                $validated[$field] = null;
            }
        }

        // terms_accepted is boolean but migration default is false, so store as boolean
        $validated['terms_accepted'] = true;

        BecomeMoneyExchanger::create($validated);

        return redirect()->back()->with('success', 'Money exchanger application submitted successfully!');
    }

    public function index()
    {
        $exchangers = BecomeMoneyExchanger::select(
            'id',
            'first_name',
            'last_name',
            'email',
            'phone',
            'status'
        )->latest()->paginate(10);

        return view('backend.moneyexchanger.index', compact('exchangers'));
    }

    public function show(BecomeMoneyExchanger $exchanger)
    {
        return view('backend.moneyexchanger.show', compact('exchanger'));
    }

    public function destroy(BecomeMoneyExchanger $exchanger)
    {
        try {
            $fileFields = [
                'citizen_document',
                'passport_document',
                'visa_document',
                'resident_id_document',
                'registration_doc1',
                'registration_doc2',
                'registration_doc3',
            ];

            foreach ($fileFields as $field) {
                if ($exchanger->$field && Storage::disk('public')->exists($exchanger->$field)) {
                    Storage::disk('public')->delete($exchanger->$field);
                }
            }

            $exchanger->forceDelete();

            return redirect()->route('superadmin.moneyexchangers.index')->with('success', 'Application deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to delete money exchanger application', [
                'error' => $e->getMessage(),
                'id'    => $exchanger->id,
            ]);
            return redirect()->back()->with('error', 'Failed to delete application.');
        }
    }

}
