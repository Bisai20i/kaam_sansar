<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
     // Enable timestamps (created_at and updated_at)

     public $timestamps = true;

    protected $table = 'education';

    protected $fillable = [
        'jobSeekerId',
        'schoolName',
        'degree',
        'city',
        'startDate',
        'graduationDate',
        'educationDescription',
    ];
    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }

}
