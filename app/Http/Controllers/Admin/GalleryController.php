<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Gallery;
use Image;
use File;
use App\Traits\DatatablTrait;
class GalleryController extends Controller
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
        return view('admin.gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->json([ 'html' => view('admin.gallery.create')->render() ]);
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
         $gallery = new Gallery();
    
        if($request->file('slider_image')) {
            $file = $request->file('slider_image');
            $fileName = time() . '_' . rand(0, 500) . '_720X480_' . $file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName);  

            $file->storeAs('gallery',$fileName, ['disk' => 'public']);
            $gallery->gal_image = $fileName ?? NULL;

        }
        $gallery->save();
        $galleryid = $gallery->id;
        $location = $file->storeAs('gallery/'.$galleryid,$fileName, ['disk' => 'public']);
        Image::make($file)->resize(720,480)->save('storage/'.$location);

        return redirect()->route('admin.gallery.index')->with('success' , "Gallery added successfully.");
    }
      public function dataListing(Request $request)
    {

        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'gal_image',
            2 => 'status',
            3 => 'action',
        );


        $totalData = Gallery::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // dd($request);

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = Gallery::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];


        foreach ($customcollections as $key => $item) {
            


            $row['id'] = $item->id;

            $row['gal_image'] = $this->image('gallery',$item->gal_image,'10%');

            $row['status'] = $this->status( $item->is_active , $item->id , route('admin.gallery.status'));
            $row['action'] = $this->action([
                 'edit_modal' => collect([
                    'id' => $item->id,
                    'action' => route('admin.gallery.edit', $item->id),
                    'target' => '#addcategory'
                ]),
                'delete' => collect([
                    'id' => $item->id,
                    'action' => route('admin.gallery.destroy', $item->id),
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
        $this->data['gallery'] = Gallery::find($id);
        return response()->json([ 'html' => view('admin.gallery.edit',$this->data)->render() ]);
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
         $gallery =  Gallery::find($id);
    
        if($request->file('slider_image')) {
            $file = $request->file('slider_image');
            $fileName = time() . '_' . rand(0, 500) . '_720X480_' . $file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName); 
            \Storage::delete('public/gallery/' . $gallery->gal_image);
            \Storage::delete('public/gallery/'.$id.'/'. $gallery->gal_image); 

            $file->storeAs('gallery',$fileName, ['disk' => 'public']);
            $gallery->gal_image = $fileName ?? NULL;
            $galleryid = $gallery->id;
            $location = $file->storeAs('gallery/'.$galleryid,$fileName, ['disk' => 'public']);
            Image::make($file)->resize(720,480)->save('storage/'.$location);

        }
        $gallery->save();
        

        return redirect()->route('admin.gallery.index')->with('success' , "Gallery Updated successfully.");
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
        $gallery = Gallery::findOrFail($id);
       
                  \Storage::delete('public/gallery/' . $gallery->gal_image);
                  \Storage::deleteDirectory('public/gallery/'.$id);
                 if($gallery->delete()) {
                         $statuscode = 200;
                        }
                        
                        return response()->json([
                        'success' => true ,
                        'message' => 'Gallery deleted successfully.'
                        ],200);
    }
    public function changeStatus(Request $request) {
        
        $statuscode = 400;
        $gallery = Gallery::findOrFail($request->id);
        $gallery->is_active  = $request->status == 'true' ? 'Yes' : 'NO' ;
        
        if($gallery->save()) {
            $statuscode = 200 ;
        }
        $status = $request->status == 'true' ? 'active' : 'deactivate' ;
        $message = 'Gallery status '.$status.' successfully.' ;

        return response()->json([
            'success' => true ,
            'message' => $message
        ],$statuscode);

    }
}
