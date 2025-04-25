<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function jobSeeker() { return $this->belongsTo(JobSeeker::class); } // jobSeeker()
}
