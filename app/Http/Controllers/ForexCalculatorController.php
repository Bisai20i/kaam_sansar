<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForexCalculator;

class ForexCalculatorController extends Controller
{
public function index()
    {
        // $forexRates = ForexCalculator::latest()->paginate(10);
        return view('backend.foreign_exchange.index');
    }

    public function store(Request $request)
    {

        $adminId = Auth::guard('admins')->user()->id;
        $request->validate([
            'forex_rates' => 'required|json',
        ]);

        $forexRates = json_decode($request->forex_rates, true);

        foreach ($forexRates as $rate) {
            ForexCalculator::create([
                'country_name' => $rate['name'],
                'publish_status' => $rate['status'],
            ]);
        }

        return redirect()->back()->with('success', 'Forex records added successfully.');
    }

    public function update(Request $request, ForexCalculator $forex)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        $forex->update([
            'country_name' => $request->name,
            'publish_status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Forex record updated successfully.');
    }

    public function destroy(ForexCalculator $forex)
    {
        $forex->delete();
        return redirect()->back()->with('success', 'Forex record deleted successfully.');
    }

}
