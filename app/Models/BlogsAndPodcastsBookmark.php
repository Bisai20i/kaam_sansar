<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogsAndPodcastsBookmark extends Model
{
    use HasFactory;

protected $fillable = ['job_seeker_id', 'blogs_and_podcasts_id', 'type'];

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class, 'job_seeker_id');
    }

    public function blogsAndPodcasts()
    {
        return $this->belongsTo(BlogsAndPodcast::class, 'blogs_and_podcasts_id');
    }
}
