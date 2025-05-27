<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollingAnswer extends Model
{
    protected $fillable = [
        'polling_question_id', 'answer'
    ];

  public function question()
{
    return $this->belongsTo(PollingQuestion::class, 'polling_question_id');

}

    public function polls()
    {
        return $this->hasMany(Poll::class);
    }
}

