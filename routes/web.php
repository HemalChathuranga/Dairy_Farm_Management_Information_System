<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::get('admin/admin/list', function () {
    return view('admin.admin.list');
});

// <--- User Authentication Routes --->
Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'authLogin']);
Route::get('logout', [AuthController::class, 'authLogout']);


// <--- Admin Middleware Group -->
Route::group(['middleware' => 'admin'], function(){
    Route::get('admin/dashboard', [DashboardController::class, 'index']);

});

// <--- Manager Middleware Group -->
Route::group(['middleware' => 'manager'], function(){
    Route::get('manager/dashboard', [DashboardController::class, 'index']);
    
});

// <--- Office Staff  Middleware Group -->
Route::group(['middleware' => 'officeStaff'], function(){
    Route::get('officeStaff/dashboard', [DashboardController::class, 'index']);
    
});

// <--- Medical Staff Middleware Group -->
Route::group(['middleware' => 'medicalStaff'], function(){
    Route::get('medicalStaff/dashboard', [DashboardController::class, 'index']);
    
});

// <--- Field Staff  Middleware Group -->
Route::group(['middleware' => 'fieldStaff'], function(){
    Route::get('fieldStaff/dashboard', [DashboardController::class, 'index']);
    
});

// <--- Stores Staff Middleware Group -->
Route::group(['middleware' => 'storesStaff'], function(){
    Route::get('storesStaff/dashboard', [DashboardController::class, 'index']);
    
});