<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCart extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function jobSeeker(){
        return $this->belongsTo(JobSeeker::class);
    }
    public function giftCoupon(){
        return $this->belongsTo(GiftCoupon::class,'coupon_id' );
    }
}
