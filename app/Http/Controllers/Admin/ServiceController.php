<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\DatatablTrait;
use App\Model\Service;
use Image;
use File;
use Storage;
use Exception;
class ServiceController extends Controller
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
        return view('admin.service.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return view('admin.service.create');
    
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
        $service = new Service();
        $service->service_name = $request->title;
        $service->slug = $request->slug;
        $service->description = $request->content;
    
        if($request->file('slider_image')) {
            $file = $request->file('slider_image');
            $fileName = time() . '_' . rand(0, 500) . '_720X480_' . $file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName); 

            $fileName2 = time() . '_' . rand(0, 500) . '_412X272_' . $file->getClientOriginalName();
            $fileName2 = str_replace(' ', '_', $fileName2);   

            $file->storeAs('service',$fileName, ['disk' => 'public']);

        }

        if($request->file('icon_image')) {
            $file1 = $request->file('icon_image');
            $fileName3 = time() . '_' . rand(0, 500) . '_64X64_' . $file1->getClientOriginalName();
            $fileName3 = str_replace(' ', '_', $fileName3); 

        }

        $service->image = $fileName??NULL ;
        $service->large_img = $fileName2;
        $service->icon_img = $fileName3;
        $service->save();
        $catid = $service->id;
        $location = $file->storeAs('service/'.$catid.'/small',$fileName, ['disk' => 'public']);
        $location1 = $file->storeAs('service/'.$catid.'/large',$fileName2, ['disk' => 'public']);
        $location2 =$file1->storeAs('service/icon/',$fileName3, ['disk' => 'public']);



        Image::make($file)->resize(720,480)->save('storage/'.$location);
        Image::make($file)->resize(412,272)->save('storage/'.$location1);
        Image::make($file1)->resize(64,64)->save('storage/'.$location2);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Category added successfully',

        // ],200);

        return redirect()->route('admin.services.index')->with('success' , "Service added successfully.");
    }

    public function dataListing(Request $request)
    {

        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'service_name',
            2 => 'image',
            3 => 'status',
            4 => 'action',
        );


        $totalData = Service::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // dd($request);

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = Service::when($search, function ($query, $search) {
            return $query->where('service_name', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];


        foreach ($customcollections as $key => $item) {
            
            // dd(route('admin.brand.edit', $item->id));

            $row['id'] = $item->id;
            $row['service_name'] = $item->service_name;
            $row['image'] = $this->image('service',$item->image,'25%');

            $row['status'] = $this->status( $item->is_active , $item->id , route('admin.services.status'));
            $row['action'] = $this->action([
                'edit' => route('admin.services.edit', $item->id),
                'delete' => collect([
                    'id' => $item->id,
                    'action' => route('admin.services.destroy', $item->id),
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
        //
        $this->data['service'] = Service::find($id);
         return  view('admin.service.edit',$this->data);
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
          $service = Service::findOrFail($id);

        $service->service_name = $request->title;
        $service->slug = $request->slug;
        $service->description = $request->content;

        if($request->file('slider_image')) {
            $file = $request->file('slider_image');
            $fileName = time() . '_' . rand(0, 500) . '_720X480_' . $file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName); 

            $fileName2 = time() . '_' . rand(0, 500) . '_412X272_' . $file->getClientOriginalName();
            $fileName2 = str_replace(' ', '_', $fileName2); 

            $file->storeAs('service', $fileName,['disk' => 'public']);
            \Storage::delete('public/service/' . $service->image);
            \Storage::delete('public/service/'.$id.'/small/' . $service->image);
            \Storage::delete('public/service/'.$id.'/large/' . $service->large_img);

            $service->image = $fileName;
            $service->large_img = $fileName2;

            $catid = $id;
            $location = $file->storeAs('service/'.$catid.'/small',$fileName, ['disk' => 'public']);
            $location1 = $file->storeAs('service/'.$catid.'/large',$fileName2, ['disk' => 'public']);
            Image::make($file)->resize(720,480)->save('storage/'.$location);
            Image::make($file)->resize(412,272)->save('storage/'.$location1);
        }
         if($request->file('icon_image')) {
            $file2 = $request->file('icon_image');
            $fileName3 = time() . '_' . rand(0, 500) . '_64X64_' . $file2->getClientOriginalName();
            $fileName3 = str_replace(' ', '_', $fileName3); 

            \Storage::delete('public/service/icon/' . $service->icon_img);
            $service->icon_img = $fileName3;
            $location2 = $file2->storeAs('service/icon/',$fileName3, ['disk' => 'public']);
            Image::make($file2)->resize(64,64)->save('storage/'.$location2);

        }

        

        $service->save();
        return redirect()->route('admin.services.index')->with('success' , "Service updated successfully.");

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
       $servies = Service::findOrFail($id);
       
                  \Storage::deleteDirectory('public/service/'.$id);
                  \Storage::delete('public/service/'. $servies->image);
                 if($servies->delete()) {
                         $statuscode = 200;
                        }
                        
                        return response()->json([
                        'success' => true ,
                        'message' => 'Service deleted successfully.'
                        ],200);
    }

      public function changeStatus(Request $request) {
        
        $statuscode = 400;
        $series = Service::findOrFail($request->id);
        $series->is_active  = $request->status == 'true' ? 'Yes' : 'NO' ;
        
        if($series->save()) {
            $statuscode = 200 ;
        }
        $status = $request->status == 'true' ? 'active' : 'deactivate' ;
        $message = 'Service status '.$status.' successfully.' ;

        return response()->json([
            'success' => true ,
            'message' => $message
        ],$statuscode);

    }
    public function check(Request $request)
    {
       
        $user = Service::where('service_name', $request->title)->first();
            if ($user) {
                 return 'false';
             } else {
                 return 'true';
            }
    }
    public function checkupdate(Request $request)
    {
        $user = Service::where('service_name',$request->title)
        ->where('id','!=',$request->id)->first();
            if ($user) {
                 return 'false';
             } else {
                 return 'true';
            }
    }
}
