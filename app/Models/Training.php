<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

     // Enable timestamps (created_at and updated_at)

     public $timestamps = true;

    protected $fillable =[
        'jobSeekerId',
        'trainingTitle',
        'institutionName',
        'completionDate',
        'certificate'

    ];
    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }
}
