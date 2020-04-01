<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\OurClient;
use Image;
use File;
use App\Traits\DatatablTrait;
class OurClientController extends Controller
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
        return view('admin.ourclient.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->json([ 'html'=> view('admin.ourclient.create')->render() ]);
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
        $ourclient = new OurClient();
        $ourclient->name = $request->name;
        if($request->file('slider_image')) {
            $file = $request->file('slider_image');
            $fileName = time() . '_' . rand(0, 500) . '_204X38_' . $file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName);  

            $file->storeAs('ourclient',$fileName, ['disk' => 'public']);
            $ourclient->ourclient_image = $fileName ?? NULL;

        }
        $ourclient->save();
        $ourclientid = $ourclient->id;
        $location = $file->storeAs('ourclient/'.$ourclientid,$fileName, ['disk' => 'public']);
        Image::make($file)->resize(204,38)->save('storage/'.$location);

        return redirect()->route('admin.ourclient.index')->with('success' , "Our Client added successfully.");
    }

     public function dataListing(Request $request)
    {

        // Listing colomns to show
        $columns = array(
            0 => 'id',
            // 1 => 'name',
            1 => 'ourclient_image',
            2 => 'status',
            3 => 'action',
        );


        $totalData = OurClient::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // dd($request);

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = OurClient::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];


        foreach ($customcollections as $key => $item) {
            
            // dd(route('admin.brand.edit', $item->id));

            $row['id'] = $item->id;
            // $row['name'] = $item->name;
            $row['ourclient_image'] = $this->image('ourclient',$item->ourclient_image,'25%');

            $row['status'] = $this->status( $item->is_active , $item->id , route('admin.ourclient.status'));
            $row['action'] = $this->action([
                 'edit_modal' => collect([
                    'id' => $item->id,
                    'action' => route('admin.ourclient.edit', $item->id),
                    'target' => '#addcategory'
                ]),
                'delete' => collect([
                    'id' => $item->id,
                    'action' => route('admin.ourclient.destroy', $item->id),
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
        $this->data['ourclient'] = OurClient::find($id);
        return response()->json([ 'html' => view('admin.ourclient.edit',$this->data)->render() ]);
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

        $ourclient =  OurClient::find($id);
        $ourclient->name = $request->name;
        if($request->file('slider_image')) {
            $file = $request->file('slider_image');
            $fileName = time() . '_' . rand(0, 500) . '_204X38_' . $file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName);  
            \Storage::delete('public/ourclient/' . $ourclient->ourclient_image);
            \Storage::delete('public/ourclient/'.$id.'/'. $ourclient->ourclient_image);

            $file->storeAs('ourclient',$fileName, ['disk' => 'public']);
            $ourclient->ourclient_image = $fileName ?? NULL;
            $ourclientid = $ourclient->id;
            $location = $file->storeAs('ourclient/'.$ourclientid,$fileName, ['disk' => 'public']);
            Image::make($file)->resize(204,38)->save('storage/'.$location);

        }
        $ourclient->save();
       

        return redirect()->route('admin.ourclient.index')->with('success' , "Our Client updated successfully.");
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
        $ourclient = OurClient::findOrFail($id);
       
                  \Storage::delete('public/ourclient/' . $ourclient->ourclient_image);
                  \Storage::deleteDirectory('public/ourclient/'.$id);
                 if($ourclient->delete()) {
                         $statuscode = 200;
                        }
                        
                        return response()->json([
                        'success' => true ,
                        'message' => 'Our Client deleted successfully.'
                        ],200);
    }

    public function changeStatus(Request $request) {
        
        $statuscode = 400;
        $ourclient = OurClient::findOrFail($request->id);
        $ourclient->is_active  = $request->status == 'true' ? 'Yes' : 'NO' ;
        
        if($ourclient->save()) {
            $statuscode = 200 ;
        }
        $status = $request->status == 'true' ? 'active' : 'deactivate' ;
        $message = 'OurClient status '.$status.' successfully.' ;

        return response()->json([
            'success' => true ,
            'message' => $message
        ],$statuscode);

    }
}
