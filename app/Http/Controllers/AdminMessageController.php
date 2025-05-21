<?php

namespace App\Http\Controllers;

use App\Models\AdminMessage;
use App\Models\Admin;
use App\Models\Jyotish;
use App\Models\JobSeeker;
use Illuminate\Http\Request;

class AdminMessageController extends Controller
{
    public function index()
    {
        $adminMessages = AdminMessage::with('admin', 'jyotish', 'jobseeker')->latest()->paginate(10);
        return view('backend.adminmessage.index', compact('adminMessages'));
    }

    public function create()
    {
        $admins = Admin::all();
        $jobseekers = JobSeeker::all();
        $jyotishs = Jyotish::all();
        return view('backend.adminmessage.create', compact('admins','jyotishs', 'jobseekers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|exists:admins,id',
            'jyotish_id' => 'required|exists:jyotishs,id',
            'jobseeker_id' => 'required|exists:job_seekers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        AdminMessage::create($request->all());
        return redirect()->route('admin-messages.index')->with('success', 'Message created successfully.');
    }

    public function show(AdminMessage $adminMessage)
    {
        return view('backend.adminmessage.show', compact('adminMessage'));
    }

    public function edit(AdminMessage $adminMessage)
    {
        $admins = Admin::all();
        $jobseekers = JobSeeker::all();
        $jyotishs = Jyotish::all();

        return view('backend.adminmessage.edit', compact('adminMessage', 'admins', 'jyotishs', 'jobseekers'));
    }

    public function update(Request $request, AdminMessage $adminMessage)
    {
        $request->validate([
            'admin_id' => 'required|exists:admins,id',
            'jyotish_id' => 'required|exists:jyotishs,id',
            'jobseeker_id' => 'required|exists:job_seekers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $adminMessage->update($request->all());
        return redirect()->route('admin-messages.index')->with('success', 'Message updated successfully.');
    }

    public function destroy(AdminMessage $adminMessage)
    {
        $adminMessage->delete();
        return redirect()->route('admin-messages.index')->with('success', 'Message deleted successfully.');
    }
}
