<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

     // Enable timestamps (created_at and updated_at)

     public $timestamps = true;
    protected $fillable = [
        'jobSeekerId',
        'skillName',
        'skillProficiency'
    ];
    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }
}
