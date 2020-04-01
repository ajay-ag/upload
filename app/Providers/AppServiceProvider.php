<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Auth;
use View;
use DB;
use App\Model\Setting;
use App\Model\Staticpages;
use App\Model\Social;
use App\Model\Homepagebanner;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        if (\Schema::hasTable('mailsetups')) {

            $mail = DB::table('mailsetups')->first();
            // dd($mail);

            //dd($mail);

            if ($mail) //checking if table is not empty
            {
                $config = array(
                    'driver'     => 'SMTP',
                    'host'       => $mail->mail_host,
                    'port'       => $mail->mail_port,
                    'from'       => array(
                        'address' => $mail->mail_username,
                        'name' => "City Post"
                    ),
                    'encryption' => $mail->mail_encryption,
                    'username'   => $mail->mail_username,
                    'password'   => $mail->mail_password
                    // 'bcc'        => $mail->bcc_mail
                );
                \Config::set('mail', $config);
                // dd(config());
//                dd($config);
            }

        }
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        ini_set('max_execution_time',18000);
        ini_set('memory_limit', '512M'); 

        View::composer('admin.*', function ($view) {
            if (Auth::guard('admin')->check()) {
                $user = Auth::guard('admin')->user();
                $view->with('adminlogin', $user);
            }
            $view->with('setting', Setting::where('id', 1)->first());


        });

         view()->composer('websiteview.*', function ($view) {

            $view->with('social', Social::where('id', 1)->first());
            $view->with('setting', Setting::where('id', 1)->first());
            $view->with('slider', Homepagebanner::where('is_active','Yes')->get());
            $view->with('slider_title', Homepagebanner::find(1));
            $view->with('categories_main', Staticpages::find(10));
            $view->with('categories_list', Staticpages::find(11));
           // dd($view);

           });
         
          $date_formet = Setting::findOrfail(1)->site_date_format;
          if ($date_formet == 1) {
            $date1 = "dd-mm-yyyy";
            $date2 = "d-m-Y";
        } elseif ($date_formet == 2) {
            $date1 = "yyyy-mm-dd";
            $date2 = "Y-m-d";
        } elseif ($date_formet == 3) {
            $date1 = "mm-dd-yyyy";
            $date2 = "m-d-Y";
        }
        $data['date_format_datepiker'] = $date1;
        $data['date_format_laravel']   = $date2;
        view()->share($data);

       $timezoneSetting  = Setting::find(1);
       $timezoneSet      = $timezoneSetting->time_zone;
     
        config(['app.timezone' => $timezoneSet]);
        //date_default_timezone_set($timezoneSet);

      

       
    }
}
