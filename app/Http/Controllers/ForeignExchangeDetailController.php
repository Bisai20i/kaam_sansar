<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForeignExchangeDetail;
use App\Models\ForexCalculator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ForeignExchangeDetailController extends Controller
{
    public function index(Request $request)
    {
        $amount = $request->query('amount') ?? 1;
        $base_currency = $request->query('base_currency');
        $forex_id = $request->query('forex_id');
        $type= $request->query('buy_or_sell')?? 'buy';
        $exchange_rate = ForexCalculator::where('id', $forex_id)->first();

        return view('frontend.ForexChanger.exchange-bank-detail', compact('amount', 'base_currency', 'exchange_rate', 'type'));
        // $details = ForeignExchangeDetail::latest()->paginate(10);
    }

    // public function create()
    // {
    //     return view('foreign_exchange_details.create');
    // }
    public function exchange_requests(){

        $requests = ForeignExchangeDetail::with('jobseeker:id,firstName,lastName,phoneNumber,emailAddress')
            ->withWhereHas('forex_calculator', function ($query) {
                $query->where('post_admin_id', Auth::guard('admin')->user()->id);
            })
            ->latest()
            ->simplePaginate(10);

        return view('backend.foreign_exchange.exchage_request', compact('requests'));

        // return $requests;
    }

    public function store(Request $request)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        $jobSeekerId = $isMobile ? $request->user()->id : Auth::guard('job_seekers')->user()->id;

        if(!$jobSeekerId) {
            return $isMobile
                ? response()->json(['error' => 'Unauthorized'], 401)
                : redirect()->back()->with('error', 'Unauthorized');
        }

        // return $request->all();

        try{
            $request->validate([
                'jobseeker_id' => 'required|exists:job_seekers,id',
                'forex_calculator_id' => 'required|exists:forex_calculators,id',
                'sender_bank_name' => 'required|string',
                'receiver_bank_name' => 'required|string',
                'transfer_amount' => 'required|numeric',
                'receiver_amount' => 'required|numeric',
                'base_currency' => 'required|string',
                'sender_account_number' => 'required|numeric',
                'receiver_account_number' => 'required|numeric',
                'buy_or_sell' => 'required|in:buy,sell',
                'remarks' => 'nullable|string',
            ]);


            ForeignExchangeDetail::create($request->all());
            Log::info('Foreign exchange detail created successfully.');
            return $isMobile
                ? response()->json([
                    'status' => true,
                    'message' => 'Foreign exchange detail created successfully.'
                    ])
                : redirect()->back()->with('success', 'Foreign exchange detail created successfully.');
        }
        catch(\Exception $e){
            Log::error('Error creating foreign exchange detail: ' . $e->getMessage());
            return $isMobile ? response()->json(['error' => $e->getMessage()], 400) : redirect()->back()->with('error', $e->getMessage());
        }
    } 



    // public function update(Request $request, ForeignExchangeDetail $foreignExchangeDetail)
    // {
    //     $request->validate([
    //         'jobseeker_id' => 'required|exists:job_seekers,id',
    //         'forex_calculator_id' => 'required|exists:currencies,id',
    //         'sender_bank_name' => 'required|string',
    //         'receiver_bank_name' => 'required|string',
    //         'transfer_amount' => 'required|integer',
    //         'receiver_amount' => 'required|integer',
    //         'base_currency' => 'required|string',
    //         'sender_account_number' => 'required|numeric',
    //         'receiver_account_number' => 'required|numeric',
    //         'remarks' => 'nullable|string',
    //     ]);

    //     $foreignExchangeDetail->update($request->all());

    //     return redirect()->route('foreign_exchange_details.index')->with('success', 'Foreign exchange detail updated successfully.');
    // }

    public function destroy(ForeignExchangeDetail $foreignExchangeDetail)
    {
        $foreignExchangeDetail->delete();
        return redirect()->back()->with('success', 'Foreign exchange detail deleted successfully.');
    }
}
