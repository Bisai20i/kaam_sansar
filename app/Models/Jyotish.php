<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jyotish extends Model
{
    use HasFactory;

     protected $table = 'jyotishs';

    // Which fields can be mass assigned
    protected $fillable = [
        'name',
        'phone',
        'email',
        'photo',
    ];
}
