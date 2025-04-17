<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdsManager;
use Illuminate\Support\Facades\Storage;

class AdsManagerController extends Controller
{
    public function index()
    {
        $ads = AdsManager::all();
        return view('backend.ads_manager.index', compact('ads'));
    }

    public function create()
    {
        return view('backend.ads_manager.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'which_page' => 'required|string|max:255',
            'position' => 'required|in:left,right,top,bottom,middle',
            'publish_or_not' => 'required|boolean',
            'active' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $ad = new AdsManager($request->except('image'));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('ads', 'public');
            $ad->image = $path;
        }

        $ad->save();

        return redirect()->route('ads-manager.index')->with('success', 'Ad created successfully!');
    }

    public function edit(AdsManager $adsManager)
    {
        return view('backend.ads_manager.edit', compact('adsManager'));
    }

    public function update(Request $request, AdsManager $adsManager)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'which_page' => 'required|string|max:255',
            'position' => 'required|in:left,right,top,bottom,middle',
            'publish_or_not' => 'required|boolean',
            'active' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $adsManager->fill($request->except('image'));

        if ($request->hasFile('image')) {
            if ($adsManager->image) {
                Storage::disk('public')->delete($adsManager->image);
            }
            $path = $request->file('image')->store('ads', 'public');
            $adsManager->image = $path;
        }

        $adsManager->save();

        return redirect()->route('ads-manager.index')->with('success', 'Ad updated successfully!');
    }

    public function destroy(AdsManager $adsManager)
    {
        if ($adsManager->image) {
            Storage::disk('public')->delete($adsManager->image);
        }

        $adsManager->delete();

        return redirect()->route('ads-manager.index')->with('success', 'Ad deleted successfully!');
    }

    // API for Mobile App
    public function getAdsByPage(Request $request, $page)
    {
        $ads = AdsManager::where('which_page', $page)
            ->where('publish_or_not', 1)
            ->where('active', 1)
            ->get();

        return response()->json($ads);
    }
}
