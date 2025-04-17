<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'fullName',
        'roleType',
        'status',
        'location',
        'profile_image'
          // Add OTP expiry field
        // Add OTP expiry field
    ];
    protected $casts = [
        'emailVerifiedAt' => 'datetime',
    ];
    public function jobPosts()
    {
        return $this->hasMany(JobPost::class, 'postedId');
    }
      // Method to check role
      public function hasRole($role)
      {
          return $this->roleType === $role;
      }

      public function giftCoupons(){
        return $this->hasMany(GiftCoupon::class,'adminId');
      }
}
