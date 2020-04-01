<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OurClient extends Model
{
    //
    public function getOurImageAttribute()
    {
        
        $imageExist  =  \Storage::disk('public')->exists('ourclient/'.$this->ourclient_image);
        
        if($imageExist && $this->ourclient_image != NULL && $this->ourclient_image != "" ) {
            return asset('storage/ourclient/'.$this->ourclient_image )  ;
        }

        return asset('storage/default/picture.png');

    }

    public function getClientImageAttribute()
    {
        
        $imageExist  =  \Storage::disk('public')->exists('ourclient/'.$this->id.'/'.$this->ourclient_image);
        
        if($imageExist && $this->ourclient_image != NULL && $this->ourclient_image != "" ) {
            return asset('storage/ourclient/'.$this->id.'/'.$this->ourclient_image )  ;
        }

        return asset('storage/default/picture.png');

    }
}
