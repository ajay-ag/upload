<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\AdvertisementPost;
use App\Model\PostRemark;
use App\Traits\DatatablTrait;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Image;
use Storage;

class PostRemarkController extends Controller
{
    use DatatablTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.post_remark.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.post_remark.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $PostRemark = new PostRemark();
        $PostRemark->name = $request->name;
        $PostRemark->save();
        return redirect()->route('admin.post-remark.index')->with('success', "Post remark  added successfully.");
    }


    public function dataListing(Request $request)
    {
        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'action',
        );

        $totalData = PostRemark::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // genrate a query
        $customcollections = PostRemark::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        });

        $totalFiltered = $customcollections->count();
        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();
        $data = [];
        foreach ($customcollections as $key => $item) {

            // dd(route('admin.brand.edit', $item->id));

            $row['id'] = $item->id;
            $row['name'] = $item->name;

            $row['action'] = $this->action([

                'edit' => route('admin.post-remark.edit', $item->id),
                'delete' => collect([
                    'id' => $item->id,
                    'action' => route('admin.post-remark.destroy', $item->id),
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
     * @param int $id
     * @return Response
     */


    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $this->data['brand'] = PostRemark::find($id);
        return view('admin.post_remark.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // dd( $request->all());
        $this->validate($request, [

                'name' => 'required',
            ]
        );


        $brand = PostRemark::find($id);
        $brand->name = $request->name;
        $brand->save();


        return redirect()->route('admin.post-remark.index')->with('success', "Post Remark updated successfully.");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */


    public function destroy($id)
    {
        $count = 0;
        $count += AdvertisementPost::withTrashed()->where('post_remark', $id)->count();

        if ($count != 0) {
            return response()->json([
                'success' => false,
                'message' => __('category.error_common_relation')
            ], 200);
        }

        PostRemark::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post Remark deleted successfully.'
        ], 200);
    }


}
