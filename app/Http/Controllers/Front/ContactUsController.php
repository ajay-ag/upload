<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Common as Helper;
use App\Http\Controllers\Controller;
use App\Model\ContactUs;
use App\Model\Mailsetup;
use Illuminate\Http\Request;
use Mail;
use Session;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $static_page = Helper::getStaticpage('2');
      
        $data['static_page'] = $static_page;
        $this->data['title'] = 'Contact Us';
        return view('websiteview.contact_us.contact_us', $this->data, $data);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $setting = Mailsetup::where('id', 1)->first();
        $email = $setting->mail_username;

        //

        $inquiry = new ContactUs();
        $inquiry->name = $request->name;
        $inquiry->mobile = $request->mobile;
        $inquiry->email = $request->email;
        $inquiry->subject = $request->subject;
        $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $request->remarks);


        $inquiry->remarks = $string;
        $inquiry->save();

        $data['subject'] = $request->subject;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->mobile;
        $data['message1'] = $string;

        Mail::send('websiteview.mail.contact_mail', $data, function ($message) use ($email) {
            $message->to($email, 'City Post Contact')->subject
            ('City Post Contact');
            $message->from($email, 'contact');
        });


        Session::flash('success', "Contact submitted successfully");
        return redirect()->route('contactus.index');
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

    public function privancy()
    {
        $static_page = Helper::getStaticpage('8');
        $data['static_page'] = $static_page;
        $this->data['title'] = 'Privancy Policy';
        return view('websiteview.contact_us.privancy_policy', $this->data, $data);
    }

    public function termsAndConditions()
    {
        $static_page = Helper::getStaticpage('9');
        $data['static_page'] = $static_page;
        $this->data['title'] = 'Terms And Conditions';
        return view('websiteview.contact_us.terms-and-conditions', $this->data, $data);
    }
}
