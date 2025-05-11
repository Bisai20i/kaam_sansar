<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_seekers_id',
        'reward_points',
    ];
    

    public function jobSeeker()
{
    return $this->belongsTo(JobSeeker::class, 'job_seekers_id');
}

}
