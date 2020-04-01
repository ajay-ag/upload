<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\AdvertisementPost;
use App\Model\Brand;
use App\Model\Category;
use App\Model\PostAttribute;
use App\Traits\DatatablTrait;
use File;
use Illuminate\Http\Request;
use Image;
use Storage;


class CategoryController extends Controller
{
    use DatatablTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['title'] = __('category.index_title');
        return view('admin.category.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->data['title'] = __('category.create_title');
        return view('admin.category.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->icon_name = $request->icon_name;
        if ($request->file('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . rand(0, 500) . '_204X38_' . $file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName);

            $file->storeAs('category', $fileName, ['disk' => 'public']);
            $category->image = $fileName ?? NULL;

        }
//        if($request->file('banner_image')) {
//            $banner_image = $request->file('banner_image');
//            $bannerimageName = time() . '_' . rand(0, 500) . '_64X64_' . $banner_image->getClientOriginalName();
//            $bannerimageName = str_replace(' ', '_',$bannerimageName);
//           $banner_image->storeAs('category/banner_image', $bannerimageName,['disk' => 'public']);
//        }

        // if ($request->file('background_image')) {
        //     $background_image = $request->file('background_image');
        //     $backgroundName = time() . '_' . rand(0, 500) . '_64X64_' . $background_image->getClientOriginalName();
        //     $backgroundName = str_replace(' ', '_', $backgroundName);
        //     $background_image->storeAs('category/background_image', $backgroundName, ['disk' => 'public']);
        // }


//        $category->banner_image  = $bannerimageName ??NULL;
        $category->banner_image = NULL;
       // $category->background_image = $backgroundName ?? NULL;

        $category->save();
        $categoryid = $category->id;

        $location = $file->storeAs('category/' . $categoryid . '/', $fileName, ['disk' => 'public']);
//        $location1 = $banner_image->storeAs('category/banner_image/'.$categoryid.'/',$bannerimageName, ['disk' => 'public']);

       // $location2 = $file->storeAs('category/background_image/' . $categoryid . '/', $backgroundName, ['disk' => 'public']);


        Image::make($file)->resize(65, 65)->save('storage/' . $location);
//        Image::make($banner_image)->resize(1920,256)->save('storage/'.$location1);
        //Image::make($background_image)->resize(100, 100)->save('storage/' . $location2);

        return redirect()->route('admin.category.index')->with('success', __('category.success_added_category'));
    }

    public function dataListing(Request $request)
    {

        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'image',
            3 => 'status',
            4 => 'action',
        );


        $totalData = Category::where('parent_id', 0)->count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // dd($request);

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = Category::where('parent_id', 0)->when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];


        foreach ($customcollections as $key => $item) {

            // dd(route('admin.brand.edit', $item->id));

            $row['id'] = $item->id;
            $row['name'] = $item->name;
            $row['image'] = $this->image('category', $item->image, '25%');
            $row['post_count'] = $this->getUserPost($item->id);


            $row['status'] = $this->status($item->is_active, $item->id, route('admin.category.status'));
            $row['action'] = $this->action([
                'edit' => route('admin.category.edit', $item->id),
                'delete' => collect([
                    'id' => $item->id,
                    'action' => route('admin.category.destroy', $item->id),
                ])
            ]);
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

    function getUserPost($id)
    {

        return AdvertisementPost::where('status', 'approved')->where('category_id', $id)->where('deleted_at', '=', null)->count();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $this->data['category'] = Category::find($id);
        $this->data['title'] = __('category.edit_title');


        //  return response()->json([ 'html' => view('admin.category.edit',$this->data)->render() ]);
        return view('admin.category.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //dd($request->all());

        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->icon_name = $request->icon_name;
        
        if ($request->file('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . rand(0, 500) . '_720X480_' . $file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName);

            $fileName2 = time() . '_' . rand(0, 500) . '_412X272_' . $file->getClientOriginalName();
            $fileName2 = str_replace(' ', '_', $fileName2);

            $file->storeAs('category', $fileName, ['disk' => 'public']);
            \Storage::delete('public/category/' . $category->image);
            \Storage::delete('public/category/' . $id . '/' . $category->image);


            $category->image = $fileName;
            $categoryid = $id;
            $location = $file->storeAs('category/' . $categoryid . '/', $fileName, ['disk' => 'public']);
            Image::make($file)->resize(65, 65)->save('storage/' . $location);

        }

        // if ($request->file('background_image')) {
        //     $file = $request->file('background_image');
        //     $fileName_background = time() . '_' . rand(0, 500) . '_720X480_' . $file->getClientOriginalName();
        //     $fileName_background = str_replace(' ', '_', $fileName_background);

        //     $fileName_background = time() . '_' . rand(0, 500) . '_412X272_' . $file->getClientOriginalName();
        //     $fileName_background = str_replace(' ', '_', $fileName_background);

        //     $file->storeAs('category/background_image', $fileName_background, ['disk' => 'public']);
        //     \Storage::delete('public/category/background_image/' . $id . '/' . $category->background_image);


        //     $category->background_image = $fileName_background;
        //     $categoryid = $id;
        //     $location = $file->storeAs('category/background_image/' . $categoryid . '/', $fileName_background, ['disk' => 'public']);
        //     Image::make($file)->resize(100, 100)->save('storage/' . $location);

        // }

//        if($request->file('banner_image')) {
//            $file = $request->file('banner_image');
//        $fileName_bannerimage = time() . '_' . rand(0, 500) . '_720X480_' . $file->getClientOriginalName();
//            $fileName_bannerimage = str_replace(' ', '_', $fileName_bannerimage);
//
//            $fileName_bannerimage = time() . '_' . rand(0, 500) . '_412X272_' . $file->getClientOriginalName();
//            $fileName_bannerimage = str_replace(' ', '_', $fileName_bannerimage);
//
//            $file->storeAs('category/banner_image', $fileName_bannerimage,['disk' => 'public']);
//            \Storage::delete('public/category/banner_image/'.$id.'/' . $category->banner_image);
//
//
//            $category->banner_image = $fileName_bannerimage;
//            $categoryid = $id;
//            $location = $file->storeAs('category/banner_image/'.$categoryid.'/',$fileName_bannerimage, ['disk' => 'public']);
//            Image::make($file)->resize(1920,256)->save('storage/'.$location);
//
//        }

        $category->save();

        return redirect()->route('admin.category.index')->with('success', __('category.success_update_category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $count = 0;
        $count += Category::where('parent_id', $id)->count();
        $count += AdvertisementPost::withTrashed()->where('category_id', $id)->count();
        $count += PostAttribute::where('category_id', $id)->count();
        $count += Brand::where('category_id', $id)->count();

        if ($count != 0) {
            return response()->json([
                'success' => false,
                'message' => __('category.error_common_relation')
            ], 200);
        }


        $category = Category::findOrFail($id);

        \Storage::delete('public/category/' . $category->image);
        \Storage::deleteDirectory('public/category/' . $id);

        \Storage::delete('public/category/background_image/' . $id . '/' . $category->background_image);
        \Storage::deleteDirectory('public/category/background_image/' . $id);

//                   \Storage::delete('public/category/banner_image/'.$id.'/'.$category->banner_image);
//                  \Storage::deleteDirectory('public/category/banner_image/'.$id);

        if ($category->delete()) {
            $statuscode = 200;
        }

        return response()->json([
            'success' => true,
            'message' => __('category.success_delete_category')
        ], 200);
    }

    public function changeStatus(Request $request)
    {

        $statuscode = 400;
        $category = Category::findOrFail($request->id);
        $category->is_active = $request->status == 'true' ? 'Yes' : 'NO';

        if ($category->save()) {
            $statuscode = 200;
        }
        $status = $request->status == 'true' ? 'active' : 'deactivate';
        $message = 'Category status ' . $status . ' successfully.';

        return response()->json([
            'success' => true,
            'message' => $message
        ], $statuscode);

    }
}
