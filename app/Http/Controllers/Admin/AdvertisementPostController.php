<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\AdvertisementPost;
use App\Model\AdvertisementPostAttribute;
use App\Model\Category;
use App\Model\PostImage;
use App\User;
use Auth;
use DB;
use File;
use Hash;
use Illuminate\Http\Request;
use Image;
use Session;
use Storage;

class AdvertisementPostController extends Controller
{

    public function index()
    {


        $userId = Auth::user()->id;
        $this->data['totalData'] = DB::table('advertisement_posts AS ap')
            ->Leftjoin('category as c', 'c.id', '=', 'ap.category_id')
            ->Leftjoin('category as subcat', 'subcat.id', '=', 'ap.sub_category_id')
            ->select('ap.id as id', 'c.name as category', 'subcat.name as sabcategory', 'ap.title as title', 'ap.publish_date as publish_date', 'ap.status as status', 'ap.price as price')
            ->where('ap.user_id', $userId)
            ->where('ap.deleted_at', '=', null)
            ->orderBy('id', 'desc')
            ->paginate(5);


        foreach ($this->data['totalData'] as $skey => &$value) {
            $value->image_path = $this->getImagePathPost($value->id);
        }


        $this->data['total_approve'] = DB::table('advertisement_posts AS ap')->where('ap.user_id', $userId)->where('ap.deleted_at', '=', null)->where('status', '=', 'approved')->count();


        $this->data['total_canceled'] = DB::table('advertisement_posts AS ap')->where('ap.user_id', $userId)->where('ap.deleted_at', '=', null)->where('status', '=', 'canceled')->count();

        $this->data['total_panding'] = DB::table('advertisement_posts AS ap')->where('ap.user_id', $userId)->where('ap.deleted_at', '=', null)->where('status', '=', 'pending')->count();


        // dd($this->data['totalData'] );

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

    public function editPost($id)
    {
        $userId = Auth::user()->id;
        $this->data['posts'] = AdvertisementPost::where('user_id', $userId)->find($id);

        $this->data['category'] = Category::where('parent_id', '0')->orderBy('name', 'ASC')->where('is_active', 'Yes')->get();

        $this->data['subcategory'] = Category::where('parent_id', $this->data['posts']->category_id)->orderBy('name', 'ASC')->get();

        $postAttribute = DB::table('post_attributes')
            ->where('category_id', $this->data['posts']->category_id)
            ->where('sub_category_id', $this->data['posts']->sub_category_id)
            ->first();


        $this->data['attr'] = array();
        if (!empty($postAttribute)) {
            $this->data['attr'] = DB::table('attibute_fields as af')
                ->join('advertisement_post_attributes as apa', 'af.id', '=', 'apa.attribute_id')
                ->select('af.name as name', 'af.id as id', 'apa.field_value as field_value')
                ->where('apa.advertisement_post_id', $this->data['posts']->id)
                ->where('af.attribute_id', $postAttribute->id)
                ->get();

        }


        return view('websiteview.post.post_edit', $this->data);
    }

    public function createPost()
    {        //get login user id

        $userId = Auth::user()->id;
        $this->data['user'] = User::find($userId);

        $this->data['category'] = Category::where('parent_id', '0')->orderBy('name', 'ASC')->where('is_active', 'Yes')->get();

        return view('websiteview.post.post_create', $this->data);

    }

    public function image($id)
    {
        // \Storage::delete('public/storage/post_image/2/1.jpg');

        $this->data['gallery'] = PostImage::where('post_id', $id)->orderBy('position', 'asc')->get();
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
        $userID = \Auth::user()->id;
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
            $fileName = time() . $originalImage->getClientOriginalName();
            $filePath = $originalPath . $fileName;

            $fileUlr = 'post_image/' . $request->post_id . '/' . $fileName;

            $fileUlrThumb = 'post_image/' . $request->post_id . '/thumb' . $fileName;
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
        return response()->json(['success' => $originalImage, 'data' => $html]);


    }

    public function galleryList($postId)
    {

        $this->data['gallery'] = PostImage::where('post_id', $postId)->orderBy('position', 'asc')->get();

        return view('websiteview.post.list', $this->data)->render();
    }

    public function galleryDestroy($id)
    {
        $gal = PostImage::where('id', $id)->first();


        $post_id = $gal->post_id;
        $userID = \Auth::user()->id;

        $gal->delete();
        $status = 200;

        $this->posImg($post_id);

        \Storage::delete('public/post_image/' . $post_id . '/' . $gal->name);
        \Storage::delete('public/post_image/' . $post_id . '/thumb/' . $gal->name);

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

        // dd($records);

        return view('admin.include.modal_get_option_post', ['records' => $records]);
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

        // dd($request->all());
        $this->validate($request, [
            'category' => 'required',
            'subcategory' => 'required',
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $userId = Auth::user()->id;

        $post = new AdvertisementPost();
        $post->user_id = $userId;
        $post->category_id = $request->category;
        $post->sub_category_id = $request->subcategory;
        $post->title = $request->title;
        $post->price = $request->price;
        $post->description = $request->description;
        $post->publish_date = date('Y-m-d');
        $title = str_slug($request->title, '-') . time();
        $post->slug = $title;
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


        // Session::flash('success',"Post Added successfully.");
        // return redirect()->route('post.list');

        // return Back();


    }

    public function imageSaveFinal()
    {
        Session::flash('success', "Post Save successfully.");
        return redirect()->route('post.list');
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
        ]);

        //get login user id
        $userId = Auth::user()->id;

        $post = AdvertisementPost::find($request->id);

        AdvertisementPostAttribute::where('advertisement_post_id', $request->id)->forceDelete();


        $post = AdvertisementPost::find($request->id);
        $post->category_id = $request->category;
        $post->sub_category_id = $request->subcategory;
        $post->title = $request->title;

        $post->publish_date = date('Y-m-d');
        $title = str_slug($request->title, '-') . time();
        $post->slug = $title;
        $post->price = $request->price;
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

        AdvertisementPostAttribute::where('advertisement_post_id', $id)->delete();
        PostImage::where('post_id', $id)->delete();
        AdvertisementPost::find($id)->delete();

        Session::flash('success', "Post deleted successfully.");
        return redirect()->route('post.list');


    }


}
