<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdvertisementPost extends Model
{
    use SoftDeletes;

    // public function postimage() {

    //     return $this->hasOne(PostImage::class,'post_id','id')->where('position',0);
    // }

    public function rel_state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function rel_city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function rel_category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function rel_sub_category()
    {
        return $this->hasOne(Category::class, 'id', 'sub_category_id');
    }

    public function brandName()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }


}
