<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassportLocation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function district()
    {
        return $this->belongsTo(PassportDistrict::class, 'district_id');
    }

    public function dateTimes()
    {
        return $this->hasMany(PassportDateTime::class, 'location_id');
    }
}
