<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollingQuestion extends Model
{
    protected $guarded = [];

    public function answers()
    {
        return $this->hasMany(PollingAnswer::class);
    }

    public function polls()
    {
        return $this->hasMany(Poll::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}