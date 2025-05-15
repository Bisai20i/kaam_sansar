<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForexCalculator;

class ForexCalculatorController extends Controller
{
     public function store(Request $request)
    {
        $validated = $request->validate([
            'post_admin_id' => 'required|exists:admins,id',
            'date_of_validity' => 'required|date',
            'base_currency' => 'required|string|max:3',
            'target_currency' => 'required|string|max:3',
            'buying_rate' => 'required|numeric',
            'selling_rate' => 'required|numeric',
        ]);

        ForexCalculator::create($validated);

        return response()->json(['message' => 'Forex rate added successfully']);
    }

    // Update (Edit) an existing forex record
    public function update(Request $request, ForexCalculator $forexRate)
    {
        $validated = $request->validate([
            'post_admin_id' => 'required|exists:admins,id',
            'date_of_validity' => 'required|date',
            'base_currency' => 'required|string|max:3',
            'target_currency' => 'required|string|max:3',
            'buying_rate' => 'required|numeric',
            'selling_rate' => 'required|numeric',
        ]);

        $forexRate->update($validated);

        return response()->json(['message' => 'Forex rate updated successfully']);
    }

    // Delete a forex record
    public function destroy(ForexCalculator $forexRate)
    {
        $forexRate->delete();

        return response()->json(['message' => 'Forex rate deleted successfully']);
    }
}
