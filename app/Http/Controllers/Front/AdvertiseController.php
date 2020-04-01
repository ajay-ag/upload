<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Common as Helper;
use App\Http\Controllers\Controller;
use App\Model\AdvertisementPostView;
use App\Model\AdvertisementPost;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Favorite;
use App\Model\Lead;
use App\Model\PostImage;
use App\User;
use Auth;
use DB;
use File;
use Hash;
use Illuminate\Http\Request;
use Mail;
use Session;


class AdvertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {


        //
        //$staticpage=getStaticpage('1');
        $data = array();
        $request_data = array();
        $data = array();
        $this->data['title'] = 'Post Add';
        $static_page = Helper::getStaticpage('6');
        $data['static_page'] = $static_page;
        $category_column_array = array();
        $data['category'] = $this->getCategorydata();
        $ids = collect($data['category'])->pluck('id');
        $data['brand'] = Brand::whereIn('category_id', $ids)->get();


        $request_data['perpage'] = 12;
        $request_data['sort'] = $request->get('sort');

        $request_data['city'] = $request->city;
        $request_data['keyword'] = $request->title;

        $listing_data = $this->listing_data($request_data);
        $this->data['totalData'] = $listing_data['totalData'];
        $this->data['maxPrice'] = $listing_data['maxPrice'];
        $this->data['category_name'] = 'All Categories';

