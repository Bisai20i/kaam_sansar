<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForexCalculator extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function post_admin(){
        return $this->belongsTo(Admin::class, 'post_admin_id');
    }
}
