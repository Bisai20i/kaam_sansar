<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForeignExchangeDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function forex_calculator()
    {
        return $this->belongsTo(ForexCalculator::class, 'forex_calculator_id');
    }
    public function jobseeker()
    {
        return $this->belongsTo(JobSeeker::class, 'jobseeker_id');
    }
}
