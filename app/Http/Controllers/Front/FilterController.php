<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\ProductSeries;
use DB;
class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $search = $request->get('search');
        if($search!=''){
             $this->data['filter'] =DB::table('product_series AS ps')
               ->LeftJoin('products AS p', 'ps.product_id', '=', 'p.id')
               ->LeftJoin('series AS s', 'ps.series_id', '=', 's.id')
            ->select('ps.product_id  AS id','ps.image AS image','p.name AS name','s.series_name AS sname','ps.slug AS slug')
              ->when($search,function($query,$item) use($search){
                  return $query->where('name', 'like', '%'.$search.'%');
              })->paginate(8);
              $this->data['filter']->appends(['search' => $search]);

        }else {
            return redirect()->back();
        }
     

        
              
              
//dd($this->data['filter']);
       
       
        return view('website.search.search',$this->data);
    }

    public function autoComplete(Request $request){
          $data = Product::select("name")
                ->where("name","LIKE","%{$request->input('query')}%")
                ->get();
   
        return response()->json($data);
    
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