        $static_page = Helper::getStaticpage('1');
        $data['static_page'] = $static_page;
        //dd($this->data['totalData']);
        return view('websiteview.advertise.list_advertise', $this->data, $data);
    }

    public function getCategorydata($data_param = "")
    {


        $category = new Category();
        $category = $category->getCategory();
        // dd( $category);
        $category_data = array();
        foreach ($category as $cat_key => $category_item) {
            $category_post_count = $category_item->userpost_cat_count($data_param);

            $category_data[] = array('id' => $category_item->id, 'name' => $category_item->name, 'slug' => $category_item->slug, 'post_count' => $category_post_count);
        }
        return $category_data;
    }

    public function listing_data($request_data = "")
    {
        $toReturn = array();
        $query = DB::table('advertisement_posts AS ap')
            ->Leftjoin('category as c', 'c.id', '=', 'ap.category_id')
            ->Leftjoin('category as subcat', 'subcat.id', '=', 'ap.sub_category_id')
            // ->Leftjoin('favorites as fav','fav.post_id','=','ap.id')
            ->Leftjoin('cities as city', 'city.id', '=', 'ap.city_id')
            ->Leftjoin('states as state', 'state.id', '=', 'ap.state_id')
            ->select('ap.id as id', 'c.name as category', 'subcat.name as sabcategory', 'ap.title as title', 'ap.publish_date as publish_date', 'ap.status as status', 'ap.price as price', 'ap.slug as slug', 'city.name as city_name', 'state.name as state_name', 'c.slug as parent_slug', 'ap.is_sold as is_sold');

        $query = $query->where('ap.status', 'approved')->where('ap.deleted_at', '=', null);

        if (isset($request_data['city'])) {
            $query = $query->where('ap.city_id', $request_data['city']);
        }

        if (isset($request_data['brand_id'])) {
            $query = $query->whereIn('ap.brand_id', $request_data['brand_id']);
        }

        if (isset($request_data['category_id']) && count($request_data['category_id'])) {
            $query = $query->whereIn('ap.category_id', $request_data['category_id']);
        }

        if (isset($request_data['sub_category_id'])) {
            $query = $query->where('ap.sub_category_id', $request_data['sub_category_id']);
        }

        if (isset($request_data['user_id']) && $request_data['user_id'] != "") {
            $query = $query->where('ap.user_id', $request_data['user_id']);
        }
        // dd($request_data['keyword']);

//
//        if (isset($request_data['keyword'])) {
//            $query = $query->where('ap.title', 'LIKE', "%{$request_data['keyword']}%");
//        }

//        if (isset($request_data['keyword'])) {
//            $query = $query->where('subcat.name', 'LIKE', "%{$request_data['keyword']}%")
//                ->orWhere('c.name', 'LIKE', "%{$request_data['keyword']}%");
//        }
        $query->when($request_data['keyword'], function ($query, $iterm) {
            return $query->where(function ($q) use ($iterm) {
                $q->where('subcat.name', 'LIKE', "%{$iterm}%")
                    ->orWhere('c.name', 'LIKE', "%{$iterm}%");
            });
        });


        $toReturn['maxPrice'] = \App\Model\AdvertisementPost::max('price');
        // dd($query->get());
        
            $cr = Helper::commonCurrency();

        if (isset($request_data['amount'])) {
            $replace = str_replace($cr, '', $request_data['amount']);
            $replace = explode('-', $replace);
            // dd($replace);
            $startAmunt = str_replace(' ', '', $replace[0]);
            $endAmunt = str_replace(' ', '', $replace[1]);
//            dd($startAmunt,$endAmunt);

            if ($endAmunt != "0") {
                $query = $query->whereBetween('ap.price', [$startAmunt, $endAmunt]);
            }


        }

        if (isset($request_data['perpage']))
            $perpage = $request_data['perpage'];
        else
            $perpage = 12;


        if (isset($request_data['sort']) && $request_data['sort'] == "low") {
            $toReturn['totalData'] = $query->orderBy('price', 'asc')->paginate($perpage);
        } else if (isset($request_data['sort']) && $request_data['sort'] == "high") {
            $toReturn['totalData'] = $query->orderBy('price', 'desc')->paginate($perpage);
        } else {

            $toReturn['totalData'] = $query->orderBy('id', 'desc')->paginate($perpage);
        }


        foreach ($toReturn['totalData'] as $skey => &$value) {

            $value->image_path = $this->getImage($value->id);
            // $value->parent_category_slug=$this->getParentCategory($value->parent_id);

            if (Auth::user()) {
                $value->is_fav = $this->getFav($value->id);
            } else {
                $value->is_fav = "No";
            }

        }
        // dd($toReturn['totalData']);
        //return $toReturn['totalData'];
        return $toReturn;
    }

    function getImage($postID)
    {

        $img = PostImage::where('post_id', $postID)->where('position', '0')->first();

        if (!empty($img->name)) {
            $imageExist = File::exists('storage/post_image/' . $postID . '/thumb/' . $img->name);

            if ($imageExist && $img->name != NULL && $img->name != "") {
                return asset('storage/post_image/' . $postID . '/thumb/' . $img->name);
            }
            return asset('storage/default/no-image-post.png');
        }
        return asset('storage/default/no-image-post.png');
    }

    function getFav($id)
    {

        $userId = Auth::user()->id;
        $fav = Favorite::where('user_id', $userId)->where('post_id', $id)->first();
        if (empty($fav)) {
            return "No";
        } else {
            return "Yes";
        }

    }

    public function contact_seller(Request $request)
    {

        $lead = new Lead();
        $lead->name = $request->txt_name;
        $lead->email = $request->txt_email;
        $lead->description = $request->description;
        $lead->post_id = $request->post_id;
        $lead->post_name = $request->advertise_name;
        $lead->save();


        Session::flash('success', "Contact seller submited successfully");
        return redirect($request->redirect_url);

    }

    public function advertise_detail(Request $request)
    {

        $notif_id = $request->get('notif_id');
        if ($notif_id) {
            $notification = DB::table('notifications')->where('id', $notif_id)->update(['read_at' => date('Y-m-d H:i:s')]);
        }


        $this->data['title'] = 'Advertise Detail';


        $data = array();
        $addSulg = "";

        $query = DB::table('advertisement_posts AS ap')
            ->Leftjoin('category as c', 'c.id', '=', 'ap.category_id')
            ->Leftjoin('category as subcat', 'subcat.id', '=', 'ap.sub_category_id')
            ->Leftjoin('cities as city', 'city.id', '=', 'ap.city_id')
            ->Leftjoin('states as state', 'state.id', '=', 'ap.state_id')
            ->select('ap.id as id', 'c.id as category_id', 'c.name as category', 'subcat.name as sabcategory', 'ap.title as title', 'ap.publish_date as publish_date', 'ap.status as status', 'ap.price as price', 'ap.description', 'ap.user_id as user_id', 'ap.slug', 'city.name as city_name', 'state.name as state_name', 'ap.address as address');

        if (!isset($request->admin_slug)) {

            $query = $query->where('ap.status', 'approved');
            $addSulg = $request->slug;
        } else {
            $addSulg = $request->admin_slug;
        }

        $query = $query->where('ap.deleted_at', '=', null);
        // dd( $query->get());
        $query = $query->where('ap.slug', $addSulg);

        $data['advertise_detail'] = $query->orderBy('id', 'desc')->first();

        // dd($data['advertise_detail'] );

        if (empty($data['advertise_detail'])) {
            abort(404, 'not found action.');
        }

        $data['user_image'] = User::where('id', $data['advertise_detail']->user_id)->first()->ProfileSrc;
        //dd($data['user_image']);
        
        if (isset($data['advertise_detail']->id) && $data['advertise_detail']->id != "") {

            $data['advertise_images'] = PostImage::where('post_id', $data['advertise_detail']->id)->orderBy('position', 'asc')->get();
            


//          $data['advertise_attribute']=DB::table('advertisement_post_attributes')->where('advertisement_post_id',$data['advertise_detail']->id)->orderBy('attribute_id','asc')->get();

            $data['advertise_attribute'] = DB::table('advertisement_post_attributes as apa')
                ->Leftjoin('attibute_fields as af', 'af.id', '=', 'apa.attribute_id')
                ->select('apa.field_value', 'af.name as field_name')
                ->where('apa.advertisement_post_id', $data['advertise_detail']->id)
                ->orderBy('apa.attribute_id', 'asc')
                ->get();

            $data['related_advertise'] = $this->related_advertise($data['advertise_detail']->id, $data['advertise_detail']->category_id);
            foreach ($data['related_advertise'] as $skey => &$value) {
                $value->image_path = $this->getImage($value->id);
                if (Auth::user()) {
                    $value->is_fav = $this->getFav($value->id);
                } else {
                    $value->is_fav = "No";
                }

            }
        }
        //get my ipaddress
//        $ip = getHostByName(getHostName());
        $ip = $_SERVER['REMOTE_ADDR'];

        $adView = AdvertisementPostView::where('post_id', $data['advertise_detail']->id)
            ->where('ip', $ip)
            ->first();

        if (empty($adView)) {
            $view = new AdvertisementPostView();
            $view->post_id = $data['advertise_detail']->id;
            // $view->ip=$_SERVER['REMOTE_ADDR'];
            $view->ip = $ip;
            $view->save();
        }
        $this->data['hisPost'] =  NULL ;
        if(\Auth::check()) {
            $this->data['hisPost'] = AdvertisementPost::where('id',$data['advertise_detail']->id)->where('user_id',\Auth::user()->id)->first();
        }

        return view('websiteview.advertise.advertise_detail', $this->data, $data);
    }


    public function related_advertise($id = "", $category_id = "")
    {
      
        $related_ad = DB::table('advertisement_posts AS ap')
            ->Leftjoin('category as c', 'c.id', '=', 'ap.category_id')
            ->Leftjoin('category as subcat', 'subcat.id', '=', 'ap.sub_category_id')
            ->Leftjoin('cities as city', 'city.id', '=', 'ap.city_id')
            ->Leftjoin('states as state', 'state.id', '=', 'ap.state_id')
            ->select('ap.id as id', 'c.name as category', 'subcat.name as sabcategory', 'ap.title as title', 'ap.publish_date as publish_date', 'ap.status as status', 'ap.price as price', 'ap.description', 'ap.slug as slug', 'city.name as city_name', 'state.name as state_name', 'c.slug as parent_slug', 'ap.is_sold as is_sold');
        $related_ad = $related_ad->where('ap.status', 'approved')->where('ap.deleted_at', '=', null);
        $related_ad = $related_ad->where('ap.id', '!=', $id);
        $related_ad = $related_ad->where('ap.category_id', $category_id);
        $related_ad = $related_ad->get();
        return $related_ad;
    }

    public function dataListing(Request $request)
    {
        //dd($request->all());
        $request_data['category_id'] = array();

        $this->data['title'] = 'POST LIST';
        $category_column_array = array();
        $category = new Category();
        if (isset($request->search_post) && $request->search_post == '1') {

            $this->data['category_name'] = '';
            if (isset($request->category_id) && count($request->category_id) > 0) {

                $request_data['category_id'] = $request->category_id;
                $data['search_category'] = $request->category_id;

                $this->data['category_name'] = '';
                $search_post['category_id'] = $request->category_id;
                // Session::push('search_post_field',$search_post);

            }
        } else {
            if (isset($request->slug)) {
//                dd(1);
                $getcategory = $category->getCategoryByslug($request->slug);
                $this->data['category_name'] = $getcategory->name;
                $request_data['sub_category_id'] = $getcategory->id;
                $request_data['category_id'] = array($getcategory->parent_id);
                $data['search_category'] = $request_data['category_id'];
            } else if (isset($request->category_slug)) {

                $getcategory = $category->getCategoryByslug($request->category_slug);
                $this->data['category_name'] = $getcategory->name;
                $request_data['category_id'] = array($getcategory->id);
                $data['search_category'] = $request_data['category_id'];
            } else if (isset($request->user_id)) {
                $this->data['category_name'] = "All Category";
                $request_data['user_id'] = $request->user_id;
            }
        }
        $request_data['keyword'] = $request->keyword;
        $request_data['amount'] = $request->amount;
        $request_data['sort'] = $request->sort;


        $request_data['brand_id'] = $request->brand_id;
        $data['search_brand'] = $request->brand_id;

        $this->data['title'] = 'Category';
        if (isset($request->user_id) && $request->user_id != "")
            $request_data['user_id'] = $request->user_id;


//dd( $request_data['category_id'] );
        $data['category'] = $this->getCategorydata($request_data);

//        $ids=collect($request_data['category_id'])->pluck('id');
//        dd( $ids);
//dd($request_data['category_id']);
//     dd($request_data['category_id']);
        $data['brand'] = Brand::whereIn('category_id', $request_data['category_id'])->get();

        $request_data['perpage'] = 12;

//        dd(  $request_data);
        $listing_data = $this->listing_data($request_data);
        //$this->data['totalData'] = $this->listing_data($request_data);
        $this->data['totalData'] = $listing_data['totalData'];
        $this->data['maxPrice'] = $listing_data['maxPrice'];
       // dd($this->data);

        $static_page = Helper::getStaticpage('1');
        $data['static_page'] = $static_page;
//        dd($this->data,$data);

        return view('websiteview.advertise.list_advertise', $this->data, $data);
        //   return response()->json($json_data);

    }

    public function setFavourit($id)
    {
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $find = Favorite::where('post_id', $id)->where('user_id', $userId)->first();
            if (empty($find)) {
                $fav = new Favorite();
                $fav->user_id = $userId;
                $fav->post_id = $id;
                $fav->save();
                return response()->json([
                    'process' => "add",
                    'success' => true,
                    'message' => 'add  successfully.'
                ], 200);

            } else {
                Favorite::where('post_id', $id)->where('user_id', $userId)->delete();
                return response()->json([
                    'process' => "remove",
                    'success' => true,
                    'message' => 'remove successfully.'
                ], 200);


            }
        }
    }
}
