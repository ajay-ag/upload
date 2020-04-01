<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Common as Helper;
use App\Http\Controllers\Controller;
use App\libraries\Firebase as Firebase;
use App\Model\Messages;
use App\Model\Setting;
use App\Model\PostImage;
use App\User;
use Auth;
use DB;
use File;
use Illuminate\Http\Request;

class MessagesController extends Controller
{


    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$staticpage=getStaticpage('1');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create_message(Request $request)
    {

        /* start send notification  */

        /* $api_key="AAAAjBhZbtw:APA91bHXkNhX9A2gNAkyuLDoINBRL34sP62CI_aN7LGZkMhwNoTszo8A8wiU4sOlqIVDcnIXR2xN4Oxg7Mm3vQbMhIQThpr-szVwcMnKqIHQyYzutA5rJzlXF8gSGup7RCmDk1w5a3kx";

      //   $firebase->api_key($api_key);

         $tokens_list='dX1f-yG1qGw:APA91bFubaHl_UTTgHzTYBDYZs1NwfO47EwMdCjecG1czdWJZjYuVkl2DM4axWTR07NqqZqoUlGb8bc-UYBVi4C7IgnD5yxk586G9nAHrjt9rOhjwehfnJjXyJiBS3515CIs_SC1bUFg';

       $this->send_push_notification($tokens_list,"Test Message","Chat Message","chat message","1",$api_key);*/

        /* end notification */
        $static_page = Helper::getStaticpage('12');
        $this->data['title'] = 'Message';
        $this->data['send_user_id'] = $request->id;
        if (Auth::user()->id == $this->data['send_user_id']) {
            abort(404, 'not found action.');
        }
        $this->data['static_page'] = $static_page;
        $this->data['to_user_detail'] = array();
        $this->data['advertise_detail'] = array();
        $this->data['toId'] = "";
        $toId = "";
        $userid = Auth::user()->id;
        if ($request->id != "") {
            $toId = $request->id;
            $this->data['toId'] = $toId;
            $this->data['to_user_detail'] = Helper::getUserDetail($toId);
        }
        if ($request->post_slug != "") {
            $this->data['advertise_detail'] = Helper::getAdvertiseDetail($request->post_slug);
            $this->data['advertise_detail']->image_path = $this->getImageThumb($this->data['advertise_detail']->id);
        }
        $after = '';

        $userlist = $this->chat_userlist($userid, $toId);
        //$user_list=Messages::where
        $chat_message = array();
        $chat_message = $this->chat_message_current($userid, $toId, $after);
        $chat_notification = $this->chat_notification($userlist);


        $this->data['chat_message'] = view("websiteview.message.chat_messages", compact('chat_message', 'userid', 'after'))->render();
        $this->data['online_user'] = view("websiteview.message.online_users", compact('userlist', 'toId', 'chat_notification'))->render();
        return view('websiteview.message.list', $this->data);

    }

    function getImageThumb($postID)
    {
        $img = PostImage::where('post_id', $postID)->where('position', '0')->first();

        if (!empty($img->name)) {
            $imageExist = File::exists('storage/post_image/' . $postID . '/thumb/' . $img->name);

            if ($imageExist && $img->name != NULL && $img->name != "") {
                return asset('storage/post_image/' . $postID . '/thumb/' . $img->name);
            }
            return asset('storage/default/no-image-post.png');
        }
        return asset('storage/default/no-image-post.png');
    }

    public function chat_userlist($userid = "")
    {
        $toReturn['userlist'] = array();
        $chat_userlist = Messages::where('userId', $userid)->select('toId', 'fromId');
        $chat_users = array();
        if ($chat_userlist->count()) {
            $chat_userlist = $chat_userlist->get();
            foreach ($chat_userlist as $ukey => $chat_userlist_val) {
                $chat_users[$chat_userlist_val->fromId] = $chat_userlist_val->fromId;
                $chat_users[$chat_userlist_val->toId] = $chat_userlist_val->toId;
            }
        }
        if (count($chat_users) > 0) {
            $userlist = User::whereIn('id', $chat_users)->where('id', '!=', $userid);
            if ($userlist->count() > 0) {
                $toReturn['userlist'] = $userlist = $userlist->get();
            }
        }
        return $toReturn['userlist'];
    }

