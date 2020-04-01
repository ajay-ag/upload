<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\AdvertisementPost;
use App\Model\AdvertisementPostAttribute;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Favorite;
use App\Model\Lead;
use App\Model\PostImage;
use App\User;
use App\Traits\DatatablTrait;
use Auth;
use DB;
use File;
use Hash;
use Illuminate\Http\Request;
use Image;
use Session;
use Storage;
use App\Helpers\Common as Helper;



class AdvertisementPostController extends Controller
{
        use DatatablTrait;

    public function index()
    {


        $userId = Auth::user()->id;
        $this->data['totalData'] = DB::table('advertisement_posts AS ap')
            ->Leftjoin('category as c', 'c.id', '=', 'ap.category_id')
            ->Leftjoin('category as subcat', 'subcat.id', '=', 'ap.sub_category_id')
            ->select('ap.id as id', 'c.name as category', 'subcat.name as sabcategory', 'ap.title as title', 'ap.publish_date as publish_date', 'ap.status as status', 'ap.price as price', 'ap.expired_date as expired_date', 'ap.is_sold as is_sold')
            ->where('ap.user_id', $userId)
            ->where('ap.deleted_at', '=', null)
            ->orderBy('id', 'desc')
            ->paginate(10);


        foreach ($this->data['totalData'] as $skey => &$value) {
            $value->image_path = $this->getImagePathPost($value->id);
        }

        $this->data['total_approve'] = DB::table('advertisement_posts AS ap')->where('ap.user_id', $userId)->where('ap.deleted_at', '=', null)->where('status', '=', 'approved')->count();
        $this->data['total_canceled'] = DB::table('advertisement_posts AS ap')->where('ap.user_id', $userId)->where('ap.deleted_at', '=', null)->where('status', '=', 'canceled')->count();
        $this->data['total_panding'] = DB::table('advertisement_posts AS ap')->where('ap.user_id', $userId)->where('ap.deleted_at', '=', null)->where('status', '=', 'pending')->count();
        return view('websiteview.post.post_list', $this->data);
    }

    function getImagePathPost($postID)
    {


        $img = PostImage::where('post_id', $postID)->where('position', '0')->first();


        if (!empty($img->name)) {


            $imageExist = File::exists('storage/post_image/' . $postID . '/thumb/' . $img->name);


            if ($imageExist && $img->name != NULL && $img->name != "") {
                return asset('storage/post_image/' . $postID . '/thumb/' . $img->name);
            }
            return asset('storage/default/picture.png');
        }
        return asset('storage/default/picture.png');
    }

