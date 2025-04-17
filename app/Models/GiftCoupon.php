<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class GiftCoupon extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'thumbnail', 'price', 'giftCategoryId', 
        'quantity', 'type', 'country', 'city', 'publishStatus', 
        'discount', 'itemCode', 'customApplied', 'adminId'
    ];

    public function giftCategory()
    {
        return $this->belongsTo(GiftCategory::class, 'giftCategoryId');
    }

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class, 'jobSeekerId');
    }

    public function userComments()
    {
        return $this->hasMany(UserComment::class, 'giftCouponId');
    }

    public function admin(){
        return $this->belongsTo(Admin::class,'adminId');
    }
    
}
