<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeesController extends Controller
{

    public function index(Request $request){

        $search = $request['search'] ?? "";

        if($search === ""){
            $employees = Employee::paginate(10); 
        }else{
            $employees = Employee::where('name','LIKE',"%$search%")->paginate(10); 
        }

        return view('pages/employees',compact('search','employees'));
    }

    public function create(){
        $route = "/store";
        $employee = new Employee();
        return view('pages/employeeForm',compact('route','employee'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'contactNo' => 'required'
        ]);

        $employee = new Employee();
        $employee->name = $request['name'];
        $employee->email = $request['email'];
        $employee->contactNo= $request['contactNo'];
        $employee->save();
        return redirect('/');
    }

    public function edit($id, Request $request){
        $route = "/update/$id";
        $employee = Employee::find($id);
        return view('pages/employeeForm', compact('route','employee'));
    }

    public function update($id, Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'contactNo' => 'required'
        ]);

        $employee = Employee::find($id);
        $employee->name = $request['name'];
        $employee->email = $request['email'];
        $employee->contactNo= $request['contactNo'];
        $employee->update();   
        return redirect('/');
    }

    public function delete($id, Request $request){
        $student = Employee::find($id);
        $student->delete();
        return redirect()->back();
    }

    public function trash(Request $request){

        $search = $request['search'] ?? "";

        if($search === ""){
            $employees = Employee::onlyTrashed()->paginate(10); 
        }else{
            $employees = Employee::onlyTrashed()->where('name','LIKE',"%$search%")->paginate(10); 
        }

        return view('pages/trash',compact('search','employees'));
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

}
