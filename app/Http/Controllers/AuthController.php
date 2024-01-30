<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AuthEmail;
use App\Models\Employee;
use Hash;
use Auth;

class AuthController extends Controller
{
    public function registerForm(){
        return view('auth.register');
    }

    public function register (Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $employeeInfo = Employee::where('email',$request->email)->first();

        if($employeeInfo){
            return redirect('/register')->with('error',"Employee already exist");
        }

        $token = hash('sha256',time());

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->password = Hash::make($request->password);
        $employee->status = "not verified";
        $employee->token = $token;
        $employee->save();

        $verification_link = url("email/verify/$token");
        $subject = "Email Verification";
        $message = "Click this link to verify your email: <a href=' $verification_link'>verify</a>";

        \Mail::to($request->email)->send(new AuthEmail($subject, $message));

        $text = "Please check your email for a verification link.";

        return redirect('register')->with('success','Check your email to verify the email address');
    }

    public function verifyEmail($token){

        $employee = Employee::where('token',$token)->first();

        if(!$employee){
            return redirect('login')->with('error','Invalid Route');
        }

        $employee->status = "verified";
        $employee->token = "";
        $employee->update();

        $subject = "Email Verification";
        $text = "Email has been verified successfully";

        return redirect('login')->with('success','Email Verified Successfully');

    }

    public function loginForm(){
        return view('auth.login');
    }
    
    public function login (Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $request->email,
            'password'=>$request->password,
            'status'=>'verified'
        ];

        if(Auth::attempt($credentials)){
            return redirect('/employee/dashboard');
        }else{
            return redirect('/login')->with('error',"Invalid Credentials");
        }

    }

    public function forgetPasswordForm(){
        return view('auth.forgetPassword');
    }

    public function forgetPassword(Request $request){

        $request->validate([
            'email' => 'required|email',
        ]);

        $employee = Employee::where('email',$request->email)->first();

        if(!$employee){
            return redirect('login')->with('error',"Email doesn't exist");
        }

        $token = hash('sha256',time());

        $employee->token = $token;
        $employee->update();

        $reset_link = url("reset-password/$token");
        $subject = "Reset Password";
        $message = "<a href='$reset_link'>click here</a> to reset your password";

        \Mail::to($request->email)->send(new AuthEmail($subject, $message));
        
        return redirect('login')->with('success','Please check your email to reset password.');
    }

    public function resetPasswordForm($token){

        $employee = Employee::where('token',$token)->first();

        if(!$employee){
            return redirect('login')->with('error',"Invalid Route");
        }

        return view('auth.resetPassword', compact('token'));
    }

    public function resetPassword(Request $request){

        $request->validate([
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);

        $employee = Employee::where('token',$request->token)->first();

        if(!$employee){
            return redirect('login')->with('error',"Invalid Email");
        }

        $employee->password = Hash::make($request->new_password);
        $employee->token="";
        $employee->update();
        
        return redirect('login')->with('success',"Password updated successfully");
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect('login');
    }
}
