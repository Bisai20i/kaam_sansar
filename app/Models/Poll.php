<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = [
        'job_seeker_id', 'polling_question_id', 'polling_answer_id'
    ];

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }

    public function question()
    {
        return $this->belongsTo(PollingQuestion::class, 'polling_question_id');
    }

    public function answer()
    {
        return $this->belongsTo(PollingAnswer::class, 'polling_answer_id');
    }
}
