<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use Log;

class ApiController extends Controller
{
    public $successStatus = 200;
    public $response_json = [];
    protected $data = [];
    protected $request;

    /**
     * ApiController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        Log::channel('api')->info($request->all());
        // DB::enableQueryLog();
        $this->request = $request;
        $this->response_json['message'] = 'Success';
        // Log::emergency($request);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseSuccess()
    {
        if (count($this->data)) {
            $this->response_json['data'] = $this->data;
        }
        $this->response_json['status'] = 1;
        // Log::alert('response' , $this->data);
        return response()->json($this->response_json, 200);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseError()
    {
        $this->response_json['data'] = (object)$this->data;
        $this->response_json['status'] = 0;
        return response()->json($this->response_json, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseStatusError()
    {
        $this->response_json['data'] = (object)$this->data;
        $this->response_json['status'] = 99;
        return response()->json($this->response_json, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseSuccessOffer()
    {
        if (count($this->data)) {
            $this->response_json['data'] = $this->data;
        } else {
            $this->response_json['data'] = (object)$this->data;
        }
        $this->response_json['status'] = 1;
        // Log::alert('response' , $this->data);
        return response()->json($this->response_json, 200);

    }

    /**
     * @param $data
     * @return $this
     */
    public function mergeData($data)
    {
        if(is_array($data)) {
            $data = array_merge($this->data, $data);
            $this->data = $data;
        }
        return $this;
    }

    /**
     * @param Type|null $var
     * @return bool
     */
    public function currentuser(Type $var = null)
    {
        return Auth::guard('api')->check() ? Auth::guard('api')->user() : false;
    }

    /**
     * @return int
     */
    public function generateRandumCode()
    {
        // $rand = substr(md5(microtime()),rand(0,26),6);
        $rand = mt_rand(100000, 999999);
        return $rand;
    }

    /**
     * @param $message
     * @param $mobileno
     */
    function send_sms($message, $mobileno)
    {
        $name = "ADIARY";
        $mobileNumber = $mobileno;
        $email = "info@mnstechonogies.com";
        $senderId = "ADIARY";
        $routeId = "8";
        $authKey = "4afd691fc2a15e28b97e676f9876be3";
        $serverUrl = "msg.msgclub.net";
        $this->sendsmsPOST($mobileNumber, $senderId, $routeId, $message, $serverUrl, $authKey);
    }

    /**
     * @param $mobileNumber
     * @param $senderId
     * @param $routeId
     * @param $message
     * @param $serverUrl
     * @param $authKey
     * @return bool|string
     */
    function sendsmsPOST($mobileNumber, $senderId, $routeId, $message, $serverUrl, $authKey)
    {
        //Prepare you post parameters
        $postData = array(
            'mobileNumbers' => $mobileNumber,
            'smsContent' => $message,
            'senderId' => $senderId,
            'routeId' => $routeId,
            "smsContentType" => 'english'
        );

        $data_json = json_encode($postData);

        $url = "http://" . $serverUrl . "/rest/services/sendSMS/sendGroupSms?AUTH_KEY=" . $authKey;
        //$url="http://".$serverUrl."/rest/services/sendSMS/sendCustomGroupSms?AUTH_KEY=".$authKey;

        // init the resource
        $ch = curl_init();

        curl_setopt_array($ch,array(
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Content-Length: '.strlen($data_json)),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data_json,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0
        ));

        //get response
        $output = curl_exec($ch);


        //Print error if any
//        if (curl_errno($ch)) {
//            echo 'error:' . curl_error($ch);
//        }
        curl_close($ch);
        return $output;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function response()
    {
        $this->response_json['data'] = (object)$this->data;
        $this->response_json['status'] = 1;

        return response()->json($this->response_json, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseZero()
    {
        $this->response_json['data'] = (object)$this->data;
        $this->response_json['status'] = 0;

        return response()->json($this->response_json, 200);
    }


}
