<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    //
      public function getAboutImageAttribute()
    {
        
        $imageExist  =  \Storage::disk('public')->exists('about/'.$this->image);
        
        if($imageExist && $this->image != NULL && $this->image != "" ) {
            return asset('storage/about/'.$this->image )  ;
        }

        return asset('storage/default/picture.png');

    }

    public static function findOrCreate($id)
	{
    $obj = static::find($id);
    return $obj ?: new static;
	}
}
