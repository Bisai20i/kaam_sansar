<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobBookmark extends Model
{
    
    use HasFactory;
    protected $fillable = ['jobSeekerId', 'jobPostId'];
    public function jobPost(){
        return $this->belongsTo(JobPost::class, 'jobPostId');
    }

    public function jobSeeker(){
        return $this->belongsTo(JobSeeker::class, 'jobSeekerId');
    }
}
