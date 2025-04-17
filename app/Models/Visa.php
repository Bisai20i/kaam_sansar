<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Visa extends Authenticatable
{
    use HasFactory;
    // Enable timestamps (created_at and updated_at)

    public $timestamps = true;

    protected $fillable = [
        'jobSeekerId',
        'visaDetails',
        'country',
        'visaImage',
        'visaExpire'
    ];
    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }

}
