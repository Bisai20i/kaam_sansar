<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'postedId',
        'jobCategoryId',
        'jobCompanyId',
        'jobSeekerId',
        'jobTitle',
        'jobLevel',
        'noOfVacancy',
        'employeeTime',
        'jobLocation',
        'offeredSalary',
        'qualification',
        'experience',
        'skills',
        'jobDescription',
        'jobBanner',
        'jobDeadline',
        'jobApproval',
        'jobViewerCount',
        'jobStatus',
        'jobType'
    ];



    public static function boot()
    {
        parent::boot();

        // Automatically generate slug when creating a job post
        static::creating(function ($jobPost) {
            $jobPost->jobSlug = $jobPost->generateUniqueSlug($jobPost->jobTitle);
        });

        // Automatically update slug when the job title changes
        static::updating(function ($jobPost) {
            if ($jobPost->isDirty('jobTitle')) { // Check if the title has changed
                $jobPost->jobSlug = $jobPost->generateUniqueSlug($jobPost->jobTitle, $jobPost->id);
            }
        });
    }

    /**
     * Generate a unique slug for a given job title.
     */
    public function generateUniqueSlug($title, $id = null)
    {
        $slug = Str::slug($title);

        // Check for existing slugs with similar pattern
        $query = JobPost::where('jobSlug', 'LIKE', "$slug%");

        if ($id) {
            $query->where('id', '!=', $id); // Exclude the current job post
        }

        $count = $query->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    // Define the relationship between the current model and the Admin model

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'postedId');
    }
    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class, 'jobCategoryId');
    }
    // Define the relationship between the current model and the JobCompany model

    public function jobCompany()
    {
        return $this->belongsTo(JobCompany::class, 'jobCompanyId');
    }
    //one to many relationship between jobPost and jobApply

    public function jobApplies()
    {
        return $this->hasMany(JobApply::class, 'jobPostId');
    }

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class, 'jobSeekerId');
    }

    public function jobBookmark()
    {
        return $this->hasMany(JobBookmark::class, 'jobPostId');
    }
}
