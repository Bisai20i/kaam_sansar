<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogsAndPodcast extends Model
{
    use HasFactory;

    protected $table = 'blogsandpodcasts';


    // Define fillable columns for mass assignment
    protected $fillable = [
        'blogOrPodcast',
        'slug',
        'title',
        'description',
        'imageUrl',
        'linkUrl',
        'podcastTime',
        'publishStatus',
    ];

    // Define casts for specific columns (optional)
    protected $casts = [
        'publishStatus' => 'boolean', // Cast publishStatus to boolean (0 = false, 1 = true)
    ];

    // Define default values for attributes (optional)
    protected $attributes = [
        'publishStatus' => '0', // Default value for publishStatus
    ];


}
