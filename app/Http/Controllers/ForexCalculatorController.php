<?php
namespace App\Http\Controllers;

use App\Models\ForexCalculator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForexCalculatorController extends Controller
{
    public function index(Request $request)
    {
        $base_currency = $request->query('base_currency');
        $date_of_validity = $request->query('date_of_validity');
        $forexRates = ForexCalculator::where('post_admin_id', Auth::guard('admin')->user()->id)
            ->when($base_currency, function ($query) use ($base_currency) {
                $query->where('base_currency', $base_currency);
            })
            ->when($date_of_validity, function ($query) use ($date_of_validity) {
                $query->where('date_of_validity', $date_of_validity);
            })
            ->simplePaginate(10);

        return view('backend.foreign_exchange.index', compact('forexRates'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $adminId = Auth::guard('admin')->user()->id;
        $request->validate([
            'rates' => 'required|json',
        ]);

        $forexRates   = json_decode($request->rates, true);
        $errorUpdates = [];
        foreach ($forexRates as $rate) {

            if (empty($rate['date_of_validity']) || empty($rate['base_currency']) || empty($rate['target_currency']) || empty($rate['buying_rate']) || empty($rate['selling_rate'])) {
                $errorUpdates[] = $rate;
            }

            if ($rate['date_of_validity'] < date('Y-m-d')) {
                $errorUpdates[] = $rate;
            }
            ForexCalculator::create([
                'post_admin_id'    => $adminId,
                'date_of_validity' => $rate['date_of_validity'],
                'base_currency'    => strtoupper($rate['base_currency']),
                'target_currency'  => strtoupper($rate['target_currency']),
                'buying_rate'      => $rate['buying_rate'],
                'selling_rate'     => $rate['selling_rate'],
            ]);
        }

        if (! empty($errorUpdates)) {
            return redirect()->back()->with('error', 'Forex records with missing records or past date used. ');
        }

        return redirect()->back()->with('success', 'Forex records added successfully.');
    }

    public function update(Request $request, ForexCalculator $forex)
    {
        try {
            $validated = $request->validate([
                'date_of_validity' => 'required|date|after_or_equal:today',
                'base_currency'    => 'required|string|size:3',
                'target_currency'  => 'required|string|size:3|different:base_currency',
                'buying_rate'      => 'required|numeric|min:0',
                'selling_rate'     => 'required|numeric|min:0',
            ]);

            $forex->update([
                'post_admin_id'    => Auth::guard('admin')->user()->id,
                'date_of_validity' => $validated['date_of_validity'],
                'base_currency'    => strtoupper($validated['base_currency']),
                'target_currency'  => strtoupper($validated['target_currency']),
                'buying_rate'      => $validated['buying_rate'],
                'selling_rate'     => $validated['selling_rate'],
            ]);

            return redirect()->back()->with('success', 'Forex record updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function destroy(ForexCalculator $forex)
    {
        $forex->delete();
        return redirect()->back()->with('success', 'Forex record deleted successfully.');
    }

}
