<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\AdvertisementPost;
use App\User;

class AdminHomeController extends Controller
{
    //
    public function index()
    {
        $this->data['title'] = 'Dashboard';
        $this->data['user_count'] = User::where('is_active', 'Yes')->count();
        $this->data['pending_count'] = AdvertisementPost::where('status', 'pending')
            ->where('deleted_at', '=', null)
            ->count();

        $this->data['approved_count'] = AdvertisementPost::where('status', 'approved')
            ->where('deleted_at', '=', null)
            ->count();

        $this->data['canceled_count'] = AdvertisementPost::where('status', 'canceled')
            ->where('deleted_at', '=', null)
            ->count();


        return view('admin.home', $this->data);
    }

}