    public function chat_message_current($fromId = "", $toId = "", $after = "")
    {
        $toReturn = array();
        $toReturn['message'] = DB::select(\DB::raw("SELECT messages.id as id,messages.fromId as fromId,messages.messageText as messageText,messages.dateSent as dateSent,users.name as name,users.id as userId,users.profile_image as photo,ap.title as post_name,ap.price as post_price,ap.id as post_id FROM messages LEFT JOIN advertisement_posts as ap ON messages.post_id=ap.id  LEFT JOIN users ON users.id=messages.fromId where userId='" . $fromId . "' AND ( (fromId='$fromId' OR fromId='$toId' ) AND (toId='$fromId' OR toId='$toId' ) ) AND dateSent>'$after' order by id DESC limit 100 "));

        /* if($after=="" && $toId!="") */
        if ($after == "" && $toId != "0") {
            DB::table('messages')->where('userid', $fromId)->where('fromId', $toId)->where('read_status', 0)->update(array('read_status' => 1));
        } else if ($toId != "0") {
            DB::table('messages')->where('userid', $fromId)->where('fromId', $toId)->where('read_status', 0)->update(array('read_status' => 1));
        }
        return array_reverse($toReturn['message']);
    }

    public function chat_notification($userlist)
    {
        $toReturn = array();
        $fromId = Auth::user()->id;
        if (count($userlist) > 0) {
            foreach ($userlist as $ukey => $userlist_value) {
                $notification_message = Messages::where('userId', $fromId)->where('fromId', $userlist_value->id)->where('read_status', 0)->count();
                if ($notification_message > 0) {
                    $toReturn[$userlist_value->id] = $notification_message;
                }
            }
        }
        return $toReturn;
    }

    public function send_message(Request $request)
    {
        //
        $toReturn = array();
        $userid = Auth::user()->id;
        $userlist = $this->chat_userlist($userid);
        $toUser_detail=User::where('id',$request->send_user_id)->first();

        $sendmessage = new Messages();
        $sendmessage->userId = $userid;
        $sendmessage->fromId = $userid;
        $sendmessage->toId = $request->send_user_id;
        $sendmessage->post_id = $request->post_id;
        $sendmessage->messageText = $request->send_message;
        $sendmessage->read_status = 1;
        $sendmessage->dateSent = time();
        $sendmessage->save();

        $sendmessage = new Messages();
        $sendmessage->userId = $request->send_user_id;
        $sendmessage->fromId = $userid;
        $sendmessage->toId = $request->send_user_id;
        $sendmessage->post_id = $request->post_id;
        $sendmessage->messageText = $request->send_message;
        $sendmessage->dateSent = time();
        $sendmessage->save();

          $tokens_list=$toUser_detail->chat_api_key;
         if($tokens_list!=""){
        $this->send_push_notification($tokens_list,$request->send_message,"New Message","chat message","1");
         }


        // $toReturn['online_user'] = view("websiteview.message.online_users",compact('userlist'))->render();
        // $toReturn['chat_message'] = view("websiteview.message.chat_messages",compact('chat_message'))->render();
        return $toReturn;

    }

    public function online_user_list(Request $request)
    {

        $toReturn = array();
        $chat_message = array();
        $fromId = Auth::user()->id;
        $userid = Auth::user()->id;
        $toId = $request->toId;
        $after = $request->afterdate;
        $userlist = $this->chat_userlist($userid);

        $chat_message = $this->chat_message_current($fromId, $toId, $after);
        $chat_notification = $this->chat_notification($userlist);


        $toReturn['item'] = $chat_message;


        $toReturn['chat_message'] = view("websiteview.message.chat_messages", compact('chat_message', 'userid', 'after'))->render();

        $toReturn['online_user'] = view("websiteview.message.online_users", compact('userlist', 'toId', 'chat_notification'))->render();

        return $toReturn;

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
        // dd($request->all());
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

    public function send_push_notification($target_tokens, $message, $title = "", $payload_location = "", $payload_id = "")
    {
        //Send to firebase
        $Firebase = new Firebase();
        $api_key=Setting::first();
        $api_key->firebase_api_key;
        $Firebase->api_key($api_key->firebase_api_key);
        $message_field = array("title" => $title, "body" => $message, "icon" => "icon.png", "click_action" => "http://city.demo4project.com/");

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
      // dd($info);
       //   \Log::info($info);die;
    }
}
