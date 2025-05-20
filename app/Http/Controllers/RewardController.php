<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\JobSeeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::with('jobSeeker')->latest()->simplePaginate(10);
        return view('backend.reward.list', compact('rewards'));
    }

    public function create()
    {
        $jobSeekers = JobSeeker::all();
        return view('backend.reward.create', compact('jobSeekers'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'job_seekers_id' => 'required|exists:job_seekers,id',
            'reward_points' => 'required|integer|min:0',
        ]);
    
    $reward = Reward::where('job_seekers_id', $request->job_seekers_id)->first();

    if ($reward) {
        // Update existing reward points
        $reward->reward_points += $request->reward_points;
        $reward->save();
    } else {
        // Create a new reward entry
        Reward::create([
            'job_seekers_id' => $request->job_seekers_id,
            'reward_points' => $request->reward_points,
        ]);
    }

    
        return redirect()->route('rewards.index')->with('success', 'Reward added successfully!');
    }
    

    public function edit($id)
    {
        $reward = Reward::findOrFail($id);
        $jobSeekers = JobSeeker::all();
        return view('backend.reward.edit', compact('reward', 'jobSeekers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'job_seekers_id' => 'required|exists:job_seekers,id',
            'reward_points' => 'required|integer|min:0',
        ]);

        try {
            $reward = Reward::findOrFail($id);
            $reward->update($request->all());
            return redirect()->route('rewards.index')->with('success', 'Reward updated successfully!');
        } catch (\Exception $e) {
            Log::error('Reward update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update reward.');
        }
    }

    public function destroy($id)
    {
        try {
            Reward::findOrFail($id)->delete();
            return redirect()->route('rewards.index')->with('success', 'Reward deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Reward delete failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete reward.');
        }
    }
}
