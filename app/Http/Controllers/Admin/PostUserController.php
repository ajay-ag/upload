<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Firebase as Firebase;
use App\Model\AdvertisementPost;
use App\Model\AdvertisementPostView;
use App\Model\PostImage;
use App\Model\Setting;
use App\Notifications\ApprovedNotification;
use App\Traits\DatatablTrait;
use App\User;
use File;
use Illuminate\Http\Request;
use App\Helpers\Common as Helper;

class PostUserController extends Controller
{
    use DatatablTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->data['title'] = 'Post';
        return view('admin.user_post.index', $this->data);
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
//dd($request->all());

        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'image',
            2 => 'publish_date',
            3 => 'category',
            4 => 'sabcategory',
            5 => 'user_name',
            6 => 'status',
            7 => 'action',
        );

        $totalData = AdvertisementPost::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // genrate a query
        $users = \DB::table('advertisement_posts AS ap')
            ->Leftjoin('category as c', 'c.id', '=', 'ap.category_id')
            ->Leftjoin('category as subcat', 'subcat.id', '=', 'ap.sub_category_id')
            ->Leftjoin('users as u', 'u.id', '=', 'ap.user_id')
            ->select('ap.id as id', 'c.name as category', 'subcat.name as sabcategory', 'ap.title as title', 'ap.publish_date as publish_date', 'ap.status as status', 'ap.price as price', 'u.name as user_name', 'ap.slug as slug', 'ap.status as status', 'ap.expired_date as expired_date', 'ap.is_sold as is_sold')
            ->when($request->input('status'), function ($query, $iterm) {
                return $query->where('ap.status', '=', $iterm);
            })
            ->when($request->input('date_from'), function ($query, $iterm) {
                return $query->whereDate('ap.publish_date', '>=', date('Y-m-d', strtotime($iterm)));
            })
            ->when($request->input('date_to'), function ($query, $iterm) {
                return $query->whereDate('ap.publish_date', '<=', date('Y-m-d', strtotime($iterm)));
            })
            ->where('ap.deleted_at', '=', null)
            ->when($search, function ($query, $search) {
                return $query->where('c.name', 'LIKE', "%{$search}%")
                    ->orwhere('subcat.name', 'LIKE', "%{$search}%")
                    ->orwhere('ap.title', 'LIKE', "%{$search}%")
                    ->orwhere('u.name', 'LIKE', "%{$search}%");
            })->orderBy($order, $dir);

        $totalFiltered = $users->count();

        $data = [];

        $users = $users->offset($start)->limit($limit)->get();


        foreach ($users as $ukey => $item) {


            $row['id'] = $item->id;


            $path = $this->getImage($item->id);

            $row['image'] = "<img src='$path' width='100px' height='100px'>";
            $row['title'] = $item->title . " <br> <i class='fas fa-eye' style='font-size: smaller;'></i> " . $this->getCount($item->id) . "<br><b>Post Expire:</b><br>" . date('d-m-Y', strtotime($item->expired_date));
            $row['publish_date'] = date(Helper::commonDateFromatType(), strtotime($item->publish_date));

            $row['category'] = $item->category;
            $row['sabcategory'] = $item->sabcategory;

            if ($item->is_sold == "Yes") {
                $row['status'] = ucfirst($item->status) . "<br> <div style='color:green;'>Sold</div>";

            } else {

                $row['status'] = ucfirst($item->status);
            }


            $row['user_name'] = $item->user_name;
            // $row['email'] = $item->email;
            // $row['personal_city'] = $item->personal_city;
            // $row['created_at'] = date('d-m-Y',strtotime($item->created_at));

            // $row['status'] = $this->status( $item->is_active , $item->id , route('admin.site_user.status'));

            if ($item->status == "canceled") {

                $row['action'] = $this->action([
                    'view_front' => url('advertise_detail/view/' . $item->slug),
                    'status_view_modal' => collect([
                        'id' => $item->id,
                        'action' => url('admin/remarkView/' . $item->id),
                        'target' => '#addcategory'
                    ]),
                ]);


            } elseif ($item->status == "expired") {
                $row['action'] = $this->action([
                    'view_front' => url('advertise_detail/view/' . $item->slug),

                ]);
            } else {

                $row['action'] = $this->action([
                    'view_front' => url('advertise_detail/view/' . $item->slug),
                    'status_modal' => collect([
                        'id' => $item->id,
                        'action' => url('admin/post/' . $item->id),
                        'target' => '#addcategory'
                    ]),
                ]);

            }


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

    function getImage($postID)
    {


        $img = PostImage::where('post_id', $postID)->where('position', '0')->first();

        if (!empty($img->name)) {
            $imageExist = File::exists('storage/post_image/' . $postID . '/thumb/' . $img->name);
            if ($imageExist && $img->name != NULL && $img->name != "") {
                return asset('storage/post_image/' . $postID . '/thumb/' . $img->name);
            }
            return asset('storage/default/picture.png');
        }
        return asset('storage/default/picture.png');
    }

    function getCount($postID)
    {
        return AdvertisementPostView::where('post_id', $postID)->count();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'status' => 'required',
            'id' => 'required',
        ]);

        $post = AdvertisementPost::find($request->id);
        $post->status = $request->status;
        $post->note = $request->note;
        $post->post_remark = $request->post_remark;
        $post->save();

        if ($request->status == "approved") {

            $user = User::find($post->user_id);
            $user['title'] = $post->title;
            $user['url'] = "advertise_detail/";
            $user['slug'] = $post->slug;
            $user['post_id'] = $post->id;

            // send notification using the "user" model, when the user receives new message
            $user->notify(new ApprovedNotification($user));

            if ($user->chat_api_key != "") {
                $tokens_list = $user->chat_api_key;
                $this->send_push_notification($tokens_list, $user['title'] . ' Add is live', "Notification", "message", "1", $post->id,$user['title']);
            }


        }

        return redirect()->route('admin.post.index')->with('success', 'Status changed successfully.');

    }


    public function send_push_notification($target_tokens, $message, $title = "", $payload_location = "", $payload_id = "", $postID, $postName)
    {
        //Send to firebase
        $Firebase = new Firebase();
        $api_key = Setting::first();
        $api_key->firebase_api_key;
        $Firebase->api_key($api_key->firebase_api_key);
        $message_field = array("title" => $title, "body" => $message, "icon" => "icon.png", "click_action" => "http://city.demo4project.com/", "post_id" => $postID, "msg_type" => 'add_notification', "post_name" => $postName);

        if ($title != "") {
            $Firebase->title = $title;
        } else {
            $Firebase->title = $this->settingsArray['siteTitle'];
        }
        $Firebase->body = strip_tags($message);
        $payload_data = array();
        if ($payload_location != "") {
            $payload_data['where'] = $payload_location;
        }
        if ($payload_id != "") {
            $payload_data['id'] = $payload_id;
        }
        $payload_data['sound'] = 'default';
        if (count($payload_data) > 0) {
            $Firebase->data = $payload_data;
        }
        $inflated_tokens = $target_tokens;
        $info = $Firebase->sendMessage($inflated_tokens, $message_field);
        //   dd($info);
        //   \Log::info($info);die;
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

        $this->data['post'] = \DB::table('advertisement_posts')->where('id', $id)->first();

        return response()->json(['html' => view('admin.user_post.status', $this->data)->render()]);


    }

    public function remarkView($id)
    {
        //
        $this->data['title'] = 'User Detail';

        $this->data['post'] = \DB::table('advertisement_posts')->where('id', $id)->first();

        return response()->json(['html' => view('admin.user_post.status_remark', $this->data)->render()]);


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
