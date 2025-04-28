<?php 
namespace App\Http\Controllers;

use App\Models\ResumeHelp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeHelpController extends Controller
{
    public function index()
    {
        $resumeHelps = ResumeHelp::all();
        return view('backend.resume_help.lists', compact('resumeHelps'));
    }

    public function create()
    {
        return view('backend.resume_help.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'nullable|string',
            'image_preview' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'normal_price' => 'required|numeric',
            'publish_not_publish' => 'required|boolean',
            'sell_price' => 'required|numeric',
            'type' => 'required|in:0,1', // Ensure type is either 0 or 1
        ]);

        $resumeHelp = new ResumeHelp($request->all());

        // if ($request->hasFile('image_preview')) {
        //     $file = $request->file('image_preview');
        //     $filename = time() . '_' . $file->getClientOriginalName();
        //     $file->move(public_path('uploads'), $filename);
            
        //     $resumeHelp->image_preview = 'uploads/' . $filename;
        // }



        if ($request->hasFile('image_preview') && $request->file('image_preview')->isValid()) {
            $file = $request->file('image_preview');
            
            // Generate a unique filename based on time and original name
            $filename = time() . '_' . $file->getClientOriginalName();
        
            // Store the file in the 'uploads' folder within the 'public' disk
            $filePath = $file->storeAs('uploads', $filename, 'public');
        
            // Store the file path in the database (accessible via public storage)
            $resumeHelp->image_preview = $filePath;
        }

        $resumeHelp->save();
        return redirect()->route('resume-help.index')->with('success', 'Record Added');
    }

    public function edit(ResumeHelp $resumeHelp)
    {
        return view('backend.resume_help.edit', compact('resumeHelp'));
    }

    public function update(Request $request, ResumeHelp $resumeHelp)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'nullable|string',
            'image_preview' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'publish_not_publish' => 'nullable|boolean',
            'normal_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
            'type' => 'required|in:0,1', // Ensure type is either 0 or 1
        ]);
    
        // If a new image is uploaded
        if ($request->hasFile('image_preview') && $request->file('image_preview')->isValid()) {
            $file = $request->file('image_preview');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $filename, 'public');
    
            // Delete old image if exists
            if ($resumeHelp->image_preview) {
                Storage::disk('public')->delete($resumeHelp->image_preview);
            }
    
            $resumeHelp->image_preview = $filePath;
        }
    
        // Update other fields
        $resumeHelp->update([
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'normal_price' => $request->normal_price,
            'sell_price' => $request->sell_price,
            'type' => $request->type,
            'publish_not_publish' => $request->publish_not_publish
        ]);
    
        return redirect()->route('resume-help.index')->with('success', 'Resume help updated successfully.');
    }

    public function destroy(ResumeHelp $resumeHelp)
    {
        $resumeHelp->delete();
        return redirect()->route('resume-help.index')->with('success', 'Record Deleted');
    }
}
