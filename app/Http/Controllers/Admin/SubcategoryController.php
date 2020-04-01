<?php

namespace App\Http\Controllers\admin;

use App\Model\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\DatatablTrait;
use App\Model\Category;
use App\Model\AdvertisementPost;
use App\Model\PostAttribute;
use Image;
use File;
use Storage;
use Exception;



class SubcategoryController extends Controller
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
          $this->data['title'] = __('subcategory.index_title');
        return view('admin.subcategory.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $this->data['title'] = __('subcategory.create_title');
      $data['category']=Category::where('parent_id',0)->get();
    // $data['vendor']=Vendor::where('status','Active')->get();

        //
      //  return response()->json([ 'html'=> view('admin.category.create')->render() ]);
          return view('admin.subcategory.create',$data,$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $subcategory = new Category();

        $subcategory->name      = $request->name;
        $subcategory->parent_id = $request->category_id;
        $subcategory->is_active ='Yes';
        $subcategory->slug      = $request->slug;
        $subcategory->save();

        return redirect()->route('admin.subcategory.index')->with('success', __('subcategory.success_added_subcategory'));
    }

     public function dataListing(Request $request)
    {

        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'category_name',
            3 => 'is_active',
            4 => 'action',
        );


        $totalData = Category::where('parent_id','!=',0)->count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // dd($request);

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = Category::Join('category as ca','ca.id','=','category.parent_id')
        ->select('ca.name as category_name','category.name','category.id','category.is_active')
        ->where('category.parent_id','!=',0)->when($search, function ($query, $search) {
            return $query->where('category.name', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $customcollections->count();
     $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];
        foreach ($customcollections as $key => $item) {

            // dd(route('admin.brand.edit', $item->id));

            $row['id'] = $item->id;
            $row['name'] = $item->name;
            $row['category_name'] =$item->category_name;


         $row['status'] = $this->status( $item->is_active ,$item->id,route('admin.subcategory.status'));
            $row['action'] = $this->action([
                'edit' => route('admin.subcategory.edit', $item->id),
                'delete' => collect([
                    'id' => $item->id,
                    'action' => route('admin.subcategory.destroy', $item->id),
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $count = 0;
        $count += AdvertisementPost::withTrashed()->where('sub_category_id', $id)->count();
        $count += PostAttribute::where('sub_category_id', $id)->count();
        $this->data['count']=$count;



           $this->data['title'] = __('subcategory.edit_title');
           $data['category']=Category::where('parent_id',0)->get();
        //
          $this->data['subcategory'] = Category::where('parent_id','!=',0)->find($id);
      //  return response()->json([ 'html' => view('admin.category.edit',$this->data)->render() ]);
           return  view('admin.subcategory.edit',$data,$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //


        $subcategory = Category::findOrFail($id);
        $subcategory->name      = $request->name;
        if(isset($request->category_id)){
        $subcategory->parent_id = $request->category_id;
        }

        $subcategory->slug      = $request->slug;
        $subcategory->save();



        $subcategory->save();

        return redirect()->route('admin.subcategory.index')->with('success',__('subcategory.success_update_subcategory'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


         $count = 0;
        $count += AdvertisementPost::withTrashed()->where('sub_category_id', $id)->count();
        $count += PostAttribute::where('sub_category_id', $id)->count();
        $count += Brand::where('sub_category_id', $id)->count();

        if ($count != 0) {
             return response()->json([
                        'success' => false ,
                        'message' => __('category.error_common_relation')
                        ],200);
        }







        $subcategory = Category::findOrFail($id);
        if($subcategory->delete()) {
                         $statuscode = 200;
                        }

                        return response()->json([
                        'success' => true ,
                        'message' => __('subcategory.success_delete_subcategory')
                        ],200);
    }

    public function changeStatus(Request $request) {

        $statuscode = 400;
        $subcategory = Category::findOrFail($request->id);
        $subcategory->is_active  = $request->status == 'true' ? 'Yes' : 'NO' ;

        if($subcategory->save()) {
            $statuscode = 200 ;
        }
        $status = $request->status == 'true' ? 'active' : 'deactivate' ;
        $message = 'Sub Category status '.$status.' successfully.' ;

        return response()->json([
            'success' => true ,
            'message' => $message
        ],$statuscode);

    }
}
