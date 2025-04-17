<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryCategory extends Model
{
    use HasFactory;
    protected $fillable =[
        'industryName',
        'slug'
    ];
    public function jobCompanies(){
        return $this->hasMany(JobCompany::class,'industryCategoryId');
    }
}
