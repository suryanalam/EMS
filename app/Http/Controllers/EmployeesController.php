<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Hash;
use Auth;

class EmployeesController extends Controller
{

    // For admin: 

    public function index(Request $request){

        $search = $request['search'] ?? "";

        if($search === ""){
            $employees = Employee::with('department')->paginate(10); 
        }else{
            $employees = Employee::with('department')->where('name','LIKE',"%$search%")->paginate(10); 
        }
        
        return view('pages.admin.employees',compact('search','employees'));
    }

    public function create(){
        $route = "/store";
        $employee = new Employee();
        return view('pages.admin.employeeForm',compact('route','employee'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);

        $employee = new Employee();
        $employee->name = $request['name'];
        $employee->email = $request['email'];
        $employee->phone= $request['phone'];
        $employee->role = $request['role'];
        $employee->deptId= $request['deptId'];
        $employee->password = Hash::make('externsclub');
        $employee->status = "verified";
        $employee->token = "";
        $employee->save();

        return redirect('/')->with('success','Employee Added Succesfully');
    }

    public function edit($id, Request $request){
        $route = "/update/$id";
        $employee = Employee::find($id);
        return view('pages.admin.employeeForm', compact('route','employee'));
    }

    public function update($id, Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);

        $employee = Employee::find($id);
        $employee->name = $request['name'];
        $employee->email = $request['email'];
        $employee->phone= $request['phone'];
        $employee->role = $request['role'];
        $employee->deptId= $request['deptId'];
        $employee->update();   

        return redirect('/')->with('success','Employee Updated Succesfully');
    }

    public function delete($id, Request $request){
        $student = Employee::find($id);
        $student->delete();
        return redirect()->back();
    }

    public function trash(Request $request){

        $search = $request['search'] ?? "";

        if($search === ""){
            $employees = Employee::with('department')->onlyTrashed()->paginate(10); 
        }else{
            $employees = Employee::with('department')->onlyTrashed()->where('name','LIKE',"%$search%")->paginate(10); 
        }

        return view('pages.admin.trash',compact('search','employees'));
    }

    public function restore($id, Request $request){
        $employee = Employee::withTrashed()->find($id);
        $employee->restore();
        return redirect('/');
    }

    public function forceDelete($id, Request $request){
        $employee = Employee::withTrashed()->find($id);
        $employee->forceDelete();
        return redirect()->back();
    }

    // For employees: 

    public function dashboard(){
        return view('pages.dashboard');
    }

    public function profile(){
        $employee = Auth::guard('web')->user();
        return view('pages.profile', compact('employee'));
    }

    public function profileUpdate(Request $request){

        $employee = Employee::where('eid',$request->eid)->first();

        if(!$employee){
            return redirect('/employee/profile')->with('error','Employee not found');
        }

        if($request->hasFile('photo')){
            
            $request->validate([
                'photo' => 'image|mimes:jpeg,jpg,png',
            ]);

            if($employee->photo !== null){
                if(public_path("uploads/$employee->photo")){
                    unlink(public_path("uploads/$employee->photo"));
                }
            }
  
            $ext = $request->file('photo')->extension();
            $photo_name = time() . '_image' . '.' . $ext;

            $request->file('photo')->move(public_path("uploads/"),$photo_name);

            $employee->photo = $photo_name;
            $employee->update();

            return redirect('/employee/profile')->with('success','Photo updated successfully');
        }

        $request->validate([
            "name"=>"required",
            "email"=>"required|email"
        ]);

        $employee->name = $request->name;
        $employee->email = $request->email;

        if($request->phone){
            $employee->phone = $request->phone;
        }

        if($request->password){
            $password = Hash::make($request->password);
            $employee->password = $password;
        }

        $employee->update();

        return redirect('/employee/profile')->with('success','Profile updated successfully');
    }

}
