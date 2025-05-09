<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassportDateTime extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function location()
    {
        return $this->belongsTo(PassportLocation::class, 'location_id');
    }

    protected $casts = [
        'date' => 'date',
        'time' => 'array'
    ];
}
