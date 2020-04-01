<?php

namespace App\Http\Controllers\Admin;

use App\Model\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Common as Helper;
class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['title'] =  'Newsletter' ;
        return view('admin.newsletter.index' , $this->data);
    }

    public function dataListing(Request $request)
    {

        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'created_at',
            2 => 'email',
           // 3 => 'action',
        );

        $totalData = Newsletter::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // genrate a query
        $hsncodees = Newsletter::select('id', 'email', 'created_at')
        ->when($request->to_date && $request->from_date == null, function ($query) use ($request) {
            return $query->where('created_at', 'payment_status<=', date('Y-m-d', strtotime($request->to_date)));
        })
        ->when($request->from_date && $request->to_date == null, function ($query) use ($request) {
            return $query->where('created_at', '>=', date('Y-m-d', strtotime($request->from_date)));
        })->when($request->from_date && $request->to_date, function ($query) use ($request) {
            $from = date('Y-m-d', strtotime($request->from_date));
            $to = date('Y-m-d', strtotime($request->to_date));
            return $query->whereBetween('created_at', array($from, $to));
        })->when($search, function ($query, $search) {
            return $query->where('email', 'LIKE', "%{$search}%");
        })->orderBy($order, $dir);

        $totalFiltered = $hsncodees->count();

        $data = [];

        $hsncodees = $hsncodees->offset($start)->limit($limit)->get();

        foreach ($hsncodees as $key => $item) {
            $row['id'] = $item->id;
            $row['created_at'] = date(Helper::commonDateFromatType(), strtotime($item->created_at));
            
            $row['email'] = $item->email;
            //$row['action'] ='';
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
     * @param  \App\Model\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show(Newsletter $newsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsletter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsletter $newsletter)
    {
        //
    }
}
