<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscussionForum extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [

        'images' => 'array',
    ];
    public function jobSeeker(){
        return $this->belongsTo(JobSeeker::class, 'jobSeekerId');
    }

    public function forumComment(){
        return $this->hasMany(ForumComment::class, 'forum_id');
    }

    public function forumInteraction(){
        return $this->hasMany(ForumInteraction::class, 'forum_id');
    }
}
