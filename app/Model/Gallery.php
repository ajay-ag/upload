<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //
     public function getGalleryImageAttribute()
    {
        
        $imageExist  =  \Storage::disk('public')->exists('gallery/'.$this->gal_image);
        
        if($imageExist && $this->gal_image != NULL && $this->gal_image != "" ) {
            return asset('storage/gallery/'.$this->gal_image )  ;
        }

        return asset('storage/default/picture.png');

    }
     public function getGallImageAttribute()
    {
        
        $imageExist  =  \Storage::disk('public')->exists('gallery/'.$this->id.'/'.$this->gal_image);
        
        if($imageExist && $this->gal_image != NULL && $this->gal_image != "" ) {
            return asset('storage/gallery/'.$this->id.'/'.$this->gal_image )  ;
        }

        return asset('storage/default/picture.png');

    }
}
