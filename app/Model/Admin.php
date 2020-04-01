<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    
    public function getProfileImageAttribute($value)
    {

        $imageExist  =  \Storage::disk('public')->exists($value);

        if($imageExist && $value != NuLL && $value != "" ) {
            return asset('storage/'.$value )  ;
        }

        return asset('assets/app/media/img/users/user4.jpg');

    }
}
