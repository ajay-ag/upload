<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WhyChoose extends Model
{
    //
    public function getWhyImageAttribute()
    {
        
        $imageExist  =  \Storage::disk('public')->exists('whychoose/'.$this->image);
        
        if($imageExist && $this->image != NULL && $this->image != "" ) {
            return asset('storage/whychoose/'.$this->image )  ;
        }

        return asset('storage/default/picture.png');

    }
    public function getChooseImageAttribute()
    {
        
        $imageExist  =  \Storage::disk('public')->exists('whychoose/'.$this->icon_image);
        
        if($imageExist && $this->icon_image != NULL && $this->icon_image != "" ) {
            return asset('storage/whychoose/'.$this->icon_image )  ;
        }

        return asset('storage/default/picture.png');

    }
}
