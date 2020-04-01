<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\AdvertisementPost;
use App\Model\City;
use App\Model\State;
use App\Traits\DatatablTrait;
use App\User;
use Illuminate\Http\Request;
use App\Helpers\Common as Helper;

class SiteuserController extends Controller
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


        $this->data['title'] = 'Users';
        return view('admin.site_user.index', $this->data);
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
    public function getSiteUser(Request $request){
        $search = $request->get('search');
        $id = $request->get('id');

        $data = User::where('name', 'like', '%' . $search . '%')
        ->get();

        return response()->json($data->toArray());
    }

    public function getUserCity(Request $request){
        $search = $request->get('search');
        $id = $request->get('id');

        $data = City::where('name', 'like', '%' . $search . '%')
        ->get();

        return response()->json($data->toArray());
    }

    public function dataListing(Request $request)
    {
        
        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'image',
            2 => 'name',
            3 => 'mobile',
            4 => 'personal_city',
            5 => 'created_at',
            6 => 'action',
        );

        $totalData = User::leftJoin('cities as ci', 'ci.id', '=', 'users.personal_city')->count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // genrate a query
        $users = User::with('city')
            ->when($request->input('date_from'), function ($query, $iterm) {
                return $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($iterm)));
            })->when($request->input('date_to'), function ($query, $iterm) {
                return $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($iterm)));

            })->when($request->input('user_id'), function ($query, $iterm) {
                return $query->where('id', '=',$iterm);

            })->when($request->input('city_id'), function ($query, $iterm) {
                return $query->where('personal_city', '=',$iterm);

            })->when($search, function ($query, $search) {

                return $query->where('name', 'LIKE', "%{$search}%")
                    ->orwhere('mobile', 'LIKE', "%{$search}%")
                    ->orwhere('email', 'LIKE', "%{$search}%");
            
         
            })->orderBy($order, $dir);


        $totalFiltered = $users->count();

        $data = [];

        $users = $users->offset($start)->limit($limit)->get();
        //dd($users);


        foreach ($users as $ukey => $item) {
           // dd($item);
            $path = $this->getProfileSrc($item->id, $item->profile_image);
            //for set images
            $row['image'] = "<img src='$path' width='50px' height='50px'>";
            $row['id'] = $item->id;
            $row['name'] = $item->name;
            $row['mobile'] = $item->mobile;
            $row['email'] = $item->email;
            $row['personal_city'] = $item->city->name ?? '';
            // $row['platform'] = $item->platform;
            $row['post_count'] = $this->getUserPost($item->id);

            $row['created_at'] = date(Helper::commonDateFromatType(), strtotime($item->created_at));

            $row['status'] = $this->status($item->is_active, $item->id, route('admin.site_user.status'));

            $row['action'] = $this->action([
                'view' => route('admin.site-user.show', $item->id)
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

    public function getProfileSrc($id, $image)
    {

        $imageExist = \Storage::disk('public')->exists('user_profile/' . $id . '/' . $image);

        if ($imageExist && $image != NULL && $image != "") {
            return asset('storage/user_profile/' . $id . '/' . $image);
        }

        return asset('storage/default/no_user.png');
    }

    function getUserPost($user_id)
    {
        return AdvertisementPost::where('status', 'approved')->where('user_id', $user_id)->where('deleted_at', '=', null)->count();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $this->data['title'] = 'User Detail';
        $this->data['user'] = User::find($id);
        ///$this->data['cities'] = City::get();
        //$this->data['state'] = State::get();


        return view('admin.site_user.show', $this->data);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeStatus(Request $request)
    {

        $statuscode = 400;
        $staticpages = User::findOrFail($request->id);
        $staticpages->is_active = $request->status == 'true' ? 'Yes' : 'NO';

        if ($staticpages->save()) {
            $statuscode = 200;
        }
        $status = $request->status == 'true' ? 'active' : 'deactivate';
        $message = 'User status ' . $status . ' successfully.';

        return response()->json([
            'success' => true,
            'message' => $message
        ], $statuscode);

    }
}