    public function postMyFavouriteList()
    {

        $userId = Auth::user()->id;

        $favPostId = Favorite::where('user_id', $userId)->pluck('post_id')->toArray();

        $toReturn = array();
        $toReturn['totalData'] = DB::table('advertisement_posts AS ap')
            ->Leftjoin('category as c', 'c.id', '=', 'ap.category_id')
            ->Leftjoin('category as subcat', 'subcat.id', '=', 'ap.sub_category_id')
            // ->Leftjoin('favorites as fav','fav.post_id','=','ap.id')
            ->Leftjoin('cities as city', 'city.id', '=', 'ap.city_id')
            ->Leftjoin('states as state', 'state.id', '=', 'ap.state_id')
            ->select('ap.id as id', 'c.name as category', 'subcat.name as sabcategory', 'ap.title as title', 'ap.publish_date as publish_date', 'ap.status as status', 'ap.price as price', 'ap.slug as slug', 'city.name as city_name', 'state.name as state_name', 'c.slug as parent_slug')
            ->where('ap.status', 'approved')
            ->whereIn('ap.id', $favPostId)
            ->where('ap.deleted_at', '=', null)
            ->orderBy('ap.id', 'desc')
            ->paginate(12);
        // dd( $toReturn['totalData']);

        foreach ($toReturn['totalData'] as $skey => &$value) {
            $value->image_path = $this->getImage($value->id);
            if (Auth::user()) {
                $value->is_fav = $this->getFav($value->id);
            } else {
                $value->is_fav = "No";
            }
        }

        return view('websiteview.post.my_favourit', $toReturn);

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

    public function editPost($id)
    {


        $userId = Auth::user()->id;

        $this->data['posts'] = AdvertisementPost::where('user_id', $userId)
            ->where('deleted_at', '=', null)
            ->where('status', '!=', 'expired')
            ->findOrfail($id);

        $created_date = $this->data['posts']->created_at;

        $this->data['expired_date'] = date('d-m-Y', strtotime($created_date . ' + 60 day'));
//        dd( $this->data['expired_date']);

        $this->data['category'] = Category::where('parent_id', '0')->orderBy('name', 'ASC')->where('is_active', 'Yes')->get();

        $this->data['subcategory'] = Category::where('parent_id', $this->data['posts']->category_id)->orderBy('name', 'ASC')->get();

        $postAttribute = DB::table('post_attributes')
            ->where('category_id', $this->data['posts']->category_id)
            ->where('sub_category_id', $this->data['posts']->sub_category_id)
            ->first();

        $this->data['brand'] = Brand::where('category_id', $this->data['posts']->category_id)
            ->where('sub_category_id', $this->data['posts']->sub_category_id)->get();


        $this->data['attr'] = array();
        if (!empty($postAttribute)) {
            $this->data['attr'] = DB::table('attibute_fields as af')
                ->join('advertisement_post_attributes as apa', 'af.id', '=', 'apa.attribute_id')
                ->select('af.name as name', 'af.id as id', 'apa.field_value as field_value')
                ->where('apa.advertisement_post_id', $this->data['posts']->id)
                ->where('af.attribute_id', $postAttribute->id)
                ->get();

        }


//        $this->data['state'] = DB::table('states')->where('country_id', '101')->where('id', $this->data['posts']->state_id)->get();

//        $this->data['cityes'] = DB::table('cities')->where('state_id', $this->data['posts']->state_id)->get();


        return view('websiteview.post.post_edit', $this->data);
    }

    public function createPost()
    {
//        dd(Auth::user()->id);


        if (Auth::user()->personal_state == "" || Auth::user()->personal_city == "" || Auth::user()->personal_state == "0" || Auth::user()->personal_city == "0") {
            return redirect()->route('profile.front')->with('danger', "Please fill first profile settings.");
        }
//        $userId = Auth::user()->personal_city;
//        dd( $userId );

        //get login user id

        $userId = Auth::user()->id;
        $this->data['user'] = User::find($userId);

        $this->data['category'] = Category::where('parent_id', '0')->orderBy('name', 'ASC')->where('is_active', 'Yes')->get();
//        $this->data['state'] = DB::table('states')->where('country_id', '101')->get();


        // $this->data['cityes'] = DB::table('cities')->get();

        return view('websiteview.post.post_create', $this->data);

    }

    public function image($id)
    {

        //dd($id);
        $userId = Auth::user()->id;

        AdvertisementPost::where('id', $id)
            ->where('user_id', $userId)
            ->where('deleted_at', '=', null)
            ->where('status', '!=', 'expired')
            ->findOrfail($id);

        // \Storage::delete('public/storage/post_image/2/1.jpg');
//        dd(1);
        $this->data['gallery'] = PostImage::where('post_id', $id)->orderBy('position', 'asc')->get();
        //dd($this->data['gallery']);
        return view('websiteview.post.image', $this->data);
    }

    public function positionImage(Request $request, $package_id)
    {


        //dd($request->all());

        $postion = $request->input('image_id', []);

        if ($postion) {

            $postionIndex = 0; // start index with 0 ;

            foreach ($postion as $key => $value) {

                if ($value == '' || is_null($value)) {
                    continue;
                }

                $image = PostImage::where('id', $value)->first();

                if ($image) {
                    $image->position = $postionIndex;
                    $image->save();
                    $postionIndex++;
                }

            }
        }

        return response()->json([
            'message' => 'sortable succefully.',
            'success' => true
        ]);

    }

    public function imageStore(Request $request)
    {
        // dd($request->all());
        $userID = Auth::user()->id;
        //dd($request->file('file'));

        $originalPath = public_path('storage/post_image/' . $request->post_id . '/');
        $originalPathThumb = public_path('storage/post_image/' . $request->post_id . '/thumb/');

        if (!File::isDirectory($originalPath)) {
            File::makeDirectory($originalPath, 0777, true, true);
        }
        if (!File::isDirectory($originalPathThumb)) {
            File::makeDirectory($originalPathThumb, 0777, true, true);
        }
        $originalImage1 = collect($request->file('file'));

        foreach ($originalImage1 as $key => $originalImage) {
            # code...

            $thumbnailImage = Image::make($originalImage);
            $fileName = rand(10, 100) . time() . str_replace(' ', '', $originalImage->getClientOriginalName());
            $filePath = $originalPath . $fileName;

            $fileUlr = 'post_image/' . $request->post_id . '/' . $fileName;

            $fileUlrThumb = 'post_image/' . $request->post_id . '/thumb' . $fileName;

            //for water mark in image in original
            $watermark = Image::make(public_path('storage/default/watermark.png'));
            $thumbnailImage->insert($watermark, 'bottom-right', round(10), round(10));

            $thumbnailImage->save($filePath, 80);


            $thumbnailImageThumb = Image::make($originalImage);
            $fileNameThumb = time() . $originalImage->getClientOriginalName();
            $filePathThumb = $originalPathThumb . $fileName;

            $fileUlrThumb = 'post_image/' . $request->post_id . '/thumb/' . $fileName;
            $thumbnailImageThumb->resize(255, 161)->save($filePathThumb);


            $imagepos = PostImage::where('post_id', $request->post_id)->max('position');

            $gallery = new PostImage();
            $gallery->user_id = $userID;
            $gallery->post_id = $request->post_id;
            $gallery->position = $imagepos === NULL ? 0 : $imagepos + 1;
            $gallery->name = $fileName;
            $gallery->path = $fileUlr;
            $gallery->thumb_path = $fileUlrThumb;
            $gallery->save();
        }
        $html = $this->galleryList($request->post_id);


        $post = AdvertisementPost::where('user_id', $userID)->where('id', $request->post_id)->first();
        $post->status = "pending";
        $post->save();


        return response()->json(['success' => $originalImage, 'data' => $html]);


    }

    public function galleryList($postId)
    {


        $this->data['gallery'] = PostImage::where('post_id', $postId)->orderBy('position', 'asc')->get();

        return view('websiteview.post.list', $this->data)->render();
    }

    public function galleryDestroy($id)
    {
        $userID = Auth::user()->id;

        $gal = PostImage::where('id', $id)->where('user_id', $userID)->firstOrFail();


        $post_id = $gal->post_id;
        $userID = Auth::user()->id;

        $gal->delete();
        $status = 200;

        $this->posImg($post_id);

        Storage::delete('public/post_image/' . $post_id . '/' . $gal->name);
        Storage::delete('public/post_image/' . $post_id . '/thumb/' . $gal->name);

        // \Storage::delete('public/package_image/cover/'. $userID.'/' .$gal->name);


        return response()->json([
            'success' => true,
            'message' => 'Image delete successfully'
        ], $status);

    }

    public function posImg($post_id)
    {

        $imagepos = PostImage::where('post_id', $post_id)->orderBy('position', 'asc')->get();

        if ($imagepos->count() < 1) {
            return true;
        }

        foreach ($imagepos as $key => $value) {

            $value->position = $key;

            $value->save();

        }


    }

    public function getSubCategory(Request $request)
    {
        $records = Category::where('parent_id', $request->id)->where('is_active', 'Yes')->orderBy('name', 'ASC')->get();
        return view('admin.include.modal_get_option', ['records' => $records]);
    }

    public function userPostAttribute(Request $request)
    {
        // dd($request->All());

        $postAttribute = DB::table('post_attributes')
            ->where('category_id', $request->category_id)
            ->where('sub_category_id', $request->sub_category_id)
            ->first();


        if (!empty($postAttribute)) {
            $records = DB::table('attibute_fields')
                ->where('attribute_id', $postAttribute->id)
                ->get();

        } else {
            $records = array();

        }

        $data['attribute'] = $records;

        $data['brand'] = Brand::where('category_id', $request->category_id)
            ->where('sub_category_id', $request->sub_category_id)->get();
//        dd($data);

        $attribute = view('admin.include.modal_get_option_post', $data)->render();
        $brand = view('admin.include.modal_get_option_post_brand', $data)->render();

        $data['attribute'] = $attribute;
        $data['brand'] = $brand;
        return $data;


//        return view('admin.include.modal_get_option_post', $data);
    }


    public function select2StatePersonal(Request $request)
    {
        $search = $request->get('search');
        $data = DB::table('states')
            ->where('country_id', '101')
            ->where('name', 'like', '%' . $search . '%')
            ->get();

        return response()->json(['items' => $data->toArray(), 'pagination' => false]);
    }




    public function getCitiesByState(Request $request)
    {
        $records = DB::table('cities')->where('state_id', $request->id)->get();
        return view('admin.include.modal_get_option', ['records' => $records]);
    }


    public function setPost(Request $request)
    {

         //dd($request->all());

        $this->validate($request, [
            'category' => 'required',
            'subcategory' => 'required',
            'title' => 'required',
            'price' => 'required',
//            'description' => 'required',
            'expired_date' => 'required',
        ]);


        $userId = Auth::user()->id;

        $post = new AdvertisementPost();
        $post->user_id = $userId;
        $post->category_id = $request->category;
        $post->sub_category_id = $request->subcategory;
        $post->brand_id = $request->brand;
        $post->title = $request->title;
        $post->price = str_replace(",", "", $request->price);
        $post->description = $request->description;
        $post->state_id = $request->state_id ?? Auth::user()->personal_state;
        $post->city_id = $request->city_id ??Auth::user()->personal_city;
        $post->address = Auth::user()->personal_address;

        //add lat and long
        $post->latitude = Auth::user()->latitude;
        $post->longitude = Auth::user()->longitude;


        $post->publish_date = date('Y-m-d');
        $post->expired_date = date('Y-m-d', strtotime($request->expired_date));
        $title = str_slug($request->title, '-') . time();
        $post->slug = $title;
        $post->save();
        //dd($post->id);

        if (isset($request->grop) && count($request->grop)) {
            foreach ($request->grop as $key => $value) {
                $postAttr = new AdvertisementPostAttribute();
                $postAttr->advertisement_post_id = $post->id;
                $postAttr->attribute_id = $value['attribute_id'];
                $postAttr->field_name = $value['attribute_name'];
                $postAttr->field_value = $value['attribute_value'];
                $postAttr->save();
            }
        }
        return redirect()->route('post.image', ['id' => $post->id]);


        // Session::flash('success',"Post Added successfully.");
        // return redirect()->route('post.list');

        // return Back();


    }

    function myLead()
    {
        $userId = Auth::user()->id;
        $postIds = AdvertisementPost::withTrashed()->where('user_id', $userId)->pluck('id')->toArray();

        $data['lead'] = Lead::whereIn('post_id', $postIds)->orderBy('id', 'desc')->paginate(10);

        return view('websiteview.post.my_lead', $data);

    }
    public function LeadDatalist(Request $request){

       // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'post_name',
            2 => 'name',
            //3 => 'email',
            4 => 'description',
            // 4 => 'action',
        );


        $totalData = Lead::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // dd($request);

        // DB::enableQueryLog();
        // genrate a query
         $userId = Auth::user()->id;
         $postIds = AdvertisementPost::withTrashed()->where('user_id', $userId)->pluck('id')->toArray();

        $customcollections = Lead::whereIn('post_id', $postIds)
        ->when($search, function ($query, $iterm) {
            return $query->where(function ($q) use ($iterm) {
                      $q->where('name', 'LIKE', "%{$iterm}%")
                        ->orWhere('post_name', 'LIKE', "%{$iterm}%")
                        ->orWhere('email', 'LIKE', "%{$iterm}%");
            });
        });

         //dd($customcollections);

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        //dd($customcollections);
        $data = [];


        foreach ($customcollections as $key => $item) {

            // dd(route('admin.brand.edit', $item->id));

            $row['id'] = $item->id;
            $row['post_name'] = $item->post_name;
            $row['name'] = $item->name.'<br><small><a><b>Email : </b>'.$item->email.'</a></small>';
           // $row['email'] = $item->email;
            $row['description'] = $item->description;

            // $row['action'] = $this->action([
            //     'edit' => url('/user/edit-post').'/'.$item->id,
            //     'delete' => collect([
            //         'id' => $item->id,
            //         'action' => url('/post-image-destroy').'/'.$item->id,
            //     ]),

            // ]);


            $data[] = $row;

        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        return response()->json($json_data);
    }

    public function imageSaveFinal()
    {

        Session::flash('success', "Post Save successfully.");
        return redirect()->route('user.list');


    }


    public function updatePost(Request $request)
    {
        // dd(12);
        // dd($request->all());

        $post = AdvertisementPost::find($request->id);

        // dd($request->all(),$post);
        $this->validate($request, [
            'category' => 'required',
            'subcategory' => 'required',
            'title' => 'required',
            'price' => 'required',
            'expired_date' => 'required',
        ]);

        $userId = Auth::user()->id;

        $postchk = AdvertisementPost::find($request->id);
        if ($postchk->price != str_replace(",", "", $request->price)) {
            $postchk->status = "pending";
            $postchk->save();
        }


        AdvertisementPostAttribute::where('advertisement_post_id', $request->id)->forceDelete();


        $post = AdvertisementPost::find($request->id);
        $post->category_id = $request->category;
        $post->sub_category_id = $request->subcategory;
        $post->brand_id = $request->brand;
        $post->description = $request->description;
        $post->title = $request->title;
        $post->state_id = $request->state_id ?? Auth::user()->personal_state;
        $post->city_id = $request->city_id ??Auth::user()->personal_city;

//        $post->state_id = $request->state;
//        $post->city_id = $request->city;
        $post->publish_date = date('Y-m-d');
        $post->expired_date = date('Y-m-d', strtotime($request->expired_date));
        // $title = str_slug($request->title, '-').time();
        // $post->slug=$title;
        $post->price = str_replace(",", "", $request->price);
        $post->save();


        if (isset($request->grop) && count($request->grop)) {
            foreach ($request->grop as $key => $value) {
                $postAttr = new AdvertisementPostAttribute();
                $postAttr->advertisement_post_id = $post->id;
                $postAttr->attribute_id = $value['attribute_id'];
                $postAttr->field_name = $value['attribute_name'];
                $postAttr->field_value = $value['attribute_value'];
                $postAttr->save();
            }
        }

        return redirect()->route('post.image', ['id' => $post->id]);
        // Session::flash('success',"Post updated successfully.");
        // return redirect()->route('post.list');


    }


    function destroy($id)
    {
        //dd($id);
        $userID = Auth::user()->id;

        $adPost = AdvertisementPost::where('user_id', $userID)->where('id', $id)->first();

        $adPost1 = $adPost;
        if (empty($adPost1)) {
            abort(403, 'Unauthorized action.');
        }


        AdvertisementPostAttribute::where('advertisement_post_id', $id)->delete();
        PostImage::where('post_id', $id)->delete();
        AdvertisementPost::find($id)->delete();

        //Session::flash('success', "Post deleted successfully.");
        return response()->json([
            'success' => true,
            'message' => "Post deleted successfully."
        ], 200);
        //return redirect()->route('post.list');


    }

    function solved($id)
    {
        $userID = Auth::user()->id;

        $adPost = AdvertisementPost::where('user_id', $userID)->where('id', $id)->first();
        // dd($adPost);
        $adPost1 = $adPost;
        if (empty($adPost1)) {
            abort(403, 'Unauthorized action.');
        }

        $adPost = AdvertisementPost::where('user_id', $userID)->where('id', $id)->first();
        $adPost->is_sold = "Yes";
        $adPost->save();


        Session::flash('success', "Post Status changed successfully.");
        return redirect()->route('user.list');


    }

    public function dataList(Request $request)
    {

        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'image',
            2 => 'title',
            3 => 'status',
            4 => 'action',
        );


        $totalData = AdvertisementPost::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // dd($request);

        // DB::enableQueryLog();
        // genrate a query
         $userId = Auth::user()->id;
        // $this->data['totalData'] = DB::table('advertisement_posts AS ap')
        //     ->Leftjoin('category as c', 'c.id', '=', 'ap.category_id')
        //     ->Leftjoin('category as subcat', 'subcat.id', '=', 'ap.sub_category_id')
        //     ->select('ap.id as id', 'c.name as category', 'subcat.name as sabcategory', 'ap.title as title', 'ap.publish_date as publish_date', 'ap.status as status', 'ap.price as price', 'ap.expired_date as expired_date', 'ap.is_sold as is_sold')
        //     ->where('ap.user_id', $userId)
        //     ->where('ap.deleted_at', '=', null)
        //     ->orderBy('id', 'desc')
        //     ->paginate(10);


        // foreach ($this->data['totalData'] as $skey => &$value) {
        //     $value->image_path = $this->getImagePathPost($value->id);
        // }

        $customcollections = AdvertisementPost::with('rel_category')
        ->where('user_id', $userId)
        ->where('deleted_at', '=', null)
        ->when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', "%{$search}%");
        });

         //dd($customcollections);

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        //dd($customcollections);
        $data = [];


        foreach ($customcollections as $key => $item) {

            // dd(route('admin.brand.edit', $item->id));

            $row['id'] = $item->id;
            if($item->status == 'pending'){
                $statusVal = "badge-warning";
            }elseif ($item->status=='approved') {
                $statusVal = "badge-success";
            }elseif($item->status=='canceled'){
                $statusVal = " badge-danger";
            }else{
                $statusVal = "badge-secondary";
            }

            $price =  Helper::commonMoneyFormat($item->price);
            $expiredDate = date('d M, Y', strtotime($item->expired_date));
            // $currency =  Helper::commonCurrency();
            $row['image'] =   "<div class=''>
            <img width='70' width='70' src='{$this->getImagePathPost($item->id)}'>
            <a><b>$price</b></a><br>

            </div>";
            $row['title'] = $item->title.'<br><small><a><b>Ad Expire : </b>'.$expiredDate.'</a></small>';

            if($item->is_sold=="No"){
                        $statusName = ucfirst($item->status);
            $row['status'] = "<span class='badge {$statusVal}' > $statusName </span>";
            }else{
                $row['status'] = "<span class='badge badge-secondary' >Sold</span>";
            }

            if($item->status=='expired' || $item->status=='canceled' || $item->is_sold=="Yes"){
                $editField = 'editblank';
            }else{
                $editField = 'edit';
            }




            $soldField =  ($item->is_sold=='Yes') ? 'markblank' : 'marksold';


                $action = $this->action([
                $editField  => url('/user/edit-post').'/'.$item->id,
                'delete' => collect([
                    'id' => $item->id,
                    'action' => url('/post-image-destroy').'/'.$item->id,
                ]),
                 $soldField => url('/post-image-solved').'/'.$item->id,
            ]);


            $row['action'] = $action;
            $data[] = $row;

        }//endforeach

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        return response()->json($json_data);

    }


}
