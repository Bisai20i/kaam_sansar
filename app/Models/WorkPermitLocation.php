<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkPermitLocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'district_id',
        'locationName',
    ];

    /**
     * Relationship: WorkPermitLocation belongs to a WorkPermitDistrict.
     */
    public function district()
    {
        return $this->belongsTo(WorkPermitDistrict::class, 'district_id');
    }
}
