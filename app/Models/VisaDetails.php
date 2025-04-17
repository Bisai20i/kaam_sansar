<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'visaTypeId',
        'visaCountryId',
        'description',
        'demoVideoLink',
        'demoVideoThumbnail',
        'embassyFee',
        'serviceFee',
        'publishStatus',

    ];
    public function visaType()
    {
        return $this->belongsTo(VisaType::class, 'visaTypeId');
    }
    public function visaCountry()
    {
        return $this->belongsTo(VisaCountryList::class, 'visaCountryId');
    }
}
