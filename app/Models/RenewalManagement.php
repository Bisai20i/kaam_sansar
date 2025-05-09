<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenewalManagement extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'provience' => 'array',
        'district' => 'array',
        'location' => 'array',
        'image' => 'array',
    ];
}
