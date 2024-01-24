<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function register (Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $userInfo = User::where('email',$request->email)->first();


        if(!is_null($userInfo)){

            return redirect('/register')->with('alert_info',"User already exist");
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $login_token = rand(1000,9999);
        session(['login_token'=>$login_token,'username'=>$request->name]);

        return redirect('/');
    }
    
    public function login (Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $userInfo = User::where('email',$request->email)->first();

        if(is_null($userInfo)){
            return redirect('/login')->with('alert_info',"Invalid Email");
        }

        if(Hash::check($request->password,$userInfo->password)){
            $login_token = rand(1000,9999);
            session(['login_token'=>$login_token,'username'=>$userInfo->name]);
            return redirect('/');
        }else{
            return redirect('/login')->with('alert_info',"Invalid Password");
        }

    }
}
