<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function insuranceCompany()
    {
        return $this->belongsTo(InsuranceCompany::class, 'insurance_company_id');
    }

    public function insuranceDetail()
    {
        return $this->hasOne(InsuranceCategoryDetail::class, 'insurance_category_id');
    }

    public function subCategory()
    {
        return $this->hasMany(InsuranceSubCategory::class, 'insurance_category_id');
    }
}
