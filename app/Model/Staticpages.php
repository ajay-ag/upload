<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Staticpages extends Model
{
    //
    protected $table='static_pages';

     public function getStaticpagesBannerimageAttribute()
    {
    
       $imageExist  =  \Storage::disk('public')->exists('staticpages/banner_image/'.$this->id.'/'.$this->banner_image);
        
        if($imageExist && $this->banner_image != NULL && $this->banner_image != "" ) {
            return asset('storage/staticpages/banner_image/'.$this->id.'/'.$this->banner_image)  ;
        }

        return asset('storage/default/picture.png');

    }
}
