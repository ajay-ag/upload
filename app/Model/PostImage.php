<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostImage extends Model
{
  use SoftDeletes;


  public function getPostImageNameAttribute()
    {


        $imageExist  = \File::exists('storage/'.$this->path);

        if($imageExist && $this->path != NULL && $this->path != "" ) {
            return asset('storage/'.$this->path) ;
        }

        return asset('storage/default/picture.png');

    }

    public function getPostImageThumbAttribute()
    {

        $imageExist  = \File::exists('storage/'.$this->thumb_path);

        if($imageExist && $this->path != NULL && $this->path != "" ) {
            return asset('storage/'.$this->thumb_path) ;
        }

        return asset('storage/default/picture.png');

    }

    public function getPostImageNameApiAttribute()
    {
        $imageExist  = \File::exists('storage/'.$this->path);

        if($imageExist && $this->path != NULL && $this->path != "" ) {
            return asset('storage/'.$this->path) ;
        }

        return null;

    }

    public function getPostImageThumbApiAttribute()
    {

        $imageExist  = \File::exists('storage/'.$this->thumb_path);

        if($imageExist && $this->path != NULL && $this->path != "" ) {
            return asset('storage/'.$this->thumb_path) ;
        }

        return null;

    }

}
