<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaCountryList extends Model
{
    use HasFactory;

    protected $fillable = [
        'countryName',
        'slug',
        'publishStatus',
    ];

    public function visadetails()
    {
        return $this->hasMany(VisaDetails::class, 'visaCountryId');
    }

    public function visaType()
    {
        return $this->belongsTo(VisaType::class);
    }
}
