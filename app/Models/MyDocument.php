<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MyDocument extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function document(){
        return $this->hasMany(MyDocumentImage::class);
    }
}
