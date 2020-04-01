<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Plan;
use App\Http\Requests\PlanValidation;
use App\Traits\DatatablTrait;
use App\Helpers\Common as Helper;
class PlanController extends Controller
{
    use DatatablTrait ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'Plan' ;
        return view('admin.plan.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanValidation $request)
    {
        //dd($request->all());
        $plan = new Plan();
        $plan->title = $request->title;
        $plan->feature = $request->feature;
        $plan->price = $request->price;
        $plan->save();

        return redirect()->route('admin.plan.index')->with('success' , __('plan.add_plan'));
    }

    public function dataList(Request $request)
    {
        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'title', 
            //2 => 'no_of_package',
            2 => 'price',          
            3 => 'is_active',           
            4 => 'action',                       
        );

        $totalData = Plan::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = Plan::when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', "%{$search}%");
                   
        });

        $totalFiltered = $customcollections->count();
        
        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();
       
        $data = [];
       
        foreach ($customcollections as $key => $item) {
            
            $row['id'] = $item->id;

            $row['title'] =  $item->title;

            //$row['no_of_package'] =  $item->no_of_package;

            $row['price'] =  Helper::commonMoneyFormat($item->price);

            $row['is_active'] = $this->status( $item->is_active , $item->id , route('admin.plan.status' ,['id' => $item->id]));

           // $row['action'] = $this->action([
           //      collect([
           //          'text'=> 'Edit',
           //          'id' => $item->id,
           //          'action' => route('admin.plan.edit', $item->id),
           //          'icon' => 'far fa-edit',           
           //          'permission' => true   
           //      ]),
           //      collect([
           //          'text'=> 'Delete',
           //          'id' => $item->id,
           //          'action' => route('admin.plan.destroy', $item->id),
           //          'icon' => 'far fa-trash-alt',                   
           //          'class' => 'delete-confrim',                   
           //          'permission' => true
           //      ])
           //  ]);
           $row['action'] = $this->action([
                'edit' => route('admin.plan.edit', $item->id),
                'delete' => collect([
                    'id' => $item->id,
                    'action' => route('admin.plan.destroy', $item->id),
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

    public function changeStatus(Request $request,$id)
    {
        $slider = Plan::findOrFail($request->id);
        $slider->is_active  = $request->status == 'true' ? 'Yes' : 'No' ;
        
        if($slider->save()) {
            $statuscode = 200 ;
        }

        $status = $request->status == 'true' ? 'activate' : 'deactivate' ;
        $message = 'Package '.$status.' successfully.' ;

        return response()->json([
            'success' => true ,
            'message' => $message
        ],$statuscode);

    }

    public function checkPlan(Request $request){

       $user = Plan::when($request->id ,function($query, $id) {

        $query->where('id','!=', $id );

       })->where('title','=',$request->get('title') )->first();

        if (is_null($user)) {

            return 'true';
        }
            return 'false';
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
        $this->data['plan'] = Plan::findorfail($id);
        return view('admin.plan.edit',$this->data);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanValidation $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $plan->title = $request->title;
        $plan->feature = $request->feature;
        $plan->price = $request->price;
        $plan->update();

        return redirect()->route('admin.plan.index')->with('success', __('plan.update_plan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Plan::destroy($id);

        return response()->json([
                'success' => true,
                'message' => __('plan.delete_plan'),
            ], 200 );
    }
}
