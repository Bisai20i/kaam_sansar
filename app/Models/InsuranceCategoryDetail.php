<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceCategoryDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function insuranceCategory()
    {
        return $this->belongsTo(InsuranceCategory::class);
    }
}
