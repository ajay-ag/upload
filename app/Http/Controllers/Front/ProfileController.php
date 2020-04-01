<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;
// use GuzzleHttp\Client;
use Hash;
use Illuminate\Http\Request;
use Session;

class ProfileController extends Controller
{

    public function profile()
    {

        //get login user id
        $userId = Auth::user()->id;
        $this->data['user'] = User::find($userId);

        //get all state
        // $this->data['states'] =   DB::table('states')->get();
        $this->data['personal_country'] = DB::table('countries')->where('id', $this->data['user']->personal_country)->get();
        //dd($this->data['personal_country']);

        $this->data['state_personal'] = DB::table('states')->where('id', $this->data['user']->personal_state)->get();

        $this->data['state_business'] = DB::table('states')->where('id', $this->data['user']->business_state)->get();

        $this->data['cityes_personal'] = DB::table('cities')->where('state_id', $this->data['user']->personal_state)->get();

        $this->data['cityes_business'] = DB::table('cities')->where('state_id', $this->data['user']->business_state)->get();


        return view('websiteview.profile.profile', $this->data);

    }


    public function select2StateHomePage(Request $request)
    {
        $search = $request->get('search');

        //dd($request->all());
        $data = DB::table('advertisement_posts AS ap')
            ->join('cities as c', 'c.id', '=', 'ap.city_id')
            ->where('ap.deleted_at', '=', null)
            ->where('c.name', 'like', '%' . $search . '%')
            ->select('c.name as name', 'c.id as id')
            ->orderBy('c.name', 'ASC')
            ->groupBy('c.id')
            ->get();

        // $data = DB::table('cities')
        //                  ->where('name', 'like', '%' . $search . '%')
        //                 ->get();

        return response()->json(['items' => $data->toArray(), 'pagination' => false]);
    }

    public function select2StatePersonal(Request $request)
    {
        //dd($request->all());
        $search = $request->get('search');
        $id = $request->get('id');
        $data = DB::table('states')
            ->where('country_id', $id)
            ->where('name', 'like', '%' . $search . '%')
            ->get();

        return response()->json(['items' => $data->toArray(), 'pagination' => false]);
    }


    public function getCitiesByState(Request $request)
    {
        $records = DB::table('cities')->where('state_id', $request->id)->get();
        return view('admin.include.modal_get_option', ['records' => $records]);
    }

    public function profileSet(Request $request)
    {

         //dd($request->all());
        $this->validate($request, [
            'personal_name' => 'required',
            'personal_address' => 'required',
            'personal_state' => 'required',
            'personal_city' => 'required',
//            'image' => 'mimes:jpeg,jpg,png,gif | dimensions:width=50,height=50',
            'image' => 'mimes:jpeg,jpg,png,gif',
            // 'business_name' => 'required',
            // 'business_address' => 'required',
            // 'business_state' => 'required',
            // 'business_city' => 'required',
        ]);
//        dd(1);


        // Get ip details
        // $client = new Client();
        // $ipRequest = $client->get('http://ip-api.com/json/');
        // $response = $ipRequest->getBody()->getContents();
        // $ipDetail = json_decode($response);

        // $latitude = $ipDetail->lat;
        // $longitude = $ipDetail->lon;

        $userId = Auth::user()->id;

        $user = User::find($userId);
        $user->name = $request->personal_name;
        $user->email = $request->personal_email;
        $user->personal_address = $request->personal_address;
        $user->personal_country = $request->countriesID;
        $user->personal_state = $request->personal_state;
        $user->personal_city = $request->personal_city;
        $user->business_name = $request->business_name;
        $user->business_address = $request->business_address;
        $user->business_gst = $request->business_gst;
        $user->business_pan = $request->business_pan;
        $user->business_state = $request->business_state;
        $user->business_city = $request->business_city;

        $user->personal_whatapp_mobile = $request->personal_whatapp_mobile;
        $user->business_whatapp_mobile = $request->business_whatapp_mobile;
        $user->business_mobile = $request->business_mobile;
        $user->business_site_url = $request->business_site_url;
        $user->business_email = $request->business_email;
        $user->unique_id = str_slug($request->personal_name, '-');

        //add lat and long
        // $user->latitude = $latitude;
        // $user->longitude = $longitude;

        //  if ($request->file('image')) {
        //     $file = $request->file('image');
        //     $fileName = time() . '_' . rand(0, 500) . '_' . $file->getClientOriginalName();
        //     $fileName = str_replace(' ', '_', $fileName);
        //     $file->storeAs('user_profile/' . $userId, $fileName, ['disk' => 'public']);
        //     \Storage::delete('public/user_profile/' . $userId . '/' . $user->profile_image);
        //     $user->profile_image = $fileName??NULL;
        // }

        if ($request->file('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . rand(0, 500) . '_100X100_' . $file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName);

            \Storage::delete('public/user_profile/' . $userId . '/' . $user->profile_image);
            \Storage::delete('public/user_profile/' . $userId . '/origanal/' . $user->profile_image);

            $user->profile_image = $fileName;

            $location = $file->storeAs('user_profile/' . $userId . '/', $fileName, ['disk' => 'public']);
           $location1 = $file->storeAs('user_profile/' . $userId . '/origanal/', $fileName, ['disk' => 'public']);

            \Image::make($file)->resize(50, 50)->save('storage/' . $location);
            \Image::make($file)->resize(250, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save('storage/' . $location1);

        }


        $user->save();

        Session::flash('success', "Profile updated successfully.");
        return Back();


    }
    public function getCountry(Request $request)
    {
        $search = $request->get('search');
        $data = DB::table('countries')
            ->where('name', 'like', '%' . $search . '%')
            ->get();

        return response()->json(['items' => $data->toArray(), 'pagination' => false]);
    }




}
