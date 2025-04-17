<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

     // Enable timestamps (created_at and updated_at)

     public $timestamps = true;
    protected $fillable=
    [
        'jobSeekerId',
        'projectTitle',
        'projectLink',
        'projectDescription',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            $project->projectSlug = $project->generateUniqueSlug($project->projectTitle);
        });
    }

    public function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = Project::where('projectSlug', 'LIKE', "$slug%")->count();


        return $count ? "{$slug}-{$count}" : $slug;
        }
    public function jobSeeker(){
        return $this->belongsTo(JobSeeker::class,'jobSeekerId');
    }

}
