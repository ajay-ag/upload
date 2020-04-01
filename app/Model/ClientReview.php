<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClientReview extends Model
{
    //
       public function getClientreviewImageAttribute()
    {
        
        $imageExist  =  \Storage::disk('public')->exists('client_review/'.$this->client_image);
        
        if($imageExist && $this->client_image != NULL && $this->client_image != "" ) {
            return asset('storage/client_review/'.$this->client_image )  ;
        }

        return asset('storage/default/picture.png');

    }
}
