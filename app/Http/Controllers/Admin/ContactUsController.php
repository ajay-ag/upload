<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ContactUs;
use App\Traits\DatatablTrait;
use App\Helpers\Common as Helper;
class ContactUsController extends Controller
{
    use DatatablTrait ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['title'] ='Contact Us';
        return view('admin.contact.index', $this->data);
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
    public function dataListing(Request $request)
    {

        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'mobile',
            3 => 'email',
            4 => 'subject',
            5 => 'created_at',
            6 => 'action',
        );

        $totalData = ContactUs::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // genrate a query
        $hsncodees = ContactUs::when($request->input('date_from'), function ($query, $iterm) {
                return $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($iterm)));
                 })->when($request->input('date_to'), function ($query, $iterm) {
                return $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($iterm)));

            })->when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
            })->orderBy($order, $dir);

        $totalFiltered = $hsncodees->count();

        $data = [];

        $hsncodees = $hsncodees->offset($start)->limit($limit)->get();

                    $ds='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis libero ipsum, imperdiet
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis libero ipsum, imperdiet
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis libero ipsum, imperdiet';
        foreach ($hsncodees as $key => $item) {
           
            $row['id'] = $item->id;
            $row['created_at'] =date(Helper::commonDateFromatType(), strtotime($item->created_at));
            $row['name'] = $item->name;
            $row['email'] = $item->email;
            $row['mobile'] = $item->mobile;
            $row['subject'] = $item->subject;
            $row['action'] = "<button tabindex='0' type='button' class='btn btn-secondary fa fa-eye' data-container='body' data-toggle='popover' data-placement='left' data-content='{$item->remarks}' data-trigger='focus'></button>";

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
