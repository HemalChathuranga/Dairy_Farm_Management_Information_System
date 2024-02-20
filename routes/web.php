<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/1', function () {
//     return view('message');
// });

// <--- User Authentication Routes --->
Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'authLogin']);
Route::get('logout', [AuthController::class, 'authLogout']);





Route::get('admin/admin/list', function () {
    return view('admin.admin.list');
});


Route::group(['middleware' => 'admin'], function(){

    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    });

});

Route::group(['middleware' => 'manager'], function(){

    Route::get('manager/dashboard', function () {
        return view('admin.dashboard');
    });
    
});

Route::group(['middleware' => 'officeStaff'], function(){

    Route::get('officeStaff/dashboard', function () {
        return view('admin.dashboard');
    });
    
});

Route::group(['middleware' => 'medicalStaff'], function(){

    Route::get('medicalStaff/dashboard', function () {
        return view('admin.dashboard');
    });
    
});

Route::group(['middleware' => 'fieldStaff'], function(){
    
    Route::get('fieldStaff/dashboard', function () {
        return view('admin.dashboard');
    });
    
});

Route::group(['middleware' => 'storesStaff'], function(){

    Route::get('storesStaff/dashboard', function () {
        return view('admin.dashboard');
    });
    
});