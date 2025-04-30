<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Http;



class JobSeeker extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    // Specify the table name if it deviates from the default (lowercase pluralized model name)
    protected $table = 'job_seekers';

    // Fillable attributes should match the column names in camelCase
    protected $fillable = [
        'firstName', // camelCase
        'lastName',  // camelCase
        'emailAddress', // camelCase
        'password',
        'otp',
        'otpVerified',  // camelCase
        'otpExpiry',  // camelCase
        'countryCode', // camelCase
        'phoneNumber', // camelCase
        'userThumbnail', // camelCase
        'emailVerifiedAt', // camelCase
        'rememberToken',
        'socialMediaLogin', // camelCase
        'luckyNumber', // camelCase
        'dateOfBirth', // camelCase
        'temporaryLocation', // camelCase
        'permanentLocation', // camelCase
        'status',
        'type',
        'referralCode',  // camelCase
        'otp',
        'acceptedTerms',
        'expectedSalary',
        'whoAmI',
        'email_or_phone',
        'country'
    ];


    protected $appends = ['country_flag'];

    // Hidden attributes that should not be serialized (e.g., sensitive data)
    protected $hidden = [
        'password',
        'rememberToken',
    ];

    // Cast specific attributes to native types
    protected $casts = [
        'emailVerifiedAt' => 'datetime', // Date
        'otpExpiry' => 'datetime', // DateTime
        'otpVerified' => 'boolean', // Boolean
        'userThumbnail' => 'array',
    ];



    

    public function getCountryCodeAttribute()
    {
        // Check if the country name exists
        if (empty($this->country)) {
            return null;
        }
    
        // Call RestCountries API to get country data by name
        $response = Http::get('https://restcountries.com/v3.1/name/' . urlencode($this->country));
    
        // Decode the JSON response
        $countries = $response->json(); // Convert response to an array
    
        // Check if the response contains countries data and count the results
        if (!empty($countries) && count($countries) > 0) {
            // Extract the country code (cca2) from the response
            return $countries[0]['cca2']; // Return the 2-letter country code
        }
    
        return null; // Return null if no valid response
    }
    
    public function getCountryFlagAttribute()
    {
        $code = strtoupper($this->country_code); // Always use your dynamic country_code
    
        if (strlen($code) === 2) {
            return "https://flagsapi.com/{$code}/flat/24.png"; // Generate flag URL
        }
    
        return ''; // Return empty if invalid
    }
    
    

    public function isOtpVerified()
    {

        return $this->otpVerified == 1; // Check if otpVerified is 1 (true)
    }
    // Relationships:
    public function jobApplies()
    {
        return $this->hasMany(JobApply::class, 'jobSeekerId');  // Ensure foreign key matches
    }

    public function jobPosts()
    {
        return $this->hasMany(JobPost::class, 'jobSeekerId');  // Ensure foreign key matches
    }



    // model relationships with resume related model
    public function achievements()
    {
        return $this->hasMany(Achievement::class, 'jobSeekerId');  // Ensure foreign key matches
    }
    public function educations()
    {
        return $this->hasMany(Education::class, 'jobSeekerId');  // Ensure foreign key matches
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class, 'jobSeekerId');  // Ensure foreign key matches
    }
    public function languages()
    {
        return $this->hasMany(Language::class, 'jobSeekerId');  // Ensure foreign key matches
    }
    public function projects()
    {
        return $this->hasMany(Project::class, 'jobSeekerId');  // Ensure foreign key matches
    }
    public function skills()
    {
        return $this->hasMany(Skill::class, 'jobSeekerId');  // Ensure foreign key matches
    }
    public function trainings()
    {
        return $this->hasMany(Training::class, 'jobSeekerId');  // Ensure foreign key matches
    }
    public function visas()
    {
        return $this->hasMany(Visa::class, 'jobSeekerId');  // Ensure foreign key matches
    }

    // develop  one to many relationship with giftcoupons

    public function giftCoupons()
    {
        return $this->hasMany(GiftCoupon::class, 'jobSeekerId');
    }

    public function productComments()
    {
        return $this->hasMany(ProductComment::class, 'jobSeekerId');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'jobSeekerId');
    }
//develop re;lationship for kundali related
  // Define the relationship with the JobSeeker model
  public function kundalis()
  {
      return $this->hasMany(Kundali::class, 'jobSeekerId');
  }
  public function kundaliMatchings()
  {
      return $this->hasMany(kundaliMatching::class, 'jobSeekerId');
  }
   public function jobBookmark(){
    return $this->hasMany(JobBookmark::class, 'jobSeekerId');
   }

   public function orderPlacement(){
    return $this->hasMany(OrderPlacement::class, 'jobSeekerId');
   }

   public function userComments(){
    return $this->hasMany(UserComment::class, 'jobSeekerId');
   }

   public function discussionForum(){
    return $this->hasMany(DiscussionForum::class, 'jobSeekerId');
   }

   public function forumComment(){
    return $this->hasMany(ForumComment::class, 'jobSeekerId');
   }

   public function messages(){
    return $this->hasMany(Message::class, 'sender_id');
   }
}
