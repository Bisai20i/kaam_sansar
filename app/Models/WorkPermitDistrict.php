<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkPermitDistrict extends Model
{
    use HasFactory;

    protected $fillable = [
        'provience_id',
        'districtName',
    ];

    /**
     * Relationship: WorkPermitDistrict belongs to a Province.
     */
    public function province()
    {
        return $this->belongsTo(PassportProvience::class, 'provience_id');
    }
    public function workPermitLocations()
    {
        return $this->hasMany(WorkPermitLocation::class, 'district_id');
    }
}
