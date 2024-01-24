<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EmployeesController;

// routes for the session storage:
Route::get('get-session-data', function(){
    $sessionData = session()->all();
    echo "<pre>";
    print_r($sessionData);
});

Route::get('flush-session-data', function(Request $request){
    $request->session()->flush();
    return redirect('/get-session-data');
});

// authentication routes:
Route::get('/register', function () {
    return view('pages/auth/register');
});

Route::get('/login', function () {
    return view('pages/auth/login');
});

Route::get('/logout',function () {
    session()->forget(['login_token','username']);
    return redirect('/login');
});

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

//application routes:
Route::middleware(['auth'])->group(function(){

    Route::get('/', [EmployeesController::class,'index']);

    Route::get('/create', [EmployeesController::class,'create']);

    Route::post('/store', [EmployeesController::class,'store']);

    Route::get('/edit/{id}', [EmployeesController::class,'edit']);

    Route::post('/update/{id}', [EmployeesController::class,'update']);

    Route::get('/delete/{id}', [EmployeesController::class,'delete']);

    Route::get('/trash', [EmployeesController::class,'trash']);

    Route::get('/restore/{id}',[EmployeesController::class,'restore']);

    Route::get('/forceDelete/{id}', [EmployeesController::class,'forceDelete']);

});