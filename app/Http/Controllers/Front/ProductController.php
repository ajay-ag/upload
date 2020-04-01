<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Social;
use App\Model\Category;
use App\Model\Product;
use App\Model\Series;
use App\Model\Setting;
use App\Model\ProductSeries;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('website.product.product');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category_id,$product_slug='')
    {
        
       

        $productId = Product::select('id')->where('meta_slug',$product_slug)->first()->id ?? null;
        $catId = Category::select('id')->where('slug',$category_id)->first()->id ?? null;
        $sId = Series::select('id','series_name')->where('slug',$category_id)->first()->id ?? null;
      
     
        $cnm = Category::where('id',$catId)->first()->name ?? null;
        $snm = Series::where('id',$sId)->first()->series_name ?? null;
        $pnm = Product::where('id',$productId)->first()->name ?? null;
        $this->data['categoryname'] =   $cnm ?? $snm;
       
        $this->data['pronm'] = $pnm;

        // if($product_slug == 'series'){
        //     $product_slug = 'series';
          
        // }elseif($product_slug=='category'){
        //     $product_slug = 'category';

        // }else{
        //     $product_slug ='product';
        // }
        // $this->data['from'] =   $product_slug;

        
        $this->data['productnm'] = ProductSeries::whereHas('product', function($q)
        {
           $q->where('is_active', 'Yes');

        })->where(function ($query) use($catId, $sId,$productId) {
            $query->when($productId=='', function ($q) use($catId, $sId){
                return $q->where('category_id',$catId)->orWhere('series_id','=',$sId);
            })
            ->when($productId!='', function ($q)use($productId) {
                $q->where('product_id','=',$productId);
            });
             })->orderBy('product_id','ASC')->paginate(9);
            
       
        /*if ($productId=='') {
            $this->data['productnm'] = ProductSeries::where(function ($query) use($catId, $sId) {

                $query->where('category_id',$catId)
                ->orWhere('series_id','=',$sId);
              
                })->orderBy('id','DESC')->paginate(6);
            
        }else  {
            $this->data['productnm'] = ProductSeries::where(function ($query) use($productId) {

                $query->where('product_id','=',$productId);
              
                })->orderBy('id','DESC')->paginate(6);        
        }*/
        
        //dd($this->data['productnm']);
        $series   = Series::where('is_active','Yes')->get();
        //$this->data['series']   = Series::where('is_active','Yes')->get();
        $newSeriesArr = $series->map(function($item,$index){
            $products = $item->product->map(function($items,$index){
                return $items;
            })->reject(function ($items) {
                return  $items->product->is_active === 'No';
            });

            return[
                'id'=>$item->id,
                'series_name'=>$item->series_name,
                'slug'=>$item->slug,
                'products'=>$products,
            ];


        });
        $this->data['series'] = $newSeriesArr;
        return view('website.product.product',$this->data);

    }

      public function Detailshow($slug)
    {
        
        $rec   = ProductSeries::where('slug',$slug)->first();
        $id    = $rec->id;
        $id1   = $rec->category_id;
        $id2   = $rec->series_id;

        $catId = Category::where('id',$id1)->first();

        $sId = Series::where('id',$id2)->first();
       //dd($sId);
        $this->data['productname'] =  $catId;
        $this->data['seriesname'] =  $sId;
         //$this->data['form'] = 'product';



        

        
        $this->data['detail']    = ProductSeries::where('id',$id)->first();
        $productid = $this->data['detail']->series_id;

        $this->data['related']    = ProductSeries::where('series_id',$productid)->whereNotIn('id',['id',$id])->get();
                       
  
           //dd($this->data['related']);
        $this->data['series']   = Series::all();
        return view('website.product.product-detail',$this->data);

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
