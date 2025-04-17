<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JobSeekerDashboardController extends Controller
{
    public function basicInfo()
    {
        if (request()->ajax()) {
            return view('frontend.profile.partials.basic-info');
        }
        return view('frontend.profile.jobseeker-dashboard');
    }

    public function yourCV()
    {
        if (request()->ajax()) {
            return view('frontend.profile.partials.your-cv');
        }
        return view('frontend.profile.jobseeker-dashboard');
    }

    public function purchaseHistory()
    {
        if (request()->ajax()) {
            return view('frontend.profile.partials.purchase-history');
        }
        return view('frontend.profile.jobseeker-dashboard');
    }

    public function editProfile()
    {
        if (request()->ajax()) {
            return view('frontend.profile.partials.edit-profile');
        }
        return view('frontend.profile.jobseeker-dashboard');
    }

    public function myJobs()
    {
        if (request()->ajax()) {
            return view('frontend.profile.partials.my-jobs');
        }
        return view('frontend.profile.jobseeker-dashboard');
    }

    
}
