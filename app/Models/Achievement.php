<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'jobSeekerId',
        'achievementTitle',
        'achievementDescription',

    ];
    public function jobSeeker(){
        return $this->belongsTo(JobSeeker::class,'jobSeekerId');
    }



}
