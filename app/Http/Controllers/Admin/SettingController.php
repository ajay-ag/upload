<?php

namespace App\Http\Controllers\Admin;

use App\Model\Setting;
use App\Model\Social;
use App\Model\Country;
use App\Model\Currency;
use App\Model\State;
use App\Model\SeoHome;
use App\Model\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Common as Helper;
use DateTimeZone;
use DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                
            //$this->data['timezonelist'] = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

            //$formatter = new \NumberFormatter(null, \NumberFormatter::CURRENCY);

         $siteDateFormat = Helper::siteDateFormat();
         $this->data['site_date_format'] = $siteDateFormat;
         $this->data['currency_list']  = Currency::get();
         $this->data['title'] = 'Settings';

         $this->data['setting'] = Setting::with('country' ,'state' ,'city')->find(1);
         if ($this->data['setting'] == "") {
             $this->data['general_setting'] = (object)array();
             $this->data['general_setting']->site_date_format = 1;
         }


        $this->data['social'] = Social::find(1);
        return view('admin.settings.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

               $this->data['homeseo'] = SeoHome::find(1);
         return view('admin.settings.seo_home', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

                 // dd($request->all());
                $request->validate([
                   'favicon' => 'dimensions:width=33,height=35',
                   'logo' => 'dimensions:width=133,height=35'
                   
                   ],
                   [
                        'favicon.dimensions' => 'Favicon size must be 33 x 35',
                        'logo.dimensions' => 'Logo size must be 133 x 35',
                   ]);
                $set = Setting::find(1);
                $set->store_name      = $request->store_name;
                $set->store_email     = $request->email;
                $set->store_contact   = $request->contact_us;
                $set->address_name    = $request->address_name;
                $set->address_email   = $request->address_email;
                $set->address_contact = $request->address_contact_us;
                $set->country_id      = $request->country;
                $set->state_id        = $request->state;
                $set->city_id         = $request->city_id;
                $set->pincode         = $request->postal_code;
                $set->site_date_format = $request->site_date_format;
                $set->time_zone        = $request->timezone;
                $set->currency_name    = $request->currency_name;
                $set->currency_symbol  = $request->currency_symbol;
                $set->currency_format  = $request->currency_format;
                $set->thousan_separator  = $request->thousan_separator;
                $set->decimal_separator  = $request->decimal_separator;
                $set->no_of_decimal      = $request->no_of_decimal;
                if ($request->hasFile('favicon')) {
                    $file = $request->file('favicon');
                    $fileName = time() . '_' . rand(0, 500) . '_' . $file->getClientOriginalName();
                    $fileName = str_replace(' ', '_', $fileName);
                    $file->storeAs('generalsetting/' , $fileName, ['disk' => 'public']);
                    \Storage::delete('public/generalsetting/' . $set->favicon);
                    $set->favicon = $fileName??NULL;
                }

                if ($request->hasFile('logo')) {
                    $file = $request->file('logo');
                    $fileName = time() . '_' . rand(0, 500) . '_' . $file->getClientOriginalName();
                    $fileName = str_replace(' ', '_', $fileName);
                    $file->storeAs('generalsetting/' , $fileName, ['disk' => 'public']);
                    \Storage::delete('public/generalsetting/' . $set->logo);
                    $set->logo = $fileName??NULL;
                } 
                
                $set->save();

                $social = Social::find(1);
                $social->facebook  = $request->facebook;
                $social->twitter   = $request->twitter;
                $social->youtube   = $request->youtube;
                $social->instagram = $request->instagram;
                $social->linkedin  = $request->linkin;
                $social->save();

                return redirect()->route('admin.settings.index')->with('success','Settings updated Successfully.');

                    
              
           
                // dd('yes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
        $this->data['title'] = 'Settings' ;
        return view('admin.settings.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
      
                $home = SeoHome::find($id);
                $home->home_title       = $request->home_title;
                $home->home_keywords    = $request->home_keywords;
                $home->home_description = $request->home_description;
                $home->save();
                 return redirect()->route('admin.homeseo.create')->with('success','Home Seo updated Successfully.');

          
        // dd($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
