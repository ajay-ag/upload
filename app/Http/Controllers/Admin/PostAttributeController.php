<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\DatatablTrait;
use App\Model\Category;
use App\Model\PostAttribute;
use App\Model\AttibuteField;
use App\Model\AdvertisementPostAttribute;

use Image;
use File;
use Storage;
use Exception;
use DB;
class PostAttributeController extends Controller
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
        return view('admin.postAttrubute.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['category']=Category::where('parent_id','0')->orderBy('name','ASC')->where('is_active','Yes')->get();
         return view('admin.postAttrubute.create',$this->data);
    
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
            'attribute_list.*.name' => 'required',
        ],[
           // 'attribute_list.*.name.required'=>'Name field is required.'
        ]);

// dd($request->All());
        $post = new PostAttribute();
        $post->category_id = $request->category;
        $post->sub_category_id = $request->subcategory;
        $post->save();


         if(isset($request->attribute_list) && count($request->attribute_list)){
          foreach ($request->attribute_list as $key => $value) {
            # Arrary in assigne attribute...
            $attibuteField = new AttibuteField();
            $attibuteField->attribute_id = $post->id;
            $attibuteField->name = $value['name'];
            $attibuteField->save();
        }
      }

      
        return redirect()->route('admin.post-attribute.index')->with('success' , "Post Attribute added successfully.");
    }


    public function dataListing(Request $request)
    {

        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'category_id',
            2 => 'sub_category_id',
            5 => 'action',
        );


        $totalData = DB::table('post_attributes AS pa')
                         ->leftjoin('category as c','c.id','=','pa.category_id')   
                         ->leftjoin('category as sb','sb.id','=','pa.sub_category_id')   
                         ->select('pa.id AS id','c.name as category','sb.name AS subcat_name')
                         ->count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // dd($request);

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = DB::table('post_attributes AS pa')
                         ->leftjoin('category as c','c.id','=','pa.category_id')   
                         ->leftjoin('category as sb','sb.id','=','pa.sub_category_id')   
                         ->select('pa.id AS id','c.name as category','sb.name AS subcat_name')
                         ->when($search, function ($query, $search) {
            return $query->where('c.name', 'LIKE', "%{$search}%")
                    ->orwhere('sb.name', 'LIKE', "%{$search}%");
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
          
            $row['action'] = $this->action([

                'edit' => route('admin.post-attribute.edit', $item->id),
                'delete' => collect([
                    'id' => $item->id,
                    'action' => route('admin.post-attribute.destroy', $item->id),
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
        $this->data['attribute'] = PostAttribute::find($id);
        $this->data['category']=Category::where('parent_id','0')->where('is_active','Yes')->orderBy('name','ASC')->get();

         $this->data['sub_category']=Category::where('parent_id', $this->data['attribute']->category_id)->orderBy('name','ASC')->get();
          $count = AttibuteField::where('attribute_id',$id)->count();
         $this->data['count'] =  $count==0 ? true : false;

         // dd( $this->data['count'] );

         $this->data['attribute_list'] = AttibuteField::where('attribute_id',$id)->orderBy('id','ASC')->get();

         return  view('admin.postAttrubute.edit',$this->data);
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
        ],[
           // 'attribute_list.*.name.required'=>'Name field is required.'
        ]
    );


        $post =  PostAttribute::find($id);
        $post->category_id = $request->category;
        $post->sub_category_id = $request->subcategory;
        $post->save();


     if(isset($request->attribute_list) && count($request->attribute_list)>0)
       {
           $idsarray=collect($request->attribute_list)->pluck('id')->toArray();
           $ids=array_filter($idsarray);

           if(!empty($ids) && count($ids)>0){
               $getIdes= AttibuteField::where('attribute_id',$id)->whereNotIn('id', $ids)->delete();
           }
       }else{
          $getIdes= AttibuteField::where('attribute_id',$id)->delete();
       }


         if(isset($request->attribute_list) && count($request->attribute_list)){

          foreach ($request->attribute_list as $key => $value) {

                  if(isset($value['id']) && !empty($value['id'])){
                         $attibuteField= AttibuteField::find($value['id']);                               
                    }else{
                          $attibuteField= new AttibuteField();    
                  }

            # Arrary in assigne attribute...
            $attibuteField->attribute_id = $post->id;
            $attibuteField->name = $value['name'];
            $attibuteField->save();
        }
      }
        return redirect()->route('admin.post-attribute.index')->with('success' , "Post Attribute updated successfully.");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function relation(Request $request)
    {
        

          $count = AdvertisementPostAttribute::withTrashed()->where('attribute_id',$request->id)->count();

        if ($count != 0) {
             return response()->json([
                        'success' => false ,
                        'message' => __('category.error_common_relation')
                        ],200);
        } 

          return response()->json([
                        'success' => true ,
                        'message' => __('category.error_common_relation')
                        ],200);


    }


    public function destroy($id)
    {

        $getAttributeID = AttibuteField::where('attribute_id', $id)->pluck('id')->toArray();

        $count = 0;
        $count += AdvertisementPostAttribute::withTrashed()->whereIn('attribute_id',$getAttributeID)->count();

        if ($count != 0) {
             return response()->json([
                        'success' => false ,
                        'message' => __('category.error_common_relation')
                        ],200);
        } 



     $d=PostAttribute::findOrFail($id);
     AttibuteField::where('attribute_id', $d->id)->delete();
     PostAttribute::findOrFail($id)->delete();
       
        return response()->json([
            'success' => true,
            'message' => 'Post Attribute deleted successfully.'
            ],200);
    }



      
}
