<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GiftCategory extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function giftCoupons()
    {
        return $this->hasMany(GiftCoupon::class, 'giftCategoryId');
    }


}
