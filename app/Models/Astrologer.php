<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Astrologer extends Model
{
    use HasFactory;

    protected $fillable = [
        'kundaliId',
        'kundaliMatchingId',
        'videoLink',
        'status',
        'publishStatus',
        
    ];

    // Relationship with Kundali
    public function kundali()
    {
        return $this->belongsTo(Kundali::class, 'kundaliId');
    }

    // Relationship with Kundali Matching
    public function kundaliMatching()
    {
        return $this->belongsTo(KundaliMatching::class, 'kundaliMatchingId');
    }
}
