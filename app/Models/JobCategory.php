<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;
    protected $fillable =[
        'jobCategoryName',
        'status',
        'publishStatus',
        'slug'
    ];
    public function jobPosts(){
        return $this->hasMany(JobPost::class,'jobCategoryId');
    }
}
