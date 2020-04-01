<?php

namespace App\Http\Controllers\Admin;

use App\Model\AdvertisementPost;
use App\Model\PostAttribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\DatatablTrait;
use App\Model\Category;
use App\Model\Brand;
use App\Model\AdvertisementPostAttribute;

use Image;
use File;
use Storage;
use Exception;
use DB;
class BrandController extends Controller
{
     use DatatablTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['category']=Category::where('parent_id','0')->orderBy('name','ASC')->where('is_active','Yes')->get();
         return view('admin.brand.create',$this->data);

    }

    public function getSubCategory(Request $request)
    {
        $records = Category::where('parent_id',$request->id)->where('is_active','Yes')->orderBy('name','ASC')->get();
        return view('admin.include.modal_get_option',['records'=>$records]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
          $this->validate($request,[
            'category' => 'required',
            'subcategory' => 'required',
            'name' => 'required',

        ]);

        $brand = new Brand();
        $brand->category_id = $request->category;
        $brand->sub_category_id = $request->subcategory;
        $brand->name = $request->name;
        $brand->save();


        return redirect()->route('admin.brand.index')->with('success' , "Brand  added successfully.");
    }


    public function dataListing(Request $request)
    {

        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'category_id',
            2 => 'sub_category_id',
            3 => 'name',
            4 => 'action',
        );


        $totalData = DB::table('brands AS b')
                         ->leftjoin('category as c','c.id','=','b.category_id')
                         ->leftjoin('category as sb','sb.id','=','b.sub_category_id')
                         ->select('b.id AS id','c.name as category','sb.name AS subcat_name','b.name as name')
                         ->count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // dd($request);

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = DB::table('brands AS b')
                         ->leftjoin('category as c','c.id','=','b.category_id')
                         ->leftjoin('category as sb','sb.id','=','b.sub_category_id')
                         ->select('b.id AS id','c.name as category','sb.name AS subcat_name','b.name as name')
                         ->when($search, function ($query, $search) {
            return $query->where('c.name', 'LIKE', "%{$search}%")
                    ->orwhere('sb.name', 'LIKE', "%{$search}%")
                    ->orwhere('b.name', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];


        foreach ($customcollections as $key => $item) {

            // dd(route('admin.brand.edit', $item->id));

            $row['id'] = $item->id;
            $row['category_id'] = $item->category;
            $row['sub_category_id'] = $item->subcat_name;
            $row['name'] = $item->name;

            $row['action'] = $this->action([

                'edit' => route('admin.brand.edit', $item->id),
                'delete' => collect([
                    'id' => $item->id,
                    'action' => route('admin.brand.destroy', $item->id),
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['brand'] = Brand::find($id);
        $this->data['category']=Category::where('parent_id','0')->where('is_active','Yes')->orderBy('name','ASC')->get();

         $this->data['sub_category']=Category::where('parent_id', $this->data['brand']->category_id)->orderBy('name','ASC')->get();


         return  view('admin.brand.edit',$this->data);
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
        // dd( $request->all());
           $this->validate($request,[
            'category' => 'required',
            'subcategory' => 'required',
            'name' => 'required',
        ]
    );


        $brand =  Brand::find($id);
        $brand->category_id = $request->category;
        $brand->sub_category_id = $request->subcategory;
        $brand->name = $request->name;
        $brand->save();


        return redirect()->route('admin.brand.index')->with('success' , "Brand updated successfully.");

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
        $count += AdvertisementPost::withTrashed()->where('brand_id', $id)->count();

        if ($count != 0) {
            return response()->json([
                'success' => false ,
                'message' => __('category.error_common_relation')
            ],200);
        }

        Brand::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Brand deleted successfully.'
            ],200);
    }




}
