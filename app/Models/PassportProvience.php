<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassportProvience extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function passportCountryList()
    {
        return $this->belongsTo(PassportCountryList::class,'country_id');
    }

    public function passportDistricts()
    {
        return $this->hasMany(PassportDistrict::class,'provience_id');
    }
}
