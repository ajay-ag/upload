<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BannerValidation;
use App\Model\Homepagebanner;
use App\Traits\DatatablTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomepagebannerController extends Controller
{
    use DatatablTrait ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'Homepagebanners';
        return view('admin.home-page-banner.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $this->data['title'] = 'Homepagebanners' ;
          $this->data['title_banner'] = Homepagebanner::find(1)->title;
          $this->data['content_banner'] = Homepagebanner::find(1)->content;

          $this->data['image1'] = Homepagebanner::find(1);
          $this->data['image2'] = Homepagebanner::find(2);
          $this->data['image3'] = Homepagebanner::find(3);
        return view('admin.home-page-banner.create', $this->data);
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
       
        $slider = Homepagebanner::find(1);
        $slider->title = $request->title;
        $slider->content = $request->description;
        $slider->save();
      

        if ($request->hasFile('image1')) {
            $slider = Homepagebanner::find(1);
            $file = $request->file('image1');
            $fileName = time() . '_' . rand(0, 500) . '_' . $file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName);
            $file->storeAs('banner', $fileName,['disk'=>'public']);
            \Storage::delete('public/banner/' . $slider->slider_img);
            $slider->slider_img = $fileName;
            $slider->save();
        }

         if ($request->hasFile('image2')) {
            $slider = Homepagebanner::find(2);
            $file = $request->file('image2');
            $fileName = time() . '_' . rand(0, 500) . '_' . $file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName);
            $file->storeAs('banner', $fileName,['disk'=>'public']);
            \Storage::delete('public/banner/' . $slider->slider_img);
            $slider->slider_img = $fileName;
            $slider->save();
        }

         if ($request->hasFile('image3')) {
            $slider = Homepagebanner::find(3);
            $file = $request->file('image3');
            $fileName = time() . '_' . rand(0, 500) . '_' . $file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName);
            $file->storeAs('banner', $fileName,['disk'=>'public']);
            \Storage::delete('public/banner/' . $slider->slider_img);
            $slider->slider_img = $fileName;
            $slider->save();
        }

        return redirect()->route('admin.homepagebanners.create')->with('success' , "Banner updated successfully.");

    }

    public function dataListing(Request $request)
    {

        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'image',
            2 => 'title',
            3 => 'status',
            4 => 'action',
        );


        $totalData = Homepagebanner::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // dd($request);

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = Homepagebanner::when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];
        // dd($customcollections);
        foreach ($customcollections as $key => $item) {
            

            $row['id'] = $item->id;
            $row['image'] = $this->image('banner',$item->slider_img, '25%');
            $row['title'] = $item->title;
            $row['status'] = $this->status( $item->is_active , $item->id , route('admin.homepagebanners.status'))  ;
            $row['action'] = $this->action([
                'edit' => route('admin.homepagebanners.edit', $item->id),
                'delete' => collect([
                    'id' => $item->id,
                    'action' => route('admin.homepagebanners.destroy', $item->id),
                ]),
                
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

    public function edit($id)
    {
        $this->data['title'] = 'Homepagebanner edit';
        $this->data['slider'] = Homepagebanner::findOrFail($id);
        return view('admin.home-page-banner.edit', $this->data);

    }

    public function update(BannerValidation $request, $id)
    {

        $slider = Homepagebanner::findOrFail($id);
        $slider->title = $request->title;
        $slider->title_position = $request->title_position;
        $slider->content = $request->content;
        $slider->content_position = $request->content_position;

        if ($request->hasFile('slider_image')) {
            $file = $request->file('slider_image');
            $fileName = time() . '_' . rand(0, 500) . '_' . $file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName);
            $file->storeAs('banner', $fileName,['disk'=>'public']);
            \Storage::delete('public/banner/' . $slider->slider_img);
            $slider->slider_img = $fileName;
        }

        $slider->btn_name = $request->btn_name;
        $slider->btn_url = $request->btn_url;
        $slider->btn_position = $request->btn_position;
        $slider->is_active = $request->status;
        $slider->update();

        return redirect()->route('admin.homepagebanners.index')->with('success', "Banner updated successfully.");

    }

    public function destroy($id)
    {
        $statuscode = 400 ;

        $slider = Homepagebanner::findOrFail($id);

        \Storage::delete('public/banner/' . $slider->slider_img);
        
        if($slider->delete()) {
            $statuscode = 200 ;
        }

        return response()->json([
            'success' => true ,
            'message' => 'Banner deleted successfully.'
        ],$statuscode);

    }

    public function changeStatus(Request $request) {
        
        $statuscode = 400 ;
        $slider = Homepagebanner::findOrFail($request->id);
        $slider->is_active  = $request->status == 'true' ? 'Yes' : 'No' ;
        
        if($slider->save()) {
            $statuscode = 200 ;
        }
        $status = $request->status == 'true' ? 'active' : 'deactivate' ;
        $message = 'Banner '.$status.' successfully.' ;

        return response()->json([
            'success' => true ,
            'message' => $message
        ],$statuscode);

    }

}
