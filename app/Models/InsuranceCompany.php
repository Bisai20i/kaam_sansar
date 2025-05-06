<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceCompany extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function insuranceCategory()
    {
        return $this->hasMany(InsuranceCategory::class, 'insurance_company_id');
    }

}
