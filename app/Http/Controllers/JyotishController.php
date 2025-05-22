<?php

namespace App\Http\Controllers;

use App\Models\Jyotish;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class JyotishController extends Controller
{
    public function index()
    {
        $jyotishs = Jyotish::paginate(10);
        return view('backend.jyotish.index', compact('jyotishs'));
    }

    // Show create form
    public function create()
    {
        return view('backend.jyotish.create');
    }

    // Store new jyotish
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:jyotishs,email',
            'photo' => 'nullable|image|max:2048', // max 2MB
        ]);

        $data = $request->only(['name', 'phone', 'email']);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('jyotish_photos', 'public');
            $data['photo'] = $path;
        }

        Jyotish::create($data);

        return redirect()->route('jyotishs.index')->with('success', 'Jyotish created successfully.');
    }

    // Show single jyotish details
    public function show(Jyotish $jyotish)
    {
        return view('backend.jyotish.show', compact('jyotish'));
    }

    // Show edit form
    public function edit(Jyotish $jyotish)
    {
        return view('backend.jyotish.edit', compact('jyotish'));
    }

    // Update jyotish
    public function update(Request $request, Jyotish $jyotish)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:jyotishs,email,' . $jyotish->id,
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'phone', 'email']);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($jyotish->photo && Storage::disk('public')->exists($jyotish->photo)) {
                Storage::disk('public')->delete($jyotish->photo);
            }
            $path = $request->file('photo')->store('jyotish_photos', 'public');
            $data['photo'] = $path;
        }

        $jyotish->update($data);

        return redirect()->route('jyotishs.index')->with('success', 'Jyotish updated successfully.');
    }


    //showjyotish
    public function showJyotishPage()
    {
        // Fetch all Jyotish (astrologers) from DB
        $jyotishs = Jyotish::all();

        // Pass to view
        return view('frontend.horoscope.horoscope', compact('jyotishs'));
    }


    // Delete jyotish
    public function destroy(Jyotish $jyotish)
    {
        if ($jyotish->photo && Storage::disk('public')->exists($jyotish->photo)) {
            Storage::disk('public')->delete($jyotish->photo);
        }

        $jyotish->delete();

        return redirect()->route('jyotishs.index')->with('success', 'Jyotish deleted successfully.');
    }
}
