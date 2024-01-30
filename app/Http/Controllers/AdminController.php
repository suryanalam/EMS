<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Hash;
use Auth;

class AdminController extends Controller
{
    public function loginForm(){
        return view('pages.admin.login');
    }
    
    public function login (Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $request->email,
            'password'=>$request->password,
        ];

        if(Auth::guard('admin')->attempt($credentials)){
            return redirect('/');
        }else{
            return redirect('/admin/login')->with('error',"Invalid Credentials");
        }

    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    public function profile(){
        $admin = Auth::guard('admin')->user();

        if($admin){
             return view('pages.admin.profile', compact('admin'));
        }else{
            return redirect()->back()->with('error','Admin details not found');
        }
       
    }

    public function update(Request $request){

        $admin = Admin::where('admin_id',$request->admin_id)->first();

        if(!$admin){
            return redirect('/admin/profile')->with('error','Admin not found');
        }

        if($request->hasFile('photo')){
            
            $request->validate([
                'photo' => 'image|mimes:jpeg,jpg,png',
            ]);

            if($admin->photo !== null){
                if(public_path("uploads/$admin->photo")){
                    unlink(public_path("uploads/$admin->photo"));
                }
            }
  
            $ext = $request->file('photo')->extension();
            $photo_name = time() . '_image' . '.' . $ext;

            $request->file('photo')->move(public_path("uploads/"),$photo_name);

            $admin->photo = $photo_name;
            $admin->update();

            return redirect('/admin/profile')->with('success','Photo updated successfully');
        }

        $request->validate([
            "name"=>"required",
            "email"=>"required|email"
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        if($request->phone){
            $admin->phone = $request->phone;
        }

        if($request->password){
            $passowrd = Hash::make($request->password);
            $admin->password = $passowrd;
        }

        $admin->update();

        return redirect('/admin/profile')->with('success','Profile updated successfully');
    }

}
