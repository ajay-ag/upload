<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    public function getServiceImageAttribute()
    {
        
        $imageExist  =  \Storage::disk('public')->exists('service/'.$this->image);
        
        if($imageExist && $this->image != NULL && $this->image != "" ) {
            return asset('storage/service/'.$this->image )  ;
        }

        return asset('storage/default/picture.png');

    }

     public function getIconImageAttribute()
    {
        
        $imageExist  =  \Storage::disk('public')->exists('service/icon/'.$this->icon_img);
        
        if($imageExist && $this->icon_img != NULL && $this->icon_img != "" ) {
            return asset('storage/service/icon/'.$this->icon_img )  ;
        }

        return asset('storage/default/picture.png');

    }

      public function getDetailImageAttribute()
    {
        
        $imageExist  =  \Storage::disk('public')->exists('service/'.$this->id.'/large/'.$this->large_img);
        
        if($imageExist && $this->large_img != NULL && $this->large_img != "" ) {
            return asset('storage/service/'.$this->id.'/large/'.$this->large_img )  ;
        }

        return asset('storage/default/picture.png');

    }
    public function getSmallImageAttribute()
    {
        
        $imageExist  =  \Storage::disk('public')->exists('service/'.$this->id.'/small/'.$this->image);
        
        if($imageExist && $this->image != NULL && $this->image != "" ) {
            return asset('storage/service/'.$this->id.'/small/'.$this->image )  ;
        }

        return asset('storage/default/picture.png');

    }
      
}
