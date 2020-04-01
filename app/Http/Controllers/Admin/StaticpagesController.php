<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\DatatablTrait;
use App\Model\Staticpages;
use Image;
use File;
use Storage;
use Exception;



class StaticpagesController extends Controller
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
          $this->data['title'] = __('staticpages.index_title');
        return view('admin.staticpages.index',$this->data);
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
        $staticpages = new Staticpages();
        $staticpages->title = $request->title;
        $staticpages->description = $request->description;


        if($request->file('banner_image')) {
            $banner_image = $request->file('banner_image');
            $bannerimageName = time() . '_' . rand(0, 500) . '_64X64_' . $banner_image->getClientOriginalName();
            $bannerimageName = str_replace(' ', '_',$bannerimageName);
           $banner_image->storeAs('staticpages/banner_image', $bannerimageName,['disk' => 'public']);
        }
        $staticpages->banner_image  = $bannerimageName ??NULL;


        $staticpages->save();
        $staticpagesid = $staticpages->id;
        $location = $banner_image->storeAs('staticpages/banner_image/'.$staticpagesid.'/',$bannerimageName, ['disk' => 'public']);

        Image::make($banner_image)->resize(1920,256)->save('storage/'.$location1);
        return redirect()->route('admin.staticpages.index')->with('success', __('staticpages.success_added_staticpages'));
    }

     public function dataListing(Request $request)
    {

        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'banner_image',
            3 => 'is_active',
            4 => 'action',
        );


        $totalData = Staticpages::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // dd($request);

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = Staticpages::when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];


        foreach ($customcollections as $key => $item) {

            // dd(route('admin.brand.edit', $item->id));

            $row['id'] = $item->id;
            $row['name'] = $item->title;
            $row['banner_image'] = $this->image('staticpages/banner_image',$item->banner_image,'100%');


            $row['status'] = $this->status( $item->is_active , $item->id , route('admin.staticpages.status'));
            $row['action'] = $this->action([
                'edit' => route('admin.staticpages.edit', $item->id),
//                'delete' => collect([
//                    'id' => $item->id,
//                    'action' => route('admin.staticpages.destroy', $item->id),
//                ])
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
        //
        $this->data['staticpages'] =Staticpages::find($id);
        $this->data['title'] = __('staticpages.edit_title');


      //  return response()->json([ 'html' => view('admin.category.edit',$this->data)->render() ]);
           return  view('admin.staticpages.edit',$this->data);
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
        //dd($request->all());

          $staticpages = Staticpages::findOrFail($id);

          $staticpages->title = $request->title;
          $staticpages->description = $request->description;

          if($request->file('banner_image')) {
            $file = $request->file('banner_image');
        $fileName_bannerimage = time() . '_' . rand(0, 500) . '_720X480_' . $file->getClientOriginalName();
            $fileName_bannerimage = str_replace(' ', '_', $fileName_bannerimage);

            $fileName_bannerimage = time() . '_' . rand(0, 500) . '_412X272_' . $file->getClientOriginalName();
            $fileName_bannerimage = str_replace(' ', '_', $fileName_bannerimage);

            $file->storeAs('staticpages/banner_image', $fileName_bannerimage,['disk' => 'public']);
            \Storage::delete('public/staticpages/banner_image/'.$id.'/' . $staticpages->banner_image);


            $staticpages->banner_image = $fileName_bannerimage;
            $staticpagesid = $id;
             $location = $file->storeAs('staticpages/banner_image/'.$staticpagesid.'/',$fileName_bannerimage, ['disk' => 'public']);
            Image::make($file)->resize(1920,256)->save('storage/'.$location);

        }

        $staticpages->save();

        return redirect()->route('admin.staticpages.index')->with('success',__('staticpages.success_update_staticpages'));
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
        $staticpages = Staticpages::findOrFail($id);

        \Storage::delete('public/staticpages/banner_image/'.$id.'/'.$staticpages->banner_image);
                  \Storage::deleteDirectory('public/staticpages/banner_image/'.$id);

                 if($staticpages->delete()) {
                         $statuscode = 200;
                        }

                        return response()->json([
                        'success' => true ,
                        'message' => __('staticpages.success_delete_staticpages')
                        ],200);
    }

    public function changeStatus(Request $request) {

        $statuscode = 400;
        $staticpages = Staticpages::findOrFail($request->id);
        $staticpages->is_active  = $request->status == 'true' ? 'Yes' : 'NO' ;

        if($staticpages->save()) {
            $statuscode = 200 ;
        }
        $status = $request->status == 'true' ? 'active' : 'deactivate' ;
        $message = 'Static page status '.$status.' successfully.' ;

        return response()->json([
            'success' => true ,
            'message' => $message
        ],$statuscode);

    }
}
