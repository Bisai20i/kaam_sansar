<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumComment extends Model
{
    use HasFactory;

    public function jobSeeker(){
        return $this->belongsTo(JobSeeker::class, 'jobSeekerId');
    }

    public function discussionForum(){
        return $this->belongsTo(DiscussionForum::class, 'forum_id');
    }
}
