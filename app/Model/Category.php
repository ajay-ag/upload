<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Category extends Model
{
    //
    protected $table = 'category';

    public function getCategoryImageAttribute()
    {

        $imageExist = Storage::disk('public')->exists('category/' . $this->image);

        if ($imageExist && $this->image != NULL && $this->image != "") {
            return asset('storage/category/' . $this->image);
        }

        return asset('storage/default/category.png');

    }

    public function getCategoryThumbAttribute()
    {

        $imageExist = Storage::disk('public')->exists('category/' . $this->id . '/' . $this->image);

        if ($imageExist && $this->image != NULL && $this->image != "") {
            return asset('storage/category/' . $this->id . '/' . $this->image);
        }

        return asset('storage/default/category.png');
    }

    public function getCategoryBackgroundImageThumbAttribute()
    {

        $imageExist = Storage::disk('public')->exists('category/background_image/' . $this->id . '/' . $this->background_image);

        if ($imageExist && $this->background_image != NULL && $this->background_image != "") {
            return asset('storage/category/background_image/' . $this->id . '/' . $this->background_image);
        }

        return asset('storage/default/category.png');

    }

    public function getCategoryBackgroundImageAttribute()
    {

        $imageExist = Storage::disk('public')->exists('category/background_image/' . $this->background_image);

        if ($imageExist && $this->background_image != NULL && $this->background_image != "") {
            return asset('storage/category/background_image/' . $this->background_image);
        }

        return asset('storage/default/category.png');

    }

    public function getCategoryBannerimageAttribute()
    {

        $imageExist = Storage::disk('public')->exists('category/banner_image/' . $this->id . '/' . $this->banner_image);

        if ($imageExist && $this->banner_image != NULL && $this->banner_image != "") {
            return asset('storage/category/banner_image/' . $this->id . '/' . $this->banner_image);
        }

        return asset('storage/default/category.png');

    }

    public function getCategory()
    {

        $category = Category::where('is_active', 'Yes')->withCount('post_cat_count')->where('parent_id', 0)->OrderBy('id', 'asc')->get();
        return $category;

    }

 

    public function post_cat_count()
    {

        return $this->hasMany(AdvertisementPost::class, 'category_id', 'id')->where('status', 'approved')->where('deleted_at', '=', null);
    }

    public function userpost_cat_count($data_param)
    {

        $post_count = $this->hasMany(AdvertisementPost::class, 'category_id', 'id')->where('status', 'approved')->where('deleted_at', '=', null);
        if (isset($data_param['user_id']) && $data_param['user_id'] != "") {

            $post_count = $post_count->where('user_id', $data_param['user_id']);
        }


        return $post_count->count();
    }

    public function post_subcat_count()
    {
        return $this->hasMany(AdvertisementPost::class, 'sub_category_id', 'id')->where('status', 'approved')->where('deleted_at', '=', null);
    }

    public function getSubcategory()
    {
        $toReturn = array();
        $toReturn = Category::where('is_active', 'Yes')->withCount('post_subcat_count')->where('parent_id', '!=', 0)->OrderBy('id', 'asc')->get();
        return $toReturn;

    }

    public function getCategoryByslug($slug = "")
    {

        $category = Category::where('is_active', 'Yes')->where('slug', $slug)->OrderBy('id', 'asc')->get()->first();
        return $category;
    }

    public function sub_cat()
    {
        // return $this->hasMany(Product::class,'category_id','parent_id');
        return $this->hasMany(Category::class, 'parent_id', 'id')->Where('is_active', 'Yes');
    }

    public function getCategoryImageApiAttribute()
    {

        $imageExist = Storage::disk('public')->exists('category/' . $this->image);

        if ($imageExist && $this->image != NULL && $this->image != "") {
            return asset('storage/category/' . $this->image);
        }

        return null;

    }


}
