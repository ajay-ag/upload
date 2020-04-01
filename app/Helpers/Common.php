<?php

namespace App\Helpers;

use App\Model\Staticpages;
use App\Model\Setting;
use App\Model\Currency;
use App\User;
use Auth;
use DB;

class Common
{

    public static function getNotification()
    {
        $notify = Auth::user()->unreadNotifications;
        foreach ($notify as $key => $pluck) {
            $a = DB::table('advertisement_posts')->where('slug', $notify[$key]->data['slug'])->first();
            if ($a->status != "approved" || $a->deleted_at != "") {
                $notification = DB::table('notifications')->where('id', $notify[$key]->id)->update(['read_at' => date('Y-m-d H:i:s')]);
            }

            if ($a->status == "expired") {
                $notification = DB::table('notifications')->where('id', $notify[$key]->id)->update(['read_at' => date('Y-m-d H:i:s')]);
            }
        }

        $notify = Auth::user()->unreadNotifications;
        return $notify;
    }


    public static function getStaticpage($id = "")
    {
        $staticpage = Staticpages::where('id', $id)->where('is_active', 'Yes')->first();
        return $staticpage;
    }

    public static function getProfileImage()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        return $user->profile_src;
    }

    public static function getUserImage($userId = "")
    {
        $user = User::find($userId);
        return $user->profile_src;

    }

    public static function getUserDetail($id = "")
    {
        $userdetail = User::Leftjoin('cities as ci', 'ci.id', '=', 'users.personal_city')->where('users.id', $id)->select('users.name as name', 'users.mobile', 'ci.name as cityname', 'users.personal_address', 'users.created_at as created_at', 'users.email as user_email', 'users.show_mobile as show_mobile', 'users.show_address as show_address', 'users.id as user_id')->firstOrFail();
        return $userdetail;

    }

    public static function getAdvertiseDetail($addSulg = "")
    {
        $query = DB::table('advertisement_posts AS ap')
            ->Leftjoin('category as c', 'c.id', '=', 'ap.category_id')
            ->Leftjoin('category as subcat', 'subcat.id', '=', 'ap.sub_category_id')
            ->Leftjoin('cities as city', 'city.id', '=', 'ap.city_id')
            ->Leftjoin('states as state', 'state.id', '=', 'ap.state_id')
            ->select('ap.id as id', 'c.id as category_id', 'c.name as category', 'subcat.name as sabcategory', 'ap.title as title', 'ap.publish_date as publish_date', 'ap.status as status', 'ap.price as price', 'ap.description', 'ap.user_id as user_id', 'ap.slug', 'city.name as city_name', 'state.name as state_name');
        $query = $query->where('ap.status', 'approved');
        $query = $query->where('ap.deleted_at', '=', null);
        $query = $query->where('ap.slug', $addSulg);

        return $data['advertise_detail'] = $query->orderBy('id', 'desc')->first();
    }


    public static function moneyFormatIndiaCommon($amount)
    {
        list ($number, $decimal) = explode('.', sprintf('%.2f', floatval($amount)));
        $sign = $number < 0 ? '-' : '';
        $number = abs($number);
        for ($i = 3; $i < strlen($number); $i += 3) {
            $number = substr_replace($number, ',', -$i, 0);
        }
        return $sign . $number;
    }

    public static function siteDateFormat()
    {
        return array('1' => 'DD-MM-YYYY', '2' => 'YYYY-MM-DD', '3' => 'MM-DD-YYYY');
    }

    public static function commonDateFromat($data)
    {
        $date_format_type = Setting::findOrfail(1)->site_date_format;

        if ($date_format_type == "3") {
            $string = str_replace("-", "/", $data);
            $string = date('Y-m-d', strtotime($string));
        } else {
            $string = date('Y-m-d', strtotime($data));
        }
        return $string;
    }

    public static function commonDateFromatType()
    {
        $date_formet = Setting::findOrfail(1)->site_date_format;

        if ($date_formet == 1) {
            $date2 = "d-m-Y";
        } elseif ($date_formet == 2) {
            $date2 = "Y-m-d";
        } elseif ($date_formet == 3) {
            $date2 = "m-d-Y";
        }

        return $date2;

    }

    public static function commonCurrency()
    {
        $currency_id = Setting::findOrfail(1)->currency_symbol;
        $symbol = Currency::findOrfail($currency_id)->symbol;
        $currency_symbol = $symbol;
        //dd($currency_symbol);
        return $currency_symbol;

    }

    public static function commonMoneyFormat($amount)
    {

        $currency = Setting::findOrfail(1);
        //dd($currency->currency_format);
        // $amout_number = str_replace(',', '', $amount);
        //No of Decimal
        $no_of_decimal = $currency->no_of_decimal;
        //Thousan Separator
        $thousan_separator = $currency->thousan_separator ?? '';

        //Decimal_Separator
        $decimal_separator = $currency->decimal_separator ?? '';

        $currency_id = Setting::findOrfail(1)->currency_symbol;
        $fcurrency = Currency::findOrfail($currency_id);
        $symbol = $fcurrency->decimal_code;

        if ($currency->currency_format == 'right') {

            $formatMoney = number_format((float)$amount, $no_of_decimal, $decimal_separator, $thousan_separator) . '' . $symbol;

        } elseif ($currency->currency_format == 'right_space') {

            $formatMoney = number_format((float)$amount, $no_of_decimal, $decimal_separator, $thousan_separator) . ' ' . $symbol;

        } elseif ($currency->currency_format == 'left') {

            $formatMoney = '<span style="inline-block;">' . $symbol . '</span>' . '<span style="display: inline-block;text-align: right;">' . '' . number_format((float)$amount, $no_of_decimal, $decimal_separator, $thousan_separator) . '</span>';

        } elseif ($currency->currency_format == 'left_space') {

            $formatMoney = '<span style="inline-block">' . $symbol . '</span><span style="display: inline-block;text-align: right;">&nbsp;' . ' ' . number_format((float)$amount, $no_of_decimal, $decimal_separator, $thousan_separator) . '</span>';

        }

        if($fcurrency->code == 'INR') {
            $formatMoney = Self::inrFormat($amount, $no_of_decimal, $decimal_separator, $thousan_separator ,$currency ,$symbol);

        }


        return $formatMoney;
    }


    public static function inrFormat($amount, $no_of_decimal = 0, $decimal_separator='.', $thousan_separator ,$currency,$symbol) {

//        dd($currency);
        $decimals = null;
        $amount = $amount;
        // Extract decimals from amount
        if (($pos = strpos($amount, ".")) !== false) {
            $decimals = substr(round(substr($amount, $pos), $no_of_decimal), 1);
            $amount = substr($amount, 0, $pos);
        }

        // Extract last 3 from amount
        $result = substr($amount, -3);
        $amount = substr($amount, 0, -3);

        // Apply digits 2 by 2
        while (strlen($amount) > 0) {
            $result = substr($amount, -2).$thousan_separator.$result;
            $amount = substr($amount, 0, -2);
        }

        $amount = $result.($decimals ? $decimal_separator : $decimals). str_replace('.','',$decimals) ;

        if ($currency->currency_format == 'right') {

            $formatMoney = $amount. '' . $symbol;

        } elseif ($currency->currency_format == 'right_space') {

            $formatMoney = $amount. ' ' . $symbol;

        } elseif ($currency->currency_format == 'left') {

            $formatMoney = '<span style="inline-block;">' . $symbol . '</span>' . '<span style="display: inline-block;text-align: right;">' . '' . $amount. '</span>';

        } elseif ($currency->currency_format == 'left_space') {

            $formatMoney = '<span style="inline-block">' . $symbol . '</span><span style="display: inline-block;text-align: right;">&nbsp;' . ' ' . $amount. '</span>';

        }

        return $formatMoney ;

    }

}
