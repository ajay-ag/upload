<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;
use Hash;

class ProfileController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       
        $adminuser = Auth::guard('admin')->user()->id ?? null;


        $user = request()->user(); //getting the current logged in user

        $data['admin'] = Admin::findorfail($adminuser);
     

        return view('admin.profile.profile',$data);
    }

    public function overviewIndex()
    {
        $adminuser = Auth::guard('admin')->user()->id ?? null;


        $user = request()->user(); //getting the current logged in user

        $data['admin'] = Admin::findorfail($adminuser);

        return view('admin.profile.overview',$data);
    }

    public function changepasswordIndex()
    {
        $adminuser = Auth::guard('admin')->user()->id ?? null;


        $user = request()->user(); //getting the current logged in user

        $data['admin'] = Admin::findorfail($adminuser);

        return view('admin.profile.change-password',$data);
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

    public function profileChange(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . $request->admin_id
        ]);
        if ($validator->passes()) {
            $admin = Admin::findorfail($request->admin_id);
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->save();

            Session::flash('success', "Profile has been updated successfully.");
            return redirect('admin/profile');
        }
        return back()->with('errors', $validator->errors());
    }

    public function passwordChange(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'required|same:password'
        ]);
        if ($validator->passes()) {
            $admin = Admin::findorfail($request->admin_id);
            if (Hash::check($request->old_password, $admin->password)) {

                $admin->password = Hash::make($request->password);
                try {
                    $admin->save();
                    $flag = TRUE;
                } catch (\Exception $e) {
                    $flag = FALSE;
                }
                if ($flag) {
                    Session::flash('success', 'Password has been changed successfully.');
                    return redirect('admin/profile-change-password');
                } else {
                    Session::flash('error', 'Unable to process request this time. Try again later.');
                    return redirect('admin/profile-change-password');
                }
            }
            Session::flash('error', "Your current password do not match in our record. Try to enter valid password");
            return redirect('admin/profile-change-password');
        }
        return back()->with('errors', $validator->errors());
    }

    public function changeProfilImage(Request $request, $id)
    {

        $status = 400;

        $admin = Admin::findorfail($id);

        $oldImage = $admin->profile_image;

        $file_data = $request->input('image');

        $file_name = 'image_' . time() . '.png'; //generating unique file name;

        
        $url = 'profile/' . $file_name; //generating unique file name;


        @list($type, $file_data) = explode(';', $file_data);

        @list(, $file_data) = explode(',', $file_data);

        if ($file_data != "") { // storing image in storage/app/public Folder
            $isUploda = \Storage::disk('public')->put($url, base64_decode($file_data));
            if ($isUploda) {
                \Storage::disk('public')->delete($oldImage);
            }
            $admin->profile_image = $url;
            $admin->save();

            $status = 200;
        }

        return response()->json([
            'success' => true,
            'message' => 'Profile Upload successfully',
            'image_url' => $admin->profile_image,
        ], $status);


    }
}
