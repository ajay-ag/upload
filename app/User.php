<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Model\City;
use App\Model\State;
use App\Model\Country;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'personal_city','id');
    }
    public function getProfileSrcAttribute()
   {

       $imageExist  =  \Storage::disk('public')->exists('user_profile/'.$this->id.'/origanal/'.$this->profile_image);

       if($imageExist && $this->profile_image != NULL && $this->profile_image != "" ) {
           return asset('storage/user_profile/'.$this->id.'/origanal/'.$this->profile_image);
       }

       return asset('storage/default/no_user.png');

   }

    public function getProfileSrcCardAttribute()
    {

        $imageExist  =  \Storage::disk('public')->exists('user_profile/'.$this->id.'/origanal/'.$this->profile_image);

        if($imageExist && $this->profile_image != NULL && $this->profile_image != "" ) {
            return asset('storage/user_profile/'.$this->id.'/origanal/'.$this->profile_image);
        }

        return asset('storage/default/user_default.png');


    }

    public function getProfileSrcApiAttribute()
   {

       $imageExist  =  \Storage::disk('public')->exists('user_profile/'.$this->id.'/'.$this->profile_image);

       if($imageExist && $this->profile_image != NULL && $this->profile_image != "" ) {
           return asset('storage/user_profile/'.$this->id.'/'.$this->profile_image);
       }

        return null;

   }
    public function per_country()
   {
       return $this->hasOne(Country::class, 'id','personal_country');
   }
   public function per_state()
   {
       return $this->hasOne(State::class, 'id','personal_state');
   }

    public function per_city()
    {
        return $this->hasOne(City::class, 'id','personal_city');
    }

    public function bus_state()
    {
        return $this->hasOne(State::class, 'id','business_state');
    }

    public function bus_city()
    {
        return $this->hasOne(City::class, 'id','business_city');
    }
}
