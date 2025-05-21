<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'jyotish_id',
        'jobseeker_id',
        'title',
        'description',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function jobseeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }

    public function jyotish()
    {
        return $this->belongsTo(Jyotish::class);
    }
}
