<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Model\Setting;
use App\Model\Social;
use App\Model\Homepagebanner;
use App\Model\SeoHome;
use App\Model\About;
use App\Model\Service;
use App\Model\ClientReview;
use App\Model\OurClient;
use App\Model\WhyChoose;
use App\Model\Counter;
use App\Model\Gallery;
use App\Helpers\Common as Helper;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        //
         //$staticpage=getStaticpage('1');
        $static_page=Helper::getStaticpage('1');
        $sub_category_array=array();
     


         $data=array();
         $category_column_array=array();

        $this->data['title']='Category';
        $category=new Category();
        $sub_category=$category->getSubcategory();
        // dd($sub_category);


        $category=$category->getCategory();

        if($category->count()>0){
               $num_record=ceil($category->count()/3);
               $first_column=$num_record*1;
               $second_column=$num_record*2;
               foreach($category as $cat_key =>$category_value){
                //echo $cat_key.'<br>';   
                  if($first_column > $cat_key){
                        $category_column_array[0][]=$category_value;
                   }
                   else if($second_column > $cat_key)
                   {
                            $category_column_array[1][]=$category_value;
                   }
                   else
                   {
                     $category_column_array[2][]=$category_value;
                   }
                  }
             
              
        }
        if($sub_category->count()>0)
        {
               $sub_category_array=array();
               foreach($sub_category as $subc_key =>$subcat_item)
               {    
                $sub_category_array[$subcat_item->parent_id][]=array(
                    'name'=>$subcat_item->name,
                    'post_count'=>$subcat_item->post_subcat_count_count,
                    'id'=>$subcat_item->id,
                    'slug'=>$subcat_item->slug);
               }
        }
  
        $data['category']=$category_column_array;
        $data['sub_category']=$sub_category_array;
        $data['static_page']=$static_page;
        
        return view('websiteview.category.category',$this->data,$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        // dd($request->all());
      
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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
