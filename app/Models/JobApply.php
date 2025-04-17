<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApply extends Model
{
    use HasFactory;
    protected $fillable =[
        'jobPostId',
        'jobSeekerId'
    ];
    //one to many relationship between jobpost and jobapply

    public function jobPost(){
        return $this->belongsTo(JobPost::class,'jobPostId');
    }
    //one to many relationship between jobseeker and jobapply

    public function jobSeeker(){
        return $this->belongsTo(JobSeeker::class,'jobSeekerId');
    }
}
