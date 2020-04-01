<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
          $userId = Auth::user()->id;
         $this->data['total_approve'] = DB::table('advertisement_posts AS ap')->where('ap.user_id', $userId)->where('ap.deleted_at', '=', null)->where('status', '=', 'approved')->count();
        $this->data['total_canceled'] = DB::table('advertisement_posts AS ap')->where('ap.user_id', $userId)->where('ap.deleted_at', '=', null)->where('status', '=', 'canceled')->count();
        $this->data['total_panding'] = DB::table('advertisement_posts AS ap')->where('ap.user_id', $userId)->where('ap.deleted_at', '=', null)->where('status', '=', 'pending')->count();

        return view('websiteview.user_panel.index',$this->data);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
