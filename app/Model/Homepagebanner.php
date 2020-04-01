<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Homepagebanner extends Model
{
    //
    public function getSliderImgeAttribute()
    {
        
        $imageExist  =  \Storage::disk('public')->exists('banner/'.$this->slider_img);
        
        if($imageExist && $this->slider_img != NULL && $this->slider_img != "" ) {
            return asset('storage/banner/'.$this->slider_img )  ;
        }

        return asset('storage/default/picture.png');

    }
}
