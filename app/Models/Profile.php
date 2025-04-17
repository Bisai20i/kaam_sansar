<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Authenticatable
{
    use HasFactory;
    // Enable timestamps (created_at and updated_at)

    public $timestamps = true;

    protected $fillable =[
        'jobSeekerId',
        'firstName',
        'lastName',
        'phoneNumber',
        'designation',
        'country',
        'bio',
        'profileImg'

    ];
        public function jobSeeker(){
            return $this->belongsTo(JobSeeker::class);
        }

}
