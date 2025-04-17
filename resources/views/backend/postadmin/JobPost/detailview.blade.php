@extends('backend.layouts.main')

@section('title', 'Job Post Details')

@section('content')
    <div class="container py-4">
        <div class="card shadow-lg border-0 rounded-3 p-4">
            <div class="card-header d-flex justify-content-between align-items-center ">
                <h4 class="mb-0">Job Post Details</h4>
                <a href="{{ route('jobPost.index') }}" class="btn btn-primary btn-sm">Back</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Left Side - Job Details -->
                    <div class="col-md-8">
                        <div class="mb-3"><strong>Job Title:</strong> {{ $jobPost->jobTitle }}</div>
                        <div class="mb-3"><strong>Education Level:</strong> {{ $jobPost->educationLevel }}</div>
                        <div class="mb-3"><strong>Experience:</strong> {{ $jobPost->experience }}</div>
                        <div class="mb-3"><strong>Job Location:</strong> {{ $jobPost->jobLocation }}</div>
                        <div class="mb-3"><strong>Job Salary:</strong> {{ $jobPost->offeredSalary }}</div>
                        <div class="mb-3"><strong>Job Type:</strong> {{ $jobPost->jobType }}</div>
                        <div class="mb-3"><strong>Job Duration:</strong> {{ $jobPost->employeeTime }}</div>
                        <div class="mb-3"><strong>Job Deadline:</strong> {{ $jobPost->jobDeadline }}</div>
                        <div class="mb-3"><strong>Job Status:</strong> {{ $jobPost->status }}</div>
                        <div class="mb-3"><strong>Job Approval:</strong> {{ $jobPost->jobApproval }}</div>
                        <div class="mb-3"><strong>Job Category:</strong> {{ $jobPost->jobCategory->jobCategoryName }}</div>
                    </div>
                    
                    <!-- Right Side - Job Banner and Description -->
                    <div class="col-md-8 text-center">
                        <div class="card shadow-sm border-0">
                            <img src="{{ asset($jobPost->jobBanner) }}"  style="width: 600px; height: 350px;" class="img-fluid rounded" alt="Job Banner">
                            <div class="card-body">
                                <p class="text-muted">{{ $jobPost->jobDescription }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
