<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $guarded = [];

     
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function getFaviconImageAttribute()
    {
        
        $imageExist  =  \Storage::disk('public')->exists('generalsetting/'.$this->favicon);
        
        if($imageExist && $this->favicon != NULL && $this->favicon != "" ) {
            return asset('storage/generalsetting/'.$this->favicon );
        }

        return asset('storage/default/download5.jpg');

    }

     public function getLogoImageAttribute()
    {
        
        $imageExist  =  \Storage::disk('public')->exists('generalsetting/'.$this->logo);
        
        if($imageExist && $this->logo != NULL && $this->logo != "" ) {
            return asset('storage/generalsetting/'.$this->logo );
        }

        return asset('storage/default/download.png');

    }
}
