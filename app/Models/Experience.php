<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

     // Enable timestamps (created_at and updated_at)

     public $timestamps = true;

    protected $fillable =
    [
        'jobSeekerId',
        'jobTitle',
        'companyName',
        'location',
        'startDate',
        'endDate',
        'experienceDescription',
        'salaryRating',
        'salaryFeedback',
        'workingEnvironmentRating',
        'workingEnvironmentFeedback',
        'benefitsRating',
        'benefitsFeedback'

    ];
    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }

}
