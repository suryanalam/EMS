<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EmployeesController;

// Session Storage Routes:
Route::get('get-session-data', function(){
    $sessionData = session()->all();
    echo "<pre>";
    print_r($sessionData);
});

Route::get('flush-session-data', function(Request $request){
    $request->session()->flush();
    return redirect('/get-session-data');
});


// User Authentication Routes:
Route::get('/register', [AuthController::class,'registerForm'])->name('register');
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::get('/email/verify/{token}',[AuthController::class,'verifyEmail'])->name('verify_email');

Route::get('/login', [AuthController::class,'loginForm'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login');

Route::get('/forget-password', [AuthController::class,'forgetPasswordForm'])->name('forget_password');
Route::post('/forget-password',[AuthController::class,'forgetPassword'])->name('forget_password');

Route::get('/reset-password/{token}', [AuthController::class,'resetPasswordForm'])->name('reset_password');
Route::post('/reset-password',[AuthController::class,'resetPassword'])->name('reset_password');


// User Routes: 
Route::middleware('auth')->group(function(){
    Route::get('/employee/dashboard', [EmployeesController::class,'dashboard'] )->name('employee_dashboard');

    Route::get('/employee/profile', [EmployeesController::class,'profile'])->name('employee_profile');

    Route::post('/employee/profile/update', [EmployeesController::class,'profileUpdate'])->name('update_employee_profile');

    Route::get('/logout', [AuthController::class,'logout'])->name('logout');
});


// Admin Routes:

Route::get('/admin/login',[AdminController::class,'loginForm'])->name('admin_login');

Route::post('/admin/login',[AdminController::class,'login'])->name('admin_login');

Route::middleware(['admin:admin'])->group(function(){

    Route::get('/', [EmployeesController::class,'index']);

    Route::get('/create', [EmployeesController::class,'create']);

    Route::post('/store', [EmployeesController::class,'store']);

    Route::get('/edit/{id}', [EmployeesController::class,'edit']);

    Route::post('/update/{id}', [EmployeesController::class,'update']);

    Route::get('/delete/{id}', [EmployeesController::class,'delete']);

    Route::get('/trash', [EmployeesController::class,'trash']);

    Route::get('/restore/{id}',[EmployeesController::class,'restore']);

    Route::get('/forceDelete/{id}', [EmployeesController::class,'forceDelete']);

    Route::get('/admin/profile',[AdminController::class,'profile'])->middleware('admin:admin')->name('admin_profile');

    Route::post('/admin/profile/update', [AdminController::class,'update'])->name('update_admin_profile');

    Route::get('/admin/logout',[AdminController::class,'logout'])->name('admin_logout');

});