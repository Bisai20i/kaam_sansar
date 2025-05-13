<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassportDistrict extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function provience()
    {
        return $this->belongsTo(PassportProvince::class, 'provience_id');
    }

    public function locations()
    {
        return $this->hasMany(PassportLocation::class, 'district_id');
    }
    public function workPermitLocations()
    {
        return $this->hasMany(WorkPermitLocation::class, 'district_id');
    }
}
