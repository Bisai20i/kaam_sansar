<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sender(){
        return $this->belongsTo(JobSeeker::class, 'sender_id');
    }
    public function receiver(){
        return $this->belongsTo(JobSeeker::class, 'receiver_id');
    }
}
