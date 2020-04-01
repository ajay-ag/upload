<?php

namespace App\Http\Controllers;

use App\Model\AdvertisementPost;
use App\Model\Category;
use App\Model\City;
use App\Model\Country;
use App\Model\Mailsetup;
use App\Model\Series;
use App\Model\State;
use App\Model\SubCategory;
use DB;
use Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function card1()
    {
        return view('view');
    }

    function card2()
    {
        return view('view1');
    }

    function card3()
    {
        return view('view2');
    }

    function symbolicLink()
    {
        \Artisan::call('storage:link');
        echo 'Link created successfully.';
    }

    function cacheClear()
    {
        \Artisan::call('config:cache');
        \Artisan::call('cache:clear');
        echo 'Cache clear successfully.';
    }
    function optimize()
    {

        \Artisan::call('optimize');
        echo 'optimize clear successfully.';

    }


    public function getCountry(Request $request)
    {

        $search = $request->get('search');
        $id = $request->get('id');

        $data = Country::when($id, function ($query, $id) {
            $query->where('id', $id);
        })
            ->where('name', 'like', '%' . $search . '%')
            ->get();

        return response()->json($data->toArray());

    }

    /**
     * for cron post expired
     */
    public function cronForExpired()
    {

        $setting = Mailsetup::where('id', 1)->first();
        $email = $setting->mail_username;

        $data['subject'] = "cron run";
        $data['name'] = "cron run";
        $data['email'] = "cron run";
        $data['phone'] = "cron run";
        $data['message1'] = "cron run";

        Mail::send('websiteview.mail.contact_mail', $data, function ($message) use ($email) {
            $message->to($email, 'City Post for cron test')->subject
            ('City Post for cron test');
            $message->from($email, 'contact');
        });


        $ad = AdvertisementPost::where('deleted_at', '=', null)
            ->whereIn('status', ['approved', 'pending'])
            ->whereDate('expired_date', '<', date('Y-m-d'))
            ->update(array('status' => 'expired'));

    }


    public function getState(Request $request)
    {

        $search = $request->get('search');
        $id = $request->get('id');

        $data = State::when($id, function ($query, $id) {
            $query->where('country_id', $id);
        })
            ->where('name', 'like', '%' . $search . '%')
            ->get();

        return response()->json($data->toArray());
    }


    public function getCity(Request $request)
    {

        $search = $request->get('search');
        $id = $request->get('id');

        $data = City::when($id, function ($query, $id) {
            $query->where('state_id', $id);
        })
            ->where('name', 'like', '%' . $search . '%')
            ->get();
        return response()->json($data->toArray());

    }

    public function getCategory(Request $request)
    {

        $search = $request->get('search');
        $id = $request->get('id');

        $data = Category::when($id, function ($query, $id) {
            $query->where('id', $id);
        })
            ->where('name', 'like', '%' . $search . '%')
            ->get();

        return response()->json($data->toArray());

    }

    public function getSubCategory(Request $request)
    {

        $search = $request->get('search');
        $id = $request->get('id');

        $data = SubCategory::when($id, function ($query, $id) {
            $query->where('category_id', $id);
        })
            ->where('name', 'like', '%' . $search . '%')
            ->get();

        return response()->json($data->toArray());

    }

    public function getBrands(Request $request)
    {

        $search = $request->get('search');
        $id = $request->get('id');

        $data = Brand::when($id && !is_null($id), function ($query, $id) use ($request) {
            $query->where('id', $request->id);
        })
            ->where('name', 'like', '%' . $search . '%')
            ->get();

        return response()->json($data->toArray());

    }

    public function getProduct(Request $request)
    {

        $search = $request->get('search');
        $id = $request->get('id');

        $data = Product::when($id && !is_null($id), function ($query, $id) use ($request) {
            $query->where('id', $request->id);
        })
            ->where('name', 'like', '%' . $search . '%')
            ->get();

        return response()->json($data->toArray());

    }

    public function getSeries(Request $request)
    {

        $search = $request->get('search');
        $id = $request->get('id');

        $data = Series::when($id, function ($query, $id) {
            $query->where('id', $id);
        })
            ->where('series_name', 'like', '%' . $search . '%')
            ->get();

        return response()->json($data->toArray());

    }

    public function common_check_exist(Request $request)
    {

        if ($request->id == "") {
            if ($request->condition_db_field != "") {
                $count = DB::table($request->table)
                    ->where($request->db_field, '=', $request->form_field)
                    ->where($request->condition_db_field, '=', $request->condition_form_field)
                    ->count();
            } else {
                $count = DB::table($request->table)
                    ->where($request->db_field, '=', $request->form_field)
                    ->count();
            }
            if ($count == 0) {
                return 'true';
            } else {
                return 'false';
            }

        } else {
            if ($request->condition_db_field != "") {
                $count = DB::table($request->table)
                    ->where($request->db_field, '=', $request->form_field)
                    ->where('id', '<>', $request->id)
                    ->where($request->condition_db_field, '=', $request->condition_form_field)
                    ->count();
            } else {
                $count = DB::table($request->table)
                    ->where($request->db_field, '=', $request->form_field)
                    ->where('id', '<>', $request->id)
                    ->count();
            }

            if ($count == 0) {
                return 'true';
            } else {
                return 'false';
            }
        }


    }

    function cityForPost(Request $request ) {

        $search = $request->get('search');
        $id = $request->get('id');

        $city = City::when($id, function ($query, $id) {
            $query->where('state_id', $id);
        })
        ->where('name', 'like', '%' . $search . '%')
        ->get();

        return response()->json([
            'items' => $city
        ]);

    }


}
