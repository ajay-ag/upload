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
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=array();
        $this->data['title']='Home Page';
        $category=new Category();
        $data['category']=$category->getCategory();
        $data['sliders'] = Homepagebanner::find(1);
       // dd($data['category']);
     
        return view('websiteview.index',$this->data,$data);
    }


     public function login()
    {
        return view('websiteview.login.login');
    }

     public function category()
    {


        return view('websiteview.category.category');
    }

    public function listingGrid()
    {
        return view('websiteview.listing.listing');
    }

     public function listingGridSingle()
    {
        return view('websiteview.listing.single-listing');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->data['categor']   = Category::where('is_active','Yes')->inRandomOrder()->get();
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
