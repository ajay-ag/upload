<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
//        Auth::loginUsingId("22");
        return view('websiteview.login.login');
    }

    public function register()
    {
        return view('websiteview.login.register');
    }

    public function changePassword()
    {

        $data['user'] = User::findorfail(Auth::user()->id);


        return view('websiteview.login.change-password', $data);
    }
    public function businessCard()
    {
        $data['user'] = User::findorfail(Auth::user()->id);
        return view('websiteview.login.card-list', $data);
    }
    public function myCard($id,$name="")
    {
        $data['user'] = User::where('id',$id)->firstOrfail();
        if($data['user']->card=="1"){
            return view('websiteview.card.view', $data);
        }elseif($data['user']->card=="2"){
            return view('websiteview.card.view1', $data);
        }elseif($data['user']->card=="3"){
            return view('websiteview.card.view2', $data);
        }
    }
    public function businessCardSet(Request $request)
    {
        $this->validate($request, [
            'card' => 'required',
        ]);

        $user = User::findorfail(Auth::user()->id);
        $user->card=$request->card;
        $user->save();

        Session::flash("success", "Card Save successfully.");
        return back();

    }


    public function changePasswordSet(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'required|same:password'
        ]);

        ///find login user to find user detail
        $user = User::findorfail(Auth::user()->id);



        if (Hash::check($request->old_password, $user->password)) {

            $user->password = Hash::make($request->password);
            try {
                $user->save();
                $flag = TRUE;
            } catch (\Exception $e) {
                $flag = FALSE;
            }
            if ($flag) {
                Session::flash("success", "Password has been changed successfully.");
                return back();
            } else {
                Session::flash('danger', 'Unable to process request this time. Try again later.');
                return back();
            }
        }

        Session::flash('danger', "Your current password do not match in our record. Try to enter valid password");
        return back();

    }

    public function changeStatus(Request $request)
    {


        $statuscode = 400;
       // dd($request->all());
        if ($request->for == "number") {

            $user = User::findorfail(Auth::user()->id);
            $user->show_mobile = $user->show_mobile == 'Yes' ? 'No' : 'Yes';
            $user->save();
            $statuscode = 200;
        } elseif ($request->for == "address") {

            $user = User::findorfail(Auth::user()->id);
            $user->show_address = $user->show_address == 'Yes' ? 'No' : 'Yes';
            $user->save();
            $statuscode = 200;
        }


        return response()->json([
            'success' => true,
            'message' => 'change successfully.'
        ], $statuscode);


    }


    public function RegisterUser(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'mobile' => 'unique:users|required',
            'password' => 'required',
        ]);

        $user = new User();
        $user->mobile = $request->mobile;
        $user->is_active = 'Yes';
        $user->password = Hash::make($request->password);
        $user->otp = $this->generateRandumCode();
        $user->unique_id = (string) Str::uuid();
        $user->save();



        Session::put('user_id', $user->id);


        //meassage string for otp
        $message = "City Post verification code " . $user->otp . " Please do not share your OTP or Password with anyone to avoid misuse of your account";
        $receiver_phone = $request->mobile;

        //sned sms in mobile number
        $this->send_sms($message, $receiver_phone);

        Session::flash('success', "OTP sent to registered mobile number.");
        return redirect('/otp-verify');
    }

    public function generateRandumCode()
    {
        // $rand = substr(md5(microtime()),rand(0,26),6);
        $rand = mt_rand(100000, 999999);
        return $rand;
    }

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

        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Content-Length: ' . strlen($data_json)),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data_json,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0
        ));

        //get response
        $output = curl_exec($ch);


        //Print error if any
        if (curl_errno($ch)) {
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch);
        return $output;
    }

    public function setResetPasswordSave(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'password' => 'required',
        ]);

        $userId = Session::get('user_id');

        $user = User::find($userId);
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::loginUsingId($user->id);
        Session::put('user_id', '');
        return redirect('/');

    }

    //generate randum number for otp 6 Digits

    public function otpVerifyView()
    {
        $userId = Session::get('user_id');
        //if session is not found then redirect main page
        if (empty($userId)) {
            return redirect()->route('users.register');
        }
        return view('websiteview.login.otp_verify');
    }

    public function otpVerify(Request $request)
    {

        $userId = Session::get('user_id');

        $this->validate($request, [
            'otp' => 'required'
        ]);

        $userOtp = User::where('otp', $request->otp)->where('id', $userId)->first();

        if (empty($userOtp)) {
            Session::flash('danger', "OTP is invalid or expired.");
            return Back();
        } else {
            if ($userOtp->otp == $request->otp) {
                $userOtp->is_otp_verify = '1';
                $userOtp->otp = '';
                $userOtp->save();
            }
            Auth::loginUsingId($userOtp->id);
            Session::put('user_id', '');

            // return redirect('/profile');
            return redirect()->route('profile.front');
        }
    }

    public function otpVerifyReset(Request $request)
    {

        $userId = Session::get('user_id');

        $this->validate($request, [
            'otp' => 'required'
        ]);

        $userOtp = User::where('otp', $request->otp)->where('id', $userId)->first();

        if (empty($userOtp)) {
            Session::flash('danger', "OTP is invalid or expired.");
            return Back();
        } else {
            if ($userOtp->otp == $request->otp) {
                $userOtp->otp = '';
                $userOtp->save();
            }
            return redirect('/set-reset-password');
        }
    }

    public function loginUser(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'mobile' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password])) {


            if (Auth::check() && Auth::user()->is_otp_verify == '0') {
                Session::put('user_id', Auth::user()->id);
                Auth::logout();
                // Session::flash('danger', "Please verify otp.");
                // return Back();
                return redirect('/otp-verify');

            } elseif (Auth::check() && Auth::user()->is_active != 'Yes') {
                Auth::logout();
                Session::flash('danger', "Your account is deactivated.please contact administrator.");
                return Back();

            } else {
                return redirect('/');

            }


            // return redirect('/');
        } else {
            Session::flash('danger', "Enter mobile no or password is invalid.");
            return redirect('/login');
        }
    }


    public function OtpResend()
    {
        //get user id from session
        $userId = Session::get('user_id');

        //if session is not found then redirect register page
        if (empty($userId)) {
            return redirect()->route('users.register');
        }

        $user = User::findOrFail($userId);
        $user->otp = $this->generateRandumCode();
        $user->save();

        //meassage string for otp
        $message = "City Post verification code " . $user->otp . " Please do not share your OTP or Password with anyone to avoid misuse of your account";
        $receiver_phone = $user->mobile;

        //send sms in mobile number
        $this->send_sms($message, $receiver_phone);
//      Session::flash('success',"OTP sent to registered mobile number.");
        return response()->json([
            'success' => true,
            'message' => "OTP sent to registered mobile number."
        ], 200);
//        return back();
    }

    public function check(Request $request)
    {
        $user = User::where('mobile', $request->mobile)->first();
        if ($user) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function resetView()
    {
        return view('websiteview.login.reset-password');
    }

    public function resetOtpView()
    {

        $userId = Session::get('user_id');

        //if session is not found then redirect register page
        if (empty($userId)) {
            return redirect()->route('users.register');
        }
        return view('websiteview.login.otp_verify_forgot');
    }

    public function setResetPassword()
    {
        $userId = Session::get('user_id');

        //if session is not found then redirect register page
        if (empty($userId)) {
            return redirect()->route('users.register');
        }


        return view('websiteview.login.set-password');
    }

    public function forgotUser(Request $request)
    {
        $userOtp = User::where('mobile', $request->mobile)->first();
        if (empty($userOtp)) {
            Session::flash('danger', "Mobile number is not registered.");

        } else {

            if ($userOtp->is_active == "No") {
                Session::flash('danger', "Your account is deactivated.please contact administrator.");
            }


            $userOtp->otp = $this->generateRandumCode();
            $userOtp->save();


            $message = "City Post verification code " . $userOtp->otp . " Please do not share your OTP or Password with anyone to avoid misuse of your account";
            $receiver_phone = $userOtp->mobile;

            //sned sms in mobile number
            $this->send_sms($message, $receiver_phone);
            Session::flash('success', "OTP sent to registered mobile number.");

            Session::put('user_id', $userOtp->id);

            return redirect('/reset-otp-password');

            // return view('websiteview.login.otp_verify_forgot');
        }

        return back();


    }


    public function logoutUser()
    {
        Auth::logout();
        return redirect('/login');
    }


}
