<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCompany extends Model
{
    use HasFactory;
    protected $fillable = [
        'companyName',
        'email',
        'industryCategoryId',
        'phoneNumber',
        'link1',
        'link2',
        'link3',
        'companyProfileImg',
        'reviewStatus',
        'companyDescription'
    ];
    public function jobPosts()
    {
        return $this->hasMany(JobPost::class, 'jobCompanyId');
    }
    public function industryCategory()
    {
        return $this->belongsTo(IndustryCategory::class, 'industryCategoryId');
    }
}
